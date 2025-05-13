<?php
defined('BASEPATH') or exit('No direct script access allowed');

class JwtEdDSA
{
    private $privateKey;
    private $publicKey;
    private $alg = 'EdDSA';
    private $jwt_expiration = 3600;
    private $kid;

    public function __construct()
    {
        $CI = &get_instance();
        $CI->load->config('jwt');

        $privateKeyDecoded = base64_decode($CI->config->item('private_key'));
        $publicKeyDecoded = base64_decode($CI->config->item('public_key'));

        // Validasi panjang kunci
        if (strlen($privateKeyDecoded) !== SODIUM_CRYPTO_SIGN_SECRETKEYBYTES) {
            throw new Exception('Invalid private key length. Got ' . strlen($privateKeyDecoded) . ', expected ' . SODIUM_CRYPTO_SIGN_SECRETKEYBYTES);
        }

        if (strlen($publicKeyDecoded) !== SODIUM_CRYPTO_SIGN_PUBLICKEYBYTES) {
            throw new Exception('Invalid public key length. Got ' . strlen($publicKeyDecoded) . ', expected ' . SODIUM_CRYPTO_SIGN_PUBLICKEYBYTES);
        }

        // Simpan secret key dan public key
        $this->alg = $CI->config->item('jwt_algorithm') ?? 'EdDSA';
        $this->privateKey = $privateKeyDecoded; 
        $this->publicKey = $publicKeyDecoded;
        $this->jwt_expiration = $CI->config->item('jwt_expiration') ?? 3600;
        $this->kid = hash('sha256', $this->publicKey);
    }

    public function generateToken(array $payload, int $exp = null): string
    {
        if (empty($payload)) {
            throw new Exception('Payload cannot be empty');
        }

        $header = ['alg' => $this->alg, 'typ' => 'JWT', 'kid' => $this->kid];
        $iat = time();
        $payload['iat'] = $iat;
        $payload['exp'] = $iat + ($exp ?? $this->jwt_expiration);

        $segments = [
            $this->base64UrlEncode(json_encode($header)),
            $this->base64UrlEncode(json_encode($payload))
        ];

        $signingInput = implode('.', $segments);
        $signature = sodium_crypto_sign_detached($signingInput, $this->privateKey);
        $segments[] = $this->base64UrlEncode($signature);

        return implode('.', $segments);
    }

    public function verifyToken(string $jwt): array
    {
        $segments = explode('.', $jwt);
        if (count($segments) !== 3) {
            throw new Exception('Token format is invalid');
        }

        list($encodedHeader, $encodedPayload, $encodedSignature) = $segments;
        $signingInput = $encodedHeader . '.' . $encodedPayload;
        $signature = $this->base64UrlDecode($encodedSignature);

        if (!sodium_crypto_sign_verify_detached($signature, $signingInput, $this->publicKey)) {
            throw new Exception('Signature verification failed');
        }

        $payload = json_decode($this->base64UrlDecode($encodedPayload), true);

        if (empty($payload)) {
            throw new Exception('Invalid payload data');
        }

        if (!isset($payload['exp'])) {
            throw new Exception('Expiration (exp) not set in token');
        }

        if ($payload['exp'] < time()) {
            throw new Exception('Token has expired');
        }

        return $payload;
    }

    private function base64UrlEncode(string $data): string
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    private function base64UrlDecode(string $data): string
    {
        $remainder = strlen($data) % 4;
        if ($remainder) {
            $data .= str_repeat('=', 4 - $remainder);
        }
        return base64_decode(strtr($data, '-_', '+/'));
    }

    public function getToken(): ?string
    {
        $headers = null;

        if (isset($_SERVER['Authorization'])) {
            $headers = trim($_SERVER["Authorization"]);
        } else if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        } else if (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            $requestHeaders = array_change_key_case($requestHeaders, CASE_LOWER);
            if (isset($requestHeaders['authorization'])) {
                $headers = trim($requestHeaders['authorization']);
            }
        }

        if (empty($headers)) {
            return null;
        }

        if (stripos($headers, 'Bearer ') === 0) {
            return substr($headers, 7);
        }

        return null;
    }
}
