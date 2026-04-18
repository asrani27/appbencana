<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LogAktivitas extends Model
{
    use HasFactory;

    protected $table = 'log_aktivitas';

    protected $fillable = [
        'user_id',
        'aktivitas',
        'waktu',
    ];

    protected $casts = [
        'waktu' => 'datetime',
    ];

    /**
     * Get the user that owns the LogAktivitas
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
