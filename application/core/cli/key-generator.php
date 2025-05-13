<?php

// Ensure the script is run from the command line
if (php_sapi_name() !== 'cli') {
    die('This script can only be run from the command line.' . PHP_EOL);
    exit(1);
}

// Define APPPATH if not already defined
if (!defined('APPPATH')) {
    define('APPPATH', dirname(__DIR__, 3) . '/application/');
}

// Load .env file
$dotenv_path = dirname(__DIR__, 3) . '/.env';
if (file_exists($dotenv_path)) {
    $lines = file($dotenv_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) {
            continue; // Skip comments
        }
        [$key, $value] = explode('=', $line, 2);
        $_ENV[trim($key)] = trim($value);
    }
}

// Generate EdDSA keypair
$keypair = sodium_crypto_sign_keypair();
$secretKey = sodium_crypto_sign_secretkey($keypair); // 64 bytes
$publicKey = sodium_crypto_sign_publickey($keypair); // 32 bytes

// Save keys in Base64 format
$private_key_path = isset($_ENV['JWT_PRIVATE_KEY_PATH']) ? APPPATH . $_ENV['JWT_PRIVATE_KEY_PATH'] : APPPATH . 'config/key/private_key.pem';
$public_key_path = isset($_ENV['JWT_PUBLIC_KEY_PATH']) ? APPPATH . $_ENV['JWT_PUBLIC_KEY_PATH'] : APPPATH . 'config/key/public_key.pem';

echo "Private Key: " . base64_encode($secretKey) . PHP_EOL;
echo "Public Key: " . base64_encode($publicKey) . PHP_EOL;

$dir = dirname($private_key_path);
echo "Directory: " . $dir . PHP_EOL;

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
    } else {
        // Update .env file with PRIVATE_KEY without moving lines
        $env_content = file($dotenv_path, FILE_IGNORE_NEW_LINES);
        $updated = false;
        foreach ($env_content as &$line) {
            if (strpos($line, 'PRIVATE_KEY=') === 0) {
                $line = 'PRIVATE_KEY=' . base64_encode($secretKey);
                $updated = true;
                break;
            }
        }
        if (!$updated) {
            $env_content[] = 'PRIVATE_KEY=' . base64_encode($secretKey);
        }
        if (@file_put_contents($dotenv_path, implode(PHP_EOL, $env_content) . PHP_EOL) === false) {
            log_message('error', 'Failed to update .env file with PRIVATE_KEY.');
        }
    }

    if (@file_put_contents($public_key_path, base64_encode($publicKey)) === false) {
        log_message('error', 'Failed to write public key to: ' . $public_key_path);
    } else {
        // Update .env file with PUBLIC_KEY without moving lines
        $env_content = file($dotenv_path, FILE_IGNORE_NEW_LINES);
        $updated = false;
        foreach ($env_content as &$line) {
            if (strpos($line, 'PUBLIC_KEY=') === 0) {
                $line = 'PUBLIC_KEY=' . base64_encode($publicKey);
                $updated = true;
                break;
            }
        }
        if (!$updated) {
            $env_content[] = 'PUBLIC_KEY=' . base64_encode($publicKey);
        }
        if (@file_put_contents($dotenv_path, implode(PHP_EOL, $env_content) . PHP_EOL) === false) {
            log_message('error', 'Failed to update .env file with PUBLIC_KEY.');
        }
    }
}else {
    echo "File already exists: " . $private_key_path . PHP_EOL;

    echo "Full path to private key: " . realpath($private_key_path) . PHP_EOL;
    echo "Full path to public key: " . realpath($public_key_path) . PHP_EOL;
}