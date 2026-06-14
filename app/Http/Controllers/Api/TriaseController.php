<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Triase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TriaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Triase::with(['korban', 'user']);

        // Filter by korban_id if provided
        if ($request->has('korban_id')) {
            $query->where('korban_id', $request->korban_id);
        }

        // Filter by kategori if provided
        if ($request->has('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        // Filter by user_id if provided
        if ($request->has('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        $triase = $query->orderBy('created_at', 'desc')->paginate($request->get('per_page', 15));

        return response()->json([
            'success' => true,
            'message' => 'Data triase berhasil diambil',
            'data' => $triase
        ]);
    }

    /**
     * Display triase by the authenticated user.
     */
    public function byUser(Request $request)
    {
        $query = Triase::with(['korban', 'user'])
            ->where('user_id', Auth::id());

        // Filter by korban_id if provided
        if ($request->has('korban_id')) {
            $query->where('korban_id', $request->korban_id);
        }

        // Filter by kategori if provided
        if ($request->has('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        $triase = $query->orderBy('created_at', 'desc')->paginate($request->get('per_page', 15));

        return response()->json([
            'success' => true,
            'message' => 'Data triase berhasil diambil',
            'data' => $triase
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'korban_id' => 'required|exists:korban,id',
            'kategori' => 'required|in:merah,kuning,hijau,hitam',
            'keterangan' => 'nullable|string',
        ]);

        $userId = Auth::id();
        
        // Check if triase for this korban by this user already exists
        $existingTriase = Triase::where('korban_id', $validated['korban_id'])
            ->where('user_id', $userId)
            ->first();
            
        if ($existingTriase) {
            return response()->json([
                'success' => false,
                'message' => 'Data triase untuk korban ini oleh user ini sudah ada'
            ], 422);
        }

        $validated['user_id'] = $userId;

        $triase = Triase::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data triase berhasil ditambahkan',
            'data' => $triase->load(['korban', 'user'])
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $triase = Triase::with(['korban', 'user'])->find($id);

        if (!$triase) {
            return response()->json([
                'success' => false,
                'message' => 'Data triase tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data triase berhasil diambil',
            'data' => $triase
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $triase = Triase::find($id);

        if (!$triase) {
            return response()->json([
                'success' => false,
                'message' => 'Data triase tidak ditemukan'
            ], 404);
        }

        $validated = $request->validate([
            'kategori' => 'sometimes|required|in:merah,kuning,hijau,hitam',
            'keterangan' => 'nullable|string',
        ]);

        $triase->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data triase berhasil diperbarui',
            'data' => $triase->load(['korban', 'user'])
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $triase = Triase::find($id);

        if (!$triase) {
            return response()->json([
                'success' => false,
                'message' => 'Data triase tidak ditemukan'
            ], 404);
        }

        $triase->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data triase berhasil dihapus'
        ]);
    }
}
