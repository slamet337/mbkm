<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Persyaratan extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model("mbkm_model");
		$this->load->model("matakuliah_model");
    date_default_timezone_set("Asia/Makassar");
	}

	public function index()
	{
		$data['data'] = array(
			'persyaratan' => $this->mbkm_model->get_persyaratan()->result(),
		);
		$data['content'] = 'persyaratan/index';
		$this->load->view('main/admin/index', $data);
	}

	public function add()
	{
		$data['kegiatan'] = $this->matakuliah_model->get_kegiatan()->result();
		$data['content'] = 'persyaratan/add';
		$this->load->view('main/admin/index', $data);
	}

	public function post()
  {
		$this->form_validation->set_rules('id_kegiatan', 'Kegiatan MBKM', 'required');
		$this->form_validation->set_rules('persyaratan', 'Persyaratan', 'required');
    
		$this->form_validation->set_message('required', '{field} harus terisi.');
		
		if ($this->form_validation->run() === FALSE)
		{
      $data['kegiatan'] = $this->matakuliah_model->get_kegiatan()->result();
      $data['content'] = 'persyaratan/add';
      $this->load->view('main/admin/index', $data);
		}
		else
		{
			$data = array(
				'id_kegiatan' => $this->input->post('id_kegiatan'),
				'persyaratan' => $this->input->post('persyaratan'),
			);
			
			if ($this->mbkm_model->post_persyaratan($data)) {
				$this->session->set_flashdata('success_save', TRUE);
			} else {
				$this->session->set_flashdata('error_save', TRUE);
			}

			redirect('/admin/persyaratan');
		}
  }

	public function edit($id)
	{
		$data['persyaratan'] = $this->mbkm_model->get_persyaratan_one($id)->row();
		$data['kegiatan'] = $this->matakuliah_model->get_kegiatan()->result();
		$data['content'] = 'persyaratan/edit';
		$this->load->view('main/admin/index', $data);
	}

	public function update($id)
	{
		$this->form_validation->set_rules('id_kegiatan', 'Kegiatan MBKM', 'required');
		$this->form_validation->set_rules('persyaratan', 'Persyaratan', 'required');
		
		$this->form_validation->set_message('required', '{field} harus terisi.');
		
		if ($this->form_validation->run() === FALSE) {
      $data['persyaratan'] = $this->mbkm_model->get_persyaratan_one($id)->row();
      $data['kegiatan'] = $this->matakuliah_model->get_kegiatan()->result();
      $data['content'] = 'persyaratan/edit';
      $this->load->view('main/admin/index', $data);
		} else {
			$data = array(
				'id_kegiatan' => $this->input->post('id_kegiatan'),
				'persyaratan' => $this->input->post('persyaratan'),
			);
			
			if ($this->mbkm_model->put_persyaratan($data, $id)) {
				$this->session->set_flashdata('success_update', TRUE);
			} else {
				$this->session->set_flashdata('error_update', TRUE);
			}

			redirect('/admin/persyaratan');
		}
	}

	public function delete()
	{
		$data = new stdClass();
		if ($this->mbkm_model->delete_persyaratan($this->input->post('id'))) {
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