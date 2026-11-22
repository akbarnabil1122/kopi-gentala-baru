<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Kopi Gentala')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header class="navbar">
        <div class="container">
            <a href="{{ route('beranda') }}" class="brand">Gentala Coffe</a>
            <nav class="nav-links">
                <a href="{{ route('beranda') }}">Beranda</a>
                <a href="{{ route('beranda') }}#profil">Profil</a>
                <a href="{{ route('beranda') }}#produk">Produk</a>
                <a href="#kontak">Kontak</a>
                {{-- Tautan keranjang dan akun diisi di langkah berikutnya --}}
                <a href="#" aria-label="Keranjang">
                    <svg viewBox="0 0 24 24"><path d="M3 4h2l2.4 11h9.2L19 7H6.2"/><circle cx="9" cy="19" r="1.4"/><circle cx="17" cy="19" r="1.4"/></svg>
                </a>
                <a href="#" aria-label="Akun">
                    <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><circle cx="12" cy="10" r="3"/><path d="M6.5 18c1.2-2.4 3-3.5 5.5-3.5s4.3 1.1 5.5 3.5"/></svg>
                </a>
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer id="kontak">
        <div class="container">
            <div class="grid">
                <div>
                    <h3>KOPI GENTALA</h3>
                    <p>Menghadirkan kehangatan sejati dari tanah Jambi langsung ke cangkir Anda. Komitmen kami adalah menjaga keautentikan rasa di setiap seduhan.</p>
                </div>
                <div>
                    <h3>Menu</h3>
                    <ul>
                        <li><a href="{{ route('beranda') }}">Beranda</a></li>
                        <li><a href="{{ route('beranda') }}#profil">Profil</a></li>
                        <li><a href="{{ route('beranda') }}#produk">Produk</a></li>
                    </ul>
                </div>
                <div>
                    <h3>Hubungi Kami</h3>
                    <ul>
                        <li>WhatsApp: <a href="https://wa.me/{{ config('kopigentala.whatsapp') }}" target="_blank" rel="noopener">+{{ config('kopigentala.whatsapp') }}</a></li>
                        <li>Email: {{ config('kopigentala.email') }}</li>
                        <li>Instagram: &#64;{{ config('kopigentala.instagram') }}</li>
                        <li>Alamat: {{ config('kopigentala.alamat') }}</li>
                    </ul>
                </div>
            </div>
            <p class="hak-cipta">&copy; {{ date('Y') }} Kopi Gentala</p>
        </div>
    </footer>
</body>
</html>