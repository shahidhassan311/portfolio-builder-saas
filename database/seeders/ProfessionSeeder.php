<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profession;

class ProfessionSeeder extends Seeder
{
    public function run(): void
    {
        $professions = [
            [
                'name' => 'Software Developer',
                'icon' => 'code',
            ],
            [
                'name' => 'Graphic Designer',
                'icon' => 'pen-tool',
            ],
            [
                'name' => 'UI/UX Designer',
                'icon' => 'palette',
            ],
            [
                'name' => 'Digital Marketing',
                'icon' => 'megaphone',
            ],
            [
                'name' => 'Content Writer',
                'icon' => 'pencil',
            ],
            [
                'name' => 'Data Analyst',
                'icon' => 'bar-chart-3',
            ],
            [
                'name' => 'Project Manager',
                'icon' => 'briefcase',
            ],
            [
                'name' => 'Accountant',
                'icon' => 'calculator',
            ],
            [
                'name' => 'Teacher',
                'icon' => 'book-open',
            ],
            [
                'name' => 'Sales & Marketing',
                'icon' => 'chart-column',
            ],
        ];

        foreach ($professions as $profession) {
            Profession::updateOrCreate(
                ['name' => $profession['name']],
                [
                    'icon' => $profession['icon'],
                ]
            );
        }
    }
}
