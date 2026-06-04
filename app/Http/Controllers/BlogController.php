<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Support\Seo;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(): View
    {
        $blogs = Blog::query()
            ->where('status', 'published')
            ->latest('published_at')
            ->paginate(9);

        $seo = Seo::forBlogIndex();
        $seo['blog_posts'] = $blogs->map(fn (Blog $blog) => [
            '@type' => 'BlogPosting',
            'headline' => $blog->title,
            'url' => Seo::canonicalUrl('/blog/'.$blog->slug),
            'datePublished' => $blog->published_at?->toIso8601String(),
        ])->values()->all();

        return view('blog.index', compact('blogs', 'seo'));
    }

    public function show(string $slug): View
    {
        $blog = Blog::query()
            ->where('status', 'published')
            ->where('slug', $slug)
            ->with('user')
            ->firstOrFail();

        $readingTime = Seo::readingTime($blog->content);
        $seo = Seo::forBlogPost($blog);

        $relatedBlogs = Blog::query()
            ->where('status', 'published')
            ->where('id', '!=', $blog->id)
            ->latest('published_at')
            ->limit(3)
            ->get();

        return view('blog.show', compact('blog', 'seo', 'readingTime', 'relatedBlogs'));
    }
}
