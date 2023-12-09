<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $data = array(
            [
                'name' => 'Administrator',
            ],
            [
                'name' => 'Customer',
            ],
        );
        foreach ($data as $d) {
            \App\Models\Role::create([
                'name' => $d['name'],
            ]);
        }
    }
}
