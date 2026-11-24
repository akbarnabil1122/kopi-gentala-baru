@extends('layouts.app')

@section('title', 'Keranjang Saya - Kopi Gentala')

@section('content')
<section class="blok">
    <div class="container isi-sempit">
        <h2 class="judul">Keranjang Saya</h2>

        @if ($errors->any())
            <div class="galat">{{ $errors->first() }}</div>
        @endif

        @forelse ($item as $i)
            <div class="baris-keranjang">
                <div class="mini-gambar">
                    @if ($i->produk->gambar)
                        <img src="{{ asset('images/produk/'.$i->produk->gambar) }}" alt="{{ $i->produk->nama_produk }}">
                    @endif
                </div>

                <div class="info-item">
                    <a href="{{ route('produk.detail', $i->produk) }}"><strong>{{ $i->produk->nama_produk }}</strong></a>
                    <p>Rp{{ number_format($i->produk->harga, 0, ',', '.') }} / kemasan</p>
                    <p class="stok-kecil">Stok tersedia: {{ $i->produk->stok }}</p>
                </div>

                <form method="POST" action="{{ route('keranjang.ubah', $i) }}" class="form-jumlah">
                    @csrf
                    @method('PATCH')
                    <div class="stepper">
                        <button type="button" data-delta="-1" aria-label="Kurangi">&minus;</button>
                        <input type="number" name="jumlah" value="{{ $i->jumlah }}" min="1" max="{{ $i->produk->stok }}">
                        <button type="button" data-delta="1" aria-label="Tambah">+</button>
                    </div>
                </form>

                <div class="subtotal-item">Rp{{ number_format($i->produk->harga * $i->jumlah, 0, ',', '.') }}</div>

                <form method="POST" action="{{ route('keranjang.hapus', $i) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="tombol-hapus" aria-label="Hapus dari keranjang">&times;</button>
                </form>
            </div>
        @empty
            <div class="kartu">
                <p>Keranjang Anda masih kosong.</p>
                <p style="margin-top:14px"><a href="{{ route('produk.index') }}" class="tombol">Lihat Produk</a></p>
            </div>
        @endforelse

        @if ($item->isNotEmpty())
            <div class="ringkasan-keranjang">
                <p>Total belanja: <strong>Rp{{ number_format($total, 0, ',', '.') }}</strong></p>
                @if (Route::has('checkout'))
                    <a href="{{ route('checkout') }}" class="tombol">CheckOut</a>
                @else
                    <span class="tombol nonaktif">CheckOut</span>
                @endif
            </div>
        @endif
    </div>
</section>

<script>
    document.querySelectorAll('.form-jumlah').forEach((form) => {
        const input = form.querySelector('input[name="jumlah"]');
        const maks = parseInt(input.max, 10) || 1;
        const kirim = (n) => {
            input.value = Math.min(Math.max(n || 1, 1), maks);
            form.submit();
        };
        form.querySelectorAll('button[data-delta]').forEach((tombol) => {
            tombol.addEventListener('click', () => kirim(parseInt(input.value, 10) + parseInt(tombol.dataset.delta, 10)));
        });
        input.addEventListener('change', () => kirim(parseInt(input.value, 10)));
    });
</script>
@endsection