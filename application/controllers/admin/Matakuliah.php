<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Matakuliah extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model("matakuliah_model");
    date_default_timezone_set("Asia/Makassar");
	}

	public function index()
	{
		$data['data'] = array(
			'matakuliah' => $this->matakuliah_model->get_matakuliah_prodi()->result(),
		);
		$data['content'] = 'matakuliah/index';
		$this->load->view('main/admin/index', $data);
	}

	public function add()
	{
		$data['content'] = 'matakuliah/add';
		$this->load->view('main/admin/index', $data);
	}

	public function post()
  {
		$this->form_validation->set_rules('kd_mk', 'Kode MK', 'required');
		$this->form_validation->set_rules('matakuliah', 'Matakuliah', 'required');
		$this->form_validation->set_rules('sks', 'SKS', 'required');
    
		$this->form_validation->set_message('required', '{field} harus terisi.');
		
		if ($this->form_validation->run() === FALSE)
		{
			$data['content'] = 'matakuliah/add';
			$this->load->view('main/admin/index', $data);
		}
		else
		{
			$data = array(
				'kd_mk' => $this->input->post('kd_mk'),
				'matakuliah' => $this->input->post('matakuliah'),
				'sks' => $this->input->post('sks'),
			);
			
			if ($this->matakuliah_model->post_matakuliah($data)) {
				$this->session->set_flashdata('success_save', TRUE);
			} else {
				$this->session->set_flashdata('error_save', TRUE);
			}

			redirect('/admin/matakuliah');
		}
  }

	public function edit($id)
	{
		$data['data'] = array(
			'matakuliah' => $this->matakuliah_model->get_list_matakuliah_one($id)->row(),
		);
		$data['content'] = 'matakuliah/edit';
		$this->load->view('main/admin/index', $data);
	}

	public function update($id)
	{
		$this->form_validation->set_rules('kd_mk', 'Kode MK', 'required');
		$this->form_validation->set_rules('matakuliah', 'Matakuliah', 'required');
		$this->form_validation->set_rules('sks', 'SKS', 'required');
    
		$this->form_validation->set_message('required', '{field} harus terisi.');
		
		if ($this->form_validation->run() === FALSE) {
			$data['data'] = array(
        'matakuliah' => $this->matakuliah_model->get_list_matakuliah_one($id)->row(),
      );
      $data['content'] = 'matakuliah/edit';
      $this->load->view('main/admin/index', $data);
		} else {
			$data = array(
				'matakuliah' => $this->input->post('matakuliah'),
				'sks' => $this->input->post('sks'),
			);
			
			if ($this->matakuliah_model->put_matakuliah($data, $id)) {
				$this->session->set_flashdata('success_update', TRUE);
			} else {
				$this->session->set_flashdata('error_update', TRUE);
			}

			redirect('/admin/matakuliah');
		}
	}

	public function delete()
	{
		$data = new stdClass();
		if ($this->matakuliah_model->delete_matakuliah($this->input->post('id'))) {
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