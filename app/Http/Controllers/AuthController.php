<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order; // Ensure you have this model

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            $user = Auth::user();

            // --- GUEST ORDER LINKER ---
            // Automatically link any guest orders with this email to this user account
            Order::where('guest_email', $user->email)
                 ->whereNull('user_id')
                 ->update(['user_id' => $user->id]);
            // --------------------------

            if ($user->role === 'admin') {
                return redirect()->intended('/admin/dashboard')
                    ->with('welcome', 'Welcome back, Admin!');
            }

            if ($user->role === 'supplier') {
                return redirect()->intended('/supplier/inventory')
                    ->with('welcome', 'Welcome back, Partner!');
            }

            return redirect()->intended('/')
                ->with('welcome', 'Successfully logged in!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
