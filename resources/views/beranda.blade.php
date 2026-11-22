@extends('layouts.app')

@section('title', 'Kopi Gentala - Beranda')

@section('content')
<section class="hero">
    <h1>KOPI GENTALA</h1>
    <p>Lahir dari tanah Jambi, dirawat oleh tradisi. Kopi Gentala menghadirkan simfoni rasa yang pekat dan aroma memikat, mengalirkan kemewahan cita rasa autentik di setiap sesapan.</p>
</section>

<section class="blok krem" id="profil">
    <div class="container teks-tengah">
        <h2 class="judul">PROFIL KAMI</h2>
        <h3>SEJARAH KOPI GENTALA</h3>
        <p>Kopi Gentala lahir pada tahun 2019 di halaman Kantor Pos KO Telanai Pura sebagai simbol kebanggaan dan semangat lokal Jambi. Mengambil nama "Gentala", kami berkomitmen membawa cita rasa kopi khas Jambi melintasi batas kota dan provinsi.</p>
        <p>Keautentikan rasa kami berakar langsung dari kekayaan bumi Jambi, menghadirkan varian biji kopi pilihan terbaik seperti Robusta Jangkat yang berkarakter kuat, Robusta Kerinci yang unik, hingga kelembutan aroma Arabika Kerinci yang legendaris.</p>
    </div>
</section>

<section class="blok">
    <div class="container">
        <h2 class="judul">MENGAPA MEMILIH KAMI</h2>
        <div class="grid grid-3">
            <div class="kartu"><h3>Bahan Baku</h3><p>Dipilih secara cermat dan diproses dengan standar ketat untuk menjaga konsistensi aroma, body, serta karakter terbaik kopi di setiap batch.</p></div>
            <div class="kartu"><h3>Rasa Autentik</h3><p>Menghadirkan keunikan rasa yang berakar dari kekayaan bumi Jambi. Setiap cangkir menawarkan sensasi yang khas, hangat, dan mendalam.</p></div>
            <div class="kartu"><h3>Mutu Terjaga</h3><p>Kami mengunci kesegaran produk sejak selesai diproses, memastikan aroma kuat yang menggugah selera langsung tercium begitu kemasan dibuka.</p></div>
        </div>
    </div>
</section>

<section class="blok krem">
    <div class="container">
        <h2 class="judul">MANFAAT DAN KEUNIKAN</h2>
        <div class="grid grid-4">
            <div class="kartu"><h3>Bahan Premium</h3><p>Menggunakan fine robusta dan biji kopi pilihan berkualitas terbaik di kelasnya.</p></div>
            <div class="kartu"><h3>Rasa Otentik</h3><p>Memberikan pengalaman menikmati karakter rasa kopi terbaik di setiap seduhan.</p></div>
            <div class="kartu"><h3>Tubuh Bugar</h3><p>Membantu mengontrol nafsu makan dan mengoptimalkan proses pembakaran lemak.</p></div>
            <div class="kartu"><h3>Kaya Antioksidan</h3><p>Mengandung antioksidan tinggi yang baik untuk menjaga kesehatan tubuh Anda.</p></div>
        </div>
    </div>
</section>

<section class="blok" id="produk">
    <div class="container">
        <h2 class="judul">PRODUK KAMI</h2>
        <div class="grid grid-3">
            @forelse ($produk as $p)
                <div class="kartu">
                    <div class="produk-gambar">
                        @if ($p->gambar)
                            <img src="{{ asset('images/produk/'.$p->gambar) }}" alt="{{ $p->nama_produk }}">
                        @else
                            <span>Foto produk</span>
                        @endif
                    </div>
                    <h3>{{ $p->nama_produk }}</h3>
                    <p>{{ $p->deskripsi }}</p>
                    <p>Berat: {{ $p->ukuran_kemasan }} gr</p>
                    <p class="harga">Harga: Rp{{ number_format($p->harga, 0, ',', '.') }}</p>
                    {{-- Tautan Beli ke halaman detail diisi di Langkah 7 --}}
                    <a href="#" class="tombol">Beli</a>
                </div>
            @empty
                <p class="teks-tengah">Produk belum tersedia.</p>
            @endforelse
        </div>
    </div>
</section>
@endsection