<?php

namespace Database\Seeders;

use App\Models\Information;
use Illuminate\Database\Seeder;

class InformationSeeder extends Seeder
{
    public function run()
    {
        $data = array(
            [
                'title' => 'Convention Hall',
                'description' => 'Convention Hall TB Silalahi Center
                keperluan event lomba, paduan suara, konser musik, maupun event seperti seminar, pameran,
                pengkajian baik oleh perusahaan-perusahaan, Pemerintah daerah,
                maupun untuk keperluan TB Silalahi Center sendiri.
                Ruangan ini akan difasilitasi dengan perlengkapan standar convention hall.

                Dilengkapi juga dengan sound system, pendingin ruangan, tata lampu yang beragam

                Silakan hubungi :

                Kantor Manajemen TB Silalahi Center
                Jl. DR TB Silalahi No.88 Desa Pagarbatu, Balige, Toba

                Telepon & Whatsapp : 0821 6648 7838
                Email : museumtbsilalahicenter@gmail.com',
                'image' => '1654541048.jpg',
                'user_id' => 1
            ],
            [
                'title' => 'Dojo',
                'description' => 'Gelanggang Olahraga TB Silalahi Center
                fasilitas olahraga dan
                pemuda yang dibangun untuk pengembangan bakat olahraga generasi muda
                di Kabupaten Toba khususnya di bidang olahraga bela diri Karate.

                Untuk informasi pemesanan selengkapnya

                Silakan hubungi :

                Kantor Manajemen TB Silalahi Center
                Jl. DR TB Silalahi No.88 Desa Pagarbatu, Balige, Toba

                Telepon & Whatsapp : 0821 6648 7838
                Email : museumtbsilalahicenter@gmail.com',
                'image' => '1654541078.jpg',
                'user_id' => 1
            ],
            [
                'title' => 'Kolam Renang Herti',
                'description' => 'Kolam Renang TB SIlalahi Center

                Kolam renang ini didirikan untuk pengembangan minat dan bakat masyarakat
                Batak khususnya generasi muda dalam bidang olahraga renang.
                Oleh karena itu, sampai saat ini kolam renang ini digunakan
                oleh siswa sekolah-sekolah di seputaran Kabupaten Toba Samosir
                untuk kegiatan ekstrakurikuler renang.

                Silakan hubungi :

                Kantor Manajemen TB Silalahi Center
                Jl. DR TB Silalahi No.88 Desa Pagarbatu, Balige, Toba

                Telepon & Whatsapp : 0821 6648 7838
                Email : museumtbsilalahicenter@gmail.com',
                'image' => '1654542675.jpg',
                'user_id' => 1
            ],
            [
                'title' => 'Lake Toba Hall',
                'description' => 'Lakefront Museum
                lokasi ruang semi terbuka yang ada di bagian bawah Museum Batak TB Silalahi Center.
                Bagian dari Museum karena menampilkan deretan patung arca dari budaya Batak yang mengelilingi hall ini.

                Untuk informasi pemesanan selengkapnya.

                Silakan hubungi :

                Kantor Manajemen TB Silalahi Center
                Jl. DR TB Silalahi No.88 Desa Pagarbatu, Balige, Toba

                Telepon & Whatsapp : 0821 6648 7838
                Email : museumtbsilalahicenter@gmail.com',
                'image' => '1654542703.jpg',
                'user_id' => 1
            ],
            [
                'title' => 'Sky Resto',
                'description' => 'Sky Resto
                salah satu pilihan utama dalam acara jamuan makan
                dengan kapasitas peserta terbatas dan eksklusif, dengan suasana tersendiri.
                Untuk mengadakan jamuan makan di Sky Resto, paket makanan dapat dipesan melalui Cafetaria @TB Silalahi Center dengan citarasa lokal yang terjaga.

                Untuk informasi pemesanan selengkapnya

                Silakan hubungi :

                Kantor Manajemen TB Silalahi Center
                Jl. DR TB Silalahi No.88 Desa Pagarbatu, Balige, Toba

                Telepon & Whatsapp : 0821 6648 7838
                Email : museumtbsilalahicenter@gmail.com',
                'image' => '1654542732.jpg',
                'user_id' => 1
            ],
            [
                'title' => 'Toba Hanggar',
                'description' => 'Toba Hanggar
                Hanggar semi outdoor yang terdapat di depan
                plaza Museum Batak TB Silalahi Center. tempat acara santai
                seperti talkshow, makan siang bersama, dan keperluan acara lainnya.

                Untuk informasi pemesanan selengkapnya

                Silakan hubungi :

                Kantor Manajemen TB Silalahi Center
                Jl. DR TB Silalahi No.88 Desa Pagarbatu, Balige, Toba

                Telepon & Whatsapp : 0821 6648 7838
                Email : museumtbsilalahicenter@gmail.com',
                'image' => '1654542764.PNG',
                'user_id' => 1
            ],
        );

        foreach ($data as $d) {
            Information::create([
                'title' => $d['title'],
                'description' => $d['description'],
                'image' => $d['image'],
                'user_id' => $d['user_id']
            ]);
        }
    }
}
