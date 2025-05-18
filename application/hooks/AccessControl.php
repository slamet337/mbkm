<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class AccessControl {

    protected $CI;

    public function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->library('JwtEdDSA');
        $this->CI->load->database();

    }

    public function check_permission() {

        $first_segment = isset($_SERVER['REQUEST_URI']) ? explode('/', trim($_SERVER['REQUEST_URI'], '/'))[0] : '';

        if ($first_segment !== 'api') {
            return;
        }
        
        $excluded_paths = [
            "/api/v1/Auth/login",
            "/api/v1/Auth/refresh",
            "/api/v1/Auth/logout",
            "/api/v1/jwks",
            "/api/v1/Auth/forgot_password",
            "/api/v1/Auth/reset_password",
            "/api/v1/Auth/verify_email",
            "/api/v1/Auth/verify_email_resend",
        ];

        $request_path = '/' . $this->CI->uri->uri_string();
        $request_method = strtoupper($_SERVER['REQUEST_METHOD']);

        if (in_array($request_path, $excluded_paths)) {
            return;
        }

        // Validasi JWT token
        $auth_data = $this->CI->JwtEdDSA->data();
        
        if (empty($auth_data) || !isset($auth_data['level'])) {
            $this->json_response('Unauthorized access: Token invalid', 401);
        }

        $user_role = strtolower($auth_data['level']);

        // Ambil role
        $role = $this->CI->db
            ->where('name', $user_role)
            ->get('api_roles')
            ->row();
        if (!$role) {
            $this->json_response('Unauthorized access: Role not registered', 403);
        }

        // Ambil endpoint dengan dukungan path dinamis
        $endpoints = $this->CI->db
            ->where('method', $request_method)
            ->get('api_endpoints')
            ->result();

        $matched_endpoint = null;
        foreach ($endpoints as $endpoint) {
            // Ubah {param} jadi regex tanpa preg_quote pada bagian dinamis
            $pattern = preg_replace('/\{[^\}]+\}/', '[^/]+', $endpoint->path);
            // Escape regex special characters except for the replaced [^/]+ and slashes
            $pattern = str_replace('/', '\/', $pattern);
            $pattern = '/^' . $pattern . '$/i';
            if (preg_match($pattern, $request_path)) {
                $matched_endpoint = $endpoint;
                break;
            }
        }

        if (!$matched_endpoint) {
            $this->json_response('Unauthorized access: Endpoint not registered', 403);
        }

        // Cek izin
        $perm = $this->CI->db
            ->where('role_id', $role->id)
            ->where('endpoint_id', $matched_endpoint->id)
            ->get('api_role_permissions')
            ->row();
        if (!$perm) {
            $this->json_response('Forbidden: You do not have permission to access this resource', 403);
        }

        // Simpan allowed_fields untuk digunakan di controller
        $this->CI->allowed_fields = $perm->allowed_fields;
    }

    protected function json_response($message, $status_code = 403) {
        // Simulasi metode dari RestController
        $this->CI->output
            ->set_status_header($status_code)
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'status' => false,
                'message' => $message
            ]))
            ->_display();
        exit;
    }
}
