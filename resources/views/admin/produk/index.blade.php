
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Produk - Gentala Coffe</title>

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

        /* MAIN */

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

        .profile-icon svg {
            width: 31px;
            height: 31px;
            color: #666;
        }

        /* HEADER PRODUK */

        .page-banner {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            background: white;
            border-radius: 20px;
            padding: 24px;
            box-shadow: 0 5px 25px rgba(0,0,0,.07);
            margin-bottom: 30px;
        }

        .banner-title {
            display: flex;
            align-items: center;
            gap: 15px;
            font-family: Georgia, serif;
            font-size: 25px;
            color: #111;
            margin-bottom: 7px;
        }

        .banner-title svg {
            width: 44px;
            height: 44px;
            color: #503e36;
        }

        .banner-description {
            font-family: Georgia, serif;
            color: #aaa;
            font-size: 20px;
        }

        .banner-actions {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 14px;
            border-radius: 9px;
            border: 1px solid #ccc;
            background: #fff;
            color: #111;
            font-size: 13px;
            cursor: pointer;
            text-decoration: none;
            white-space: nowrap;
            box-shadow: 0 3px 6px rgba(0,0,0,.16);
        }

        .button-primary {
            background: #503e36;
            color: white;
            border-color: #503e36;
        }

        .button-primary:hover {
            background: #604b41;
        }

        .button svg {
            width: 17px;
            height: 17px;
        }

        /* ALERT */

        .alert {
            padding: 13px 18px;
            border-radius: 9px;
            margin-bottom: 22px;
            font-size: 14px;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
        }

        /* STATISTIK */

        .statistics {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 36px;
            margin-bottom: 52px;
        }

        .stat-card {
            min-height: 145px;
            background: #f8f5f4;
            border: 1px solid #e9e2df;
            border-radius: 19px;
            box-shadow: 0 4px 7px rgba(0,0,0,.28);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 15px;
        }

        .stat-card svg {
            width: 30px;
            height: 30px;
            margin-bottom: 5px;
        }

        .stat-title {
            font-family: Georgia, serif;
            font-size: 22px;
            margin-bottom: 3px;
        }

        .stat-value {
            font-size: 25px;
            font-weight: bold;
        }

        .stat-unit {
            font-size: 15px;
            font-weight: normal;
        }

        /* TABEL */

        .table-card {
            min-height: 515px;
            padding: 32px 35px;
            background: #fff;
            border-radius: 25px;
            box-shadow: 0 5px 25px rgba(0,0,0,.1);
        }

        .table-toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 43px;
        }

        .search-box {
            width: 400px;
            max-width: 100%;
            height: 40px;
            background: #f3f1f1;
            border-radius: 9px;
            display: flex;
            align-items: center;
            padding: 0 15px;
            gap: 10px;
        }

        .search-box svg {
            width: 18px;
            height: 18px;
            color: #aaa;
        }

        .search-box input {
            border: none;
            outline: none;
            background: transparent;
            width: 100%;
            font-size: 13px;
        }

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 850px;
            color: #111;
        }

        th, td {
            border: 1px solid #c8c8c8;
            padding: 15px 11px;
            text-align: center;
            font-size: 14px;
        }

        th {
            font-weight: bold;
        }

        tbody tr:hover {
            background: #faf8f7;
        }

        .status {
            display: inline-block;
            min-width: 100px;
            padding: 7px 12px;
            border-radius: 25px;
            font-size: 13px;
            font-weight: bold;
        }

        .status-tersedia {
            background: #dcfce7;
            color: #15803d;
        }

        .status-menipis {
            background: #fef3c7;
            color: #b45309;
        }

        .status-habis {
            background: #fee2e2;
            color: #b91c1c;
        }

        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 13px;
        }

        .icon-button {
            border: none;
            background: transparent;
            cursor: pointer;
            padding: 2px;
        }

        .icon-button svg {
            width: 21px;
            height: 21px;
        }

        .edit-button {
            color: #111;
        }

        .delete-button {
            color: #e32616;
        }

        .empty-data {
            padding: 30px;
            color: #888;
        }

        .pagination {
            margin-top: 25px;
        }

        /* MODAL */

        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,.48);
            z-index: 100;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .modal-overlay.active {
            display: flex;
        }

        .modal {
            width: 100%;
            max-width: 550px;
            max-height: 90vh;
            overflow-y: auto;
            background: white;
            border-radius: 15px;
            padding: 28px;
            color: #333;
        }

        .modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 23px;
        }

        .modal-header h2 {
            font-family: Georgia, serif;
            font-size: 24px;
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 30px;
            cursor: pointer;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 7px;
        }

        .form-control {
            width: 100%;
            padding: 11px 13px;
            border: 1px solid #ccc;
            border-radius: 7px;
            outline: none;
            font-size: 14px;
        }

        .form-control:focus {
            border-color: #503e36;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 75px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 13px;
        }

        .modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 25px;
        }

        .cancel-button {
            background: white;
            border: 1px solid #aaa;
            color: #333;
            padding: 10px 18px;
            border-radius: 8px;
            cursor: pointer;
        }

        .save-button {
            background: #503e36;
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
        }

        /* MODAL KELOLA STOK */
        .stock-summary {
            border: 1px solid #aaa;
            border-radius: 8px;
            padding: 14px 15px;
            margin-bottom: 28px;
            background: #f8f5f4;
        }

        .stock-product-name {
            font-size: 17px;
            margin: 8px 0 13px;
        }

        .stock-current {
            display: flex;
            justify-content: space-between;
            color: #777;
            font-size: 13px;
            border-top: 1px solid #aaa;
            padding-top: 10px;
        }

        .stock-options {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
            margin: 14px 0 25px;
        }

        .stock-option {
            position: relative;
        }

        .stock-option input {
            position: absolute;
            opacity: 0;
        }

        .stock-option label {
            min-height: 82px;
            border: 1px solid #aaa;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 8px;
            cursor: pointer;
            color: #503e36;
        }

        .stock-option input:checked + label {
            border: 1.5px solid #503e36;
            background: #f8f5f4;
        }

        .stock-option svg {
            width: 22px;
            height: 22px;
        }

        .stock-preview {
            margin: 18px 0 5px;
            padding: 0 10px;
        }

        .stock-preview small {
            color: #999;
        }

        .stock-preview strong {
            display: block;
            font-size: 20px;
            font-weight: normal;
            margin: 5px 0;
            color: #111;
        }

        .modal-danger {
            max-width: 430px;
            text-align: center;
        }

        .delete-warning-icon {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: #fee9e7;
            color: #d93827;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }

        .delete-warning-icon svg {
            width: 35px;
            height: 35px;
        }

        .delete-details {
            text-align: left;
            margin: 22px 0;
        }

        .delete-detail-row {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            padding: 13px 3px;
            border-bottom: 1px solid #ddd;
            font-size: 14px;
        }

        .delete-info {
            background: #fff3e0;
            color: #8a4b08;
            padding: 13px;
            border-radius: 8px;
            text-align: left;
            font-size: 13px;
            line-height: 1.5;
        }

        .delete-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
            margin-top: 22px;
        }

        .delete-confirm {
            background: #df2d0b;
            border: none;
            color: white;
            padding: 12px;
            border-radius: 9px;
            cursor: pointer;
        }

        .delete-cancel {
            background: white;
            border: 1px solid #ddd;
            color: #111;
            padding: 12px;
            border-radius: 9px;
            cursor: pointer;
        }

        /* RESPONSIVE */

        @media (max-width: 1050px) {
            .statistics {
                gap: 18px;
            }

            .banner-description {
                font-size: 16px;
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

            .banner-actions {
                width: 100%;
                flex-wrap: wrap;
            }

            .statistics {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .table-card {
                padding: 25px 15px;
            }

            .table-toolbar {
                margin-bottom: 25px;
            }
        }

        @media (max-width: 480px) {
            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }

            .brand-logo {
                width: 40px;
                height: 40px;
            }

            .banner-title {
                font-size: 21px;
            }

            .banner-description {
                font-size: 14px;
            }

            .topbar-left {
                gap: 12px;
            }

            .page-title {
                font-size: 24px;
            }
        }


        /* POP-UP BERHASIL */
        .success-overlay {
            position: fixed;
            inset: 0;
            z-index: 99999;
            background: rgba(0, 0, 0, .25);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 16px;
        }

        .success-modal {
            width: 100%;
            max-width: 543px;
            min-height: 319px;
            background: #fff;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 35px 20px;
            text-align: center;
            animation: successFadeIn .22s ease-out;
        }

        .success-icon {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: #e4f5e9;
            color: #229b55;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 42px;
        }

        .success-icon svg {
            width: 30px;
            height: 30px;
        }

        .success-modal h2 {
            font-family: Arial, sans-serif;
            font-size: 23px;
            font-weight: 600;
            color: #111;
            margin: 0 0 43px;
        }

        .success-modal button {
            background: #503e36;
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 10px 19px;
            font-size: 15px;
            cursor: pointer;
            box-shadow: 0 4px 7px rgba(0, 0, 0, .2);
        }

        .success-modal button:hover {
            background: #392a24;
        }

        @keyframes successFadeIn {
            from { opacity: 0; transform: scale(.96); }
            to { opacity: 1; transform: scale(1); }
        }

        @media (max-width: 480px) {
            .success-modal h2 { font-size: 20px; }
        }


        /* POP-UP BERHASIL UNDUH LAPORAN */
        .download-success-modal {
            width: 100%;
            max-width: 543px;
            min-height: 319px;
            background: #fff;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 30px 35px;
            text-align: center;
            animation: successFadeIn .22s ease-out;
        }

        .download-success-modal .success-icon {
            margin-bottom: 7px;
        }

        .download-success-modal h2 {
            font-family: Arial, sans-serif;
            font-size: 23px;
            font-weight: 600;
            color: #111;
            margin: 0 0 5px;
        }

        .download-description {
            color: #aaa;
            font-size: 13px;
            margin-bottom: 13px;
        }

        .download-file-row {
            width: 100%;
            max-width: 330px;
            display: flex;
            align-items: center;
            gap: 12px;
            text-align: left;
            margin-bottom: 17px;
        }

        .download-file-icon {
            width: 22px;
            height: 22px;
            flex: 0 0 22px;
            color: #159447;
        }

        .download-file-details {
            min-width: 0;
            flex: 1;
        }

        .download-file-name {
            color: #111;
            font-size: 13px;
            font-weight: 600;
            overflow-wrap: anywhere;
        }

        .download-file-type {
            color: #aaa;
            font-size: 11px;
            margin-top: 3px;
        }

        .download-file-check {
            width: 17px;
            height: 17px;
            flex: 0 0 17px;
            color: #347a2b;
        }

        .download-success-modal button {
            background: #503e36;
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 10px 19px;
            font-size: 15px;
            cursor: pointer;
            box-shadow: 0 4px 7px rgba(0, 0, 0, .2);
        }

        .download-success-modal button:hover {
            background: #392a24;
        }

        #tombolUnduhStok:disabled {
            opacity: .65;
            cursor: wait;
        }

        @media (max-width: 480px) {
            .download-success-modal {
                padding: 25px 18px;
            }

            .download-success-modal h2 {
                font-size: 20px;
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

            <a href="{{ route('admin.produk.index') }}" class="menu-link active">
                Produk
            </a>

            <a href="{{ route('admin.pesanan.index') }}" class="menu-link">
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

                <h1 class="page-title">Produk</h1>
            </div>

            <div class="profile-icon">
                <svg viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2a10 10 0 1 0 0 20 10 10 0 0 0 0-20zm0 4a3.2 3.2 0 1 1 0 6.4A3.2 3.2 0 0 1 12 6zm0 12.5a7.4 7.4 0 0 1-5.8-2.8c.1-1.9 3.9-2.9 5.8-2.9s5.7 1 5.8 2.9a7.4 7.4 0 0 1-5.8 2.8z"/>
                </svg>
            </div>

        </header>

        <!-- PESAN NOTIFIKASI -->

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

        <!-- HEADER MANAJEMEN PRODUK -->

        <section class="page-banner">

            <div>
                <h2 class="banner-title">
                    <svg viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="1.5"
                         stroke-linecap="round" stroke-linejoin="round">
                        <path d="m3 7 6-3 6 3-6 3-6-3z"/>
                        <path d="M9 10v7"/>
                        <path d="m3 7 0 7 6 3"/>
                        <path d="m15 7 0 7-6 3"/>
                        <path d="m13 14 5-2.5 4 2.5-5 2.5-4-2.5z"/>
                        <path d="M18 17v5"/>
                        <path d="m13 14v5l5 3 4-3v-5"/>
                        <path d="M18 4v5"/>
                        <path d="m15 6 3-2 3 2"/>
                    </svg>

                    Manajemen Produk
                </h2>

                <p class="banner-description">
                    Kelola informasi produk dan ketersediaan stok Kopi Gentala.
                </p>
            </div>

            <div class="banner-actions">

                <button
                    type="button"
                    class="button"
                    id="tombolUnduhStok"
                    data-url="{{ route('admin.produk.export') }}"
                    onclick="unduhLaporanStok(this)"
                >
                    <svg viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2"
                         stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 3v12"/>
                        <path d="m7 10 5 5 5-5"/>
                        <path d="M5 17v4h14v-4"/>
                    </svg>
                    Unduh laporan stok
                </button>

                <button type="button"
                        class="button button-primary"
                        onclick="bukaModalTambah()">

                    <svg viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2"
                         stroke-linecap="round">
                        <circle cx="12" cy="12" r="9"/>
                        <path d="M12 8v8M8 12h8"/>
                    </svg>

                    Tambah Produk
                </button>

            </div>

        </section>

        <!-- STATISTIK -->

        <section class="statistics">

            <div class="stat-card">

                <svg viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="1.5">
                    <path d="M3 7h10v14H3z"/>
                    <path d="M13 12h8v9h-8z"/>
                    <path d="M7 7V3h10l4 4v5"/>
                </svg>

                <h3 class="stat-title">Total Produk</h3>

                <p class="stat-value">
                    {{ number_format($totalProduk, 0, ',', '.') }}
                    <span class="stat-unit">varian</span>
                </p>

            </div>

            <div class="stat-card">

                <svg viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="1.5">
                    <path d="m12 2 10 5-10 5L2 7l10-5z"/>
                    <path d="M2 7v10l10 5 10-5V7"/>
                    <path d="M12 12v10"/>
                </svg>

                <h3 class="stat-title">Total Stok</h3>

                <p class="stat-value">
                    {{ number_format($totalStok, 0, ',', '.') }}
                    <span class="stat-unit">pcs</span>
                </p>

            </div>

            <div class="stat-card">

                <svg viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="1.5">
                    <rect x="3" y="3" width="7" height="7"/>
                    <rect x="14" y="3" width="7" height="7"/>
                    <rect x="3" y="14" width="7" height="7"/>
                    <path d="M17.5 14v7M14 17.5h7"/>
                </svg>

                <h3 class="stat-title">Stok Menipis</h3>

                <p class="stat-value">
                    {{ number_format($stokMenipis, 0, ',', '.') }}
                </p>

            </div>

        </section>

        <!-- TABEL PRODUK -->

        <section class="table-card">

            <div class="table-toolbar">

                <form action="{{ route('admin.produk.index') }}"
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
                        name="cari"
                        placeholder="Cari Nama"
                        value="{{ $cari }}"
                    >

                </form>

            </div>

            <div class="table-wrapper">

                <table>

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Jenis</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($produk as $index => $item)

                            @php
                                if ($item->stok <= 0) {
                                    $status = 'Habis';
                                    $statusClass = 'status-habis';
                                } elseif ($item->stok <= 10) {
                                    $status = 'Stok Menipis';
                                    $statusClass = 'status-menipis';
                                } else {
                                    $status = 'Tersedia';
                                    $statusClass = 'status-tersedia';
                                }

                                $jenisTampilan = $item->jenis_kopi === 'Kopi Roasted'
                                    ? 'Biji Kopi'
                                    : $item->jenis_kopi;
                            @endphp

                            <tr>

                                <td>
                                    {{ $produk->firstItem() + $index }}
                                </td>

                                <td>
                                    {{ $item->nama_produk }}
                                </td>

                                <td>
                                    {{ $jenisTampilan }}
                                </td>

                                <td>
                                    Rp{{ number_format($item->harga, 0, ',', '.') }}
                                </td>

                                <td>
                                    {{ number_format($item->stok, 0, ',', '.') }}
                                </td>

                                <td>
                                    <span class="status {{ $statusClass }}">
                                        {{ $item->status_aktif ? $status : 'Nonaktif' }}
                                    </span>
                                </td>

                                <td>

                                    <div class="action-buttons">

                                        <!-- TOMBOL KELOLA STOK -->
                                        <button
                                            type="button"
                                            class="icon-button edit-button"
                                            title="Kelola Stok"
                                            onclick="bukaModalStok(this)"
                                            data-url="{{ route('admin.produk.update', $item->id_produk) }}"
                                            data-nama="{{ $item->nama_produk }}"
                                            data-jenis="{{ $jenisTampilan }}"
                                            data-stok="{{ $item->stok }}"
                                        >
                                            <svg viewBox="0 0 24 24" fill="none"
                                                 stroke="currentColor" stroke-width="2"
                                                 stroke-linecap="round" stroke-linejoin="round">
                                                <path d="m15 5 4 4"/>
                                                <path d="M4 20l4-.8L19 8a2.8 2.8 0 0 0-4-4L4 15z"/>
                                            </svg>
                                        </button>

                                        <!-- TOMBOL HAPUS -->
                                        <button
                                            type="button"
                                            class="icon-button delete-button"
                                            title="Hapus Produk"
                                            onclick="bukaModalHapus(this)"
                                            data-url="{{ route('admin.produk.destroy', $item->id_produk) }}"
                                            data-nama="{{ $item->nama_produk }}"
                                            data-jenis="{{ $jenisTampilan }}"
                                            data-stok="{{ $item->stok }}"
                                        >
                                            <svg viewBox="0 0 24 24" fill="none"
                                                 stroke="currentColor" stroke-width="1.8"
                                                 stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M3 6h18"/>
                                                <path d="M8 6V4h8v2"/>
                                                <path d="m19 6-1 15H6L5 6"/>
                                                <path d="M10 11v6M14 11v6"/>
                                            </svg>
                                        </button>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="7" class="empty-data">
                                    Produk tidak ditemukan.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="pagination">
                {{ $produk->links() }}
            </div>

        </section>

    </main>

</div>

<!-- MODAL TAMBAH PRODUK -->

<div class="modal-overlay" id="modalTambah">

    <div class="modal">

        <div class="modal-header">
            <h2>Tambah Produk</h2>

            <button type="button" class="modal-close"
                    onclick="tutupModal('modalTambah')">
                &times;
            </button>
        </div>

        <form action="{{ route('admin.produk.store') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <div class="form-group">
                <label>Nama Produk</label>
                <input type="text" name="nama_produk"
                       class="form-control" required>
            </div>

            <div class="form-group">
                <label>Jenis Kopi</label>

                <select name="jenis_kopi" class="form-control" required>
                    <option value="">Pilih Jenis Kopi</option>
                    <option value="Kopi Bubuk">Kopi Bubuk</option>
                    <option value="Kopi Roasted">Biji Kopi</option>
                </select>
            </div>

            <div class="form-group">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control"></textarea>
            </div>

            <div class="form-row">

                <div class="form-group">
                    <label>Ukuran Kemasan (gram)</label>
                    <input type="number" name="ukuran_kemasan"
                           class="form-control" min="1" required>
                </div>

                <div class="form-group">
                    <label>Stok</label>
                    <input type="number" name="stok"
                           class="form-control" min="0" required>
                </div>

            </div>

            <div class="form-row">

                <div class="form-group">
                    <label>Harga Jual (Rp)</label>
                    <input type="number" name="harga"
                           class="form-control" min="0" required>
                </div>

                <div class="form-group">
                    <label>Harga Modal (Rp)</label>
                    <input type="number" name="harga_modal"
                           class="form-control" min="0" required>
                </div>

            </div>

            <div class="form-group">
                <label>Gambar Produk (opsional)</label>
                <input type="file" name="gambar"
                       class="form-control" accept="image/*">
            </div>

            <div class="modal-actions">
                <button type="button" class="cancel-button"
                        onclick="tutupModal('modalTambah')">
                    Batal
                </button>

                <button type="submit" class="save-button">
                    Simpan Produk
                </button>
            </div>

        </form>

    </div>

</div>

<!-- MODAL KELOLA STOK -->
<div class="modal-overlay" id="modalStok">
    <div class="modal">
        <div class="modal-header">
            <h2>Kelola Stok Produk</h2>
            <button type="button" class="modal-close"
                    onclick="tutupModal('modalStok')">&times;</button>
        </div>

        <form id="formStok" method="POST">
            @csrf
            @method('PUT')

            <div class="stock-summary">
                <small>Nama Produk</small>
                <div class="stock-product-name" id="stokNamaProduk">-</div>
                <div class="stock-current">
                    <span>Stok saat ini</span>
                    <strong id="stokSaatIni">0</strong>
                </div>
            </div>

            <div class="form-group">
                <label>Pilih Perubahan Stok</label>
                <div class="stock-options">
                    <div class="stock-option">
                        <input type="radio" name="aksi_stok" id="aksiTambah"
                               value="tambah" checked>
                        <label for="aksiTambah">
                            <svg viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="1.8">
                                <circle cx="12" cy="12" r="9"/>
                                <path d="M12 8v8M8 12h8"/>
                            </svg>
                            Tambah Stok
                        </label>
                    </div>

                    <div class="stock-option">
                        <input type="radio" name="aksi_stok" id="aksiKurangi"
                               value="kurangi">
                        <label for="aksiKurangi">
                            <svg viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="1.8">
                                <circle cx="12" cy="12" r="9"/>
                                <path d="M8 12h8"/>
                            </svg>
                            Kurangi Stok
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="jumlahStok">Jumlah stok</label>
                <input type="number" name="jumlah_stok" id="jumlahStok"
                       class="form-control" min="1" value="1" required>
            </div>

            <div class="stock-preview">
                <small>Stok setelah perubahan</small>
                <strong id="stokSetelah">0</strong>
                <small id="keteranganStok">Stok akan bertambah</small>
            </div>

            <div class="modal-actions">
                <button type="button" class="cancel-button"
                        onclick="tutupModal('modalStok')">Batal</button>
                <button type="submit" class="save-button">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL KONFIRMASI HAPUS -->
<div class="modal-overlay" id="modalHapus">
    <div class="modal modal-danger">
        <button type="button" class="modal-close"
                style="display:block;margin-left:auto"
                onclick="tutupModal('modalHapus')">&times;</button>

        <div class="delete-warning-icon">
            <svg viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="1.8"
                 stroke-linecap="round" stroke-linejoin="round">
                <path d="M10.3 3.9 2.7 17a2 2 0 0 0 1.7 3h15.2a2 2 0 0 0 1.7-3L13.7 3.9a2 2 0 0 0-3.4 0z"/>
                <path d="M12 9v4M12 17h.01"/>
            </svg>
        </div>

        <h2 style="font-family:Arial,sans-serif;font-size:19px;color:#111">
            Hapus Produk?
        </h2>
        <p style="color:#999;font-size:13px;margin-top:15px">
            Apakah anda yakin ingin menghapus produk ini?
        </p>

        <div class="delete-details">
            <div class="delete-detail-row">
                <strong>Nama Produk</strong>
                <span id="hapusNamaProduk">-</span>
            </div>
            <div class="delete-detail-row">
                <strong>Jenis</strong>
                <span id="hapusJenisProduk">-</span>
            </div>
            <div class="delete-detail-row">
                <strong>Stok</strong>
                <span id="hapusStokProduk">-</span>
            </div>
        </div>

        <div class="delete-info">
            Produk yang sudah digunakan dalam transaksi tidak akan dihapus
            permanen. Produk tersebut akan dinonaktifkan agar riwayat
            transaksi sebelumnya tetap tersimpan.
        </div>

        <form id="formHapus" method="POST">
            @csrf
            @method('DELETE')
            <div class="delete-actions">
                <button type="button" class="delete-cancel"
                        onclick="tutupModal('modalHapus')">Batal</button>
                <button type="submit" class="delete-confirm">Hapus</button>
            </div>
        </form>
    </div>
</div>



{{-- POP-UP BERHASIL --}}
@if (session('success_popup'))
    @php
        $judulPopup = [
            'tambah' => 'Produk Berhasil Ditambah!',
            'hapus' => 'Produk Berhasil Dihapus!',
            'edit' => 'Stok Berhasil Diedit!',
        ];
        $judulSuccessPopup = $judulPopup[session('success_popup')] ?? 'Berhasil!';
    @endphp

    <div class="success-overlay" id="successPopup" role="dialog" aria-modal="true" aria-labelledby="successPopupTitle">
        <div class="success-modal">
            <div class="success-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="m5 12 4 4L19 6" />
                </svg>
            </div>

            <h2 id="successPopupTitle">{{ $judulSuccessPopup }}</h2>

            <button type="button" onclick="tutupSuccessPopup()">Selesai</button>
        </div>
    </div>
@endif

{{-- POP-UP BERHASIL UNDUH LAPORAN STOK --}}
<div class="success-overlay" id="downloadSuccessPopup"
     role="dialog" aria-modal="true"
     aria-labelledby="downloadSuccessTitle"
     style="display:none;">
    <div class="download-success-modal">
        <div class="success-icon">
            <svg viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2.5"
                 stroke-linecap="round" stroke-linejoin="round"
                 aria-hidden="true">
                <path d="m5 12 4 4L19 6"/>
            </svg>
        </div>

        <h2 id="downloadSuccessTitle">Berhasil Diunduh!</h2>

        <p class="download-description">
            Laporan stok produk berhasil diunduh ke perangkat Anda.
        </p>

        <div class="download-file-row">
            <svg class="download-file-icon" viewBox="0 0 24 24"
                 fill="none" stroke="currentColor" stroke-width="1.8"
                 stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="4" width="18" height="16" rx="1"/>
                <path d="M3 9h18M7 13h2M11 13h2M15 13h2"/>
            </svg>

            <div class="download-file-details">
                <div class="download-file-name" id="downloadFileName">
                    laporan-stok-gentala.csv
                </div>
                <div class="download-file-type">
                    File CSV · Laporan stok produk
                </div>
            </div>

            <svg class="download-file-check" viewBox="0 0 24 24"
                 fill="currentColor" aria-hidden="true">
                <circle cx="12" cy="12" r="10"/>
                <path d="m7 12 3.2 3.2L17.5 8"
                      fill="none" stroke="#fff" stroke-width="2"
                      stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>

        <button type="button" onclick="tutupPopupUnduh()">
            Selesai
        </button>
    </div>
</div>

<script>

    // Mengunduh laporan stok dan menampilkan pop-up setelah berhasil
    async function unduhLaporanStok(button) {
        const url = button.dataset.url;
        const teksAwal = button.innerHTML;

        button.disabled = true;
        button.textContent = 'Menyiapkan laporan...';

        try {
            const response = await fetch(url, {
                method: 'GET',
                credentials: 'same-origin',
                headers: {
                    'Accept': 'text/csv'
                }
            });

            if (!response.ok) {
                throw new Error('Laporan gagal diunduh. Silakan coba lagi.');
            }

            const tipeKonten = response.headers.get('Content-Type') || '';

            if (!tipeKonten.includes('text/csv')) {
                throw new Error('Server tidak mengirim file CSV. Periksa login dan route laporan stok.');
            }

            const blob = await response.blob();

            // Ambil nama file dari header server jika tersedia
            const disposition = response.headers.get('Content-Disposition') || '';
            const match = disposition.match(/filename="?([^";]+)"?/i);
            const namaFile = match
                ? match[1]
                : 'laporan-stok-gentala.csv';

            // Memulai unduhan file CSV ke perangkat
            const objectUrl = window.URL.createObjectURL(blob);
            const link = document.createElement('a');

            link.href = objectUrl;
            link.download = namaFile;
            document.body.appendChild(link);
            link.click();
            link.remove();

            // Beri waktu browser memulai unduhan sebelum URL dibersihkan
            setTimeout(() => window.URL.revokeObjectURL(objectUrl), 1000);

            // Tampilkan pop-up setelah file berhasil diterima
            document.getElementById('downloadFileName').textContent = namaFile;
            document.getElementById('downloadSuccessPopup').style.display = 'flex';

        } catch (error) {
            alert(error.message || 'Terjadi kesalahan saat mengunduh laporan.');
        } finally {
            button.disabled = false;
            button.innerHTML = teksAwal;
        }
    }

    // Menutup pop-up unduhan
    function tutupPopupUnduh() {
        document.getElementById('downloadSuccessPopup').style.display = 'none';
    }

    // Menutup pop-up setelah proses berhasil
    function tutupSuccessPopup() {
        const popup = document.getElementById('successPopup');
        if (popup) {
            popup.remove();
        }
    }

    // Membuka modal tambah produk
    function bukaModalTambah() {
        document.getElementById('modalTambah').classList.add('active');
    }

    // Data stok produk yang sedang dipilih
    let stokProdukSaatIni = 0;

    // Membuka modal kelola stok
    function bukaModalStok(button) {
        const form = document.getElementById('formStok');

        form.action = button.dataset.url;
        stokProdukSaatIni = parseInt(button.dataset.stok, 10) || 0;

        document.getElementById('stokNamaProduk').textContent =
            button.dataset.nama;
        document.getElementById('stokSaatIni').textContent =
            stokProdukSaatIni + ' Kemasan';
        document.getElementById('jumlahStok').value = 1;
        document.getElementById('aksiTambah').checked = true;

        hitungStokSetelahPerubahan();
        document.getElementById('modalStok').classList.add('active');
    }

    // Menghitung perkiraan stok setelah perubahan
    function hitungStokSetelahPerubahan() {
        const jumlah = parseInt(
            document.getElementById('jumlahStok').value, 10
        ) || 0;

        const aksi = document.querySelector(
            'input[name="aksi_stok"]:checked'
        ).value;

        let hasil = stokProdukSaatIni;

        if (aksi === 'tambah') {
            hasil += jumlah;
            document.getElementById('keteranganStok').textContent =
                'Stok akan bertambah';
        } else {
            hasil -= jumlah;
            document.getElementById('keteranganStok').textContent =
                'Stok akan berkurang';
        }

        document.getElementById('stokSetelah').textContent =
            Math.max(hasil, 0) + ' Kemasan';

        document.getElementById('stokSetelah').style.color =
            hasil < 0 ? '#dc2626' : '#111';
    }

    document.getElementById('jumlahStok').addEventListener(
        'input', hitungStokSetelahPerubahan
    );

    document.querySelectorAll('input[name="aksi_stok"]').forEach(input => {
        input.addEventListener('change', hitungStokSetelahPerubahan);
    });

    // Membuka modal konfirmasi hapus
    function bukaModalHapus(button) {
        document.getElementById('formHapus').action = button.dataset.url;
        document.getElementById('hapusNamaProduk').textContent =
            button.dataset.nama;
        document.getElementById('hapusJenisProduk').textContent =
            button.dataset.jenis;
        document.getElementById('hapusStokProduk').textContent =
            button.dataset.stok + ' Kemasan';

        document.getElementById('modalHapus').classList.add('active');
    }

    // Menutup modal
    function tutupModal(id) {
        document.getElementById(id).classList.remove('active');
    }

    // Menutup modal jika area luar diklik
    document.querySelectorAll('.modal-overlay').forEach(modal => {
        modal.addEventListener('click', function(event) {
            if (event.target === modal) {
                modal.classList.remove('active');
            }
        });
    });
</script>

</body>
</html>
