<?php
// app/Http/Controllers/Api/CampaignController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CampaignController extends Controller
{
    public function index(Request $request)
    {
        if ($request->user()->isAdmin()) {
            $campaigns = Campaign::with('company')->get();
        } elseif ($request->user()->isEntreprise()) {
            $company = $request->user()->company;
            $campaigns = $company ? $company->campaigns : collect();
        } else {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json($campaigns);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_id' => 'required|exists:companies,id',
            'nom' => 'required|string|max:255',
            'budget' => 'required|numeric|min:0',
            'duree' => 'required|integer|min:1',
            'description' => 'required|string',
            'image_design' => 'nullable|image|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $imagePath = null;
        if ($request->hasFile('image_design')) {
            $imagePath = $request->file('image_design')->store('campaigns', 'public');
        }

        $campaign = Campaign::create([
            'company_id' => $request->company_id,
            'nom' => $request->nom,
            'budget' => $request->budget,
            'duree' => $request->duree,
            'description' => $request->description,
            'image_design' => $imagePath,
        ]);

        return response()->json($campaign->load('company'), 201);
    }

    public function show(Campaign $campaign)
    {
        return response()->json($campaign->load('company', 'contracts.vehicle'));
    }

    public function update(Request $request, Campaign $campaign)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'sometimes|string|max:255',
            'budget' => 'sometimes|numeric|min:0',
            'duree' => 'sometimes|integer|min:1',
            'description' => 'sometimes|string',
            'image_design' => 'nullable|image|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if ($request->hasFile('image_design')) {
            if ($campaign->image_design) {
                Storage::disk('public')->delete($campaign->image_design);
            }
            $campaign->image_design = $request->file('image_design')->store('campaigns', 'public');
        }

        $campaign->update($request->only(['nom', 'budget', 'duree', 'description']));

        return response()->json($campaign);
    }

    public function destroy(Campaign $campaign)
    {
        if ($campaign->image_design) {
            Storage::disk('public')->delete($campaign->image_design);
        }
        
        $campaign->delete();

        return response()->json(['message' => 'Campaign deleted successfully']);
    }

    public function getCompanies()
    {
        $companies = Company::with('user')->get();
        return response()->json($companies);
    }
}
