<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;
use application\libraries\JwtEdDSA;

class Auth extends RestController {

    private  $jwt_expiration;

    function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model', 'm_auth');
        $this->load->library('JwtEdDSA', null, 'JwtEdDSA');
        
        $this->jwt_expiration= ($this->config->item('jwt_expiration')) ? $this->config->item('jwt_expiration') : 3600;
    }

    public function login_get() {
        $this->response([
            'status' => false,
            'message' => 'Login not implemented yet'
        ], RestController::HTTP_OK );
    }

    public function login_post() {
        $username = html_escape($this->post('username'));
        $password = html_escape($this->post('password'));
    
        if (empty($username) || empty($password)) {
            $this->response([
                'success' => false,
                'message' => 'Username and password are required'
            ], RestController::HTTP_BAD_REQUEST);
        }
        $user_m = $this->m_auth->login($username);
        $user_a = $this->m_auth->login_admin($username);
    
        if ($user_m->num_rows() > 0) {
            $user = $user_m->row();
            if (password_verify($password, $user->password)) {
                try {
                    $payload = [
                        'id' => $user->id,
                        'id_mhsw' => $user->id_mhsw,
                        'email' => property_exists($user, 'email') ? $user->email : null,
                        'level' => $user->level
                    ];
                    $token = $this->JwtEdDSA->generateToken($payload, $this->jwt_expiration);
                } catch (Exception $e) {
                    $this->response([
                        'success' => false,
                        'message' => 'Failed to generate token: ' . $e->getMessage()
                    ], RestController::HTTP_INTERNAL_SERVER_ERROR);
                    return;
                }
                $this->response([
                    'success' => true,
                    'message' => 'Login successful',
                    'data' => [
                        'user' => $payload,
                        'token' => $token,
                        'expires_in' => $this->jwt_expiration
                    ]
                ], RestController::HTTP_OK);
            } else {
                $this->response([
                    'success' => false,
                    'message' => 'Invalid password'
                ], RestController::HTTP_UNAUTHORIZED);
            }
        } elseif ($user_a->num_rows() > 0) {
            $user = $user_a->row();
            if (password_verify($password, $user->password)) {
                try {
                    $payload = [
                        'id' => $user->id,
                        'email' => property_exists($user, 'email') ? $user->email : null,
                        'level' => $user->level,
                        'id_mitra' => $user->id_mitra,
                    ];
                    $token = $this->JwtEdDSA->generateToken($payload, $this->jwt_expiration);
                } catch (Exception $e) {
                    $this->response([
                        'success' => false,
                        'message' => 'Failed to generate token: ' . $e->getMessage()
                    ], RestController::HTTP_INTERNAL_SERVER_ERROR);
                    return;
                }
                $this->response([
                    'success' => true,
                    'message' => 'Login successful',
                    'data' => [
                        'user' => $payload,
                        'token' => $token,
                        'expires_in' => $this->jwt_expiration
                    ]
                ], RestController::HTTP_OK);
            } else {
                $this->response([
                    'success' => false,
                    'message' => 'Invalid password'
                ], RestController::HTTP_UNAUTHORIZED);
            }
        } else {
            $this->response([
                'success' => false,
                'message' => 'User not found'
            ], RestController::HTTP_NOT_FOUND);
        }
    }
    

    public function verifyToken_post() {
        // $token = $this->post('token');
        $headers = $this->input->request_headers();
        if (isset($headers['Authorization'])) {
            $authHeader = $headers['Authorization'];
            if (preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
                $token = $matches[1];
            } else {
                $this->response([
                    'success' => false,
                    'message' => 'Authorization header is malformed'
                ], RestController::HTTP_BAD_REQUEST);
                return;
            }
        } else {
            $this->response([
                'success' => false,
                'message' => 'Authorization header not found'
            ], RestController::HTTP_BAD_REQUEST);
            return;
        }
        $toke_data = $this->JwtEdDSA->verifyToken($token);
        if ($toke_data) {
            $this->response([
                'success' => true,
                'message' => 'Token is valid',
                'data' => $toke_data
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'success' => false,
                'message' => 'Token is invalid'
            ], RestController::HTTP_UNAUTHORIZED);
        }

    }
}