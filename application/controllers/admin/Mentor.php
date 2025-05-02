<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mentor extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model("mentor_model");
    date_default_timezone_set("Asia/Makassar");
	}

	public function index()
	{
		$data['data'] = array(
			'mentor' => $this->mentor_model->get_mentor($this->session->id_mitra)->result(),
		);
		$data['content'] = 'mentor/index';
		$this->load->view('main/admin/index', $data);
	}

	public function add()
	{
		$data['content'] = 'mentor/add';
		$this->load->view('main/admin/index', $data);
	}

	public function post()
  {
		$this->form_validation->set_rules('nama', 'Nama Mentor', 'required');
		$this->form_validation->set_rules('phone_number', 'Nomor HP', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
		$this->form_validation->set_rules('pendidikan_terakhir', 'Pendidikan Terakhir', 'required');
		$this->form_validation->set_rules('jenis_personil', 'Jenis Personil', 'required');
		$this->form_validation->set_rules('sertifikasi_keahlian', 'Sertifikasi Atau Keahlian', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
    
		$this->form_validation->set_message('required', '{field} harus terisi.');
		
		if ($this->form_validation->run() === FALSE)
		{
      $data['content'] = 'mentor/add';
      $this->load->view('main/admin/index', $data);
		}
		else
		{
			$data = array(
				'nama' => $this->input->post('nama'),
				'phone_number' => $this->input->post('phone_number'),
				'email' => $this->input->post('email'),
				'jabatan' => $this->input->post('jabatan'),
				'pendidikan_terakhir' => $this->input->post('pendidikan_terakhir'),
				'sertifikasi_keahlian' => $this->input->post('sertifikasi_keahlian'),
				'alamat' => $this->input->post('alamat'),
				'jenis_personil' => $this->input->post('jenis_personil'),
				'id_mitra' => $this->session->id_mitra,
			);
			
			if ($this->mentor_model->post($data)) {
				$this->session->set_flashdata('success_save', TRUE);
			} else {
				$this->session->set_flashdata('error_save', TRUE);
			}

			redirect('/admin/mentor');
		}
  }

	public function edit($id)
	{
		$data['data'] = array(
			'mentor' => $this->mentor_model->get_mentor_one($id)->row(),
		);
		$data['content'] = 'mentor/edit';
		$this->load->view('main/admin/index', $data);
	}

	public function update($id)
	{
		$this->form_validation->set_rules('nama', 'Nama Mentor', 'required');
		$this->form_validation->set_rules('phone_number', 'Nomor HP', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
		$this->form_validation->set_rules('pendidikan_terakhir', 'Pendidikan Terakhir', 'required');
		$this->form_validation->set_rules('jenis_personil', 'Jenis Personil', 'required');
		$this->form_validation->set_rules('sertifikasi_keahlian', 'Sertifikasi Atau Keahlian', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		
		$this->form_validation->set_message('required', '{field} harus terisi.');
		
		if ($this->form_validation->run() === FALSE) {
      $data['data'] = array(
        'mentor' => $this->mentor_model->get_mentor_one($id)->row(),
      );
      $data['content'] = 'mentor/edit';
      $this->load->view('main/admin/index', $data);
		} else {
			$data = array(
				'nama' => $this->input->post('nama'),
				'phone_number' => $this->input->post('phone_number'),
				'email' => $this->input->post('email'),
				'jabatan' => $this->input->post('jabatan'),
				'pendidikan_terakhir' => $this->input->post('pendidikan_terakhir'),
				'sertifikasi_keahlian' => $this->input->post('sertifikasi_keahlian'),
				'jenis_personil' => $this->input->post('jenis_personil'),
				'alamat' => $this->input->post('alamat'),
			);
			
			if ($this->mentor_model->put($data, $id)) {
				$this->session->set_flashdata('success_update', TRUE);
			} else {
				$this->session->set_flashdata('error_update', TRUE);
			}

			redirect('/admin/mentor');
		}
	}

	public function delete()
	{
		$data = new stdClass();
		if ($this->mentor_model->delete($this->input->post('id'))) {
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