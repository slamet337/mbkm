<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Pendaftaran extends CI_Controller {
    function __construct(){
      parent::__construct();
      $this->load->model("pendaftaran_model");
      date_default_timezone_set("Asia/Makassar");
    }

    public function index()
    {
      $data['mbkm'] = $this->pendaftaran_model->get_program_mbkm()->result();
      $data['content'] = 'menu/pendaftaran/index';
      $this->load->view('main/users/index_menu', $data);
    }

    public function mbkm($id)
    {
      $data['kegiatan'] = $this->pendaftaran_model->get_kegiatan($id);
      $data['matakuliah_konversi'] = $this->pendaftaran_model->get_matakuliah_konversi();
      $data['content'] = 'menu/pendaftaran/daftar';
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
      $kd_mk = $this->input->post('kd_mk');

      $data = new stdClass();
      $description = $this->pendaftaran_model->get_description($kd_mk);
      if ($description->num_rows() >= 0) {
        $data->status = "success";
        $data->data = $description->row()->description;
      } else {
        $data->status = "failed";
      }
  
      $json = json_encode($data);
  
      echo $json;
    }

    public function matakuliah_pertukaran()
    {
      $id_kegiatan = $this->input->post('id_kegiatan');
      $semester = $this->input->post('semester');

      $data = new stdClass();
      $total_sks = $this->pendaftaran_model->get_total_sks($semester, $this->session->id_mhsw);
      $matakuliah_pertukaran = $this->pendaftaran_model->get_matakuliah_pertukaran($id_kegiatan);
      if ($matakuliah_pertukaran->num_rows() >= 0) {
        $data->status = "success";
        $data->total_sks = $total_sks->num_rows() > 0 ? $total_sks->row()->total_sks : "0";
        $data->data = $matakuliah_pertukaran->result();
      } else {
        $data->status = "failed";
      }
  
      $json = json_encode($data);
  
      echo $json;
    }

    public function post() {
      $id = $this->input->post('id');
      $id_mbkm = $this->input->post('id_mbkm');
      $this->form_validation->set_rules('id_kegiatan', 'Kegiatan MBKM', 'required');
      $this->form_validation->set_rules('semester', 'Semester', 'required');
      
      $this->form_validation->set_message('required', '{field} harus terisi.');
      
      if ($this->form_validation->run() === FALSE)
      {
        $data['kegiatan'] = $this->pendaftaran_model->get_kegiatan($id);
        $data['matakuliah_konversi'] = $this->pendaftaran_model->get_matakuliah_konversi($this->session->kd_prodi);
        $data['content'] = 'menu/pendaftaran/daftar';
        $data['id'] = $id_mbkm;
        $this->load->view('main/users/index_menu', $data);
      }
      else
      {
        if (!is_dir('images/persyaratan/' . $this->session->nim)) {
          mkdir('./images/persyaratan/' . $this->session->nim, 0777, TRUE);
        }
  
        $config = array(
          'upload_path'   => 'images/persyaratan/' . $this->session->nim,
          'allowed_types' => 'jpg|png|jpeg',
          'max_size'      => 500,
          'overwrite'     => TRUE,     
        );
  
        $this->load->library('upload', $config);
        
  
        $data = array(
          'id_mhsw' => $this->session->id_mhsw,
          'id_kegiatan' => $this->input->post('id_kegiatan'),
          'semester' => $this->input->post('semester'),
          'status_pendaftaran' => 'On Process',
          'status_kegiatan' => 'Belum Aktif',
        );

        $this->db->trans_start();
        $id_pendaftaran = $this->pendaftaran_model->post($data);
        if ($id_pendaftaran) {
          $persyaratan = $this->pendaftaran_model->get_persyaratan($id)->result();
          
          foreach ($persyaratan as $show) {
            $config['file_name'] = $this->session->nim."_".$show->id;
          
            $this->upload->initialize($config);
    
            if ($this->upload->do_upload('syarat_file_'.$show->id)) {
              $this->upload->data();
  
              $data_persyaratan = array(
                'id_pendaftaran' => $id_pendaftaran,
                'id_persyaratan' => $show->id,
                'file_upload' => 'images/persyaratan/'.$this->session->nim.'/'.$this->session->nim."_".$show->id.$this->upload->data('file_ext')    
              );

              if(!$this->pendaftaran_model->post_persyaratan($data_persyaratan)) {
                $this->session->set_flashdata('error_save', TRUE);
                redirect('/pendaftaran/mbkm/'.$id_mbkm);
              }
            } else {
              $data['error'] = $this->upload->display_errors();
              $data['kegiatan'] = $this->pendaftaran_model->get_kegiatan($id);
              $data['matakuliah_konversi'] = $this->pendaftaran_model->get_matakuliah_konversi($this->session->kd_prodi);
              $data['content'] = 'menu/pendaftaran/daftar';
              $data['id'] = $id_mbkm;
              $this->load->view('main/users/index_menu', $data);
              return false;
            }
          }

          if($id_mbkm == 1) {
            $mk_pertukaran = $this->input->post('mk_pertukaran');
            $mk_konversi = $this->input->post('mk_konversi');
            
            foreach ($mk_pertukaran as $key => $value) {
              $exp_mk_konversi = explode(",",$mk_konversi[$key]);
              $data_mk = array(
                'id_pendaftaran' => $id_pendaftaran,
                'kd_prodi' => $this->session->kd_prodi,
                'kd_mk_pertukaran' => $value,
                'kd_mk' => $exp_mk_konversi[0]
              );

              if(!$this->pendaftaran_model->post_mk_pertukaran($data_mk)) {
                $this->session->set_flashdata('error_save', TRUE);
                redirect('/pendaftaran/mbkm/'.$id_mbkm);
                return false;
              }
            }
          } else {
            $mk_konversi = $this->input->post('mk_konversi');
            
            foreach ($mk_konversi as $show) {
              $data_mk = array(
                'id_pendaftaran' => $id_pendaftaran,
                'kd_mk' => $show
              );

              if(!$this->pendaftaran_model->post_mk_temp_konversi($data_mk)) {
                $this->session->set_flashdata('error_save', TRUE);
                redirect('/pendaftaran/mbkm/'.$id_mbkm);
                return false;
              }
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
        } else {
          $this->db->trans_rollback();
          $this->session->set_flashdata('error_save', TRUE);
        }

        redirect('/manajemen');
      }
    }
  }
?>
