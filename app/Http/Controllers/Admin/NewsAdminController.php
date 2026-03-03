<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class NewsAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Blog::query();

        // Application des filtres
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('excerpt', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->category) {
            $query->where('category', $request->category);
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        // Tri
        $sortField = $request->input('sortField', 'created_at');
        $sortDirection = $request->input('sortDirection', 'desc');
        $query->orderBy($sortField, $sortDirection);

        $blogs = $query->paginate($request->input('perPage', 10))->withQueryString();

        return Inertia::render('Admin/News/Index', [
            'blogs' => $blogs,
            'categories' => Blog::categories(),
            'statuses' => Blog::statuses(),
            'filters' => $request->only(['search', 'category', 'status', 'sortField', 'sortDirection', 'perPage']),
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|min:3|max:255',
            'slug' => 'nullable|alpha_dash|max:255',
            'content' => 'required|min:10',
            'excerpt' => 'nullable|max:500',
            'category' => 'required|string',
            'is_featured' => 'boolean',
            'status' => 'required|string',
            'published_at' => 'nullable|date',
            'image' => 'nullable|image|max:2048',
        ];

        // Règle d'unicité pour le slug
        if ($request->id) {
            $rules['slug'] .= '|unique:blogs,slug,' . $request->id;
        } else {
            $rules['slug'] .= '|unique:blogs,slug';
        }

        $validated = $request->validate($rules);

        $data = [
            'title' => $validated['title'],
            'slug' => $validated['slug'] ?: null,
            'content' => $validated['content'],
            'excerpt' => $validated['excerpt'],
            'category' => $validated['category'],
            'is_featured' => $validated['is_featured'] ?? false,
            'status' => $validated['status'],
            'published_at' => $validated['status'] == Blog::STATUS_PUBLISHED ? ($validated['published_at'] ?? now()) : $validated['published_at'],
        ];

        $blog = $request->id ? Blog::findOrFail($request->id) : new Blog();

        if ($request->hasFile('image')) {
            if ($blog->image && Storage::disk('public')->exists($blog->image)) {
                Storage::disk('public')->delete($blog->image);
            }
            $data['image'] = $request->file('image')->store('blogs', 'public');
        }

        if ($request->id) {
            $blog->update($data);
            $message = 'Article mis à jour avec succès.';
        } else {
            $blog = Blog::create($data);
            $message = 'Article créé avec succès.';
        }

        return redirect()->route('admin.news')->with('success', $message);
    }

    public function destroy(Blog $news)
    {
        if ($news->image && Storage::disk('public')->exists($news->image)) {
            Storage::disk('public')->delete($news->image);
        }

        $news->delete();

        return redirect()->route('admin.news')->with('success', 'Article supprimé avec succès.');
    }
}
