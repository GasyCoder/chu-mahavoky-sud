<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class BlogCategoryController extends Controller
{
    public function index()
    {
        $categories = BlogCategory::ordered()->withCount('blogs')->get();

        return Inertia::render('Admin/News/Categories', [
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'color' => 'required|string|max:30',
            'icon' => 'nullable|string|max:50',
            'order' => 'nullable|integer',
            'active' => 'boolean',
        ]);

        $slug = Str::slug($validated['name']);

        $category = $request->id ? BlogCategory::findOrFail($request->id) : new BlogCategory();

        if (!$request->id && BlogCategory::where('slug', $slug)->exists()) {
            $slug .= '-' . time();
        }

        $data = [
            'name' => $validated['name'],
            'slug' => $request->id ? $category->slug : $slug,
            'color' => $validated['color'],
            'icon' => $validated['icon'],
            'order' => $validated['order'] ?? 0,
            'active' => $validated['active'] ?? true,
        ];

        if ($request->id) {
            // Update the old category name in blogs
            if ($category->name !== $validated['name']) {
                $category->blogs()->update(['category' => $validated['name']]);
            }
            $category->update($data);
            $message = 'Catégorie mise à jour avec succès.';
        } else {
            BlogCategory::create($data);
            $message = 'Catégorie créée avec succès.';
        }

        return redirect()->back()->with('success', $message);
    }

    public function destroy(BlogCategory $category)
    {
        if ($category->blogs()->count() > 0) {
            return redirect()->back()->with('error', 'Impossible de supprimer cette catégorie car elle contient des articles.');
        }

        $category->delete();

        return redirect()->back()->with('success', 'Catégorie supprimée avec succès.');
    }
}
