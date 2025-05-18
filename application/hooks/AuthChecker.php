<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthChecker
{
    public function checkJWT()
    {
        // Cek apakah ini request API (URL diawali "api/")
        $first_segment = isset($_SERVER['REQUEST_URI']) ? explode('/', trim($_SERVER['REQUEST_URI'], '/'))[0] : '';

        if ($first_segment !== 'api') {
            // Kalau bukan API, skip cek token
            return;
        }

        // Baru load CI instance
        if (!function_exists('get_instance')) {
            $this->jsonError('CodeIgniter instance not available', 500);
        }

        $CI =& get_instance();
        if (!$CI) {
            $this->jsonError('CodeIgniter instance is null', 500);
        }

        $CI->load->helper('url');

        // List route yang TIDAK perlu JWT (whitelist)
        $public_routes = [
            "api/v1/Auth/login",
            "api/v1/Auth/refresh",
            "api/v1/Auth/logout",
            "api/v1/jwks",
            "api/v1/Auth/forgot_password",
            "api/v1/Auth/reset_password",
            "api/v1/Auth/verify_email",
            "api/v1/Auth/verify_email_resend",
        ];

        // Dapatkan URI sekarang
        $current_route = uri_string();

        // Kalau route sekarang masuk whitelist, skip cek JWT
        if (in_array($current_route, $public_routes)) {
            return;
        }

        // Ambil Authorization header
        $headers = $this->getAuthorizationHeader();

        if (!$headers) {
            $this->jsonError('Unauthorized: Token missing', 401);
        }

        $token = str_replace('Bearer ', '', $headers);

        try {
            // Ambil public key kamu
            // $publicKey = file_get_contents(APPPATH . 'config/key/public_key.pem');
            $publicKeyPath = APPPATH . $_ENV['JWT_PUBLIC_KEY_PATH'];
            $publicKey = file_get_contents($publicKeyPath);

            // Decode token
            $decoded = JWT::decode($token, new Key($publicKey, 'EdDSA'));

            // Simpan user info ke instance CI
            $CI->user = $decoded;

        } catch (Exception $e) {
            // $this->jsonError('Unauthorized: ' . $e->getMessage(), 401);
            // Cek apakah token invalid
            if ($e->getCode() === 0) {
                $this->jsonError('Unauthorized: Token invalid', 401);
            }
            // Cek apakah token expired
            if ($e->getCode() === 401) {
                $this->jsonError('Unauthorized: Token expired', 401);
            } else {
                $this->jsonError('Unauthorized: ' . $e->getMessage(), 401);
            }
        }
    }

    private function getAuthorizationHeader()
    {
        $headers = null;

        if (isset($_SERVER['Authorization'])) {
            $headers = trim($_SERVER["Authorization"]);
        } else if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        } else if (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            if (isset($requestHeaders['Authorization'])) {
                $headers = trim($requestHeaders['Authorization']);
            }
        }
        return $headers;
    }

    private function jsonError($message, $status_code)
    {
        header('Content-Type: application/json');
        http_response_code($status_code);
        echo json_encode([
            'status' => $status_code,
            'error' => $message
        ]);
        exit;
    }
}
