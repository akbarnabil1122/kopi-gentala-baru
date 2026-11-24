<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use RuntimeException;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $password = env('ADMIN_DEFAULT_PASSWORD');

        if (! $password) {
            throw new RuntimeException(
                'Tambahkan ADMIN_DEFAULT_PASSWORD ke file .env sebelum menjalankan AdminSeeder.'
            );
        }

        Admin::updateOrCreate(
            ['email' => 'ahmadirsanto693@gmail.com'],
            [
                'nama_admin' => 'gentala',
                'password_hash' => Hash::make($password),
                'mfa_enabled' => true,
                'failed_login_attempts' => 0,
                'locked_until' => null,
            ]
        );
    }
}
