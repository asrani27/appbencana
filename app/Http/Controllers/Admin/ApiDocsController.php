<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiDocsController extends Controller
{
    public function index()
    {
        $apiEndpoints = [
            [
                'method' => 'POST',
                'endpoint' => '/api/login',
                'description' => 'Login untuk mendapatkan token API (Laravel Sanctum)',
                'parameters' => [
                    ['name' => 'username', 'type' => 'string', 'required' => true, 'description' => 'Username pengguna'],
                    ['name' => 'password', 'type' => 'string', 'required' => true, 'description' => 'Password pengguna'],
                ],
            ],
            [
                'method' => 'POST',
                'endpoint' => '/api/logout',
                'description' => 'Logout dan invalidate token API',
                'parameters' => [],
            ],
            [
                'method' => 'GET',
                'endpoint' => '/api/user',
                'description' => 'Ambil data user yang sedang login',
                'parameters' => [],
            ],
            [
                'method' => 'GET',
                'endpoint' => '/api/bencana',
                'description' => 'Ambil semua data bencana',
                'parameters' => [
                    ['name' => 'page', 'type' => 'integer', 'required' => false, 'description' => 'Nomor halaman'],
                    ['name' => 'per_page', 'type' => 'integer', 'required' => false, 'description' => 'Jumlah data per halaman'],
                ],
            ],
            [
                'method' => 'GET',
                'endpoint' => '/api/bencana/{id}',
                'description' => 'Ambil detail data bencana',
                'parameters' => [
                    ['name' => 'id', 'type' => 'integer', 'required' => true, 'description' => 'ID bencana'],
                ],
            ],
            [
                'method' => 'POST',
                'endpoint' => '/api/bencana',
                'description' => 'Tambah data bencana baru',
                'parameters' => [
                    ['name' => 'nama_bencana', 'type' => 'string', 'required' => true, 'description' => 'Nama bencana'],
                    ['name' => 'tanggal_kejadian', 'type' => 'date', 'required' => true, 'description' => 'Tanggal kejadian'],
                    ['name' => 'lokasi', 'type' => 'string', 'required' => true, 'description' => 'Lokasi bencana'],
                    ['name' => 'deskripsi', 'type' => 'text', 'required' => false, 'description' => 'Deskripsi bencana'],
                ],
            ],
            [
                'method' => 'PUT',
                'endpoint' => '/api/bencana/{id}',
                'description' => 'Update data bencana',
                'parameters' => [
                    ['name' => 'id', 'type' => 'integer', 'required' => true, 'description' => 'ID bencana'],
                    ['name' => 'nama_bencana', 'type' => 'string', 'required' => false, 'description' => 'Nama bencana'],
                    ['name' => 'tanggal_kejadian', 'type' => 'date', 'required' => false, 'description' => 'Tanggal kejadian'],
                    ['name' => 'lokasi', 'type' => 'string', 'required' => false, 'description' => 'Lokasi bencana'],
                ],
            ],
            [
                'method' => 'DELETE',
                'endpoint' => '/api/bencana/{id}',
                'description' => 'Hapus data bencana',
                'parameters' => [
                    ['name' => 'id', 'type' => 'integer', 'required' => true, 'description' => 'ID bencana'],
                ],
            ],
            [
                'method' => 'GET',
                'endpoint' => '/api/korban',
                'description' => 'Ambil semua data korban',
                'parameters' => [],
            ],
            [
                'method' => 'GET',
                'endpoint' => '/api/korban/{id}',
                'description' => 'Ambil detail data korban',
                'parameters' => [
                    ['name' => 'id', 'type' => 'integer', 'required' => true, 'description' => 'ID korban'],
                ],
            ],
            [
                'method' => 'POST',
                'endpoint' => '/api/korban',
                'description' => 'Tambah data korban baru',
                'parameters' => [
                    ['name' => 'bencana_id', 'type' => 'integer', 'required' => true, 'description' => 'ID bencana'],
                    ['name' => 'nama', 'type' => 'string', 'required' => true, 'description' => 'Nama korban'],
                    ['name' => 'nik', 'type' => 'string', 'required' => true, 'description' => 'NIK korban'],
                    ['name' => 'alamat', 'type' => 'string', 'required' => true, 'description' => 'Alamat korban'],
                    ['name' => 'no_telp', 'type' => 'string', 'required' => false, 'description' => 'Nomor telepon'],
                ],
            ],
            [
                'method' => 'GET',
                'endpoint' => '/api/triase',
                'description' => 'Ambil semua data triase',
                'parameters' => [],
            ],
            [
                'method' => 'POST',
                'endpoint' => '/api/triase',
                'description' => 'Tambah data triase baru',
                'parameters' => [
                    ['name' => 'korban_id', 'type' => 'integer', 'required' => true, 'description' => 'ID korban'],
                    ['name' => 'kategori', 'type' => 'string', 'required' => true, 'description' => 'Kategori triase (merah/kuning/hijau/hitam)'],
                    ['name' => 'keterangan', 'type' => 'text', 'required' => false, 'description' => 'Keterangan triase'],
                ],
            ],
            [
                'method' => 'GET',
                'endpoint' => '/api/pemeriksaan',
                'description' => 'Ambil semua data pemeriksaan medis',
                'parameters' => [],
            ],
            [
                'method' => 'POST',
                'endpoint' => '/api/pemeriksaan',
                'description' => 'Tambah data pemeriksaan medis',
                'parameters' => [
                    ['name' => 'korban_id', 'type' => 'integer', 'required' => true, 'description' => 'ID korban'],
                    ['name' => 'tekanan_darah', 'type' => 'string', 'required' => false, 'description' => 'Tekanan darah'],
                    ['name' => 'denyut_nadi', 'type' => 'integer', 'required' => false, 'description' => 'Denyut nadi'],
                    ['name' => 'suhu_badan', 'type' => 'decimal', 'required' => false, 'description' => 'Suhu badan'],
                    ['name' => 'diagnosa', 'type' => 'text', 'required' => false, 'description' => 'Diagnosa'],
                ],
            ],
            [
                'method' => 'GET',
                'endpoint' => '/api/rujukan',
                'description' => 'Ambil semua data rujukan',
                'parameters' => [],
            ],
            [
                'method' => 'POST',
                'endpoint' => '/api/rujukan',
                'description' => 'Tambah data rujukan',
                'parameters' => [
                    ['name' => 'korban_id', 'type' => 'integer', 'required' => true, 'description' => 'ID korban'],
                    ['name' => 'rumah_sakit_id', 'type' => 'integer', 'required' => true, 'description' => 'ID rumah sakit tujuan'],
                    ['name' => 'alasan', 'type' => 'text', 'required' => true, 'description' => 'Alasan rujukan'],
                ],
            ],
            [
                'method' => 'GET',
                'endpoint' => '/api/rumah-sakit',
                'description' => 'Ambil semua data rumah sakit',
                'parameters' => [],
            ],
            [
                'method' => 'POST',
                'endpoint' => '/api/rumah-sakit',
                'description' => 'Tambah data rumah sakit',
                'parameters' => [
                    ['name' => 'nama', 'type' => 'string', 'required' => true, 'description' => 'Nama rumah sakit'],
                    ['name' => 'alamat', 'type' => 'string', 'required' => true, 'description' => 'Alamat rumah sakit'],
                    ['name' => 'no_telp', 'type' => 'string', 'required' => true, 'description' => 'Nomor telepon'],
                    ['name' => 'kapasitas', 'type' => 'integer', 'required' => false, 'description' => 'Kapasitas tempat tidur'],
                ],
            ],
        ];

        return view('admin.api-docs.index', compact('apiEndpoints'));
    }
}
