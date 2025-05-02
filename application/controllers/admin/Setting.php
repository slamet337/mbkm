<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Setting extends CI_Controller {
    function __construct(){
      parent::__construct();
      $this->load->model("profil_model");
      date_default_timezone_set("Asia/Makassar");
    }

    public function index()
    {
      $data['content'] = 'setting/index';
      $this->load->view('main/admin/index', $data);
    }

    public function setting()
    {
      $this->form_validation->set_rules('old_password', 'Password Lama', 'required');
      $this->form_validation->set_rules('new_password', 'Password Baru', 'required');
      
      $this->form_validation->set_message('required', '{field} harus terisi.');
      
      if ($this->form_validation->run() === FALSE) {
        $data['content'] = 'setting/index';
        $this->load->view('main/admin/index', $data);
      } else {
        $cek_login = $this->profil_model->get_user_dosen_one($this->session->id)->row();
        if (password_verify($this->input->post('old_password'), $cek_login->password)) {
          $data_setting = array(
            'password' => password_hash($this->input->post('new_password'), PASSWORD_DEFAULT),
          );
          
          if ($this->profil_model->put_setting_mitra($data_setting, $this->session->id)) {
            $this->session->set_flashdata('success_save', TRUE);
          } else {
            $this->session->set_flashdata('error_save', TRUE);
          }

          $data['content'] = 'setting/index';
          $this->load->view('main/admin/index', $data);
        } else {
          $data['content'] = 'setting/index';
          $data['error'] = 'Password yang dimasukkan salah';		 
          $this->load->view('main/admin/index', $data);
        }
      }
    }
  }
?>
