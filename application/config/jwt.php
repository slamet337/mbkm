<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Konfigurasi JWT
$config['jwt_key'] = 'your_secret_key'; // Optional, jika pakai HMAC. Tidak dipakai di EdDSA
$config['jwt_algorithm'] = 'EdDSA';
$config['jwt_expiration'] = 3600; // 1 jam
$config['jwt_issuer'] = 'your_issuer';
$config['jwt_audience'] = 'your_audience';

$private_key_path = APPPATH . 'config/key/private_key.pem';
$public_key_path = APPPATH . 'config/key/public_key.pem';

// Pastikan direktori ada
$dir = dirname($private_key_path);
if (!is_dir($dir)) {
    mkdir($dir, 0700, true);
}

// ✅ Hanya generate jika file belum ada
if (!file_exists($private_key_path) || !file_exists($public_key_path)) {
    // Hasilkan pasangan kunci Ed25519
    $keypair   = sodium_crypto_sign_keypair();
    $secretKey = sodium_crypto_sign_secretkey($keypair); // 64 bytes
    $publicKey = sodium_crypto_sign_publickey($keypair); // 32 bytes

    // Simpan kunci dalam format Base64
    file_put_contents($private_key_path, base64_encode($secretKey));
    file_put_contents($public_key_path, base64_encode($publicKey));
}

// ✅ Load kunci dari file
if (file_exists($private_key_path)) {
    // $config['private_key'] = base64_decode(file_get_contents($private_key_path));
    $config['private_key'] = file_get_contents($private_key_path);
} else {
    log_message('error', 'Private key file not found: ' . $private_key_path);
    $config['private_key'] = null;
}

if (file_exists($public_key_path)) {
    // $config['public_key'] = base64_decode(file_get_contents($public_key_path));
    $config['public_key'] = file_get_contents($public_key_path);
    $config['kid'] = hash('sha256', base64_decode($config['public_key']));
} else {
    log_message('error', 'Public key file not found: ' . $public_key_path);
    $config['public_key'] = null;
}
