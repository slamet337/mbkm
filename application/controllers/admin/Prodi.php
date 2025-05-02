<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prodi extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model("users_model");
    date_default_timezone_set("Asia/Makassar");
	}

	public function index()
	{
		$data['data'] = array(
			'prodi' => $this->users_model->get_prodi()->result(),
		);
		$data['content'] = 'prodi/index';
		$this->load->view('main/admin/index', $data);
	}

	public function show_prodi()
	{
		$kd_jur = $this->input->post('kd_jur');

		$data = new stdClass();
		$jurusan = $this->users_model->get_prodi_kd_jur($kd_jur);
		if ($jurusan->num_rows() >= 0) {
			$data->status = "success";
			$data->data = $jurusan->result();
		} else {
			$data->status = "failed";
		}

		$json = json_encode($data);

		echo $json;
	}

	public function add()
	{
		$data['content'] = 'prodi/add';
		$data['jurusan'] = $this->users_model->get_jurusan()->result();
		$data['prodi'] = $this->users_model->get_prodi_all()->result();
		$this->load->view('main/admin/index', $data);
	}

	public function post()
  {
		$this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
		$this->form_validation->set_rules('full_name', 'Nama Lengkap', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('phone_number', 'Nomor HP', 'required');
		$this->form_validation->set_rules('kd_jur', 'Jurusan', 'required');
		$this->form_validation->set_rules('kd_prodi', 'Prodi', 'required');
		
		$this->form_validation->set_message('required', '{field} harus terisi.');
		$this->form_validation->set_message('is_unique', '{field} sudah terdaftar.');
		
		if ($this->form_validation->run() === FALSE)
		{
			$data['content'] = 'prodi/add';
			$this->load->view('main/admin/index', $data);
		}
		else
		{
			$data = array(
				'username' => $this->input->post('username'),
				'full_name' => $this->input->post('full_name'),
				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'phone_number' => $this->input->post('phone_number'),
				'kd_prodi' => $this->input->post('kd_prodi'),
				'id_level' => '2',
			);
			
			if ($this->users_model->post($data)) {
				$this->session->set_flashdata('success_save', TRUE);
			} else {
				$this->session->set_flashdata('error_save', TRUE);
			}

			redirect('/admin/prodi');
		}
  }

	public function edit($username)
	{
		$data['data'] = array(
			'prodi' => $this->users_model->get_prodi_one($username)->row(),
		);
		$data['jurusan'] = $this->users_model->get_jurusan()->result();
		$data['list_prodi'] = $this->users_model->get_prodi_all()->result();
		$data['content'] = 'prodi/edit';
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
		$this->form_validation->set_rules('kd_jur', 'Jurusan', 'required');
		$this->form_validation->set_rules('kd_prodi', 'Prodi', 'required');
		
		$this->form_validation->set_message('required', '{field} harus terisi.');
		$this->form_validation->set_message('is_unique', '{field} sudah terdaftar.');
		
		if ($this->form_validation->run() === FALSE) {
			$data['data'] = array(
				'prodi' => $this->users_model->get_prodi_one($username)->row(),
			);
			$data['content'] = 'prodi/edit';
			$this->load->view('main/admin/index', $data);
		} else {
			if ($this->input->post('password') == "") {
				$data = array(
					'username' => $this->input->post('username'),
					'full_name' => $this->input->post('full_name'),
					'phone_number' => $this->input->post('phone_number'),
					'kd_prodi' => $this->input->post('kd_prodi'),
					'id_level' => '2',
				);
			} else {
				$data = array(
					'username' => $this->input->post('username'),
					'full_name' => $this->input->post('full_name'),
					'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
					'phone_number' => $this->input->post('phone_number'),
					'kd_prodi' => $this->input->post('kd_prodi'),
					'id_level' => '2',
				);
			}
			
			if ($this->users_model->put($data, $username)) {
				$this->session->set_flashdata('success_update', TRUE);
			} else {
				$this->session->set_flashdata('error_update', TRUE);
			}

			redirect('/admin/prodi');
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