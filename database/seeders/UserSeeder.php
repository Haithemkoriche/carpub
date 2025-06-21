<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Propriétaire
        User::create([
            'name' => 'Ali Propriétaire',
            'email' => 'owner@example.com',
            'password' => Hash::make('password'),
            'role' => 'proprietaire',
        ]);

        // Entreprise + Company
        $entreprise = User::create([
            'name' => 'Entreprise XYZ',
            'email' => 'entreprise@example.com',
            'password' => Hash::make('password'),
            'role' => 'entreprise',
        ]);

        Company::create([
            'user_id' => $entreprise->id,
            'nom' => 'Entreprise XYZ',
            'secteur' => 'Automobile',
            'telephone' => '+213770001122',
        ]);
    }
}
