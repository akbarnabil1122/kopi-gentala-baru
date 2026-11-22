@extends('layouts.app')

@section('title', 'Checkout - Kopi Gentala')

@section('content')
<section class="blok">
    <div class="container">
        <form method="POST" action="{{ route('checkout.simpan') }}" class="checkout-grid">
            @csrf

            <div class="panel">
                <h3>Detail Alamat</h3>

                @if ($errors->any())
                    <div class="galat">
                        @foreach ($errors->all() as $pesan)
                            <div>{{ $pesan }}</div>
                        @endforeach
                    </div>
                @endif

                <label for="nama_penerima">Nama penerima</label>
                <input type="text" id="nama_penerima" name="nama_penerima" value="{{ old('nama_penerima', $pelanggan->nama_pelanggan) }}" required>

                <div class="dua-kolom">
                    <div>
                        <label for="email">Email</label>
                        <input type="email" id="email" value="{{ $pelanggan->email }}" readonly>
                    </div>
                    <div>
                        <label for="no_telepon">No. HP</label>
                        <input type="tel" id="no_telepon" name="no_telepon" value="{{ old('no_telepon', $pelanggan->no_telepon) }}" required>
                    </div>
                </div>

                <label for="negara">Negara</label>
                <input type="text" id="negara" name="negara" value="{{ old('negara', 'Indonesia') }}" required>

                <label for="kota_kecamatan">Kota dan Kecamatan</label>
                <input type="text" id="kota_kecamatan" name="kota_kecamatan" value="{{ old('kota_kecamatan') }}" placeholder="Contoh: Kota Jambi, Telanaipura" required>

                <label for="alamat_lengkap">Alamat lengkap</label>
                <textarea id="alamat_lengkap" name="alamat_lengkap" rows="3" placeholder="Nama jalan, nomor rumah, RT/RW, patokan" required>{{ old('alamat_lengkap', $pelanggan->alamat) }}</textarea>

                <label for="catatan">Catatan untuk penjual (opsional)</label>
                <textarea id="catatan" name="catatan" rows="2">{{ old('catatan') }}</textarea>

                <h3 class="sub-judul">Metode Pengiriman</h3>
                <div class="opsi-grup">
                    <label class="opsi">
                        <input type="radio" name="metode_pengiriman" value="Antar Langsung" data-ongkir="0" @checked(old('metode_pengiriman', 'Ekspedisi') === 'Antar Langsung')>
                        <span>Antar Langsung <small>Gratis, untuk area dekat</small></span>
                    </label>
                    <label class="opsi">
                        <input type="radio" name="metode_pengiriman" value="Ekspedisi" data-ongkir="{{ $ongkirEkspedisi }}" @checked(old('metode_pengiriman', 'Ekspedisi') === 'Ekspedisi')>
                        <span>Ekspedisi <small>Rp{{ number_format($ongkirEkspedisi, 0, ',', '.') }}</small></span>
                    </label>
                </div>

                <h3 class="sub-judul">Metode Pembayaran</h3>
                <div class="opsi-grup">
                    <label class="opsi">
                        <input type="radio" name="metode_pembayaran" value="QRIS" checked>
                        <span>QRIS</span>
                    </label>
                    <label class="opsi opsi-mati">
                        <input type="radio" disabled>
                        <span>Transfer Bank <small>Segera hadir</small></span>
                    </label>
                </div>
            </div>

            <aside class="panel">
                <h3>Ringkasan Pesanan</h3>

                @foreach ($item as $i)
                    <div class="baris-ringkasan">
                        <div class="mini-gambar">
                            @if ($i->produk->gambar)
                                <img src="{{ asset('images/produk/'.$i->produk->gambar) }}" alt="{{ $i->produk->nama_produk }}">
                            @endif
                        </div>
                        <div>
                            <strong>{{ $i->produk->nama_produk }}</strong>
                            <p>{{ $i->jumlah }} x Rp{{ number_format($i->produk->harga, 0, ',', '.') }}</p>
                        </div>
                        <div class="kanan">Rp{{ number_format($i->produk->harga * $i->jumlah, 0, ',', '.') }}</div>
                    </div>
                @endforeach

                <div class="rincian">
                    <div><span>Subtotal pesanan</span><span>Rp{{ number_format($subtotal, 0, ',', '.') }}</span></div>
                    <div><span>Subtotal pengiriman</span><span id="ongkir-teks"></span></div>
                    <div class="total"><span>Subtotal pembayaran</span><span id="total-teks"></span></div>
                </div>

                <button type="submit" class="tombol tombol-penuh">Buat Pesanan</button>
            </aside>
        </form>
    </div>
</section>

<script>
    const subtotal = {{ (int) round($subtotal) }};
    const rp = (n) => 'Rp' + n.toLocaleString('id-ID');

    function hitung() {
        const pilih = document.querySelector('input[name="metode_pengiriman"]:checked');
        const ongkir = pilih ? parseInt(pilih.dataset.ongkir, 10) : 0;
        document.getElementById('ongkir-teks').textContent = ongkir === 0 ? 'Gratis' : rp(ongkir);
        document.getElementById('total-teks').textContent = rp(subtotal + ongkir);
    }

    document.querySelectorAll('input[name="metode_pengiriman"]').forEach((r) => r.addEventListener('change', hitung));
    hitung();
</script>
@endsection