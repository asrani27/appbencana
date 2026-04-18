<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KorbanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // Bencana Lombok (bencana_id = 1)
            [
                'bencana_id' => 1,
                'nama' => 'Ahmad Fauzi',
                'jenis_kelamin' => 'L',
                'umur' => 35,
                'status_identitas' => 'dikenal',
                'lokasi_ditemukan' => 'Desa Santong, Lombok Utara',
                'tanggal_ditemukan' => '2024-01-15',
                'kondisi_awal' => 'Luka ringan di kepala',
                'foto' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'bencana_id' => 1,
                'nama' => 'Siti Aminah',
                'jenis_kelamin' => 'P',
                'umur' => 28,
                'status_identitas' => 'dikenal',
                'lokasi_ditemukan' => 'Desa Santong, Lombok Utara',
                'tanggal_ditemukan' => '2024-01-15',
                'kondisi_awal' => 'Patah tulang kaki kanan',
                'foto' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Bencana Jakarta (bencana_id = 2)
            [
                'bencana_id' => 2,
                'nama' => 'Budi Santoso',
                'jenis_kelamin' => 'L',
                'umur' => 45,
                'status_identitas' => 'dikenal',
                'lokasi_ditemukan' => 'Jl. Lebak Bulus, Jakarta Selatan',
                'tanggal_ditemukan' => '2024-02-20',
                'kondisi_awal' => 'Hipothermia ringan',
                'foto' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'bencana_id' => 2,
                'nama' => null,
                'jenis_kelamin' => 'P',
                'umur' => null,
                'status_identitas' => 'tidak_dikenal',
                'lokasi_ditemukan' => 'Jl. TB Simatupang, Jakarta Selatan',
                'tanggal_ditemukan' => '2024-02-20',
                'kondisi_awal' => 'Luka-luka di tubuh',
                'foto' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Bencana Cianjur (bencana_id = 3)
            [
                'bencana_id' => 3,
                'nama' => 'Rina Marlina',
                'jenis_kelamin' => 'P',
                'umur' => 12,
                'status_identitas' => 'dikenal',
                'lokasi_ditemukan' => 'Desa Cijantibunik, Cianjur',
                'tanggal_ditemukan' => '2024-03-10',
                'kondisi_awal' => 'Luka serius di kepala',
                'foto' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'bencana_id' => 3,
                'nama' => 'Ujang Sutisna',
                'jenis_kelamin' => 'L',
                'umur' => 55,
                'status_identitas' => 'dikenal',
                'lokasi_ditemukan' => 'Desa Sukamekar, Cianjur',
                'tanggal_ditemukan' => '2024-03-10',
                'kondisi_awal' => 'Tertimpa bangunan',
                'foto' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Bencana Bandung (bencana_id = 5)
            [
                'bencana_id' => 5,
                'nama' => 'Dewi Lestari',
                'jenis_kelamin' => 'P',
                'umur' => 30,
                'status_identitas' => 'dikenal',
                'lokasi_ditemukan' => 'Kecamatan Pangalengan, Bandung',
                'tanggal_ditemukan' => '2024-05-12',
                'kondisi_awal' => 'Luka di bagian punggung',
                'foto' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Bencana Surabaya (bencana_id = 6)
            [
                'bencana_id' => 6,
                'nama' => 'Hendra Wijaya',
                'jenis_kelamin' => 'L',
                'umur' => 40,
                'status_identitas' => 'dikenal',
                'lokasi_ditemukan' => 'Jl. Kenjeran, Surabaya',
                'tanggal_ditemukan' => '2024-06-18',
                'kondisi_awal' => 'Tenggelam berhasil ditolong',
                'foto' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Bencana Pati (bencana_id = 7)
            [
                'bencana_id' => 7,
                'nama' => 'Mbak Sri',
                'jenis_kelamin' => 'P',
                'umur' => 50,
                'status_identitas' => 'dikenal',
                'lokasi_ditemukan' => 'Desa Jakenan, Pati',
                'tanggal_ditemukan' => '2024-07-22',
                'kondisi_awal' => 'Tertimpa atap rumah',
                'foto' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Bencana Yogyakarta (bencana_id = 8)
            [
                'bencana_id' => 8,
                'nama' => 'Kartinah',
                'jenis_kelamin' => 'P',
                'umur' => 65,
                'status_identitas' => 'dikenal',
                'lokasi_ditemukan' => 'Desa Trimulyo, Bantul',
                'tanggal_ditemukan' => '2024-08-30',
                'kondisi_awal' => 'Luka di tangan dan kaki',
                'foto' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Bencana Samarinda (bencana_id = 10)
            [
                'bencana_id' => 10,
                'nama' => 'Andi Prasetyo',
                'jenis_kelamin' => 'L',
                'umur' => 22,
                'status_identitas' => 'dikenal',
                'lokasi_ditemukan' => 'Kecamatan Sungai Pinang, Samarinda',
                'tanggal_ditemukan' => '2024-10-05',
                'kondisi_awal' => 'Tenggelam',
                'foto' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Bencana Sulawesi (bencana_id = 12)
            [
                'bencana_id' => 12,
                'nama' => 'Nurhaliza',
                'jenis_kelamin' => 'P',
                'umur' => 8,
                'status_identitas' => 'dikenal',
                'lokasi_ditemukan' => 'Desa Tadui, Mamuju',
                'tanggal_ditemukan' => '2024-12-01',
                'kondisi_awal' => 'Shocked dan luka ringan',
                'foto' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('korban')->insert($data);
    }
}
