<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pemeriksaan extends Model
{
    use HasFactory;

    protected $table = 'pemeriksaan';

    protected $fillable = [
        'korban_id',
        'user_id',
        
        // Identitas Pasien
        'no_pasien',
        'nama_pasien',
        'jenis_kelamin',
        'tanggal_lahir',
        'umur',
        'alamat',
        
        // Vital Sign
        'tekanan_darah',
        'nadi',
        'respirasi',
        'suhu',
        'bb',
        'tb',
        
        // Keluhan & Diagnosis
        'keluhan',
        'diagnosa_awal',
        'tindakan',
        
        // Nyeri & Alergi
        'nyeri',
        'skala_nyeri',
        'alergi',
        
        // Pemeriksaan Psikiatri
        'pemeriksaan_psikiatri',
        
        // Jenis Kejadian
        'jenis_bencana',
        'jenis_bencana_lainnya',
        'jenis_cedera',
        'jenis_cedera_afiksia',
        
        // Penemuan & Pelapor
        'tanggal_ditemukan',
        'jam_ditemukan',
        'lokasi_ditemukan',
        'penemu_nama',
        'penemu_umur',
        'penemu_jenis_kelamin',
        'penemu_alamat',
        'penemu_telp',
        
        // Primary Survey
        'pupil',
        'reflek_cahaya',
        'airway',
        'breathing',
        'circulation',
        'disability',
        'eksposure',
        'prehospital',
        
        // Kondisi (Triase)
        'kondisi',
        
        // Anamnesis & Terapi
        'anamnesis',
        'terapi',
        
        // Tindakan Lanjutan
        'tindakan_lanjutan',
        'dipulangkan_status',
        'tanggal_meninggal',
        'jam_meninggal',
        'dirujuk_ke',
        'nama_pengantar',
        'transportasi',
        
        // Petugas
        'petugas_nama',
    ];

    /**
     * Get the korban that owns the Pemeriksaan
     */
    public function korban(): BelongsTo
    {
        return $this->belongsTo(Korban::class);
    }

    /**
     * Get the user that performed the Pemeriksaan
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
