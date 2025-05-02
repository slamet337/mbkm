<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengumuman extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model("pengumuman_model");
    date_default_timezone_set("Asia/Makassar");
	}

	public function index()
	{
		$data['data'] = array(
			'pengumuman' => $this->pengumuman_model->get_pengumuman()->result(),
		);
		$data['content'] = 'pengumuman/index';
		$this->load->view('main/admin/index', $data);
	}

	public function add()
	{
		$data['content'] = 'pengumuman/add';
		$this->load->view('main/admin/index', $data);
	}

	public function post()
  {
		$this->form_validation->set_rules('title', 'Judul', 'required');
		$this->form_validation->set_rules('text', 'Text Isi', 'required');
    
		$this->form_validation->set_message('required', '{field} harus terisi.');
		
		if ($this->form_validation->run() === FALSE)
		{
      $data['content'] = 'pengumuman/add';
      $this->load->view('main/admin/index', $data);
		}
		else
		{
			$data = array(
				'title' => $this->input->post('title'),
				'text' => $this->input->post('text'),
			);
			
			if ($this->pengumuman_model->post($data)) {
				$this->session->set_flashdata('success_save', TRUE);
			} else {
				$this->session->set_flashdata('error_save', TRUE);
			}

			redirect('/admin/pengumuman');
		}
  }

	public function send($id)
	{
		$pengumuman = $this->pengumuman_model->get_pengumuman_one($id)->row();
		if($this->input->post('tujuan') == 1) {
			$mahasiswa = $this->pengumuman_model->get_mahasiswa();
			foreach ($mahasiswa->result() as $show) {
				$this->email($pengumuman, $show->email);
			}
		} elseif ($this->input->post('tujuan') == 2) {
			$mahasiswa = $this->pengumuman_model->get_mahasiswa_prodi('C101');
			foreach ($mahasiswa->result() as $show) {
				$this->email($pengumuman, $show->email);
			}
		} elseif ($this->input->post('tujuan') == 3) {
			$mahasiswa = $this->pengumuman_model->get_mahasiswa_prodi('C200');
			foreach ($mahasiswa->result() as $show) {
				$this->email($pengumuman, $show->email);
			}
		} elseif ($this->input->post('tujuan') == 4) {
			$mahasiswa = $this->pengumuman_model->get_mahasiswa_prodi('C201');
			foreach ($mahasiswa->result() as $show) {
				$this->email($pengumuman, $show->email);
			}
		} elseif ($this->input->post('tujuan') == 5) {
			$mahasiswa = $this->pengumuman_model->get_mahasiswa_prodi('C300');
			foreach ($mahasiswa->result() as $show) {
				$this->email($pengumuman, $show->email);
			}
		} elseif ($this->input->post('tujuan') == 6) {
			$mahasiswa = $this->pengumuman_model->get_mahasiswa_prodi('C301');
			foreach ($mahasiswa->result() as $show) {
				$this->email($pengumuman, $show->email);
			}
		} elseif ($this->input->post('tujuan') == 7) {
			$mahasiswa = $this->pengumuman_model->get_mahasiswa_inbound();
			foreach ($mahasiswa->result() as $show) {
				$this->email($pengumuman, $show->email);
			}
		}elseif ($this->input->post('tujuan') == 8) {
			$mitra = $this->pengumuman_model->get_mitra();
			foreach ($mitra->result() as $show) {
				$this->email($pengumuman, $show->email);
			}
		} elseif ($this->input->post('tujuan') == 9) {
			$mahasiswa = $this->pengumuman_model->get_mahasiswa();
			foreach ($mahasiswa->result() as $show) {
				$this->email($pengumuman, $show->email);
			}
			$mahasiswa_inbound = $this->pengumuman_model->get_mahasiswa_inbound();
			foreach ($mahasiswa_inbound->result() as $show) {
				$this->email($pengumuman, $show->email);
			}
			$mitra = $this->pengumuman_model->get_mitra();
			foreach ($mitra->result() as $show) {
				$this->email($pengumuman, $show->email);
			}
		} elseif ($this->input->post('tujuan') == 10) {
			$dosen = $this->pengumuman_model->get_dosen();
			foreach ($dosen->result() as $show) {
				$this->email($pengumuman, $show->email);
			}
		} elseif ($this->input->post('tujuan') == 11) {
			$alumni = $this->pengumuman_model->get_alumni();
			foreach ($alumni->result() as $show) {
				$this->email($pengumuman, $show->email);
			}
		} elseif ($this->input->post('tujuan') == 99) {
			$this->email($pengumuman, 'rachmadkurniawandev@gmail.com');
		}
		redirect('/admin/pengumuman');
	}

	public function email($pengumuman, $email)
	{
		// $config = [
		// 	'mailtype'  => 'html',
		// 	'charset'   => 'utf-8',
		// 	'protocol'  => 'smtp',
		// 	'smtp_host' => 'mail.mbkmfeb.com',
		// 	'smtp_user' => 'admin@mbkmfeb.com',  // Email gmail
		// 	'smtp_pass'   => 'wawan711994',  // Password gmail
		// 	'smtp_crypto' => 'ssl',
		// 	'smtp_port'   => 465,
		// 	'crlf'    => "\r\n",
		// 	'newline' => "\r\n"
		// ];
		$config = [
			'mailtype'  => 'html',
			'charset'   => 'utf-8',
			'protocol'  => 'smtp',
			'smtp_host' => 'smtp.googlemail.com',
			'smtp_user' => 'feb.mbkm.untad@gmail.com',  // Email gmail
			'smtp_pass'   => 'wawan070194',  // Password gmail
			'smtp_crypto' => 'ssl',
			'smtp_port'   => 465,
			'crlf'    => "\r\n",
			'newline' => "\r\n"
		];

		// Load library email dan konfigurasinya
		$this->load->library('email', $config);

		// Email dan nama pengirim
		$this->email->from('admin@mbkmfeb.com', 'Admin MBKM');

		// Email penerima
		$this->email->to($email); // Ganti dengan email tujuan

		// Subject email
		$this->email->subject($pengumuman->title);

		// Isi email
		$this->email->message('
			<html>
				<head>
					<title></title>
					<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
					<meta name="viewport" content="width=device-width, initial-scale=1" />
					<meta http-equiv="X-UA-Compatible" content="IE=edge" />
					<style type="text/css">
						body,
						table,
						td,
						a {
							-webkit-text-size-adjust: 100%;
							-ms-text-size-adjust: 100%;
							font-family: -apple-system, BlinkMacSystemFont, sans-serif;
						}
			
						table,
						td {
							mso-table-lspace: 0pt;
							mso-table-rspace: 0pt;
						}
			
						img {
							-ms-interpolation-mode: bicubic;
						}
			
						/* RESET STYLES */
						img {
							border: 0;
							height: auto;
							line-height: 100%;
							outline: none;
							text-decoration: none;
						}
			
						table {
							border-collapse: collapse !important;
						}
			
						body {
							height: 100% !important;
							margin: 0 !important;
							padding: 0 !important;
							width: 100% !important;
						}
			
						/* iOS BLUE LINKS */
						a[x-apple-data-detectors] {
							color: inherit !important;
							text-decoration: none !important;
							font-size: inherit !important;
							font-family: inherit !important;
							font-weight: inherit !important;
							line-height: inherit !important;
						}
			
						/* MOBILE STYLES */
						@media screen and (max-width: 600px) {
							h1 {
								font-size: 32px !important;
								line-height: 32px !important;
							}
						}
			
						/* ANDROID CENTER FIX */
						div[style*="margin: 16px 0;"] {
							margin: 0 !important;
						}
					</style>
				</head>
			
				<body
					style="
						background-color: #f4f4f4;
						margin: 0 !important;
						padding: 0 !important;
					"
				>
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<!-- LOGO -->
						<tr>
							<td bgcolor="#B2100E" align="center">
								<table
									border="0"
									cellpadding="0"
									cellspacing="0"
									width="100%"
									style="max-width: 600px"
								>
									<tr>
										<td
											align="center"
											valign="top"
											style="padding: 40px 10px 40px 10px"
										></td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td bgcolor="#B2100E" align="center" style="padding: 0px 10px 0px 10px">
								<table
									border="0"
									cellpadding="0"
									cellspacing="0"
									width="100%"
									style="max-width: 600px"
								>
									<tr>
										<td
											bgcolor="#ffffff"
											align="center"
											valign="top"
											style="
												padding: 40px 20px 20px 20px;
												border-radius: 4px 4px 0px 0px;
												color: #111111;
												font-family: Helvetica, Arial, sans-serif;
												font-size: 48px;
												font-weight: 400;
												letter-spacing: 4px;
												line-height: 48px;
											"
										>
											<h1
												style="
													font-size: 35px;
													font-weight: 200;
													margin: 2;
													margin-bottom: 30px;
												"
											>
												Pengumuman MBKM FEB
											</h1>
											<img
												src="https://i.postimg.cc/v8Cs0srT/logo-dark.png"
												width="35%"
												style="display: block; border: 0px"
											/>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px">
								<table
									border="0"
									cellpadding="0"
									cellspacing="0"
									width="100%"
									style="max-width: 600px"
								>
									<tr>
										<td
											bgcolor="#ffffff"
											align="left"
											style="
												padding: 20px 30px 20px 30px;
												color: #666666;
												font-family: Helvetica, Arial, sans-serif;
												font-size: 18px;
												font-weight: 400;
												line-height: 25px;
											"
										>
											<p style="margin: 0">
												'.$pengumuman->text.'
											</p>
										</td>
									</tr>
									<tr>
										<td bgcolor="#ffffff" align="left">
											<table width="100%" border="0" cellspacing="0" cellpadding="0">
												<tr>
													<td
														bgcolor="#ffffff"
														align="center"
														style="padding: 0px 30px 20px 30px"
													>
														<table border="0" cellspacing="0" cellpadding="0">
															<tr>
																<td
																	align="center"
																	style="border-radius: 3px"
																	bgcolor="#B2100E"
																>
																	<a
																		href="'.base_url().'"
																		target="_blank"
																		style="
																			font-size: 20px;
																			font-family: Helvetica, Arial, sans-serif;
																			color: #ffffff;
																			text-decoration: none;
																			color: #ffffff;
																			text-decoration: none;
																			padding: 15px 25px;
																			border-radius: 2px;
																			border: 1px solid #b2100e;
																			display: inline-block;
																		"
																		>Kunjungi Link</a
																	>
																</td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
										</td>
									</tr>
									<!-- COPY -->
									<tr>
										<td
											bgcolor="#ffffff"
											align="center"
											style="
												padding: 0px 30px 40px 30px;
												border-radius: 0px 0px 4px 4px;
												color: #666666;
												font-family: Helvetica, Arial, sans-serif;
												font-size: 18px;
												font-weight: 400;
												line-height: 25px;
											"
										>
											<p style="margin: 0">Hormat Kami,<br />MBKM FEB</p>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px">
								<table
									border="0"
									cellpadding="0"
									cellspacing="0"
									width="100%"
									style="max-width: 600px"
								>
									<tr>
										<td
											bgcolor="#f4f4f4"
											align="left"
											style="
												padding: 0px 30px 30px 30px;
												color: #666666;
												font-family: Helvetica, Arial, sans-serif;
												font-size: 14px;
												font-weight: 400;
												line-height: 18px;
											"
										>
											<br />
											<p style="margin: 0"></p>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</body>
			</html>
	
		');

		// Tampilkan pesan sukses atau error
		if ($this->email->send()) {
			return true;
				// $this->response( [
				// 		'status' => true,
				// 		'data' => $data,
				// 		'message' => 'Register Success'
				// ], 200 );
		} else {
			return false;
				// $this->response( [
				// 		'status' => false,
				// 		'data' => $data,
				// 		'message' => 'Email not send'
				// ], 406 );
		}
	}

	public function edit($id)
	{
		$data['data'] = array(
			'pengumuman' => $this->pengumuman_model->get_pengumuman_one($id)->row(),
		);
		$data['content'] = 'pengumuman/edit';
		$this->load->view('main/admin/index', $data);
	}

	public function update($id)
	{
		$this->form_validation->set_rules('title', 'Judul', 'required');
		$this->form_validation->set_rules('text', 'Text Isi', 'required');
    
		$this->form_validation->set_message('required', '{field} harus terisi.');
		
		if ($this->form_validation->run() === FALSE) {
      $data['data'] = array(
        'pengumuman' => $this->pengumuman_model->get_pengumuman_one($id)->row(),
      );
      $data['content'] = 'pengumuman/edit';
      $this->load->view('main/admin/index', $data);
		} else {
			$data = array(
				'title' => $this->input->post('title'),
				'text' => $this->input->post('text'),
			);
			
			if ($this->pengumuman_model->put($data, $id)) {
				$this->session->set_flashdata('success_update', TRUE);
			} else {
				$this->session->set_flashdata('error_update', TRUE);
			}

			redirect('/admin/pengumuman');
		}
	}

	public function delete()
	{
		$data = new stdClass();
		if ($this->pengumuman_model->delete($this->input->post('id'))) {
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