<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Inertia\Inertia;

class NewsDetailController extends Controller
{
    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)
            ->where('status', Blog::STATUS_PUBLISHED)
            ->where('published_at', '<=', now())
            ->firstOrFail();

        $relatedNews = Blog::published()
            ->where('id', '!=', $blog->id)
            ->where('category', $blog->category)
            ->take(3)
            ->get();

        $recentNews = Blog::published()
            ->where('id', '!=', $blog->id)
            ->take(4)
            ->get();

        return Inertia::render('News/Show', [
            'blog' => [
                'id' => $blog->id,
                'title' => $blog->title,
                'slug' => $blog->slug,
                'content' => $blog->content,
                'excerpt' => $blog->excerpt,
                'image_url' => $blog->image_url,
                'category' => $blog->category,
                'published_at' => $blog->published_at->format('d F Y'),
                'published_at_iso' => $blog->published_at->format('Y-m-d'),
            ],
            'relatedNews' => $relatedNews->map(fn($b) => [
                'id' => $b->id,
                'title' => $b->title,
                'slug' => $b->slug,
                'excerpt' => $b->excerpt,
                'image_url' => $b->image_url,
                'category' => $b->category,
                'published_at' => $b->published_at->format('d M Y'),
                'published_at_iso' => $b->published_at->format('Y-m-d'),
            ]),
            'recentNews' => $recentNews->map(fn($b) => [
                'id' => $b->id,
                'title' => $b->title,
                'slug' => $b->slug,
                'image_url' => $b->image_url,
                'published_at' => $b->published_at->format('d M Y'),
                'published_at_iso' => $b->published_at->format('Y-m-d'),
            ]),
        ]);
    }
}
