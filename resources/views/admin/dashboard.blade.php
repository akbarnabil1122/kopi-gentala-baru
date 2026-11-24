
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Gentala Coffe</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #fff;
            color: #503e36;
        }

        .dashboard-layout {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */

        .sidebar {
            width: 300px;
            min-height: 100vh;
            background: #fff;
            box-shadow: 5px 0 25px rgba(0,0,0,.06);
            display: flex;
            flex-direction: column;
            padding: 30px 28px;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            z-index: 10;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 65px;
            white-space: nowrap;
        }

        .brand-logo {
            width: 52px;
            height: 52px;
            background: #24170f;
            color: white;
            border: 4px double #c4a77d;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Georgia, serif;
            font-size: 19px;
        }

        .brand-name {
            font-family: Georgia, serif;
            font-size: 25px;
            font-weight: bold;
        }

        .sidebar-menu {
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .menu-link {
            text-decoration: none;
            color: #503e36;
            font-family: Georgia, serif;
            font-size: 18px;
            font-weight: bold;
            padding: 14px 20px;
            border-radius: 10px;
            text-align: center;
            transition: .2s;
        }

        .menu-link:hover,
        .menu-link.active {
            background: #503e36;
            color: #fff;
            box-shadow: 0 5px 18px rgba(80,62,54,.25);
        }

        .sidebar-logout {
            margin-top: auto;
            display: flex;
            justify-content: center;
        }

        .logout-button {
            border: none;
            background: transparent;
            color: #503e36;
            cursor: pointer;
            padding: 12px;
        }

        .logout-button svg {
            width: 30px;
            height: 30px;
        }

        /* KONTEN UTAMA */

        .main-content {
            margin-left: 300px;
            width: calc(100% - 300px);
            padding: 30px 38px;
        }

        /* HEADER */

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 38px;
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 28px;
        }

        .menu-toggle {
            border: none;
            background: transparent;
            cursor: pointer;
            color: #222;
        }

        .menu-toggle svg {
            width: 30px;
            height: 30px;
        }

        .page-title {
            font-family: Georgia, serif;
            font-size: 30px;
            color: #000;
        }

        .profile-icon {
            color: #666;
        }

        .profile-icon svg {
            width: 32px;
            height: 32px;
        }

        /* NOTIFIKASI */

        .notification-card {
            background: #fff;
            border-radius: 20px;
            padding: 25px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            box-shadow: 0 5px 25px rgba(0,0,0,.08);
            margin-bottom: 48px;
        }

        .notification-title {
            display: flex;
            align-items: center;
            gap: 12px;
            font-family: Georgia, serif;
            font-size: 25px;
            color: #000;
            margin-bottom: 8px;
        }

        .notification-title svg {
            width: 32px;
            height: 32px;
            color: #503e36;
        }

        .notification-description {
            color: #aaa;
            font-family: Georgia, serif;
            font-size: 20px;
        }

        .notification-button {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 12px 20px;
            border-radius: 30px;
            background: #503e36;
            color: #fff;
            text-decoration: none;
            font-size: 16px;
            white-space: nowrap;
            box-shadow: 0 3px 8px rgba(0,0,0,.2);
        }

        .notification-button:hover {
            background: #604b41;
        }

        /* STATISTIK */

        .statistics {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 40px;
            margin-bottom: 48px;
        }

        .stat-card {
            min-height: 205px;
            background: #f8f5f4;
            border: 1px solid #e9e2df;
            border-radius: 20px;
            box-shadow: 0 4px 7px rgba(0,0,0,.3);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 20px 10px;
        }

        .stat-icon {
            width: 36px;
            height: 36px;
            margin-bottom: 8px;
            color: #503e36;
        }

        .stat-title {
            font-family: Georgia, serif;
            font-size: 22px;
            margin-bottom: 5px;
        }

        .stat-value {
            font-size: 26px;
            font-weight: bold;
            color: #503e36;
        }

        .stat-unit {
            font-size: 15px;
            font-weight: normal;
        }

        /* TABEL PESANAN */

        .orders-card {
            background: #fff;
            border-radius: 28px;
            padding: 48px 55px;
            box-shadow: 0 5px 25px rgba(0,0,0,.13);
            overflow-x: auto;
        }

        .orders-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 750px;
            color: #111;
        }

        .orders-table th,
        .orders-table td {
            border: 1px solid #c8c8c8;
            padding: 15px 12px;
            text-align: center;
            font-size: 15px;
        }

        .orders-table th {
            font-weight: bold;
            background: #fff;
        }

        .orders-table tr:hover td {
            background: #faf8f7;
        }

        .status {
            display: inline-block;
            min-width: 175px;
            padding: 8px 14px;
            border-radius: 30px;
            font-weight: bold;
        }

        .status-masuk {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .status-diproses {
            background: #fef3c7;
            color: #b45309;
        }

        .status-dikemas {
            background: #f3e8ff;
            color: #9333ea;
        }

        .status-dikirim {
            background: #e0e7ff;
            color: #4338ca;
        }

        .status-diantar {
            background: #cffafe;
            color: #0e7490;
        }

        .status-selesai {
            background: #dcfce7;
            color: #15803d;
        }

        .status-dibatalkan {
            background: #fee2e2;
            color: #b91c1c;
        }

        .empty-data {
            padding: 35px;
            text-align: center;
            color: #888;
        }

        /* RESPONSIVE */

        @media (max-width: 1200px) {
            .statistics {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 25px;
            }

            .notification-description {
                font-size: 16px;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 230px;
                padding: 25px 18px;
            }

            .main-content {
                margin-left: 230px;
                width: calc(100% - 230px);
                padding: 25px 20px;
            }

            .brand-name {
                font-size: 19px;
            }

            .brand-logo {
                width: 42px;
                height: 42px;
            }

            .notification-card {
                flex-direction: column;
                align-items: flex-start;
            }

            .notification-title {
                font-size: 20px;
            }

            .statistics {
                grid-template-columns: 1fr;
            }

            .orders-card {
                padding: 25px 18px;
            }
        }

        @media (max-width: 520px) {
            .sidebar {
                width: 75px;
                padding: 20px 8px;
            }

            .brand {
                justify-content: center;
            }

            .brand-name,
            .menu-link span {
                display: none;
            }

            .menu-link {
                font-size: 13px;
                padding: 12px 5px;
            }

            .main-content {
                margin-left: 75px;
                width: calc(100% - 75px);
                padding: 20px 12px;
            }

            .page-title {
                font-size: 23px;
            }

            .topbar-left {
                gap: 12px;
            }

            .notification-description {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>

<div class="dashboard-layout">

    <!-- SIDEBAR -->

    <aside class="sidebar">

        <div class="brand">
            <div class="brand-logo">G</div>
            <div class="brand-name">Gentala Coffe</div>
        </div>

        <nav class="sidebar-menu">

            <a href="{{ route('admin.dashboard') }}"
            class="menu-link active">
                Beranda
            </a>

            <a href="{{ route('admin.produk.index') }}"
            class="menu-link">
                Produk
            </a>

            <a href="{{ route('admin.pesanan.index') }}" class="menu-link">
                Pesanan
            </a>

        </nav>

        <div class="sidebar-logout">

            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf

                <button type="submit"
                        class="logout-button"
                        title="Logout">

                    <svg viewBox="0 0 24 24"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="2.5"
                         stroke-linecap="round"
                         stroke-linejoin="round">

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
                    <svg viewBox="0 0 24 24"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="1.8"
                         stroke-linecap="round">

                        <path d="M3 6h18"/>
                        <path d="M3 12h18"/>
                        <path d="M3 18h18"/>

                    </svg>
                </button>

                <h1 class="page-title">Beranda</h1>

            </div>

            <div class="profile-icon" title="Administrator">

                <svg viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2a10 10 0 1 0 0 20 10 10 0 0 0 0-20zm0 4a3.2 3.2 0 1 1 0 6.4A3.2 3.2 0 0 1 12 6zm0 12.5a7.4 7.4 0 0 1-5.8-2.8c.1-1.9 3.9-2.9 5.8-2.9s5.7 1 5.8 2.9a7.4 7.4 0 0 1-5.8 2.8z"/>
                </svg>

            </div>

        </header>

        <!-- NOTIFIKASI PESANAN -->

        <section class="notification-card">

            <div>

                <h2 class="notification-title">

                    <svg viewBox="0 0 24 24"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="1.7"
                         stroke-linecap="round"
                         stroke-linejoin="round">

                        <path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"/>
                        <path d="M10 21h4"/>

                    </svg>

                    Notifikasi Pesanan Masuk

                </h2>

                <p class="notification-description">

                    Terdapat {{ $jumlahPesananMasuk }} pesanan baru yang telah masuk.
                    Periksa pesanan untuk melanjutkan proses penanganan.

                </p>

            </div>

            <a href="#tabel-pesanan" class="notification-button">

                Lihat Pesanan Masuk
                <span>→</span>

            </a>

        </section>

        <!-- KARTU STATISTIK -->

        <section class="statistics">

            <!-- PENJUALAN -->

            <div class="stat-card">

                <svg class="stat-icon"
                     viewBox="0 0 24 24"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="1.8">

                    <rect x="3" y="11" width="6" height="10"/>
                    <rect x="9" y="4" width="6" height="17"/>
                    <rect x="15" y="8" width="6" height="13"/>

                </svg>

                <h3 class="stat-title">Penjualan Bulan Ini</h3>

                <p class="stat-value">
                    Rp{{ number_format($penjualanBulanIni, 0, ',', '.') }}
                </p>

            </div>

            <!-- PRODUK TERJUAL -->

            <div class="stat-card">

                <svg class="stat-icon"
                     viewBox="0 0 24 24"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="1.8">

                    <circle cx="12" cy="12" r="10"/>
                    <path d="M12 2v10l7 4"/>

                </svg>

                <h3 class="stat-title">Produk Terjual</h3>

                <p class="stat-value">
                    {{ number_format($produkTerjual, 0, ',', '.') }}<span class="stat-unit"> pcs</span>
                </p>

            </div>

            <!-- PROFIT -->

            <div class="stat-card">

                <svg class="stat-icon"
                     viewBox="0 0 24 24"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="1.8"
                     stroke-linecap="round"
                     stroke-linejoin="round">

                    <path d="M3 3v18h18"/>
                    <path d="m6 14 4-4 3 3 6-7"/>
                    <path d="M15 6h4v4"/>

                </svg>

                <h3 class="stat-title">Profit Bulanan</h3>

                <p class="stat-value">
                    Rp{{ number_format($profitBulanan, 0, ',', '.') }}
                </p>

            </div>

            <!-- PELANGGAN -->

            <div class="stat-card">

                <svg class="stat-icon"
                     viewBox="0 0 24 24"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="1.8">

                    <path d="M3 3v18h18"/>
                    <circle cx="9" cy="9" r="1"/>
                    <circle cx="16" cy="7" r="1"/>
                    <circle cx="14" cy="15" r="1"/>
                    <circle cx="19" cy="12" r="1"/>

                </svg>

                <h3 class="stat-title">Data Pelanggan</h3>

                <p class="stat-value">
                    {{ number_format($jumlahPelanggan, 0, ',', '.') }}
                    <span class="stat-unit"> org</span>
                </p>

            </div>

        </section>

        <!-- TABEL PESANAN TERBARU -->

        <section class="orders-card" id="tabel-pesanan">

            <table class="orders-table">

                <thead>
                    <tr>
                        <th>ID Pesanan</th>
                        <th>Nama Pelanggan</th>
                        <th>Produk/Item</th>
                        <th>Total Tagihan</th>
                        <th>Status Pesanan</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($pesananTerbaru as $pesanan)

                        @php
                            $daftarProduk = $pesanan->detail
                                ->map(function ($detail) {
                                    return $detail->produk
                                        ? $detail->produk->nama_produk
                                        : null;
                                })
                                ->filter()
                                ->unique()
                                ->implode(', ');

                            $statusClass = match($pesanan->status_pesanan) {
                                'Pesanan Masuk' => 'status-masuk',
                                'Diproses' => 'status-diproses',
                                'Dikemas' => 'status-dikemas',
                                'Dikirim' => 'status-dikirim',
                                'Diantar' => 'status-diantar',
                                'Selesai' => 'status-selesai',
                                'Dibatalkan' => 'status-dibatalkan',
                                default => ''
                            };
                        @endphp

                        <tr>

                            <td>
                                PSN-{{ str_pad($pesanan->id_pesanan, 3, '0', STR_PAD_LEFT) }}
                            </td>

                            <td>
                                {{ $pesanan->pelanggan->nama_pelanggan ?? 'Pelanggan tidak ditemukan' }}
                            </td>

                            <td>
                                {{ $daftarProduk ?: '-' }}
                            </td>

                            <td>
                                Rp{{ number_format((float) $pesanan->total_harga, 0, ',', '.') }}
                            </td>

                            <td>
                                <span class="status {{ $statusClass }}">
                                    {{ $pesanan->status_pesanan }}
                                </span>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="5" class="empty-data">
                                Belum ada pesanan yang masuk.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </section>

    </main>

</div>

</body>
</html>
