<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;

class AuthController extends Controller
{
    // Fungsi untuk menampilkan halaman login
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    // Fungsi untuk memproses data login
    public function processLogin(Request $request)
    {
        // Validasi input login
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Coba untuk melakukan login
        if (Auth::attempt($request->only('email', 'password'))) {
            // Jika login berhasil, redirect ke halaman dashboard atau halaman lain yang Anda inginkan
            return redirect()->route('dashboard');
        } else {
            // Jika login gagal, kembali ke halaman login dengan pesan error
            return redirect()->back()->with('error', 'Email atau password salah.');
        }
    }

    // Fungsi untuk menampilkan halaman registrasi
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Fungsi untuk memproses data registrasi
    public function processRegistration(Request $request)
    {
        // Validasi input registrasi
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        // Simpan data user baru ke database
        $user = new \App\Models\User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();



        // Redirect ke halaman login dengan pesan sukses
        return redirect()->route('login')->with('success', 'Registrasi berhasil. Silakan login.');
    }

    // Fungsi untuk logout
    public function logout()
    {
        Auth::logout();

        // Redirect ke halaman login dengan pesan sukses
        return redirect()->route('login')->with('success', 'Anda telah berhasil logout.');
    }

    public function redirectToLogin()
    {
        return redirect()->route('login');
    }
}