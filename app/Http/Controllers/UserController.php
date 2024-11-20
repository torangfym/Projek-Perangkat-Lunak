<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('kepalalab.manajemenuser.index', compact('users'));
    }

    public function post(Request $request)
    {
        // Validasi input di sini jika diperlukan
        $request->validate([
            'name' => 'required|string|max:255',
            'nip' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users',
            'role' => 'required|in:staff,kepalalab,teknisi',
            'password' => 'required|min:8|confirmed',
            'created_at' => 'required|date',
        ]);

        try {
            // Create user
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'nip' => $request->nip,
                'role' => $request->role,
                'password' => Hash::make($request->password),
                'created_at' => $request->created_at,
            ]);

            return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan!');
        } catch (\Exception $e) {
            // Check if the exception is related to duplicate entry (email already exists)
            if ($e instanceof \Illuminate\Database\QueryException && strpos($e->getMessage(), 'Duplicate entry') !== false) {
                return redirect()->back()->with('error', 'Email sudah ada dalam database.');
            }

            // Handle other exceptions or rethrow the exception if necessary
            throw $e;
        }
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    // Fungsi untuk menyimpan pembaruan data user
    public function update(Request $request, User $user)
    {
        // Validasi input di sini jika diperlukan
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'nip' => 'nullable|string|max:255',
            'role' => 'required|in:staff,kepalalab,teknisi',
            // Tambahkan validasi dan field lainnya sesuai kebutuhan
        ]);

        // Update data user
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'nip' => $request->nip,
            'role' => $request->role,
            // Tambahkan field lainnya sesuai kebutuhan
        ]);

        return redirect()->route('user.index')->with('success', 'User berhasil diperbarui!');
    }

    public function hapus(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User berhasil dihapus!');
    }



}
