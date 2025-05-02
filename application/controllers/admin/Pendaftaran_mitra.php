<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran_mitra extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model("pendaftaran_model");
		$this->load->model("matakuliah_model");
		$this->load->model("mentor_model");
		$this->load->model("logbook_model");
    date_default_timezone_set("Asia/Makassar");
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

	public function index()
	{
		$data['data'] = array(
			'pendaftaran' => $this->pendaftaran_model->get_pendaftaran_mitra($this->session->id_mitra)->result(),
		);
		$data['content'] = 'pendaftaran/index_mitra';
		$this->load->view('main/admin/index', $data);
	}

	public function logbook($id)
	{
		$data['data'] = array(
			'logbook' => $this->logbook_model->get_logbook_dosen($id)->result(),
		);
		$data['content'] = 'pendaftaran/logbook_mitra';
		$this->load->view('main/admin/index', $data);
	}

	public function input_nilai($id_daftar, $id_kegiatan)
	{
		$data['data'] = array(
			'pendaftaran' => $this->pendaftaran_model->get_pendaftaran_adm_prodi_one($id_daftar)->row(),
			'matakuliah' => $this->pendaftaran_model->get_matakuliah_konversi_pertukaran($id_daftar)->result(),
		);
		$data['content'] = 'pendaftaran/nilai_prodi_mitra';
		$this->load->view('main/admin/index', $data);

	}

	public function update_nilai($id)
	{
		$id_mk = $this->input->post('id_mk');
		$nilai = $this->input->post('nilai');
		$grade = $this->input->post('grade');

		foreach ($id_mk as $key => $value) {
			$data = array(
				'id_pendaftaran' => $id,
				'id_matakuliah_pertukaran' => $value,
				'nilai' => $nilai[$key],
				'grade' => $grade[$key],
				'id_user' => $this->session->id,
			);
			
			$this->pendaftaran_model->post_nilai_pertukaran($data);
		}

		$data_kegiatan = array(
			'status_kegiatan' => 'Selesai',
		);

		if ($this->pendaftaran_model->put($data_kegiatan, $id)) {
			$this->session->set_flashdata('success_save', TRUE);
		} else {
			$this->session->set_flashdata('error_save', TRUE);
		}

		redirect('/admin/pendaftaran_mitra');
	}

  public function mentor($id)
	{
		$data['data'] = array(
			'pendaftaran' => $this->pendaftaran_model->get_pendaftaran_mitra_one($id)->row(),
			'mentor' => $this->mentor_model->get_mentor($this->session->id_mitra)->result(),
		);
		$data['content'] = 'pendaftaran/mentor';
		$this->load->view('main/admin/index', $data);
	}

	public function update($id)
	{
		$this->form_validation->set_rules('id_mentor', 'Nama Mentor', 'required');
		
		$this->form_validation->set_message('required', '{field} harus terisi.');
		
		if ($this->form_validation->run() === FALSE) {
      $data['data'] = array(
        'pendaftaran' => $this->pendaftaran_model->get_pendaftaran_mitra_one($id)->row(),
      );
      $data['content'] = 'pendaftaran/mentor';
      $this->load->view('main/admin/index', $data);
		} else {
      $data = array(
        'id_mentor' => $this->input->post('id_mentor'),
      );

			if ($this->pendaftaran_model->put($data, $id)) {
				$this->session->set_flashdata('success_update', TRUE);
			} else {
				$this->session->set_flashdata('error_update', TRUE);
			}

			redirect('/admin/pendaftaran_mitra');
		}
	}
}
?>