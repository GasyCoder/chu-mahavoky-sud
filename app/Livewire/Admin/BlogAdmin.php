<?php

namespace App\Livewire\Admin;

use App\Models\Blog;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class BlogAdmin extends Component
{
    use WithPagination, WithFileUploads;

    // Propriétés du formulaire
    public $blog_id;
    public $title;
    public $slug;
    public $content;
    public $excerpt;
    public $image;
    public $temp_image;
    public $category;
    public $is_featured = false;
    public $status;
    public $published_at;

    // Propriétés pour la gestion de la liste
    public $search = '';
    public $category_filter = '';
    public $status_filter = '';
    public $perPage = 10;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    // Propriétés pour le mode d'affichage
    public $isModalOpen = false;
    public $confirmingItemDeletion = false;
    public $itemIdToDelete;

    public function mount()
    {
        if (request()->method() === 'GET' && request()->is('livewire/update')) {
            abort(403, 'Accès non autorisé');
        }
    }

    // Règles de validation
    protected function rules()
    {
        $rules = [
            'title' => 'required|min:3|max:255',
            'slug' => 'nullable|alpha_dash|max:255|unique:blogs,slug',
            'content' => 'required|min:10',
            'excerpt' => 'nullable|max:500',
            'category' => 'required|in:' . implode(',', Blog::categories()),
            'is_featured' => 'boolean',
            'status' => 'required|in:' . implode(',', array_keys(Blog::statuses())),
        ];

        // Si on est en mode édition, on exclut le slug actuel de la validation d'unicité
        if ($this->blog_id) {
            $rules['slug'] = 'nullable|alpha_dash|max:255|unique:blogs,slug,' . $this->blog_id;
        }

        // Si l'image est un objet (nouveau téléchargement), on la valide
        if ($this->temp_image && !is_string($this->temp_image)) {
            $rules['temp_image'] = 'image|max:2048';
        }

        return $rules;
    }

    // Messages d'erreur personnalisés
    protected $messages = [
        'title.required' => 'Le titre est obligatoire',
        'title.min' => 'Le titre doit contenir au moins :min caractères',
        'content.required' => 'Le contenu est obligatoire',
        'content.min' => 'Le contenu doit contenir au moins :min caractères',
        'temp_image.image' => 'Le fichier doit être une image',
        'temp_image.max' => 'L\'image ne doit pas dépasser 2Mo',
        'category.required' => 'La catégorie est obligatoire',
        'status.required' => 'Le statut est obligatoire',
    ];

    // Réinitialiser la pagination quand on effectue une recherche
    public function updatingSearch()
    {
        $this->resetPage();
    }

    // Réinitialiser le formulaire et ouvrir la modal
    public function create()
    {
        $this->resetInputFields();
        $this->status = Blog::STATUS_DRAFT;
        $this->category = Blog::CATEGORY_NEWS;
        $this->openModal();
    }

    // Charger les données d'un blog pour l'édition
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        $this->blog_id = $blog->id;
        $this->title = $blog->title;
        $this->slug = $blog->slug;
        $this->content = $blog->content;
        $this->excerpt = $blog->excerpt;
        $this->image = $blog->image;
        $this->category = $blog->category;
        $this->is_featured = $blog->is_featured;
        $this->status = $blog->status;
        $this->published_at = $blog->published_at ? $blog->published_at->format('Y-m-d\TH:i') : null;

        $this->openModal();
    }

    // Enregistrer ou mettre à jour un blog
    public function store()
    {
        $this->validate();

        // Gérer l'image si elle a été téléchargée
        if ($this->temp_image && !is_string($this->temp_image)) {
            // Supprimer l'ancienne image si elle existe
            if ($this->image && Storage::disk('public')->exists($this->image)) {
                Storage::disk('public')->delete($this->image);
            }

            // Stocker la nouvelle image
            $this->image = $this->temp_image->store('blogs', 'public');
        }

        // Créer ou mettre à jour le blog
        $blog = Blog::updateOrCreate(
            ['id' => $this->blog_id],
            [
                'title' => $this->title,
                'slug' => $this->slug ?: null, // Si le slug est vide, Laravel le générera automatiquement
                'content' => $this->content,
                'excerpt' => $this->excerpt,
                'image' => $this->image,
                'category' => $this->category,
                'is_featured' => $this->is_featured,
                'status' => $this->status,
                'published_at' => $this->status == Blog::STATUS_PUBLISHED ? ($this->published_at ?: now()) : $this->published_at,
            ]
        );

        session()->flash('message', $this->blog_id ? 'Article mis à jour avec succès.' : 'Article créé avec succès.');

        $this->closeModal();
        $this->resetInputFields();
    }

    // Confirmer la suppression d'un blog
    public function confirmDelete($id)
    {
        $this->confirmingItemDeletion = true;
        $this->itemIdToDelete = $id;
    }

    // Supprimer un blog
    public function delete()
    {
        $blog = Blog::findOrFail($this->itemIdToDelete);

        // Supprimer l'image si elle existe
        if ($blog->image && Storage::disk('public')->exists($blog->image)) {
            Storage::disk('public')->delete($blog->image);
        }

        $blog->delete();
        session()->flash('message', 'Article supprimé avec succès.');

        $this->confirmingItemDeletion = false;
    }

    // Annuler la suppression
    public function cancelDelete()
    {
        $this->confirmingItemDeletion = false;
        $this->itemIdToDelete = null;
    }

    // Ouvrir la modal
    public function openModal()
    {
        $this->isModalOpen = true;
    }

    // Fermer la modal
    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    // Réinitialiser les champs du formulaire
    public function resetInputFields()
    {
        $this->blog_id = null;
        $this->title = null;
        $this->slug = null;
        $this->content = null;
        $this->excerpt = null;
        $this->temp_image = null;
        $this->image = null;
        $this->category = Blog::CATEGORY_NEWS;
        $this->is_featured = false;
        $this->status = Blog::STATUS_DRAFT;
        $this->published_at = null;
        $this->resetErrorBag();
    }

    // Trier les blogs
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    // Changer le nombre d'éléments par page
    public function changeItemsPerPage($value)
    {
        $this->perPage = $value;
    }

    // Rendu du composant
    public function render()
    {
        $query = Blog::query();

        // Appliquer les filtres
        if ($this->search) {
            $query->search($this->search);
        }

        if ($this->category_filter) {
            $query->category($this->category_filter);
        }

        if ($this->status_filter) {
            $query->where('status', $this->status_filter);
        }

        // Appliquer le tri
        $query->orderBy($this->sortField, $this->sortDirection);

        // Récupérer les blogs paginés
        $blogs = $query->paginate($this->perPage);

        return view('livewire.admin.blog-admin', [
            'blogs' => $blogs,
            'categories' => Blog::categories(),
            'statuses' => Blog::statuses(),
        ]);
    }
}
