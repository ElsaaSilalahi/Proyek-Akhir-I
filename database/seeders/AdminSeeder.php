<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $data = array(
            [
                'name' => 'Admin',
                'fullname' => 'Administrator',
                'email' => 'admin@gmail.com',
                'phone' => '0',
                'password' => Hash::make('password'),
                'role_id' => 1,
            ]
        );
        foreach ($data as $d) {
            User::create([
                'name' => $d['name'],
                'fullname' => $d['fullname'],
                'email' => $d['email'],
                'phone' => $d['phone'],
                'password' => $d['password'],
                'role_id' => $d['role_id'],
            ]);
        }
    }
}
