<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alumni extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model("alumni_model");
    date_default_timezone_set("Asia/Makassar");
	}

	public function index()
	{
    if ($this->session->level == 1) {
      $data['data'] = array(
        'alumni' => $this->alumni_model->get_alumni_all()->result(),
      );
    } elseif ($this->session->level == 2) {
      $data['data'] = array(
        'alumni' => $this->alumni_model->get_alumni_all_prodi($this->session->kd_prodi)->result(),
      );
    }
		$data['content'] = 'alumni/index';
		$this->load->view('main/admin/index', $data);
	}

  public function tgl_indo($tanggal){
		$bulan = array (
			1 =>   'Januari',
			'Februari',
			'Maret',
			'April',
			'Mei',
			'Juni',
			'Juli',
			'Agustus',
			'September',
			'Oktober',
			'November',
			'Desember'
		);
		$pecahkan = explode('-', $tanggal);
	 
		return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
	}
}
?>