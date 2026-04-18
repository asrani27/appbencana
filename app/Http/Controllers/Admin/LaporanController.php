<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bencana;
use App\Models\Korban;
use App\Models\Triase;
use App\Models\Pemeriksaan;
use App\Models\Rujukan;
use App\Models\RumahSakit;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PDF;

class LaporanController extends Controller
{
    /**
     * Display the laporan index page
     */
    public function index()
    {
        return view('admin.laporan.index');
    }

    /**
     * Filter data based on date range or month/year
     */
    private function buildDateQuery($model, $dateColumn, $tanggalMulai = null, $tanggalSelesai = null, $bulan = null, $tahun = null)
    {
        $query = $model->newQuery();

        if ($tanggalMulai && $tanggalSelesai) {
            $query->whereBetween($dateColumn, [
                Carbon::parse($tanggalMulai)->startOfDay(),
                Carbon::parse($tanggalSelesai)->endOfDay()
            ]);
        } elseif ($bulan && $tahun) {
            $query->whereMonth($dateColumn, $bulan)
                ->whereYear($dateColumn, $tahun);
        }

        return $query;
    }

    /**
     * Get filter parameters from request
     */
    private function getFilterParams($request)
    {
        return [
            'tanggal_mulai' => $request->input('tanggal_mulai'),
            'tanggal_selesai' => $request->input('tanggal_selesai'),
            'bulan' => $request->input('bulan'),
            'tahun' => $request->input('tahun'),
        ];
    }

    /**
     * Format date range for report title
     */
    private function formatDateRange($tanggalMulai, $tanggalSelesai, $bulan, $tahun)
    {
        if ($tanggalMulai && $tanggalSelesai) {
            return Carbon::parse($tanggalMulai)->format('d/m/Y') . ' - ' . Carbon::parse($tanggalSelesai)->format('d/m/Y');
        } elseif ($bulan && $tahun) {
            return Carbon::createFromDate($tahun, $bulan, 1)->format('F Y');
        }
        return 'Semua Waktu';
    }

    /**
     * ============================================
     * LAPORAN DATA BENCANA
     * ============================================
     */
    public function bencanaIndex(Request $request)
    {
        $filters = $this->getFilterParams($request);

        $query = $this->buildDateQuery(new Bencana(), 'tanggal_kejadian', $filters['tanggal_mulai'], $filters['tanggal_selesai'], $filters['bulan'], $filters['tahun']);
        $bencana = $query->orderBy('tanggal_kejadian', 'desc')->get();

        $tanggalRange = $this->formatDateRange($filters['tanggal_mulai'], $filters['tanggal_selesai'], $filters['bulan'], $filters['tahun']);

        if ($request->has('export') && $request->export === 'pdf') {
            return $this->exportBencanaPdf($bencana, $tanggalRange);
        }

        return view('admin.laporan.bencana', compact('bencana', 'filters', 'tanggalRange'));
    }

    private function exportBencanaPdf($bencana, $tanggalRange)
    {
        $pdf = PDF::loadView('admin.laporan.pdf.bencana', [
            'bencana' => $bencana,
            'tanggalRange' => $tanggalRange,
            'tanggalCetak' => Carbon::now()->format('d/m/Y H:i'),
        ]);

        $pdf->setPaper('legal', 'landscape');
        $pdf->setOptions(['margin-top' => 20, 'margin-left' => 20, 'margin-right' => 20]);

        return $pdf->stream('laporan_bencana.pdf');
    }

    /**
     * ============================================
     * LAPORAN DATA KORBAN
     * ============================================
     */
    public function korbanIndex(Request $request)
    {
        $filters = $this->getFilterParams($request);

        $query = $this->buildDateQuery(new Korban(), 'tanggal_ditemukan', $filters['tanggal_mulai'], $filters['tanggal_selesai'], $filters['bulan'], $filters['tahun']);
        $korban = $query->with('bencana')->orderBy('tanggal_ditemukan', 'desc')->get();

        $tanggalRange = $this->formatDateRange($filters['tanggal_mulai'], $filters['tanggal_selesai'], $filters['bulan'], $filters['tahun']);

        if ($request->has('export') && $request->export === 'pdf') {
            return $this->exportKorbanPdf($korban, $tanggalRange);
        }

        return view('admin.laporan.korban', compact('korban', 'filters', 'tanggalRange'));
    }

