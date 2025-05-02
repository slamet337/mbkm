<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model("auth_model");
		$this->load->library('recaptcha');
		$this->recaptcha->set_keys('6LdrQTcbAAAAABbP2Bpnt2BaEgwB-8auRlsj8Ohz', '6LdrQTcbAAAAAKkOaCecmTJwgTQMLBYIoWudTdfX');
	}

	public function index()
	{
		$recaptcha = $this->recaptcha->create_box();
		$data['recaptcha'] = $recaptcha;
		$this->load->view('main/admin/login', $data);
	}

	public function proc_login()
	{
		$username=html_escape($this->input->post('username'));
		$password=html_escape($this->input->post('password'));

		if(empty($username)){
			$recaptcha = $this->recaptcha->create_box();
			$data['recaptcha'] = $recaptcha;
			$data['error'] = 'Username belum terisi';
			$this->load->view('main/admin/login', $data);
		}elseif (empty($password)) {
			$recaptcha = $this->recaptcha->create_box();
			$data['recaptcha'] = $recaptcha;
			$data['error'] = 'Password belum terisi';
			$this->load->view('main/admin/login', $data);
		}else{
			$q_cek_login = $this->auth_model->login_admin($username);
			$cek_login= $q_cek_login->row();

			$is_valid = $this->recaptcha->is_valid();
			
			if ($is_valid['success'] == 1) {
				if ($q_cek_login->num_rows() > 0) {
					if (password_verify($this->input->post('password'), $cek_login->password)) {
						$data_session = array(
							'fullname' => $cek_login->full_name,
							'username' => $cek_login->username,
							'level' => $cek_login->id_level,
							'level_name' => $cek_login->level,
							'id' => $cek_login->id,
							'phone_number' => $cek_login->phone_number,
							'id_mitra' => $cek_login->id_mitra,
							'nama_mitra' => $cek_login->nama_mitra,
							'kd_prodi' => $cek_login->kd_prodi
						);
						
						$this->session->set_userdata($data_session);
						redirect('admin');
					} else {
						$recaptcha = $this->recaptcha->create_box();
						$data['error'] = 'Maaf username atau password yang dimasukkan salah';		 
						$data['recaptcha'] = $recaptcha;
						
						$this->load->view('main/admin/login', $data);
					}
				} else {
					$recaptcha = $this->recaptcha->create_box();
					$data['error'] = 'Maaf Username tidak terdaftar';		 
					$data['recaptcha'] = $recaptcha;
					
					$this->load->view('main/admin/login', $data);
				}
			} else {
				$recaptcha = $this->recaptcha->create_box();
				$data['error'] = 'Maaf Captcha Salah';		 
				$data['recaptcha'] = $recaptcha;
				$this->load->view('main/admin/login', $data);
			}
    }
	}
    
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('home');
	}
}
?>