<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserAkses
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Log untuk debugging
        Log::info('UserAkses Middleware', [
            'user' => Auth::user(),
            'required_role' => $role,
            'current_role' => Auth::user() ? Auth::user()->role : null
        ]);

        // Cek apakah user sudah login DAN role-nya sesuai
        if (Auth::check() && Auth::user()->role === $role) {
            // Jika sudah login dan role sesuai, lanjutkan request
            return $next($request);
        }

        // Jika request AJAX, kembalikan response JSON
        if ($request->ajax()) {
            return response()->json(['message' => 'Anda tidak memiliki hak akses'], 403);
        }
        // Jika bukan AJAX, redirect kembali dengan pesan error
        return redirect()->back()->with('error', 'Anda tidak memiliki hak akses');
    }
}
