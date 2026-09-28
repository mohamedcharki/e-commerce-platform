<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminController extends Controller
{
    // Credentials — change these or move to .env
    private $adminEmail    = 'admin@aura.com';
    private $adminPassword = 'password';

    public function index()
    {
        // Pass the API token to the view so JS can use it
        return view('admin.index', [
            'apiToken' => session('admin_api_token', '')
        ]);
    }

    public function login()
    {
        // If already logged in, redirect to admin dashboard
        if (session('admin_logged_in')) {
            return redirect()->route('admin.index');
        }
        return view('admin.login');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if ($request->email === $this->adminEmail && $request->password === $this->adminPassword) {
            // Find or create the admin user record for Sanctum token
            $user = User::where('email', $this->adminEmail)->first();

            if (!$user) {
                $user = User::create([
                    'name'     => 'Admin',
                    'email'    => $this->adminEmail,
                    'password' => Hash::make($this->adminPassword),
                ]);
            }

            // Revoke old admin tokens and create a fresh one
            $user->tokens()->where('name', 'admin-token')->delete();
            $token = $user->createToken('admin-token')->plainTextToken;

            session([
                'admin_logged_in'  => true,
                'admin_email'      => $request->email,
                'admin_api_token'  => $token,
            ]);

            return redirect()->route('admin.index')->with('success', 'Welcome back, Admin!');
        }

        return back()->withErrors(['email' => 'Invalid credentials.'])->withInput();
    }

    public function logout(Request $request)
    {
        // Revoke Sanctum token if we have one stored
        if ($apiToken = session('admin_api_token')) {
            $user = User::where('email', session('admin_email'))->first();
            if ($user) {
                $user->tokens()->where('name', 'admin-token')->delete();
            }
        }

        $request->session()->forget(['admin_logged_in', 'admin_email', 'admin_api_token']);
        return redirect()->route('admin.login')->with('success', 'Logged out successfully.');
    }
}
