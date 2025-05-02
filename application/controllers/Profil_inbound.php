<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  use Dompdf\Dompdf;

  class Profil_inbound extends CI_Controller {
    function __construct(){
      parent::__construct();
      $this->load->model("profil_model");
      date_default_timezone_set("Asia/Makassar");
    }

    public function index()
    {
      $data['profil'] = $this->profil_model->get_profil_inbound_one($this->session->id)->row();
      $data['prodi'] = $this->profil_model->get_prodi_all()->result();
      $data['content'] = 'menu/profil_inbound/index';
      $data['tab'] = 'biodata';
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
      $this->form_validation->set_rules('stambuk_asal', 'Nomor Stambuk Asal', 'required');
      $this->form_validation->set_rules('no_hp', 'Nomor HP', 'required');
      $this->form_validation->set_rules('alamat', 'Alamat', 'required');
      $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required');
      $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
      $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
      $this->form_validation->set_rules('agama', 'Agama', 'required');
      $this->form_validation->set_rules('status_pernikahan', 'Status Pernikahan', 'required');
			$this->form_validation->set_rules('universitas_asal', 'Universitas Asal', 'required');
			$this->form_validation->set_rules('fakultas_asal', 'Fakultas Asal', 'required');
			$this->form_validation->set_rules('prodi_asal', 'Prodi Asal', 'required');
      
      $this->form_validation->set_message('required', '{field} harus terisi.');

      if ($this->form_validation->run() === FALSE) {
        $data['profil'] = $this->profil_model->get_profil_inbound_one($this->session->id)->row();
        $data['prodi'] = $this->profil_model->get_prodi_all()->result();
        $data['content'] = 'menu/profil_inbound/index';
        $data['tab'] = 'biodata';
        $this->load->view('main/users/index_menu', $data);
      } else {
        $tanggal_lahir = explode("/",$this->input->post('tanggal_lahir'));
        $tanggal_lahir_data = $tanggal_lahir[2]."-".$tanggal_lahir[1]."-".$tanggal_lahir[0];

        $data = array(
          'nama' => $this->input->post('nama'),
          'nik' => $this->input->post('nik'),
          'stambuk_asal' => $this->input->post('stambuk_asal'),
          'no_hp' => $this->input->post('no_hp'),
          'alamat' => $this->input->post('alamat'),
          'tempat_lahir' => $this->input->post('tempat_lahir'),
          'tanggal_lahir' => $tanggal_lahir_data,
          'jenis_kelamin' => $this->input->post('jenis_kelamin'),
          'agama' => $this->input->post('agama'),
          'status_pernikahan' => $this->input->post('status_pernikahan'),
          'universitas_asal' => $this->input->post('universitas_asal'),
          'fakultas_asal' => $this->input->post('fakultas_asal'),
          'prodi_asal' => $this->input->post('prodi_asal'),
        );
        
        if ($this->profil_model->put_inbound($data, $id)) {
          $this->session->set_flashdata('success_update', TRUE);
        } else {
          $this->session->set_flashdata('error_update', TRUE);
        }
  
        redirect('/profil_inbound');
      }
    }

    public function setting($id)
    {
      $this->form_validation->set_rules('old_password', 'Password Lama', 'required');
      $this->form_validation->set_rules('new_password', 'Password Baru', 'required');
      
      $this->form_validation->set_message('required', '{field} harus terisi.');
      
      if ($this->form_validation->run() === FALSE) {
        $data['tab'] = 'setting';
        $data['profil'] = $this->profil_model->get_profil_inbound_one($this->session->id)->row();
        $data['prodi'] = $this->profil_model->get_prodi_all()->result();
        $data['content'] = 'menu/profil_inbound/index';
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
    
          $data['tab'] = 'setting';
          $data['profil'] = $this->profil_model->get_profil_inbound_one($this->session->id)->row();
          $data['prodi'] = $this->profil_model->get_prodi_all()->result();
          $data['content'] = 'menu/profil_inbound/index';
          $this->load->view('main/users/index_menu', $data);
        } else {
          $data['tab'] = 'setting';
          $data['profil'] = $this->profil_model->get_profil_inbound_one($this->session->id)->row();
          $data['prodi'] = $this->profil_model->get_prodi_all()->result();
          $data['content'] = 'menu/profil_inbound/index';
          $data['error'] = 'Password yang dimasukkan salah';	
          $this->load->view('main/users/index_menu', $data);
        }
      }
    }
  }
?>
