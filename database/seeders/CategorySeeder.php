<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $data = array(
            [
                'name' => 'Umum',
            ],
            [
                'name' => 'Anak-anak',
            ],
            [
                'name' => 'Rombongan Pelajar/Mahasiswa',
            ],
            [
                'name' => 'Rombongan Umum',
            ],
            [
                'name' => 'Rombongan Keluarga'
            ],
            [
                'name' => 'Foreigner'
            ]
        );

        foreach ($data as $d) {
            Category::create([
                'name' => $d['name'],
            ]);
        }
    }
}
