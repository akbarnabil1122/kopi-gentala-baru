@extends('layouts.app')

@section('title', 'Pembayaran Pesanan - Kopi Gentala')

@section('content')
@php
    $bayar = $pesanan->pembayaran;
    $kirim = $pesanan->pengiriman;
    $nominal = number_format($bayar->jumlah_bayar, 0, ',', '.');
    $pesanWa = "Halo Kopi Gentala, saya sudah melakukan pembayaran QRIS untuk pesanan #{$pesanan->id_pesanan} sebesar Rp{$nominal}.";
@endphp

<section class="blok">
    <div class="container isi-sempit">
        <h2 class="judul">Pesanan #{{ $pesanan->id_pesanan }} Berhasil Dibuat</h2>

        <div class="panel">
            <p>Status pembayaran: <strong>{{ $bayar->status_pembayaran }}</strong></p>

            <div class="rincian">
                @foreach ($pesanan->detail as $d)
                    <div>
                        <span>{{ $d->produk->nama_produk }} ({{ $d->jumlah }} x Rp{{ number_format($d->harga_satuan, 0, ',', '.') }})</span>
                        <span>Rp{{ number_format($d->subtotal, 0, ',', '.') }}</span>
                    </div>
                @endforeach
                <div><span>Subtotal pesanan</span><span>Rp{{ number_format($pesanan->total_harga, 0, ',', '.') }}</span></div>
                <div><span>Ongkos kirim ({{ $kirim->metode_pengiriman }})</span><span>{{ $kirim->biaya_kirim > 0 ? 'Rp'.number_format($kirim->biaya_kirim, 0, ',', '.') : 'Gratis' }}</span></div>
                <div class="total"><span>Total yang harus dibayar</span><span>Rp{{ $nominal }}</span></div>
            </div>
        </div>

        <div class="panel panel-qris">
            <h3>Bayar dengan QRIS</h3>

            @if (file_exists(public_path('images/pembayaran/qris1.jpeg')))
                <img src="{{ asset('images/pembayaran/qris1.jpeg') }}" alt="QRIS Kopi Gentala" class="qris">
            @else
                <div class="qris kosong">QRIS belum dipasang. Letakkan file <code>qris.png</code> di folder <code>public/images/</code>.</div>
            @endif

            <ol class="langkah-bayar">
                <li>Buka aplikasi mobile banking atau e-wallet, lalu pilih bayar dengan QRIS.</li>
                <li>Scan kode QRIS di atas dan bayar tepat sebesar <strong>Rp{{ $nominal }}</strong>.</li>
                <li>Setelah membayar, konfirmasi lewat WhatsApp agar pembayaran segera diverifikasi.</li>
            </ol>

            <div class="aksi">
                <a href="https://wa.me/{{ config('kopigentala.whatsapp') }}?text={{ urlencode($pesanWa) }}" target="_blank" rel="noopener" class="tombol">Konfirmasi via WhatsApp</a>
                <a href="{{ route('akun') }}" class="tombol-garis">Lihat Pesanan Saya</a>
                <a href="{{ route('beranda') }}" class="tombol-garis">Kembali ke Beranda</a>
            </div>
        </div>
    </div>
</section>
@endsection