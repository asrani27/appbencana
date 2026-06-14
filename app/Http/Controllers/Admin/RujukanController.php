<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rujukan;
use App\Models\Korban;
use App\Models\RumahSakit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RujukanController extends Controller
{
    /**
     * Display a listing of rujukan.
     */
    public function index(Request $request)
    {
        $query = Rujukan::with(['korban', 'rumahSakit']);

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->whereHas('korban', function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        $rujukans = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.rujukan.index', compact('rujukans'));
    }

    /**
     * Show the form for creating a new rujukan.
     */
    public function create()
    {
        $korban = Korban::all();
        $rumahSakit = RumahSakit::all();
        return view('admin.rujukan.create', compact('korban', 'rumahSakit'));
    }

    /**
     * Store a newly created rujukan.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'korban_id' => ['required', 'exists:korban,id'],
            'rumah_sakit_id' => ['required', 'exists:rumah_sakit,id'],
            'status' => ['required', 'in:dirujuk,diterima,selesai'],
            'waktu_rujuk' => ['nullable', 'date'],
            'catatan' => ['nullable', 'string'],
        ]);

        $validated['user_id'] = Auth::id();
        Rujukan::create($validated);

        return redirect()
            ->route('admin.rujukan.index')
            ->with('success', 'Data rujukan berhasil ditambahkan');
    }

    /**
     * Display the specified rujukan.
     */
    public function show(Rujukan $rujukan)
    {
        return view('admin.rujukan.show', compact('rujukan'));
    }

    /**
     * Show the form for editing the specified rujukan.
     */
    public function edit(Rujukan $rujukan)
    {
        $korban = Korban::all();
        $rumahSakit = RumahSakit::all();
        return view('admin.rujukan.edit', compact('rujukan', 'korban', 'rumahSakit'));
    }

    /**
     * Update the specified rujukan.
     */
    public function update(Request $request, Rujukan $rujukan)
    {
        $validated = $request->validate([
            'korban_id' => ['required', 'exists:korban,id'],
            'rumah_sakit_id' => ['required', 'exists:rumah_sakit,id'],
            'status' => ['required', 'in:dirujuk,diterima,selesai'],
            'waktu_rujuk' => ['nullable', 'date'],
            'catatan' => ['nullable', 'string'],
        ]);

        $rujukan->update($validated);

        return redirect()
            ->route('admin.rujukan.index')
            ->with('success', 'Data rujukan berhasil diperbarui');
    }

    /**
     * Remove the specified rujukan.
     */
    public function destroy(Rujukan $rujukan)
    {
        $rujukan->delete();

        return redirect()
            ->route('admin.rujukan.index')
            ->with('success', 'Data rujukan berhasil dihapus');
    }
}
