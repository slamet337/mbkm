<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran_inbound extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model("pendaftaran_model");
		$this->load->model("matakuliah_model");
		$this->load->model("logbook_model");
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
			'pendaftaran' => $this->pendaftaran_model->get_pendaftaran_inbound_prodi($this->session->kd_prodi)->result(),
		);
		$data['content'] = 'pendaftaran_inbound/index';
		$this->load->view('main/admin/index', $data);
	}

  public function nilai($id)
  {
		$pendaftaran = $this->pendaftaran_model->get_pendaftaran_adm_prodi_one_inbound($id)->row();
    $data['nilai'] = $this->pendaftaran_model->get_nilai_inbound($pendaftaran->id_mhsw, $pendaftaran->semester)->result();
		$data['content'] = 'pendaftaran_inbound/view_nilai';
		$this->load->view('main/admin/index', $data);
  }

  public function logbook($id_mhsw, $semester)
	{
		$data['data'] = array(
			'logbook' => $this->logbook_model->get_logbook_inbound_one($id_mhsw, $semester)->result(),
		);
		$data['content'] = 'pendaftaran_inbound/logbook_prodi';
		$this->load->view('main/admin/index', $data);
	}

	public function input_nilai($id_daftar)
	{
		$pendaftaran = $this->pendaftaran_model->get_pendaftaran_adm_prodi_one_inbound($id_daftar)->row();
		$data['data'] = array(
			'pendaftaran' => $pendaftaran,
			'matakuliah' => $this->pendaftaran_model->get_detail_jadwal($pendaftaran->id_mhsw, $pendaftaran->semester)->result(),
		);
		$data['content'] = 'pendaftaran_inbound/nilai_prodi';
		$this->load->view('main/admin/index', $data);

	}

  public function detail($id)
	{
		$pendaftaran = $this->pendaftaran_model->get_pendaftaran_adm_prodi_one_inbound($id)->row();
		$data['data'] = array(
			'pendaftaran' => $pendaftaran,
      'persyaratan' => $this->pendaftaran_model->get_persyaratan_adm_prodi_inbound($id)->result(),
      'dosen'       => $this->matakuliah_model->get_dosen()->result(),
			'jadwal'			=> $this->pendaftaran_model->get_detail_jadwal($pendaftaran->id_mhsw, $pendaftaran->semester)->result()
		);

		$data['content'] = 'pendaftaran_inbound/detail';
		$this->load->view('main/admin/index', $data);
	}

  public function update_nilai($id)
	{
		$id_pendaftaran = $this->input->post('id_pendaftaran');
		
		$nilai = $this->input->post('nilai');
		$grade = $this->input->post('grade');

		foreach ($id_pendaftaran as $key => $value) {
			$pendaftaran = $this->pendaftaran_model->get_pendaftaran_adm_prodi_one_inbound($value)->row();
			$data = array(
				'id_pendaftaran_inbound' => $value,
				'id_mhsw' => $pendaftaran->id_mhsw,
				'semester' => $pendaftaran->semester,
				'nilai' => $nilai[$key],
				'grade' => $grade[$key],
				'id_user' => $this->session->id,
			);
			
			$this->pendaftaran_model->post_nilai_inbound($data);
		}
		
		$data_kegiatan = array(
			'status_kegiatan' => 'Selesai',
		);

		$pendaftaran = $this->pendaftaran_model->get_pendaftaran_adm_prodi_one_inbound($id)->row();

		if ($this->pendaftaran_model->put_inbound($data_kegiatan, $pendaftaran->id_mhsw, $pendaftaran->semester, 'Diterima')) {
			$this->session->set_flashdata('success_save', TRUE);
		} else {
			$this->session->set_flashdata('error_save', TRUE);
		}

		redirect('/admin/pendaftaran_inbound');
	}

	public function update($id)
	{
		$this->form_validation->set_rules('status_pendaftaran', 'Verifikasi', 'required');
		
		$this->form_validation->set_message('required', '{field} harus terisi.');
		
		$pendaftaran = $this->pendaftaran_model->get_pendaftaran_adm_prodi_one_inbound($id)->row();
		if ($this->form_validation->run() === FALSE) {
			$data['data'] = array(
				'pendaftaran' => $pendaftaran,
				'persyaratan' => $this->pendaftaran_model->get_persyaratan_adm_prodi_inbound($id)->result(),
				'dosen'       => $this->matakuliah_model->get_dosen()->result(),
				'jadwal'			=> $this->pendaftaran_model->get_detail_jadwal($pendaftaran->id_mhsw, $pendaftaran->semester)->result()
			);
	
			$data['content'] = 'pendaftaran_inbound/detail';
			$this->load->view('main/admin/index', $data);
		} else {
      if($this->input->post('status_pendaftaran') == "Diterima") {
        $data = array(
          'id_dosen' => $this->input->post('id_dosen'),
          'status_pendaftaran' => $this->input->post('status_pendaftaran'),
          'status_kegiatan' => 'Aktif',
        );

				$jadwal = $this->pendaftaran_model->get_jadwal_mahasiswa_inbound($pendaftaran->id_mhsw, $pendaftaran->semester, 'On Process')->result();
				foreach ($jadwal as $show) {
					$kuota = $show->sisa_kuota - 1;
					$data_jadwal = array(
						'sisa_kuota' => $kuota,
					);
					$this->pendaftaran_model->put_kuota_jadwal_inbound($data_jadwal, $show->id);
				}
			} else {
        $data = array(
          'status_pendaftaran' => $this->input->post('status_pendaftaran'),
					'keterangan' => $this->input->post('keterangan'),
        );
      }
			
			if ($this->pendaftaran_model->put_inbound($data, $pendaftaran->id_mhsw, $pendaftaran->semester, 'On Process')) {
				$this->session->set_flashdata('success_update', TRUE);
			} else {
				$this->session->set_flashdata('error_update', TRUE);
			}

			redirect('/admin/pendaftaran_inbound');
		}
	}
}
?>