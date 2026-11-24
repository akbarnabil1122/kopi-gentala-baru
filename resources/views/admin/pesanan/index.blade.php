
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan - Gentala Coffe</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #fff;
            color: #111;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */

        .sidebar {
            width: 235px;
            background: #fff;
            box-shadow: 5px 0 25px rgba(0,0,0,.06);
            display: flex;
            flex-direction: column;
            padding: 30px 22px;
            position: fixed;
            inset: 0 auto 0 0;
            z-index: 10;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 9px;
            margin-bottom: 45px;
            white-space: nowrap;
        }

        .brand-logo {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #24170f;
            border: 4px double #c4a77d;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: Georgia, serif;
            font-size: 18px;
        }

        .brand-name {
            font-family: Georgia, serif;
            font-size: 23px;
            font-weight: bold;
            color: #503e36;
        }

        .sidebar-menu {
            display: flex;
            flex-direction: column;
            gap: 28px;
        }

        .menu-link {
            display: block;
            padding: 13px 15px;
            border-radius: 9px;
            color: #503e36;
            text-decoration: none;
            text-align: center;
            font-family: Georgia, serif;
            font-size: 17px;
            font-weight: bold;
        }

        .menu-link:hover,
        .menu-link.active {
            background: #503e36;
            color: white;
            box-shadow: 0 5px 18px rgba(80,62,54,.22);
        }

        .sidebar-logout {
            margin-top: auto;
            display: flex;
            justify-content: center;
        }

        .logout-button {
            background: none;
            border: none;
            color: #503e36;
            cursor: pointer;
        }

        .logout-button svg {
            width: 29px;
            height: 29px;
        }

        /* KONTEN UTAMA */

        .main-content {
            margin-left: 235px;
            width: calc(100% - 235px);
            padding: 30px;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 42px;
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 28px;
        }

        .menu-toggle {
            background: none;
            border: none;
            cursor: pointer;
        }

        .menu-toggle svg {
            width: 29px;
            height: 29px;
        }

        .page-title {
            font-family: Georgia, serif;
            font-size: 30px;
            font-weight: normal;
            color: #000;
        }

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .admin-avatar {
            width: 43px;
            height: 43px;
            border-radius: 50%;
            background: #e9e4df;
            color: #503e36;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            overflow: hidden;
        }

        .admin-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .admin-info strong {
            display: block;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .admin-info span {
            font-size: 12px;
            color: #333;
        }

        /* BANNER DAFTAR PESANAN */

        .page-banner {
            min-height: 128px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            background: white;
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 3px 10px rgba(0,0,0,.17);
            margin-bottom: 18px;
        }

        .banner-title {
            display: flex;
            align-items: center;
            gap: 12px;
            font-family: Georgia, serif;
            font-size: 25px;
            color: #111;
            margin-bottom: 10px;
        }

        .banner-title svg {
            width: 40px;
            height: 40px;
            color: #503e36;
            flex-shrink: 0;
        }

        .banner-description {
            font-family: Georgia, serif;
            color: #aaa;
            font-size: 20px;
            line-height: 1.4;
        }

        .new-order-badge {
            background: #fce5dc;
            color: #b94e20;
            padding: 8px 30px;
            border-radius: 30px;
            font-size: 16px;
            white-space: nowrap;
        }

        /* INFORMASI PEMBAYARAN */

        .payment-info {
            min-height: 129px;
            border: 1px solid #b9b5b3;
            border-radius: 9px;
            background: #f8f5f4;
            padding: 10px 18px;
            margin-bottom: 21px;
        }

        .payment-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-family: Georgia, serif;
            font-size: 25px;
            margin-bottom: 10px;
        }

        .payment-title svg {
            width: 39px;
            height: 39px;
            color: #398b42;
            flex-shrink: 0;
        }

        .payment-description {
            font-family: Georgia, serif;
            font-size: 20px;
            line-height: 1.4;
            color: #aaa;
        }

        /* TABEL PESANAN */

        .table-card {
            min-height: 575px;
            padding: 30px;
            background: #fff;
            border-radius: 25px;
            box-shadow: 0 5px 25px rgba(0,0,0,.09);
        }

        .table-toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 87px;
        }

        .search-box {
            width: 400px;
            height: 40px;
            background: #f3f1f1;
            border-radius: 9px;
            display: flex;
            align-items: center;
            padding: 0 16px;
            gap: 10px;
        }

        .search-box svg {
            width: 17px;
            height: 17px;
            color: #aaa;
            flex-shrink: 0;
        }

        .search-box input {
            border: none;
            outline: none;
            background: transparent;
            width: 100%;
            font-size: 11px;
        }

        .filter-form {
            width: 178px;
        }

        .filter-select {
            width: 100%;
            height: 40px;
            padding: 0 13px;
            border: none;
            border-radius: 9px;
            color: #999;
            background: #f3f1f1;
            outline: none;
            font-size: 11px;
            cursor: pointer;
        }

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            min-width: 1050px;
            border-collapse: collapse;
            color: #111;
        }

        th, td {
            border: 1px solid #c8c8c8;
            height: 52px;
            padding: 8px 10px;
            text-align: center;
            font-size: 14px;
            vertical-align: middle;
        }

        th {
            height: 52px;
            font-weight: bold;
            background: #fff;
        }

        tbody tr:hover {
            background: #faf9f8;
        }

        .product-name {
            font-size: 14px;
        }

        .status-form {
            width: 100%;
        }

        .status-select {
            width: 100%;
            height: 32px;
            border: none;
            outline: none;
            border-radius: 9px;
            background: #f2f0f0;
            color: #888;
            font-size: 11px;
            padding: 0 10px;
            cursor: pointer;
            text-align: center;
        }

        .resi-input {
            width: 100%;
            height: 32px;
            border: 1px solid #555;
            border-radius: 4px;
            outline: none;
            padding: 0 7px;
            font-size: 11px;
        }

        .resi-input:focus {
            border-color: #503e36;
        }

        .delete-button {
            border: none;
            background: transparent;
            color: #f12c0c;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .delete-button svg {
            width: 22px;
            height: 22px;
        }

        .empty-data {
            padding: 35px;
            color: #999;
        }

        .pagination {
            margin-top: 25px;
        }

        /* NOTIFIKASI */

        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 18px;
            font-size: 13px;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
        }

        /* RESPONSIVE */

        @media (max-width: 1100px) {
            .main-content {
                padding: 25px 20px;
            }

            .table-toolbar {
                margin-bottom: 45px;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 75px;
                padding: 22px 8px;
            }

            .brand {
                justify-content: center;
            }

            .brand-name {
                display: none;
            }

            .menu-link {
                font-size: 12px;
                padding: 12px 4px;
            }

            .main-content {
                margin-left: 75px;
                width: calc(100% - 75px);
                padding: 20px 15px;
            }

            .page-banner {
                align-items: flex-start;
                flex-direction: column;
            }

            .new-order-badge {
                align-self: flex-end;
            }

            .table-card {
                padding: 25px 15px;
            }

            .table-toolbar {
                margin-bottom: 35px;
            }

            .search-box {
                width: 65%;
            }

            .filter-form {
                width: 32%;
            }

            .payment-description {
                font-size: 15px;
            }
        }

        @media (max-width: 480px) {
            .admin-info {
                display: none;
            }

            .topbar-left {
                gap: 12px;
            }

            .page-title {
                font-size: 24px;
            }

            .banner-title,
            .payment-title {
                font-size: 20px;
            }

            .banner-description {
                font-size: 15px;
            }

            .table-toolbar {
                flex-direction: column;
                align-items: stretch;
            }

            .search-box,
            .filter-form {
                width: 100%;
            }
        }
    </style>
