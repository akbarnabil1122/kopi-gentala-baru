@extends('layouts.app')

@section('title', 'Produk - Kopi Gentala')

@section('content')
<section class="blok">
    <div class="container">
        <h2 class="judul">PRODUK KAMI</h2>
        <div class="grid grid-2">
            @forelse ($produk as $p)
                <div class="kartu">
                    <a href="{{ route('produk.detail', $p) }}" class="produk-gambar">
                        @if ($p->gambar)
                            <img src="{{ asset('images/produk/'.$p->gambar) }}" alt="{{ $p->nama_produk }}">
                        @else
                            <span>Foto produk</span>
                        @endif
                    </a>
                    <h3><a href="{{ route('produk.detail', $p) }}">{{ $p->nama_produk }}</a></h3>
                    <p>Berat: {{ $p->ukuran_kemasan }} gr</p>
                    <p class="harga">Rp{{ number_format($p->harga, 0, ',', '.') }}</p>
                    <a href="{{ route('produk.detail', $p) }}" class="tombol">Lihat Detail</a>
                </div>
            @empty
                <p class="teks-tengah">Produk belum tersedia.</p>
            @endforelse
        </div>
    </div>
</section>
@endsection