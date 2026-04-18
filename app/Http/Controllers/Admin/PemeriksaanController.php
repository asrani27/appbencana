<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemeriksaan;
use App\Models\Korban;
use App\Models\User;
use Illuminate\Http\Request;

class PemeriksaanController extends Controller
{
    /**
     * Display a listing of pemeriksaan.
     */
    public function index(Request $request)
    {
        $query = Pemeriksaan::with(['korban', 'petugas']);

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->whereHas('korban', function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%");
            });
        }

        $pemeriksaans = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.pemeriksaan.index', compact('pemeriksaans'));
    }

    /**
     * Show the form for creating a new pemeriksaan.
     */
    public function create()
    {
        $korban = Korban::all();
        $petugas = User::where('role', 'medis')->orWhere('role', 'petugas')->get();
        return view('admin.pemeriksaan.create', compact('korban', 'petugas'));
    }

    /**
     * Store a newly created pemeriksaan.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'korban_id' => ['required', 'exists:korban,id'],
            'tekanan_darah' => ['nullable', 'string', 'max:20'],
            'nadi' => ['nullable', 'string', 'max:10'],
            'respirasi' => ['nullable', 'string', 'max:10'],
            'suhu' => ['nullable', 'numeric', 'min:0', 'max:50'],
            'keluhan' => ['nullable', 'string'],
            'diagnosa_awal' => ['nullable', 'string'],
            'tindakan' => ['nullable', 'string'],
            'petugas_id' => ['required', 'exists:users,id'],
        ]);

        $validated['petugas_id'] = auth()->id();

        Pemeriksaan::create($validated);

        return redirect()
            ->route('admin.pemeriksaan.index')
            ->with('success', 'Data pemeriksaan berhasil ditambahkan');
    }

    /**
     * Display the specified pemeriksaan.
     */
    public function show(Pemeriksaan $pemeriksaan)
    {
        return view('admin.pemeriksaan.show', compact('pemeriksaan'));
    }

    /**
     * Show the form for editing the specified pemeriksaan.
     */
    public function edit(Pemeriksaan $pemeriksaan)
    {
        $korban = Korban::all();
        $petugas = User::where('role', 'medis')->orWhere('role', 'petugas')->get();
        return view('admin.pemeriksaan.edit', compact('pemeriksaan', 'korban', 'petugas'));
    }

    /**
     * Update the specified pemeriksaan.
     */
    public function update(Request $request, Pemeriksaan $pemeriksaan)
    {
        $validated = $request->validate([
            'korban_id' => ['required', 'exists:korban,id'],
            'tekanan_darah' => ['nullable', 'string', 'max:20'],
            'nadi' => ['nullable', 'string', 'max:10'],
            'respirasi' => ['nullable', 'string', 'max:10'],
            'suhu' => ['nullable', 'numeric', 'min:0', 'max:50'],
            'keluhan' => ['nullable', 'string'],
            'diagnosa_awal' => ['nullable', 'string'],
            'tindakan' => ['nullable', 'string'],
            'petugas_id' => ['required', 'exists:users,id'],
        ]);

        $pemeriksaan->update($validated);

        return redirect()
            ->route('admin.pemeriksaan.index')
            ->with('success', 'Data pemeriksaan berhasil diperbarui');
    }

    /**
     * Remove the specified pemeriksaan.
     */
    public function destroy(Pemeriksaan $pemeriksaan)
    {
        $pemeriksaan->delete();

        return redirect()
            ->route('admin.pemeriksaan.index')
            ->with('success', 'Data pemeriksaan berhasil dihapus');
    }
}
