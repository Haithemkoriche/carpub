<?php
// app/Http/Controllers/Api/ContractController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;

class ContractController extends Controller
{
    public function index(Request $request)
    {
        if ($request->user()->isAdmin()) {
            $contracts = Contract::with(['vehicle.user', 'campaign.company', 'garage'])->get();
        } elseif ($request->user()->isProprietaire()) {
            $contracts = Contract::with(['vehicle', 'campaign.company', 'garage', 'payments'])
                ->whereHas('vehicle', function ($query) use ($request) {
                    $query->where('user_id', $request->user()->id);
                })->get();
        } else {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json($contracts);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vehicle_id' => 'required|exists:vehicles,id',
            'campaign_id' => 'required|exists:campaigns,id',
            'garage_id' => 'required|exists:garages,id',
            'montant_mensuel' => 'required|numeric|min:0',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after:date_debut',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $contract = Contract::create($request->all());

        return response()->json($contract->load(['vehicle.user', 'campaign.company', 'garage']), 201);
    }

    public function show(Contract $contract)
    {
        return response()->json($contract->load(['vehicle.user', 'campaign.company', 'garage', 'payments']));
    }

    public function update(Request $request, Contract $contract)
    {
        $validator = Validator::make($request->all(), [
            'montant_mensuel' => 'sometimes|numeric|min:0',
            'date_debut' => 'sometimes|date',
            'date_fin' => 'sometimes|date|after:date_debut',
            'statut' => 'sometimes|in:actif,termine,suspendu',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $contract->update($request->all());

        return response()->json($contract);
    }

    public function destroy(Contract $contract)
    {
        $contract->delete();
        return response()->json(['message' => 'Contract deleted successfully']);
    }

    public function generatePdf(Contract $contract)
    {
        $contract->load(['vehicle.user', 'campaign.company', 'garage']);

        $pdf = Pdf::loadView('contracts.pdf', compact('contract'));

        return $pdf->download('contrat-' . $contract->id . '.pdf');
    }
}
