<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RujukanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'korban_id' => 1,
                'rumah_sakit_id' => 1,
                'status' => 'diterima',
                'waktu_rujuk' => Carbon::now()->subDays(3),
                'catatan' => 'Luka kepala sudah dijahit, kondisi stabil',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'korban_id' => 2,
                'rumah_sakit_id' => 1,
                'status' => 'diterima',
                'waktu_rujuk' => Carbon::now()->subDays(3),
                'catatan' => 'Patah tulang kaki kanan, perlu operasi',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'korban_id' => 3,
                'rumah_sakit_id' => 9,
                'status' => 'diterima',
                'waktu_rujuk' => Carbon::now()->subDays(2),
                'catatan' => 'Hipothermia, sudah dihangatkan di IGD',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'korban_id' => 5,
                'rumah_sakit_id' => 3,
                'status' => 'diterima',
                'waktu_rujuk' => Carbon::now()->subDays(1),
                'catatan' => 'Cedera kepala sedang, CT scan menunjukkan perdarahan ringan',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'korban_id' => 6,
                'rumah_sakit_id' => 4,
                'status' => 'dirujuk',
                'waktu_rujuk' => Carbon::now(),
                'catatan' => 'Cedera thoracal, perlu pemeriksaan lebih lanjut',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'korban_id' => 8,
                'rumah_sakit_id' => 2,
                'status' => 'diterima',
                'waktu_rujuk' => Carbon::now()->subHours(12),
                'catatan' => 'Pasien tenggelam, sudah stabil setelah tindakan',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'korban_id' => 9,
                'rumah_sakit_id' => 5,
                'status' => 'dirujuk',
                'waktu_rujuk' => Carbon::now()->subHours(8),
                'catatan' => 'Cedera torso, perlu observasi intensif',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'korban_id' => 11,
                'rumah_sakit_id' => 12,
                'status' => 'diterima',
                'waktu_rujuk' => Carbon::now()->subHours(6),
                'catatan' => 'Pasien henti napas berhasil diresusitasi, di IGD',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'korban_id' => 12,
                'rumah_sakit_id' => 7,
                'status' => 'diterima',
                'waktu_rujuk' => Carbon::now()->subDays(5),
                'catatan' => 'Shock, sudah mendapat infuse dan observasi',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'korban_id' => 4,
                'rumah_sakit_id' => 6,
                'status' => 'selesai',
                'waktu_rujuk' => Carbon::now()->subDays(4),
                'catatan' => 'Multi trauma, sudah sembuh dan dipulangkan',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'korban_id' => 7,
                'rumah_sakit_id' => 10,
                'status' => 'selesai',
                'waktu_rujuk' => Carbon::now()->subDays(6),
                'catatan' => 'Luka punggung sudah kering, kontrol poli',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'korban_id' => 10,
                'rumah_sakit_id' => 6,
                'status' => 'selesai',
                'waktu_rujuk' => Carbon::now()->subDays(7),
                'catatan' => 'Luka lecet sudah sembuh, kontrol 1 minggu',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('rujukan')->insert($data);
    }
}