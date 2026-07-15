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
        $query = Pemeriksaan::with(['korban', 'user']);

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
            
            // Identitas Pasien
            'no_pasien' => ['nullable', 'string', 'max:50'],
            'nama_pasien' => ['nullable', 'string', 'max:100'],
            'jenis_kelamin' => ['nullable', 'string', 'max:20'],
            'tanggal_lahir' => ['nullable', 'date'],
            'umur' => ['nullable', 'integer', 'min:0', 'max:150'],
            'alamat' => ['nullable', 'string'],
            
            // Vital Sign
            'tekanan_darah' => ['nullable', 'string', 'max:20'],
            'nadi' => ['nullable', 'string', 'max:10'],
            'respirasi' => ['nullable', 'string', 'max:10'],
            'suhu' => ['nullable', 'numeric', 'min:0', 'max:50'],
            'bb' => ['nullable', 'numeric', 'min:0', 'max:500'],
            'tb' => ['nullable', 'numeric', 'min:0', 'max:300'],
            
            // Nyeri & Alergi
            'nyeri' => ['nullable', 'string', 'max:10'],
            'skala_nyeri' => ['nullable', 'string', 'max:20'],
            'alergi' => ['nullable', 'string', 'max:255'],
            
            // Pemeriksaan Psikiatri
            'pemeriksaan_psikiatri' => ['nullable', 'string'],
            
            // Jenis Kejadian
            'jenis_bencana' => ['nullable'],
            'jenis_bencana_lainnya' => ['nullable', 'string', 'max:100'],
            'jenis_cedera' => ['nullable'],
            'jenis_cedera_afiksia' => ['nullable', 'string', 'max:100'],
            
            // Penemuan & Pelapor
            'tanggal_ditemukan' => ['nullable', 'date'],
            'jam_ditemukan' => ['nullable'],
            'lokasi_ditemukan' => ['nullable', 'string', 'max:255'],
            'penemu_nama' => ['nullable', 'string', 'max:100'],
            'penemu_umur' => ['nullable', 'integer', 'min:0', 'max:150'],
            'penemu_jenis_kelamin' => ['nullable', 'string', 'max:20'],
            'penemu_alamat' => ['nullable', 'string'],
            'penemu_telp' => ['nullable', 'string', 'max:20'],
            
            // Primary Survey
            'pupil' => ['nullable', 'string', 'max:20'],
            'reflek_cahaya' => ['nullable', 'string', 'max:100'],
            'airway' => ['nullable'],
            'breathing' => ['nullable'],
            'circulation' => ['nullable'],
            'disability' => ['nullable'],
            'eksposure' => ['nullable'],
            'prehospital' => ['nullable'],
            
            // Kondisi (Triase)
            'kondisi' => ['nullable', 'string', 'max:5'],
            
            // Diagnosis & Tindakan
            'diagnosa_awal' => ['nullable', 'string'],
            'tindakan' => ['nullable', 'string'],
            'anamnesis' => ['nullable', 'string'],
            'terapi' => ['nullable', 'string'],
            
            // Tindakan Lanjutan
            'tindakan_lanjutan' => ['nullable', 'string', 'max:50'],
            'dipulangkan_status' => ['nullable'],
            'tanggal_meninggal' => ['nullable', 'date'],
            'jam_meninggal' => ['nullable'],
            'dirujuk_ke' => ['nullable', 'string', 'max:255'],
            'nama_pengantar' => ['nullable', 'string', 'max:100'],
            'transportasi' => ['nullable', 'string', 'max:50'],
            
            // Petugas
            'petugas_nama' => ['nullable', 'string', 'max:100'],
        ]);

        $validated['user_id'] = auth()->id();

        // Handle JSON fields
        $jsonFields = ['airway', 'breathing', 'circulation', 'disability', 'eksposure', 'prehospital', 'dipulangkan_status', 'jenis_bencana', 'jenis_cedera'];
        foreach ($jsonFields as $field) {
            if (isset($validated[$field]) && is_array($validated[$field])) {
                $validated[$field] = json_encode($validated[$field]);
            } else {
                $validated[$field] = null;
            }
        }

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
        return view('admin.pemeriksaan.edit', compact('pemeriksaan', 'korban'));
    }

    /**
     * Update the specified pemeriksaan.
     */
    public function update(Request $request, Pemeriksaan $pemeriksaan)
    {
        $validated = $request->validate([
            'korban_id' => ['required', 'exists:korban,id'],
            
            // Identitas Pasien
            'no_pasien' => ['nullable', 'string', 'max:50'],
            'nama_pasien' => ['nullable', 'string', 'max:100'],
            'jenis_kelamin' => ['nullable', 'string', 'max:20'],
            'tanggal_lahir' => ['nullable', 'date'],
            'umur' => ['nullable', 'integer', 'min:0', 'max:150'],
            'alamat' => ['nullable', 'string'],
            
            // Vital Sign
            'tekanan_darah' => ['nullable', 'string', 'max:20'],
            'nadi' => ['nullable', 'string', 'max:10'],
            'respirasi' => ['nullable', 'string', 'max:10'],
            'suhu' => ['nullable', 'numeric', 'min:0', 'max:50'],
            'bb' => ['nullable', 'numeric', 'min:0', 'max:500'],
            'tb' => ['nullable', 'numeric', 'min:0', 'max:300'],
            
            // Nyeri & Alergi
            'nyeri' => ['nullable', 'string', 'max:10'],
            'skala_nyeri' => ['nullable', 'string', 'max:20'],
            'alergi' => ['nullable', 'string', 'max:255'],
            
            // Pemeriksaan Psikiatri
            'pemeriksaan_psikiatri' => ['nullable', 'string'],
            
            // Jenis Kejadian
            'jenis_bencana' => ['nullable'],
            'jenis_bencana_lainnya' => ['nullable', 'string', 'max:100'],
            'jenis_cedera' => ['nullable'],
            'jenis_cedera_afiksia' => ['nullable', 'string', 'max:100'],
            
            // Penemuan & Pelapor
            'tanggal_ditemukan' => ['nullable', 'date'],
            'jam_ditemukan' => ['nullable'],
            'lokasi_ditemukan' => ['nullable', 'string', 'max:255'],
            'penemu_nama' => ['nullable', 'string', 'max:100'],
            'penemu_umur' => ['nullable', 'integer', 'min:0', 'max:150'],
            'penemu_jenis_kelamin' => ['nullable', 'string', 'max:20'],
            'penemu_alamat' => ['nullable', 'string'],
            'penemu_telp' => ['nullable', 'string', 'max:20'],
            
            // Primary Survey
            'pupil' => ['nullable', 'string', 'max:20'],
            'reflek_cahaya' => ['nullable', 'string', 'max:100'],
            'airway' => ['nullable'],
            'breathing' => ['nullable'],
            'circulation' => ['nullable'],
            'disability' => ['nullable'],
            'eksposure' => ['nullable'],
            'prehospital' => ['nullable'],
            
            // Kondisi (Triase)
            'kondisi' => ['nullable', 'string', 'max:5'],
            
            // Diagnosis & Tindakan
            'diagnosa_awal' => ['nullable', 'string'],
            'tindakan' => ['nullable', 'string'],
            'anamnesis' => ['nullable', 'string'],
            'terapi' => ['nullable', 'string'],
            
            // Tindakan Lanjutan
            'tindakan_lanjutan' => ['nullable', 'string', 'max:50'],
            'dipulangkan_status' => ['nullable'],
            'tanggal_meninggal' => ['nullable', 'date'],
            'jam_meninggal' => ['nullable'],
            'dirujuk_ke' => ['nullable', 'string', 'max:255'],
            'nama_pengantar' => ['nullable', 'string', 'max:100'],
            'transportasi' => ['nullable', 'string', 'max:50'],
            
            // Petugas
            'petugas_nama' => ['nullable', 'string', 'max:100'],
        ]);

        // Handle JSON fields
        $jsonFields = ['airway', 'breathing', 'circulation', 'disability', 'eksposure', 'prehospital', 'dipulangkan_status', 'jenis_bencana', 'jenis_cedera'];
        foreach ($jsonFields as $field) {
            if (isset($validated[$field]) && is_array($validated[$field])) {
                $validated[$field] = json_encode($validated[$field]);
            } else {
                $validated[$field] = null;
            }
        }

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
