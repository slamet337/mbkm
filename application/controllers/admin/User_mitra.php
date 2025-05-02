<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_mitra extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model("users_model");
    date_default_timezone_set("Asia/Makassar");
	}

	public function index()
	{
		$data['data'] = array(
			'user_mitra' => $this->users_model->get_user_mitra()->result(),
		);
		$data['content'] = 'user_mitra/index';
		$this->load->view('main/admin/index', $data);
	}

	public function add()
	{
		$data['content'] = 'user_mitra/add';
		$data['mitra'] = $this->users_model->get_mitra()->result();
		$this->load->view('main/admin/index', $data);
	}

	public function post()
  {
		$this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
		$this->form_validation->set_rules('full_name', 'Nama Lengkap', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('phone_number', 'Nomor HP', 'required');
		$this->form_validation->set_rules('id_mitra', 'Mitra', 'required');
		
		$this->form_validation->set_message('required', '{field} harus terisi.');
		$this->form_validation->set_message('is_unique', '{field} sudah terdaftar.');
		
		if ($this->form_validation->run() === FALSE)
		{
			$data['content'] = 'user_mitra/add';
			$data['mitra'] = $this->users_model->get_mitra()->result();
			$this->load->view('main/admin/index', $data);
		}
		else
		{
			$data = array(
				'username' => $this->input->post('username'),
				'full_name' => $this->input->post('full_name'),
				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'phone_number' => $this->input->post('phone_number'),
				'id_mitra' => $this->input->post('id_mitra'),
				'id_level' => '3',
			);
			
			if ($this->users_model->post($data)) {
				$this->session->set_flashdata('success_save', TRUE);
			} else {
				$this->session->set_flashdata('error_save', TRUE);
			}

			redirect('/admin/user_mitra');
		}
  }

	public function edit($username)
	{
		$data['data'] = array(
			'user_mitra' => $this->users_model->get_user_mitra_one($username)->row(),
		);
		$data['mitra'] = $this->users_model->get_mitra()->result();
		$data['content'] = 'user_mitra/edit';
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
		$this->form_validation->set_rules('id_mitra', 'Mitra', 'required');
		
		$this->form_validation->set_message('required', '{field} harus terisi.');
		$this->form_validation->set_message('is_unique', '{field} sudah terdaftar.');
		
		if ($this->form_validation->run() === FALSE) {
			$data['data'] = array(
				'user_mitra' => $this->users_model->get_user_mitra_one($username)->row(),
			);
			$data['mitra'] = $this->users_model->get_mitra()->result();
			$data['content'] = 'user_mitra/edit';
			$this->load->view('main/admin/index', $data);
		} else {
			if ($this->input->post('password') == "") {
				$data = array(
					'username' => $this->input->post('username'),
					'full_name' => $this->input->post('full_name'),
					'phone_number' => $this->input->post('phone_number'),
					'id_mitra' => $this->input->post('id_mitra'),
					'id_level' => '3',
				);
			} else {
				$data = array(
					'username' => $this->input->post('username'),
					'full_name' => $this->input->post('full_name'),
					'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
					'phone_number' => $this->input->post('phone_number'),
					'id_mitra' => $this->input->post('id_mitra'),
					'id_level' => '3',
				);
			}
			
			if ($this->users_model->put($data, $username)) {
				$this->session->set_flashdata('success_update', TRUE);
			} else {
				$this->session->set_flashdata('error_update', TRUE);
			}

			redirect('/admin/user_mitra');
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