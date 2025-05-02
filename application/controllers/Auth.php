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
		$this->load->view('main/users/login', $data);
	}

  public function register()
	{
		$recaptcha = $this->recaptcha->create_box();
		$data['recaptcha'] = $recaptcha;
    $data['content'] = 'register/index';
		$data['fakultas'] = $this->auth_model->get_fakultas()->result();
		$data['prodi'] = $this->auth_model->get_prodi()->result();
		$this->load->view('main/users/index', $data);
	}

  public function register_inbound()
	{
		$recaptcha = $this->recaptcha->create_box();
		$data['recaptcha'] = $recaptcha;
    $data['content'] = 'register/inbound';
		$data['fakultas'] = $this->auth_model->get_fakultas()->result();
		$data['prodi'] = $this->auth_model->get_prodi()->result();
		$this->load->view('main/users/index', $data);
	}

  public function register_alumni()
	{
		$recaptcha = $this->recaptcha->create_box();
		$data['recaptcha'] = $recaptcha;
    $data['content'] = 'register/alumni';
		$data['fakultas'] = $this->auth_model->get_fakultas()->result();
		$data['prodi'] = $this->auth_model->get_prodi()->result();
		$this->load->view('main/users/index', $data);
	}

	public function post()
	{
		$is_valid = $this->recaptcha->is_valid();

		if ($is_valid['success'] == 1) {
			$this->form_validation->set_rules('nama', 'Nama', 'required');
			$this->form_validation->set_rules('no_hp', 'Nomor HP', 'required');
			$this->form_validation->set_rules('nik', 'NIK', 'required');
			$this->form_validation->set_rules('nim', 'NIM', 'required');
			$this->form_validation->set_rules('fakultas', 'Fakultas', 'required');
			$this->form_validation->set_rules('prodi', 'Prodi', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|is_unique[users_mhsw.email]');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('alamat', 'Alamat', 'required');
			$this->form_validation->set_rules('angkatan', 'Tahun Angkatan', 'required');
			
			$this->form_validation->set_message('required', '{field} harus terisi.');
			$this->form_validation->set_message('is_unique', '{field} sudah terdaftar.');

			if ($this->form_validation->run() === FALSE) {
				$recaptcha = $this->recaptcha->create_box();
				$data['recaptcha'] = $recaptcha;
				$data['content'] = 'register/index';
				$data['fakultas'] = $this->auth_model->get_fakultas()->result();
				$data['prodi'] = $this->auth_model->get_prodi()->result();
				$this->load->view('main/users/index', $data);
			} else {
				$data_user = array(
					'email' => $this->input->post('email'),
					'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
					'kd_fak' => $this->input->post('fakultas'),
					'kd_prodi' => $this->input->post('prodi'),
					'level' => 'mahasiswa',
					'full_name' => $this->input->post('nama'),
					'phone_number' => $this->input->post('no_hp'),
				);

				$id_user = $this->auth_model->post_user($data_user);

				if($id_user) {
					$data = array(
						'id_user' => $id_user,
						'email' => $this->input->post('email'),
						'nama' => $this->input->post('nama'),
						'alamat' => $this->input->post('alamat'),
						'nik' => $this->input->post('nik'),
						'nim' => $this->input->post('nim'),
						'no_hp' => $this->input->post('no_hp'),
						'kd_fak' => $this->input->post('fakultas'),
						'kd_prodi' => $this->input->post('prodi'),
						'angkatan' => $this->input->post('angkatan'),
					);
					
					if ($this->auth_model->post($data)) {
						$this->session->set_flashdata('success_save', TRUE);
					} else {
						$this->session->set_flashdata('error_save', TRUE);
					}
				} else {
					$this->session->set_flashdata('error_save', TRUE);
				}
	
				redirect('/auth/register');
			}
		} else {
			$data['error'] = 'Anda belum mencentang captcha';
			$recaptcha = $this->recaptcha->create_box();
			$data['recaptcha'] = $recaptcha;
			$data['content'] = 'register/index';
			$data['fakultas'] = $this->auth_model->get_fakultas()->result();
			$data['prodi'] = $this->auth_model->get_prodi()->result();
			$this->load->view('main/users/index', $data);
		}
	}

	public function post_inbound()
	{
		$is_valid = $this->recaptcha->is_valid();

		if ($is_valid['success'] == 1) {
			$this->form_validation->set_rules('nama', 'Nama', 'required');
			$this->form_validation->set_rules('no_hp', 'Nomor HP', 'required');
			$this->form_validation->set_rules('nik', 'NIK', 'required');
			$this->form_validation->set_rules('universitas_asal', 'Universitas Asal', 'required');
			$this->form_validation->set_rules('stambuk_asal', 'Stambuk Asal', 'required');
			$this->form_validation->set_rules('fakultas_asal', 'Fakultas Asal', 'required');
			$this->form_validation->set_rules('prodi_asal', 'Prodi Asal', 'required');
			$this->form_validation->set_rules('fakultas', 'Fakultas', 'required');
			$this->form_validation->set_rules('prodi', 'Prodi', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|is_unique[users_mhsw.email]');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('alamat', 'Alamat', 'required');
			$this->form_validation->set_rules('angkatan', 'Tahun Angkatan', 'required');
			
			$this->form_validation->set_message('required', '{field} harus terisi.');
			$this->form_validation->set_message('is_unique', '{field} sudah terdaftar.');

			if ($this->form_validation->run() === FALSE) {
				$recaptcha = $this->recaptcha->create_box();
				$data['recaptcha'] = $recaptcha;
				$data['content'] = 'register/inbound';
				$data['fakultas'] = $this->auth_model->get_fakultas()->result();
				$data['prodi'] = $this->auth_model->get_prodi()->result();
				$this->load->view('main/users/index', $data);
			} else {
				$data_user = array(
					'email' => $this->input->post('email'),
					'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
					'kd_fak' => $this->input->post('fakultas'),
					'kd_prodi' => $this->input->post('prodi'),
					'level' => 'inbound',
					'full_name' => $this->input->post('nama'),
					'phone_number' => $this->input->post('no_hp'),
				);

				$id_user = $this->auth_model->post_user($data_user);

				if($id_user) {
					$data = array(
						'id_user' => $id_user,
						'email' => $this->input->post('email'),
						'nama' => $this->input->post('nama'),
						'alamat' => $this->input->post('alamat'),
						'nik' => $this->input->post('nik'),
						'no_hp' => $this->input->post('no_hp'),
						'kd_fak' => $this->input->post('fakultas'),
						'kd_prodi' => $this->input->post('prodi'),
						'stambuk_asal' => $this->input->post('stambuk_asal'),
						'universitas_asal' => $this->input->post('universitas_asal'),
						'fakultas_asal' => $this->input->post('fakultas_asal'),
						'prodi_asal' => $this->input->post('prodi_asal'),
						'angkatan' => $this->input->post('angkatan'),
					);
					
					if ($this->auth_model->post_inbound($data)) {
						$this->session->set_flashdata('success_save', TRUE);
					} else {
						$this->session->set_flashdata('error_save', TRUE);
					}
				} else {
					$this->session->set_flashdata('error_save', TRUE);
				}
	
				redirect('/auth/register');
			}
		} else {
			$data['error'] = 'Anda belum mencentang captcha';
			$recaptcha = $this->recaptcha->create_box();
			$data['recaptcha'] = $recaptcha;
			$data['content'] = 'register/inbound';
			$data['fakultas'] = $this->auth_model->get_fakultas()->result();
			$data['prodi'] = $this->auth_model->get_prodi()->result();
			$this->load->view('main/users/index', $data);
		}
	}

	public function post_alumni()
	{
		$is_valid = $this->recaptcha->is_valid();

		if ($is_valid['success'] == 1) {
			$this->form_validation->set_rules('nama', 'Nama', 'required');
			$this->form_validation->set_rules('no_hp', 'Nomor HP', 'required');
			$this->form_validation->set_rules('nik', 'NIK', 'required');
			$this->form_validation->set_rules('nim', 'NIM', 'required');
			$this->form_validation->set_rules('fakultas', 'Fakultas', 'required');
			$this->form_validation->set_rules('prodi', 'Prodi', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|is_unique[users_mhsw.email]');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('alamat', 'Alamat', 'required');
			
			$this->form_validation->set_message('required', '{field} harus terisi.');
			$this->form_validation->set_message('is_unique', '{field} sudah terdaftar.');

			if ($this->form_validation->run() === FALSE) {
				$recaptcha = $this->recaptcha->create_box();
				$data['recaptcha'] = $recaptcha;
				$data['content'] = 'register/alumni';
				$data['fakultas'] = $this->auth_model->get_fakultas()->result();
				$data['prodi'] = $this->auth_model->get_prodi()->result();
				$this->load->view('main/users/index', $data);
			} else {
				$tanggal_yudisium = explode("/",$this->input->post('tanggal_yudisium'));
	      $tanggal_yudisium_data = $tanggal_yudisium[2]."-".$tanggal_yudisium[1]."-".$tanggal_yudisium[0];

				$data_user = array(
					'email' => $this->input->post('email'),
					'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
					'kd_fak' => $this->input->post('fakultas'),
					'kd_prodi' => $this->input->post('prodi'),
					'level' => 'alumni',
					'full_name' => $this->input->post('nama'),
					'phone_number' => $this->input->post('no_hp'),
				);

				$id_user = $this->auth_model->post_user($data_user);

				if($id_user) {
					$data = array(
						'id_user' => $id_user,
						'email' => $this->input->post('email'),
						'nama' => $this->input->post('nama'),
						'alamat' => $this->input->post('alamat'),
						'nik' => $this->input->post('nik'),
						'nim' => $this->input->post('nim'),
						'no_hp' => $this->input->post('no_hp'),
						'kd_fak' => $this->input->post('fakultas'),
						'kd_prodi' => $this->input->post('prodi'),
					);
					
					if ($this->auth_model->post($data)) {
						$this->session->set_flashdata('success_save', TRUE);
					} else {
						$this->session->set_flashdata('error_save', TRUE);
					}
				} else {
					$this->session->set_flashdata('error_save', TRUE);
				}
	
				redirect('/auth/register_alumni');
			}
		} else {
			$data['error'] = 'Anda belum mencentang captcha';
			$recaptcha = $this->recaptcha->create_box();
			$data['recaptcha'] = $recaptcha;
			$data['content'] = 'register/alumni';
			$data['fakultas'] = $this->auth_model->get_fakultas()->result();
			$this->load->view('main/users/index', $data);
		}
	}
	
	public function search_jurusan()
	{
		$kd_fak = $this->input->get('kd_fak', TRUE);
		$prodi = $this->input->get('prodi', TRUE);
		$data = new stdClass();
		$data->status = "success";	
		$data->data = $this->auth_model->search_jurusan($kd_fak, $prodi)->result();

		$json = json_encode($data);

		echo $json;
	}

	public function proc_login()
	{
		$email=html_escape($this->input->post('email'));
		$password=html_escape($this->input->post('password'));

		if(empty($email)){
			$data['error'] = 'Email belum terisi';
			$this->load->view('main/users/login', $data);
		}elseif (empty($password)) {
			$data['error'] = 'Password belum terisi';
			$this->load->view('main/users/login', $data);
		}else{
			$q_cek_login = $this->auth_model->login($email);
			$cek_login= $q_cek_login->row();

			$is_valid = $this->recaptcha->is_valid();
			
			if ($is_valid['success'] == 1) {
				if ($q_cek_login->num_rows() > 0) {
					if (password_verify($this->input->post('password'), $cek_login->password)) {
						$data_session = array(
							'id' => $cek_login->id,
							'id_mhsw' => $cek_login->id_mhsw,
							'nama' => $cek_login->full_name,
							'email' => $cek_login->email,
							'kd_fak' => $cek_login->kd_fak,
							'kd_prodi' => $cek_login->kd_prodi,
							'level' => $cek_login->level,
							'nim' => $cek_login->nim,
							'nik' => $cek_login->nik,
						);
						
						$this->session->set_userdata($data_session);
						redirect('menu');
					} else {
						$recaptcha = $this->recaptcha->create_box();
						$data['error'] = 'Maaf username atau password yang dimasukkan salah';		 
						$data['recaptcha'] = $recaptcha;
						$this->load->view('main/users/login', $data);
					}
				} else {
					$recaptcha = $this->recaptcha->create_box();
					$data['error'] = 'Maaf Username tidak terdaftar';		 
					$data['recaptcha'] = $recaptcha;
					$this->load->view('main/users/login', $data);				}
			} else {
				$recaptcha = $this->recaptcha->create_box();
				$data['error'] = 'Maaf Captcha Salah';		 
				$data['recaptcha'] = $recaptcha;
				$this->load->view('main/users/login', $data);
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