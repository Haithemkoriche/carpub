<?php
// app/Models/Garage.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Garage extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'adresse',
        'ville',
        'telephone',
    ];

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }
}
