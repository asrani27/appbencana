<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bencana;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BencanaController extends Controller
{
    /**
     * Display a listing of bencana.
     */
    public function index(Request $request)
    {
        $query = Bencana::query();

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_bencana', 'like', "%{$search}%")
                    ->orWhere('lokasi', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        // Filter by jenis bencana
        if ($request->has('jenis') && $request->jenis) {
            $query->where('jenis_bencana', $request->jenis);
        }

        $bencanas = $query->orderBy('tanggal_kejadian', 'desc')->paginate(10);

        return view('admin.bencana.index', compact('bencanas'));
    }

    /**
     * Show the form for creating a new bencana.
     */
    public function create()
    {
        $jenisBencana = [
            'gempa' => 'Gempa Bumi',
            'banjir' => 'Banjir',
            'tsunami' => 'Tsunami',
            'kebakaran' => 'Kebakaran',
            'longsor' => 'Longsor',
            'puting_beliung' => 'Puting Beliung',
            'kekeringan' => 'Kekeringan',
            'lainnya' => 'Lainnya',
        ];

        return view('admin.bencana.create', compact('jenisBencana'));
    }

    /**
     * Store a newly created bencana.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_bencana' => ['required', 'string', 'max:255'],
            'jenis_bencana' => ['required', Rule::in(['gempa', 'banjir', 'tsunami', 'kebakaran', 'longsor', 'puting_beliung', 'kekeringan', 'lainnya'])],
            'lokasi' => ['required', 'string'],
            'tanggal_kejadian' => ['required', 'date'],
            'status' => ['required', Rule::in(['aktif', 'selesai'])],
            'keterangan' => ['nullable', 'string'],
        ]);

        Bencana::create($validated);

        return redirect()
            ->route('admin.bencana.index')
            ->with('success', 'Data bencana berhasil ditambahkan');
    }

    /**
     * Display the specified bencana.
     */
    public function show(Bencana $bencana)
    {
        return view('admin.bencana.show', compact('bencana'));
    }

    /**
     * Show the form for editing the specified bencana.
     */
    public function edit(Bencana $bencana)
    {
        $jenisBencana = [
            'gempa' => 'Gempa Bumi',
            'banjir' => 'Banjir',
            'tsunami' => 'Tsunami',
            'kebakaran' => 'Kebakaran',
            'longsor' => 'Longsor',
            'puting_beliung' => 'Puting Beliung',
            'kekeringan' => 'Kekeringan',
            'lainnya' => 'Lainnya',
        ];

        return view('admin.bencana.edit', compact('bencana', 'jenisBencana'));
    }

    /**
     * Update the specified bencana.
     */
    public function update(Request $request, Bencana $bencana)
    {
        $validated = $request->validate([
            'nama_bencana' => ['required', 'string', 'max:255'],
            'jenis_bencana' => ['required', Rule::in(['gempa', 'banjir', 'tsunami', 'kebakaran', 'longsor', 'puting_beliung', 'kekeringan', 'lainnya'])],
            'lokasi' => ['required', 'string'],
            'tanggal_kejadian' => ['required', 'date'],
            'status' => ['required', Rule::in(['aktif', 'selesai'])],
            'keterangan' => ['nullable', 'string'],
        ]);

        $bencana->update($validated);

        return redirect()
            ->route('admin.bencana.index')
            ->with('success', 'Data bencana berhasil diperbarui');
    }

    /**
     * Remove the specified bencana.
     */
    public function destroy(Bencana $bencana)
    {
        // Check if bencana has related korban
        if ($bencana->korban()->count() > 0) {
            return redirect()
                ->route('admin.bencana.index')
                ->with('error', 'Tidak dapat menghapus bencana yang memiliki data korban terkait');
        }

        $bencana->delete();

        return redirect()
            ->route('admin.bencana.index')
            ->with('success', 'Data bencana berhasil dihapus');
    }
}