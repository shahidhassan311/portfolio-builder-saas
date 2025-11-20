<?php

namespace Database\Seeders;

use App\Models\Theme;
use Illuminate\Database\Seeder;

class ThemeSeeder extends Seeder
{
    public function run(): void
    {
        Theme::create([
            'name' => 'Classic Portfolio',
            'slug' => 'classic',
            'preview_image' => null,
            'is_active' => true,
        ]);

        Theme::create([
            'name' => 'Hero Banner Style',
            'slug' => 'hero',
            'preview_image' => null,
            'is_active' => true,
        ]);

        // First super beautiful portfolio theme
        Theme::create([
            'name' => 'Super Portfolio',
            'slug' => 'super-portfolio', // resources/views/themes/super-portfolio.blade.php
            'preview_image' => null,
            'is_active' => true,
        ]);

        // Second super beautiful portfolio theme (SuperPortfolioTwo)
        Theme::create([
            'name' => 'Super Portfolio Two',
            'slug' => 'superportfolitwo', // resources/views/themes/superportfolitwo.blade.php
            'preview_image' => null,
            'is_active' => true,
        ]);

        Theme::create([
            'name' => 'Professional page',
            'slug' => 'professional',
            'preview_image' => null,
            'is_active' => true,
        ]);
    }
}
