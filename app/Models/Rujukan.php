<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rujukan extends Model
{
    use HasFactory;

    protected $table = 'rujukan';

    protected $fillable = [
        'korban_id',
        'rumah_sakit_id',
        'status',
        'waktu_rujuk',
        'catatan',
        'user_id',
    ];

    protected $casts = [
        'waktu_rujuk' => 'datetime',
    ];

    /**
     * Get the korban that owns the Rujukan
     */
    public function korban(): BelongsTo
    {
        return $this->belongsTo(Korban::class);
    }

    /**
     * Get the rumah sakit that owns the Rujukan
     */
    public function rumahSakit(): BelongsTo
    {
        return $this->belongsTo(RumahSakit::class);
    }

    /**
     * Get the user that owns the Rujukan
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
