<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  use Dompdf\Dompdf;

  class Profil extends CI_Controller {
    function __construct(){
      parent::__construct();
      $this->load->model("profil_model");
      date_default_timezone_set("Asia/Makassar");
    }

    public function index()
    {
      $data['profil'] = $this->profil_model->get_profil_one($this->session->id_mhsw)->row();
      $data['prodi'] = $this->profil_model->get_prodi_all()->result();
      $data['content'] = 'menu/profil/index';
      $data['tab'] = 'biodata';
      $data['pendidikan'] = $this->profil_model->get_pendidikan($this->session->id_mhsw)->result();
      $data['pekerjaan'] = $this->profil_model->get_pekerjaan($this->session->id_mhsw)->result();
      $data['jabatan'] = $this->profil_model->get_jabatan($this->session->id_mhsw)->result();
      $data['wirausaha'] = $this->profil_model->get_wirausaha($this->session->id_mhsw)->result();
      $data['seminar'] = $this->profil_model->get_seminar($this->session->id_mhsw)->result();
      $data['prestasi'] = $this->profil_model->get_prestasi($this->session->id_mhsw)->result();
      $data['karya_ilmiah'] = $this->profil_model->get_karya_ilmiah($this->session->id_mhsw)->result();
      $data['organisasi'] = $this->profil_model->get_organisasi($this->session->id_mhsw)->result();
      $data['mbkm'] = $this->profil_model->get_mbkm($this->session->id_mhsw)->result();
      $data['mbkm_luar'] = $this->profil_model->get_mbkm_luar($this->session->id_mhsw)->result();
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

    public function update($id)
    {
      $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
      $this->form_validation->set_rules('nik', 'Nomor Induk Kependudukan', 'required');
      $this->form_validation->set_rules('nim', 'Nomor Stambuk', 'required');
      $this->form_validation->set_rules('no_hp', 'Nomor HP', 'required');
      $this->form_validation->set_rules('alamat', 'Alamat', 'required');
      $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required');
      $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
      $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
      $this->form_validation->set_rules('agama', 'Agama', 'required');
      $this->form_validation->set_rules('status_pernikahan', 'Status Pernikahan', 'required');
      $this->form_validation->set_rules('gol_darah', 'Golongan Darah', 'required');
      
      $this->form_validation->set_message('required', '{field} harus terisi.');

      if ($this->form_validation->run() === FALSE) {
        $data['profil'] = $this->profil_model->get_profil_one($this->session->id_mhsw)->row();
        $data['prodi'] = $this->profil_model->get_prodi_all()->result();
        $data['content'] = 'menu/profil/index';
        $data['tab'] = 'biodata';
        $data['pendidikan'] = $this->profil_model->get_pendidikan($this->session->id_mhsw)->result();
        $data['pekerjaan'] = $this->profil_model->get_pekerjaan($this->session->id_mhsw)->result();
        $data['jabatan'] = $this->profil_model->get_jabatan($this->session->id_mhsw)->result();
        $data['wirausaha'] = $this->profil_model->get_wirausaha($this->session->id_mhsw)->result();
        $data['seminar'] = $this->profil_model->get_seminar($this->session->id_mhsw)->result();
        $data['prestasi'] = $this->profil_model->get_prestasi($this->session->id_mhsw)->result();
        $data['karya_ilmiah'] = $this->profil_model->get_karya_ilmiah($this->session->id_mhsw)->result();
        $data['organisasi'] = $this->profil_model->get_organisasi($this->session->id_mhsw)->result();
        $data['mbkm'] = $this->profil_model->get_mbkm($this->session->id_mhsw)->result();
        $data['mbkm_luar'] = $this->profil_model->get_mbkm_luar($this->session->id_mhsw)->result();
        $this->load->view('main/users/index_menu', $data);
      } else {
        $tanggal_lahir = explode("/",$this->input->post('tanggal_lahir'));
        $tanggal_lahir_data = $tanggal_lahir[2]."-".$tanggal_lahir[1]."-".$tanggal_lahir[0];

        $data = array(
          'nama' => $this->input->post('nama'),
          'nik' => $this->input->post('nik'),
          'nim' => $this->input->post('nim'),
          'no_hp' => $this->input->post('no_hp'),
          'alamat' => $this->input->post('alamat'),
          'tempat_lahir' => $this->input->post('tempat_lahir'),
          'tanggal_lahir' => $tanggal_lahir_data,
          'jenis_kelamin' => $this->input->post('jenis_kelamin'),
          'agama' => $this->input->post('agama'),
          'status_pernikahan' => $this->input->post('status_pernikahan'),
          'gol_darah' => $this->input->post('gol_darah'),
          //tambahan///
          // 'peringkat' => $this->input->post('peringkat'),
          // 'jml_negara' => $this->input->post('jml_negara'),
          // 'jml_pt' => $this->input->post('jml_pt'),
          // 'jenis_peserta' => $this->input->post('jenis_peserta'),
          // 'nomor_sertifikat' => $this->input->post('nomor_sertifikat'),
          // 'm_pelakasana' => $this->input->post('m_pelakasana'),
          // 'nomor_sk' => $this->input->post('nomor_sk'),
          // 'tanggal_mulai' => $this->input->post('tanggal_mulai'),
          // 'tanggal_selesai' => $this->input->post('tanggal_selesai'),
          //tinggal upload gambar
        );
        
        if ($this->profil_model->put($data, $id)) {
          $this->session->set_flashdata('success_update', TRUE);
        } else {
          $this->session->set_flashdata('error_update', TRUE);
        }
  
        redirect('/profil');
      }
    }

    public function post_pendidikan($id)
    {
      $this->form_validation->set_rules('jenjang', 'Jenjang', 'required');
      $this->form_validation->set_rules('nama_sekolah', 'Nama Universitas', 'required');
      $this->form_validation->set_rules('fakultas', 'Fakultas', 'required');
      $this->form_validation->set_rules('jurusan', 'Jurusan', 'required');
      $this->form_validation->set_rules('prodi', 'Prodi', 'required');
      $this->form_validation->set_rules('dosen_pembimbing', 'Dosen Pembimbing', 'required');
      $this->form_validation->set_rules('tanggal_masuk', 'Tanggal Masuk', 'required');
      
      $this->form_validation->set_message('required', '{field} harus terisi.');

      if ($this->form_validation->run() === FALSE) {
        $data['profil'] = $this->profil_model->get_profil_one($this->session->id_mhsw)->row();
        $data['prodi'] = $this->profil_model->get_prodi_all()->result();
        $data['content'] = 'menu/profil/index';
        $data['tab'] = 'pendidikan';
        $data['pendidikan'] = $this->profil_model->get_pendidikan($this->session->id_mhsw)->result();
        $data['pekerjaan'] = $this->profil_model->get_pekerjaan($this->session->id_mhsw)->result();
        $data['jabatan'] = $this->profil_model->get_jabatan($this->session->id_mhsw)->result();
        $data['wirausaha'] = $this->profil_model->get_wirausaha($this->session->id_mhsw)->result();
        $data['seminar'] = $this->profil_model->get_seminar($this->session->id_mhsw)->result();
        $data['prestasi'] = $this->profil_model->get_prestasi($this->session->id_mhsw)->result();
        $data['karya_ilmiah'] = $this->profil_model->get_karya_ilmiah($this->session->id_mhsw)->result();
        $data['organisasi'] = $this->profil_model->get_organisasi($this->session->id_mhsw)->result();
        $data['mbkm'] = $this->profil_model->get_mbkm($this->session->id_mhsw)->result();
        $data['mbkm_luar'] = $this->profil_model->get_mbkm_luar($this->session->id_mhsw)->result();
        $data['show_modal'] = true;
        $this->load->view('main/users/index_menu', $data);
      } else {
        $tanggal_masuk = explode("/",$this->input->post('tanggal_masuk'));
        $tanggal_masuk_data = $tanggal_masuk[2]."-".$tanggal_masuk[1]."-".$tanggal_masuk[0];
        $tanggal_yudisium = explode("/",$this->input->post('tanggal_yudisium'));
        $tanggal_yudisium_data = $tanggal_yudisium[2]."-".$tanggal_yudisium[1]."-".$tanggal_yudisium[0];

        $data_pendidikan = array(
          'jenjang' => $this->input->post('jenjang'),
          'nama_sekolah' => $this->input->post('nama_sekolah'),
          'fakultas' => $this->input->post('fakultas'),
          'jurusan' => $this->input->post('jurusan'),
          'prodi' => $this->input->post('prodi'),
          'dosen_pembimbing' => $this->input->post('dosen_pembimbing'),
          'tanggal_masuk' => $tanggal_masuk_data,
          'tanggal_yudisium' => $tanggal_yudisium_data,
          'konsentrasi' => $this->input->post('konsentrasi'),
          'tugas_akhir' => $this->input->post('tugas_akhir'),
          'ipk' => $this->input->post('ipk'),
          'gelar' => $this->input->post('gelar'),
          'id_mhsw' => $id
        );
        
        if ($this->profil_model->post_pendidikan($data_pendidikan)) {
          $this->session->set_flashdata('success_save', TRUE);
        } else {
          $this->session->set_flashdata('error_save', TRUE);
        }
  
        $data['profil'] = $this->profil_model->get_profil_one($this->session->id_mhsw)->row();
        $data['prodi'] = $this->profil_model->get_prodi_all()->result();
        $data['content'] = 'menu/profil/index';
        $data['tab'] = 'pendidikan';
        $data['pendidikan'] = $this->profil_model->get_pendidikan($this->session->id_mhsw)->result();
        $data['pekerjaan'] = $this->profil_model->get_pekerjaan($this->session->id_mhsw)->result();
        $data['jabatan'] = $this->profil_model->get_jabatan($this->session->id_mhsw)->result();
        $data['wirausaha'] = $this->profil_model->get_wirausaha($this->session->id_mhsw)->result();
        $data['seminar'] = $this->profil_model->get_seminar($this->session->id_mhsw)->result();
        $data['prestasi'] = $this->profil_model->get_prestasi($this->session->id_mhsw)->result();
        $data['karya_ilmiah'] = $this->profil_model->get_karya_ilmiah($this->session->id_mhsw)->result();
        $data['organisasi'] = $this->profil_model->get_organisasi($this->session->id_mhsw)->result();
        $data['mbkm'] = $this->profil_model->get_mbkm($this->session->id_mhsw)->result();
        $data['mbkm_luar'] = $this->profil_model->get_mbkm_luar($this->session->id_mhsw)->result();
        $this->load->view('main/users/index_menu', $data);
      }
    }

    public function put_pendidikan($id)
    {
      $this->form_validation->set_rules('jenjang', 'Jenjang', 'required');
      $this->form_validation->set_rules('nama_sekolah', 'Nama Universitas', 'required');
      $this->form_validation->set_rules('fakultas', 'Fakultas', 'required');
      $this->form_validation->set_rules('jurusan', 'Jurusan', 'required');
      $this->form_validation->set_rules('prodi', 'Prodi', 'required');
      $this->form_validation->set_rules('dosen_pembimbing', 'Dosen Pembimbing', 'required');
      $this->form_validation->set_rules('tanggal_masuk', 'Tanggal Masuk', 'required');
      $this->form_validation->set_rules('tanggal_yudisium', 'Tanggal Yudisium', 'required');
      $this->form_validation->set_rules('konsentrasi', 'Konsentrasi', 'required');
      $this->form_validation->set_rules('tugas_akhir', 'Tugas Akhir', 'required');
      $this->form_validation->set_rules('ipk', 'IPK', 'required');
      $this->form_validation->set_rules('gelar', 'Gelar', 'required');
      
      $this->form_validation->set_message('required', '{field} harus terisi.');

      if ($this->form_validation->run() === FALSE) {
        $data['profil'] = $this->profil_model->get_profil_one($this->session->id_mhsw)->row();
        $data['prodi'] = $this->profil_model->get_prodi_all()->result();
        $data['content'] = 'menu/profil/index';
        $data['tab'] = 'pendidikan';
        $data['show_modal_update'] = $id;
        $data['pendidikan'] = $this->profil_model->get_pendidikan($this->session->id_mhsw)->result();
        $data['pekerjaan'] = $this->profil_model->get_pekerjaan($this->session->id_mhsw)->result();
        $data['jabatan'] = $this->profil_model->get_jabatan($this->session->id_mhsw)->result();
        $data['wirausaha'] = $this->profil_model->get_wirausaha($this->session->id_mhsw)->result();
        $data['seminar'] = $this->profil_model->get_seminar($this->session->id_mhsw)->result();
        $data['prestasi'] = $this->profil_model->get_prestasi($this->session->id_mhsw)->result();
        $data['karya_ilmiah'] = $this->profil_model->get_karya_ilmiah($this->session->id_mhsw)->result();
        $data['organisasi'] = $this->profil_model->get_organisasi($this->session->id_mhsw)->result();
        $data['mbkm'] = $this->profil_model->get_mbkm($this->session->id_mhsw)->result();
        $data['mbkm_luar'] = $this->profil_model->get_mbkm_luar($this->session->id_mhsw)->result();
        $this->load->view('main/users/index_menu', $data);
      } else {
        $tanggal_masuk = explode("/",$this->input->post('tanggal_masuk'));
        $tanggal_masuk_data = $tanggal_masuk[2]."-".$tanggal_masuk[1]."-".$tanggal_masuk[0];
        $tanggal_yudisium = explode("/",$this->input->post('tanggal_yudisium'));
        $tanggal_yudisium_data = $tanggal_yudisium[2]."-".$tanggal_yudisium[1]."-".$tanggal_yudisium[0];

        $data_pendidikan = array(
          'jenjang' => $this->input->post('jenjang'),
          'nama_sekolah' => $this->input->post('nama_sekolah'),
          'fakultas' => $this->input->post('fakultas'),
          'jurusan' => $this->input->post('jurusan'),
          'prodi' => $this->input->post('prodi'),
          'dosen_pembimbing' => $this->input->post('dosen_pembimbing'),
          'tanggal_masuk' => $tanggal_masuk_data,
          'tanggal_yudisium' => $tanggal_yudisium_data,
          'konsentrasi' => $this->input->post('konsentrasi'),
          'tugas_akhir' => $this->input->post('tugas_akhir'),
          'ipk' => $this->input->post('ipk'),
          'gelar' => $this->input->post('gelar'),
        );
        
        if ($this->profil_model->put_pendidikan($data_pendidikan, $id)) {
          $this->session->set_flashdata('success_update', TRUE);
        } else {
          $this->session->set_flashdata('error_update', TRUE);
        }
  
        $data['profil'] = $this->profil_model->get_profil_one($this->session->id_mhsw)->row();
        $data['prodi'] = $this->profil_model->get_prodi_all()->result();
        $data['content'] = 'menu/profil/index';
        $data['tab'] = 'pendidikan';
        $data['pendidikan'] = $this->profil_model->get_pendidikan($this->session->id_mhsw)->result();
        $data['pekerjaan'] = $this->profil_model->get_pekerjaan($this->session->id_mhsw)->result();
        $data['jabatan'] = $this->profil_model->get_jabatan($this->session->id_mhsw)->result();
        $data['wirausaha'] = $this->profil_model->get_wirausaha($this->session->id_mhsw)->result();
        $data['seminar'] = $this->profil_model->get_seminar($this->session->id_mhsw)->result();
        $data['prestasi'] = $this->profil_model->get_prestasi($this->session->id_mhsw)->result();
        $data['karya_ilmiah'] = $this->profil_model->get_karya_ilmiah($this->session->id_mhsw)->result();
        $data['organisasi'] = $this->profil_model->get_organisasi($this->session->id_mhsw)->result();
        $data['mbkm'] = $this->profil_model->get_mbkm($this->session->id_mhsw)->result();
        $data['mbkm_luar'] = $this->profil_model->get_mbkm_luar($this->session->id_mhsw)->result();
        $this->load->view('main/users/index_menu', $data);
      }
    }

    public function delete()
    {
      $data = new stdClass();
      if ($this->profil_model->delete_pendidikan($this->input->post('id'))) {
        $data->status = "success";	
        $data->id = $this->input->post('id');
      } else {
        $data->status = "failed";	
        $data->id = $this->input->post('id');	
      }
  
      $json = json_encode($data);
  
      echo $json;
    }

    public function post_pekerjaan($id)
    {
      $this->form_validation->set_rules('nama_perusahaan', 'Nama Perusahaan', 'required');
      $this->form_validation->set_rules('bergerak_bidang', 'Bergerak dibidang', 'required');
      $this->form_validation->set_rules('tanggal_masuk', 'Tanggal Masuk', 'required');
      $this->form_validation->set_rules('gaji', 'Gaji', 'required');
      $this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
      $this->form_validation->set_rules('alamat', 'Alamat', 'required');
      
      $this->form_validation->set_message('required', '{field} harus terisi.');

      if ($this->form_validation->run() === FALSE) {
        $data['profil'] = $this->profil_model->get_profil_one($this->session->id_mhsw)->row();
        $data['prodi'] = $this->profil_model->get_prodi_all()->result();
        $data['content'] = 'menu/profil/index';
        $data['tab'] = 'pekerjaan';
        $data['pendidikan'] = $this->profil_model->get_pendidikan($this->session->id_mhsw)->result();
        $data['pekerjaan'] = $this->profil_model->get_pekerjaan($this->session->id_mhsw)->result();
        $data['jabatan'] = $this->profil_model->get_jabatan($this->session->id_mhsw)->result();
        $data['wirausaha'] = $this->profil_model->get_wirausaha($this->session->id_mhsw)->result();
        $data['seminar'] = $this->profil_model->get_seminar($this->session->id_mhsw)->result();
        $data['prestasi'] = $this->profil_model->get_prestasi($this->session->id_mhsw)->result();
        $data['karya_ilmiah'] = $this->profil_model->get_karya_ilmiah($this->session->id_mhsw)->result();
        $data['organisasi'] = $this->profil_model->get_organisasi($this->session->id_mhsw)->result();
        $data['mbkm'] = $this->profil_model->get_mbkm($this->session->id_mhsw)->result();
        $data['mbkm_luar'] = $this->profil_model->get_mbkm_luar($this->session->id_mhsw)->result();
        $data['show_modal_pekerjaan'] = true;
        $this->load->view('main/users/index_menu', $data);
      } else {
        $tanggal_masuk = explode("/",$this->input->post('tanggal_masuk'));
        $tanggal_masuk_data = $tanggal_masuk[2]."-".$tanggal_masuk[1]."-".$tanggal_masuk[0];
        if ($this->input->post('tanggal_berhenti') == "") {
          $tanggal_berhenti_data = "0000-00-00";
        } else {
          $tanggal_berhenti = explode("/",$this->input->post('tanggal_berhenti'));
          $tanggal_berhenti_data = $tanggal_berhenti[2]."-".$tanggal_berhenti[1]."-".$tanggal_berhenti[0];
        }

        $data_pekerjaan = array(
          'nama_perusahaan' => $this->input->post('nama_perusahaan'),
          'bergerak_bidang' => $this->input->post('bergerak_bidang'),
          'tanggal_masuk' => $tanggal_masuk_data,
          'tanggal_berhenti' => $tanggal_berhenti_data,
          'gaji' => $this->input->post('gaji'),
          'jabatan' => $this->input->post('jabatan'),
          'alamat' => $this->input->post('alamat'),
          'id_mhsw' => $id
        );
        
        if ($this->profil_model->post_pekerjaan($data_pekerjaan)) {
          $this->session->set_flashdata('success_save', TRUE);
        } else {
          $this->session->set_flashdata('error_save', TRUE);
        }
  
        $data['profil'] = $this->profil_model->get_profil_one($this->session->id_mhsw)->row();
        $data['prodi'] = $this->profil_model->get_prodi_all()->result();
        $data['content'] = 'menu/profil/index';
        $data['tab'] = 'pekerjaan';
        $data['pendidikan'] = $this->profil_model->get_pendidikan($this->session->id_mhsw)->result();
        $data['pekerjaan'] = $this->profil_model->get_pekerjaan($this->session->id_mhsw)->result();
        $data['jabatan'] = $this->profil_model->get_jabatan($this->session->id_mhsw)->result();
        $data['wirausaha'] = $this->profil_model->get_wirausaha($this->session->id_mhsw)->result();
        $data['seminar'] = $this->profil_model->get_seminar($this->session->id_mhsw)->result();
        $data['prestasi'] = $this->profil_model->get_prestasi($this->session->id_mhsw)->result();
        $data['karya_ilmiah'] = $this->profil_model->get_karya_ilmiah($this->session->id_mhsw)->result();
        $data['organisasi'] = $this->profil_model->get_organisasi($this->session->id_mhsw)->result();
        $data['mbkm'] = $this->profil_model->get_mbkm($this->session->id_mhsw)->result();
        $data['mbkm_luar'] = $this->profil_model->get_mbkm_luar($this->session->id_mhsw)->result();
        $this->load->view('main/users/index_menu', $data);
      }
    }

    public function put_pekerjaan($id)
    {
      $this->form_validation->set_rules('nama_perusahaan', 'Nama Perusahaan', 'required');
      $this->form_validation->set_rules('bergerak_bidang', 'Bergerak dibidang', 'required');
      $this->form_validation->set_rules('tanggal_masuk', 'Tanggal Masuk', 'required');
      $this->form_validation->set_rules('gaji', 'Gaji', 'required');
      $this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
      $this->form_validation->set_rules('alamat', 'Alamat', 'required');
      
      $this->form_validation->set_message('required', '{field} harus terisi.');

      if ($this->form_validation->run() === FALSE) {
        $data['profil'] = $this->profil_model->get_profil_one($this->session->id_mhsw)->row();
        $data['prodi'] = $this->profil_model->get_prodi_all()->result();
        $data['content'] = 'menu/profil/index';
        $data['tab'] = 'pekerjaan';
        $data['pendidikan'] = $this->profil_model->get_pendidikan($this->session->id_mhsw)->result();
        $data['pekerjaan'] = $this->profil_model->get_pekerjaan($this->session->id_mhsw)->result();
        $data['jabatan'] = $this->profil_model->get_jabatan($this->session->id_mhsw)->result();
        $data['wirausaha'] = $this->profil_model->get_wirausaha($this->session->id_mhsw)->result();
        $data['seminar'] = $this->profil_model->get_seminar($this->session->id_mhsw)->result();
        $data['prestasi'] = $this->profil_model->get_prestasi($this->session->id_mhsw)->result();
        $data['karya_ilmiah'] = $this->profil_model->get_karya_ilmiah($this->session->id_mhsw)->result();
        $data['organisasi'] = $this->profil_model->get_organisasi($this->session->id_mhsw)->result();
        $data['mbkm'] = $this->profil_model->get_mbkm($this->session->id_mhsw)->result();
        $data['mbkm_luar'] = $this->profil_model->get_mbkm_luar($this->session->id_mhsw)->result();
        $data['show_modal_update_pekerjaan'] = $id;
        $this->load->view('main/users/index_menu', $data);
      } else {
        $tanggal_masuk = explode("/",$this->input->post('tanggal_masuk'));
        $tanggal_masuk_data = $tanggal_masuk[2]."-".$tanggal_masuk[1]."-".$tanggal_masuk[0];
        $tanggal_berhenti = explode("/",$this->input->post('tanggal_berhenti'));
        $tanggal_berhenti_data = $tanggal_berhenti[2]."-".$tanggal_berhenti[1]."-".$tanggal_berhenti[0];

        $data_pekerjaan = array(
          'nama_perusahaan' => $this->input->post('nama_perusahaan'),
          'bergerak_bidang' => $this->input->post('bergerak_bidang'),
          'tanggal_masuk' => $tanggal_masuk_data,
          'tanggal_berhenti' => $tanggal_berhenti_data,
          'gaji' => $this->input->post('gaji'),
          'jabatan' => $this->input->post('jabatan'),
          'alamat' => $this->input->post('alamat'),
        );
        
        if ($this->profil_model->put_pekerjaan($data_pekerjaan, $id)) {
          $this->session->set_flashdata('success_update', TRUE);
        } else {
          $this->session->set_flashdata('error_update', TRUE);
        }
  
        $data['profil'] = $this->profil_model->get_profil_one($this->session->id_mhsw)->row();
        $data['prodi'] = $this->profil_model->get_prodi_all()->result();
        $data['content'] = 'menu/profil/index';
        $data['tab'] = 'pekerjaan';
        $data['pendidikan'] = $this->profil_model->get_pendidikan($this->session->id_mhsw)->result();
        $data['pekerjaan'] = $this->profil_model->get_pekerjaan($this->session->id_mhsw)->result();
        $data['jabatan'] = $this->profil_model->get_jabatan($this->session->id_mhsw)->result();
        $data['wirausaha'] = $this->profil_model->get_wirausaha($this->session->id_mhsw)->result();
        $data['seminar'] = $this->profil_model->get_seminar($this->session->id_mhsw)->result();
        $data['prestasi'] = $this->profil_model->get_prestasi($this->session->id_mhsw)->result();
        $data['karya_ilmiah'] = $this->profil_model->get_karya_ilmiah($this->session->id_mhsw)->result();
        $data['organisasi'] = $this->profil_model->get_organisasi($this->session->id_mhsw)->result();
        $data['mbkm'] = $this->profil_model->get_mbkm($this->session->id_mhsw)->result();
        $data['mbkm_luar'] = $this->profil_model->get_mbkm_luar($this->session->id_mhsw)->result();
        $this->load->view('main/users/index_menu', $data);
      }
    }
    
    public function delete_pekerjaan()
    {
      $data = new stdClass();
      if ($this->profil_model->delete_pekerjaan($this->input->post('id'))) {
        $data->status = "success";	
        $data->id = $this->input->post('id');
      } else {
        $data->status = "failed";	
        $data->id = $this->input->post('id');	
      }
  
      $json = json_encode($data);
  
      echo $json;
    }

    public function post_jabatan($id)
    {
      $this->form_validation->set_rules('instansi', 'Nama Perusahaan', 'required');
      $this->form_validation->set_rules('jabatan', 'Bergerak dibidang', 'required');
      $this->form_validation->set_rules('tanggal_masuk', 'Tanggal Masuk', 'required');
      $this->form_validation->set_rules('alamat', 'Alamat', 'required');
      
      $this->form_validation->set_message('required', '{field} harus terisi.');

      if ($this->form_validation->run() === FALSE) {
        $data['profil'] = $this->profil_model->get_profil_one($this->session->id_mhsw)->row();
        $data['prodi'] = $this->profil_model->get_prodi_all()->result();
        $data['content'] = 'menu/profil/index';
        $data['tab'] = 'jabatan';
        $data['pendidikan'] = $this->profil_model->get_pendidikan($this->session->id_mhsw)->result();
        $data['pekerjaan'] = $this->profil_model->get_pekerjaan($this->session->id_mhsw)->result();
        $data['jabatan'] = $this->profil_model->get_jabatan($this->session->id_mhsw)->result();
        $data['wirausaha'] = $this->profil_model->get_wirausaha($this->session->id_mhsw)->result();
        $data['seminar'] = $this->profil_model->get_seminar($this->session->id_mhsw)->result();
        $data['prestasi'] = $this->profil_model->get_prestasi($this->session->id_mhsw)->result();
        $data['karya_ilmiah'] = $this->profil_model->get_karya_ilmiah($this->session->id_mhsw)->result();
        $data['organisasi'] = $this->profil_model->get_organisasi($this->session->id_mhsw)->result();
        $data['mbkm'] = $this->profil_model->get_mbkm($this->session->id_mhsw)->result();
        $data['mbkm_luar'] = $this->profil_model->get_mbkm_luar($this->session->id_mhsw)->result();
        $data['show_modal_jabatan'] = true;
        $this->load->view('main/users/index_menu', $data);
      } else {
        $tanggal_masuk = explode("/",$this->input->post('tanggal_masuk'));
        $tanggal_masuk_data = $tanggal_masuk[2]."-".$tanggal_masuk[1]."-".$tanggal_masuk[0];
        if ($this->input->post('tanggal_selesai') == "") {
          $tanggal_selesai_data = "0000-00-00";
        } else {
          $tanggal_selesai = explode("/",$this->input->post('tanggal_selesai'));
          $tanggal_selesai_data = $tanggal_selesai[2]."-".$tanggal_selesai[1]."-".$tanggal_selesai[0];
        }

        $data_jabatan = array(
          'instansi' => $this->input->post('instansi'),
          'jabatan' => $this->input->post('jabatan'),
          'tanggal_mulai' => $tanggal_masuk_data,
          'tanggal_selesai' => $tanggal_selesai_data,
          'alamat' => $this->input->post('alamat'),
          'id_mhsw' => $id
        );
        
        if ($this->profil_model->post_jabatan($data_jabatan)) {
          $this->session->set_flashdata('success_save', TRUE);
        } else {
          $this->session->set_flashdata('error_save', TRUE);
        }
  
        $data['profil'] = $this->profil_model->get_profil_one($this->session->id_mhsw)->row();
        $data['prodi'] = $this->profil_model->get_prodi_all()->result();
        $data['content'] = 'menu/profil/index';
        $data['tab'] = 'jabatan';
        $data['pendidikan'] = $this->profil_model->get_pendidikan($this->session->id_mhsw)->result();
        $data['pekerjaan'] = $this->profil_model->get_pekerjaan($this->session->id_mhsw)->result();
        $data['jabatan'] = $this->profil_model->get_jabatan($this->session->id_mhsw)->result();
        $data['wirausaha'] = $this->profil_model->get_wirausaha($this->session->id_mhsw)->result();
        $data['seminar'] = $this->profil_model->get_seminar($this->session->id_mhsw)->result();
        $data['prestasi'] = $this->profil_model->get_prestasi($this->session->id_mhsw)->result();
        $data['karya_ilmiah'] = $this->profil_model->get_karya_ilmiah($this->session->id_mhsw)->result();
        $data['organisasi'] = $this->profil_model->get_organisasi($this->session->id_mhsw)->result();
        $data['mbkm'] = $this->profil_model->get_mbkm($this->session->id_mhsw)->result();
        $data['mbkm_luar'] = $this->profil_model->get_mbkm_luar($this->session->id_mhsw)->result();
        $this->load->view('main/users/index_menu', $data);
      }
    }

    public function put_jabatan($id)
    {
      $this->form_validation->set_rules('instansi', 'Nama Perusahaan', 'required');
      $this->form_validation->set_rules('jabatan', 'Bergerak dibidang', 'required');
      $this->form_validation->set_rules('tanggal_masuk', 'Tanggal Masuk', 'required');
      $this->form_validation->set_rules('alamat', 'Alamat', 'required');
      
      $this->form_validation->set_message('required', '{field} harus terisi.');

      if ($this->form_validation->run() === FALSE) {
        $data['profil'] = $this->profil_model->get_profil_one($this->session->id_mhsw)->row();
        $data['prodi'] = $this->profil_model->get_prodi_all()->result();
        $data['content'] = 'menu/profil/index';
        $data['tab'] = 'jabatan';
        $data['pendidikan'] = $this->profil_model->get_pendidikan($this->session->id_mhsw)->result();
        $data['pekerjaan'] = $this->profil_model->get_pekerjaan($this->session->id_mhsw)->result();
        $data['jabatan'] = $this->profil_model->get_jabatan($this->session->id_mhsw)->result();
        $data['wirausaha'] = $this->profil_model->get_wirausaha($this->session->id_mhsw)->result();
        $data['seminar'] = $this->profil_model->get_seminar($this->session->id_mhsw)->result();
        $data['prestasi'] = $this->profil_model->get_prestasi($this->session->id_mhsw)->result();
        $data['karya_ilmiah'] = $this->profil_model->get_karya_ilmiah($this->session->id_mhsw)->result();
        $data['organisasi'] = $this->profil_model->get_organisasi($this->session->id_mhsw)->result();
        $data['mbkm'] = $this->profil_model->get_mbkm($this->session->id_mhsw)->result();
        $data['mbkm_luar'] = $this->profil_model->get_mbkm_luar($this->session->id_mhsw)->result();
        $data['show_modal_jabatan'] = true;
        $this->load->view('main/users/index_menu', $data);
      } else {
        $tanggal_masuk = explode("/",$this->input->post('tanggal_masuk'));
        $tanggal_masuk_data = $tanggal_masuk[2]."-".$tanggal_masuk[1]."-".$tanggal_masuk[0];
        if ($this->input->post('tanggal_selesai') == "") {
          $tanggal_selesai_data = "0000-00-00";
        } else {
          $tanggal_selesai = explode("/",$this->input->post('tanggal_selesai'));
          $tanggal_selesai_data = $tanggal_selesai[2]."-".$tanggal_selesai[1]."-".$tanggal_selesai[0];
        }

        $data_jabatan = array(
          'instansi' => $this->input->post('instansi'),
          'jabatan' => $this->input->post('jabatan'),
          'tanggal_mulai' => $tanggal_masuk_data,
          'tanggal_selesai' => $tanggal_selesai_data,
          'alamat' => $this->input->post('alamat'),
        );
        
        if ($this->profil_model->put_jabatan($data_jabatan, $id)) {
          $this->session->set_flashdata('success_update', TRUE);
        } else {
          $this->session->set_flashdata('error_update', TRUE);
        }
  
        $data['profil'] = $this->profil_model->get_profil_one($this->session->id_mhsw)->row();
        $data['prodi'] = $this->profil_model->get_prodi_all()->result();
        $data['content'] = 'menu/profil/index';
        $data['tab'] = 'jabatan';
        $data['pendidikan'] = $this->profil_model->get_pendidikan($this->session->id_mhsw)->result();
        $data['pekerjaan'] = $this->profil_model->get_pekerjaan($this->session->id_mhsw)->result();
        $data['jabatan'] = $this->profil_model->get_jabatan($this->session->id_mhsw)->result();
        $data['wirausaha'] = $this->profil_model->get_wirausaha($this->session->id_mhsw)->result();
        $data['seminar'] = $this->profil_model->get_seminar($this->session->id_mhsw)->result();
        $data['prestasi'] = $this->profil_model->get_prestasi($this->session->id_mhsw)->result();
        $data['karya_ilmiah'] = $this->profil_model->get_karya_ilmiah($this->session->id_mhsw)->result();
        $data['organisasi'] = $this->profil_model->get_organisasi($this->session->id_mhsw)->result();
        $data['mbkm'] = $this->profil_model->get_mbkm($this->session->id_mhsw)->result();
        $data['mbkm_luar'] = $this->profil_model->get_mbkm_luar($this->session->id_mhsw)->result();
        $this->load->view('main/users/index_menu', $data);
      }
    }
    
    public function delete_jabatan()
    {
      $data = new stdClass();
      if ($this->profil_model->delete_jabatan($this->input->post('id'))) {
        $data->status = "success";	
        $data->id = $this->input->post('id');
      } else {
        $data->status = "failed";	
        $data->id = $this->input->post('id');	
      }
  
      $json = json_encode($data);
  
      echo $json;
    }

    public function post_wirausaha($id)
    {
      $this->form_validation->set_rules('nama_usaha', 'Nama Usaha', 'required');
      $this->form_validation->set_rules('jenis_usaha', 'Jenis Usaha', 'required');
      $this->form_validation->set_rules('tanggal_mulai', 'Tanggal Mulai', 'required');
      $this->form_validation->set_rules('rata_rata_omset', 'Rata-rata Omset', 'required');
      $this->form_validation->set_rules('alamat_usaha', 'Alamat Usaha', 'required');
      
      $this->form_validation->set_message('required', '{field} harus terisi.');

      if ($this->form_validation->run() === FALSE) {
        $data['profil'] = $this->profil_model->get_profil_one($this->session->id_mhsw)->row();
        $data['prodi'] = $this->profil_model->get_prodi_all()->result();
        $data['content'] = 'menu/profil/index';
        $data['tab'] = 'wirausaha';
        $data['pendidikan'] = $this->profil_model->get_pendidikan($this->session->id_mhsw)->result();
        $data['pekerjaan'] = $this->profil_model->get_pekerjaan($this->session->id_mhsw)->result();
        $data['jabatan'] = $this->profil_model->get_jabatan($this->session->id_mhsw)->result();
        $data['wirausaha'] = $this->profil_model->get_wirausaha($this->session->id_mhsw)->result();
        $data['seminar'] = $this->profil_model->get_seminar($this->session->id_mhsw)->result();
        $data['prestasi'] = $this->profil_model->get_prestasi($this->session->id_mhsw)->result();
        $data['karya_ilmiah'] = $this->profil_model->get_karya_ilmiah($this->session->id_mhsw)->result();
        $data['organisasi'] = $this->profil_model->get_organisasi($this->session->id_mhsw)->result();
        $data['mbkm'] = $this->profil_model->get_mbkm($this->session->id_mhsw)->result();
        $data['mbkm_luar'] = $this->profil_model->get_mbkm_luar($this->session->id_mhsw)->result();
        $data['show_modal_wirausaha'] = true;
        $this->load->view('main/users/index_menu', $data);
      } else {
        $tanggal_mulai = explode("/",$this->input->post('tanggal_mulai'));
        $tanggal_mulai_data = $tanggal_mulai[2]."-".$tanggal_mulai[1]."-".$tanggal_mulai[0];
        if ($this->input->post('tanggal_selesai') == "") {
          $tanggal_selesai_data = "0000-00-00";
        } else {
          $tanggal_selesai = explode("/",$this->input->post('tanggal_selesai'));
          $tanggal_selesai_data = $tanggal_selesai[2]."-".$tanggal_selesai[1]."-".$tanggal_selesai[0];
        }

        $data_wirausaha = array(
          'nama_usaha' => $this->input->post('nama_usaha'),
          'jenis_usaha' => $this->input->post('jenis_usaha'),
          'tanggal_mulai' => $tanggal_mulai_data,
          'tanggal_selesai' => $tanggal_selesai_data,
          'rata_rata_omset' => $this->input->post('rata_rata_omset'),
          'alamat_usaha' => $this->input->post('alamat_usaha'),
          'id_mhsw' => $id
        );
        
        if ($this->profil_model->post_wirausaha($data_wirausaha)) {
          $this->session->set_flashdata('success_save', TRUE);
        } else {
          $this->session->set_flashdata('error_save', TRUE);
        }
  
        $data['profil'] = $this->profil_model->get_profil_one($this->session->id_mhsw)->row();
        $data['prodi'] = $this->profil_model->get_prodi_all()->result();
        $data['content'] = 'menu/profil/index';
        $data['tab'] = 'wirausaha';
        $data['pendidikan'] = $this->profil_model->get_pendidikan($this->session->id_mhsw)->result();
        $data['pekerjaan'] = $this->profil_model->get_pekerjaan($this->session->id_mhsw)->result();
        $data['jabatan'] = $this->profil_model->get_jabatan($this->session->id_mhsw)->result();
        $data['wirausaha'] = $this->profil_model->get_wirausaha($this->session->id_mhsw)->result();
        $data['seminar'] = $this->profil_model->get_seminar($this->session->id_mhsw)->result();
        $data['prestasi'] = $this->profil_model->get_prestasi($this->session->id_mhsw)->result();
        $data['karya_ilmiah'] = $this->profil_model->get_karya_ilmiah($this->session->id_mhsw)->result();
        $data['organisasi'] = $this->profil_model->get_organisasi($this->session->id_mhsw)->result();
        $data['mbkm'] = $this->profil_model->get_mbkm($this->session->id_mhsw)->result();
        $data['mbkm_luar'] = $this->profil_model->get_mbkm_luar($this->session->id_mhsw)->result();
        $this->load->view('main/users/index_menu', $data);
      }
    }

    public function put_wirausaha($id)
    {
      $this->form_validation->set_rules('nama_usaha', 'Nama Usaha', 'required');
      $this->form_validation->set_rules('jenis_usaha', 'Jenis Usaha', 'required');
      $this->form_validation->set_rules('tanggal_mulai', 'Tanggal Mulai', 'required');
      $this->form_validation->set_rules('rata_rata_omset', 'Rata-rata Omset', 'required');
      $this->form_validation->set_rules('alamat_usaha', 'Alamat Usaha', 'required');
      
      $this->form_validation->set_message('required', '{field} harus terisi.');

      if ($this->form_validation->run() === FALSE) {
        $data['profil'] = $this->profil_model->get_profil_one($this->session->id_mhsw)->row();
        $data['prodi'] = $this->profil_model->get_prodi_all()->result();
        $data['content'] = 'menu/profil/index';
        $data['tab'] = 'wirausaha';
        $data['pendidikan'] = $this->profil_model->get_pendidikan($this->session->id_mhsw)->result();
        $data['pekerjaan'] = $this->profil_model->get_pekerjaan($this->session->id_mhsw)->result();
        $data['jabatan'] = $this->profil_model->get_jabatan($this->session->id_mhsw)->result();
        $data['wirausaha'] = $this->profil_model->get_wirausaha($this->session->id_mhsw)->result();
        $data['seminar'] = $this->profil_model->get_seminar($this->session->id_mhsw)->result();
        $data['prestasi'] = $this->profil_model->get_prestasi($this->session->id_mhsw)->result();
        $data['karya_ilmiah'] = $this->profil_model->get_karya_ilmiah($this->session->id_mhsw)->result();
        $data['organisasi'] = $this->profil_model->get_organisasi($this->session->id_mhsw)->result();
        $data['mbkm'] = $this->profil_model->get_mbkm($this->session->id_mhsw)->result();
        $data['mbkm_luar'] = $this->profil_model->get_mbkm_luar($this->session->id_mhsw)->result();
        $data['show_modal_wirausaha'] = true;
        $this->load->view('main/users/index_menu', $data);
      } else {
        $tanggal_mulai = explode("/",$this->input->post('tanggal_mulai'));
        $tanggal_mulai_data = $tanggal_mulai[2]."-".$tanggal_mulai[1]."-".$tanggal_mulai[0];
        if ($this->input->post('tanggal_selesai') == "") {
          $tanggal_selesai_data = "0000-00-00";
        } else {
          $tanggal_selesai = explode("/",$this->input->post('tanggal_selesai'));
          $tanggal_selesai_data = $tanggal_selesai[2]."-".$tanggal_selesai[1]."-".$tanggal_selesai[0];
        }

        $data_wirausaha = array(
          'nama_usaha' => $this->input->post('nama_usaha'),
          'jenis_usaha' => $this->input->post('jenis_usaha'),
          'tanggal_mulai' => $tanggal_mulai_data,
          'tanggal_selesai' => $tanggal_selesai_data,
          'rata_rata_omset' => $this->input->post('rata_rata_omset'),
          'alamat_usaha' => $this->input->post('alamat_usaha'),
        );
        
        if ($this->profil_model->put_wirausaha($data_wirausaha, $id)) {
          $this->session->set_flashdata('success_update', TRUE);
        } else {
          $this->session->set_flashdata('error_update', TRUE);
        }
  
        $data['profil'] = $this->profil_model->get_profil_one($this->session->id_mhsw)->row();
        $data['prodi'] = $this->profil_model->get_prodi_all()->result();
        $data['content'] = 'menu/profil/index';
        $data['tab'] = 'wirausaha';
        $data['pendidikan'] = $this->profil_model->get_pendidikan($this->session->id_mhsw)->result();
        $data['pekerjaan'] = $this->profil_model->get_pekerjaan($this->session->id_mhsw)->result();
        $data['jabatan'] = $this->profil_model->get_jabatan($this->session->id_mhsw)->result();
        $data['wirausaha'] = $this->profil_model->get_wirausaha($this->session->id_mhsw)->result();
        $data['seminar'] = $this->profil_model->get_seminar($this->session->id_mhsw)->result();
        $data['prestasi'] = $this->profil_model->get_prestasi($this->session->id_mhsw)->result();
        $data['karya_ilmiah'] = $this->profil_model->get_karya_ilmiah($this->session->id_mhsw)->result();
        $data['organisasi'] = $this->profil_model->get_organisasi($this->session->id_mhsw)->result();
        $data['mbkm'] = $this->profil_model->get_mbkm($this->session->id_mhsw)->result();
        $data['mbkm_luar'] = $this->profil_model->get_mbkm_luar($this->session->id_mhsw)->result();
        $this->load->view('main/users/index_menu', $data);
      }
    }
    
    public function delete_wirausaha()
    {
      $data = new stdClass();
      if ($this->profil_model->delete_wirausaha($this->input->post('id'))) {
        $data->status = "success";	
        $data->id = $this->input->post('id');
      } else {
        $data->status = "failed";	
        $data->id = $this->input->post('id');	
      }
  
      $json = json_encode($data);
  
      echo $json;
    }

    public function post_seminar($id)
    {
      $this->form_validation->set_rules('nama_kegiatan', 'Nama Kegiatan', 'required');
      $this->form_validation->set_rules('pelaksana_kegiatan', 'Pelaksana Kegiatan', 'required');
      $this->form_validation->set_rules('jenis_kegiatan', 'Jenis Kegiatan', 'required');
      $this->form_validation->set_rules('tingkat_kegiatan', 'Tingkat Kegiatan', 'required');
      $this->form_validation->set_rules('tanggal_mulai', 'Tanggal Mulai', 'required');
      $this->form_validation->set_rules('tanggal_selesai', 'Tanggal Selesai', 'required');
      $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
      
      $this->form_validation->set_message('required', '{field} harus terisi.');

      if ($this->form_validation->run() === FALSE) {
        $data['profil'] = $this->profil_model->get_profil_one($this->session->id_mhsw)->row();
        $data['prodi'] = $this->profil_model->get_prodi_all()->result();
        $data['content'] = 'menu/profil/index';
        $data['tab'] = 'seminar';
        $data['pendidikan'] = $this->profil_model->get_pendidikan($this->session->id_mhsw)->result();
        $data['pekerjaan'] = $this->profil_model->get_pekerjaan($this->session->id_mhsw)->result();
        $data['jabatan'] = $this->profil_model->get_jabatan($this->session->id_mhsw)->result();
        $data['wirausaha'] = $this->profil_model->get_wirausaha($this->session->id_mhsw)->result();
        $data['seminar'] = $this->profil_model->get_seminar($this->session->id_mhsw)->result();
        $data['prestasi'] = $this->profil_model->get_prestasi($this->session->id_mhsw)->result();
        $data['karya_ilmiah'] = $this->profil_model->get_karya_ilmiah($this->session->id_mhsw)->result();
        $data['organisasi'] = $this->profil_model->get_organisasi($this->session->id_mhsw)->result();
        $data['mbkm'] = $this->profil_model->get_mbkm($this->session->id_mhsw)->result();
        $data['mbkm_luar'] = $this->profil_model->get_mbkm_luar($this->session->id_mhsw)->result();
        $data['show_modal_seminar'] = true;
        $this->load->view('main/users/index_menu', $data);
      } else {
        $tanggal_mulai = explode("/",$this->input->post('tanggal_mulai'));
        $tanggal_mulai_data = $tanggal_mulai[2]."-".$tanggal_mulai[1]."-".$tanggal_mulai[0];
        $tanggal_selesai = explode("/",$this->input->post('tanggal_selesai'));
        $tanggal_selesai_data = $tanggal_selesai[2]."-".$tanggal_selesai[1]."-".$tanggal_selesai[0];
        
        $data_seminar = array(
          'nama_kegiatan' => $this->input->post('nama_kegiatan'),
          'pelaksana_kegiatan' => $this->input->post('pelaksana_kegiatan'),
          'jenis_kegiatan' => $this->input->post('jenis_kegiatan'),
          'tingkat_kegiatan' => $this->input->post('tingkat_kegiatan'),
          'peran' => $this->input->post('peran'),
          'tanggal_mulai' => $tanggal_mulai_data,
          'tanggal_selesai' => $tanggal_selesai_data,
          'keterangan' => $this->input->post('keterangan'),
          'id_mhsw' => $id
        );
        
        if ($this->profil_model->post_seminar($data_seminar)) {
          $this->session->set_flashdata('success_save', TRUE);
        } else {
          $this->session->set_flashdata('error_save', TRUE);
        }
  
        $data['profil'] = $this->profil_model->get_profil_one($this->session->id_mhsw)->row();
        $data['prodi'] = $this->profil_model->get_prodi_all()->result();
        $data['content'] = 'menu/profil/index';
        $data['tab'] = 'seminar';
        $data['pendidikan'] = $this->profil_model->get_pendidikan($this->session->id_mhsw)->result();
        $data['pekerjaan'] = $this->profil_model->get_pekerjaan($this->session->id_mhsw)->result();
        $data['jabatan'] = $this->profil_model->get_jabatan($this->session->id_mhsw)->result();
        $data['wirausaha'] = $this->profil_model->get_wirausaha($this->session->id_mhsw)->result();
        $data['seminar'] = $this->profil_model->get_seminar($this->session->id_mhsw)->result();
        $data['prestasi'] = $this->profil_model->get_prestasi($this->session->id_mhsw)->result();
        $data['karya_ilmiah'] = $this->profil_model->get_karya_ilmiah($this->session->id_mhsw)->result();
        $data['organisasi'] = $this->profil_model->get_organisasi($this->session->id_mhsw)->result();
        $data['mbkm'] = $this->profil_model->get_mbkm($this->session->id_mhsw)->result();
        $data['mbkm_luar'] = $this->profil_model->get_mbkm_luar($this->session->id_mhsw)->result();
        $this->load->view('main/users/index_menu', $data);
      }
    }

    public function put_seminar($id)
    {
      $this->form_validation->set_rules('nama_kegiatan', 'Nama Kegiatan', 'required');
      $this->form_validation->set_rules('pelaksana_kegiatan', 'Pelaksana Kegiatan', 'required');
      $this->form_validation->set_rules('jenis_kegiatan', 'Jenis Kegiatan', 'required');
      $this->form_validation->set_rules('tingkat_kegiatan', 'Tingkat Kegiatan', 'required');
      $this->form_validation->set_rules('peran', 'Peran', 'required');
      $this->form_validation->set_rules('tanggal_mulai', 'Tanggal Mulai', 'required');
      $this->form_validation->set_rules('tanggal_selesai', 'Tanggal Selesai', 'required');
      $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
      
      $this->form_validation->set_message('required', '{field} harus terisi.');


      if ($this->form_validation->run() === FALSE) {
        $data['profil'] = $this->profil_model->get_profil_one($this->session->id_mhsw)->row();
        $data['prodi'] = $this->profil_model->get_prodi_all()->result();
        $data['content'] = 'menu/profil/index';
        $data['tab'] = 'seminar';
        $data['pendidikan'] = $this->profil_model->get_pendidikan($this->session->id_mhsw)->result();
        $data['pekerjaan'] = $this->profil_model->get_pekerjaan($this->session->id_mhsw)->result();
        $data['jabatan'] = $this->profil_model->get_jabatan($this->session->id_mhsw)->result();
        $data['wirausaha'] = $this->profil_model->get_wirausaha($this->session->id_mhsw)->result();
        $data['seminar'] = $this->profil_model->get_seminar($this->session->id_mhsw)->result();
        $data['prestasi'] = $this->profil_model->get_prestasi($this->session->id_mhsw)->result();
        $data['karya_ilmiah'] = $this->profil_model->get_karya_ilmiah($this->session->id_mhsw)->result();
        $data['organisasi'] = $this->profil_model->get_organisasi($this->session->id_mhsw)->result();
        $data['mbkm'] = $this->profil_model->get_mbkm($this->session->id_mhsw)->result();
        $data['mbkm_luar'] = $this->profil_model->get_mbkm_luar($this->session->id_mhsw)->result();
        $data['show_modal_seminar'] = true;
        $this->load->view('main/users/index_menu', $data);
      } else {
        $tanggal_mulai = explode("/",$this->input->post('tanggal_mulai'));
        $tanggal_mulai_data = $tanggal_mulai[2]."-".$tanggal_mulai[1]."-".$tanggal_mulai[0];
        $tanggal_selesai = explode("/",$this->input->post('tanggal_selesai'));
        $tanggal_selesai_data = $tanggal_selesai[2]."-".$tanggal_selesai[1]."-".$tanggal_selesai[0];
        
        $data_seminar = array(
          'nama_kegiatan' => $this->input->post('nama_kegiatan'),
          'pelaksana_kegiatan' => $this->input->post('pelaksana_kegiatan'),
          'jenis_kegiatan' => $this->input->post('jenis_kegiatan'),
          'tingkat_kegiatan' => $this->input->post('tingkat_kegiatan'),
          'peran' => $this->input->post('peran'),
          'tanggal_mulai' => $tanggal_mulai_data,
          'tanggal_selesai' => $tanggal_selesai_data,
          'keterangan' => $this->input->post('keterangan')
        );
        
        if ($this->profil_model->put_seminar($data_seminar, $id)) {
          $this->session->set_flashdata('success_update', TRUE);
        } else {
          $this->session->set_flashdata('error_update', TRUE);
        }
  
        $data['profil'] = $this->profil_model->get_profil_one($this->session->id_mhsw)->row();
        $data['prodi'] = $this->profil_model->get_prodi_all()->result();
        $data['content'] = 'menu/profil/index';
        $data['tab'] = 'seminar';
        $data['pendidikan'] = $this->profil_model->get_pendidikan($this->session->id_mhsw)->result();
        $data['pekerjaan'] = $this->profil_model->get_pekerjaan($this->session->id_mhsw)->result();
        $data['jabatan'] = $this->profil_model->get_jabatan($this->session->id_mhsw)->result();
        $data['wirausaha'] = $this->profil_model->get_wirausaha($this->session->id_mhsw)->result();
        $data['seminar'] = $this->profil_model->get_seminar($this->session->id_mhsw)->result();
        $data['prestasi'] = $this->profil_model->get_prestasi($this->session->id_mhsw)->result();
        $data['karya_ilmiah'] = $this->profil_model->get_karya_ilmiah($this->session->id_mhsw)->result();
        $data['organisasi'] = $this->profil_model->get_organisasi($this->session->id_mhsw)->result();
        $data['mbkm'] = $this->profil_model->get_mbkm($this->session->id_mhsw)->result();
        $data['mbkm_luar'] = $this->profil_model->get_mbkm_luar($this->session->id_mhsw)->result();
        $this->load->view('main/users/index_menu', $data);
      }
    }
    
    public function delete_seminar()
    {
      $data = new stdClass();
      if ($this->profil_model->delete_seminar($this->input->post('id'))) {
        $data->status = "success";	
        $data->id = $this->input->post('id');
      } else {
        $data->status = "failed";	
        $data->id = $this->input->post('id');	
      }
  
      $json = json_encode($data);
  
      echo $json;
    }

    // public function post_prestasi($id)
    // {
    //   $this->form_validation->set_rules('nama_kegiatan', 'Nama Kegiatan', 'required');
    //   $this->form_validation->set_rules('nama_pelaksana', 'Nama Pelaksana', 'required');
    //   $this->form_validation->set_rules('tingkat_kegiatan', 'Tingkat Kegiatan', 'required');
    //   $this->form_validation->set_rules('nama_pembimbing', 'Nama Pembimbing/Anggota Lainnya', 'required');
    //   $this->form_validation->set_rules('dana_diterima', 'Dana Diterima', 'required');
    //   $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
      
    //   $this->form_validation->set_message('required', '{field} harus terisi.');

    //   if ($this->form_validation->run() === FALSE) {
    //     $data['profil'] = $this->profil_model->get_profil_one($this->session->id_mhsw)->row();
    //     $data['prodi'] = $this->profil_model->get_prodi_all()->result();
    //     $data['content'] = 'menu/profil/index';
    //     $data['tab'] = 'prestasi';
    //     $data['pendidikan'] = $this->profil_model->get_pendidikan($this->session->id_mhsw)->result();
    //     $data['pekerjaan'] = $this->profil_model->get_pekerjaan($this->session->id_mhsw)->result();
    //     $data['jabatan'] = $this->profil_model->get_jabatan($this->session->id_mhsw)->result();
    //     $data['wirausaha'] = $this->profil_model->get_wirausaha($this->session->id_mhsw)->result();
    //     $data['seminar'] = $this->profil_model->get_seminar($this->session->id_mhsw)->result();
    //     $data['prestasi'] = $this->profil_model->get_prestasi($this->session->id_mhsw)->result();
    //     $data['karya_ilmiah'] = $this->profil_model->get_karya_ilmiah($this->session->id_mhsw)->result();
    //     $data['organisasi'] = $this->profil_model->get_organisasi($this->session->id_mhsw)->result();
    //     $data['mbkm'] = $this->profil_model->get_mbkm($this->session->id_mhsw)->result();
    //     $data['mbkm_luar'] = $this->profil_model->get_mbkm_luar($this->session->id_mhsw)->result();
    //     $data['show_modal_prestasi'] = true;
    //     $this->load->view('main/users/index_menu', $data);
    //   } else {
    //     $data_prestasi = array(
    //       'nama_kegiatan' => $this->input->post('nama_kegiatan'),
    //       'nama_pelaksana' => $this->input->post('nama_pelaksana'),
    //       'tingkat_kegiatan' => $this->input->post('tingkat_kegiatan'),
    //       'nama_pembimbing' => $this->input->post('nama_pembimbing'),
    //       'dana_diterima' => $this->input->post('dana_diterima'),
    //       'keterangan' => $this->input->post('keterangan'),
    //       //tambahan///
    //       'peringkat' => $this->input->post('peringkat'),
    //       'jml_negara' => $this->input->post('jml_negara'),
    //       'jml_pt' => $this->input->post('jml_pt'),
    //       'jenis_peserta' => $this->input->post('jenis_peserta'),
    //       'nomor_sertifikat' => $this->input->post('nomor_sertifikat'),
    //       'm_pelaksana' => $this->input->post('m_pelaksana'),
    //       'nomor_sk' => $this->input->post('nomor_sk'),
    //       'tanggal_mulai' => $this->input->post('tanggal_mulai'),
    //       'tanggal_selesai' => $this->input->post('tanggal_selesai'),
    //       //tinggal upload gambar
    //       'id_mhsw' => $id
    //     );
        
    //     if ($this->profil_model->post_prestasi($data_prestasi)) {
    //       $this->session->set_flashdata('success_save', TRUE);
    //     } else {
    //       $this->session->set_flashdata('error_save', TRUE);
    //     }
  
    //     $data['profil'] = $this->profil_model->get_profil_one($this->session->id_mhsw)->row();
    //     $data['prodi'] = $this->profil_model->get_prodi_all()->result();
    //     $data['content'] = 'menu/profil/index';
    //     $data['tab'] = 'prestasi';
    //     $data['pendidikan'] = $this->profil_model->get_pendidikan($this->session->id_mhsw)->result();
    //     $data['pekerjaan'] = $this->profil_model->get_pekerjaan($this->session->id_mhsw)->result();
    //     $data['jabatan'] = $this->profil_model->get_jabatan($this->session->id_mhsw)->result();
    //     $data['wirausaha'] = $this->profil_model->get_wirausaha($this->session->id_mhsw)->result();
    //     $data['seminar'] = $this->profil_model->get_seminar($this->session->id_mhsw)->result();
    //     $data['prestasi'] = $this->profil_model->get_prestasi($this->session->id_mhsw)->result();
    //     $data['karya_ilmiah'] = $this->profil_model->get_karya_ilmiah($this->session->id_mhsw)->result();
    //     $data['organisasi'] = $this->profil_model->get_organisasi($this->session->id_mhsw)->result();
    //     $data['mbkm'] = $this->profil_model->get_mbkm($this->session->id_mhsw)->result();
    //     $data['mbkm_luar'] = $this->profil_model->get_mbkm_luar($this->session->id_mhsw)->result();
    //     $this->load->view('main/users/index_menu', $data);
    //   }
    // }

    // public function put_prestasi($id)
    // {
    //   $this->form_validation->set_rules('nama_kegiatan', 'Nama Kegiatan', 'required');
    //   $this->form_validation->set_rules('nama_pelaksana', 'Nama Pelaksana', 'required');
    //   $this->form_validation->set_rules('tingkat_kegiatan', 'Tingkat Kegiatan', 'required');
    //   $this->form_validation->set_rules('nama_pembimbing', 'Nama Pembimbing/Anggota Lainnya', 'required');
    //   $this->form_validation->set_rules('dana_diterima', 'Dana Diterima', 'required');
    //   $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
      
    //   $this->form_validation->set_message('required', '{field} harus terisi.');


    //   if ($this->form_validation->run() === FALSE) {
    //     $data['profil'] = $this->profil_model->get_profil_one($this->session->id_mhsw)->row();
    //     $data['prodi'] = $this->profil_model->get_prodi_all()->result();
    //     $data['content'] = 'menu/profil/index';
    //     $data['tab'] = 'prestasi';
    //     $data['pendidikan'] = $this->profil_model->get_pendidikan($this->session->id_mhsw)->result();
    //     $data['pekerjaan'] = $this->profil_model->get_pekerjaan($this->session->id_mhsw)->result();
    //     $data['jabatan'] = $this->profil_model->get_jabatan($this->session->id_mhsw)->result();
    //     $data['wirausaha'] = $this->profil_model->get_wirausaha($this->session->id_mhsw)->result();
    //     $data['seminar'] = $this->profil_model->get_seminar($this->session->id_mhsw)->result();
    //     $data['prestasi'] = $this->profil_model->get_prestasi($this->session->id_mhsw)->result();
    //     $data['karya_ilmiah'] = $this->profil_model->get_karya_ilmiah($this->session->id_mhsw)->result();
    //     $data['organisasi'] = $this->profil_model->get_organisasi($this->session->id_mhsw)->result();
    //     $data['mbkm'] = $this->profil_model->get_mbkm($this->session->id_mhsw)->result();
    //     $data['mbkm_luar'] = $this->profil_model->get_mbkm_luar($this->session->id_mhsw)->result();
    //     $data['show_modal_prestasi'] = true;
    //     $this->load->view('main/users/index_menu', $data);
    //   } else {
    //     $data_prestasi = array(
    //       'nama_kegiatan' => $this->input->post('nama_kegiatan'),
    //       'nama_pelaksana' => $this->input->post('nama_pelaksana'),
    //       'tingkat_kegiatan' => $this->input->post('tingkat_kegiatan'),
    //       'nama_pembimbing' => $this->input->post('nama_pembimbing'),
    //       'dana_diterima' => $this->input->post('dana_diterima'),
    //       'keterangan' => $this->input->post('keterangan'),
    //       //tambahan///
    //       'peringkat' => $this->input->post('peringkat'),
    //       'jml_negara' => $this->input->post('jml_negara'),
    //       'jml_pt' => $this->input->post('jml_pt'),
    //       'jenis_peserta' => $this->input->post('jenis_peserta'),
    //       'nomor_sertifikat' => $this->input->post('nomor_sertifikat'),
    //       'm_pelaksana' => $this->input->post('m_pelaksana'),
    //       'nomor_sk' => $this->input->post('nomor_sk'),
    //       'tanggal_mulai' => $this->input->post('tanggal_mulai'),
    //       'tanggal_selesai' => $this->input->post('tanggal_selesai'),
    //       //tinggal upload gambar
    //     );
        
    //     if ($this->profil_model->put_prestasi($data_prestasi, $id)) {
    //       $this->session->set_flashdata('success_update', TRUE);
    //     } else {
    //       $this->session->set_flashdata('error_update', TRUE);
    //     }
  
    //     $data['profil'] = $this->profil_model->get_profil_one($this->session->id_mhsw)->row();
    //     $data['prodi'] = $this->profil_model->get_prodi_all()->result();
    //     $data['content'] = 'menu/profil/index';
    //     $data['tab'] = 'prestasi';
    //     $data['pendidikan'] = $this->profil_model->get_pendidikan($this->session->id_mhsw)->result();
    //     $data['pekerjaan'] = $this->profil_model->get_pekerjaan($this->session->id_mhsw)->result();
    //     $data['jabatan'] = $this->profil_model->get_jabatan($this->session->id_mhsw)->result();
    //     $data['wirausaha'] = $this->profil_model->get_wirausaha($this->session->id_mhsw)->result();
    //     $data['seminar'] = $this->profil_model->get_seminar($this->session->id_mhsw)->result();
    //     $data['prestasi'] = $this->profil_model->get_prestasi($this->session->id_mhsw)->result();
    //     $data['karya_ilmiah'] = $this->profil_model->get_karya_ilmiah($this->session->id_mhsw)->result();
    //     $data['organisasi'] = $this->profil_model->get_organisasi($this->session->id_mhsw)->result();
    //     $data['mbkm'] = $this->profil_model->get_mbkm($this->session->id_mhsw)->result();
    //     $data['mbkm_luar'] = $this->profil_model->get_mbkm_luar($this->session->id_mhsw)->result();
    //     $this->load->view('main/users/index_menu', $data);
    //   }
    // }

    public function post_prestasi($id)
{
    $this->form_validation->set_rules('nama_kegiatan', 'Nama Kegiatan', 'required');
    $this->form_validation->set_rules('nama_pelaksana', 'Nama Pelaksana', 'required');
    $this->form_validation->set_rules('tingkat_kegiatan', 'Tingkat Kegiatan', 'required');
    $this->form_validation->set_rules('nama_pembimbing', 'Nama Pembimbing/Anggota Lainnya', 'required');
    $this->form_validation->set_rules('dana_diterima', 'Dana Diterima', 'required');
    $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
    $this->form_validation->set_message('required', '{field} harus terisi.');

    if ($this->form_validation->run() === FALSE) {
        $data['profil'] = $this->profil_model->get_profil_one($this->session->id_mhsw)->row();
        $data['prodi'] = $this->profil_model->get_prodi_all()->result();
        $data['content'] = 'menu/profil/index';
        $data['tab'] = 'prestasi';
        $data['pendidikan'] = $this->profil_model->get_pendidikan($this->session->id_mhsw)->result();
        $data['pekerjaan'] = $this->profil_model->get_pekerjaan($this->session->id_mhsw)->result();
        $data['jabatan'] = $this->profil_model->get_jabatan($this->session->id_mhsw)->result();
        $data['wirausaha'] = $this->profil_model->get_wirausaha($this->session->id_mhsw)->result();
        $data['seminar'] = $this->profil_model->get_seminar($this->session->id_mhsw)->result();
        $data['prestasi'] = $this->profil_model->get_prestasi($this->session->id_mhsw)->result();
        $data['karya_ilmiah'] = $this->profil_model->get_karya_ilmiah($this->session->id_mhsw)->result();
        $data['organisasi'] = $this->profil_model->get_organisasi($this->session->id_mhsw)->result();
        $data['mbkm'] = $this->profil_model->get_mbkm($this->session->id_mhsw)->result();
        $data['mbkm_luar'] = $this->profil_model->get_mbkm_luar($this->session->id_mhsw)->result();
        $data['show_modal_prestasi'] = true;
        $this->load->view('main/users/index_menu', $data);
    } else {
        $data_prestasi = array(
            'nama_kegiatan' => $this->input->post('nama_kegiatan'),
            'nama_pelaksana' => $this->input->post('nama_pelaksana'),
            'tingkat_kegiatan' => $this->input->post('tingkat_kegiatan'),
            'nama_pembimbing' => $this->input->post('nama_pembimbing'),
            'dana_diterima' => $this->input->post('dana_diterima'),
            'keterangan' => $this->input->post('keterangan'),
            'peringkat' => $this->input->post('peringkat'),
            'jml_negara' => $this->input->post('jml_negara'),
            'jml_pt' => $this->input->post('jml_pt'),
            'jenis_peserta' => $this->input->post('jenis_peserta'),
            'nomor_sertifikat' => $this->input->post('nomor_sertifikat'),
            'm_pelaksana' => $this->input->post('m_pelaksana'),
            'nomor_sk' => $this->input->post('nomor_sk'),
            'tanggal_mulai' => $this->input->post('tanggal_mulai'),
            'tanggal_selesai' => $this->input->post('tanggal_selesai'),
            'id_mhsw' => $id
        );

        // === Handle Upload ===
    $this->load->library('upload');
    $upload_fields = ['sertifikat', 'foto', 'sk', 'link'];
    foreach ($upload_fields as $field) {
        if (!empty($_FILES[$field]['name'])) {
            $config['upload_path'] = './uploads/prestasi/';
            $config['allowed_types'] = ($field == 'foto'|| $field == 'link') ? 'jpg|jpeg|png' : 'pdf';
            $config['max_size'] = 2048;
            $config['file_name'] = $field . '_' . time();

            $this->upload->initialize($config);

            if ($this->upload->do_upload($field)) {
                $upload_data = $this->upload->data();
                $data_prestasi[$field] = $upload_data['file_name'];
            } else {
                $this->session->set_flashdata('error_save', 'Gagal upload file ' . $field . ': ' . strip_tags($this->upload->display_errors()));
                redirect('profil'); return;
            }
        }
    }

        if ($this->profil_model->post_prestasi($data_prestasi)) {
            $this->session->set_flashdata('success_save', TRUE);
        } else {
            $this->session->set_flashdata('error_save', TRUE);
        }

        $data['profil'] = $this->profil_model->get_profil_one($this->session->id_mhsw)->row();
        $data['prodi'] = $this->profil_model->get_prodi_all()->result();
        $data['content'] = 'menu/profil/index';
        $data['tab'] = 'prestasi';
        $data['pendidikan'] = $this->profil_model->get_pendidikan($this->session->id_mhsw)->result();
        $data['pekerjaan'] = $this->profil_model->get_pekerjaan($this->session->id_mhsw)->result();
        $data['jabatan'] = $this->profil_model->get_jabatan($this->session->id_mhsw)->result();
        $data['wirausaha'] = $this->profil_model->get_wirausaha($this->session->id_mhsw)->result();
        $data['seminar'] = $this->profil_model->get_seminar($this->session->id_mhsw)->result();
        $data['prestasi'] = $this->profil_model->get_prestasi($this->session->id_mhsw)->result();
        $data['karya_ilmiah'] = $this->profil_model->get_karya_ilmiah($this->session->id_mhsw)->result();
        $data['organisasi'] = $this->profil_model->get_organisasi($this->session->id_mhsw)->result();
        $data['mbkm'] = $this->profil_model->get_mbkm($this->session->id_mhsw)->result();
        $data['mbkm_luar'] = $this->profil_model->get_mbkm_luar($this->session->id_mhsw)->result();
        $this->load->view('main/users/index_menu', $data);
      }
    }

    public function put_prestasi($id)
    {
    $this->form_validation->set_rules('nama_kegiatan', 'Nama Kegiatan', 'required');
    $this->form_validation->set_rules('nama_pelaksana', 'Nama Pelaksana', 'required');
    $this->form_validation->set_rules('tingkat_kegiatan', 'Tingkat Kegiatan', 'required');
    $this->form_validation->set_rules('nama_pembimbing', 'Nama Pembimbing/Anggota Lainnya', 'required');
    $this->form_validation->set_rules('dana_diterima', 'Dana Diterima', 'required');
    $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
    $this->form_validation->set_message('required', '{field} harus terisi.');

    if ($this->form_validation->run() === FALSE) {
        // Kembali ke form dengan error
        $data['profil'] = $this->profil_model->get_profil_one($this->session->id_mhsw)->row();
        $data['prodi'] = $this->profil_model->get_prodi_all()->result();
        $data['content'] = 'menu/profil/index';
        $data['tab'] = 'prestasi';
        $data['pendidikan'] = $this->profil_model->get_pendidikan($this->session->id_mhsw)->result();
        $data['pekerjaan'] = $this->profil_model->get_pekerjaan($this->session->id_mhsw)->result();
        $data['jabatan'] = $this->profil_model->get_jabatan($this->session->id_mhsw)->result();
        $data['wirausaha'] = $this->profil_model->get_wirausaha($this->session->id_mhsw)->result();
        $data['seminar'] = $this->profil_model->get_seminar($this->session->id_mhsw)->result();
        $data['prestasi'] = $this->profil_model->get_prestasi($this->session->id_mhsw)->result();
        $data['karya_ilmiah'] = $this->profil_model->get_karya_ilmiah($this->session->id_mhsw)->result();
        $data['organisasi'] = $this->profil_model->get_organisasi($this->session->id_mhsw)->result();
        $data['mbkm'] = $this->profil_model->get_mbkm($this->session->id_mhsw)->result();
        $data['mbkm_luar'] = $this->profil_model->get_mbkm_luar($this->session->id_mhsw)->result();
        $data['show_modal_prestasi'] = true;
        $this->load->view('main/users/index_menu', $data);
    } else {
        $data_prestasi = array(
            'nama_kegiatan' => $this->input->post('nama_kegiatan'),
            'nama_pelaksana' => $this->input->post('nama_pelaksana'),
            'tingkat_kegiatan' => $this->input->post('tingkat_kegiatan'),
            'nama_pembimbing' => $this->input->post('nama_pembimbing'),
            'dana_diterima' => $this->input->post('dana_diterima'),
            'keterangan' => $this->input->post('keterangan'),
            'peringkat' => $this->input->post('peringkat'),
            'jml_negara' => $this->input->post('jml_negara'),
            'jml_pt' => $this->input->post('jml_pt'),
            'jenis_peserta' => $this->input->post('jenis_peserta'),
            'nomor_sertifikat' => $this->input->post('nomor_sertifikat'),
            'm_pelaksana' => $this->input->post('m_pelaksana'),
            'nomor_sk' => $this->input->post('nomor_sk'),
            'tanggal_mulai' => $this->input->post('tanggal_mulai'),
            'tanggal_selesai' => $this->input->post('tanggal_selesai'),
            'id_mhsw' => $id
        );

        // === Handle File Upload ===
        $this->load->library('upload');
        $upload_fields = ['sertifikat', 'foto', 'link', 'sk'];

        foreach ($upload_fields as $field) {
            if (!empty($_FILES[$field]['name'])) {
                $config['upload_path']   = './uploads/prestasi/';
                $config['allowed_types'] = ($field == 'sertifikat' || $field == 'sk') ? 'pdf' : 'jpg|jpeg|png';
                $config['max_size']      = 2048;
                $config['file_name']     = $field . '_' . time();

                $this->upload->initialize($config);

                if ($this->upload->do_upload($field)) {
                    $upload_data = $this->upload->data();
                    $data_prestasi[$field] = $upload_data['file_name'];
                } else {
                    $this->session->set_flashdata('error_save', 'Gagal upload file ' . $field . ': ' . $this->upload->display_errors());
                    redirect('profil');
                    return;
                }
            }
        }

        // Simpan ke database
        if ($this->profil_model->post_prestasi($data_prestasi)) {
            $this->session->set_flashdata('success_save', TRUE);
        } else {
            $this->session->set_flashdata('error_save', TRUE);
        }

        redirect('profil');
    }
}

    public function delete_prestasi()
    {
      $data = new stdClass();
      if ($this->profil_model->delete_prestasi($this->input->post('id'))) {
        $data->status = "success";	
        $data->id = $this->input->post('id');
      } else {
        $data->status = "failed";	
        $data->id = $this->input->post('id');	
      }
  
      $json = json_encode($data);
  
      echo $json;
    }

    public function post_karya_ilmiah($id)
    {
      $this->form_validation->set_rules('judul_karya_ilmiah', 'Judul Karya Ilmiah', 'required');
      $this->form_validation->set_rules('jenis_karya_ilmiah', 'Jenis Karya Ilmiah', 'required');
      $this->form_validation->set_rules('jenis_luaran', 'Jenis Luaran', 'required');
      $this->form_validation->set_rules('peran', 'Peran', 'required');
      $this->form_validation->set_rules('nama_jurnal', 'Nama Jurnal/Penerbit', 'required');
      $this->form_validation->set_rules('tahun', 'Tahun', 'required');
      $this->form_validation->set_rules('edisi', 'Edisi', 'required');
      $this->form_validation->set_rules('halaman', 'Halaman', 'required');
      $this->form_validation->set_rules('sumber_dana', 'Sumber Dana', 'required');
      $this->form_validation->set_rules('alamat_url_karya_ilmiah', 'Alamat URL Karya Ilmiah', 'required');
      
      $this->form_validation->set_message('required', '{field} harus terisi.');

      if ($this->form_validation->run() === FALSE) {
        $data['profil'] = $this->profil_model->get_profil_one($this->session->id_mhsw)->row();
        $data['prodi'] = $this->profil_model->get_prodi_all()->result();
        $data['content'] = 'menu/profil/index';
        $data['tab'] = 'karya-ilmiah';
        $data['pendidikan'] = $this->profil_model->get_pendidikan($this->session->id_mhsw)->result();
        $data['pekerjaan'] = $this->profil_model->get_pekerjaan($this->session->id_mhsw)->result();
        $data['jabatan'] = $this->profil_model->get_jabatan($this->session->id_mhsw)->result();
        $data['wirausaha'] = $this->profil_model->get_wirausaha($this->session->id_mhsw)->result();
        $data['seminar'] = $this->profil_model->get_seminar($this->session->id_mhsw)->result();
        $data['prestasi'] = $this->profil_model->get_prestasi($this->session->id_mhsw)->result();
        $data['karya_ilmiah'] = $this->profil_model->get_karya_ilmiah($this->session->id_mhsw)->result();
        $data['organisasi'] = $this->profil_model->get_organisasi($this->session->id_mhsw)->result();
        $data['mbkm'] = $this->profil_model->get_mbkm($this->session->id_mhsw)->result();
        $data['mbkm_luar'] = $this->profil_model->get_mbkm_luar($this->session->id_mhsw)->result();
        $data['show_modal_karya_ilmiah'] = true;
        $this->load->view('main/users/index_menu', $data);
      } else {
        $data_karya_ilmiah = array(
          'judul_karya_ilmiah' => $this->input->post('judul_karya_ilmiah'),
          'jenis_karya_ilmiah' => $this->input->post('jenis_karya_ilmiah'),
          'jenis_luaran' => $this->input->post('jenis_luaran'),
          'peran' => $this->input->post('peran'),
          'nama_jurnal' => $this->input->post('nama_jurnal'),
          'tahun' => $this->input->post('tahun'),
          'edisi' => $this->input->post('edisi'),
          'halaman' => $this->input->post('halaman'),
          'sumber_dana' => $this->input->post('sumber_dana'),
          'alamat_url_karya_ilmiah' => $this->input->post('alamat_url_karya_ilmiah'),
          'id_mhsw' => $id
        );
        
        if ($this->profil_model->post_karya_ilmiah($data_karya_ilmiah)) {
          $this->session->set_flashdata('success_save', TRUE);
        } else {
          $this->session->set_flashdata('error_save', TRUE);
        }
  
        $data['profil'] = $this->profil_model->get_profil_one($this->session->id_mhsw)->row();
        $data['prodi'] = $this->profil_model->get_prodi_all()->result();
        $data['content'] = 'menu/profil/index';
        $data['tab'] = 'karya-ilmiah';
        $data['pendidikan'] = $this->profil_model->get_pendidikan($this->session->id_mhsw)->result();
        $data['pekerjaan'] = $this->profil_model->get_pekerjaan($this->session->id_mhsw)->result();
        $data['jabatan'] = $this->profil_model->get_jabatan($this->session->id_mhsw)->result();
        $data['wirausaha'] = $this->profil_model->get_wirausaha($this->session->id_mhsw)->result();
        $data['seminar'] = $this->profil_model->get_seminar($this->session->id_mhsw)->result();
        $data['prestasi'] = $this->profil_model->get_prestasi($this->session->id_mhsw)->result();
        $data['karya_ilmiah'] = $this->profil_model->get_karya_ilmiah($this->session->id_mhsw)->result();
        $data['organisasi'] = $this->profil_model->get_organisasi($this->session->id_mhsw)->result();
        $data['mbkm'] = $this->profil_model->get_mbkm($this->session->id_mhsw)->result();
        $data['mbkm_luar'] = $this->profil_model->get_mbkm_luar($this->session->id_mhsw)->result();
        $this->load->view('main/users/index_menu', $data);
      }
    }

    public function put_karya_ilmiah($id)
    {
      $this->form_validation->set_rules('judul_karya_ilmiah', 'Judul Karya Ilmiah', 'required');
      $this->form_validation->set_rules('jenis_karya_ilmiah', 'Jenis Karya Ilmiah', 'required');
      $this->form_validation->set_rules('jenis_luaran', 'Jenis Luaran', 'required');
      $this->form_validation->set_rules('peran', 'Peran', 'required');
      $this->form_validation->set_rules('nama_jurnal', 'Nama Jurnal/Penerbit', 'required');
      $this->form_validation->set_rules('tahun', 'Tahun', 'required');
      $this->form_validation->set_rules('edisi', 'Edisi', 'required');
      $this->form_validation->set_rules('halaman', 'Halaman', 'required');
      $this->form_validation->set_rules('sumber_dana', 'Sumber Dana', 'required');
      $this->form_validation->set_rules('alamat_url_karya_ilmiah', 'Alamat URL Karya Ilmiah', 'required');
      
      $this->form_validation->set_message('required', '{field} harus terisi.');


      if ($this->form_validation->run() === FALSE) {
        $data['profil'] = $this->profil_model->get_profil_one($this->session->id_mhsw)->row();
        $data['prodi'] = $this->profil_model->get_prodi_all()->result();
        $data['content'] = 'menu/profil/index';
        $data['tab'] = 'karya-ilmiah';
        $data['pendidikan'] = $this->profil_model->get_pendidikan($this->session->id_mhsw)->result();
        $data['pekerjaan'] = $this->profil_model->get_pekerjaan($this->session->id_mhsw)->result();
        $data['jabatan'] = $this->profil_model->get_jabatan($this->session->id_mhsw)->result();
        $data['wirausaha'] = $this->profil_model->get_wirausaha($this->session->id_mhsw)->result();
        $data['seminar'] = $this->profil_model->get_seminar($this->session->id_mhsw)->result();
        $data['prestasi'] = $this->profil_model->get_prestasi($this->session->id_mhsw)->result();
        $data['karya_ilmiah'] = $this->profil_model->get_karya_ilmiah($this->session->id_mhsw)->result();
        $data['organisasi'] = $this->profil_model->get_organisasi($this->session->id_mhsw)->result();
        $data['mbkm'] = $this->profil_model->get_mbkm($this->session->id_mhsw)->result();
        $data['mbkm_luar'] = $this->profil_model->get_mbkm_luar($this->session->id_mhsw)->result();
        $data['show_modal_karya_ilmiah'] = true;
        $this->load->view('main/users/index_menu', $data);
      } else {
        $data_karya_ilmiah = array(
          'judul_karya_ilmiah' => $this->input->post('judul_karya_ilmiah'),
          'jenis_karya_ilmiah' => $this->input->post('jenis_karya_ilmiah'),
          'jenis_luaran' => $this->input->post('jenis_luaran'),
          'peran' => $this->input->post('peran'),
          'nama_jurnal' => $this->input->post('nama_jurnal'),
          'tahun' => $this->input->post('tahun'),
          'edisi' => $this->input->post('edisi'),
          'halaman' => $this->input->post('halaman'),
          'sumber_dana' => $this->input->post('sumber_dana'),
          'alamat_url_karya_ilmiah' => $this->input->post('alamat_url_karya_ilmiah'),
        );
        
        if ($this->profil_model->put_karya_ilmiah($data_karya_ilmiah, $id)) {
          $this->session->set_flashdata('success_update', TRUE);
        } else {
          $this->session->set_flashdata('error_update', TRUE);
        }
  
        $data['profil'] = $this->profil_model->get_profil_one($this->session->id_mhsw)->row();
        $data['prodi'] = $this->profil_model->get_prodi_all()->result();
        $data['content'] = 'menu/profil/index';
        $data['tab'] = 'karya-ilmiah';
        $data['pendidikan'] = $this->profil_model->get_pendidikan($this->session->id_mhsw)->result();
        $data['pekerjaan'] = $this->profil_model->get_pekerjaan($this->session->id_mhsw)->result();
        $data['jabatan'] = $this->profil_model->get_jabatan($this->session->id_mhsw)->result();
        $data['wirausaha'] = $this->profil_model->get_wirausaha($this->session->id_mhsw)->result();
        $data['seminar'] = $this->profil_model->get_seminar($this->session->id_mhsw)->result();
        $data['prestasi'] = $this->profil_model->get_prestasi($this->session->id_mhsw)->result();
        $data['karya_ilmiah'] = $this->profil_model->get_karya_ilmiah($this->session->id_mhsw)->result();
        $data['organisasi'] = $this->profil_model->get_organisasi($this->session->id_mhsw)->result();
        $data['mbkm'] = $this->profil_model->get_mbkm($this->session->id_mhsw)->result();
        $data['mbkm_luar'] = $this->profil_model->get_mbkm_luar($this->session->id_mhsw)->result();
        $this->load->view('main/users/index_menu', $data);
      }
    }
    
    public function delete_karya_ilmiah()
    {
      $data = new stdClass();
      if ($this->profil_model->delete_karya_ilmiah($this->input->post('id'))) {
        $data->status = "success";	
        $data->id = $this->input->post('id');
      } else {
        $data->status = "failed";	
        $data->id = $this->input->post('id');	
      }
  
      $json = json_encode($data);
  
      echo $json;
    }

    public function post_organisasi($id)
    {
      $this->form_validation->set_rules('nama_lembaga', 'Nama Lembaga', 'required');
      $this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
      $this->form_validation->set_rules('tanggal_bergabung', 'Tanggal Bergabung', 'required');
      
      $this->form_validation->set_message('required', '{field} harus terisi.');

      if ($this->form_validation->run() === FALSE) {
        $data['profil'] = $this->profil_model->get_profil_one($this->session->id_mhsw)->row();
        $data['prodi'] = $this->profil_model->get_prodi_all()->result();
        $data['content'] = 'menu/profil/index';
        $data['tab'] = 'karya-ilmiah';
        $data['pendidikan'] = $this->profil_model->get_pendidikan($this->session->id_mhsw)->result();
        $data['pekerjaan'] = $this->profil_model->get_pekerjaan($this->session->id_mhsw)->result();
        $data['jabatan'] = $this->profil_model->get_jabatan($this->session->id_mhsw)->result();
        $data['wirausaha'] = $this->profil_model->get_wirausaha($this->session->id_mhsw)->result();
        $data['seminar'] = $this->profil_model->get_seminar($this->session->id_mhsw)->result();
        $data['prestasi'] = $this->profil_model->get_prestasi($this->session->id_mhsw)->result();
        $data['karya_ilmiah'] = $this->profil_model->get_karya_ilmiah($this->session->id_mhsw)->result();
        $data['organisasi'] = $this->profil_model->get_organisasi($this->session->id_mhsw)->result();
        $data['mbkm'] = $this->profil_model->get_mbkm($this->session->id_mhsw)->result();
        $data['mbkm_luar'] = $this->profil_model->get_mbkm_luar($this->session->id_mhsw)->result();
        $data['show_modal_organisasi'] = true;
        $this->load->view('main/users/index_menu', $data);
      } else {
        $tanggal_bergabung = explode("/",$this->input->post('tanggal_bergabung'));
        $tanggal_bergabung_data = $tanggal_bergabung[2]."-".$tanggal_bergabung[1]."-".$tanggal_bergabung[0];
        $data_organisasi = array(
          'nama_lembaga' => $this->input->post('nama_lembaga'),
          'jabatan' => $this->input->post('jabatan'),
          'tanggal_bergabung' => $tanggal_bergabung_data,
          'id_mhsw' => $id
        );
        
        if ($this->profil_model->post_organisasi($data_organisasi)) {
          $this->session->set_flashdata('success_save', TRUE);
        } else {
          $this->session->set_flashdata('error_save', TRUE);
        }
  
        $data['profil'] = $this->profil_model->get_profil_one($this->session->id_mhsw)->row();
        $data['prodi'] = $this->profil_model->get_prodi_all()->result();
        $data['content'] = 'menu/profil/index';
        $data['tab'] = 'organisasi';
        $data['pendidikan'] = $this->profil_model->get_pendidikan($this->session->id_mhsw)->result();
        $data['pekerjaan'] = $this->profil_model->get_pekerjaan($this->session->id_mhsw)->result();
        $data['jabatan'] = $this->profil_model->get_jabatan($this->session->id_mhsw)->result();
        $data['wirausaha'] = $this->profil_model->get_wirausaha($this->session->id_mhsw)->result();
        $data['seminar'] = $this->profil_model->get_seminar($this->session->id_mhsw)->result();
        $data['prestasi'] = $this->profil_model->get_prestasi($this->session->id_mhsw)->result();
        $data['karya_ilmiah'] = $this->profil_model->get_karya_ilmiah($this->session->id_mhsw)->result();
        $data['organisasi'] = $this->profil_model->get_organisasi($this->session->id_mhsw)->result();
        $data['mbkm'] = $this->profil_model->get_mbkm($this->session->id_mhsw)->result();
        $data['mbkm_luar'] = $this->profil_model->get_mbkm_luar($this->session->id_mhsw)->result();
        $this->load->view('main/users/index_menu', $data);
      }
    }

    public function put_organisasi($id)
    {
      $this->form_validation->set_rules('nama_lembaga', 'Nama Lembaga', 'required');
      $this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
      $this->form_validation->set_rules('tanggal_bergabung', 'Tanggal Bergabung', 'required');
      
      $this->form_validation->set_message('required', '{field} harus terisi.');


      if ($this->form_validation->run() === FALSE) {
        $data['profil'] = $this->profil_model->get_profil_one($this->session->id_mhsw)->row();
        $data['prodi'] = $this->profil_model->get_prodi_all()->result();
        $data['content'] = 'menu/profil/index';
        $data['tab'] = 'karya-ilmiah';
        $data['pendidikan'] = $this->profil_model->get_pendidikan($this->session->id_mhsw)->result();
        $data['pekerjaan'] = $this->profil_model->get_pekerjaan($this->session->id_mhsw)->result();
        $data['jabatan'] = $this->profil_model->get_jabatan($this->session->id_mhsw)->result();
        $data['wirausaha'] = $this->profil_model->get_wirausaha($this->session->id_mhsw)->result();
        $data['seminar'] = $this->profil_model->get_seminar($this->session->id_mhsw)->result();
        $data['prestasi'] = $this->profil_model->get_prestasi($this->session->id_mhsw)->result();
        $data['karya_ilmiah'] = $this->profil_model->get_karya_ilmiah($this->session->id_mhsw)->result();
        $data['organisasi'] = $this->profil_model->get_organisasi($this->session->id_mhsw)->result();
        $data['mbkm'] = $this->profil_model->get_mbkm($this->session->id_mhsw)->result();
        $data['mbkm_luar'] = $this->profil_model->get_mbkm_luar($this->session->id_mhsw)->result();
        $data['show_modal_organisasi'] = true;
        $this->load->view('main/users/index_menu', $data);
      } else {
        $tanggal_bergabung = explode("/",$this->input->post('tanggal_bergabung'));
        $tanggal_bergabung_data = $tanggal_bergabung[2]."-".$tanggal_bergabung[1]."-".$tanggal_bergabung[0];
        $data_organisasi = array(
          'nama_lembaga' => $this->input->post('nama_lembaga'),
          'jabatan' => $this->input->post('jabatan'),
          'tanggal_bergabung' => $tanggal_bergabung_data,
        );
        
        if ($this->profil_model->put_organisasi($data_organisasi, $id)) {
          $this->session->set_flashdata('success_update', TRUE);
        } else {
          $this->session->set_flashdata('error_update', TRUE);
        }
  
        $data['profil'] = $this->profil_model->get_profil_one($this->session->id_mhsw)->row();
        $data['prodi'] = $this->profil_model->get_prodi_all()->result();
        $data['content'] = 'menu/profil/index';
        $data['tab'] = 'organisasi';
        $data['pendidikan'] = $this->profil_model->get_pendidikan($this->session->id_mhsw)->result();
        $data['pekerjaan'] = $this->profil_model->get_pekerjaan($this->session->id_mhsw)->result();
        $data['jabatan'] = $this->profil_model->get_jabatan($this->session->id_mhsw)->result();
        $data['wirausaha'] = $this->profil_model->get_wirausaha($this->session->id_mhsw)->result();
        $data['seminar'] = $this->profil_model->get_seminar($this->session->id_mhsw)->result();
        $data['prestasi'] = $this->profil_model->get_prestasi($this->session->id_mhsw)->result();
        $data['karya_ilmiah'] = $this->profil_model->get_karya_ilmiah($this->session->id_mhsw)->result();
        $data['organisasi'] = $this->profil_model->get_organisasi($this->session->id_mhsw)->result();
        $data['mbkm'] = $this->profil_model->get_mbkm($this->session->id_mhsw)->result();
        $data['mbkm_luar'] = $this->profil_model->get_mbkm_luar($this->session->id_mhsw)->result();
        $this->load->view('main/users/index_menu', $data);
      }
    }
    
    public function delete_organisasi()
    {
      $data = new stdClass();
      if ($this->profil_model->delete_organisasi($this->input->post('id'))) {
        $data->status = "success";	
        $data->id = $this->input->post('id');
      } else {
        $data->status = "failed";	
        $data->id = $this->input->post('id');	
      }
  
      $json = json_encode($data);
  
      echo $json;
    }

    public function setting($id)
    {
      $this->form_validation->set_rules('old_password', 'Password Lama', 'required');
      $this->form_validation->set_rules('new_password', 'Password Baru', 'required');
      
      $this->form_validation->set_message('required', '{field} harus terisi.');
      
      if ($this->form_validation->run() === FALSE) {
        $data['profil'] = $this->profil_model->get_profil_one($this->session->id_mhsw)->row();
        $data['prodi'] = $this->profil_model->get_prodi_all()->result();
        $data['content'] = 'menu/profil/index';
        $data['tab'] = 'setting';
        $data['pendidikan'] = $this->profil_model->get_pendidikan($this->session->id_mhsw)->result();
        $data['pekerjaan'] = $this->profil_model->get_pekerjaan($this->session->id_mhsw)->result();
        $data['jabatan'] = $this->profil_model->get_jabatan($this->session->id_mhsw)->result();
        $data['wirausaha'] = $this->profil_model->get_wirausaha($this->session->id_mhsw)->result();
        $data['seminar'] = $this->profil_model->get_seminar($this->session->id_mhsw)->result();
        $data['prestasi'] = $this->profil_model->get_prestasi($this->session->id_mhsw)->result();
        $data['karya_ilmiah'] = $this->profil_model->get_karya_ilmiah($this->session->id_mhsw)->result();
        $data['organisasi'] = $this->profil_model->get_organisasi($this->session->id_mhsw)->result();
        $data['mbkm'] = $this->profil_model->get_mbkm($this->session->id_mhsw)->result();
        $data['mbkm_luar'] = $this->profil_model->get_mbkm_luar($this->session->id_mhsw)->result();
        $this->load->view('main/users/index_menu', $data);
      } else {
        $cek_login = $this->profil_model->get_user_one($this->session->id)->row();
        if (password_verify($this->input->post('old_password'), $cek_login->password)) {
          $data_setting = array(
            'password' => password_hash($this->input->post('new_password'), PASSWORD_DEFAULT),
          );
          
          if ($this->profil_model->put_setting($data_setting, $this->session->id)) {
            $this->session->set_flashdata('success_save', TRUE);
          } else {
            $this->session->set_flashdata('error_save', TRUE);
          }
    
          $data['profil'] = $this->profil_model->get_profil_one($this->session->id_mhsw)->row();
          $data['prodi'] = $this->profil_model->get_prodi_all()->result();
          $data['content'] = 'menu/profil/index';
          $data['tab'] = 'setting';
          $data['pendidikan'] = $this->profil_model->get_pendidikan($this->session->id_mhsw)->result();
          $data['pekerjaan'] = $this->profil_model->get_pekerjaan($this->session->id_mhsw)->result();
          $data['jabatan'] = $this->profil_model->get_jabatan($this->session->id_mhsw)->result();
          $data['wirausaha'] = $this->profil_model->get_wirausaha($this->session->id_mhsw)->result();
          $data['seminar'] = $this->profil_model->get_seminar($this->session->id_mhsw)->result();
          $data['prestasi'] = $this->profil_model->get_prestasi($this->session->id_mhsw)->result();
          $data['karya_ilmiah'] = $this->profil_model->get_karya_ilmiah($this->session->id_mhsw)->result();
          $data['organisasi'] = $this->profil_model->get_organisasi($this->session->id_mhsw)->result();
          $data['mbkm'] = $this->profil_model->get_mbkm($this->session->id_mhsw)->result();
          $data['mbkm_luar'] = $this->profil_model->get_mbkm_luar($this->session->id_mhsw)->result();
          $this->load->view('main/users/index_menu', $data);
        } else {
          $data['profil'] = $this->profil_model->get_profil_one($this->session->id_mhsw)->row();
          $data['prodi'] = $this->profil_model->get_prodi_all()->result();
          $data['content'] = 'menu/profil/index';
          $data['tab'] = 'setting';
          $data['pendidikan'] = $this->profil_model->get_pendidikan($this->session->id_mhsw)->result();
          $data['pekerjaan'] = $this->profil_model->get_pekerjaan($this->session->id_mhsw)->result();
          $data['jabatan'] = $this->profil_model->get_jabatan($this->session->id_mhsw)->result();
          $data['wirausaha'] = $this->profil_model->get_wirausaha($this->session->id_mhsw)->result();
          $data['seminar'] = $this->profil_model->get_seminar($this->session->id_mhsw)->result();
          $data['prestasi'] = $this->profil_model->get_prestasi($this->session->id_mhsw)->result();
          $data['karya_ilmiah'] = $this->profil_model->get_karya_ilmiah($this->session->id_mhsw)->result();
          $data['organisasi'] = $this->profil_model->get_organisasi($this->session->id_mhsw)->result();
          $data['mbkm'] = $this->profil_model->get_mbkm($this->session->id_mhsw)->result();
          $data['mbkm_luar'] = $this->profil_model->get_mbkm_luar($this->session->id_mhsw)->result();
          $data['error'] = 'Password yang dimasukkan salah';		 
          $this->load->view('main/users/index_menu', $data);
        }
      }
    }

    public function download()
    {
      $biodata = $this->profil_model->get_profil_one($this->session->id_mhsw)->row();

      $tanggal_lahir = "";
      if($biodata->tanggal_lahir == NULL || $biodata->tanggal_lahir == "0000-00-00") {
        $tanggal_lahir = "";
      } else {
        $tanggal_lahir = $this->tgl_indo($biodata->tanggal_lahir);
      }

      $jk = "";
      if ($biodata->jenis_kelamin == "L") {
        $jk = "Laki-Laki";
      } else {
        $jk = "Perempuan";
      }

      $nim = "";
      if ($this->session->level != "Alumni") {
        $nim = "<tr>
                <td>NIM/Stambuk</td>
                <td>".$biodata->nim."</td>
              </tr>";
      }

      $pendidikan = "";
      if ($this->input->post('pendidikan') == "pendidikan") {
        $pendidikan = '
          <li style="font-weight: bold; font-size: 18px">Riwayat Pendidikan</li>
          <div style="margin-top: 20px; margin-bottom: 40px">
            <table id="mbkm">
              <tr>
                <th>No.</th>
                <th>Jenjang</th>
                <th>Bidang Ilmu (Konsentrasi)</th>
                <th>Tahun Masuk-Lulus</th>
                <th>Judul Skripsi/Tesis/Disertasi</th>
                <th>Nama Pembimbing</th>
              </tr>';
              $data_pendidikan = $this->profil_model->get_pendidikan($this->session->id_mhsw)->result();
              $i = 1;
              foreach ($data_pendidikan as $show) {
                $dosen_pembimbing = explode(';', $show->dosen_pembimbing);
                $tahun_masuk =  date('Y', strtotime($show->tanggal_masuk));
                $tahun_lulus =  date('Y', strtotime($show->tanggal_yudisium));
                $tanggal_berhenti = "";
                if($show->tanggal_yudisium == "0000-00-00" || $show->tanggal_yudisium == NULL) {
                  $tahun_lulus = "Masih Aktif";
                } else {
                  $tahun_lulus =  date('Y', strtotime($show->tanggal_yudisium));
                }
                $pendidikan .= '<tr>
                  <td style="text-align: center">'.$i.'</td>
                  <td>'.$show->jenjang.'</td>
                  <td>'.$show->prodi.' ('.$show->konsentrasi.')</td>
                  <td>'.$tahun_masuk.' - '.$tahun_lulus.'</td>
                  <td>'.$show->tugas_akhir.'</td>
                  <td>
                    <ol>';
                foreach ($dosen_pembimbing as $show_dosen) {
                  $pendidikan .= '<li>'.$show_dosen.'</li>';
                }
                $pendidikan .= '</ol>
                  </td>
                </tr>';
                $i++;
              }
        $pendidikan .= '</table>
          </div>
        ';
      }

      $pekerjaan = "";
      if ($this->input->post('pekerjaan') == "pekerjaan") {
        $pekerjaan = '
          <li style="font-weight: bold; font-size: 18px">Riwayat Pekerjaan</li>
          <div style="margin-top: 20px; margin-bottom: 40px">
            <table id="mbkm">
              <tr>
                <th>No.</th>
                <th>Nama Instansi</th>
                <th>Tanggal Masuk - Berhenti</th>
                <th>Jabatan</th>
                <th>Alamat</th>
              </tr>';
              $data_pekerjaan = $this->profil_model->get_pekerjaan($this->session->id_mhsw)->result();
              $i = 1;
              foreach ($data_pekerjaan as $show) {
                $tanggal_berhenti = "";
                if($show->tanggal_berhenti == "0000-00-00") {
                  $tanggal_berhenti = "Sampai Sekarang";
                } else {
                  $tanggal_berhenti = $this->tgl_indo($show->tanggal_berhenti);
                }
                $pekerjaan .= '<tr>
                  <td style="text-align: center">'.$i.'</td>
                  <td>'.$show->nama_perusahaan.'</td>
                  <td>'.$this->tgl_indo($show->tanggal_masuk).' - '.$tanggal_berhenti.'</td>
                  <td>'.$show->jabatan.'</td>
                  <td>'.$show->alamat.'</td>
                </tr>';
                $i++;
              }
        $pekerjaan .= '</table>
          </div>
        ';
      }

      $jabatan = "";
      if ($this->input->post('jabatan') == "jabatan") {
        $jabatan = '
          <li style="font-weight: bold; font-size: 18px">Riwayat Jabatan</li>
          <div style="margin-top: 20px; margin-bottom: 40px">
            <table id="mbkm">
              <tr>
                <th>No.</th>
                <th>Nama Instansi</th>
                <th>Tanggal Mulai - Selesai</th>
                <th>Jabatan</th>
                <th>Alamat</th>
              </tr>';
              $data_jabatan = $this->profil_model->get_jabatan($this->session->id_mhsw)->result();
              $i = 1;
              foreach ($data_jabatan as $show) {
                $tanggal_selesai = "";
                if($show->tanggal_selesai == "0000-00-00") {
                  $tanggal_selesai = "Sampai Sekarang";
                } else {
                  $tanggal_selesai = $this->tgl_indo($show->tanggal_selesai);
                }
                $jabatan .= '<tr>
                  <td style="text-align: center">'.$i.'</td>
                  <td>'.$show->instansi.'</td>
                  <td>'.$this->tgl_indo($show->tanggal_mulai).' - '.$tanggal_selesai.'</td>
                  <td>'.$show->jabatan.'</td>
                  <td>'.$show->alamat.'</td>
                </tr>';
                $i++;
              }
        $jabatan .= '</table>
          </div>
        ';
      }

      $wirausaha = "";
      if ($this->input->post('wirausaha') == "wirausaha") {
        $wirausaha = '
          <li style="font-weight: bold; font-size: 18px">Riwayat Wirausaha</li>
          <div style="margin-top: 20px; margin-bottom: 40px">
            <table id="mbkm">
              <tr>
                <th>No.</th>
                <th>Nama Usaha</th>
                <th>Jenis Usaha</th>
                <th>Tanggal Mulai - Selesai</th>
                <th>Rata-rata Omset</th>
                <th>Alamat Usaha</th>
              </tr>';
              $data_wirausaha = $this->profil_model->get_wirausaha($this->session->id_mhsw)->result();
              $i = 1;
              foreach ($data_wirausaha as $show) {
                $tanggal_selesai = "";
                if($show->tanggal_selesai == "0000-00-00") {
                  $tanggal_selesai = "Sampai Sekarang";
                } else {
                  $tanggal_selesai = $this->tgl_indo($show->tanggal_selesai);
                }
                $wirausaha .= '<tr>
                  <td style="text-align: center">'.$i.'</td>
                  <td>'.$show->nama_usaha.'</td>
                  <td>'.$show->jenis_usaha.'</td>
                  <td>'.$this->tgl_indo($show->tanggal_mulai).' - '.$tanggal_selesai.'</td>
                  <td>Rp. '.number_format($show->rata_rata_omset,0,', -','.').'</td>
                  <td>'.$show->alamat_usaha.'</td>
                </tr>';
                $i++;
              }
        $wirausaha .= '</table>
          </div>
        ';
      }

      $seminar = "";
      if ($this->input->post('seminar') == "seminar") {
        $seminar = '
          <li style="font-weight: bold; font-size: 18px">Riwayat Seminar/Pelatihan/Sertifikasi</li>
          <div style="margin-top: 20px; margin-bottom: 40px">
            <table id="mbkm">
              <tr>
                <th>No.</th>
                <th>Nama Kegiatan</th>
                <th>Pelaksana Kegiatan</th>
                <th>Jenis Kegiatan</th>
                <th>Tingkat Kegiatan</th>
                <th>Peran</th>
                <th>Tanggal Mulai - Selesai</th>
                <th>Keterangan</th>
              </tr>';
              $data_seminar = $this->profil_model->get_seminar($this->session->id_mhsw)->result();
              $i = 1;
              foreach ($data_seminar as $show) {
                $tanggal_selesai = "";
                if($show->tanggal_selesai == "0000-00-00") {
                  $tanggal_selesai = "Sampai Sekarang";
                } else {
                  $tanggal_selesai = $this->tgl_indo($show->tanggal_selesai);
                }
                $seminar .= '<tr>
                  <td style="text-align: center">'.$i.'</td>
                  <td>'.$show->nama_kegiatan.'</td>
                  <td>'.$show->pelaksana_kegiatan.'</td>
                  <td>'.$show->jenis_kegiatan.'</td>
                  <td>'.$show->tingkat_kegiatan.'</td>
                  <td>'.$show->peran.'</td>
                  <td>'.$this->tgl_indo($show->tanggal_mulai).' - '.$tanggal_selesai.'</td>
                  <td>'.$show->keterangan.'</td>
                </tr>';
                $i++;
              }
        $seminar .= '</table>
          </div>
        ';
      }

      $prestasi = "";
      if ($this->input->post('prestasi') == "prestasi") {
        $prestasi = '
          <li style="font-weight: bold; font-size: 18px">Riwayat Prestasi/Hibah</li>
          <div style="margin-top: 20px; margin-bottom: 40px">
            <table id="mbkm">
              <tr>
                <th>No.</th>
                <th>Nama Kegiatan</th>
                <th>Nama Pelaksana</th>
                <th>Tingkat Kegiatan</th>
                <th>Nama Pembimbing/Anggota Lainnya</th>
                <th>Dana Diterima</th>
                <th>Keterangan</th>
              </tr>';
              $data_prestasi = $this->profil_model->get_prestasi($this->session->id_mhsw)->result();
              $i = 1;
              foreach ($data_prestasi as $show) {
                $pembimbing = explode(';', $show->nama_pembimbing);
                $prestasi .= '<tr>
                  <td style="text-align: center">'.$i.'</td>
                  <td>'.$show->nama_kegiatan.'</td>
                  <td>'.$show->nama_pelaksana.'</td>
                  <td>'.$show->tingkat_kegiatan.'</td>
                  <td>    
                    <ol>';
                    foreach ($pembimbing as $show_pembimbing) {
                      $prestasi .= '<li>'.$show_pembimbing.'</li>';
                    }
                $prestasi .= '</ol>
                  </td>
                  <td>Rp. '.number_format($show->dana_diterima,0,', -','.').'</td>
                  <td>'.$show->keterangan.'</td>
                </tr>';
                $i++;
              }
        $prestasi .= '</table>
          </div>
        ';
      }

      $karya_ilmiah = "";
      if ($this->input->post('karya_ilmiah') == "karya_ilmiah") {
        $karya_ilmiah = '
          <li style="font-weight: bold; font-size: 18px">Riwayat Karya Ilmiah</li>
          <div style="margin-top: 20px; margin-bottom: 40px">
            <table id="mbkm">
              <tr>
                <th>No.</th>
                <th>Judul Karya Ilmiah</th>
                <th>Jenis Karya Ilmiah</th>
                <th>Peran</th>
                <th>Nama Jurnal/Penerbit</th>
                <th>Tahun</th>
                <th>Edisi</th>
                <th>Halaman</th>
                <th>Sumber Dana</th>
              </tr>';
              $data_karya_ilmiah = $this->profil_model->get_karya_ilmiah($this->session->id_mhsw)->result();
              $i = 1;
              foreach ($data_karya_ilmiah as $show) {
                $karya_ilmiah .= '<tr>
                  <td style="text-align: center">'.$i.'</td>
                  <td>'.$show->judul_karya_ilmiah.'</td>
                  <td>'.$show->jenis_karya_ilmiah.'</td>
                  <td>'.$show->peran.'</td>
                  <td>'.$show->nama_jurnal.'</td>
                  <td>'.$show->tahun.'</td>
                  <td>'.$show->edisi.'</td>
                  <td>'.$show->halaman.'</td>
                  <td>'.$show->sumber_dana.'</td>
                </tr>';
                $i++;
              }
        $karya_ilmiah .= '</table>
          </div>
        ';
      }

      $organisasi = "";
      if ($this->input->post('organisasi') == "organisasi") {
        $organisasi = '
          <li style="font-weight: bold; font-size: 18px">Riwayat Organisasi</li>
          <div style="margin-top: 20px; margin-bottom: 40px">
            <table id="mbkm">
              <tr>
                <th>No.</th>
                <th>Nama Lembaga</th>
                <th>Jabatan</th>
                <th>Tanggal Bergabung</th>
              </tr>';
              $data_organisasi = $this->profil_model->get_organisasi($this->session->id_mhsw)->result();
              $i = 1;
              foreach ($data_organisasi as $show) {
                $organisasi .= '<tr>
                  <td style="text-align: center">'.$i.'</td>
                  <td>'.$show->nama_lembaga.'</td>
                  <td>'.$show->jabatan.'</td>
                  <td>'.$this->tgl_indo($show->tanggal_bergabung).'</td>
                </tr>';
                $i++;
              }
        $organisasi .= '</table>
          </div>
        ';
      }
      
      $dompdf = new Dompdf();
      $dompdf->loadHtml('
      <!DOCTYPE html>
        <html lang="en">
          <head>
            <meta charset="UTF-8" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <style>
              #mbkm {
                margin-left: -20px;
                font-family: Arial, Helvetica, sans-serif;
                border-collapse: collapse;
                width: 100%;
              }

              #mbkm td,
              #mbkm th {
                border: 1px solid #ddd;
                padding: 8px;
              }

              #mbkm tr:nth-child(even) {
                background-color: #f2f2f2;
              }

              #mbkm tr:hover {
                background-color: #ddd;
              }

              #mbkm th {
                padding-top: 12px;
                padding-bottom: 12px;
                text-align: left;
                background-color: #04aa6d;
                color: white;
              }
            </style>
          </head>
          <body>
            <h3 style="text-align: center">CURRICULUM VITAE</h3>
            <ol type="A">
              <li style="font-weight: bold; font-size: 18px">Identitas Diri</li>
              <div style="margin-top: 20px; margin-bottom: 40px">
                <table id="mbkm">
                  <tr>
                    <th width="35%">Nama Lengkap</th>
                    <th>'.$biodata->nama.'</th>
                  </tr>
                  <tr>
                    <td>Jenis Kelamin</td>
                    <td>'.$jk.'</td>
                  </tr>
                  <tr>
                    <td>Nomor Induk Kependudukan</td>
                    <td>'.$biodata->nik.'</td>
                  </tr>
                  '.$nim.'
                  <tr>
                    <td>Tempat Tanggal Lahir</td>
                    <td>'.$biodata->tempat_lahir.', '.$tanggal_lahir.'</td>
                  </tr>
                  <tr>
                    <td>Agama</td>
                    <td>'.$biodata->agama.'</td>
                  </tr>
                  <tr>
                    <td>Nomor HP</td>
                    <td>'.$biodata->no_hp.'</td>
                  </tr>
                  <tr>
                    <td>Status Pernikahan</td>
                    <td>'.$biodata->status_pernikahan.'</td>
                  </tr>
                  <tr>
                    <td>Alamat</td>
                    <td>'.$biodata->alamat.'</td>
                  </tr>
                </table>
              </div>
              '.$pendidikan.'
              '.$pekerjaan.'
              '.$jabatan.'
              '.$wirausaha.'
              '.$seminar.'
              '.$prestasi.'
              '.$karya_ilmiah.'
              '.$organisasi.'
            </ol>
            <p style="margin-left: 20px">
              Demikian daftar riwayat hidup ini dibuat dengan sebenar-benarnya.
              Berdasarkan data yang diperoleh dari website
              https://mbkm.fekon.untad.ac.id/
            </p>
            <table style="width: 100%">
              <tr>
                <td width="65%"></td>
                <td>Palu, '.$this->tgl_indo(date("Y-m-d")).'</td>
              </tr>
              <tr>
                <td width="65%"></td>
                <td>Hormat Saya,</td>
              </tr>
              <tr>
                <td width="65%" style="height: 60px"></td>
                <td></td>
              </tr>
              <tr>
                <td width="65%"></td>
                <td>
                  <b><u>'.$biodata->nama.'</u></b>
                </td>
              </tr>
            </table>
          </body>
        </html>
      ');

      // (Optional) Setup the paper size and orientation
      $dompdf->setPaper('A4', 'potrait');

      // Render the HTML as PDF
      $dompdf->render();

      // Output the generated PDF to Browser
      $dompdf->stream();
    }
  }
?>
