<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Pendaftaran_inbound extends CI_Controller {
    function __construct(){
      parent::__construct();
      $this->load->model("pendaftaran_model");
      date_default_timezone_set("Asia/Makassar");
    }

    public function index()
    {
      $data['mbkm'] = $this->pendaftaran_model->get_program_mbkm_one(1)->result();
      $data['content'] = 'menu/pendaftaran_inbound/index';
      $this->load->view('main/users/index_menu', $data);
    }

    public function mbkm($id)
    {
      $data['jadwal'] = $this->pendaftaran_model->get_jadwal();
      $data['matakuliah_konversi'] = $this->pendaftaran_model->get_matakuliah_konversi();
      $data['content'] = 'menu/pendaftaran_inbound/daftar';
      $data['id'] = $id;
      $this->load->view('main/users/index_menu', $data);
    }

    public function matakuliah()
    {
      $id_kegiatan = $this->input->post('id');
      $kd_prodi = $this->session->kd_prodi;

      $data = new stdClass();
      // $matakuliah = $this->pendaftaran_model->get_matakuliah($id_kegiatan, $kd_prodi);
      $persyaratan = $this->pendaftaran_model->get_persyaratan($id_kegiatan);
      if ($persyaratan->num_rows() >= 0) {
        $data->status = "success";
        // $data->count = $matakuliah->num_rows();
        // $data->data = $matakuliah->result();
        $data->count_syarat = $persyaratan->num_rows();
        $data->data_syarat = $persyaratan->result();
      } else {
        $data->status = "failed";
      }
  
      $json = json_encode($data);
  
      echo $json;
    }

    public function get_description()
    {
      $kd_mk = $this->input->post('kd_mk1');

      $data = new stdClass();
      $description = $this->pendaftaran_model->get_description_inbound($kd_mk);
      if ($description->num_rows() >= 0) {
        $data->status = "success";
        $data->data = $description->row()->description;
      } else {
        $data->status = "failed";
      }
  
      $json = json_encode($data);
  
      echo $json;
    }

    public function matakuliah_inbound()
    {
      $semester = $this->input->post('semester');

      $data = new stdClass();
      $total_sks = $this->pendaftaran_model->get_total_sks_inbound($semester, $this->session->id);
      $matakuliah_inbound = $this->pendaftaran_model->get_matakuliah_inbound();
      if ($matakuliah_inbound->num_rows() >= 0) {
        $data->status = "success";
        $data->total_sks = $total_sks->num_rows() > 0 ? $total_sks->row()->total_sks : "0";
        $data->data = $matakuliah_inbound->result();
      } else {
        $data->status = "failed";
      }
  
      $json = json_encode($data);
  
      echo $json;
    }

    public function post($id) {
      $this->form_validation->set_rules('semester', 'Semester', 'required');
      
      $this->form_validation->set_message('required', '{field} harus terisi.');
      
      if ($this->form_validation->run() === FALSE)
      {
        $data['jadwal'] = $this->pendaftaran_model->get_jadwal();
        $data['matakuliah_konversi'] = $this->pendaftaran_model->get_matakuliah_konversi();
        $data['content'] = 'menu/pendaftaran_inbound/daftar';
        $data['id'] = $id;
        $this->load->view('main/users/index_menu', $data);
      }
      else
      {
        if (!is_dir('images/persyaratan_inbound/' . $this->session->id)) {
          mkdir('./images/persyaratan_inbound/' . $this->session->id, 0777, TRUE);
        }
  
        $config = array(
          'upload_path'   => 'images/persyaratan_inbound/' . $this->session->id,
          'allowed_types' => 'jpg|png|jpeg',
          'max_size'      => 500,
          'overwrite'     => TRUE,     
        );
  
        $this->load->library('upload', $config);
        
        $id_mhsw = $this->pendaftaran_model->get_id_mahasiswa($this->session->id)->row()->id;
        
        $mk_inbound = $this->input->post('mk_inbound');
        
        $this->db->trans_start();
        foreach ($mk_inbound as $value) {
          $exp_mk_inbound = explode(",",$value);
          print_r($exp_mk_inbound);
          $data = array(
            'id_mhsw' => $id_mhsw,
            'id_jadwal' => $exp_mk_inbound[0],
            'semester' => $this->input->post('semester'),
            'status_pendaftaran' => 'On Process',
            'status_kegiatan' => 'Belum Aktif',
          );

          $id_pendaftaran = $this->pendaftaran_model->post_inbound($data);

          $config['file_name'] = 'persyaratan_transkip_'.$id_pendaftaran;
          
          $this->upload->initialize($config);
  
          if ($this->upload->do_upload('transkip_nilai')) {
            $this->upload->data();

            $data_persyaratan = array(
              'id_pendaftaran' => $id_pendaftaran,
              'persyaratan' => 'Transkip Nilai',
              'file_upload' => 'images/persyaratan_inbound/'.$this->session->id.'/persyaratan_transkip_'.$id_pendaftaran.$this->upload->data('file_ext')    
            );

            if(!$this->pendaftaran_model->post_persyaratan_inbound($data_persyaratan)) {
              $this->session->set_flashdata('error_save', TRUE);
              redirect('/pendaftaran_inbound/mbkm/'.$id);
            }
          } else {
            $data['error'] = $this->upload->display_errors();
            $data['jadwal'] = $this->pendaftaran_model->get_jadwal();
            $data['matakuliah_konversi'] = $this->pendaftaran_model->get_matakuliah_konversi();
            $data['content'] = 'menu/pendaftaran_inbound/daftar';
            $data['id'] = $id;
            $this->load->view('main/users/index_menu', $data);
            return false;
          }

          $config['file_name'] = 'persyaratan_permohonan_'.$id_pendaftaran;
          
          $this->upload->initialize($config);
  
          if ($this->upload->do_upload('surat_permohonan')) {
            $this->upload->data();

            $data_persyaratan = array(
              'id_pendaftaran' => $id_pendaftaran,
              'persyaratan' => 'Surat Permohonan',
              'file_upload' => 'images/persyaratan_inbound/'.$this->session->id.'/persyaratan_permohonan_'.$id_pendaftaran.$this->upload->data('file_ext')    
            );

            if(!$this->pendaftaran_model->post_persyaratan_inbound($data_persyaratan)) {
              $this->session->set_flashdata('error_save', TRUE);
              redirect('/pendaftaran_inbound/mbkm/'.$id);
            }
          } else {
            $data['error'] = $this->upload->display_errors();
            $data['jadwal'] = $this->pendaftaran_model->get_jadwal();
            $data['matakuliah_konversi'] = $this->pendaftaran_model->get_matakuliah_konversi();
            $data['content'] = 'menu/pendaftaran_inbound/daftar';
            $data['id'] = $id;
            $this->load->view('main/users/index_menu', $data);
            return false;
          }
        }
        
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
          $this->db->trans_rollback();
          $this->session->set_flashdata('error_save', TRUE);
        } 
        else {
          $this->db->trans_commit();
          $this->session->set_flashdata('success_save', TRUE);            
        }

        redirect('/manajemen_inbound');
      }
    }
  }
?>
