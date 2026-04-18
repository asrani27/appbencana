<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RumahSakit;
use Illuminate\Http\Request;

class RumahSakitController extends Controller
{
    /**
     * Display a listing of rumah sakit.
     */
    public function index(Request $request)
    {
        $query = RumahSakit::query();

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('alamat', 'like', "%{$search}%");
            });
        }

        $rumahSakit = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.rumahsakit.index', compact('rumahSakit'));
    }

    /**
     * Show the form for creating a new rumah sakit.
     */
    public function create()
    {
        return view('admin.rumahsakit.create');
    }

    /**
     * Store a newly created rumah sakit.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string'],
            'no_hp' => ['nullable', 'string', 'max:20'],
            'latitude' => ['nullable', 'numeric', 'min:-90', 'max:90'],
            'longitude' => ['nullable', 'numeric', 'min:-180', 'max:180'],
            'kapasitas_igd' => ['nullable', 'integer', 'min:0'],
        ]);

        RumahSakit::create($validated);

        return redirect()
            ->route('admin.rumahsakit.index')
            ->with('success', 'Data rumah sakit berhasil ditambahkan');
    }

    /**
     * Display the specified rumah sakit.
     */
    public function show($rumahsakit)
    {
        $rumahSakit = RumahSakit::findOrFail($rumahsakit);

        return view('admin.rumahsakit.show', compact('rumahSakit'));
    }

    /**
     * Show the form for editing the specified rumah sakit.
     */
    public function edit($rumahsakit)
    {
        $rumahSakit = RumahSakit::findOrFail($rumahsakit);

        return view('admin.rumahsakit.edit', compact('rumahSakit'));
    }

    /**
     * Update the specified rumah sakit.
     */
    public function update(Request $request, RumahSakit $rumahSakit)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string'],
            'no_hp' => ['nullable', 'string', 'max:20'],
            'latitude' => ['nullable', 'numeric', 'min:-90', 'max:90'],
            'longitude' => ['nullable', 'numeric', 'min:-180', 'max:180'],
            'kapasitas_igd' => ['nullable', 'integer', 'min:0'],
        ]);

        $rumahSakit->update($validated);

        return redirect()
            ->route('admin.rumahsakit.index')
            ->with('success', 'Data rumah sakit berhasil diperbarui');
    }

    /**
     * Remove the specified rumah sakit.
     */
    public function destroy(RumahSakit $rumahSakit)
    {
        $rumahSakit->delete();

        return redirect()
            ->route('admin.rumahsakit.index')
            ->with('success', 'Data rumah sakit berhasil dihapus');
    }
}
