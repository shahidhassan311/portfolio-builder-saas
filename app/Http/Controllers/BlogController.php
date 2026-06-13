<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Support\BlogContent;
use App\Support\Seo;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(): View
    {
        $blogs = Blog::query()
            ->published()
            ->latest('published_at')
            ->paginate(9);

        $seo = Seo::forBlogIndexPagination($blogs->currentPage(), $blogs->hasMorePages());
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
            ->published()
            ->where('slug', $slug)
            ->with('user')
            ->firstOrFail();

        $contentHtml = BlogContent::injectHeadingIds($blog->content);
        $tableOfContents = BlogContent::tableOfContents($contentHtml);
        $faqItems = BlogContent::extractFaq($contentHtml);
        $readingTime = Seo::readingTime($contentHtml);
        $seo = Seo::forBlogPost($blog, $faqItems);

        $relatedBlogs = BlogContent::relatedPosts(
            $blog,
            Blog::query()
                ->published()
                ->where('id', '!=', $blog->id)
                ->latest('published_at')
                ->limit(12)
                ->get()
        );

        return view('blog.show', compact(
            'blog',
            'seo',
            'readingTime',
            'relatedBlogs',
            'contentHtml',
            'tableOfContents',
            'faqItems'
        ));
    }
}
