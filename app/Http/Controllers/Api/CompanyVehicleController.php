<?php
// app/Http/Controllers/Api/CompanyVehicleController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class CompanyVehicleController extends Controller
{
    public function index(Request $request)
    {
        $company = $request->user()->company;
        
        if (!$company) {
            return response()->json(['message' => 'Company not found'], 404);
        }

        $vehicles = Vehicle::with(['user', 'contracts.campaign'])
            ->whereHas('contracts.campaign', function ($query) use ($company) {
                $query->where('company_id', $company->id);
            })
            ->get();

        return response()->json($vehicles);
    }
}
