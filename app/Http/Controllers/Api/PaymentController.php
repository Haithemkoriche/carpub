<?php
// app/Http/Controllers/Api/PaymentController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Contract;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->user()->isAdmin()) {
            $payments = Payment::with(['contract.vehicle.user', 'contract.campaign'])->get();
        } elseif ($request->user()->isProprietaire()) {
            $payments = Payment::with(['contract.vehicle', 'contract.campaign'])
                ->whereHas('contract.vehicle', function ($query) use ($request) {
                    $query->where('user_id', $request->user()->id);
                })->get();
        } else {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json($payments);
    }

    public function show(Payment $payment)
    {
        return response()->json($payment->load(['contract.vehicle.user', 'contract.campaign']));
    }

    public function update(Request $request, Payment $payment)
    {
        $payment->update(['status' => $request->status]);
        return response()->json($payment);
    }

    public function getByContract(Contract $contract)
    {
        $payments = $contract->payments;
        return response()->json($payments);
    }
}
