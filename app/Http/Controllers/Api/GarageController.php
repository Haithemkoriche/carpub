<?php
// app/Http/Controllers/Api/GarageController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Garage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GarageController extends Controller
{
    public function index()
    {
        $garages = Garage::all();
        return response()->json($garages);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'ville' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $garage = Garage::create($request->all());

        return response()->json($garage, 201);
    }

    public function show(Garage $garage)
    {
        return response()->json($garage->load('contracts'));
    }

    public function update(Request $request, Garage $garage)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'sometimes|string|max:255',
            'adresse' => 'sometimes|string|max:255',
            'ville' => 'sometimes|string|max:255',
            'telephone' => 'sometimes|string|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $garage->update($request->all());

        return response()->json($garage);
    }

    public function destroy(Garage $garage)
    {
        $garage->delete();
        return response()->json(['message' => 'Garage deleted successfully']);
    }
}
