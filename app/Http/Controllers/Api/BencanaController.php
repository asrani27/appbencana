<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bencana;
use Illuminate\Http\Request;

class BencanaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Bencana::with('korban');

        // Filter by status if provided
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Filter by jenis_bencana if provided
        if ($request->has('jenis_bencana')) {
            $query->where('jenis_bencana', $request->jenis_bencana);
        }

        // Filter by date range
        if ($request->has('tanggal_awal') && $request->has('tanggal_akhir')) {
            $query->whereBetween('tanggal_kejadian', [$request->tanggal_awal, $request->tanggal_akhir]);
        }

        $bencana = $query->orderBy('tanggal_kejadian', 'desc')->paginate($request->get('per_page', 15));

        return response()->json([
            'success' => true,
            'message' => 'Data bencana berhasil diambil',
            'data' => $bencana
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_bencana' => 'required|string|max:255',
            'jenis_bencana' => 'required|string|max:100',
            'lokasi' => 'required|string|max:255',
            'tanggal_kejadian' => 'required|date',
            'status' => 'required|in:aktif,selesai,ditutup',
            'keterangan' => 'nullable|string',
        ]);

        $bencana = Bencana::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data bencana berhasil ditambahkan',
            'data' => $bencana
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $bencana = Bencana::with('korban')->find($id);

        if (!$bencana) {
            return response()->json([
                'success' => false,
                'message' => 'Data bencana tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data bencana berhasil diambil',
            'data' => $bencana
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $bencana = Bencana::find($id);

        if (!$bencana) {
            return response()->json([
                'success' => false,
                'message' => 'Data bencana tidak ditemukan'
            ], 404);
        }

        $validated = $request->validate([
            'nama_bencana' => 'sometimes|required|string|max:255',
            'jenis_bencana' => 'sometimes|required|string|max:100',
            'lokasi' => 'sometimes|required|string|max:255',
            'tanggal_kejadian' => 'sometimes|required|date',
            'status' => 'sometimes|required|in:aktif,selesai,ditutup',
            'keterangan' => 'nullable|string',
        ]);

        $bencana->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data bencana berhasil diperbarui',
            'data' => $bencana
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bencana = Bencana::find($id);

        if (!$bencana) {
            return response()->json([
                'success' => false,
                'message' => 'Data bencana tidak ditemukan'
            ], 404);
        }

        $bencana->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data bencana berhasil dihapus'
        ]);
    }
}
