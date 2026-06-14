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
        'tekanan_darah',
        'nadi',
        'respirasi',
        'suhu',
        'keluhan',
        'diagnosa_awal',
        'tindakan',
        'user_id',
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
