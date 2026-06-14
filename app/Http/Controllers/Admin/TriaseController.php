<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Korban;
use App\Models\Triase;
use Illuminate\Http\Request;

class TriaseController extends Controller
{
    /**
     * Display a listing of triase.
     */
    public function index(Request $request)
    {
        $query = Triase::with(['korban', 'user']);

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->whereHas('korban', function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%");
            });
        }

        // Filter by kategori
        if ($request->has('kategori') && $request->kategori) {
            $query->where('kategori', $request->kategori);
        }

        // Filter by bencana
        if ($request->has('bencana_id') && $request->bencana_id) {
            $query->whereHas('korban', function ($q) use ($request) {
                $q->where('bencana_id', $request->bencana_id);
            });
        }

        $triases = $query->orderBy('created_at', 'desc')->paginate(10);
        $kategoriOptions = ['merah', 'kuning', 'hijau', 'hitam'];

        return view('admin.triase.index', compact('triases', 'kategoriOptions'));
    }

    /**
     * Show the form for creating a new triase.
     */
    public function create()
    {
        $kategoriOptions = [
            'merah' => 'Merah - Prioritas Tinggi (Immediate)',
            'kuning' => 'Kuning - Prioritas Sedang (Delayed)',
            'hijau' => 'Hijau - Prioritas Rendah (Walking Wounded)',
            'hitam' => 'Hitam - Meninggal/Dead',
        ];
        
        $korbanOptions = Korban::whereDoesntHave('triase')->orderBy('nama')->get();

        return view('admin.triase.create', compact('kategoriOptions', 'korbanOptions'));
    }

    /**
     * Store a newly created triase.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'korban_id' => ['required', 'exists:korban,id'],
            'kategori' => ['required', 'in:merah,kuning,hijau,hitam'],
            'keterangan' => ['nullable', 'string', 'max:1000'],
        ]);

        $validated['user_id'] = auth()->id();

        Triase::create($validated);

        return redirect()
            ->route('admin.triase.index')
            ->with('success', 'Data triase berhasil ditambahkan');
    }

    /**
     * Display the specified triase.
     */
    public function show(Triase $triase)
    {
        return view('admin.triase.show', compact('triase'));
    }

    /**
     * Show the form for editing the specified triase.
     */
    public function edit(Triase $triase)
    {
        $kategoriOptions = [
            'merah' => 'Merah - Prioritas Tinggi (Immediate)',
            'kuning' => 'Kuning - Prioritas Sedang (Delayed)',
            'hijau' => 'Hijau - Prioritas Rendah (Walking Wounded)',
            'hitam' => 'Hitam - Meninggal/Dead',
        ];

        return view('admin.triase.edit', compact('triase', 'kategoriOptions'));
    }

    /**
     * Update the specified triase.
     */
    public function update(Request $request, Triase $triase)
    {
        $validated = $request->validate([
            'kategori' => ['required', 'in:merah,kuning,hijau,hitam'],
            'keterangan' => ['nullable', 'string', 'max:1000'],
        ]);

        $triase->update($validated);

        return redirect()
            ->route('admin.triase.index')
            ->with('success', 'Data triase berhasil diperbarui');
    }

    /**
     * Remove the specified triase.
     */
    public function destroy(Triase $triase)
    {
        $triase->delete();

        return redirect()
            ->route('admin.triase.index')
            ->with('success', 'Data triase berhasil dihapus');
    }
}
