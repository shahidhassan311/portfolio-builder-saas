<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $themes = Theme::where('is_active', true)->get();

        return view('home', compact('themes'));
    }

    public function previewTheme($id)
    {
        $theme = Theme::findOrFail($id);

        // Return demo data for preview
        $demoUser = (object)[
            'id' => 0,
            'name' => 'John Doe',
            'username' => 'demo',
            'profile' => (object)[
                'profile_image' => null,
                'tagline' => 'Web Developer',
                'about_title' => 'About Me',
                'about_short' => 'I am a passionate web developer with 5+ years of experience building modern web applications.',
                'about_long' => 'I specialize in PHP, Laravel, JavaScript, and modern frontend frameworks. I love creating beautiful and functional web experiences.',
                'contact_email' => 'john@example.com',
                'location' => 'New York, USA',
                'social_facebook' => 'https://facebook.com',
                'social_linkedin' => 'https://linkedin.com',
                'social_github' => 'https://github.com',
                'social_instagram' => 'https://instagram.com',
                'social_twitter' => 'https://twitter.com',
            ],
            'skills' => collect([
                (object)['name' => 'PHP', 'level' => 'Expert'],
                (object)['name' => 'Laravel', 'level' => 'Expert'],
                (object)['name' => 'JavaScript', 'level' => 'Intermediate'],
                (object)['name' => 'Vue.js', 'level' => 'Intermediate'],
            ]),
            'projects' => collect([
                (object)[
                    'title' => 'E-Commerce Platform',
                    'short_description' => 'A full-featured e-commerce platform built with Laravel and Vue.js',
                    'project_url' => 'https://example.com',
                    'project_image' => null,
                ],
                (object)[
                    'title' => 'Portfolio Website',
                    'short_description' => 'A modern portfolio website with custom CMS',
                    'project_url' => 'https://example.com',
                    'project_image' => null,
                ],
            ]),
            'goals' => collect([
                (object)['goal_text' => 'Build 10 more successful projects'],
                (object)['goal_text' => 'Learn new technologies and frameworks'],
                (object)['goal_text' => 'Contribute to open source projects'],
            ]),
        ];

        return view('themes.' . $theme->slug, ['user' => $demoUser, 'theme' => $theme, 'isPreview' => true]);
    }

    public function selectTheme(Request $request, $id)
    {
        $theme = Theme::findOrFail($id);

        if (auth()->check()) {
            auth()->user()->update(['active_theme_id' => $theme->id]);
            return redirect()->route('dashboard')->with('success', 'Theme selected successfully!');
        }

        return redirect()->route('register', ['theme_id' => $theme->id]);
    }
}
