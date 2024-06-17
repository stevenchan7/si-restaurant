<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'max:255']
        ]);
     
        if (Auth::attempt($validated)) {
            $request->session()->regenerate();
            $user = Auth::user();
        
            if ($user->hasRole('1')) {
                return redirect()->intended('admin/dashboard');
            } elseif ($user->hasRole('2')) {
                return redirect()->intended('customer/dashboard');
            } elseif ($user->hasRole('3')) {
                return redirect()->intended('pegawai/dashboard');
            }
            else {
                return back()->withErrors(['credential' => 'No user found']);
            }
        }else{
            return back()->withErrors(['credential' => 'Incorrect password or mail']);
        }
    }
}
