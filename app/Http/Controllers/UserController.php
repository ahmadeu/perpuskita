<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhere('nim', 'like', "%$search%")
                  ->orWhere('role', 'like', "%$search%") ;
            });
        }

        $users = $query->latest()->paginate(10)->withQueryString();
        return view('admin.users.index', compact('users'));
    }

    public function admin()
    {
        return view('admin.users.dashboard');
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'nim' => 'nullable|string|max:20|unique:users',
                'password' => 'required|string|min:8',
                'role' => 'required|in:admin,user'
            ]);

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'nim' => $request->nim,
                'password' => Hash::make($request->password),
                'role' => $request->role
            ]);

            return redirect()->route('users.create')->with('success', 'User berhasil ditambahkan');
        } catch (\Exception $e) {
            Log::error('Error saat menambah user:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->with('error', 'Terjadi kesalahan saat menambah user: ' . $e->getMessage());
        }
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'nim' => 'nullable|string|max:20|unique:users,nim,' . $user->id,
            'role' => 'required|in:admin,user'
        ]);

        $user->update($request->only(['name', 'email', 'nim', 'role']));

        if ($request->filled('password')) {
            $request->validate([
                'password' => 'required|string|min:8'
            ]);
            $user->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('users.edit', $user->id)->with('success', 'User berhasil diperbarui');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus');
    }
} 