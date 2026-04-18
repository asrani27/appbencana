<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RumahSakit;
use Illuminate\Http\Request;

class RumahSakitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = RumahSakit::with('rujukan');

        // Filter by nama if provided (search)
        if ($request->has('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        // Filter by availability (kapasitas > 0)
        if ($request->has('tersedia') && $request->tersedia) {
            $query->where('kapasitas_igd', '>', 0);
        }

        $rumahSakit = $query->orderBy('nama')->paginate($request->get('per_page', 15));

        return response()->json([
            'success' => true,
            'message' => 'Data rumah sakit berhasil diambil',
            'data' => $rumahSakit
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:500',
            'no_hp' => 'required|string|max:20',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'kapasitas_igd' => 'required|integer|min:0',
        ]);

        $rumahSakit = RumahSakit::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data rumah sakit berhasil ditambahkan',
            'data' => $rumahSakit
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rumahSakit = RumahSakit::with('rujukan')->find($id);

        if (!$rumahSakit) {
            return response()->json([
                'success' => false,
                'message' => 'Data rumah sakit tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data rumah sakit berhasil diambil',
            'data' => $rumahSakit
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rumahSakit = RumahSakit::find($id);

        if (!$rumahSakit) {
            return response()->json([
                'success' => false,
                'message' => 'Data rumah sakit tidak ditemukan'
            ], 404);
        }

        $validated = $request->validate([
            'nama' => 'sometimes|required|string|max:255',
            'alamat' => 'sometimes|required|string|max:500',
            'no_hp' => 'sometimes|required|string|max:20',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'kapasitas_igd' => 'sometimes|required|integer|min:0',
        ]);

        $rumahSakit->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data rumah sakit berhasil diperbarui',
            'data' => $rumahSakit
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rumahSakit = RumahSakit::find($id);

        if (!$rumahSakit) {
            return response()->json([
                'success' => false,
                'message' => 'Data rumah sakit tidak ditemukan'
            ], 404);
        }

        // Check if rumah sakit has related rujukan
        if ($rumahSakit->rujukan()->count() > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Data rumah sakit tidak dapat dihapus karena memiliki data rujukan'
            ], 400);
        }

        $rumahSakit->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data rumah sakit berhasil dihapus'
        ]);
    }

    /**
     * Get nearby rumah sakit based on coordinates.
     */
    public function nearby(Request $request)
    {
        $request->validate([
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'radius' => 'nullable|integer|min:1|max:100', // in kilometers
        ]);

        $latitude = $request->latitude;
        $longitude = $request->longitude;
        $radius = $request->get('radius', 50); // default 50km

        // Calculate distance using Haversine formula (simplified)
        $rumahSakit = RumahSakit::selectRaw("*, (6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance", [$latitude, $longitude, $latitude])
            ->having('distance', '<=', $radius)
            ->orderBy('distance')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Data rumah sakit terdekat berhasil diambil',
            'data' => $rumahSakit
        ]);
    }
}