    private function exportKorbanPdf($korban, $tanggalRange)
    {
        $pdf = PDF::loadView('admin.laporan.pdf.korban', [
            'korban' => $korban,
            'tanggalRange' => $tanggalRange,
            'tanggalCetak' => Carbon::now()->format('d/m/Y H:i'),
        ]);

        $pdf->setPaper('legal', 'landscape');
        $pdf->setOptions(['margin-top' => 20, 'margin-left' => 20, 'margin-right' => 20]);

        return $pdf->stream('laporan_korban.pdf');
    }

    /**
     * ============================================
     * LAPORAN TRIASE
     * ============================================
     */
    public function triaseIndex(Request $request)
    {
        $filters = $this->getFilterParams($request);

        $query = Triase::query();

        if ($filters['tanggal_mulai'] && $filters['tanggal_selesai']) {
            $query->whereBetween('created_at', [
                Carbon::parse($filters['tanggal_mulai'])->startOfDay(),
                Carbon::parse($filters['tanggal_selesai'])->endOfDay()
            ]);
        } elseif ($filters['bulan'] && $filters['tahun']) {
            $query->whereMonth('created_at', $filters['bulan'])
                ->whereYear('created_at', $filters['tahun']);
        }

        $triase = $query->with(['korban.bencana', 'creator'])->orderBy('created_at', 'desc')->get();

        $tanggalRange = $this->formatDateRange($filters['tanggal_mulai'], $filters['tanggal_selesai'], $filters['bulan'], $filters['tahun']);

        if ($request->has('export') && $request->export === 'pdf') {
            return $this->exportTriasePdf($triase, $tanggalRange);
        }

        return view('admin.laporan.triase', compact('triase', 'filters', 'tanggalRange'));
    }

    private function exportTriasePdf($triase, $tanggalRange)
    {
        $pdf = PDF::loadView('admin.laporan.pdf.triase', [
            'triase' => $triase,
            'tanggalRange' => $tanggalRange,
            'tanggalCetak' => Carbon::now()->format('d/m/Y H:i'),
        ]);

        $pdf->setPaper('legal', 'landscape');
        $pdf->setOptions(['margin-top' => 20, 'margin-left' => 20, 'margin-right' => 20]);

        return $pdf->stream('laporan_triase.pdf');
    }

    /**
     * ============================================
     * LAPORAN PEMERIKSAAN MEDIS
     * ============================================
     */
    public function pemeriksaanIndex(Request $request)
    {
        $filters = $this->getFilterParams($request);

        $query = Pemeriksaan::query();

        if ($filters['tanggal_mulai'] && $filters['tanggal_selesai']) {
            $query->whereBetween('created_at', [
                Carbon::parse($filters['tanggal_mulai'])->startOfDay(),
                Carbon::parse($filters['tanggal_selesai'])->endOfDay()
            ]);
        } elseif ($filters['bulan'] && $filters['tahun']) {
            $query->whereMonth('created_at', $filters['bulan'])
                ->whereYear('created_at', $filters['tahun']);
        }

        $pemeriksaan = $query->with(['korban.bencana', 'petugas'])->orderBy('created_at', 'desc')->get();

        $tanggalRange = $this->formatDateRange($filters['tanggal_mulai'], $filters['tanggal_selesai'], $filters['bulan'], $filters['tahun']);

        if ($request->has('export') && $request->export === 'pdf') {
            return $this->exportPemeriksaanPdf($pemeriksaan, $tanggalRange);
        }

        return view('admin.laporan.pemeriksaan', compact('pemeriksaan', 'filters', 'tanggalRange'));
    }

