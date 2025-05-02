<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manajemen extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model("pendaftaran_model");
    date_default_timezone_set("Asia/Makassar");
	}

	public function index()
	{
		$data['data'] = array(
			'manajemen' => $this->pendaftaran_model->get_pendaftaran_one($this->session->id_mhsw)->result(),
		);
		$data['content'] = 'menu/manajemen/index';
    $this->load->view('main/users/index_menu', $data);
	}
}
?>