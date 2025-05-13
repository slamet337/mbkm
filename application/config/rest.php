<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Format default untuk respon REST API
|--------------------------------------------------------------------------
|
| Format default yang digunakan untuk respon API. Nilai yang umum digunakan
| adalah 'json' atau 'xml'.
|
*/
$config['rest_default_format'] = 'json';

/*
|--------------------------------------------------------------------------
| Autentikasi REST API
|--------------------------------------------------------------------------
|
| Metode autentikasi yang digunakan. Pilihan yang tersedia:
| 'basic', 'digest', 'session', atau FALSE untuk tanpa autentikasi.
|
*/
$config['rest_auth'] = FALSE;

/*
|--------------------------------------------------------------------------
| Kunci API untuk autentikasi
|--------------------------------------------------------------------------
|
| Daftar kunci API yang valid. Formatnya adalah array dengan pasangan
| 'username' => 'password'.
|
*/
$config['rest_valid_logins'] = [
    'admin' => '1234',
];

/*
|--------------------------------------------------------------------------
| Pengaturan JWT (JSON Web Token)
|--------------------------------------------------------------------------
|
| Konfigurasi untuk penggunaan JWT dalam autentikasi.
|
*/
$config['jwt_key'] = 'your_secret_key'; // Ganti dengan kunci rahasia Anda
$config['jwt_algorithm'] = 'HS256';
$config['jwt_expiration'] = 3600; // Dalam detik (1 jam)

/*
|--------------------------------------------------------------------------
| Pengaturan CORS (Cross-Origin Resource Sharing)
|--------------------------------------------------------------------------
|
| Mengizinkan permintaan dari domain lain. Sangat berguna saat API
| diakses dari aplikasi frontend yang berbeda domain.
|
*/
$config['allow_any_cors_domain'] = TRUE;
$config['allowed_cors_headers'] = [
    'Origin',
    'X-Requested-With',
    'Content-Type',
    'Accept',
    'Authorization',
];
$config['allowed_cors_methods'] = [
    'GET',
    'POST',
    'OPTIONS',
    'PUT',
    'DELETE',
];

/*
|--------------------------------------------------------------------------
| Pengaturan Logging
|--------------------------------------------------------------------------
|
| Mengaktifkan atau menonaktifkan pencatatan aktivitas API.
|
*/
$config['rest_enable_logging'] = TRUE;
$config['rest_logs_table'] = 'api_logs';

/*
|--------------------------------------------------------------------------
| Pengaturan Rate Limiting
|--------------------------------------------------------------------------
|
| Membatasi jumlah permintaan yang dapat dilakukan oleh pengguna dalam
| jangka waktu tertentu untuk mencegah penyalahgunaan.
|
*/
// $config['rest_enable_limits'] = TRUE;
// $config['rest_limits_table'] = 'api_limits';
// $config['rest_limits_method'] = 'IP'; // Bisa 'IP' atau 'API_KEY'
