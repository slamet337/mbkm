<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran_inbound_dosen extends CI_Controller {
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
			'pendaftaran' => $this->pendaftaran_model->get_pendaftaran_dosen_inbound($dosen->id)->result(),
		);
		$data['content'] = 'pendaftaran_inbound/index_dosen';
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

	public function logbook($id_mhsw, $semester)
	{
		$data['data'] = array(
			'logbook' => $this->logbook_model->get_logbook_inbound_one($id_mhsw, $semester)->result(),
		);
		$data['content'] = 'pendaftaran_inbound/logbook_prodi';
		$this->load->view('main/admin/index', $data);
	}

	public function nilai($id_daftar)
	{
		$pendaftaran = $this->pendaftaran_model->get_pendaftaran_adm_prodi_one_inbound($id_daftar)->row();
		$data['data'] = array(
			'pendaftaran' => $pendaftaran,
			'matakuliah' => $this->pendaftaran_model->get_detail_jadwal($pendaftaran->id_mhsw, $pendaftaran->semester)->result(),
		);
		$data['content'] = 'pendaftaran_inbound/nilai';
		$this->load->view('main/admin/index', $data);

	}

	public function update($id)
	{
		$id_pendaftaran = $this->input->post('id_pendaftaran');
		
		$nilai = $this->input->post('nilai');
		$grade = $this->input->post('grade');

		foreach ($id_pendaftaran as $key => $value) {
			$pendaftaran = $this->pendaftaran_model->get_pendaftaran_adm_prodi_one_inbound($value)->row();
			$data = array(
				'id_pendaftaran_inbound' => $value,
				'id_mhsw' => $pendaftaran->id_mhsw,
				'semester' => $pendaftaran->semester,
				'nilai' => $nilai[$key],
				'grade' => $grade[$key],
				'id_user' => $this->session->id,
			);
			
			$this->pendaftaran_model->post_nilai_inbound($data);
		}
		
		$data_kegiatan = array(
			'status_kegiatan' => 'Selesai',
		);

		$pendaftaran = $this->pendaftaran_model->get_pendaftaran_adm_prodi_one_inbound($id)->row();

		if ($this->pendaftaran_model->put_inbound($data_kegiatan, $pendaftaran->id_mhsw, $pendaftaran->semester, 'Diterima')) {
			$this->session->set_flashdata('success_save', TRUE);
		} else {
			$this->session->set_flashdata('error_save', TRUE);
		}

		redirect('/admin/pendaftaran_inbound_dosen');
	}
}
?>