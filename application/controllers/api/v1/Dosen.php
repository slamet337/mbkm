<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;
use application\libraries\JwtEdDSA;


class Dosen extends RestController {

    function __construct()
    {
        parent::__construct();
		$this->load->model("kegiatan_mbkm_luar_model");
        $this->load->library('JwtEdDSA', null, 'JwtEdDSA');
    }

    public function index_get()
    {
        $dosen = $this->kegiatan_mbkm_luar_model->get_dosen();
        if ($dosen->num_rows() > 0) {
            $this->response([
                'status' => true,
                'data' => $dosen->result()
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'No data found'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

}