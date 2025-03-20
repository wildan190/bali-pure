<?php

return [
  'merchant_id' => env('MIDTRANS_MERCHANT_ID'),
  'client_key' => env('MIDTRANS_CLIENT_KEY'),
  'server_key' => env('MIDTRANS_SERVER_KEY'),
  'is_production' => false, // Ubah ke true jika sudah live
  'is_sanitized' => true,
  'is_3ds' => true,
];
