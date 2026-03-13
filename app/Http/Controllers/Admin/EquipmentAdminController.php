<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class EquipmentAdminController extends Controller
{
    public function index()
    {
        $equipments = Equipment::ordered()->get();

        return Inertia::render('Admin/Equipments/Index', [
            'equipments' => $equipments,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'icon' => 'nullable|string|max:50',
            'order' => 'nullable|integer',
            'status' => 'boolean',
            'image' => 'nullable|image|max:2048',
        ]);

        $equipment = $request->id ? Equipment::findOrFail($request->id) : new Equipment();

        $data = [
            'name' => $validated['name'],
            'description' => $validated['description'],
            'icon' => $validated['icon'] ?? 'fa-cog',
            'order' => $validated['order'] ?? 0,
            'status' => $validated['status'] ?? true,
        ];

        if ($request->hasFile('image')) {
            if ($equipment->image && Storage::disk('public')->exists($equipment->image)) {
                Storage::disk('public')->delete($equipment->image);
            }
            $data['image'] = $request->file('image')->store('equipments', 'public');
        }

        if ($request->id) {
            $equipment->update($data);
            $message = 'Équipement mis à jour avec succès.';
        } else {
            Equipment::create($data);
            $message = 'Équipement créé avec succès.';
        }

        return redirect()->back()->with('success', $message);
    }

    public function destroy(Equipment $equipment)
    {
        if ($equipment->image && Storage::disk('public')->exists($equipment->image)) {
            Storage::disk('public')->delete($equipment->image);
        }

        $equipment->delete();

        return redirect()->back()->with('success', 'Équipement supprimé avec succès.');
    }
}
