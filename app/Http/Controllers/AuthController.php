<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{


public function showRegisterForm() {

    return view('auth.register');

}

public function register(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed'
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $user->assignRole('user');

        Auth::login($user);

        return redirect()->route('home');
}

public function showLoginForm() {

    return view('auth.login');

}

public function login(Request $request)
{
       $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);



if (Auth::attempt($credentials)) {
    if (auth()->user()->is_blocked) {
        Auth::logout(); // log out the blocked user
        return back()->withErrors([
            'email' => 'Your account is blocked.',
        ]);
    }

        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ]);



}
}

 public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

public function forgot(){

    return view('auth.forgot');

}


}
