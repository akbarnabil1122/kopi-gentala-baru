<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Throwable;

class AdminAuthController extends Controller
{
    // Menampilkan halaman login
    public function formLogin()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.auth.login');
    }

    // Memeriksa username dan password
    public function login(Request $request)
    {
        $request->validate([
            'nama_pengguna' => 'required',
            'kata_sandi' => 'required',
        ]);

        $admin = Admin::where(
            'nama_admin',
            $request->nama_pengguna
        )->first();

        if (
            !$admin ||
            !Hash::check(
                $request->kata_sandi,
                $admin->password_hash
            )
        ) {
            return back()
                ->withInput()
                ->with('error', 'Nama pengguna atau kata sandi salah.');
        }

        // Membuat OTP enam digit
        $otp = (string) random_int(100000, 999999);

        // Menyimpan data OTP sementara dalam session
        $request->session()->put([
            'admin_mfa_pending_id' => $admin->id_admin,
            'admin_mfa_otp_hash' => Hash::make($otp),
            'admin_mfa_expires_at' => now()->addMinutes(5)->timestamp,
            'admin_mfa_attempts' => 0,
        ]);

        // Mengirim OTP ke email admin
        try {
            Mail::raw(
                "Kode verifikasi akun Gentala Coffe kamu adalah: {$otp}\n\nKode berlaku selama 5 menit. Jangan berikan kode ini kepada siapa pun.",
                function ($message) use ($admin) {
                    $message->to($admin->email)
                        ->subject('Kode Verifikasi MFA - Gentala Coffe');
                }
            );
        } catch (Throwable $e) {
            $request->session()->forget([
                'admin_mfa_pending_id',
                'admin_mfa_otp_hash',
                'admin_mfa_expires_at',
                'admin_mfa_attempts',
            ]);

            return back()->with(
                'error',
                'Email OTP gagal dikirim. Periksa konfigurasi email.'
            );
        }

        return redirect()
            ->route('admin.login')
            ->with('show_mfa', true)
            ->with('success', 'Kode OTP telah dikirim ke email admin.');
    }

    // Memeriksa kode OTP
    public function verifyMFA(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        $adminId = $request->session()->get('admin_mfa_pending_id');
        $otpHash = $request->session()->get('admin_mfa_otp_hash');
        $expiresAt = $request->session()->get('admin_mfa_expires_at');
        $attempts = $request->session()->get('admin_mfa_attempts', 0);

        if (!$adminId || !$otpHash || !$expiresAt) {
            return redirect()->route('admin.login')
                ->with('error', 'Silakan login kembali.');
        }

        if (now()->timestamp > $expiresAt) {
            $request->session()->forget([
                'admin_mfa_pending_id',
                'admin_mfa_otp_hash',
                'admin_mfa_expires_at',
                'admin_mfa_attempts',
            ]);

            return redirect()->route('admin.login')
                ->with('error', 'Kode OTP sudah kedaluwarsa. Silakan login kembali.');
        }

        if ($attempts >= 5) {
            $request->session()->forget([
                'admin_mfa_pending_id',
                'admin_mfa_otp_hash',
                'admin_mfa_expires_at',
                'admin_mfa_attempts',
            ]);

            return redirect()->route('admin.login')
                ->with('error', 'Terlalu banyak percobaan. Silakan login kembali.');
        }

        if (!Hash::check($request->otp, $otpHash)) {
            $request->session()->put(
                'admin_mfa_attempts',
                $attempts + 1
            );

            return redirect()->route('admin.login')
                ->with('show_mfa', true)
                ->with('error', 'Kode OTP yang kamu masukkan salah.');
        }

        $admin = Admin::find($adminId);

        if (!$admin || !$admin->mfa_enabled) {
            $request->session()->forget([
                'admin_mfa_pending_id',
                'admin_mfa_otp_hash',
                'admin_mfa_expires_at',
                'admin_mfa_attempts',
            ]);

            return redirect()->route('admin.login')
                ->with('error', 'Akun admin tidak valid.');
        }

        // Menghapus data OTP sementara
        $request->session()->forget([
            'admin_mfa_pending_id',
            'admin_mfa_otp_hash',
            'admin_mfa_expires_at',
            'admin_mfa_attempts',
        ]);

        // Login admin setelah OTP benar
        Auth::guard('admin')->login($admin);

        $request->session()->regenerate();

        return redirect()->route('admin.dashboard');
    }
}
