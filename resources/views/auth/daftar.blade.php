@extends('layouts.app')

@section('title', 'Daftar - Kopi Gentala')

@section('content')
<section class="blok">
    <div class="form-auth">
        <h2>Daftar</h2>
        <form method="POST" action="{{ route('daftar') }}">
            @csrf

            <label for="nama_pelanggan">Nama lengkap*</label>
            <input type="text" id="nama_pelanggan" name="nama_pelanggan" value="{{ old('nama_pelanggan') }}" placeholder="Nama lengkap kamu" required autofocus>
            @error('nama_pelanggan') <small class="galat-kecil">{{ $message }}</small> @enderror

            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Email kamu" required>
            @error('email') <small class="galat-kecil">{{ $message }}</small> @enderror

            <label for="no_telepon">No. telepon / WhatsApp</label>
            <input type="tel" id="no_telepon" name="no_telepon" value="{{ old('no_telepon') }}" placeholder="081234567890" required>
            @error('no_telepon') <small class="galat-kecil">{{ $message }}</small> @enderror

            <label for="password">Kata sandi</label>
            <input type="password" id="password" name="password" placeholder="Minimal 8 karakter" required>
            @error('password') <small class="galat-kecil">{{ $message }}</small> @enderror

            <button type="submit" class="tombol">Selanjutnya</button>
        </form>
        <p class="alt">Sudah punya akun? <a href="{{ route('login') }}"><strong>Login di sini</strong></a></p>
    </div>
</section>
@endsection