<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;
use application\libraries\JwtEdDSA;

class Profile extends RestController {
    
    public $token;
    public $user;

    function __construct()
    {
        parent::__construct();

        $this->load->library('JwtEdDSA', null, 'JwtEdDSA');
        $this->token =  $this->JwtEdDSA->getToken();
        $this->user = $this->JwtEdDSA->verifyToken($this->token);
    }

    public function index_get()
    {
        switch ($this->user['level']) {
            case 'admin':
                $this->response([
                    'success' => true,
                    'message' => 'Profile admin',
                    'data' => $this->user
                ], RestController::HTTP_OK);
                break;
            case 'mahasiswa':
                $this->load->model('Profil_model', 'm_profile');
                $this->response([
                    'success' => true,
                    'message' => 'Profile mahasiswa',
                    'data' => $this->m_profile->get_profil_one($this->user['id_mhsw'])->row(),
                ], RestController::HTTP_OK);
                break;
            case 'alumni':
                $this->load->model('Profil_model', 'm_profile');
                $this->response([
                    'success' => true,
                    'message' => 'Profile alumni',
                    'data' => $this->m_profile->get_profil_one($this->user['id_mhsw'])->row(),
                ], RestController::HTTP_OK);
                break;
            case 'inbound':
                $this->load->model('Profil_model', 'm_profile');
                $this->response([
                    'success' => true,
                    'message' => 'Profile inbound',
                    'data' => $this->m_profile->get_profil_inbound_one($this->user['id_mhsw'])->row(),
                ], RestController::HTTP_OK);
                break;
            case 'prodi':
                $this->response([
                    'success' => true,
                    'message' => 'Profile prodi',
                    'data' => $this->user
                ], RestController::HTTP_OK);
                break;
            case 'mitra':
                $this->load->model('Profil_mitra_model', 'm_profile');
                $this->response([
                    'success' => true,
                    'message' => 'Profile mitra',
                    'data' => $this->m_profile->get_profil_mitra_one($this->user['id_mitra'])->row(),
                ], RestController::HTTP_OK);
                break;
            case 'dosen':
                $this->load->model('Profil_model', 'm_profile');
                $this->response([
                    'success' => true,
                    'message' => 'Profile dosen',
                    'data' => $this->m_profile->get_profil_dosen_one($this->user['id'])->row(),
                ], RestController::HTTP_OK);
                break;
            default:
                $this->response([
                    'success' => false,
                    'message' => 'Invalid user level'
                ], RestController::HTTP_UNAUTHORIZED);
                break;
        }
    }


}