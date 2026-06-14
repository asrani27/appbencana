<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TriaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'korban_id' => 1,
                'kategori' => 'kuning',
                'keterangan' => 'Luka di kepala, perlu observasi lanjut',
                'user_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'korban_id' => 2,
                'kategori' => 'merah',
                'keterangan' => 'Patah tulang kaki kanan, membutuhkan penanganan segera',
                'user_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'korban_id' => 3,
                'kategori' => 'merah',
                'keterangan' => 'Hipothermia, membutuhkan penanganan segera',
                'user_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'korban_id' => 4,
                'kategori' => 'kuning',
                'keterangan' => 'Luka-luka di tubuh, observasi diperlukan',
                'user_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'korban_id' => 5,
                'kategori' => 'merah',
                'keterangan' => 'Luka serius di kepala, penanganan segera diperlukan',
                'user_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'korban_id' => 6,
                'kategori' => 'kuning',
                'keterangan' => 'Tertimpa bangunan, kemungkinan patah tulang',
                'user_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'korban_id' => 7,
                'kategori' => 'hijau',
                'keterangan' => 'Luka di punggung, kondisi stabil',
                'user_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'korban_id' => 8,
                'kategori' => 'kuning',
                'keterangan' => 'Tenggelam berhasil ditolong, observasi pernapasan',
                'user_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'korban_id' => 9,
                'kategori' => 'kuning',
                'keterangan' => 'Tertimpa atap rumah, luka di torso',
                'user_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'korban_id' => 10,
                'kategori' => 'hijau',
                'keterangan' => 'Luka di tangan dan kaki, kondisi ringan',
                'user_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'korban_id' => 11,
                'kategori' => 'merah',
                'keterangan' => 'Tenggelam, butuh bantuan pernapasan segera',
                'user_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'korban_id' => 12,
                'kategori' => 'merah',
                'keterangan' => 'Shock dan luka ringan, observasi vital signs',
                'user_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('triase')->insert($data);
    }
}
