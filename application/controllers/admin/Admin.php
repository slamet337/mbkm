<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model("users_model");
    date_default_timezone_set("Asia/Makassar");
	}

	public function index()
	{
		$data['data'] = array(
			'admin' => $this->users_model->get_admin()->result(),
		);
		$data['content'] = 'admin/index';
		$this->load->view('main/admin/index', $data);
	}

	public function add()
	{
		$data['content'] = 'admin/add';
		$this->load->view('main/admin/index', $data);
	}

	public function post()
  {
		$this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
		$this->form_validation->set_rules('full_name', 'Nama Lengkap', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('phone_number', 'Nomor HP', 'required');
		
		$this->form_validation->set_message('required', '{field} harus terisi.');
		$this->form_validation->set_message('is_unique', '{field} sudah terdaftar.');
		
		if ($this->form_validation->run() === FALSE)
		{
			$data['content'] = 'admin/add';
			$this->load->view('main/admin/index', $data);
		}
		else
		{
			$data = array(
				'username' => $this->input->post('username'),
				'full_name' => $this->input->post('full_name'),
				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'phone_number' => $this->input->post('phone_number'),
				'id_level' => '1',
			);
			
			if ($this->users_model->post($data)) {
				$this->session->set_flashdata('success_save', TRUE);
			} else {
				$this->session->set_flashdata('error_save', TRUE);
			}

			redirect('/admin/admin');
		}
  }

	public function edit($username)
	{
		$data['data'] = array(
			'admin' => $this->users_model->get_admin_one($username)->row(),
		);
		$data['content'] = 'admin/edit';
		$this->load->view('main/admin/index', $data);
	}

	public function update($username)
	{
		if($username != $this->input->post('username')) {
			$this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
		} else {
			$this->form_validation->set_rules('username', 'Username', 'required');
		}
		$this->form_validation->set_rules('full_name', 'Nama Lengkap', 'required');
		$this->form_validation->set_rules('phone_number', 'Nomor HP', 'required');
		
		$this->form_validation->set_message('required', '{field} harus terisi.');
		$this->form_validation->set_message('is_unique', '{field} sudah terdaftar.');
		
		if ($this->form_validation->run() === FALSE) {
			$data['data'] = array(
				'admin' => $this->users_model->get_admin_one($username)->row(),
			);
			$data['content'] = 'admin/edit';
			$this->load->view('main/admin/index', $data);
		} else {
			if ($this->input->post('password') == "") {
				$data = array(
					'username' => $this->input->post('username'),
					'full_name' => $this->input->post('full_name'),
					'phone_number' => $this->input->post('phone_number'),
					'id_level' => '1',
				);
			} else {
				$data = array(
					'username' => $this->input->post('username'),
					'full_name' => $this->input->post('full_name'),
					'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
					'phone_number' => $this->input->post('phone_number'),
					'id_level' => '1',
				);
			}
			
			if ($this->users_model->put($data, $username)) {
				$this->session->set_flashdata('success_update', TRUE);
			} else {
				$this->session->set_flashdata('error_update', TRUE);
			}

			redirect('/admin/admin');
		}
	}

	public function delete()
	{
		$data = new stdClass();
		if ($this->users_model->delete($this->input->post('id'))) {
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