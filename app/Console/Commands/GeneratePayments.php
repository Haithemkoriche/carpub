<?php
// app/Console/Commands/GeneratePayments.php

namespace App\Console\Commands;

use App\Models\Contract;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Console\Command;

class GeneratePayments extends Command
{
    protected $signature = 'payments:generate';
    protected $description = 'Generate monthly payments for active contracts';

    public function handle()
    {
        $currentMonth = Carbon::now()->format('Y-m');
        $activeContracts = Contract::where('statut', 'actif')
            ->where('date_debut', '<=', Carbon::now())
            ->where('date_fin', '>=', Carbon::now())
            ->get();

        $generated = 0;

        foreach ($activeContracts as $contract) {
            // Check if payment already exists for this month
            $existingPayment = Payment::where('contract_id', $contract->id)
                ->where('mois', $currentMonth)
                ->first();

            if (!$existingPayment) {
                Payment::create([
                    'contract_id' => $contract->id,
                    'mois' => $currentMonth,
                    'montant' => $contract->montant_mensuel,
                    'status' => 'en_attente',
                ]);
                $generated++;
            }
        }

        $this->info("Generated {$generated} payments for {$currentMonth}");
    }
}