</head>

<body>

<div class="layout">

    <!-- SIDEBAR -->

    <aside class="sidebar">

        <div class="brand">
            <div class="brand-logo">G</div>
            <div class="brand-name">Gentala Coffe</div>
        </div>

        <nav class="sidebar-menu">

            <a href="{{ route('admin.dashboard') }}" class="menu-link">
                Beranda
            </a>

            <a href="{{ route('admin.produk.index') }}" class="menu-link">
                Produk
            </a>

            <a href="{{ route('admin.pesanan.index') }}" class="menu-link active">
                Pesanan
            </a>

        </nav>

        <div class="sidebar-logout">
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf

                <button type="submit" class="logout-button" title="Logout">
                    <svg viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2.5"
                         stroke-linecap="round">
                        <path d="M12 2v10"/>
                        <path d="M5.5 5.5a9 9 0 1 0 13 0"/>
                    </svg>
                </button>
            </form>
        </div>

    </aside>

    <!-- KONTEN UTAMA -->

    <main class="main-content">

        <!-- HEADER -->

        <header class="topbar">

            <div class="topbar-left">

                <button class="menu-toggle" type="button">
                    <svg viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="1.8"
                         stroke-linecap="round">
                        <path d="M3 6h18"/>
                        <path d="M3 12h18"/>
                        <path d="M3 18h18"/>
                    </svg>
                </button>

                <h1 class="page-title">Pesanan</h1>

            </div>

            <div class="admin-profile">

                <div class="admin-avatar">
                    {{ strtoupper(substr(Auth::guard('admin')->user()->nama_admin ?? 'A', 0, 1)) }}
                </div>

                <div class="admin-info">
                    <strong>
                        {{ Auth::guard('admin')->user()->nama_admin ?? 'Nama Admin' }}
                    </strong>

                    <span>Admin Kopi Gentala</span>
                </div>

            </div>

        </header>

        <!-- NOTIFIKASI -->

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-error">
                {{ $errors->first() }}
            </div>
        @endif

        <!-- BANNER DAFTAR PESANAN -->

        <section class="page-banner">

            <div>

                <h2 class="banner-title">
                    <svg viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2.3"
                         stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 11.5a8.4 8.4 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.4 8.4 0 0 1-3.8-.9L3 21l1.9-5.7a8.4 8.4 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.4 8.4 0 0 1 3.8-.9h.5a8.5 8.5 0 0 1 8 8v.5z"/>
                        <path d="m8 12 2.5 2.5L16 9"/>
                    </svg>

                    Daftar Pesanan Masuk
                </h2>

                <p class="banner-description">
                    Kelola pesanan pelanggan Kopi Gentala.
                </p>

            </div>

            <div class="new-order-badge">
                {{ $jumlahPesananMasuk }} Pesanan Baru
            </div>

        </section>

        <!-- INFORMASI PEMBAYARAN -->

        <section class="payment-info">

            <h2 class="payment-title">

                <svg viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="1.8"
                     stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 2 20 5v6c0 5-3.5 9-8 11-4.5-2-8-6-8-11V5l8-3z"/>
                    <path d="m8.5 12 2.3 2.3 4.7-5"/>
                </svg>

                Informasi Pembayaran
            </h2>

            <p class="payment-description">
                Admin melakukan pengecekan pembayaran pelanggan melalui WhatsApp
                sebelum pesanan diproses.
            </p>

        </section>

        <!-- TABEL PESANAN -->

        <section class="table-card">

            <div class="table-toolbar">

                <!-- PENCARIAN -->

                <form action="{{ route('admin.pesanan.index') }}"
                      method="GET"
                      class="search-box">

                    <svg viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2"
                         stroke-linecap="round">
                        <circle cx="11" cy="11" r="7"/>
                        <path d="m16 16 5 5"/>
                    </svg>

                    <input
                        type="text"
                        name="search"
                        placeholder="Cari Nama"
                        value="{{ request('search') }}"
                    >

                    @if(request('status'))
                        <input type="hidden" name="status"
                               value="{{ request('status') }}">
                    @endif

                </form>

                <!-- FILTER STATUS -->

                <form action="{{ route('admin.pesanan.index') }}"
                      method="GET"
                      class="filter-form">

                    @if(request('search'))
                        <input type="hidden" name="search"
                               value="{{ request('search') }}">
                    @endif

                    <select name="status"
                            class="filter-select"
                            onchange="this.form.submit()">

                        <option value="">Status Pemesanan</option>

                        <option value="Pesanan Masuk"
                            {{ request('status') === 'Pesanan Masuk' ? 'selected' : '' }}>
                            Pesanan Masuk
                        </option>

                        <option value="Diproses"
                            {{ request('status') === 'Diproses' ? 'selected' : '' }}>
                            Diproses
                        </option>

                        <option value="Dikemas"
                            {{ request('status') === 'Dikemas' ? 'selected' : '' }}>
                            Dikemas
                        </option>

                        <option value="Dikirim"
                            {{ request('status') === 'Dikirim' ? 'selected' : '' }}>
                            Dikirim
                        </option>

                        <option value="Diantar"
                            {{ request('status') === 'Diantar' ? 'selected' : '' }}>
                            Diantar
                        </option>

                        <option value="Selesai"
                            {{ request('status') === 'Selesai' ? 'selected' : '' }}>
                            Selesai
                        </option>

                        <option value="Dibatalkan"
                            {{ request('status') === 'Dibatalkan' ? 'selected' : '' }}>
                            Dibatalkan
                        </option>

                    </select>

                </form>

            </div>

            <!-- ISI TABEL -->

            <div class="table-wrapper">

                <table>

                    <thead>
                        <tr>
                            <th>ID Pesanan</th>
                            <th>ID Pelanggan</th>
                            <th>Produk yang Dipesan</th>
                            <th>Total Pembayaran</th>
                            <th>Status</th>
                            <th>Aksi</th>
                            <th>No. Resi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($pesanan as $item)

                            <tr>

                                <!-- ID PESANAN -->

                                <td>
                                    PSN-{{ str_pad($item->id_pesanan, 3, '0', STR_PAD_LEFT) }}
                                </td>

                                <!-- ID PELANGGAN -->

                                <td>
                                    PLG-{{ str_pad($item->id_pelanggan, 3, '0', STR_PAD_LEFT) }}
                                </td>

                                <!-- PRODUK -->

                                <td>
                                    <div class="product-name">

                                        @foreach($item->detail as $detail)

                                            <div>
                                                {{ $detail->produk->nama_produk ?? 'Produk tidak tersedia' }}
                                            </div>

                                        @endforeach

                                    </div>
                                </td>

                                <!-- TOTAL PEMBAYARAN -->

                                <td>
                                    Rp{{ number_format($item->total_harga, 0, ',', '.') }}
                                </td>

                                <!-- STATUS -->

                                <td>

                                    <form
                                        action="{{ route('admin.pesanan.update-status', $item->id_pesanan) }}"
                                        method="POST"
                                        class="status-form"
                                    >

                                        @csrf
                                        @method('PUT')

                                        <input type="hidden"
                                               name="nama_ekspedisi"
                                               value="{{ $item->pengiriman->nama_ekspedisi ?? '' }}">

                                        <input type="hidden"
                                               name="no_resi"
                                               value="{{ $item->pengiriman->no_resi ?? '' }}"
                                               class="resi-hidden">

                                        <select
                                            name="status_pesanan"
                                            class="status-select"
                                            onchange="this.form.submit()"
                                        >

                                            <option value="Pesanan Masuk"
                                                {{ $item->status_pesanan === 'Pesanan Masuk' ? 'selected' : '' }}>
                                                Pesanan Masuk
                                            </option>

                                            <option value="Diproses"
                                                {{ $item->status_pesanan === 'Diproses' ? 'selected' : '' }}>
                                                Diproses
                                            </option>

                                            <option value="Dikemas"
                                                {{ $item->status_pesanan === 'Dikemas' ? 'selected' : '' }}>
                                                Dikemas
                                            </option>

                                            <option value="Dikirim"
                                                {{ $item->status_pesanan === 'Dikirim' ? 'selected' : '' }}>
                                                Dikirim
                                            </option>

                                            <option value="Diantar"
                                                {{ $item->status_pesanan === 'Diantar' ? 'selected' : '' }}>
                                                Diantar
                                            </option>

                                            <option value="Selesai"
                                                {{ $item->status_pesanan === 'Selesai' ? 'selected' : '' }}>
                                                Selesai
                                            </option>

                                            <option value="Dibatalkan"
                                                {{ $item->status_pesanan === 'Dibatalkan' ? 'selected' : '' }}>
                                                Dibatalkan
                                            </option>

                                        </select>

                                    </form>

                                </td>

                                <!-- AKSI -->

                                <td>

                                    <button type="button"
                                            class="delete-button"
                                            title="Hapus pesanan"
                                            onclick="alert('Fitur hapus pesanan belum dihubungkan.')">

                                        <svg viewBox="0 0 24 24" fill="none"
                                             stroke="currentColor" stroke-width="1.8"
                                             stroke-linecap="round"
                                             stroke-linejoin="round">
                                            <path d="M3 6h18"/>
                                            <path d="M8 6V4h8v2"/>
                                            <path d="m19 6-1 14H6L5 6"/>
                                            <path d="M10 11v5"/>
                                            <path d="M14 11v5"/>
                                        </svg>

                                    </button>

                                </td>

                                <!-- NOMOR RESI -->

                                <td>

                                    <form
                                        action="{{ route('admin.pesanan.update-status', $item->id_pesanan) }}"
                                        method="POST"
                                        class="status-form"
                                    >

                                        @csrf
                                        @method('PUT')

                                        <input type="hidden"
                                               name="status_pesanan"
                                               value="{{ $item->status_pesanan }}">

                                        <input type="hidden"
                                               name="nama_ekspedisi"
                                               value="{{ $item->pengiriman->nama_ekspedisi ?? '' }}">

                                        <input
                                            type="text"
                                            name="no_resi"
                                            class="resi-input"
                                            placeholder="No. resi"
                                            value="{{ $item->pengiriman->no_resi ?? '' }}"
                                            onchange="this.form.submit()"
                                        >

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="7" class="empty-data">
                                    Belum ada pesanan yang ditemukan.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <!-- PAGINATION -->

            <div class="pagination">
                {{ $pesanan->links() }}
            </div>

        </section>

    </main>

</div>

</body>
</html>
