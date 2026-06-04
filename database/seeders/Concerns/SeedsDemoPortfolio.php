<?php

namespace Database\Seeders\Concerns;

use App\Models\Education;
use App\Models\Experience;
use App\Models\Theme;
use App\Models\User;
use App\Models\UserGoal;
use App\Models\UserProfile;
use App\Models\UserProject;
use App\Models\UserSkill;
use Illuminate\Support\Facades\Hash;

trait SeedsDemoPortfolio
{
    protected function demoPassword(): string
    {
        return 'password';
    }

    protected function seedDemoUser(array $userAttrs): User
    {
        $theme = Theme::where('is_active', true)->first();

        $user = User::updateOrCreate(
            ['email' => $userAttrs['email']],
            [
                'name' => $userAttrs['name'],
                'username' => $userAttrs['username'],
                'password' => Hash::make($this->demoPassword()),
                'is_admin' => $userAttrs['is_admin'] ?? false,
                'plan' => $userAttrs['plan'],
                'custom_domain' => $userAttrs['custom_domain'] ?? null,
                'remove_branding' => $userAttrs['remove_branding'] ?? false,
                'organization_name' => $userAttrs['organization_name'] ?? null,
                'active_theme_id' => $theme?->id,
            ]
        );

        UserProfile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'tagline' => $userAttrs['tagline'] ?? 'Product Designer · Open to work',
                'about_title' => 'About Me',
                'about_short' => 'Designer and developer building hire-ready portfolios. This is demo content for the ' . strtoupper($userAttrs['plan']) . ' plan UI.',
                'about_long' => 'Use this account to preview how Resumizo looks for each pricing tier. Switch between free@, pro@, and teams@ demo logins.',
                'location' => 'San Francisco, USA',
                'contact_email' => $user->email,
                'contact_phone' => '+1 555 0100',
                'social_linkedin' => 'https://linkedin.com/in/demo',
                'social_github' => 'https://github.com/demo',
            ]
        );

        $user->skills()->delete();
        foreach (
            [
                ['name' => 'Figma', 'level' => 'Expert', 'sort_order' => 1],
                ['name' => 'Laravel', 'level' => 'Advanced', 'sort_order' => 2],
                ['name' => 'UX Research', 'level' => 'Intermediate', 'sort_order' => 3],
            ] as $skill
        ) {
            UserSkill::create(['user_id' => $user->id, ...$skill]);
        }

        $user->projects()->delete();
        UserProject::create([
            'user_id' => $user->id,
            'title' => 'SaaS Dashboard',
            'short_description' => 'End-to-end product design for a B2B analytics tool.',
            'project_url' => 'https://example.com',
            'sort_order' => 1,
        ]);
        UserProject::create([
            'user_id' => $user->id,
            'title' => 'Portfolio System',
            'short_description' => 'Design system and templates for career portfolios.',
            'project_url' => 'https://example.com',
            'sort_order' => 2,
        ]);

        $user->experiences()->delete();
        Experience::create([
            'user_id' => $user->id,
            'company' => 'Resumizo',
            'role_title' => 'Lead Product Designer',
            'employment_type' => 'Full-time',
            'location' => 'Remote',
            'start_date' => '2022-01-01',
            'is_current' => true,
            'description' => 'Shipped portfolio builder UX across Free, Pro, and Teams plans.',
            'sort_order' => 1,
        ]);

        $user->educations()->delete();
        Education::create([
            'user_id' => $user->id,
            'institution' => 'State University',
            'degree' => 'BS Design',
            'field_of_study' => 'Interaction Design',
            'location' => 'USA',
            'start_date' => '2016-09-01',
            'end_date' => '2020-05-01',
            'sort_order' => 1,
        ]);

        $user->goals()->delete();
        UserGoal::create([
            'user_id' => $user->id,
            'goal_text' => 'Land a senior product role in 2026',
            'sort_order' => 1,
        ]);

        return $user->fresh();
    }

    protected function logDemoLogin(string $plan, string $email): void
    {
        $this->command?->info(sprintf(
            '  [%s] %s / password: %s',
            strtoupper($plan),
            $email,
            $this->demoPassword()
        ));
    }
}
