<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Korban;
use App\Models\Bencana;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class VictimController extends Controller
{
    /**
     * Display a listing of korban.
     */
    public function index(Request $request)
    {
        $query = Korban::with('bencana');

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('lokasi_ditemukan', 'like', "%{$search}%");
            });
        }

        // Filter by disaster
        if ($request->has('bencana_id') && $request->bencana_id) {
            $query->where('bencana_id', $request->bencana_id);
        }

        // Filter by gender
        if ($request->has('jenis_kelamin') && $request->jenis_kelamin) {
            $query->where('jenis_kelamin', $request->jenis_kelamin);
        }

        // Filter by identity status
        if ($request->has('status_identitas') && $request->status_identitas) {
            $query->where('status_identitas', $request->status_identitas);
        }

        $korban = $query->orderBy('created_at', 'desc')->paginate(10);
        $bencanas = Bencana::orderBy('nama_bencana')->get();

        return view('admin.korban.index', compact('korban', 'bencanas'));
    }

    /**
     * Show the form for creating a new korban.
     */
    public function create()
    {
        $bencanas = Bencana::orderBy('nama_bencana')->get();
        $jenisKelamin = ['L' => 'Laki-laki', 'P' => 'Perempuan'];
        $statusIdentitas = ['dikenal' => 'Dikenal', 'tidak_dikenal' => 'Tidak Dikenal'];

        return view('admin.korban.create', compact('bencanas', 'jenisKelamin', 'statusIdentitas'));
    }

    /**
     * Store a newly created korban.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'bencana_id' => ['required', 'exists:bencana,id'],
            'nama' => ['nullable', 'string', 'max:255'],
            'jenis_kelamin' => ['required', Rule::in(['L', 'P'])],
            'umur' => ['nullable', 'integer', 'min:0', 'max:150'],
            'status_identitas' => ['required', Rule::in(['dikenal', 'tidak_dikenal'])],
            'lokasi_ditemukan' => ['nullable', 'string'],
            'tanggal_ditemukan' => ['nullable', 'date'],
            'kondisi_awal' => ['nullable', 'string'],
            'foto' => ['nullable', 'string', 'max:255'],
        ]);

        $validated['user_id'] = Auth::id();

        Korban::create($validated);

        return redirect()
            ->route('admin.korban.index')
            ->with('success', 'Data korban berhasil ditambahkan');
    }

    /**
     * Display the specified korban.
     */
    public function show(Korban $korban)
    {
        return view('admin.korban.show', compact('korban'));
    }

    /**
     * Show the form for editing the specified korban.
     */
    public function edit(Korban $korban)
    {
        $bencanas = Bencana::orderBy('nama_bencana')->get();
        $jenisKelamin = ['L' => 'Laki-laki', 'P' => 'Perempuan'];
        $statusIdentitas = ['dikenal' => 'Dikenal', 'tidak_dikenal' => 'Tidak Dikenal'];

        return view('admin.korban.edit', compact('korban', 'bencanas', 'jenisKelamin', 'statusIdentitas'));
    }

    /**
     * Update the specified korban.
     */
    public function update(Request $request, Korban $korban)
    {
        $validated = $request->validate([
            'bencana_id' => ['required', 'exists:bencana,id'],
            'nama' => ['nullable', 'string', 'max:255'],
            'jenis_kelamin' => ['required', Rule::in(['L', 'P'])],
            'umur' => ['nullable', 'integer', 'min:0', 'max:150'],
            'status_identitas' => ['required', Rule::in(['dikenal', 'tidak_dikenal'])],
            'lokasi_ditemukan' => ['nullable', 'string'],
            'tanggal_ditemukan' => ['nullable', 'date'],
            'kondisi_awal' => ['nullable', 'string'],
            'foto' => ['nullable', 'string', 'max:255'],
        ]);

        $korban->update($validated);

        return redirect()
            ->route('admin.korban.index')
            ->with('success', 'Data korban berhasil diperbarui');
    }

    /**
     * Remove the specified korban.
     */
    public function destroy(Korban $korban)
    {
        $korban->delete();

        return redirect()
            ->route('admin.korban.index')
            ->with('success', 'Data korban berhasil dihapus');
    }
}
