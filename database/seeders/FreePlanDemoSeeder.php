<?php

namespace Database\Seeders;

use Database\Seeders\Concerns\SeedsDemoPortfolio;
use Illuminate\Database\Seeder;

class FreePlanDemoSeeder extends Seeder
{
    use SeedsDemoPortfolio;

    public function run(): void
    {
        $this->seedDemoUser([
            'name' => 'Alex Free',
            'username' => 'demo-free',
            'email' => 'free@resumizo.test',
            'plan' => 'free',
            'tagline' => 'Junior Developer · Open to work',
        ]);

        $this->logDemoLogin('free', 'free@resumizo.test');
    }
}
