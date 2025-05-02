<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Panduan extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model("panduan_model");
		$this->load->model("mbkm_model");
    date_default_timezone_set("Asia/Makassar");
	}

	public function index()
	{
		$data['data'] = array(
			'panduan' => $this->panduan_model->get_panduan()->result(),
		);
		$data['content'] = 'panduan/index';
		$this->load->view('main/admin/index', $data);
	}

	public function add()
	{
		$data['content'] = 'panduan/add';
		$this->load->view('main/admin/index', $data);
	}

	public function post()
  {
		$this->form_validation->set_rules('title', 'Program MBKM', 'required');
		$this->form_validation->set_rules('text', 'Text Isi', 'required');
    
		$this->form_validation->set_message('required', '{field} harus terisi.');
		
		if ($this->form_validation->run() === FALSE)
		{
			$data['mbkm'] = $this->mbkm_model->get_mbkm()->result();
			$data['content'] = 'panduan/add';
			$this->load->view('main/admin/index', $data);
		}
		else
		{
			$data = array(
				'title' => $this->input->post('title'),
				'text' => $this->input->post('text'),
			);
			
			if ($this->panduan_model->post($data)) {
				$this->session->set_flashdata('success_save', TRUE);
			} else {
				$this->session->set_flashdata('error_save', TRUE);
			}

			redirect('/admin/panduan');
		}
  }

	public function edit($id)
	{
		$data['data'] = array(
			'panduan' => $this->panduan_model->get_panduan_one($id)->row(),
		);
		$data['content'] = 'panduan/edit';
		$this->load->view('main/admin/index', $data);
	}

	public function update($id)
	{
		$this->form_validation->set_rules('title', 'Program MBKM', 'required');
		$this->form_validation->set_rules('text', 'Text Isi', 'required');
    
		$this->form_validation->set_message('required', '{field} harus terisi.');
		
		if ($this->form_validation->run() === FALSE) {
      $data['data'] = array(
        'panduan' => $this->panduan_model->get_panduan_one($id)->row(),
      );
			$data['mbkm'] = $this->mbkm_model->get_mbkm()->result();
      $data['content'] = 'panduan/edit';
      $this->load->view('main/admin/index', $data);
		} else {
			$data = array(
				'title' => $this->input->post('title'),
				'text' => $this->input->post('text'),
			);
			
			if ($this->panduan_model->put($data, $id)) {
				$this->session->set_flashdata('success_update', TRUE);
			} else {
				$this->session->set_flashdata('error_update', TRUE);
			}

			redirect('/admin/panduan');
		}
	}

	public function delete()
	{
		$data = new stdClass();
		if ($this->panduan_model->delete($this->input->post('id'))) {
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