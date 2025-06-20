<?php
// app/Models/Contract.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_id',
        'campaign_id',
        'garage_id',
        'montant_mensuel',
        'date_debut',
        'date_fin',
        'statut',
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function garage()
    {
        return $this->belongsTo(Garage::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
