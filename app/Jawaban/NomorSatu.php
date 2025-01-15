<?php

namespace App\Jawaban;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class NomorSatu {

    public function auth(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)
                    ->orWhere('username', $request->email)
                    ->first();

        if (!$user || $request->password !== $user->password){
            return redirect()->back()->withErrors(['login' => 'Invalid email or password']);
        }

        Auth::login($user);

        return redirect()->route('event.home');
    }

    public function logout(Request $request) {

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('event.home');
    }
}
