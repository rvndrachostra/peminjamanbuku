<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    // Menampilkan halaman register
    public function show()
    {
        return view('auth.register');
    }

    // Proses register
    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Simpan user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $peminjamRole = Role::firstOrCreate(
            ['name' => 'peminjam'],
            ['label' => 'Peminjam']
        );

        if (!$user->roles()->where('role_id', $peminjamRole->id)->exists()) {
            $user->roles()->attach($peminjamRole->id);
        }

        return redirect()
            ->route('login')
            ->with('success', 'Registrasi berhasil. Silakan login untuk mulai mengajukan peminjaman.');
    }
}
