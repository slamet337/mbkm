<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran_luar extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model("pendaftaran_luar_model");
    date_default_timezone_set("Asia/Makassar");
	}

	public function index()
	{
		$data['data'] = array(
			'pendaftaran' => $this->pendaftaran_luar_model->get_pendaftar_prodi($this->session->kd_prodi)->result(),
		);
		$data['content'] = 'pendaftaran_luar/index';
		$this->load->view('main/admin/index', $data);
	}

  public function input_nilai($id)
	{
		$data['data'] = array(
			'matakuliah' => $this->pendaftaran_luar_model->get_matakuliah_kegiatan_lain($id)->result(),
			'mahasiswa' => $this->pendaftaran_luar_model->get_mahasiswa($id)->row(),
		);
		$data['content'] = 'pendaftaran_luar/nilai';
		$this->load->view('main/admin/index', $data);

	}

  public function update_nilai($id)
	{
		$id_mk = $this->input->post('id');
		$nilai = $this->input->post('nilai');
		$grade = $this->input->post('grade');

		$this->db->trans_start();
		foreach ($id_mk as $key => $value) {
			$data = array(
				'nilai' => $nilai[$key],
				'grade' => $grade[$key],
				'id_user' => $this->session->id,
			);
			
			$this->pendaftaran_luar_model->put_nilai_mk_lain($data, $value);
		}
		
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$this->session->set_flashdata('error_save', TRUE);
		} 
		else {
			$this->db->trans_commit();
			$this->session->set_flashdata('success_save', TRUE);            
		}

		redirect('/admin/pendaftaran_luar');
	}

}
?>