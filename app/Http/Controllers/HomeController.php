<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Theme;
use App\Support\Seo;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $themes = Theme::where('is_active', true)->get();
        $latestBlogs = Blog::query()
            ->published()
            ->latest('published_at')
            ->limit(3)
            ->get(['title', 'slug', 'excerpt', 'content', 'published_at', 'image']);

        $seo = Seo::forPage('home', [
            'canonical' => Seo::canonicalUrl('/'),
        ]);

        return view('home', compact('themes', 'latestBlogs', 'seo'));
    }

    public function previewTheme($id)
    {
        $theme = Theme::findOrFail($id);

        $demoUser = (object)[
            'id' => 0,
            'name' => 'John Doe',
            'username' => 'john-doe',

            'profile' => (object)[
                'profile_image'    => null,
                'tagline'          => 'Full Stack Laravel Developer',
                'bio'              => 'Professional Laravel Developer.',
                'about_title'      => 'About Me',
                'about_short'      => 'Passionate Full Stack Developer with Laravel expertise.',
                'about_long'       => 'I build scalable web applications using Laravel, PHP, MySQL, JavaScript and modern frontend technologies.',
                'contact_email'    => 'john@example.com',
                'contact_phone'    => '+1 234 567 890',
                'location'         => 'New York, USA',

                'social_facebook'  => '#',
                'social_instagram' => '#',
                'social_linkedin'  => '#',
                'social_github'    => '#',
                'social_twitter'   => '#',

                'live_link'        => '#',
            ],

            'skills' => collect([
                (object)[
                    'name'  => 'Laravel',
                    'level' => 'Expert',
                ],
                (object)[
                    'name'  => 'PHP',
                    'level' => 'Intermediate',
                ],
                (object)[
                    'name'  => 'JavaScript',
                    'level' => 'Expert',
                ],
            ]),

            'experiences' => collect([
                (object)[
                    'company'         => 'Google',
                    'role_title'      => 'Senior Laravel Developer',
                    'employment_type' => 'Full Time',
                    'location'        => 'California, USA',
                    'start_date'      => now()->subYears(3),
                    'end_date'        => null,
                    'is_current'      => true,
                    'description'     => 'Worked on enterprise Laravel applications.',
                ],
            ]),

            'educations' => collect([
                (object)[
                    'institution'    => 'Harvard University',
                    'degree'         => 'BS Computer Science',
                    'field_of_study' => 'Computer Science',
                    'location'       => 'USA',
                    'start_date'     => now()->subYears(8),
                    'end_date'       => now()->subYears(4),
                    'is_current'     => false,
                    'description'    => 'Graduated with honors.',
                ],
            ]),

            'projects' => collect([
                (object)[
                    'title'             => 'Portfolio Website',
                    'short_description' => 'Modern Laravel Portfolio Website.',
                    'project_url'       => '#',
                    'project_image'     => null,
                ],
            ]),

            'certifications' => collect([
                (object)[
                    'image'          => null,
                    'title'          => 'Laravel Certified Developer',
                    'organization'   => 'Laravel',
                    'issue_date'     => now()->subYear(),
                    'credential_url' => '#',
                    'description'    => 'Official Laravel Certification.',
                ],
            ]),

            'gallery' => collect([
                (object)[
                    'title' => 'Project Screenshot',
                    'image' => null,
                ],
            ]),

            'volunteer' => collect([
                (object)[
                    'organization_name'      => 'Red Cross',
                    'role'                   => 'Community Volunteer',
                    'location'               => 'New York, USA',
                    'description'            => 'Helping local communities through food drives and disaster relief.',
                    'start_date'             => now()->subYears(2),
                    'end_date'               => null,
                    'currently_volunteering' => true,
                ],
                (object)[
                    'organization_name'      => 'Code for Good',
                    'role'                   => 'Laravel Mentor',
                    'location'               => 'Remote',
                    'description'            => 'Mentoring junior developers in Laravel and PHP.',
                    'start_date'             => now()->subYear(),
                    'end_date'               => null,
                    'currently_volunteering' => true,
                ],
            ]),

            'achievements' => collect([
                (object)[
                    'title'            => 'Best Developer Award',
                    'organization'     => 'Tech Conference',
                    'description'      => 'Recognized for outstanding web development.',
                    'achievement_date' => now()->subMonths(8),
                ],
            ]),

            'services' => collect([
                (object)[
                    'title'       => 'Web Development',
                    'description' => 'Laravel, PHP & MySQL Development.',
                    'icon'        => '💻',
                ],
                (object)[
                    'title'       => 'API Development',
                    'description' => 'RESTful API Development using Laravel.',
                    'icon'        => '⚡',
                ],
                (object)[
                    'title'       => 'Bug Fixing',
                    'description' => 'Fixing Laravel and PHP application issues.',
                    'icon'        => '🛠️',
                ],
            ]),

            'testimonials' => collect([
                (object)[
                    'name'    => 'Jane Smith',
                    'role'    => 'CEO',
                    'company' => 'ABC Ltd',
                    'message' => 'Excellent work and highly professional developer.',
                    'rating'  => 5,
                ],
            ]),

            'goals' => collect([
                (object)[
                    'goal_text' => 'Build world-class web applications.',
                ],
                (object)[
                    'goal_text' => 'Contribute to open-source Laravel projects.',
                ],
            ]),
        ];
        return response()
            ->view('themes.'.$theme->slug, [
                'user' => $demoUser,
                'theme' => $theme,
                'isPreview' => true,
            ])
            ->header('X-Robots-Tag', 'noindex, nofollow');
    }

    public function selectTheme(Request $request, $id)
    {
        $theme = Theme::findOrFail($id);

        if (auth()->check()) {
            auth()->user()->update(['active_theme_id' => $theme->id]);
            return redirect()->route('dashboard.templates')->with('success', 'Theme selected successfully!');
        }

        return redirect()->route('register', ['theme_id' => $theme->id]);
    }

    public function contactSubmit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|in:general,support,billing,feature,bug,other',
            'message' => 'required|string|max:2000',
        ]);

        // TODO: Send email notification
        // You can use Laravel's Mail facade to send emails
        // Mail::to('support@resumizo.com')->send(new ContactFormMail($validated));

        // For now, we'll just log the contact form submission
        \Log::info('Contact form submission', $validated);

        return redirect()->route('home')->with('success', 'Thank you for contacting us! We\'ll get back to you soon.');
    }
}
