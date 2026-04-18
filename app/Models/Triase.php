<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Triase extends Model
{
    use HasFactory;

    protected $table = 'triase';

    protected $fillable = [
        'korban_id',
        'kategori',
        'keterangan',
        'created_by',
    ];

    /**
     * Get the korban that owns the Triase
     */
    public function korban(): BelongsTo
    {
        return $this->belongsTo(Korban::class);
    }

    /**
     * Get the user that created the Triase
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
