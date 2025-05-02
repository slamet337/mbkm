<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_akhir extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model("laporan_akhir_model");
    date_default_timezone_set("Asia/Makassar");
	}

	public function index()
	{
		$data['data'] = array(
			'laporan_akhir' => $this->laporan_akhir_model->get_laporan_akhir($this->session->id_mhsw)->result(),
			'nilai_kegiatan' => $this->laporan_akhir_model->check_nilai_kegiatan($this->session->id_mhsw)->num_rows(),
		);
		$data['content'] = 'menu/laporan_akhir/index';
    $this->load->view('main/users/index_menu', $data);
	}

	public function nilai($id, $id_program)
	{
    if($id_program == 1) {
      $data['data'] = array(
        'nilai' => $this->laporan_akhir_model->get_nilai_pertukaran($id)->result(),
      );
    } else {
      $data['data'] = array(
        'nilai' => $this->laporan_akhir_model->get_nilai($id)->result(),
      );
    }
		$data['content'] = 'menu/laporan_akhir/nilai';
    $this->load->view('main/users/index_menu', $data);
	}

  public function upload_tugas($id)
	{
    $data['laporan_akhir'] = $this->laporan_akhir_model->get_laporan_akhir_one($id)->row();
		$data['content'] = 'menu/laporan_akhir/edit';
    $this->load->view('main/users/index_menu', $data);
	}

  public function update($id) {
    if (!is_dir('images/laporan_akhir/' . $this->session->nim)) {
      mkdir('./images/laporan_akhir/' . $this->session->nim, 0777, TRUE);
    }

    $config = array(
      'upload_path'   => 'images/laporan_akhir/' . $this->session->nim,
      'allowed_types' => 'pdf|doc|docx',
      'max_size'      => 5000,
      'overwrite'     => TRUE,     
    );

    $this->load->library('upload', $config);      

    if (!empty($_FILES['file_laporan_akhir']['name'])) {
      $config['file_name'] = $this->session->nim."_tgs_akhir";
        
      $this->upload->initialize($config);

      if ($this->upload->do_upload('file_laporan_akhir')) {
        $this->upload->data();

        $file_upload = 'images/laporan_akhir/'.$this->session->nim.'/'.$this->session->nim."_tgs_akhir".$this->upload->data('file_ext');
        $data_laporan = array(
          'file_laporan_akhir' => $file_upload,
        );

        if ($this->laporan_akhir_model->put($data_laporan, $id)) {
          $this->session->set_flashdata('success_update', TRUE);            
        } else {
          $this->session->set_flashdata('error_update', TRUE);
        }
    
        redirect('/laporan_akhir');
      } else {
        $data['error'] = $this->upload->display_errors();
        $data['laporan_akhir'] = $this->laporan_akhir_model->get_laporan_akhir_one($id)->row();
        $data['content'] = 'menu/laporan_akhir/edit';
        $this->load->view('main/users/index_menu', $data);
      }
    } else {
      $data['error'] = "File Tugas Harus diisi";
      $data['laporan_akhir'] = $this->laporan_akhir_model->get_laporan_akhir_one($id)->row();
      $data['content'] = 'menu/laporan_akhir/edit';
      $this->load->view('main/users/index_menu', $data);
    }
  }
}
?>