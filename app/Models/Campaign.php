<?php
// app/Models/Campaign.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'nom',
        'budget',
        'duree',
        'description',
        'image_design',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

    public function vehicles()
    {
        return $this->hasManyThrough(Vehicle::class, Contract::class);
    }
}
