<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konversi_mk extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model("matakuliah_model");
    date_default_timezone_set("Asia/Makassar");
	}

	public function index()
	{
		$data['data'] = array(
			'matakuliah' => $this->matakuliah_model->get_matakuliah()->result(),
		);
		$data['content'] = 'konversi_mk/index';
		$this->load->view('main/admin/index', $data);
	}

	public function add()
	{
		$data['kegiatan'] = $this->matakuliah_model->get_kegiatan()->result();
		$data['matakuliah'] = $this->matakuliah_model->get_matakuliah_prodi()->result();
		$data['content'] = 'konversi_mk/add';
		$this->load->view('main/admin/index', $data);
	}

	public function post()
  {
		$this->form_validation->set_rules('id_program_kegiatan', 'Kegiatan MBKM', 'required');
		$this->form_validation->set_rules('kd_mk', 'Kode Matakuliah', 'required');
    
		$this->form_validation->set_message('required', '{field} harus terisi.');
		
		if ($this->form_validation->run() === FALSE)
		{
			$data['kegiatan'] = $this->matakuliah_model->get_kegiatan()->result();
			$data['matakuliah'] = $this->matakuliah_model->get_matakuliah_prodi()->result();
			$data['dosen'] = $this->matakuliah_model->get_dosen()->result();
			$data['content'] = 'konversi_mk/add';
			$this->load->view('main/admin/index', $data);
		}
		else
		{
			$data = array(
				'id_program_kegiatan' => $this->input->post('id_program_kegiatan'),
				'kd_prodi' => $this->session->kd_prodi,
				'kd_mk' => $this->input->post('kd_mk'),
			);
			
			if ($this->matakuliah_model->post($data)) {
				$this->session->set_flashdata('success_save', TRUE);
			} else {
				$this->session->set_flashdata('error_save', TRUE);
			}

			redirect('/admin/konversi_mk');
		}
  }

	public function edit($id)
	{
		$data['data'] = array(
			'konversi_mk' => $this->matakuliah_model->get_matakuliah_one($id)->row(),
		);
		$data['kegiatan'] = $this->matakuliah_model->get_kegiatan()->result();
		$data['matakuliah'] = $this->matakuliah_model->get_matakuliah_prodi()->result();
		$data['dosen'] = $this->matakuliah_model->get_dosen()->result();
		$data['content'] = 'konversi_mk/edit';
		$this->load->view('main/admin/index', $data);
	}

	public function update($id)
	{
		$this->form_validation->set_rules('id_program_kegiatan', 'Kegiatan MBKM', 'required');
		$this->form_validation->set_rules('kd_mk', 'Kode Matakuliah', 'required');
		$this->form_validation->set_message('required', '{field} harus terisi.');
		
		if ($this->form_validation->run() === FALSE) {
			$data['data'] = array(
				'konversi_mk' => $this->matakuliah_model->get_matakuliah_one($id)->row(),
			);
			$data['kegiatan'] = $this->matakuliah_model->get_kegiatan()->result();
			$data['matakuliah'] = $this->matakuliah_model->get_matakuliah_prodi()->result();
			$data['dosen'] = $this->matakuliah_model->get_dosen()->result();
			$data['content'] = 'konversi_mk/edit';
			$this->load->view('main/admin/index', $data);
		} else {
			$data = array(
				'id_program_kegiatan' => $this->input->post('id_program_kegiatan'),
				'kd_prodi' => $this->session->kd_prodi,
				'kd_mk' => $this->input->post('kd_mk'),
			);
			
			if ($this->matakuliah_model->put($data, $id)) {
				$this->session->set_flashdata('success_update', TRUE);
			} else {
				$this->session->set_flashdata('error_update', TRUE);
			}

			redirect('/admin/konversi_mk');
		}
	}

	public function delete()
	{
		$data = new stdClass();
		if ($this->matakuliah_model->delete($this->input->post('id'))) {
			$data->status = "success";	
			$data->id = $this->input->post('id');
		} else {
			$data->status = "failed";	
			$data->id = $this->input->post('id');	
		}

		$json = json_encode($data);

		echo $json;
  }
}
?>