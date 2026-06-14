<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pemeriksaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemeriksaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Pemeriksaan::with(['korban', 'user']);

        // Filter by korban_id if provided
        if ($request->has('korban_id')) {
            $query->where('korban_id', $request->korban_id);
        }

        // Filter by user_id if provided
        if ($request->has('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        // Filter by date range
        if ($request->has('tanggal_awal') && $request->has('tanggal_akhir')) {
            $query->whereBetween('created_at', [$request->tanggal_awal, $request->tanggal_akhir]);
        }

        $pemeriksaan = $query->orderBy('created_at', 'desc')->paginate($request->get('per_page', 15));

        return response()->json([
            'success' => true,
            'message' => 'Data pemeriksaan berhasil diambil',
            'data' => $pemeriksaan
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'korban_id' => 'required|exists:korban,id',
            'tekanan_darah' => 'required|string|max:20',
            'nadi' => 'required|integer|min:0|max:300',
            'respirasi' => 'required|integer|min:0|max:100',
            'suhu' => 'required|numeric|min:30|max:45',
            'keluhan' => 'nullable|string',
            'diagnosa_awal' => 'nullable|string',
            'tindakan' => 'nullable|string',
        ]);

        $validated['user_id'] = Auth::id();

        $pemeriksaan = Pemeriksaan::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data pemeriksaan berhasil ditambahkan',
            'data' => $pemeriksaan->load(['korban', 'user'])
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pemeriksaan = Pemeriksaan::with(['korban', 'user'])->find($id);

        if (!$pemeriksaan) {
            return response()->json([
                'success' => false,
                'message' => 'Data pemeriksaan tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data pemeriksaan berhasil diambil',
            'data' => $pemeriksaan
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pemeriksaan = Pemeriksaan::find($id);

        if (!$pemeriksaan) {
            return response()->json([
                'success' => false,
                'message' => 'Data pemeriksaan tidak ditemukan'
            ], 404);
        }

        $validated = $request->validate([
            'tekanan_darah' => 'sometimes|required|string|max:20',
            'nadi' => 'sometimes|required|integer|min:0|max:300',
            'respirasi' => 'sometimes|required|integer|min:0|max:100',
            'suhu' => 'sometimes|required|numeric|min:30|max:45',
            'keluhan' => 'nullable|string',
            'diagnosa_awal' => 'nullable|string',
            'tindakan' => 'nullable|string',
        ]);

        $pemeriksaan->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data pemeriksaan berhasil diperbarui',
            'data' => $pemeriksaan->load(['korban', 'user'])
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pemeriksaan = Pemeriksaan::find($id);

        if (!$pemeriksaan) {
            return response()->json([
                'success' => false,
                'message' => 'Data pemeriksaan tidak ditemukan'
            ], 404);
        }

        $pemeriksaan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data pemeriksaan berhasil dihapus'
        ]);
    }
}
