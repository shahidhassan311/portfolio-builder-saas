<?php

namespace Database\Seeders;

use App\Models\Profession;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfessionBlocksSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        $defaultBlocks = [
            'profile',
            'about',
            'education',
            'skills',
            'experience',
            'projects',
        ];

        // old mapping remove
        DB::table('profession_blocks')->delete();

        foreach (Profession::all() as $profession) {

            $order = 1;

            foreach ($defaultBlocks as $slug) {

                $block = DB::table('blocks')
                    ->where('slug', $slug)
                    ->first();

                if (!$block) {
                    continue;
                }

                DB::table('profession_blocks')->insert([
                    'profession_id' => $profession->id,
                    'block_id'      => $block->id,
                    'is_default'    => true,
                    'display_order' => $order++,
                    'created_at'    => $now,
                    'updated_at'    => $now,
                ]);
            }
        }
    }
}
