<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran extends CI_Controller {
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
			'pendaftaran' => $this->pendaftaran_model->get_pendaftaran_adm_prodi($this->session->kd_prodi)->result(),
		);
		$data['content'] = 'pendaftaran/index';
		$this->load->view('main/admin/index', $data);
	}

  public function nilai($id)
  {
    $data['nilai'] = $this->pendaftaran_model->get_nilai($id)->result();
		$data['content'] = 'pendaftaran/view_nilai';
		$this->load->view('main/admin/index', $data);
  }

  public function logbook($id)
	{
		$data['data'] = array(
			'logbook' => $this->logbook_model->get_logbook_dosen($id)->result(),
		);
		$data['content'] = 'pendaftaran/logbook_prodi';
		$this->load->view('main/admin/index', $data);
	}

	public function input_nilai($id_daftar, $id_kegiatan)
	{
		$data['data'] = array(
			'pendaftaran' => $this->pendaftaran_model->get_pendaftaran_adm_prodi_one($id_daftar)->row(),
			'matakuliah' => $this->pendaftaran_model->get_matakuliah_dosen($id_daftar)->result(),
		);
		$data['content'] = 'pendaftaran/nilai_prodi';
		$this->load->view('main/admin/index', $data);

	}

  public function detail($id, $id_program)
	{
		$data['data'] = array(
			'pendaftaran' => $this->pendaftaran_model->get_pendaftaran_adm_prodi_one($id)->row(),
      'persyaratan' => $this->pendaftaran_model->get_persyaratan_adm_prodi($id)->result(),
      'dosen'       => $this->matakuliah_model->get_dosen()->result(),
			'id_program' 	=> $id_program
		);
		if($id_program == 1) {
			$data['matakuliah'] = $this->pendaftaran_model->get_detail_matakuliah_konversi($id)->result();
		} else {
			$data['matakuliah'] = $this->pendaftaran_model->get_detail_matakuliah_konversi_kegiatan_lain($id)->result();
		}

		$data['content'] = 'pendaftaran/detail';
		$this->load->view('main/admin/index', $data);
	}

  public function update_nilai($id)
	{
		$id_mk = $this->input->post('id_mk');
		$nilai = $this->input->post('nilai');
		$grade = $this->input->post('grade');

		foreach ($id_mk as $key => $value) {
			$data = array(
				'id_pendaftaran' => $id,
				'id_matakuliah' => $value,
				'nilai' => $nilai[$key],
				'grade' => $grade[$key],
				'id_user' => $this->session->id,
			);
			
			$this->pendaftaran_model->post_nilai($data);
		}
		
		$data_kegiatan = array(
			'status_kegiatan' => 'Selesai',
		);

		if ($this->pendaftaran_model->put($data_kegiatan, $id)) {
			$this->session->set_flashdata('success_save', TRUE);
		} else {
			$this->session->set_flashdata('error_save', TRUE);
		}

		redirect('/admin/pendaftaran');
	}

	public function update($id, $id_program)
	{
		$this->form_validation->set_rules('status_pendaftaran', 'Verifikasi', 'required');
		
		$this->form_validation->set_message('required', '{field} harus terisi.');
		
		if ($this->form_validation->run() === FALSE) {
      $data['data'] = array(
        'pendaftaran' => $this->pendaftaran_model->get_pendaftaran_adm_prodi_one($id)->row(),
        'persyaratan' => $this->pendaftaran_model->get_persyaratan_adm_prodi($id)->result(),
        'dosen'       => $this->matakuliah_model->get_dosen()->result(),
				'id_program' 	=> $id_program
			);
			if($id_program == 1) {
				$data['matakuliah'] = $this->pendaftaran_model->get_detail_matakuliah_konversi($id)->result();
			} else {
				$data['matakuliah'] = $this->pendaftaran_model->get_detail_matakuliah_konversi_kegiatan_lain($id)->result();
			}

      $data['content'] = 'pendaftaran/detail';
      $this->load->view('main/admin/index', $data);
		} else {
      if($this->input->post('status_pendaftaran') == "Diterima") {
				$temp_mk_daftar = $this->pendaftaran_model->get_detail_matakuliah_konversi_kegiatan_lain($id)->result();

				foreach ($temp_mk_daftar as $show) {
					$data_mk_konversi = array(
						'id_pendaftaran' => $id,
						'kd_mk' => $show->kd_mk,
					);

					$this->pendaftaran_model->post_konversi_mk($data_mk_konversi);
				}

        $data = array(
          'id_dosen' => $this->input->post('id_dosen'),
          'status_pendaftaran' => $this->input->post('status_pendaftaran'),
          'status_kegiatan' => 'Aktif',
        );

        $data_ditolak = array(
          'status_pendaftaran' => 'Ditolak',
        );
        $prodi_one = $this->pendaftaran_model->get_pendaftaran_adm_prodi_one($id)->row();
        $this->pendaftaran_model->put_ditolak($id, $prodi_one->id_mhsw);

				if($id_program == 1) {
					$id_kegiatan = $prodi_one->id_kegiatan;
					$mk_pertukaran = $this->pendaftaran_model->get_matakuliah_pertukaran($id_kegiatan)->result();
					foreach ($mk_pertukaran as $show) {
						$kuota = $show->sisa_kuota - 1;
						$data_kegiatan = array(
							'sisa_kuota' => $kuota,
						);
						$this->pendaftaran_model->put_kuota_kegiatan_pertukaran($data_kegiatan, $show->id);
					}
				} else {
					$id_kegiatan = $prodi_one->id_kegiatan;
					$program_kegiatan = $this->pendaftaran_model->get_kegiatan_one($id_kegiatan)->row();
					$kuota = $program_kegiatan->sisa_kuota - 1;
					$data_kegiatan = array(
						'sisa_kuota' => $kuota,
					);
	
					$this->pendaftaran_model->put_kuota_kegiatan($data_kegiatan, $id_kegiatan);
				}
      } else {
        $data = array(
          'status_pendaftaran' => $this->input->post('status_pendaftaran'),
					'keterangan' => $this->input->post('keterangan'),
        );
      }
			
			if ($this->pendaftaran_model->put($data, $id)) {
				$this->session->set_flashdata('success_update', TRUE);
			} else {
				$this->session->set_flashdata('error_update', TRUE);
			}

			redirect('/admin/pendaftaran');
		}
	}
}
?>