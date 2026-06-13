<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Support\Seo;
use Illuminate\Http\Response;

class BlogFeedController extends Controller
{
    public function __invoke(): Response
    {
        $blogs = Blog::query()
            ->published()
            ->latest('published_at')
            ->limit(20)
            ->get();

        $content = view('blog.feed', [
            'blogs' => $blogs,
            'siteUrl' => Seo::siteUrl(),
            'siteName' => config('seo.site_name'),
        ])->render();

        return response('<?xml version="1.0" encoding="UTF-8"?>'."\n".$content, 200, [
            'Content-Type' => 'application/rss+xml; charset=UTF-8',
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }
}
