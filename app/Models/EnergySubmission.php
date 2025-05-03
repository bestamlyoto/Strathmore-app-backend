<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnergySubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'county_id', 'energy_type_id',
        'house_type', 'energy_capacity', 'installation_date', 'is_primary'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function county()
    {
        return $this->belongsTo(County::class);
    }

    public function energyType()
    {
        return $this->belongsTo(EnergyType::class);
    }
}
