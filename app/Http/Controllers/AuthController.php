<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrasiRequest;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    private const MAKS_GAGAL = 5;
    private const MENIT_KUNCI = 15;

    public function formDaftar()
    {
        return view('auth.daftar');
    }

    public function daftar(RegistrasiRequest $request)
    {
        $data = $request->validated();

        $pelanggan = Pelanggan::create([
            'nama_pelanggan' => $data['nama_pelanggan'],
            'no_telepon' => $data['no_telepon'],
            'email' => $data['email'],
            'password_hash' => $data['password'], // di-hash otomatis oleh cast pada model
            'alamat' => '', // diisi saat checkout
        ]);

        Auth::guard('pelanggan')->login($pelanggan);
        $request->session()->regenerate();

        return redirect()->route('beranda')
            ->with('status', 'Registrasi berhasil. Selamat datang di Kopi Gentala!');
    }

    public function formLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Kata sandi wajib diisi.',
        ]);

        $pelanggan = Pelanggan::where('email', strtolower($data['email']))->first();

        if ($pelanggan && $pelanggan->locked_until && $pelanggan->locked_until->isFuture()) {
            return $this->akunTerkunci($pelanggan);
        }

        if (! $pelanggan || ! Hash::check($data['password'], $pelanggan->password_hash)) {
            if ($pelanggan) {
                $pelanggan->failed_login_attempts++;

                if ($pelanggan->failed_login_attempts >= self::MAKS_GAGAL) {
                    $pelanggan->failed_login_attempts = 0;
                    $pelanggan->locked_until = now()->addMinutes(self::MENIT_KUNCI);
                    $pelanggan->save();

                    return $this->akunTerkunci($pelanggan);
                }

                $pelanggan->save();
            }

            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'Email atau kata sandi salah.']);
        }

        $pelanggan->forceFill(['failed_login_attempts' => 0, 'locked_until' => null])->save();

        Auth::guard('pelanggan')->login($pelanggan);
        $request->session()->regenerate();

        return redirect()->intended(route('beranda'));
    }

    public function logout(Request $request)
    {
        Auth::guard('pelanggan')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('beranda');
    }

    private function akunTerkunci(Pelanggan $pelanggan)
    {
        $menit = (int) ceil(now()->diffInMinutes($pelanggan->locked_until, true));

        return back()
            ->withInput(request()->only('email'))
            ->withErrors(['email' => "Akun dikunci sementara karena terlalu banyak percobaan gagal. Coba lagi dalam {$menit} menit."]);
    }
}