<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Support\Seo;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $blogs = Blog::query()
            ->where('status', 'published')
            ->orderByDesc('updated_at')
            ->get();

        $content = view('sitemap', [
            'staticEntries' => Seo::sitemapEntries(),
            'blogs' => $blogs,
        ])->render();

        return response($content, 200, [
            'Content-Type' => 'application/xml; charset=UTF-8',
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }
}
