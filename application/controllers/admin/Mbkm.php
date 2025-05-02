<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mbkm extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model("mbkm_model");
    date_default_timezone_set("Asia/Makassar");
	}

	public function index()
	{
		$data['data'] = array(
			'mbkm' => $this->mbkm_model->get_mbkm()->result(),
		);
		$data['content'] = 'mbkm/index';
		$this->load->view('main/admin/index', $data);
	}

	public function add()
	{
		$data['content'] = 'mbkm/add';
		$this->load->view('main/admin/index', $data);
	}

	public function post()
  {
		$this->form_validation->set_rules('nama_program', 'Nama Program MBKM', 'required');
    
		$this->form_validation->set_message('required', '{field} harus terisi.');
		
		if ($this->form_validation->run() === FALSE)
		{
			$data['content'] = 'mbkm/add';
			$this->load->view('main/admin/index', $data);
		}
		else
		{
			$data = array(
				'nama_program' => $this->input->post('nama_program'),
			);
			
			if ($this->mbkm_model->post($data)) {
				$this->session->set_flashdata('success_save', TRUE);
			} else {
				$this->session->set_flashdata('error_save', TRUE);
			}

			redirect('/admin/mbkm');
		}
  }

	public function edit($id)
	{
		$data['data'] = array(
			'mbkm' => $this->mbkm_model->get_mbkm_one($id)->row(),
		);
		$data['content'] = 'mbkm/edit';
		$this->load->view('main/admin/index', $data);
	}

	public function update($id)
	{
		$this->form_validation->set_rules('nama_program', 'Nama Program MBKM', 'required');
		
		$this->form_validation->set_message('required', '{field} harus terisi.');
		
		if ($this->form_validation->run() === FALSE) {
      $data['data'] = array(
        'mbkm' => $this->mbkm_model->get_mbkm_one($id)->row(),
      );
      $data['content'] = 'mbkm/edit';
      $this->load->view('main/admin/index', $data);
		} else {
			$data = array(
				'nama_program' => $this->input->post('nama_program'),
			);
			
			if ($this->mbkm_model->put($data, $id)) {
				$this->session->set_flashdata('success_update', TRUE);
			} else {
				$this->session->set_flashdata('error_update', TRUE);
			}

			redirect('/admin/mbkm');
		}
	}

	public function delete()
	{
		$data = new stdClass();
		if ($this->mbkm_model->delete($this->input->post('id'))) {
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