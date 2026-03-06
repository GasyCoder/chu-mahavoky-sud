<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class PartnerAdminController extends Controller
{
    public function index()
    {
        $partners = Partner::orderBy('order')->get();
        return Inertia::render('Admin/Partners', [
            'partners' => $partners
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'required|image|max:2048',
            'link' => 'nullable|url|max:555',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('partners', 'public');
        }

        Partner::create($validated);

        return redirect()->back()->with('success', 'Partenaire ajouté avec succès.');
    }

    public function update(Request $request, Partner $partner)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|max:2048',
            'link' => 'nullable|url|max:555',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ];

        $validated = $request->validate($rules);

        // Retirer le logo des données validées pour éviter d'écraser par null
        unset($validated['logo']);

        if ($request->hasFile('logo')) {
            if ($partner->logo) {
                Storage::disk('public')->delete($partner->logo);
            }
            $validated['logo'] = $request->file('logo')->store('partners', 'public');
        }

        $partner->update($validated);

        return redirect()->back()->with('success', 'Partenaire mis à jour.');
    }

    public function destroy(Partner $partner)
    {
        if ($partner->logo) {
            Storage::disk('public')->delete($partner->logo);
        }
        $partner->delete();

        return redirect()->back()->with('success', 'Partenaire supprimé.');
    }
}
