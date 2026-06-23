<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Mahasiswa;

class AuthController extends Controller
{
    /**
     * Tampilkan form login.
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Proses login.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate(
            [
                'email'    => 'required|email',
                'password' => 'required',
            ],
            [
                'email.required'    => 'Email tidak boleh dikosongkan',
                'email.email'       => 'Format email tidak valid',
                'password.required' => 'Password tidak boleh dikosongkan',
            ]
        );

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->isAdmin()) {
                return redirect()->intended(route('dashboard.admin'))->with('success', 'Selamat datang, ' . $user->name . '!');
            }

            return redirect()->intended(route('dashboard.mahasiswa'))->with('success', 'Selamat datang, ' . $user->name . '!');
        }

        return back()->withErrors([
            'email' => 'Email atau password yang dimasukkan salah.',
        ])->onlyInput('email');
    }

    /**
     * Tampilkan form registrasi (khusus mahasiswa).
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Proses registrasi mahasiswa.
     * NPM yang diinput wajib sudah ada di tabel mahasiswa (didaftarkan admin)
     * dan belum pernah dipakai untuk akun lain.
     */
    public function register(Request $request)
    {
        $validated = $request->validate(
            [
                'npm'      => [
                    'required',
                    'max:10',
                    Rule::exists('mahasiswa', 'npm'),
                    Rule::unique('users', 'npm'),
                ],
                'name'     => 'required|min:3|max:50',
                'email'    => 'required|email|unique:users,email',
                'password' => 'required|min:6|confirmed',
            ],
            [
                'npm.required'    => 'NPM tidak boleh dikosongkan',
                'npm.exists'      => 'NPM tidak ditemukan pada data mahasiswa. Hubungi admin untuk didaftarkan terlebih dahulu',
                'npm.unique'      => 'NPM ini sudah terdaftar dan memiliki akun',
                'name.required'   => 'Nama tidak boleh dikosongkan',
                'name.min'        => 'Nama terlalu pendek, minimal 3 karakter',
                'email.required'  => 'Email tidak boleh dikosongkan',
                'email.email'     => 'Format email tidak valid',
                'email.unique'    => 'Email sudah digunakan',
                'password.required'  => 'Password tidak boleh dikosongkan',
                'password.min'       => 'Password minimal 6 karakter',
                'password.confirmed' => 'Konfirmasi password tidak cocok',
            ]
        );

        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role'     => 'mahasiswa',
            'npm'      => $validated['npm'],
        ]);

        Auth::login($user);

        return redirect()->route('dashboard.mahasiswa')->with('success', 'Registrasi berhasil! Selamat datang, ' . $user->name . '.');
    }

    /**
     * Proses logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda berhasil logout');
    }
}
