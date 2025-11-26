<?php

namespace Database\Seeders;

use App\Models\Theme;
use Illuminate\Database\Seeder;

class ThemeSeeder extends Seeder
{
    public function run(): void
    {
        $themes = [
            [
                'name' => 'Classic Portfolio',
                'slug' => 'classic',
                'preview_image' => null,
                'is_active' => true,
            ],
            [
                'name' => 'Hero Banner Style',
                'slug' => 'hero',
                'preview_image' => null,
                'is_active' => true,
            ],
            [
                'name' => 'Super Portfolio',
                'slug' => 'super-portfolio',
                'preview_image' => null,
                'is_active' => true,
            ],
            [
                'name' => 'Super Portfolio Two',
                'slug' => 'superportfolitwo',
                'preview_image' => null,
                'is_active' => true,
            ],
            [
                'name' => 'Professional page',
                'slug' => 'professional',
                'preview_image' => null,
                'is_active' => true,
            ],
            [
                'name' => 'FreeLance Portfolio',
                'slug' => 'freelancer',
                'preview_image' => null,
                'is_active' => true,
            ],
        ];

        foreach ($themes as $theme) {
            Theme::firstOrCreate(
                ['slug' => $theme['slug']], // check uniqueness
                $theme                        // fill the rest if not exists
            );
        }
    }
}
