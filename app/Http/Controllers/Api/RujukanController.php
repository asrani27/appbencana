<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Rujukan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RujukanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Rujukan::with(['korban', 'rumahSakit']);

        // Filter by korban_id if provided
        if ($request->has('korban_id')) {
            $query->where('korban_id', $request->korban_id);
        }

        // Filter by rumah_sakit_id if provided
        if ($request->has('rumah_sakit_id')) {
            $query->where('rumah_sakit_id', $request->rumah_sakit_id);
        }

        // Filter by status if provided
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Filter by date range
        if ($request->has('tanggal_awal') && $request->has('tanggal_akhir')) {
            $query->whereBetween('waktu_rujuk', [$request->tanggal_awal, $request->tanggal_akhir]);
        }

        $rujukan = $query->orderBy('waktu_rujuk', 'desc')->paginate($request->get('per_page', 15));

        return response()->json([
            'success' => true,
            'message' => 'Data rujukan berhasil diambil',
            'data' => $rujukan
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'korban_id' => 'required|exists:korban,id',
            'rumah_sakit_id' => 'required|exists:rumah_sakit,id',
            'status' => 'required|in:dirujuk,diterima,selesai',
            'waktu_rujuk' => 'required|date',
            'catatan' => 'nullable|string',
        ]);

        $validated['user_id'] = Auth::id();
        $rujukan = Rujukan::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data rujukan berhasil ditambahkan',
            'data' => $rujukan->load(['korban', 'rumahSakit'])
        ], 201);
    }

    /**
     * Display rujukan by the authenticated user.
     */
    public function byUser(Request $request)
    {
        $query = Rujukan::with(['korban', 'rumahSakit'])
            ->where('user_id', Auth::id());

        // Filter by korban_id if provided
        if ($request->has('korban_id')) {
            $query->where('korban_id', $request->korban_id);
        }

        // Filter by status if provided
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $rujukan = $query->orderBy('waktu_rujuk', 'desc')->paginate($request->get('per_page', 15));

        return response()->json([
            'success' => true,
            'message' => 'Data rujukan berhasil diambil',
            'data' => $rujukan
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rujukan = Rujukan::with(['korban', 'rumahSakit'])->find($id);

        if (!$rujukan) {
            return response()->json([
                'success' => false,
                'message' => 'Data rujukan tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data rujukan berhasil diambil',
            'data' => $rujukan
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rujukan = Rujukan::find($id);

        if (!$rujukan) {
            return response()->json([
                'success' => false,
                'message' => 'Data rujukan tidak ditemukan'
            ], 404);
        }

        $validated = $request->validate([
            'rumah_sakit_id' => 'sometimes|required|exists:rumah_sakit,id',
            'status' => 'sometimes|required|in:dirujuk,diterima,selesai',
            'waktu_rujuk' => 'sometimes|required|date',
            'catatan' => 'nullable|string',
        ]);

        $rujukan->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data rujukan berhasil diperbarui',
            'data' => $rujukan->load(['korban', 'rumahSakit'])
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rujukan = Rujukan::find($id);

        if (!$rujukan) {
            return response()->json([
                'success' => false,
                'message' => 'Data rujukan tidak ditemukan'
            ], 404);
        }

        $rujukan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data rujukan berhasil dihapus'
        ]);
    }
}
