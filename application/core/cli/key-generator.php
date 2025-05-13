<?php

// allow access only from CLI
if (php_sapi_name() !== 'cli') {
    die('This script can only be run from the command line.');
}

define('BASEPATH', true);
define('APPPATH', __DIR__ . '/../../'); 

// Load .env file using vlucas/phpdotenv
require_once APPPATH . '../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(APPPATH . '../');
$dotenv->load();


// Hasilkan pasangan kunci Ed25519
$keypair   = sodium_crypto_sign_keypair();
$privateKey = sodium_crypto_sign_secretkey($keypair); // 64 bytes
$publicKey = sodium_crypto_sign_publickey($keypair); // 32 bytes


// Generate a new EdDSA key pair
$privateKeyBase64 = base64_encode($privateKey);
$publicKeyBase64 = base64_encode($publicKey);
$kid = hash('sha256', $publicKeyBase64);

// Save the keys to .env file
$envFile = APPPATH . '../.env';
$envContent = file_get_contents($envFile);

// Update the PRIVATE_KEY and PUBLIC_KEY lines
// $envContent = preg_replace('/^PRIVATE_KEY=.*$/m', 'PRIVATE_KEY=' . $privateKeyBase64, $envContent);
// $envContent = preg_replace('/^PUBLIC_KEY=.*$/m', 'PUBLIC_KEY=' . $publicKeyBase64, $envContent);
if (!preg_match('/^PRIVATE_KEY=/m', $envContent)) {
    $envContent .= PHP_EOL . 'PRIVATE_KEY=' . $privateKeyBase64;
} else {
    $envContent = preg_replace('/^PRIVATE_KEY=.*$/m', 'PRIVATE_KEY=' . $privateKeyBase64, $envContent);
}

if (!preg_match('/^PUBLIC_KEY=/m', $envContent)) {
    $envContent .= PHP_EOL . 'PUBLIC_KEY=' . $publicKeyBase64;
} else {
    $envContent = preg_replace('/^PUBLIC_KEY=.*$/m', 'PUBLIC_KEY=' . $publicKeyBase64, $envContent);
}

echo "Private key length: " . strlen(base64_decode($privateKeyBase64)) . PHP_EOL;
echo "Public key length: " . strlen(base64_decode($publicKeyBase64)) . PHP_EOL;


// Coba buat tanda tangan dengan private key
$data = "This is some data to sign.";
$signature = sodium_crypto_sign_detached($data, $privateKey);

// Verifikasi tanda tangan dengan public key
try {
    sodium_crypto_sign_verify_detached($signature, $data, $publicKey);
    echo "Signature is valid!";
} catch (SodiumException $e) {
    echo "Signature is invalid!";
}

// Write the updated content back to the .env file
file_put_contents($envFile, $envContent);
