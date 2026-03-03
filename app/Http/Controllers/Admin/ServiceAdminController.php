<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ServiceAdminController extends Controller
{
    public function index(Request $request, $type = 'technical')
    {
        $query = Service::query()->whereHas('category', function ($q) use ($type) {
            $q->where('type', $type);
        });

        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $services = $query->orderBy('name')->paginate(10)->withQueryString();

        // Load categories for the modal
        $categories = ServiceCategory::where('type', $type)->get();

        return Inertia::render('Admin/Services/Index', [
            'services' => $services,
            'categories' => $categories,
            'type' => $type,
            'filters' => $request->only(['search']),
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:service_categories,id',
            'short_description' => 'required|string|max:500',
            'full_description' => 'required|string',
            'icon' => 'nullable|string|max:50',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'location' => 'nullable|string|max:255',
            'working_hours' => 'nullable|string|max:255',
            'active' => 'boolean',
            'equipments' => 'nullable|string', // Comma separated
        ];

        $validated = $request->validate($rules);

        // Manage Slug
        $slug = Str::slug($validated['name']);
        if (!$request->id && Service::where('slug', $slug)->exists()) {
            $slug .= '-' . time();
        }

        $data = [
            'name' => $validated['name'],
            'slug' => $slug,
            'category_id' => $validated['category_id'],
            'short_description' => $validated['short_description'],
            'full_description' => $validated['full_description'],
            'icon' => $validated['icon'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'location' => $validated['location'],
            'working_hours' => $validated['working_hours'],
            'active' => $validated['active'] ?? true,
            'equipments' => $validated['equipments'] ? array_map('trim', explode(',', $validated['equipments'])) : [],
        ];

        // Handle Image
        $service = $request->id ? Service::findOrFail($request->id) : new Service();

        if ($request->hasFile('image')) {
            if ($service->image && Storage::disk('public')->exists($service->image)) {
                Storage::disk('public')->delete($service->image);
            }
            $data['image'] = $request->file('image')->store('services', 'public');
        }

        // Handle Team Members JSON logic
        $team = $request->input('team_members', ['leader' => [], 'members' => []]);
        if (is_string($team)) {
            $team = json_decode($team, true);
        }

        // Handle Team Photos
        if ($request->hasFile('leader_photo')) {
            $team['leader']['photo'] = $request->file('leader_photo')->store('team-photos', 'public');
        }

        if ($request->hasFile('members_photos')) {
            foreach ($request->file('members_photos') as $index => $photo) {
                if (isset($team['members'][$index])) {
                    $team['members'][$index]['photo'] = $photo->store('team-photos', 'public');
                }
            }
        }

        $data['team_members'] = $team;

        if ($request->id) {
            $service->update($data);
            $message = 'Service mis à jour avec succès.';
        } else {
            Service::create($data);
            $message = 'Service créé avec succès.';
        }

        return redirect()->back()->with('success', $message);
    }

    public function destroy(Service $service)
    {
        if ($service->image && Storage::disk('public')->exists($service->image)) {
            Storage::disk('public')->delete($service->image);
        }

        $service->delete();

        return redirect()->back()->with('success', 'Service supprimé avec succès.');
    }
}
