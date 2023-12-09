<?php

namespace Database\Seeders;

use App\Models\Ticket;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    public function run()
    {
        $data = array(
            [
                'category_id' => 1,
                'description' => '',
                'price' => '15000',
                'stock' => '100',
                'cover' => '1654589080.png',
            ],
            [
                'category_id' => 2,
                'description' => 'Usia 2-6 tahun',
                'price' => '10000',
                'stock' => '100',
                'cover' => '1654589098.png',
            ],
            [
                'category_id' => 3,
                'description' => 'Jumlah minimal 30 orang
                Guru/Dosen dikenakan tarif rombongan pelajar
                Free 2 orang(tidak berlaku kelipatan)',
                'price' => '7500',
                'stock' => '100',
                'cover' => '1654589190.png',
            ],
            [
                'category_id' => 4,
                'description' => 'Jumlah minimal 30 orang
                Tidak Berlaku Free',
                'price' => '10000',
                'stock' => '100',
                'cover' => '1654589225.png',
            ],
            [
                'category_id' => 5,
                'description' => 'Jumlah minimal 15 orang
                Tidak Berlaku Free',
                'price' => '10000',
                'stock' => '100',
                'cover' => '1654589269.png',
            ],
            [
                'category_id' => 6,
                'description' => 'Untuk pengunjung asing',
                'price' => '10000',
                'stock' => '100',
                'cover' => '1654589286.png',
            ]
        );

        foreach ($data as $d) {
            Ticket::create([
                'category_id' => $d['category_id'],
                'description' => $d['description'],
                'price' => $d['price'],
                'stock' => $d['stock'],
                'cover' => $d['cover'],
            ]);
        }
    }
}
