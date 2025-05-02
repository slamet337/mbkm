<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  use Dompdf\Dompdf;

  class Profil_mitra extends CI_Controller {
    function __construct(){
      parent::__construct();
      $this->load->model("profil_mitra_model");
      date_default_timezone_set("Asia/Makassar");
    }

    public function index()
    {
      $data['profil'] = $this->profil_mitra_model->get_profil_mitra($this->session->id_mitra)->row();
      $data['content'] = 'profil_mitra/index';
      $data['tab'] = 'data_mitra';
      $this->load->view('main/admin/index', $data);
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
      $this->form_validation->set_rules('nama_mitra', 'Nama Mitra', 'required');
      $this->form_validation->set_rules('kriteria_mitra', 'Kriteria Mitra', 'required');
      $this->form_validation->set_rules('email', 'Email', 'required');
      $this->form_validation->set_rules('phone_number', 'Nomor HP', 'required');
      $this->form_validation->set_rules('partisipasi_dalam_kurikulum', 'Pilihan Berpartisi Dalam Penyusunan Kurikulum', 'required');
      $this->form_validation->set_rules('alamat', 'Alamat', 'required');

      $this->form_validation->set_message('required', '{field} harus terisi.');

      if ($this->form_validation->run() === FALSE) {
        $data['profil'] = $this->profil_mitra_model->get_profil_mitra($this->session->id_mitra)->row();
        $data['content'] = 'profil_mitra/index';
        $data['tab'] = 'data_mitra';
        $this->load->view('main/admin/index', $data);
      } else {
        $data = array(
          'nama_mitra' => $this->input->post('nama_mitra'),
          'kriteria_mitra' => $this->input->post('kriteria_mitra'),
          'email' => $this->input->post('email'),
          'phone_number' => $this->input->post('phone_number'),
          'partisipasi_dalam_kurikulum' => $this->input->post('partisipasi_dalam_kurikulum'),
          'alamat' => $this->input->post('alamat'),
        );
        
        if ($this->profil_mitra_model->put($data, $id)) {
          $this->session->set_flashdata('success_update', TRUE);
        } else {
          $this->session->set_flashdata('error_update', TRUE);
        }
  
        redirect('/admin/profil_mitra');
      }
    }

    public function update_cp($id)
    {
      $this->form_validation->set_rules('nama_cp', 'Nama Kontak', 'required');
      $this->form_validation->set_rules('jabatan_cp', 'Jabatan', 'required');
      $this->form_validation->set_rules('email_cp', 'Email', 'required');
      $this->form_validation->set_rules('phone_number_cp', 'Nomor HP Kontak', 'required');

      $this->form_validation->set_message('required', '{field} harus terisi.');

      if ($this->form_validation->run() === FALSE) {
        $data['profil'] = $this->profil_mitra_model->get_profil_mitra($this->session->id_mitra)->row();
        $data['content'] = 'profil_mitra/index';
        $data['tab'] = 'contact-person';
        $this->load->view('main/admin/index', $data);
      } else {
        $data = array(
          'nama_cp' => $this->input->post('nama_cp'),
          'jabatan_cp' => $this->input->post('jabatan_cp'),
          'email_cp' => $this->input->post('email_cp'),
          'phone_number_cp' => $this->input->post('phone_number_cp'),
        );
        
        if ($this->profil_mitra_model->put($data, $id)) {
          $this->session->set_flashdata('success_update', TRUE);
        } else {
          $this->session->set_flashdata('error_update', TRUE);
        }
  
        $data['profil'] = $this->profil_mitra_model->get_profil_mitra($this->session->id_mitra)->row();
        $data['content'] = 'profil_mitra/index';
        $data['tab'] = 'contact-person';
        $this->load->view('main/admin/index', $data);
      }
    }

    public function update_kerjasama($id)
    {
      $this->form_validation->set_rules('no_moa', 'Nomor', 'required');
      $this->form_validation->set_rules('tanggal_mulai_moa', 'Tanggal Mulai', 'required');
      $this->form_validation->set_rules('tanggal_berakhir_moa', 'Tanggal Berakhir', 'required');

      $this->form_validation->set_message('required', '{field} harus terisi.');

      if ($this->form_validation->run() === FALSE) {
        $data['profil'] = $this->profil_mitra_model->get_profil_mitra($this->session->id_mitra)->row();
        $data['content'] = 'profil_mitra/index';
        $data['tab'] = 'perjanjian_kerjasama';
        $this->load->view('main/admin/index', $data);
      } else {
        $tanggal_mulai_moa = explode("/",$this->input->post('tanggal_mulai_moa'));
        $tanggal_mulai_moa_data = $tanggal_mulai_moa[2]."-".$tanggal_mulai_moa[1]."-".$tanggal_mulai_moa[0];
        $tanggal_berakhir_moa = explode("/",$this->input->post('tanggal_berakhir_moa'));
        $tanggal_berakhir_moa_data = $tanggal_berakhir_moa[2]."-".$tanggal_berakhir_moa[1]."-".$tanggal_berakhir_moa[0];

        $data = array(
          'no_moa' => $this->input->post('no_moa'),
          'tanggal_mulai_moa' => $tanggal_mulai_moa_data,
          'tanggal_berakhir_moa' => $tanggal_berakhir_moa_data,
        );
        
        if ($this->profil_mitra_model->put($data, $id)) {
          $this->session->set_flashdata('success_update', TRUE);
        } else {
          $this->session->set_flashdata('error_update', TRUE);
        }
  
        $data['profil'] = $this->profil_mitra_model->get_profil_mitra($this->session->id_mitra)->row();
        $data['content'] = 'profil_mitra/index';
        $data['tab'] = 'perjanjian_kerjasama';
        $this->load->view('main/admin/index', $data);
      }
    }

    public function setting($id)
    {
      $this->form_validation->set_rules('old_password', 'Password Lama', 'required');
      $this->form_validation->set_rules('new_password', 'Password Baru', 'required');
      
      $this->form_validation->set_message('required', '{field} harus terisi.');
      
      if ($this->form_validation->run() === FALSE) {
        $data['profil'] = $this->profil_mitra_model->get_profil_mitra($this->session->id_mitra)->row();
        $data['content'] = 'profil_mitra/index';
        $data['tab'] = 'setting';
        $this->load->view('main/admin/index', $data);
      } else {
        $cek_login = $this->profil_mitra_model->get_profil_mitra_one($this->session->id)->row();
        if (password_verify($this->input->post('old_password'), $cek_login->password)) {
          $data_setting = array(
            'password' => password_hash($this->input->post('new_password'), PASSWORD_DEFAULT),
          );
          
          if ($this->profil_mitra_model->put_setting_dosen($data_setting, $this->session->id)) {
            $this->session->set_flashdata('success_save', TRUE);
          } else {
            $this->session->set_flashdata('error_save', TRUE);
          }
          
          $data['profil'] = $this->profil_mitra_model->get_profil_mitra($this->session->id_mitra)->row();
          $data['content'] = 'profil_mitra/index';
          $data['tab'] = 'setting';
          $this->load->view('main/admin/index', $data);
        } else {
          $data['profil'] = $this->profil_mitra_model->get_profil_mitra($this->session->id_mitra)->row();
          $data['content'] = 'profil_mitra/index';
          $data['tab'] = 'setting';
          $data['error'] = 'Password yang dimasukkan salah';		 
          $this->load->view('main/admin/index', $data);
        }
      }
    }
  }
?>
