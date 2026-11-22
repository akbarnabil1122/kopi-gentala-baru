<?php

return [
    'whatsapp'         => env('WHATSAPP_NUMBER'),
    'email'            => env('KONTAK_EMAIL'),
    'instagram'        => env('KONTAK_INSTAGRAM'),
    'alamat'           => env('KONTAK_ALAMAT'),
    'cek_resi_url'     => env('CEK_RESI_URL'),
    'ongkir_ekspedisi' => (int) env('ONGKIR_EKSPEDISI', 30000),
];