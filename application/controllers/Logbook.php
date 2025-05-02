<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logbook extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model("logbook_model");
    date_default_timezone_set("Asia/Makassar");
	}

	public function index()
	{
		$data['data'] = array(
			'logbook' => $this->logbook_model->get_logbook($this->session->id_mhsw)->result(),
		);
		$data['content'] = 'menu/logbook/index';
    $this->load->view('main/users/index_menu', $data);
	}

  public function add()
	{
		$data['content'] = 'menu/logbook/add';
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

  public function post() {
    $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
    $this->form_validation->set_rules('kegiatan_dilakukan', 'Kegiatan yang dilakukan', 'required');
    $this->form_validation->set_rules('lokasi', 'Lokasi', 'required');
    
    $this->form_validation->set_message('required', '{field} harus terisi.');
    
    if ($this->form_validation->run() === FALSE)
    {
      $data['content'] = 'menu/logbook/add';
      $this->load->view('main/users/index_menu', $data);
    }
    else
    {
      if (!is_dir('images/logbook/' . $this->session->nim)) {
        mkdir('./images/logbook/' . $this->session->nim, 0777, TRUE);
      }

      $config = array(
        'upload_path'   => 'images/logbook/' . $this->session->nim,
        'allowed_types' => 'jpg|png|jpeg|pdf|doc|docx',
        'max_size'      => 1000,
        'overwrite'     => TRUE,     
      );

      $this->load->library('upload', $config);      

      $id_pendaftaran = $this->logbook_model->get_id_daftar($this->session->id_mhsw)->row()->id;

      $tanggal = explode("/",$this->input->post('tanggal'));
      $tanggal_logbook = $tanggal[2]."-".$tanggal[1]."-".$tanggal[0];
      $tanggal_name = $tanggal[0]."_".$tanggal[1]."_".$tanggal[2];

      $config['file_name'] = $tanggal_name."_foto";
        
      $this->upload->initialize($config);

      if ($this->upload->do_upload('foto_kegiatan')) {
        $this->upload->data();

        $foto_upload = 'images/logbook/'.$this->session->nim.'/'.$tanggal_name."_foto".$this->upload->data('file_ext');
        $data_log = array(
          'id_mhsw' => $this->session->id_mhsw,
          'id_pendaftaran' => $id_pendaftaran,
          'kegiatan_dilakukan' => $this->input->post('kegiatan_dilakukan'),
          'lokasi' => $this->input->post('lokasi'),
          'tanggal' => $tanggal_logbook,
          'foto_kegiatan' => $foto_upload,
        );
      } else {
        $data['error'] = $this->upload->display_errors();
        $data['content'] = 'menu/logbook/add';
        $this->load->view('main/users/index_menu', $data);
        return false;
      }

      if (!empty($_FILES['file_laporan']['name'])) {
        $config['file_name'] = $tanggal_name."_laporan";
        
        $this->upload->initialize($config);

        if ($this->upload->do_upload('file_laporan')) {
          $this->upload->data();

          $file_upload = 'images/logbook/'.$this->session->nim.'/'.$tanggal_name."_laporan".$this->upload->data('file_ext');
          $data_log = array(
            'id_mhsw' => $this->session->id_mhsw,
            'id_pendaftaran' => $id_pendaftaran,
            'kegiatan_dilakukan' => $this->input->post('kegiatan_dilakukan'),
            'lokasi' => $this->input->post('lokasi'),
            'tanggal' => $tanggal_logbook,
            'foto_kegiatan' => $foto_upload,
            'file_laporan' => $file_upload,
          );
        } else {
          $data['error'] = $this->upload->display_errors();
          $data['content'] = 'menu/logbook/add';
          $this->load->view('main/users/index_menu', $data);
          return false;
        }
      }
      
      if ($this->logbook_model->post($data_log)) {
        $this->session->set_flashdata('success_save', TRUE);            
      } else {
        $this->session->set_flashdata('error_save', TRUE);
      }

      redirect('/logbook');
    }
  }

  public function edit($id)
	{
    $data['logbook'] = $this->logbook_model->get_logbook_one($id)->row();
		$data['content'] = 'menu/logbook/edit';
    $this->load->view('main/users/index_menu', $data);
	}

  public function update($id) {
    $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
    $this->form_validation->set_rules('kegiatan_dilakukan', 'Kegiatan yang dilakukan', 'required');
    $this->form_validation->set_rules('lokasi', 'Lokasi', 'required');
    
    $this->form_validation->set_message('required', '{field} harus terisi.');
    
    if ($this->form_validation->run() === FALSE)
    {
      $data['logbook'] = $this->logbook_model->get_logbook_one($id)->row();
      $data['content'] = 'menu/logbook/edit';
      $this->load->view('main/users/index_menu', $data);
    }
    else
    {
      if (!is_dir('images/logbook/' . $this->session->nim)) {
        mkdir('./images/logbook/' . $this->session->nim, 0777, TRUE);
      }

      $config = array(
        'upload_path'   => 'images/logbook/' . $this->session->nim,
        'allowed_types' => 'jpg|png|jpeg|pdf|doc|docx',
        'max_size'      => 1000,
        'overwrite'     => TRUE,     
      );

      $this->load->library('upload', $config);      

      $tanggal = explode("/",$this->input->post('tanggal'));
      $tanggal_logbook = $tanggal[2]."-".$tanggal[1]."-".$tanggal[0];
      $tanggal_name = $tanggal[0]."_".$tanggal[1]."_".$tanggal[2];

      $data_log = array(
        'kegiatan_dilakukan' => $this->input->post('kegiatan_dilakukan'),
        'lokasi' => $this->input->post('lokasi'),
        'tanggal' => $tanggal_logbook,
      );
      
      if (!empty($_FILES['foto_kegiatan']['name'])) {
        $config['file_name'] = $tanggal_name."_foto";
          
        $this->upload->initialize($config);

        if ($this->upload->do_upload('foto_kegiatan')) {
          $this->upload->data();

          $foto_upload = 'images/logbook/'.$this->session->nim.'/'.$tanggal_name."_foto".$this->upload->data('file_ext');
          $data_log = array(
            'kegiatan_dilakukan' => $this->input->post('kegiatan_dilakukan'),
            'lokasi' => $this->input->post('lokasi'),
            'tanggal' => $tanggal_logbook,
            'foto_kegiatan' => $foto_upload,
          );
        } else {
          $data['error'] = $this->upload->display_errors();
          $data['logbook'] = $this->logbook_model->get_logbook_one($id)->row();
          $data['content'] = 'menu/logbook/edit';
          $this->load->view('main/users/index_menu', $data);
          return false;
        }
      }

      if (!empty($_FILES['file_laporan']['name'])) {
        $config['file_name'] = $tanggal_name."_laporan";
        
        $this->upload->initialize($config);

        if ($this->upload->do_upload('file_laporan')) {
          $this->upload->data();

          $file_upload = 'images/logbook/'.$this->session->nim.'/'.$tanggal_name."_laporan".$this->upload->data('file_ext');
          $data_log = array(
            'kegiatan_dilakukan' => $this->input->post('kegiatan_dilakukan'),
            'lokasi' => $this->input->post('lokasi'),
            'tanggal' => $tanggal_logbook,
            'foto_kegiatan' => $foto_upload,
            'file_laporan' => $file_upload,
          );
        } else {
          $data['error'] = $this->upload->display_errors();
          $data['logbook'] = $this->logbook_model->get_logbook_one($id)->row();
          $data['content'] = 'menu/logbook/edit';
          $this->load->view('main/users/index_menu', $data);
          return false;
        }
      }
      
      if ($this->logbook_model->put($data_log, $id)) {
        $this->session->set_flashdata('success_update', TRUE);            
      } else {
        $this->session->set_flashdata('error_update', TRUE);
      }

      redirect('/logbook');
    }
  }

  public function delete()
	{
		$data = new stdClass();
		if ($this->logbook_model->delete($this->input->post('id'))) {
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