<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;

class ClientSeeder extends Seeder
{
    public function run()
    {
        Client::updateOrCreate(
            ['email' => 'demo@example.com'],
            [
                'nom' => 'Doe',
                'prenom' => 'John',
                'phone' => '1234567890',
                'ville' => 'New York',
                'statut' => 1,
                'password' => Hash::make('password')
            ]
        );
    }
}
