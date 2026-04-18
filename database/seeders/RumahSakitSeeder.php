<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RumahSakitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama' => 'RSUD Mataram',
                'alamat' => 'Jl. Prabu Ratu Siliwangi No. 1, Mataram, NTB',
                'no_hp' => '0370-123456',
                'latitude' => '-8.5833',
                'longitude' => '116.1167',
                'kapasitas_igd' => 30,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'RSU Dr. Soetomo',
                'alamat' => 'Jl. Prof. Dr. Moestopo No. 6-8, Surabaya, Jawa Timur',
                'no_hp' => '031-5501000',
                'latitude' => '-7.2653',
                'longitude' => '112.7529',
                'kapasitas_igd' => 50,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'RSUP Dr. Hasan Sadikin',
                'alamat' => 'Jl. Pasteur No. 38, Bandung, Jawa Barat',
                'no_hp' => '022-2034003',
                'latitude' => '-6.8979',
                'longitude' => '107.6046',
                'kapasitas_igd' => 40,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'RSUD Dr. Slamet Gardae',
                'alamat' => 'Jl. Slamet No. 4, Cianjur, Jawa Barat',
                'no_hp' => '0263-265111',
                'latitude' => '-6.8217',
                'longitude' => '107.1411',
                'kapasitas_igd' => 25,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'RSUD Dr. Soedono',
                'alamat' => 'Jl. Dr. Soedono No. 52, Madiun, Jawa Timur',
                'no_hp' => '0351-461653',
                'latitude' => '-7.6300',
                'longitude' => '111.5289',
                'kapasitas_igd' => 20,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'RS Sardjito',
                'alamat' => 'Jl. Kesehatan No. 1, Sleman, DI Yogyakarta',
                'no_hp' => '0274-587333',
                'latitude' => '-7.7671',
                'longitude' => '110.3725',
                'kapasitas_igd' => 35,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'RSUD Abdul Wahab Sjahranie',
                'alamat' => 'Jl. Palangkaraya No. 2, Samarinda, Kalimantan Timur',
                'no_hp' => '0541-738118',
                'latitude' => '-0.4941',
                'longitude' => '117.1494',
                'kapasitas_igd' => 30,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'RSUD Provincial Papua Barat',
                'alamat' => 'Jl.ransie No. 1, Manokwari, Papua Barat',
                'no_hp' => '0986-211945',
                'latitude' => '-0.8629',
                'longitude' => '134.0620',
                'kapasitas_igd' => 25,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'RSUP Sanglah',
                'alamat' => 'Jl. Diponegoro, Denpasar, Bali',
                'no_hp' => '0361-227911',
                'latitude' => '-8.6495',
                'longitude' => '115.2197',
                'kapasitas_igd' => 45,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'RSUD Dr. M. Haulussy',
                'alamat' => 'Jl. Dr. M. Haulussy No. 1, Ambon, Maluku',
                'no_hp' => '0911-343628',
                'latitude' => '-3.7036',
                'longitude' => '128.1772',
                'kapasitas_igd' => 20,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'RSUD Dr. H. Bocimi',
                'alamat' => 'Jl. Raya Bandung Ciranjang, Cianjur, Jawa Barat',
                'no_hp' => '0263-732333',
                'latitude' => '-6.7500',
                'longitude' => '107.1500',
                'kapasitas_igd' => 15,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'RSUD Dr. R. D. Kandou',
                'alamat' => 'Jl. 20 November, Manado, Sulawesi Utara',
                'no_hp' => '0431-838841',
                'latitude' => '1.4747',
                'longitude' => '124.8421',
                'kapasitas_igd' => 35,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('rumah_sakit')->insert($data);
    }
}
