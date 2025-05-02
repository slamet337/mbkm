<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manajemen_inbound extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model("pendaftaran_model");
    date_default_timezone_set("Asia/Makassar");
	}

	public function index()
	{
		$data['data'] = array(
			'manajemen' => $this->pendaftaran_model->get_pendaftaran_inbound_one($this->session->id)->result(),
		);
		$data['content'] = 'menu/manajemen_inbound/index';
    $this->load->view('main/users/index_menu', $data);
	}
}
?>