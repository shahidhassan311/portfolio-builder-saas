<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = \App\Models\Blog::where('status', 'published')->latest('published_at')->paginate(9);
        return view('blog.index', compact('blogs'));
    }

    public function show($slug)
    {
        $blog = \App\Models\Blog::where('status', 'published')->where('slug', $slug)->firstOrFail();
        return view('blog.show', compact('blog'));
    }
}
