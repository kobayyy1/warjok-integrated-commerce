<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class userAuthController extends Controller
{
    /**
     * Tampilkan halaman login
     */
    public function showLogin()
    {
        // Jika sudah login, redirect ke dashboard
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('auth.userlogin');
    }

    /**
     * Proses login
     */
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => [
                'required',
                'email',
            ],
            'password' => [
                'required',
                'string',
            ],
        ], [
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password harus diisi.',
        ]);

        // Coba login
        if (Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']], $request->boolean('remember'))) {
            $request->session()->regenerate();
            
            return redirect()->route('home')->with('success', 'Selamat datang, ' . Auth::user()->name . '!');
        }

        // Jika gagal
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    /**
     * Tampilkan halaman register
     */
    public function showRegister()
    {
        // Jika sudah login, redirect ke dashboard
        if (Auth::check()) {
            return redirect()->route('home');
        }

        // Get active stores untuk pilihan saat register
        $stores = Store::where('is_active', true)->get();
        
        return view('auth.register', compact('stores'));
    }

    /**
     * Proses register
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'min:3',
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],
            'password' => [
                'required',
                'confirmed',
                'min:6',
            ],
            'store_id' => [
                'nullable',
                'exists:stores,id',
            ],
        ], [
            'name.required' => 'Nama harus diisi.',
            'name.min' => 'Nama minimal 3 karakter.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password harus diisi.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.min' => 'Password minimal 6 karakter.',
            'store_id.exists' => 'Store tidak valid.',
        ]);

        // Create user dengan role default 'staff'
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'store_id' => $validated['store_id'] ?? null,
            'role' => 'staff', // Default role untuk user baru
        ]);

        // Auto login setelah register
        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('home')->with('success', 'Registrasi berhasil! Selamat datang, ' . $user->name . '!');
    }

    /**
     * Logout user
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Anda telah logout.');
    }
}