@extends('layouts.app')

@section('title', 'Login - Kopi Gentala')

@section('content')
<section class="blok">
    <div class="form-auth">
        <h2>Login</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            @if ($errors->any())
                <div class="galat">{{ $errors->first() }}</div>
            @endif

            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Email kamu" required autofocus>

            <label for="password">Kata sandi</label>
            <input type="password" id="password" name="password" placeholder="Kata sandi" required>

            <button type="submit" class="tombol">Masuk</button>
        </form>
        <p class="alt">Tidak punya akun? <a href="{{ route('daftar') }}"><strong>Daftar di sini</strong></a></p>
    </div>
</section>
@endsection