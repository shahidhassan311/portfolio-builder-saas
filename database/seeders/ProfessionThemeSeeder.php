<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfessionThemeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('profession_theme')->truncate();

        DB::table('profession_theme')->insert([

            // Software Developer
            ['profession_id' => 1, 'theme_id' => 1],
            ['profession_id' => 1, 'theme_id' => 2],
            ['profession_id' => 1, 'theme_id' => 3],
            ['profession_id' => 1, 'theme_id' => 4],

            // Graphic Designer
            ['profession_id' => 2, 'theme_id' => 6],
            ['profession_id' => 2, 'theme_id' => 8],
            ['profession_id' => 2, 'theme_id' => 9],

            // UI/UX Designer
            ['profession_id' => 3, 'theme_id' => 8],
            ['profession_id' => 3, 'theme_id' => 9],

            // Digital Marketing
            ['profession_id' => 4, 'theme_id' => 7],

            // Content Writer
            ['profession_id' => 5, 'theme_id' => 10],

            // Data Analyst
            ['profession_id' => 6, 'theme_id' => 10],

            // Project Manager
            ['profession_id' => 7, 'theme_id' => 5],

            // Accountant
            ['profession_id' => 8, 'theme_id' => 5],

            // Teacher
            ['profession_id' => 9, 'theme_id' => 5],

            // Sales & Marketing
            ['profession_id' => 10, 'theme_id' => 7],
        ]);
    }
}
