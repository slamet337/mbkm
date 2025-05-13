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

// Cek ketersediaan file kunci
if (!file_exists($private_key_path) || !file_exists($public_key_path)) {
    log_message('error', 'Key files not found. Please run `composer run key-generator` to generate the keys.');
    response([
        'status' => false,
        'message' => 'Key files not found. Please run `composer run key-generator` to generate the keys.'
    ], 500);
}

// ✅ Load kunci dari file
if (file_exists($private_key_path)) {
    $config['private_key'] = file_get_contents($private_key_path);
} else {
    log_message('error', 'Private key file not found: ' . $private_key_path);
    response([
        'status' => false,
        'message' => 'Private key file not found: ' . $private_key_path
    ], 500);
    $config['private_key'] = null;
}

if (file_exists($public_key_path)) {
    $config['public_key'] = file_get_contents($public_key_path);
    $config['kid'] = hash('sha256', base64_decode($config['public_key']));
} else {
    log_message('error', 'Public key file not found: ' . $public_key_path);
    response([
        'status' => false,
        'message' => 'Public key file not found: ' . $public_key_path
    ], 500);
    $config['public_key'] = null;
}

function response($data, $status = 200)
{
    header('Content-Type: application/json');
    http_response_code($status);
    echo json_encode($data);
    exit;
}