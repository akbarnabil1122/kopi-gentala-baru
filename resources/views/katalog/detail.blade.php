@extends('layouts.app')

@section('title', $produk->nama_produk.' - Kopi Gentala')

@section('content')
<section class="blok">
    <div class="container">
        <a href="{{ route('produk.index') }}" class="kembali">&larr; Kembali ke produk</a>

        <div class="detail-produk">
            <div class="detail-gambar">
                @if ($produk->gambar)
                    <img src="{{ asset('images/produk/'.$produk->gambar) }}" alt="{{ $produk->nama_produk }}">
                @else
                    <span>Foto produk</span>
                @endif
            </div>

            <div class="detail-info">
                <h1>{{ $produk->nama_produk }}</h1>
                <p class="harga-besar">Rp{{ number_format($produk->harga, 0, ',', '.') }}</p>

                <ul class="spesifikasi">
                    <li>Kategori: <strong>{{ $produk->jenis_kopi }}</strong></li>
                    <li>Berat: <strong>{{ $produk->ukuran_kemasan }} gr</strong></li>
                    <li>Ketersediaan: <strong>{{ $produk->stok > 0 ? 'Ada' : 'Habis' }}</strong></li>
                    <li>Jumlah Stok: <strong>{{ $produk->stok }}</strong></li>
                </ul>

                @if ($errors->any())
                    <div class="galat">{{ $errors->first() }}</div>
                @endif

                @if ($produk->stok > 0)
                    <form method="POST" action="{{ route('keranjang.tambah') }}">
                        @csrf
                        <input type="hidden" name="id_produk" value="{{ $produk->id_produk }}">

                        <div class="stepper">
                            <button type="button" id="kurang" aria-label="Kurangi">&minus;</button>
                            <input type="number" name="jumlah" id="jumlah" value="1" min="1" max="{{ $produk->stok }}">
                            <button type="button" id="tambah" aria-label="Tambah">+</button>
                        </div>

                        <div class="aksi">
                            <button type="submit" name="langsung" value="1" class="tombol">Pesan Sekarang</button>
                            <button type="submit" class="tombol-garis">Keranjang</button>
                        </div>
                    </form>
                @else
                    <p class="galat">Stok produk ini sedang habis.</p>
                @endif
            </div>
        </div>

        <div class="deskripsi-kotak">
            <h3>Deskripsi Produk</h3>
            <p>{!! nl2br(e($produk->deskripsi)) !!}</p>
        </div>
    </div>
</section>

<script>
    const jumlah = document.getElementById('jumlah');
    if (jumlah) {
        const maks = parseInt(jumlah.max, 10);
        const atur = (n) => { jumlah.value = Math.min(Math.max(n || 1, 1), maks); };
        document.getElementById('kurang').addEventListener('click', () => atur(parseInt(jumlah.value, 10) - 1));
        document.getElementById('tambah').addEventListener('click', () => atur(parseInt(jumlah.value, 10) + 1));
        jumlah.addEventListener('change', () => atur(parseInt(jumlah.value, 10)));
    }
</script>
@endsection