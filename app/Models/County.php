<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class County extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'x_coord', 'y_coord'];

    public function installations()
    {
        return $this->hasMany(EnergyInstallation::class);
    }
}
