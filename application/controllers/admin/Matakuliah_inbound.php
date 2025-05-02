<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Matakuliah_inbound extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model("matakuliah_inbound_model");
    date_default_timezone_set("Asia/Makassar");
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

	public function index()
	{
		$data['data'] = array(
			'jadwal' => $this->matakuliah_inbound_model->get_jadwal($this->session->kd_prodi)->result(),
		);
		$data['content'] = 'matakuliah_inbound/index';
		$this->load->view('main/admin/index', $data);
	}

	public function add()
	{
		$data['matakuliah'] = $this->matakuliah_inbound_model->get_matakuliah()->result();
		$data['content'] = 'matakuliah_inbound/add';
		$this->load->view('main/admin/index', $data);
	}

	public function post()
  {
		$this->form_validation->set_rules('kd_mk', 'Matakuliah', 'required');
		$this->form_validation->set_rules('status', 'Jenis Kegiatan', 'required');
		$this->form_validation->set_rules('waktu_mulai', 'Tanggal Mulai Pendaftaran', 'required');
		$this->form_validation->set_rules('waktu_selesai', 'Tanggal Tutup Pendaftaran', 'required');
		$this->form_validation->set_rules('kuota', 'Kuota', 'required');
		$this->form_validation->set_rules('kelas', 'Kelas', 'required');
		$this->form_validation->set_rules('hari', 'Hari', 'required');
		$this->form_validation->set_rules('jam_mulai', 'Jam Mulai', 'required');
		$this->form_validation->set_rules('jam_selesai', 'Jam Selesai', 'required');
    
		$this->form_validation->set_message('required', '{field} harus terisi.');
		
		if ($this->form_validation->run() === FALSE)
		{
      $data['mbkm'] = $this->matakuliah_inbound_model->get_mbkm()->result();
      $data['content'] = 'matakuliah_inbound/add';
      $this->load->view('main/admin/index', $data);
		}
		else
		{
			$tanggal = explode("/",$this->input->post('waktu_mulai'));
			$tanggal_mulai = $tanggal[2]."-".$tanggal[1]."-".$tanggal[0];
			$tanggal1 = explode("/",$this->input->post('waktu_selesai'));
			$tanggal_selesai = $tanggal1[2]."-".$tanggal1[1]."-".$tanggal1[0];
			$data = array(
				'kd_mk' => $this->input->post('kd_mk'),
				'status' => $this->input->post('status'),
				'waktu_mulai' => $tanggal_mulai,
				'waktu_selesai' => $tanggal_selesai,
				'kuota' => $this->input->post('kuota'),
				'sisa_kuota' => $this->input->post('kuota'),
				'kelas' => $this->input->post('kelas'),
				'hari' => $this->input->post('hari'),
				'jam_mulai' => $this->input->post('jam_mulai'),
				'jam_selesai' => $this->input->post('jam_selesai'),
				'kd_prodi' => $this->session->kd_prodi,
				'description' => $this->input->post('description'),
			);
			
			if ($this->matakuliah_inbound_model->post($data)) {
				$this->session->set_flashdata('success_save', TRUE);
			} else {
				$this->session->set_flashdata('error_save', TRUE);
			}

			redirect('/admin/matakuliah_inbound');
		}
  }

	public function edit($id)
	{
    $jadwal_one = $this->matakuliah_inbound_model->get_jadwal_one($id)->row();
    $tanggal_mulai = explode("-",$jadwal_one->waktu_mulai);
    $tgl_mulai = $tanggal_mulai[2]."/".$tanggal_mulai[1]."/".$tanggal_mulai[0];
    $tanggal_selesai = explode("-",$jadwal_one->waktu_selesai);
    $tgl_selesai = $tanggal_selesai[2]."/".$tanggal_selesai[1]."/".$tanggal_selesai[0];
		$data['data'] = array(
			'jadwal' => $jadwal_one,
			'tgl_mulai' => $tgl_mulai,
			'tgl_selesai' => $tgl_selesai,
		);
		$data['matakuliah'] = $this->matakuliah_inbound_model->get_matakuliah()->result();
		$data['content'] = 'matakuliah_inbound/edit';
		$this->load->view('main/admin/index', $data);
	}

	public function update($id)
	{
		$this->form_validation->set_rules('kd_mk', 'Matakuliah', 'required');
		$this->form_validation->set_rules('status', 'Jenis Kegiatan', 'required');
		$this->form_validation->set_rules('waktu_mulai', 'Tanggal Mulai Pendaftaran', 'required');
		$this->form_validation->set_rules('waktu_selesai', 'Tanggal Tutup Pendaftaran', 'required');
		$this->form_validation->set_rules('kuota', 'Kuota', 'required');
		$this->form_validation->set_rules('kelas', 'Kelas', 'required');
		$this->form_validation->set_rules('hari', 'Hari', 'required');
		$this->form_validation->set_rules('jam_mulai', 'Jam Mulai', 'required');
		$this->form_validation->set_rules('jam_selesai', 'Jam Selesai', 'required');
		
		$this->form_validation->set_message('required', '{field} harus terisi.');
		
		if ($this->form_validation->run() === FALSE) {
      $jadwal_one = $this->matakuliah_inbound_model->get_jadwal_one($id)->row();
			$tanggal_mulai = explode("-",$jadwal_one->waktu_mulai);
			$tgl_mulai = $tanggal_mulai[2]."/".$tanggal_mulai[1]."/".$tanggal_mulai[0];
			$tanggal_selesai = explode("-",$jadwal_one->waktu_selesai);
			$tgl_selesai = $tanggal_selesai[2]."/".$tanggal_selesai[1]."/".$tanggal_selesai[0];
			$data['data'] = array(
				'jadwal' => $jadwal_one,
				'tgl_mulai' => $tgl_mulai,
				'tgl_selesai' => $tgl_selesai,
			);
			$data['matakuliah'] = $this->matakuliah_inbound_model->get_matakuliah()->result();
			$data['content'] = 'matakuliah_inbound/edit';
			$this->load->view('main/admin/index', $data);
		} else {
			$tanggal = explode("/",$this->input->post('waktu_mulai'));
      $tanggal_mulai = $tanggal[2]."-".$tanggal[1]."-".$tanggal[0];
      $tanggal1 = explode("/",$this->input->post('waktu_selesai'));
      $tanggal_selesai = $tanggal1[2]."-".$tanggal1[1]."-".$tanggal1[0];
		
			$data = array(
				'kd_mk' => $this->input->post('kd_mk'),
				'status' => $this->input->post('status'),
				'waktu_mulai' => $tanggal_mulai,
				'waktu_selesai' => $tanggal_selesai,
				'kuota' => $this->input->post('kuota'),
				'sisa_kuota' => $this->input->post('kuota'),
				'kelas' => $this->input->post('kelas'),
				'hari' => $this->input->post('hari'),
				'jam_mulai' => $this->input->post('jam_mulai'),
				'jam_selesai' => $this->input->post('jam_selesai'),
				'kd_prodi' => $this->session->kd_prodi,
				'description' => $this->input->post('description'),
			);
			
			if ($this->matakuliah_inbound_model->put($data, $id)) {
				$this->session->set_flashdata('success_update', TRUE);
			} else {
				$this->session->set_flashdata('error_update', TRUE);
			}

			redirect('/admin/matakuliah_inbound');
		}
	}

	public function delete()
	{
		$data = new stdClass();
		if ($this->matakuliah_inbound_model->delete($this->input->post('id'))) {
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