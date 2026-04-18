<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BencanaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama_bencana' => 'Gempa Bumi Lombok 2024',
                'jenis_bencana' => 'gempa',
                'lokasi' => 'Kabupaten Lombok Utara, NTB',
                'tanggal_kejadian' => '2024-01-15',
                'status' => 'selesai',
                'keterangan' => 'Gempa bumi berkekuatan 6.4 SR menyebabkan kerusakan di beberapa wilayah Lombok',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_bencana' => 'Banjir Bandang Jakarta',
                'jenis_bencana' => 'banjir',
                'lokasi' => 'Kota Jakarta Selatan',
                'tanggal_kejadian' => '2024-02-20',
                'status' => 'selesai',
                'keterangan' => 'Hujan deras menyebabkan banjir bandang di beberapa titik Jakarta Selatan',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_bencana' => 'Gempa Bumi Cianjur',
                'jenis_bencana' => 'gempa',
                'lokasi' => 'Kabupaten Cianjur, Jawa Barat',
                'tanggal_kejadian' => '2024-03-10',
                'status' => 'selesai',
                'keterangan' => 'Gempa bumi berkekuatan 5.6 SR menyebabkan korban jiwa dan kerusakan infrastruktur',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_bencana' => 'Kebakaran Hutan Kalimantan',
                'jenis_bencana' => 'kebakaran',
                'lokasi' => 'Provinsi Kalimantan Tengah',
                'tanggal_kejadian' => '2024-04-05',
                'status' => 'selesai',
                'keterangan' => 'Kebakaran hutan akibat cuaca kering dan kemarau panjang',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_bencana' => 'Tanah Longsor Bandung',
                'jenis_bencana' => 'longsor',
                'lokasi' => 'Kabupaten Bandung, Jawa Barat',
                'tanggal_kejadian' => '2024-05-12',
                'status' => 'selesai',
                'keterangan' => 'Curah hujan tinggi menyebabkan tanah longsor di kawasan pegunungan',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_bencana' => 'Banjir Surabaya',
                'jenis_bencana' => 'banjir',
                'lokasi' => 'Kota Surabaya, Jawa Timur',
                'tanggal_kejadian' => '2024-06-18',
                'status' => 'aktif',
                'keterangan' => 'Banjir akibat luapan sungai Surplus dan curah hujan tinggi',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_bencana' => 'Puting Beliung Pati',
                'jenis_bencana' => 'puting_beliung',
                'lokasi' => 'Kabupaten Pati, Jawa Tengah',
                'tanggal_kejadian' => '2024-07-22',
                'status' => 'selesai',
                'keterangan' => 'Angin puting beliung merusak ratusan rumah dan infrastruktur',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_bencana' => 'Gempa Bumi Yogyakarta',
                'jenis_bencana' => 'gempa',
                'lokasi' => 'Kabupaten Bantul, DI Yogyakarta',
                'tanggal_kejadian' => '2024-08-30',
                'status' => 'aktif',
                'keterangan' => 'Gempa bumi tektonik menyebabkan kerusakan di beberapa desa',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_bencana' => 'Kekeringan NTT',
                'jenis_bencana' => 'kekeringan',
                'lokasi' => 'Provinsi Nusa Tenggara Timur',
                'tanggal_kejadian' => '2024-09-15',
                'status' => 'aktif',
                'keterangan' => 'Kemarau panjang menyebabkan krisis air bersih dan gagal panen',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_bencana' => 'Banjir Samarinda',
                'jenis_bencana' => 'banjir',
                'lokasi' => 'Kota Samarinda, Kalimantan Timur',
                'tanggal_kejadian' => '2024-10-05',
                'status' => 'aktif',
                'keterangan' => 'Banjir melanda beberapa kecamatan akibat hujan deras berkepanjangan',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_bencana' => 'Tsunami Pantai Selatan',
                'jenis_bencana' => 'tsunami',
                'lokasi' => 'Pantai Selatan Jawa Barat',
                'tanggal_kejadian' => '2024-11-10',
                'status' => 'aktif',
                'keterangan' => 'Tsunami kecil akibat gempa bawah laut di Samudra Hindia',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_bencana' => 'Gempa Bumi Sulawesi',
                'jenis_bencana' => 'gempa',
                'lokasi' => 'Kota Mamuju, Sulawesi Barat',
                'tanggal_kejadian' => '2024-12-01',
                'status' => 'aktif',
                'keterangan' => 'Gempa bumi susulan menyebabkan evakuasi warga',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('bencana')->insert($data);
    }
}
