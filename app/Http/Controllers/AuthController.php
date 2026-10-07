<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()->withErrors(['email' => 'Email atau password salah.'])->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect()->route(Auth::user()->role.'.dashboard');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:255'],
            'no_ktp' => ['required', 'string', 'max:255'],
            'no_hp' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:6', 'confirmed'],
        ]);

        // Format no_rm: YYYYMM-XXX (urutan pasien dalam bulan berjalan)
        $user = DB::transaction(function () use ($data) {
            $prefix = now()->format('Ym');
            $jumlah = User::where('role', 'pasien')
                ->where('no_rm', 'like', $prefix.'-%')
                ->lockForUpdate()
                ->count();

            return User::create($data + [
                'role' => 'pasien',
                'no_rm' => $prefix.'-'.str_pad($jumlah + 1, 3, '0', STR_PAD_LEFT),
            ]);
        });

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('pasien.dashboard');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
