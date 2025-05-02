<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alumni extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model("alumni_model");
    date_default_timezone_set("Asia/Makassar");
	}

	public function index()
	{
		$data['data'] = array(
			'alumni' => $this->alumni_model->get_alumni($this->session->id)->result(),
		);
		$data['content'] = 'menu/alumni/index';
    $this->load->view('main/users/index_menu', $data);
	}

  public function add()
	{
		$data['content'] = 'menu/alumni/add';
    $this->load->view('main/users/index_menu', $data);
	}

  public function tgl_indo($tanggal){
		$bulan = array (
			1 =>   'Januari',
			'Februari',
			'Maret',
			'April',
			'Mei',
			'Juni',
			'Juli',
			'Agustus',
			'September',
			'Oktober',
			'November',
			'Desember'
		);
		$pecahkan = explode('-', $tanggal);
	 
		return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
	}

  public function tgl_indo_1($tanggal){
		$pecahkan = explode('-', $tanggal);
	 
		return $pecahkan[2] . '/' . $pecahkan[1] . '/' . $pecahkan[0];
	}

  public function post() {
    $this->form_validation->set_rules('tipe', 'Jenis Riwayat', 'required');
    $this->form_validation->set_rules('riwayat', 'Riwayat', 'required');
    $this->form_validation->set_rules('lokasi', 'Lokasi', 'required');
    $this->form_validation->set_rules('status_kerja', 'Status Kerja', 'required');
    $this->form_validation->set_rules('tanggal_mulai', 'Tanggal Mulai', 'required');
    
    $this->form_validation->set_message('required', '{field} harus terisi.');
    
    if ($this->form_validation->run() === FALSE)
    {
      $data['content'] = 'menu/alumni/add';
      $this->load->view('main/users/index_menu', $data);
    }
    else
    {
      $tanggal_mulai = explode("/",$this->input->post('tanggal_mulai'));
      $tanggal_mulai_data = $tanggal_mulai[2]."-".$tanggal_mulai[1]."-".$tanggal_mulai[0];
      $tanggal_selesai = explode("/",$this->input->post('tanggal_selesai'));
      $tanggal_selesai_data = $tanggal_selesai[2]."-".$tanggal_selesai[1]."-".$tanggal_selesai[0];
      $data = array(
        'id_mhsw' => $this->session->id,
        'tipe' => $this->input->post('tipe'),
        'riwayat' => $this->input->post('riwayat'),
        'lokasi' => $this->input->post('lokasi'),
        'status_kerja' => $this->input->post('status_kerja'),
        'tanggal_mulai' => $tanggal_mulai_data,
        'tanggal_selesai' => $tanggal_selesai_data,
      );
    
      if ($this->alumni_model->post($data)) {
        $this->session->set_flashdata('success_save', TRUE);            
      } else {
        $this->session->set_flashdata('error_save', TRUE);
      }

      redirect('/alumni');
    }
  }

  public function edit($id)
	{
    $data['alumni'] = $this->alumni_model->get_alumni_one($id)->row();
		$data['content'] = 'menu/alumni/edit';
    $this->load->view('main/users/index_menu', $data);
	}

  public function update($id) {
    $this->form_validation->set_rules('tipe', 'Jenis Riwayat', 'required');
    $this->form_validation->set_rules('riwayat', 'Riwayat', 'required');
    $this->form_validation->set_rules('lokasi', 'Lokasi', 'required');
    $this->form_validation->set_rules('status_kerja', 'Status Kerja', 'required');
    $this->form_validation->set_rules('tanggal_mulai', 'Tanggal Mulai', 'required');
    
    $this->form_validation->set_message('required', '{field} harus terisi.');
    
    if ($this->form_validation->run() === FALSE)
    {
      $data['alumni'] = $this->alumni_model->get_alumni_one($id)->row();
      $data['content'] = 'menu/alumni/edit';
      $this->load->view('main/users/index_menu', $data);
    }
    else
    {
      $tanggal_mulai = explode("/",$this->input->post('tanggal_mulai'));
      $tanggal_mulai_data = $tanggal_mulai[2]."-".$tanggal_mulai[1]."-".$tanggal_mulai[0];
      $tanggal_selesai = explode("/",$this->input->post('tanggal_selesai'));
      $tanggal_selesai_data = $tanggal_selesai[2]."-".$tanggal_selesai[1]."-".$tanggal_selesai[0];
      $data = array(
        'id_mhsw' => $this->session->id,
        'tipe' => $this->input->post('tipe'),
        'riwayat' => $this->input->post('riwayat'),
        'lokasi' => $this->input->post('lokasi'),
        'status_kerja' => $this->input->post('status_kerja'),
        'tanggal_mulai' => $tanggal_mulai_data,
        'tanggal_selesai' => $tanggal_selesai_data,
      );
      
      if ($this->alumni_model->put($data, $id)) {
        $this->session->set_flashdata('success_update', TRUE);            
      } else {
        $this->session->set_flashdata('error_update', TRUE);
      }

      redirect('/alumni');
    }
  }

  public function delete()
	{
		$data = new stdClass();
		if ($this->alumni_model->delete($this->input->post('id'))) {
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