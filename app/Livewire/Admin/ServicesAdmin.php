<?php

namespace App\Livewire\Admin;

use App\Models\Service;
use App\Models\ServiceCategory;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ServicesAdmin extends Component
{
    use WithPagination, WithFileUploads;

    public $serviceData = [
        'name' => '',
        'category_id' => '',
        'icon' => '',
        'short_description' => '',
        'full_description' => '',
        'phone' => '',
        'email' => '',
        'location' => '',
        'working_hours' => '',
        'team_members' => [
            'leader' => [
                'name' => '',
                'position' => '',
                'photo' => '',
                'email' => ''
            ],
            'members' => []
        ],
        'order' => 0,
        'featured' => false,
        'active' => true
    ];

    public $image;
    public $teamLeaderPhotoTemp;
    public $teamMemberPhotoTemp = [];

    public $categories = [];
    public $administrativeCategoryIds = [];
    public $showEditModal = false;
    public $editingServiceId = null;
    public $searchTerm = '';
    public $categoryFilter = '';
    public $statusFilter = null;
    public $sortField = 'name';
    public $sortDirection = 'asc';

    public $serviceType = 'administrative';
    public $pageTitle = 'Gestion des Services Administratifs';


    public function render()
    {
        $services = $this->getFilteredServices();
        $categories = ServiceCategory::where('type', $this->serviceType)->get();

        return view('livewire.admin.services-admin', [
            'services' => $services,
            'categories' => $categories,
            'serviceType' => $this->serviceType
        ]);
    }

    public function getFilteredServices()
    {
        $query = Service::query()
            ->join('service_categories', 'services.category_id', '=', 'service_categories.id')
            ->where('service_categories.type', 'administrative')
            ->select('services.*');

        if (!empty($this->searchTerm)) {
            $query->where(function ($q) {
                $q->where('services.name', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('services.short_description', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('services.phone', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('services.email', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('services.location', 'like', '%' . $this->searchTerm . '%');
            });
        }

        if (!empty($this->categoryFilter)) {
            $query->where('services.category_id', $this->categoryFilter);
        }

        if ($this->statusFilter !== null) {
            $query->where('services.active', $this->statusFilter);
        }

        if ($this->sortField === 'category_id') {
            $query->orderBy('service_categories.name', $this->sortDirection);
        } else {
            $query->orderBy('services.' . $this->sortField, $this->sortDirection);
        }

        return $query->with('category')->paginate(10);
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function resetFilters()
    {
        $this->searchTerm = '';
        $this->categoryFilter = '';
        $this->statusFilter = null;
    }

    public function resetSearch()
    {
        $this->searchTerm = '';
    }

    public function createNewService()
    {
        $this->resetForm();
        $firstAdminCategory = ServiceCategory::where('type', 'administrative')->first();
        if ($firstAdminCategory) {
            $this->serviceData['category_id'] = $firstAdminCategory->id;
        }
        $this->showEditModal = true;
        $this->dispatch('modal-opened');
    }

    public function editService($id)
    {
        $this->resetForm();
        $this->editingServiceId = $id;

        $service = Service::findOrFail($id);
        $category = ServiceCategory::findOrFail($service->category_id);
        if ($category->type !== 'administrative') {
            session()->flash('error', 'Ce service n\'est pas un service administratif.');
            return;
        }

        $this->serviceData = [
            'name' => $service->name,
            'category_id' => $service->category_id,
            'icon' => $service->icon,
            'image' => $service->image,
            'short_description' => $service->short_description,
            'full_description' => $service->full_description,
            'phone' => $service->phone,
            'email' => $service->email,
            'location' => $service->location,
            'working_hours' => $service->working_hours,
            'team_members' => $service->team_members ?? [
                'leader' => ['name' => '', 'position' => '', 'photo' => '', 'email' => ''],
                'members' => []
            ],
            'order' => $service->order,
            'featured' => $service->featured,
            'active' => $service->active
        ];

        $this->showEditModal = true;
        $this->dispatch('modal-opened');
    }

    public function closeModal()
    {
        $this->showEditModal = false;
    }

    public function resetForm()
    {
        $this->serviceData = [
            'name' => '',
            'category_id' => '',
            'icon' => '',
            'short_description' => '',
            'full_description' => '',
            'phone' => '',
            'email' => '',
            'location' => '',
            'working_hours' => '',
            'team_members' => [
                'leader' => [
                    'name' => '',
                    'position' => '',
                    'photo' => '',
                    'email' => ''
                ],
                'members' => []
            ],
            'order' => 0,
            'featured' => false,
            'active' => true
        ];

        $this->image = null;
        $this->teamLeaderPhotoTemp = null;
        $this->teamMemberPhotoTemp = [];
        $this->editingServiceId = null;
        $this->resetErrorBag();
    }

    protected function rules()
    {
        return [
            'serviceData.name' => 'required|string|max:255',
            'serviceData.category_id' => 'required|exists:service_categories,id',
            'serviceData.icon' => 'nullable|string|max:255',
            'serviceData.short_description' => 'required|string|max:500',
            'serviceData.full_description' => 'nullable|string',
            'serviceData.phone' => 'nullable|string|max:255',
            'serviceData.email' => 'nullable|email|max:255',
            'serviceData.location' => 'nullable|string|max:255',
            'serviceData.working_hours' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048'
        ];
    }

    public function saveService()
    {
        $this->validate();

        $category = ServiceCategory::findOrFail($this->serviceData['category_id']);
        if ($category->type !== 'administrative') {
            session()->flash('error', 'Veuillez choisir une catégorie administrative.');
            return;
        }

        try {
            $service = $this->editingServiceId ? Service::findOrFail($this->editingServiceId) : new Service();
            if (empty($service->slug)) {
                $service->slug = Str::slug($this->serviceData['name']);
            }

            if ($this->image) {
                if ($service->image && Storage::exists($service->image)) {
                    Storage::delete($service->image);
                }
                $imagePath = $this->image->store('services', 'public');
                $this->serviceData['image'] = $imagePath;
            }

            $this->processTeamPhotos();
            $service->fill($this->serviceData);
            $service->save();

            session()->flash('success', $this->editingServiceId ? 'Service administratif mis à jour.' : 'Service administratif créé.');
            $this->showEditModal = false;
        } catch (\Exception $e) {
            Log::error('Erreur lors de la sauvegarde: ' . $e->getMessage());
            session()->flash('error', 'Erreur lors de l\'enregistrement.');
        }
    }

    protected function processTeamPhotos()
    {
        if ($this->teamLeaderPhotoTemp) {
            $path = $this->teamLeaderPhotoTemp->store('team-photos', 'public');
            $this->serviceData['team_members']['leader']['photo'] = Storage::url($path);
        }

        if (!empty($this->teamMemberPhotoTemp)) {
            foreach ($this->teamMemberPhotoTemp as $index => $photo) {
                if ($photo && isset($this->serviceData['team_members']['members'][$index])) {
                    $path = $photo->store('team-photos', 'public');
                    $this->serviceData['team_members']['members'][$index]['photo'] = Storage::url($path);
                }
            }
        }
    }

    public function confirmDeleteService($id)
    {
        $service = Service::findOrFail($id);
        $category = ServiceCategory::findOrFail($service->category_id);

        if ($category->type !== 'administrative') {
            session()->flash('error', 'Ce service n\'est pas un service administratif.');
            return;
        }

        $this->dispatch('confirm-service-deletion', ['id' => $id]);
    }

    public function deleteService($id)
    {
        $service = Service::findOrFail($id);
        $category = ServiceCategory::findOrFail($service->category_id);

        if ($category->type !== 'administrative') {
            session()->flash('error', 'Ce service n\'est pas un service administratif.');
            return;
        }

        if ($service->image && Storage::exists($service->image)) {
            Storage::delete($service->image);
        }

        $service->delete();
        session()->flash('success', 'Service administratif supprimé avec succès.');
    }

    public function addTeamMember()
    {
        if (!isset($this->serviceData['team_members']['members'])) {
            $this->serviceData['team_members']['members'] = [];
        }

        $this->serviceData['team_members']['members'][] = [
            'name' => '',
            'position' => '',
            'photo' => '',
            'email' => ''
        ];
    }

    public function removeTeamMember($index)
    {
        if (isset($this->serviceData['team_members']['members'][$index])) {
            unset($this->serviceData['team_members']['members'][$index]);
            $this->serviceData['team_members']['members'] = array_values($this->serviceData['team_members']['members']);
        }

        if (isset($this->teamMemberPhotoTemp[$index])) {
            unset($this->teamMemberPhotoTemp[$index]);
        }
    }

    public function removeTeamLeaderPhoto()
    {
        $this->serviceData['team_members']['leader']['photo'] = '';
        $this->teamLeaderPhotoTemp = null;
    }

    public function removeTeamMemberPhoto($index)
    {
        if (isset($this->serviceData['team_members']['members'][$index])) {
            $this->serviceData['team_members']['members'][$index]['photo'] = '';
        }

        if (isset($this->teamMemberPhotoTemp[$index])) {
            unset($this->teamMemberPhotoTemp[$index]);
        }
    }
}
