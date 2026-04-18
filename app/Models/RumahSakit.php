<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RumahSakit extends Model
{
    use HasFactory;

    protected $table = 'rumah_sakit';

    /**
     * Get the route key for the model.
     * Used for implicit route model binding.
     */
    public function getRouteKeyName(): string
    {
        return 'id';
    }

    protected $fillable = [
        'nama',
        'alamat',
        'no_hp',
        'latitude',
        'longitude',
        'kapasitas_igd',
    ];

    /**
     * Get all of the rujukan for the RumahSakit
     */
    public function rujukan(): HasMany
    {
        return $this->hasMany(Rujukan::class);
    }
}
