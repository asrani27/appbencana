<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bencana;
use App\Models\Korban;
use App\Models\Triase;
use App\Models\Pemeriksaan;
use App\Models\Rujukan;
use App\Models\RumahSakit;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_bencana' => Bencana::count(),
            'total_korban' => Korban::count(),
            'total_triase' => Triase::count(),
            'total_rumahsakit' => RumahSakit::count(),
            'total_pemeriksaan' => Pemeriksaan::count(),
            'total_rujukan' => Rujukan::count(),
            'total_users' => User::count(),
        ];

        $recentBencana = Bencana::orderBy('tanggal_kejadian', 'desc')->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentBencana'));
    }
}
