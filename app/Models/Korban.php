<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Korban extends Model
{
    use HasFactory;

    protected $table = 'korban';

    protected $fillable = [
        'bencana_id',
        'nama',
        'jenis_kelamin',
        'umur',
        'status_identitas',
        'lokasi_ditemukan',
        'tanggal_ditemukan',
        'kondisi_awal',
        'foto',
        'user_id',
    ];

    protected $casts = [
        'tanggal_ditemukan' => 'date',
    ];

    /**
     * Get the bencana that owns the Korban
     */
    public function bencana(): BelongsTo
    {
        return $this->belongsTo(Bencana::class);
    }

    /**
     * Get the lokasi korban associated with the Korban
     */
    public function lokasi(): HasOne
    {
        return $this->hasOne(LokasiKorban::class);
    }

    /**
     * Get all of the triase for the Korban
     */
    public function triase(): HasMany
    {
        return $this->hasMany(Triase::class);
    }

    /**
     * Get all of the pemeriksaan for the Korban
     */
    public function pemeriksaan(): HasMany
    {
        return $this->hasMany(Pemeriksaan::class);
    }

    /**
     * Get all of the rujukan for the Korban
     */
    public function rujukan(): HasMany
    {
        return $this->hasMany(Rujukan::class);
    }
}
