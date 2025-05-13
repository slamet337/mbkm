<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Load .env file
$dotenv_path = APPPATH . '../.env';
if (file_exists($dotenv_path)) {
    $dotenv = @parse_ini_file($dotenv_path);
    if ($dotenv === false) {
        log_message('error', 'Error parsing .env file: ' . $dotenv_path);
    } else {
        foreach ($dotenv as $key => $value) {
            $_ENV[$key] = $value;
        }
    }
} else {
    log_message('error', '.env file not found: ' . $dotenv_path);
}

// Konfigurasi JWT
$config['jwt_key'] = 'your_secret_key'; // Optional, jika pakai HMAC. Tidak dipakai di EdDSA
$config['jwt_algorithm'] = 'EdDSA';
$config['jwt_expiration'] = 3600; // 1 jam
$config['jwt_issuer'] = 'your_issuer';
$config['jwt_audience'] = 'your_audience';
$private_key_path = isset($_ENV['JWT_PRIVATE_KEY_PATH']) ? APPPATH . $_ENV['JWT_PRIVATE_KEY_PATH'] : APPPATH . 'config/key/private_key.pem';
$public_key_path = isset($_ENV['JWT_PUBLIC_KEY_PATH']) ? APPPATH . $_ENV['JWT_PUBLIC_KEY_PATH'] : APPPATH . 'config/key/public_key.pem';

$dir = dirname($private_key_path);
if (!is_dir($dir)) {
    if (!@mkdir($dir, 0700, true) && !is_dir($dir)) {
        log_message('error', 'Failed to create directory: ' . $dir);
    }
}
if (!is_dir($dir)) {
    mkdir($dir, 0700, true);
}

// ✅ Hanya generate jika file belum ada
if (!file_exists($private_key_path) || !file_exists($public_key_path)) {
    if (@file_put_contents($private_key_path, base64_encode($secretKey)) === false) {
        log_message('error', 'Failed to write private key to: ' . $private_key_path);
    }
    if (@file_put_contents($public_key_path, base64_encode($publicKey)) === false) {
        log_message('error', 'Failed to write public key to: ' . $public_key_path);
    }
    $keypair = sodium_crypto_sign_keypair(); // Generate the keypair
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
