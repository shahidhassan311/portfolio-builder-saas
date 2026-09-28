<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PlanDemoUsersSeeder extends Seeder
{
    public function run(): void
    {
        $this->command?->info('Seeding plan demo users (password for all: password)');
        $this->command?->newLine();

        $this->call([
            FreePlanDemoSeeder::class,
            ProPlanDemoSeeder::class,
            TeamsPlanDemoSeeder::class,
        ]);

        $this->command?->newLine();
        $this->command?->warn('Log in at /login to preview each plan UI.');
    }
}
