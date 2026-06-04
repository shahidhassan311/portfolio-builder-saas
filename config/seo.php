<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Canonical site URL (no trailing slash)
    |--------------------------------------------------------------------------
    */
    'site_url' => rtrim(env('SEO_SITE_URL', env('APP_URL', 'http://localhost')), '/'),

    'force_https' => env('SEO_FORCE_HTTPS', true),

    'site_name' => env('SEO_SITE_NAME', 'Resumizo'),

    'tagline' => 'Portfolio & resume builder — no code required',

    'default_title' => 'Portfolio Builder & Resume Builder | Resumizo',

    'title_separator' => ' | ',

    'default_description' => 'Create a professional portfolio and resume website with Resumizo. Choose templates, publish a live link, and export PDF — no coding required.',

    'default_keywords' => 'portfolio builder, resume builder, resume website, online portfolio, ATS resume, resumizo',

    'default_robots' => 'index, follow',

    'twitter_handle' => env('SEO_TWITTER_HANDLE', '@resumizo'),

    'locale' => env('SEO_LOCALE', 'en_US'),

    'og_image' => env('SEO_OG_IMAGE', 'resumizo-logo.png'),

    'og_image_width' => 1200,

    'og_image_height' => 630,

    /*
    |--------------------------------------------------------------------------
    | Organization / social (used in JSON-LD)
    |--------------------------------------------------------------------------
    */
    'organization' => [
        'name' => 'Resumizo',
        'email' => env('SEO_CONTACT_EMAIL', 'support@resumizo.com'),
        'logo' => 'resumizo-logo.png',
        'same_as' => array_filter([
            env('SEO_FACEBOOK_URL'),
            env('SEO_TWITTER_URL', 'https://twitter.com/resumizo'),
            env('SEO_LINKEDIN_URL'),
        ]),
    ],

    /*
    |--------------------------------------------------------------------------
    | Include aggregateRating in SoftwareApplication schema (off by default)
    |--------------------------------------------------------------------------
    */
    'include_aggregate_rating' => env('SEO_INCLUDE_AGGREGATE_RATING', false),

    'aggregate_rating' => [
        'ratingValue' => '4.8',
        'reviewCount' => '1250',
        'bestRating' => '5',
        'worstRating' => '1',
    ],

    /*
    |--------------------------------------------------------------------------
    | Static page metadata (keyed by route name or page id)
    |--------------------------------------------------------------------------
    */
    'pages' => [
        'home' => [
            'title' => 'Portfolio Builder & Resume Builder — Create Your Resume Website',
            'description' => 'Create your professional portfolio and resume website effortlessly with Resumizo. Build online resumes, showcase your work, and get hired. No coding required.',
            'keywords' => 'portfolio builder, resume builder, resume website, online portfolio, professional portfolio, resumizo',
            'og_type' => 'website',
            'schemas' => ['organization', 'website', 'software', 'faq', 'reviews'],
        ],
        'blog.index' => [
            'title' => 'Blog — Portfolio & Resume Tips',
            'description' => 'Read insights, tutorials, and hiring tips from Resumizo. Learn how to build portfolios and resumes that get interviews.',
            'keywords' => 'portfolio builder blog, resume tips, job search blog, resumizo',
            'og_type' => 'website',
            'schemas' => ['organization', 'breadcrumb'],
        ],
        'privacy' => [
            'title' => 'Privacy Policy',
            'description' => 'Learn how Resumizo collects, uses, and protects your personal information.',
            'keywords' => 'resumizo privacy policy, data protection',
            'robots' => 'index, follow',
            'schemas' => ['organization', 'breadcrumb'],
        ],
        'terms' => [
            'title' => 'Terms & Conditions',
            'description' => 'Terms and conditions for using the Resumizo portfolio and resume builder platform.',
            'keywords' => 'resumizo terms, terms of service',
            'robots' => 'index, follow',
            'schemas' => ['organization', 'breadcrumb'],
        ],
        'login' => [
            'title' => 'Log In',
            'description' => 'Log in to your Resumizo account to edit your portfolio, switch templates, and export your resume PDF.',
            'robots' => 'noindex, follow',
            'schemas' => [],
        ],
        'register' => [
            'title' => 'Create Free Account',
            'description' => 'Sign up free on Resumizo and launch your portfolio and resume website in minutes.',
            'robots' => 'noindex, follow',
            'schemas' => [],
        ],
        'password.request' => [
            'title' => 'Forgot Password',
            'robots' => 'noindex, nofollow',
            'schemas' => [],
        ],
        'password.reset' => [
            'title' => 'Reset Password',
            'robots' => 'noindex, nofollow',
            'schemas' => [],
        ],
        'verification.notice' => [
            'title' => 'Verify Email',
            'robots' => 'noindex, nofollow',
            'schemas' => [],
        ],
        'password.confirm' => [
            'title' => 'Confirm Password',
            'robots' => 'noindex, nofollow',
            'schemas' => [],
        ],
        'dashboard' => [
            'title' => 'Dashboard',
            'robots' => 'noindex, nofollow',
            'schemas' => [],
        ],
        'profile.edit' => [
            'title' => 'Account Settings',
            'robots' => 'noindex, nofollow',
            'schemas' => [],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Homepage FAQ (FAQPage schema + on-page content)
    |--------------------------------------------------------------------------
    */
    'home_reviews' => [
        [
            'author' => 'Aisha Khan',
            'reviewBody' => 'I had a portfolio live in under 20 minutes. The PDF export saved me when HR asked for a resume attachment.',
            'ratingValue' => 5,
        ],
        [
            'author' => 'Rahul Mehta',
            'reviewBody' => 'As a fresher I did not know where to start. The templates made me look professional without hiring anyone.',
            'ratingValue' => 5,
        ],
        [
            'author' => 'Sofia Lopez',
            'reviewBody' => 'Switching themes without losing my projects was huge. I tested two looks before sending applications.',
            'ratingValue' => 5,
        ],
    ],

    'home_faq' => [
        [
            'question' => 'Is Resumizo free to use?',
            'answer' => 'Yes. You can create a portfolio, publish a live link, and export a PDF on the free plan. Pro features such as custom domains are coming soon.',
        ],
        [
            'question' => 'Do I need coding skills to build a portfolio?',
            'answer' => 'No. Pick a template, fill in your experience and projects, and publish. Resumizo handles layout, typography, and responsive design.',
        ],
        [
            'question' => 'Can I export my resume as a PDF?',
            'answer' => 'Yes. Every theme includes one-click PDF export so recruiters receive a polished attachment that matches your live portfolio.',
        ],
        [
            'question' => 'Are Resumizo templates ATS-friendly?',
            'answer' => 'Our templates use clear headings and readable structure that work well for applicant tracking systems. For dedicated ATS guidance, see our ATS resume guide.',
        ],
        [
            'question' => 'Can I change templates after publishing?',
            'answer' => 'Yes. Switch themes anytime from your dashboard without re-entering your content.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Programmatic SEO hubs & landing pages
    |--------------------------------------------------------------------------
    */
    'programmatic_hubs' => [
        'resume-templates' => [
            'title' => 'Resume Templates — Professional Designs',
            'description' => 'Browse free resume and portfolio templates. Modern layouts for developers, designers, and job seekers.',
            'keywords' => 'resume templates, portfolio templates, free resume template, resumizo',
            'h1' => 'Resume & portfolio templates',
            'intro' => 'Choose a recruiter-friendly template, customize your story, and publish a live portfolio with PDF export.',
        ],
        'resume-examples' => [
            'title' => 'Resume Examples by Role & Experience',
            'description' => 'Resume examples for software engineers, designers, graduates, and more. Learn what to include and how to structure your story.',
            'keywords' => 'resume examples, resume samples, cv examples',
            'h1' => 'Resume examples',
            'intro' => 'See how strong resumes are structured for common roles — then build yours in minutes with Resumizo.',
        ],
        'ats-resume' => [
            'title' => 'ATS Resume Guide — Beat Applicant Tracking Systems',
            'description' => 'Learn how to format an ATS-friendly resume: keywords, headings, file types, and templates that parse correctly.',
            'keywords' => 'ATS resume, applicant tracking system resume, ATS friendly resume',
            'h1' => 'ATS resume guide',
            'intro' => 'Applicant tracking systems scan structure before humans read your story. Follow these rules to stay visible in the pipeline.',
        ],
        'cover-letters' => [
            'title' => 'Cover Letter Templates & Examples',
            'description' => 'Cover letter examples and tips paired with your portfolio link. Stand out when applying to jobs.',
            'keywords' => 'cover letter template, cover letter examples, job application cover letter',
            'h1' => 'Cover letters',
            'intro' => 'Pair a concise cover letter with your live portfolio URL so recruiters can skim your work faster than attachments alone.',
        ],
        'job-resumes' => [
            'title' => 'Job-Specific Resumes — Tailor by Role',
            'description' => 'Job-specific resume guides for software engineers, product managers, UX designers, data analysts, and more.',
            'keywords' => 'job specific resume, role based resume, resume by job title',
            'h1' => 'Job-specific resumes',
            'intro' => 'Tailor keywords, projects, and skills to the role you want — then publish with a template built for that career path.',
        ],
    ],

    'programmatic_pages' => [
        'resume-templates' => [
            'modern-resume-template' => [
                'title' => 'Modern Resume Template',
                'description' => 'A clean modern resume template with bold typography, skills grid, and PDF export. Ideal for tech and creative roles.',
                'keywords' => 'modern resume template, contemporary cv template',
                'h1' => 'Modern resume template',
            ],
            'professional-resume-template' => [
                'title' => 'Professional Resume Template',
                'description' => 'Corporate-friendly professional resume template with clear sections for experience, education, and skills.',
                'keywords' => 'professional resume template, corporate cv template',
                'h1' => 'Professional resume template',
            ],
            'creative-portfolio-template' => [
                'title' => 'Creative Portfolio Template',
                'description' => 'Showcase projects and case studies with a creative portfolio template built for designers and freelancers.',
                'keywords' => 'creative portfolio template, designer portfolio',
                'h1' => 'Creative portfolio template',
            ],
        ],
        'resume-examples' => [
            'software-engineer-resume-example' => [
                'title' => 'Software Engineer Resume Example',
                'description' => 'Software engineer resume example: projects, stack, impact metrics, and how to structure experience for tech hiring.',
                'keywords' => 'software engineer resume example, developer resume sample',
                'h1' => 'Software engineer resume example',
            ],
            'ux-designer-resume-example' => [
                'title' => 'UX Designer Resume Example',
                'description' => 'UX designer resume example highlighting case studies, research skills, and portfolio links recruiters expect.',
                'keywords' => 'ux designer resume example, product designer cv',
                'h1' => 'UX designer resume example',
            ],
            'entry-level-resume-example' => [
                'title' => 'Entry-Level Resume Example',
                'description' => 'Entry-level resume example for graduates and career changers: education, internships, and projects that compensate for limited experience.',
                'keywords' => 'entry level resume example, graduate resume sample',
                'h1' => 'Entry-level resume example',
            ],
        ],
        'ats-resume' => [
            'ats-friendly-resume-format' => [
                'title' => 'ATS-Friendly Resume Format',
                'description' => 'Step-by-step ATS-friendly resume format: standard headings, keyword placement, and fonts that parse reliably.',
                'keywords' => 'ATS friendly resume format, ATS resume layout',
                'h1' => 'ATS-friendly resume format',
            ],
            'resume-keywords-for-ats' => [
                'title' => 'Resume Keywords for ATS',
                'description' => 'How to research and place resume keywords for ATS without keyword stuffing — aligned to job descriptions.',
                'keywords' => 'resume keywords ATS, keyword optimization resume',
                'h1' => 'Resume keywords for ATS',
            ],
        ],
        'cover-letters' => [
            'software-engineer-cover-letter' => [
                'title' => 'Software Engineer Cover Letter Example',
                'description' => 'Software engineer cover letter example with portfolio link, impact bullets, and concise structure for tech applications.',
                'keywords' => 'software engineer cover letter, developer cover letter example',
                'h1' => 'Software engineer cover letter',
            ],
            'general-cover-letter-template' => [
                'title' => 'General Cover Letter Template',
                'description' => 'A flexible cover letter template you can adapt to any role — paired with your Resumizo portfolio URL.',
                'keywords' => 'cover letter template, general cover letter',
                'h1' => 'General cover letter template',
            ],
        ],
        'job-resumes' => [
            'software-engineer-resume' => [
                'title' => 'Software Engineer Resume Guide',
                'description' => 'Build a software engineer resume with the right sections, tech keywords, and project proof for engineering interviews.',
                'keywords' => 'software engineer resume, developer resume guide',
                'h1' => 'Software engineer resume',
            ],
            'product-manager-resume' => [
                'title' => 'Product Manager Resume Guide',
                'description' => 'Product manager resume guide: outcomes, roadmaps, cross-functional impact, and metrics recruiters scan first.',
                'keywords' => 'product manager resume, PM resume guide',
                'h1' => 'Product manager resume',
            ],
            'data-analyst-resume' => [
                'title' => 'Data Analyst Resume Guide',
                'description' => 'Data analyst resume guide covering SQL, dashboards, experimentation, and storytelling with data.',
                'keywords' => 'data analyst resume, analytics resume guide',
                'h1' => 'Data analyst resume',
            ],
            'marketing-manager-resume' => [
                'title' => 'Marketing Manager Resume Guide',
                'description' => 'Marketing manager resume guide: campaigns, growth metrics, channel expertise, and brand outcomes.',
                'keywords' => 'marketing manager resume, marketing resume guide',
                'h1' => 'Marketing manager resume',
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Robots.txt disallow paths
    |--------------------------------------------------------------------------
    */
    'robots_disallow' => [
        '/admin/',
        '/dashboard/',
        '/profile/',
        '/login',
        '/register',
        '/forgot-password',
        '/reset-password',
        '/verify-email',
        '/confirm-password',
        '/preview/',
        '/*/pdf',
    ],

];
