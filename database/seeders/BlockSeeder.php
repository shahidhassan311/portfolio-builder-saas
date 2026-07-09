<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BlockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('blocks')->delete();

        $blocks = [
            'Profile',
            'About',
            'Education',
            'Skills',
            'Experience',
            'Projects',
            'Certifications',
            'Achievements',
            'Volunteer',
            'Gallery',
            'Testimonials',
            'Services',
            'Contact',
        ];

        $data = [];

        foreach ($blocks as $block) {
            $data[] = [
                'name'       => $block,
                'slug'       => Str::slug($block),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('blocks')->insert($data);
    }
}
