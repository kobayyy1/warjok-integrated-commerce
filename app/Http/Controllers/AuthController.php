<?php
// app/Http/Controllers/AuthController.php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }
  

    public function login(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'exists:users,name',
            ],
            'password' => [
                'required',
                'string',
                'min:6',
            ],
        ], [
            'name.required' => 'Username harus diisi.',
            'name.exists' => 'Username tidak ditemukan.',
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password minimal 6 karakter.',
        ]);

        $user = User::where('name', $validated['name'])->first();

        // Validasi password
        if (!$user || !Hash::check($validated['password'], $user->password)) {
            throw ValidationException::withMessages([
                'password' => ['name atau password salah.'],
            ]);
        }

        Auth::login($user, $request->boolean('remember'));

        return redirect()->intended(route('admin.dashboard'))->with('success', 'Selamat datang, ' . $user->name . '!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Anda telah logout.');
    }
}
