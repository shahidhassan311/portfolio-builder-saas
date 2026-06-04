<?php

namespace Database\Seeders;

use Database\Seeders\Concerns\SeedsDemoPortfolio;
use Illuminate\Database\Seeder;

class ProPlanDemoSeeder extends Seeder
{
    use SeedsDemoPortfolio;

    public function run(): void
    {
        $this->seedDemoUser([
            'name' => 'Jordan Pro',
            'username' => 'demo-pro',
            'email' => 'pro@resumizo.test',
            'plan' => 'pro',
            'custom_domain' => 'jordan.design',
            'remove_branding' => true,
            'tagline' => 'Senior Engineer · Available for clients',
        ]);

        $this->logDemoLogin('pro', 'pro@resumizo.test');
    }
}
