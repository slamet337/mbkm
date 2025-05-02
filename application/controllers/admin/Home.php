<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model("home_model");
	}

	public function index()
	{
		if ($this->session->level == "1") {
			$data['jml_mhsw'] = $this->home_model->get_mahasiswa($this->session->level)->num_rows();
			$data['jml_alumni'] = $this->home_model->get_alumni($this->session->level)->num_rows();
			$data['jml_dosen'] = $this->home_model->get_dosen($this->session->level)->num_rows();
			$data['jml_mitra'] = $this->home_model->get_mitra()->num_rows();
			$data['jml_mitra_aktif'] = $this->home_model->get_mitra_aktif()->num_rows();
			$data['jml_feb_diterima'] = $this->home_model->get_feb($this->session->level, 'Diterima', 'Aktif')->num_rows();
			$data['jml_feb_ditolak'] = $this->home_model->get_feb($this->session->level, 'Ditolak', '')->num_rows();
			$data['jml_feb_pending'] = $this->home_model->get_feb($this->session->level, 'On Process', 'Belum Aktif')->num_rows();
			$data['jml_feb_selesai'] = $this->home_model->get_feb($this->session->level, 'Diterima', 'Selesai')->num_rows();
			$data['jml_kementerian_null'] = $this->home_model->get_kementerian_null($this->session->level, 'Kementrian')->num_rows();
			$data['jml_kementerian_nilai'] = $this->home_model->get_kementerian_nilai($this->session->level, 'Kementrian')->num_rows();
			$data['jml_universitas_null'] = $this->home_model->get_kementerian_null($this->session->level, 'Universitas')->num_rows();
			$data['jml_universitas_nilai'] = $this->home_model->get_kementerian_nilai($this->session->level, 'Universitas')->num_rows();
		} else if ($this->session->level == "2") {
			$data['jml_mhsw'] = $this->home_model->get_mahasiswa($this->session->level, $this->session->kd_prodi)
			->num_rows();
			$data['jml_alumni'] = $this->home_model->get_alumni($this->session->level, $this->session->kd_prodi)->num_rows();
			$data['jml_dosen'] = $this->home_model->get_dosen($this->session->level, $this->session->kd_prodi)->num_rows();
			$data['jml_mitra'] = $this->home_model->get_mitra()->num_rows();
			$data['jml_mitra_aktif'] = $this->home_model->get_mitra_aktif()->num_rows();
			$data['jml_feb_diterima'] = $this->home_model->get_feb($this->session->level, 'Diterima', 'Aktif', $this->session->kd_prodi)->num_rows();
			$data['jml_feb_ditolak'] = $this->home_model->get_feb($this->session->level, 'Ditolak', '', $this->session->kd_prodi)->num_rows();
			$data['jml_feb_pending'] = $this->home_model->get_feb($this->session->level, 'On Process', 'Belum Aktif', $this->session->kd_prodi)->num_rows();
			$data['jml_feb_selesai'] = $this->home_model->get_feb($this->session->level, 'Diterima', 'Selesai', $this->session->kd_prodi)->num_rows();
			$data['jml_kementerian_null'] = $this->home_model->get_kementerian_null($this->session->level, 'Kementrian', $this->session->kd_prodi)->num_rows();
			$data['jml_kementerian_nilai'] = $this->home_model->get_kementerian_nilai($this->session->level, 'Kementrian', $this->session->kd_prodi)->num_rows();
			$data['jml_universitas_null'] = $this->home_model->get_kementerian_null($this->session->level, 'Universitas', $this->session->kd_prodi)->num_rows();
			$data['jml_universitas_nilai'] = $this->home_model->get_kementerian_nilai($this->session->level, 'Universitas', $this->session->kd_prodi)->num_rows();
		} else if ($this->session->level == "3") {
			$data['jml_mentor'] = $this->home_model->get_mentor($this->session->id_mitra, "Mentor")
			->num_rows();
			$data['jml_dpj'] = $this->home_model->get_mentor($this->session->id_mitra, "Dosen Penanggung Jawab")
			->num_rows();
			$data['jml_dp'] = $this->home_model->get_mentor($this->session->id_mitra, "Dosen Praktisi")
			->num_rows();
			$data['jml_kegiatan'] = $this->home_model->get_kegiatan($this->session->id_mitra)->num_rows();
			$data['jml_pendaftar'] = $this->home_model->get_pendaftar($this->session->id_mitra)->num_rows();
		}
		$data['content'] = 'home/index';
		$this->load->view('main/admin/index', $data);
	}
}
?>