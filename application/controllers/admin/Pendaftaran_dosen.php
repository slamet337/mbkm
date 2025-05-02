<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran_dosen extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model("pendaftaran_model");
		$this->load->model("matakuliah_model");
		$this->load->model("logbook_model");
    date_default_timezone_set("Asia/Makassar");
	}

	public function index()
	{
		$dosen = $this->pendaftaran_model->search_dosen($this->session->id)->row();
		$data['data'] = array(
			'pendaftaran' => $this->pendaftaran_model->get_pendaftaran_dosen($dosen->id)->result(),
		);
		$data['content'] = 'pendaftaran/index_dosen';
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

	public function logbook($id)
	{
		$data['data'] = array(
			'logbook' => $this->logbook_model->get_logbook_dosen($id)->result(),
		);
		$data['content'] = 'pendaftaran/logbook';
		$this->load->view('main/admin/index', $data);
	}

	public function nilai($id_daftar, $id_kegiatan)
	{
		$data['data'] = array(
			'pendaftaran' => $this->pendaftaran_model->get_pendaftaran_adm_prodi_one($id_daftar)->row(),
			'matakuliah' => $this->pendaftaran_model->get_matakuliah_dosen($id_daftar)->result(),
		);
		$data['content'] = 'pendaftaran/nilai';
		$this->load->view('main/admin/index', $data);

	}

	public function update($id)
	{
		$id_mk = $this->input->post('id_mk');
		$nilai = $this->input->post('nilai');
		$grade = $this->input->post('grade');

		foreach ($id_mk as $key => $value) {
			$data = array(
				'id_pendaftaran' => $id,
				'id_matakuliah' => $value,
				'nilai' => $nilai[$key],
				'grade' => $grade[$key],
				'id_user' => $this->session->id,
			);
			
			$this->pendaftaran_model->post_nilai($data);
		}
		
		$data_kegiatan = array(
			'status_kegiatan' => 'Selesai',
		);

		if ($this->pendaftaran_model->put($data_kegiatan, $id)) {
			$this->session->set_flashdata('success_save', TRUE);
		} else {
			$this->session->set_flashdata('error_save', TRUE);
		}

		redirect('/admin/pendaftaran_dosen');
	}
}
?>