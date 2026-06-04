<?php

namespace Database\Seeders;

use Database\Seeders\Concerns\SeedsDemoPortfolio;
use Illuminate\Database\Seeder;

class TeamsPlanDemoSeeder extends Seeder
{
    use SeedsDemoPortfolio;

    public function run(): void
    {
        $this->seedDemoUser([
            'name' => 'Sam Teams',
            'username' => 'demo-teams',
            'email' => 'teams@resumizo.test',
            'plan' => 'teams',
            'organization_name' => 'Northbridge Bootcamp',
            'tagline' => 'Career Coach · Cohort Lead',
        ]);

        $this->logDemoLogin('teams', 'teams@resumizo.test');
    }
}