    private function exportPemeriksaanPdf($pemeriksaan, $tanggalRange)
    {
        $pdf = PDF::loadView('admin.laporan.pdf.pemeriksaan', [
            'pemeriksaan' => $pemeriksaan,
            'tanggalRange' => $tanggalRange,
            'tanggalCetak' => Carbon::now()->format('d/m/Y H:i'),
        ]);

        $pdf->setPaper('legal', 'landscape');
        $pdf->setOptions(['margin-top' => 20, 'margin-left' => 20, 'margin-right' => 20]);

        return $pdf->stream('laporan_pemeriksaan.pdf');
    }

    /**
     * ============================================
     * LAPORAN RUJUKAN
     * ============================================
     */
    public function rujukanIndex(Request $request)
    {
        $filters = $this->getFilterParams($request);

        $query = Rujukan::query();

        if ($filters['tanggal_mulai'] && $filters['tanggal_selesai']) {
            $query->whereBetween('waktu_rujuk', [
                Carbon::parse($filters['tanggal_mulai'])->startOfDay(),
                Carbon::parse($filters['tanggal_selesai'])->endOfDay()
            ]);
        } elseif ($filters['bulan'] && $filters['tahun']) {
            $query->whereMonth('waktu_rujuk', $filters['bulan'])
                ->whereYear('waktu_rujuk', $filters['tahun']);
        }

        $rujukan = $query->with(['korban.bencana', 'rumahSakit'])->orderBy('waktu_rujuk', 'desc')->get();

        $tanggalRange = $this->formatDateRange($filters['tanggal_mulai'], $filters['tanggal_selesai'], $filters['bulan'], $filters['tahun']);

        if ($request->has('export') && $request->export === 'pdf') {
            return $this->exportRujukanPdf($rujukan, $tanggalRange);
        }

        return view('admin.laporan.rujukan', compact('rujukan', 'filters', 'tanggalRange'));
    }

    private function exportRujukanPdf($rujukan, $tanggalRange)
    {
        $pdf = PDF::loadView('admin.laporan.pdf.rujukan', [
            'rujukan' => $rujukan,
            'tanggalRange' => $tanggalRange,
            'tanggalCetak' => Carbon::now()->format('d/m/Y H:i'),
        ]);

        $pdf->setPaper('legal', 'landscape');
        $pdf->setOptions(['margin-top' => 20, 'margin-left' => 20, 'margin-right' => 20]);

        return $pdf->stream('laporan_rujukan.pdf');
    }

    /**
     * ============================================
     * LAPORAN RUMAH SAKIT
     * ============================================
     */
    public function rumahSakitIndex(Request $request)
    {
        $rumahSakit = RumahSakit::withCount('rujukan')->orderBy('nama', 'asc')->get();

        $filters = $this->getFilterParams($request);
        $tanggalRange = $this->formatDateRange($filters['tanggal_mulai'], $filters['tanggal_selesai'], $filters['bulan'], $filters['tahun']);

        if ($request->has('export') && $request->export === 'pdf') {
            return $this->exportRumahSakitPdf($rumahSakit, $tanggalRange);
        }

        return view('admin.laporan.rumahsakit', compact('rumahSakit', 'filters', 'tanggalRange'));
    }

    private function exportRumahSakitPdf($rumahSakit, $tanggalRange)
    {
        $pdf = PDF::loadView('admin.laporan.pdf.rumahsakit', [
            'rumahSakit' => $rumahSakit,
            'tanggalRange' => $tanggalRange,
            'tanggalCetak' => Carbon::now()->format('d/m/Y H:i'),
        ]);

        $pdf->setPaper('legal', 'landscape');
        $pdf->setOptions(['margin-top' => 20, 'margin-left' => 20, 'margin-right' => 20]);

        return $pdf->stream('laporan_rumah_sakit.pdf');
    }
}
