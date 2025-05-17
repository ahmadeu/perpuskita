<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan form login admin
    public function showLoginForm()
    {
        return view('admin.login'); // Pastikan file resources/views/admin/login.blade.php tersedia
    }

    // Proses login admin
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Cek apakah user memiliki role 'admin'
            if ($user && $user->role === 'admin') {
                return redirect()->route('dashboard');
            } else {
                Auth::logout();
                return redirect()->route('admin.login')->withErrors([
                    'error' => 'Anda bukan admin.'
                ]);
            }
        }

        return back()->withErrors([
            'error' => 'Email atau password salah.'
        ]);
    }
}
