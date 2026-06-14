<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Korban;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KorbanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Korban::with(['bencana', 'lokasi']);

        // Filter by bencana_id if provided
        if ($request->has('bencana_id')) {
            $query->where('bencana_id', $request->bencana_id);
        }

        // Filter by status_identitas if provided
        if ($request->has('status_identitas')) {
            $query->where('status_identitas', $request->status_identitas);
        }

        // Filter by jenis_kelamin if provided
        if ($request->has('jenis_kelamin')) {
            $query->where('jenis_kelamin', $request->jenis_kelamin);
        }

        // Filter by date range
        if ($request->has('tanggal_awal') && $request->has('tanggal_akhir')) {
            $query->whereBetween('tanggal_ditemukan', [$request->tanggal_awal, $request->tanggal_akhir]);
        }

        $korban = $query->orderBy('tanggal_ditemukan', 'desc')->paginate($request->get('per_page', 15));

        return response()->json([
            'success' => true,
            'message' => 'Data korban berhasil diambil',
            'data' => $korban
        ]);
    }

    /**
     * Display korban by the authenticated user.
     */
    public function byUser(Request $request)
    {
        $query = Korban::with(['bencana', 'lokasi'])
            ->where('user_id', Auth::id());

        // Filter by bencana_id if provided
        if ($request->has('bencana_id')) {
            $query->where('bencana_id', $request->bencana_id);
        }

        // Filter by status_identitas if provided
        if ($request->has('status_identitas')) {
            $query->where('status_identitas', $request->status_identitas);
        }

        // Filter by jenis_kelamin if provided
        if ($request->has('jenis_kelamin')) {
            $query->where('jenis_kelamin', $request->jenis_kelamin);
        }

        $korban = $query->orderBy('tanggal_ditemukan', 'desc')->paginate($request->get('per_page', 15));

        return response()->json([
            'success' => true,
            'message' => 'Data korban berhasil diambil',
            'data' => $korban
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'bencana_id' => 'required|exists:bencana,id',
            'nama' => 'nullable|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'umur' => 'nullable|integer|min:0|max:150',
            'status_identitas' => 'required|in:dikenal,tidak_dikenal',
            'lokasi_ditemukan' => 'required|string|max:255',
            'tanggal_ditemukan' => 'required|date',
            'kondisi_awal' => 'nullable|string',
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('foto-korban', 'public');
        }

        $validated['user_id'] = Auth::id();
        $korban = Korban::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data korban berhasil ditambahkan',
            'data' => $korban->load('bencana')
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $korban = Korban::with(['bencana', 'lokasi', 'triase', 'pemeriksaan', 'rujukan'])->find($id);

        if (!$korban) {
            return response()->json([
                'success' => false,
                'message' => 'Data korban tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data korban berhasil diambil',
            'data' => $korban
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $korban = Korban::find($id);

        if (!$korban) {
            return response()->json([
                'success' => false,
                'message' => 'Data korban tidak ditemukan'
            ], 404);
        }

        $validated = $request->validate([
            'bencana_id' => 'sometimes|required|exists:bencana,id',
            'nama' => 'nullable|string|max:255',
            'jenis_kelamin' => 'sometimes|required|in:L,P',
            'umur' => 'nullable|integer|min:0|max:150',
            'status_identitas' => 'sometimes|required|in:dikenal,tidak_dikenal',
            'lokasi_ditemukan' => 'sometimes|required|string|max:255',
            'tanggal_ditemukan' => 'sometimes|required|date',
            'kondisi_awal' => 'nullable|string',
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('foto-korban', 'public');
        }

        $korban->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data korban berhasil diperbarui',
            'data' => $korban->load('bencana')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $korban = Korban::find($id);

        if (!$korban) {
            return response()->json([
                'success' => false,
                'message' => 'Data korban tidak ditemukan'
            ], 404);
        }

        $korban->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data korban berhasil dihapus'
        ]);
    }
}
