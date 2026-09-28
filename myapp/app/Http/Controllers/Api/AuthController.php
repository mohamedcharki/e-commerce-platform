<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Client;

class AuthController extends Controller
{
    public function loginAdmin(Request $request)
    {
        $request->validate(['email' => 'required', 'password' => 'required']);
        $user = User::where('email', $request->email)->first();
        
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
        
        $token = $user->createToken('admin-token')->plainTextToken;
        return response()->json(['token' => $token, 'user' => $user]);
    }

    public function loginClient(Request $request)
    {
        $request->validate(['email' => 'required', 'password' => 'required']);
        $client = Client::where('email', $request->email)->first();
        
        if (!$client || !Hash::check($request->password, $client->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
        
        $token = $client->createToken('client-token')->plainTextToken;
        return response()->json(['token' => $token, 'client' => $client]);
    }

    public function registerClient(Request $request)
    {
        $request->validate([
            'nom' => 'required', 
            'prenom' => 'required', 
            'email' => 'required|email|unique:clients', 
            'password' => 'required|min:6'
        ]);
        
        $client = Client::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'statut' => 1
        ]);
        
        $token = $client->createToken('client-token')->plainTextToken;
        return response()->json(['token' => $token, 'client' => $client], 201);
    }
}
