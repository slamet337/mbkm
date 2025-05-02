<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kegiatan_mbkm_luar extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model("kegiatan_mbkm_luar_model");
    date_default_timezone_set("Asia/Makassar");
	}

	public function index()
	{
		$data['data'] = array(
			'kegiatan_mbkm_luar' => $this->kegiatan_mbkm_luar_model->get_kegiatan_mbkm_luar($this->session->id_mhsw)->result(),
		);
		$data['content'] = 'menu/kegiatan_mbkm_luar/index';
    $this->load->view('main/users/index_menu', $data);
	}

  public function add()
	{
    $data['mbkm'] = $this->kegiatan_mbkm_luar_model->get_program_mbkm();
    $data['dosen'] = $this->kegiatan_mbkm_luar_model->get_dosen();
    $data['matakuliah'] = $this->kegiatan_mbkm_luar_model->get_matakuliah();
		$data['content'] = 'menu/kegiatan_mbkm_luar/add';
    $this->load->view('main/users/index_menu', $data);
	}

  public function post() {

    // $this->load->library('upload');

    // // Konfigurasi Upload
    // $upload_paths = './uploads/'; // Folder penyimpanan file
    // $config = [
    //     'upload_path'   => $upload_paths,
    //     'allowed_types' => 'jpg|png|pdf|docx',
    //     'max_size'      => 2048, // Maksimal 2MB
    // ];

    $this->form_validation->set_rules('jenis_mbkm', 'Jenis MBKM', 'required');
    $this->form_validation->set_rules('id_program_mbkm', 'Program MBKM', 'required');
    $this->form_validation->set_rules('nama_kegiatan', 'Nama Kegiatan', 'required');
    $this->form_validation->set_rules('semester', 'Semester', 'required');
    $this->form_validation->set_rules('penyelenggara_mbkm', 'Penyelenggara MBKM', 'required');
    $this->form_validation->set_rules('nama_mentor', 'Nama Mentor', 'required');
    $this->form_validation->set_rules('lokasi_kegiatan', 'Lokasi Kegiatan', 'required');
    
    
    $this->form_validation->set_message('required', '{field} harus terisi.');

    // function upload_file($field_name, $config)
    // {
    //     $CI =& get_instance();
    //     $config['file_name'] = time() . '_' . $_FILES[$field_name]['name']; // Nama unik
    //     $CI->upload->initialize($config);

    //     if (!$CI->upload->do_upload($field_name)) {
    //         return null; // Gagal upload, return null
    //     } else {
    //         return $CI->upload->data('file_name'); // Berhasil, return nama file
    //     }
    // }

    // $sertifikat = upload_file('sertifikat', $config);
    // $link       = upload_file('link', $config);
    // $foto       = upload_file('foto', $config);
    // $surat_tugas= upload_file('surat_tugas', $config);
    
    if ($this->form_validation->run() === FALSE)
    { 
      $data['mbkm'] = $this->kegiatan_mbkm_luar_model->get_program_mbkm();
      $data['dosen'] = $this->kegiatan_mbkm_luar_model->get_dosen();
      $data['matakuliah'] = $this->kegiatan_mbkm_luar_model->get_matakuliah();
      $data['content'] = 'menu/kegiatan_mbkm_luar/add';
      $this->load->view('main/users/index_menu', $data);
    }
    else
    {
      $data = array(
        'id_mhsw' => $this->session->id_mhsw,
        'jenis_mbkm' => $this->input->post('jenis_mbkm'),
        'id_program_mbkm' => $this->input->post('id_program_mbkm'),
        'nama_kegiatan' => $this->input->post('nama_kegiatan'),
        'id_dosen' => $this->input->post('id_dosen'),
        'dosen_lainnya' => $this->input->post('dosen_lainnya'),
        'semester' => $this->input->post('semester'),
        'lokasi_kegiatan' => $this->input->post('lokasi_kegiatan'),
        'penyelenggara_mbkm' => $this->input->post('penyelenggara_mbkm'),
        'nama_mentor' => $this->input->post('nama_mentor'),
        // 'jenis_kegiatan' => $this->input->post('jenis_kegiatan'),
        // 'juml_negara' => $this->input->post('juml_negara'),
        // 'juml_pt' => $this->input->post('juml_pt'),
        // 'model_pelaksana' => $this->input->post('model_pelaksana'),
        // 'jenis_peserta' => $this->input->post('jenis_peserta'),
        // 'peringkat' => $this->input->post('peringkat'),
        // 'nomor_serti' => $this->input->post('nomor_serti'),
        // 'sertifikat' => $sertifikat,
        // 'link' => $link,
        // 'foto' => $foto,
        // 'surat_tugas' => $surat_tugas,

      );

      $this->db->trans_start();
      $id = $this->kegiatan_mbkm_luar_model->post($data);
      if ($id) {
        $kode_mk = $this->input->post('kode_mk');
        foreach ($kode_mk as $show) {
          $data_mk = array(
            'id_kegiatan_mbkm_lain' => $id,
            'kd_mk' => $show,
            'id_user' => $this->session->id,
          );

          $this->kegiatan_mbkm_luar_model->post_mk($data_mk);
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
        $this->session->set_flashdata('error_save', TRUE);
      }

      redirect('/kegiatan_mbkm_luar');
    }
  }

  public function edit($id)
	{
    $data['kegiatan'] = $this->kegiatan_mbkm_luar_model->get_kegiatan_mbkm_luar_one($id)->row();
    $data['matakuliah_lain'] = $this->kegiatan_mbkm_luar_model->get_matakuliah_lain_one($id)->result();
    $data['mbkm'] = $this->kegiatan_mbkm_luar_model->get_program_mbkm();
    $data['dosen'] = $this->kegiatan_mbkm_luar_model->get_dosen();
    $data['matakuliah'] = $this->kegiatan_mbkm_luar_model->get_matakuliah();
		$data['content'] = 'menu/kegiatan_mbkm_luar/edit';
    $this->load->view('main/users/index_menu', $data);
	}

  public function update($id) {

    // Konfigurasi Upload
    // $upload_paths = './uploads/'; // Folder penyimpanan file
    // $config = [
    //     'upload_path'   => $upload_paths,
    //     'allowed_types' => 'jpg|png|pdf|docx',
    //     'max_size'      => 2048, // Maksimal 2MB
    // ];

    $this->form_validation->set_rules('jenis_mbkm', 'Jenis MBKM', 'required');
    $this->form_validation->set_rules('id_program_mbkm', 'Program MBKM', 'required');
    $this->form_validation->set_rules('nama_kegiatan', 'Nama Kegiatan', 'required');
    $this->form_validation->set_rules('semester', 'Semester', 'required');
    $this->form_validation->set_rules('penyelenggara_mbkm', 'Penyelenggara MBKM', 'required');
    $this->form_validation->set_rules('nama_mentor', 'Nama Mentor', 'required');
    $this->form_validation->set_rules('lokasi_kegiatan', 'Lokasi Kegiatan', 'required');
    
    $this->form_validation->set_message('required', '{field} harus terisi.');
    

    // $sertifikat = upload_file('sertifikat', $config);
    // $link       = upload_file('link', $config);
    // $foto       = upload_file('foto', $config);
    // $surat_tugas= upload_file('surat_tugas', $config);

    if ($this->form_validation->run() === FALSE)
    {
      $data['kegiatan'] = $this->kegiatan_mbkm_luar_model->get_kegiatan_mbkm_luar_one($id)->row();
      $data['matakuliah_lain'] = $this->kegiatan_mbkm_luar_model->get_matakuliah_lain_one($id)->result();
      $data['mbkm'] = $this->kegiatan_mbkm_luar_model->get_program_mbkm();
      $data['dosen'] = $this->kegiatan_mbkm_luar_model->get_dosen();
      $data['matakuliah'] = $this->kegiatan_mbkm_luar_model->get_matakuliah();
      $data['content'] = 'menu/kegiatan_mbkm_luar/edit';
      $this->load->view('main/users/index_menu', $data);
    }
    else
    {
      $data = array(
        'id_mhsw' => $this->session->id_mhsw,
        'jenis_mbkm' => $this->input->post('jenis_mbkm'),
        'id_program_mbkm' => $this->input->post('id_program_mbkm'),
        'nama_kegiatan' => $this->input->post('nama_kegiatan'),
        'id_dosen' => $this->input->post('id_dosen'),
        'dosen_lainnya' => $this->input->post('dosen_lainnya'),
        'semester' => $this->input->post('semester'),
        'lokasi_kegiatan' => $this->input->post('lokasi_kegiatan'),
        'penyelenggara_mbkm' => $this->input->post('penyelenggara_mbkm'),
        'nama_mentor' => $this->input->post('nama_mentor'),
        // 'jenis_kegiatan' => $this->input->post('jenis_kegiatan'),
        // 'juml_negara' => $this->input->post('juml_negara'),
        // 'juml_pt' => $this->input->post('juml_pt'),
        // 'model_pelaksana' => $this->input->post('model_pelaksana'),
        // 'jenis_peserta' => $this->input->post('jenis_peserta'),
        // 'peringkat' => $this->input->post('peringkat'),
        // 'nomor_serti' => $this->input->post('nomor_serti'),
        // 'sertifikat' => $sertifikat,
        // 'link' => $link,
        // 'foto' => $foto,
        // 'surat_tugas' => $surat_tugas,

      );

      $this->db->trans_start();
      if ($this->kegiatan_mbkm_luar_model->put($data, $id)) {
        $mk_lain = $this->kegiatan_mbkm_luar_model->get_matakuliah_lain_one($id)->result();

				foreach ($mk_lain as $show) {
          $data_mk = array(
            'kd_mk' => $this->input->post('kode_mk_'.$show->id),
            'id_user' => $this->session->id,
          );

          $this->kegiatan_mbkm_luar_model->put_mk($data_mk, $show->id);
        }

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
          $this->db->trans_rollback();
          $this->session->set_flashdata('error_update', TRUE);
        } 
        else {
          $this->db->trans_commit();
          $this->session->set_flashdata('success_update', TRUE);            
        }
      } else {
        $this->session->set_flashdata('error_update', TRUE);
      }

      redirect('/kegiatan_mbkm_luar');
    }
  }

  public function delete()
	{
		$data = new stdClass();
		if ($this->kegiatan_mbkm_luar_model->delete($this->input->post('id'))) {
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