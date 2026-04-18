<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bencana extends Model
{
    use HasFactory;

    protected $table = 'bencana';

    protected $fillable = [
        'nama_bencana',
        'jenis_bencana',
        'lokasi',
        'tanggal_kejadian',
        'status',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_kejadian' => 'date',
    ];

    /**
     * Get all of the korban for the Bencana
     */
    public function korban(): HasMany
    {
        return $this->hasMany(Korban::class);
    }
}
