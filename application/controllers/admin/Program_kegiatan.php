<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Program_kegiatan extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model("mbkm_model");
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
			'kegiatan' => $this->mbkm_model->get_kegiatan($this->session->id_mitra)->result(),
		);
		$data['content'] = 'program_kegiatan/index';
		$this->load->view('main/admin/index', $data);
	}

	public function add()
	{
		$data['mbkm'] = $this->mbkm_model->get_mbkm()->result();
		$data['mentor'] = $this->mbkm_model->get_mentor($this->session->id_mitra)->result();
		$data['content'] = 'program_kegiatan/add';
		$this->load->view('main/admin/index', $data);
	}

	public function post()
  {
		$this->form_validation->set_rules('id_program', 'Program MBKM', 'required');
		$this->form_validation->set_rules('nama_kegiatan', 'Nama Kegiatan MBKM', 'required');
		$this->form_validation->set_rules('waktu_mulai', 'Waktu Mulai', 'required');
		$this->form_validation->set_rules('waktu_selesai', 'Waktu Selesai', 'required');
    
		$this->form_validation->set_message('required', '{field} harus terisi.');
		
		if ($this->form_validation->run() === FALSE)
		{
      $data['mbkm'] = $this->mbkm_model->get_mbkm()->result();
      $data['content'] = 'program_kegiatan/add';
      $this->load->view('main/admin/index', $data);
		}
		else
		{
			if ($this->input->post('id_program')=="1") {
				$tanggal = explode("/",$this->input->post('waktu_mulai'));
				$tanggal_mulai = $tanggal[2]."-".$tanggal[1]."-".$tanggal[0];
				$tanggal1 = explode("/",$this->input->post('waktu_selesai'));
				$tanggal_selesai = $tanggal1[2]."-".$tanggal1[1]."-".$tanggal1[0];
				$data = array(
					'id_program' => $this->input->post('id_program'),
					'nama_kegiatan' => $this->input->post('nama_kegiatan'),
					'waktu_mulai' => $tanggal_mulai,
					'waktu_selesai' => $tanggal_selesai,
					'id_mitra' => $this->session->id_mitra,
				);

				$this->db->trans_start();
				$id_kegiatan = $this->mbkm_model->post_kegiatan($data);

				$kd_mk = $this->input->post('kode_mk');
				$matakuliah = $this->input->post('matakuliah');
				$sks = $this->input->post('sks');
				$id_mentor = $this->input->post('id_mentor');

				foreach ($kd_mk as $key => $value) {
					$data_mk = array(
						'id_program_kegiatan' => $id_kegiatan,
						'id_mitra' => $this->session->id_mitra,
						'kd_mk' => $value,
						'matakuliah' => $matakuliah[$key],
						'kuota' => $this->input->post('kuota')[$key],
						'sisa_kuota' => $this->input->post('kuota')[$key],
						'description' => $this->input->post('description')[$key],
						'sks' => $sks[$key],
						'id_mentor' => $id_mentor[$key],
					);

					$this->mbkm_model->post_mk_pertukaran($data_mk);
				}

				$this->db->trans_complete();

				if ($this->db->trans_status() === TRUE) {
					$this->session->set_flashdata('success_save', TRUE);
				} else {
					$this->session->set_flashdata('error_save', TRUE);
				}
	
				redirect('/admin/program_kegiatan');
			} else {
				$tanggal = explode("/",$this->input->post('waktu_mulai'));
				$tanggal_mulai = $tanggal[2]."-".$tanggal[1]."-".$tanggal[0];
				$tanggal1 = explode("/",$this->input->post('waktu_selesai'));
				$tanggal_selesai = $tanggal1[2]."-".$tanggal1[1]."-".$tanggal1[0];
				$data = array(
					'id_program' => $this->input->post('id_program'),
					'nama_kegiatan' => $this->input->post('nama_kegiatan'),
					'kuota' => $this->input->post('kuota'),
					'sisa_kuota' => $this->input->post('kuota'),
					'waktu_mulai' => $tanggal_mulai,
					'waktu_selesai' => $tanggal_selesai,
					'id_mitra' => $this->session->id_mitra,
					'job_desc' => $this->input->post('job_desc'),
				);
				
				if ($this->mbkm_model->post_kegiatan($data)) {
					$this->session->set_flashdata('success_save', TRUE);
				} else {
					$this->session->set_flashdata('error_save', TRUE);
				}
	
				redirect('/admin/program_kegiatan');
			}
		}
  }

	public function edit($id)
	{
    $kegiatan_one = $this->mbkm_model->get_kegiatan_one($id)->row();
    $tanggal_mulai = explode("-",$kegiatan_one->waktu_mulai);
    $tgl_mulai = $tanggal_mulai[2]."/".$tanggal_mulai[1]."/".$tanggal_mulai[0];
    $tanggal_selesai = explode("-",$kegiatan_one->waktu_selesai);
    $tgl_selesai = $tanggal_selesai[2]."/".$tanggal_selesai[1]."/".$tanggal_selesai[0];
		$data['data'] = array(
			'kegiatan' => $kegiatan_one,
			'tgl_mulai' => $tgl_mulai,
			'tgl_selesai' => $tgl_selesai,
		);
		$data['mentor'] = $this->mbkm_model->get_mentor($this->session->id_mitra)->result();
		$data['matakuliah_pertukaran'] = $this->mbkm_model->get_mk_pertukaran($id)->result();
		$data['mbkm'] = $this->mbkm_model->get_mbkm()->result();
		$data['content'] = 'program_kegiatan/edit';
		$this->load->view('main/admin/index', $data);
	}

	public function update($id)
	{
		$this->form_validation->set_rules('id_program', 'Program MBKM', 'required');
		$this->form_validation->set_rules('nama_kegiatan', 'Nama Kegiatan MBKM', 'required');
		$this->form_validation->set_rules('waktu_mulai', 'Waktu Mulai', 'required');
		$this->form_validation->set_rules('waktu_selesai', 'Waktu Selesai', 'required');
		
		$this->form_validation->set_message('required', '{field} harus terisi.');
		
		if ($this->form_validation->run() === FALSE) {
      $kegiatan_one = $this->mbkm_model->get_kegiatan_one($id)->row();
      $tanggal_mulai = explode("-",$kegiatan_one->waktu_mulai);
      $tgl_mulai = $tanggal_mulai[2]."/".$tanggal_mulai[1]."/".$tanggal_mulai[0];
      $tanggal_selesai = explode("-",$kegiatan_one->waktu_selesai);
      $tgl_selesai = $tanggal_selesai[2]."/".$tanggal_selesai[1]."/".$tanggal_selesai[0];
      $data['data'] = array(
        'kegiatan' => $kegiatan_one,
        'tgl_mulai' => $tgl_mulai,
        'tgl_selesai' => $tgl_selesai,
      );
      $data['mbkm'] = $this->mbkm_model->get_mbkm()->result();
      $data['content'] = 'program_kegiatan/edit';
      $this->load->view('main/admin/index', $data);
		} else {
			$tanggal = explode("/",$this->input->post('waktu_mulai'));
      $tanggal_mulai = $tanggal[2]."-".$tanggal[1]."-".$tanggal[0];
      $tanggal1 = explode("/",$this->input->post('waktu_selesai'));
      $tanggal_selesai = $tanggal1[2]."-".$tanggal1[1]."-".$tanggal1[0];
		
			if($this->input->post('id_program') == 1) {
				$data = array(
					'id_program' => $this->input->post('id_program'),
					'nama_kegiatan' => $this->input->post('nama_kegiatan'),
					'waktu_mulai' => $tanggal_mulai,
					'waktu_selesai' => $tanggal_selesai,
					'id_mitra' => $this->session->id_mitra,
				);
				
				if ($this->mbkm_model->put_kegiatan($data, $id)) {
					$mk_pertukaran = $this->mbkm_model->get_mk_pertukaran($id)->result();

					foreach ($mk_pertukaran as $show) {
						$data_matakuliah = array(
							'id_program_kegiatan' => $id,
							'kd_mk' => $this->input->post('kode_mk_'.$show->id),
							'matakuliah' => $this->input->post('matakuliah_'.$show->id),
							'sks' => $this->input->post('sks_'.$show->id),
							'id_mentor' => $this->input->post('id_mentor_'.$show->id),
							'kuota' => $this->input->post('kuota_'.$show->id),
							'description' => $this->input->post('description_'.$show->id),
						);
						
						$this->mbkm_model->put_matakuliah_tukar($data_matakuliah, $show->id);
					}

					$this->session->set_flashdata('success_update', TRUE);
				} else {
					$this->session->set_flashdata('error_update', TRUE);
				}
			} else {
				$data = array(
					'id_program' => $this->input->post('id_program'),
					'nama_kegiatan' => $this->input->post('nama_kegiatan'),
					'kuota' => $this->input->post('kuota'),
					'sisa_kuota' => $this->input->post('kuota'),
					'waktu_mulai' => $tanggal_mulai,
					'waktu_selesai' => $tanggal_selesai,
					'id_mitra' => $this->session->id_mitra,
					'job_desc' => $this->input->post('job_desc'),
				);
				
				if ($this->mbkm_model->put_kegiatan($data, $id)) {
					$this->session->set_flashdata('success_update', TRUE);
				} else {
					$this->session->set_flashdata('error_update', TRUE);
				}
			}

			redirect('/admin/program_kegiatan');
		}
	}

	public function delete()
	{
		$data = new stdClass();
		if ($this->mbkm_model->delete_kegiatan($this->input->post('id'))) {
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