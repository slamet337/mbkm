<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model("users_model");
    date_default_timezone_set("Asia/Makassar");
	}

	public function index()
	{
		$data['data'] = array(
			'dosen' => $this->users_model->get_dosen()->result(),
		);
		$data['content'] = 'dosen/index';
		$this->load->view('main/admin/index', $data);
	}

	public function add()
	{
		$data['content'] = 'dosen/add';
		$data['prodi'] = $this->users_model->get_prodi_all()->result();
		$this->load->view('main/admin/index', $data);
	}

	public function post()
  {
		$this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
		$this->form_validation->set_rules('full_name', 'Nama Lengkap', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('phone_number', 'Nomor HP', 'required');
		$this->form_validation->set_rules('nip', 'NIP', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('kd_prodi', 'Prodi', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		
		$this->form_validation->set_message('required', '{field} harus terisi.');
		$this->form_validation->set_message('is_unique', '{field} sudah terdaftar.');
		
		if ($this->form_validation->run() === FALSE)
		{
      $data['content'] = 'dosen/add';
      $data['prodi'] = $this->users_model->get_prodi_all()->result();
      $this->load->view('main/admin/index', $data);
		}
		else
		{
			$data = array(
				'username' => $this->input->post('username'),
				'full_name' => $this->input->post('full_name'),
				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
        'kd_prodi' => $this->input->post('kd_prodi'),
				'phone_number' => $this->input->post('phone_number'),
				'id_level' => '4',
			);
			
      $id_user = $this->users_model->post_user_dosen($data);
			if ($id_user) {
				$data_dosen = array(
          'id_user' => $id_user,
          'nama' => $this->input->post('full_name'),
          'email' => $this->input->post('email'),
          'nip' => $this->input->post('nip'),
          'kd_fak' => 'C',
          'kd_prodi' => $this->input->post('kd_prodi'),
					'phone_number' => $this->input->post('phone_number'),
					'alamat' => $this->input->post('alamat'),
        );
        if($this->users_model->post_dosen($data_dosen)) {
          $this->session->set_flashdata('success_save', TRUE);
        } else {
          $this->session->set_flashdata('error_save', TRUE);
        }
			} else {
				$this->session->set_flashdata('error_save', TRUE);
			}

			redirect('/admin/dosen');
		}
  }

	public function edit($id)
	{
		$data['data'] = array(
			'dosen' => $this->users_model->get_dosen_one($id)->row(),
		);
		$data['content'] = 'dosen/edit';
		$data['prodi'] = $this->users_model->get_prodi_all()->result();
		$this->load->view('main/admin/index', $data);
	}

	public function update($id)
	{
		if($this->input->post('old_username') != $this->input->post('username')) {
			$this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
		} else {
			$this->form_validation->set_rules('username', 'Username', 'required');
		}
		$this->form_validation->set_rules('full_name', 'Nama Lengkap', 'required');
		$this->form_validation->set_rules('phone_number', 'Nomor HP', 'required');
		$this->form_validation->set_rules('nip', 'NIP', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('kd_prodi', 'Prodi', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		
		$this->form_validation->set_message('required', '{field} harus terisi.');
		$this->form_validation->set_message('is_unique', '{field} sudah terdaftar.');
		
		if ($this->form_validation->run() === FALSE) {
      $data['data'] = array(
        'dosen' => $this->users_model->get_dosen_one($id)->row(),
      );
      $data['content'] = 'dosen/edit';
      $data['prodi'] = $this->users_model->get_prodi_all()->result();
      $this->load->view('main/admin/index', $data);
		} else {
			if ($this->input->post('password') == "") {
				$data = array(
          'username' => $this->input->post('username'),
          'full_name' => $this->input->post('full_name'),
          'kd_prodi' => $this->input->post('kd_prodi'),
          'phone_number' => $this->input->post('phone_number'),
          'id_level' => '4',
				);
			} else {
				$data = array(
          'username' => $this->input->post('username'),
          'full_name' => $this->input->post('full_name'),
          'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
          'kd_prodi' => $this->input->post('kd_prodi'),
          'phone_number' => $this->input->post('phone_number'),
          'id_level' => '4',
				);
			}
			
			if ($this->users_model->put_user_dosen($data, $id)) {
        $data_dosen = array(
          'nama' => $this->input->post('full_name'),
          'email' => $this->input->post('email'),
          'nip' => $this->input->post('nip'),
          'kd_fak' => 'C',
          'kd_prodi' => $this->input->post('kd_prodi'),
					'phone_number' => $this->input->post('phone_number'),
					'alamat' => $this->input->post('alamat'),
        );

        if($this->users_model->put_dosen($data_dosen, $id)) {
          $this->session->set_flashdata('success_update', TRUE);
        } else {
          $this->session->set_flashdata('error_update', TRUE);
        }
			} else {
				$this->session->set_flashdata('error_update', TRUE);
			}

			redirect('/admin/dosen');
		}
	}

	public function delete()
	{
		$data = new stdClass();
		if ($this->users_model->delete_user_dosen($this->input->post('id'))) {    
  		if ($this->users_model->delete_dosen($this->input->post('id'))) {
        $data->status = "success";	
        $data->id = $this->input->post('id');
      } else {
        $data->status = "failed";	
        $data->id = $this->input->post('id');	
      }
		} else {
			$data->status = "failed";	
			$data->id = $this->input->post('id');	
		}

		$json = json_encode($data);

		echo $json;
  }
}
?>