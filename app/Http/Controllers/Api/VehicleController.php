<?php
// app/Http/Controllers/Api/VehicleController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class VehicleController extends Controller
{
    public function index(Request $request)
    {
        if ($request->user()->isAdmin()) {
            $vehicles = Vehicle::with('user')->get();
        } else {
            $vehicles = $request->user()->vehicles;
        }

        return response()->json($vehicles);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'marque' => 'required|string|max:255',
            'modele' => 'required|string|max:255',
            'immatriculation' => 'required|string|max:20|unique:vehicles',
            'photo' => 'nullable|image|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('vehicles', 'public');
        }

        $vehicle = Vehicle::create([
            'user_id' => $request->user()->id,
            'marque' => $request->marque,
            'modele' => $request->modele,
            'immatriculation' => $request->immatriculation,
            'photo' => $photoPath,
        ]);

        return response()->json($vehicle, 201);
    }

    public function show(Vehicle $vehicle)
    {
        return response()->json($vehicle->load('user', 'contracts.campaign'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        // Only admin can update vehicle status
        if ($request->user()->isAdmin() && $request->has('status')) {
            $vehicle->update(['status' => $request->status]);
        }

        return response()->json($vehicle);
    }

    public function destroy(Vehicle $vehicle)
    {
        if ($vehicle->photo) {
            Storage::disk('public')->delete($vehicle->photo);
        }
        
        $vehicle->delete();

        return response()->json(['message' => 'Vehicle deleted successfully']);
    }

    public function pendingVehicles()
    {
        $vehicles = Vehicle::with('user')
            ->where('status', 'en_attente')
            ->get();

        return response()->json($vehicles);
    }

    public function validateVehicle(Request $request, Vehicle $vehicle)
    {
        $vehicle->update(['status' => 'valide']);

        return response()->json($vehicle);
    }
}
