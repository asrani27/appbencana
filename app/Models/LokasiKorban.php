<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LokasiKorban extends Model
{
    use HasFactory;

    protected $table = 'lokasi_korban';

    protected $fillable = [
        'korban_id',
        'latitude',
        'longitude',
    ];

    /**
     * Get the korban that owns the LokasiKorban
     */
    public function korban(): BelongsTo
    {
        return $this->belongsTo(Korban::class);
    }
}
