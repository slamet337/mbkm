<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mitra extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model("mitra_model");
    date_default_timezone_set("Asia/Makassar");
	}

	public function index()
	{
		$data['data'] = array(
			'mitra' => $this->mitra_model->get_mitra()->result(),
		);
		$data['content'] = 'mitra/index';
		$this->load->view('main/admin/index', $data);
	}

	public function add()
	{
		$data['content'] = 'mitra/add';
		$this->load->view('main/admin/index', $data);
	}

	public function post()
  {
		$this->form_validation->set_rules('nama_mitra', 'Nama Mitra', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('phone_number', 'Nomor HP', 'required');
		
		$this->form_validation->set_message('required', '{field} harus terisi.');
		
		if ($this->form_validation->run() === FALSE) {
			$data['content'] = 'mitra/add';
			$this->load->view('main/admin/index', $data);
		} else {
			$data = array(
				'nama_mitra' => $this->input->post('nama_mitra'),
				'email' => $this->input->post('email'),
				'phone_number' => $this->input->post('phone_number'),
				'alamat' => $this->input->post('alamat'),
			);
			
			if ($this->mitra_model->post($data)) {
				$this->session->set_flashdata('success_save', TRUE);
			} else {
				$this->session->set_flashdata('error_save', TRUE);
			}

			redirect('/admin/mitra');
		}
  }

	public function edit($id)
	{
		$data['data'] = array(
			'mitra' => $this->mitra_model->get_mitra_one($id)->row(),
		);
		$data['content'] = 'mitra/edit';
		$this->load->view('main/admin/index', $data);
	}

	public function update($id)
	{
		$this->form_validation->set_rules('nama_mitra', 'Nama Mitra', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('phone_number', 'Nomor HP', 'required');
		
		$this->form_validation->set_message('required', '{field} harus terisi.');
		
		if ($this->form_validation->run() === FALSE) {
			$data['data'] = array(
				'mitra' => $this->mitra_model->get_mitra_one($id)->row(),
			);
			$data['content'] = 'mitra/edit';
			$this->load->view('main/admin/index', $data);
		} else {
			$data = array(
				'nama_mitra' => $this->input->post('nama_mitra'),
				'email' => $this->input->post('email'),
				'phone_number' => $this->input->post('phone_number'),
				'alamat' => $this->input->post('alamat'),
			);
			
			if ($this->mitra_model->put($data, $id)) {
				$this->session->set_flashdata('success_update', TRUE);
			} else {
				$this->session->set_flashdata('error_update', TRUE);
			}

			redirect('/admin/mitra');
		}
	}

	public function delete()
	{
		$data = new stdClass();
		if ($this->mitra_model->delete($this->input->post('id'))) {
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