@extends('layouts.app')

@section('title', 'Akun Saya - Kopi Gentala')

@section('content')
<section class="blok">
    <div class="container isi-sempit">
        <h2 class="judul rata-kiri">Akun Saya</h2>

        @if ($pelanggan)
            <div class="sapaan">Halo {{ $pelanggan->nama_pelanggan }}, Silahkan Berbelanja di Kopi Gentala</div>
        @else
            <div class="sapaan sapaan-tamu">
                <span>Miliki Akun untuk mendapatkan penawaran terbaik!</span>
                <span class="aksi">
                    <a href="{{ route('login') }}" class="tombol kecil">Masuk</a>
                    <a href="{{ route('daftar') }}" class="tombol-garis kecil">Daftar</a>
                </span>
            </div>
        @endif

        <div class="tab-akun">
            <a href="{{ route('akun') }}" class="{{ $tab === 'pesanan' ? 'aktif' : '' }}">Pesanan</a>
            <a href="{{ route('akun', ['tab' => 'riwayat']) }}" class="{{ $tab === 'riwayat' ? 'aktif' : '' }}">Riwayat Pesanan</a>
        </div>

        <div class="panel-akun">
            <h3>{{ $tab === 'pesanan' ? 'Pesanan Saya' : 'Riwayat Pesanan' }}</h3>

            @forelse ($daftar as $p)
                @php
                    $bayar = $p->pembayaran;
                    $kirim = $p->pengiriman;
                    $pertama = $p->detail->first();
                    $lain = $p->detail->slice(1);
                    $ongkir = $kirim ? $kirim->biaya_kirim : 0;
                    $total = $bayar ? $bayar->jumlah_bayar : ($p->total_harga + $ongkir);

                    $kelasPesanan = match ($p->status_pesanan) {
                        'Selesai' => 'ok',
                        'Dibatalkan' => 'gagal',
                        default => 'proses',
                    };
                    $kelasBayar = $bayar ? match ($bayar->status_pembayaran) {
                        'Sudah Dibayar' => 'ok',
                        'Gagal' => 'gagal',
                        default => 'proses',
                    } : 'proses';
                @endphp

                <article class="kartu-pesanan">
                    <div class="kepala-pesanan">
                        <div>
                            <strong>Pesanan #{{ $p->id_pesanan }}</strong>
                            <span class="tanggal">{{ $p->tanggal_pesanan->translatedFormat('d F Y, H:i') }}</span>
                        </div>
                        <div class="lencana-grup">
                            <span class="lencana lencana-{{ $kelasPesanan }}">{{ $p->status_pesanan }}</span>
                            @if ($bayar)
                                <span class="lencana lencana-{{ $kelasBayar }}">{{ $bayar->status_pembayaran }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="isi-pesanan">
                        <div class="mini-gambar">
                            @if ($pertama && $pertama->produk->gambar)
                                <img src="{{ asset('images/produk/'.$pertama->produk->gambar) }}" alt="{{ $pertama->produk->nama_produk }}">
                            @endif
                        </div>
                        <div class="info-item">
                            @if ($pertama)
                                <strong>{{ $pertama->produk->nama_produk }}</strong>
                                <p>{{ $pertama->jumlah }} pcs &times; Rp{{ number_format($pertama->harga_satuan, 0, ',', '.') }}</p>
                            @endif
                            @if ($lain->isNotEmpty())
                                <p class="stok-kecil"><em>+{{ $lain->count() }} produk lainnya ({{ $lain->map(fn ($d) => $d->produk->nama_produk)->join(', ') }})</em></p>
                            @endif
                        </div>
                        <div class="total-pesanan">
                            <small>Total Belanja (Termasuk Ongkir)</small>
                            <strong>Rp{{ number_format($total, 0, ',', '.') }}</strong>
                        </div>
                    </div>

                    <div class="kaki-pesanan">
                        <div>
                            @if ($kirim)
                                @if ($kirim->metode_pengiriman === 'Ekspedisi')
                                    Kurir: <strong>{{ $kirim->nama_ekspedisi ?? 'Menunggu diproses admin' }}</strong>
                                    @if ($kirim->no_resi) &ndash; Resi: <strong>{{ $kirim->no_resi }}</strong> @endif
                                @else
                                    Pengiriman: <strong>Antar Langsung</strong>
                                @endif
                                <br><small>Status pengiriman: {{ $kirim->status_pengiriman }}</small>
                                @if ($kirim->no_resi)
                                    <br><a href="{{ config('kopigentala.cek_resi_url') }}" target="_blank" rel="noopener" class="tautan">Cek Pengirimanmu disini CekResi.com</a>
                                @endif
                            @endif
                        </div>
                        @if ($bayar && $bayar->status_pembayaran === 'Menunggu Pembayaran' && $p->status_pesanan !== 'Dibatalkan')
                            <a href="{{ route('pembayaran.tampil', $p) }}" class="tombol kecil">Bayar Sekarang</a>
                        @endif
                    </div>

                    <details class="detail-pesanan">
                        <summary>Lihat detail pesanan</summary>
                        <div class="rincian">
                            @foreach ($p->detail as $d)
                                <div>
                                    <span>{{ $d->produk->nama_produk }} ({{ $d->jumlah }} &times; Rp{{ number_format($d->harga_satuan, 0, ',', '.') }})</span>
                                    <span>Rp{{ number_format($d->subtotal, 0, ',', '.') }}</span>
                                </div>
                            @endforeach
                            <div><span>Subtotal pesanan</span><span>Rp{{ number_format($p->total_harga, 0, ',', '.') }}</span></div>
                            <div><span>Ongkos kirim</span><span>{{ $ongkir > 0 ? 'Rp'.number_format($ongkir, 0, ',', '.') : 'Gratis' }}</span></div>
                            <div class="total"><span>Total pembayaran</span><span>Rp{{ number_format($total, 0, ',', '.') }}</span></div>
                        </div>
                        @if ($kirim)
                            <p class="alamat-detail"><strong>Alamat tujuan:</strong><br>{!! nl2br(e($kirim->alamat_tujuan)) !!}</p>
                        @endif
                        @if ($p->catatan)
                            <p class="alamat-detail"><strong>Catatan:</strong> {{ $p->catatan }}</p>
                        @endif
                    </details>
                </article>
            @empty
                <div class="kosong-pesanan">
                    <svg viewBox="0 0 24 24" width="44" height="44" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M3 7l9-4 9 4-9 4-9-4z"/><path d="M3 7v10l9 4 9-4V7"/><path d="M12 11v10"/></svg>
                    <p>Tidak ada Pesanan</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection