<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use App\Models\Theme;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index()
    {
        // Get published blogs
        $blogs = Blog::where('status', 'published')
            ->orderBy('updated_at', 'desc')
            ->get();

        // Get users with active themes (who have portfolios)
        $users = User::whereNotNull('active_theme_id')
            ->orderBy('updated_at', 'desc')
            ->get();

        // Get all themes
        $themes = Theme::orderBy('updated_at', 'desc')
            ->get();

        $content = view('sitemap', [
            'blogs' => $blogs,
            'users' => $users,
            'themes' => $themes,
        ])->render();

        return response($content, 200)
            ->header('Content-Type', 'text/xml');
    }
}
