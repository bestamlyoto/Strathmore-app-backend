<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnergyInstallation extends Model
{
    use HasFactory;

    protected $fillable = [
        'county_id',
        'energy_type',
        'house_type',
        'energy_capacity',
        'installation_date',
        'is_primary_source',
    ];

    public function county()
    {
        return $this->belongsTo(County::class);
    }
}
