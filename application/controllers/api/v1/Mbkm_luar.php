<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;
use application\libraries\JwtEdDSA;


class Mbkm_luar extends RestController {

    function __construct()
    {
        parent::__construct();
		$this->load->model("kegiatan_mbkm_luar_model");
        $this->load->library('JwtEdDSA', null, 'JwtEdDSA');
    }

    public function index_get()
    {
        $program = $this->kegiatan_mbkm_luar_model->get_program_mbkm();
            
        if ($program->num_rows() > 0) {
            $this->response([
                'status' => true,
                'data' => $program->result()
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'No data found'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }
    public function index_post()
    {
        $_POST = $this->post();
        $this->load->library('form_validation');

        $this->form_validation->set_rules('jenis_mbkm', 'Jenis MBKM', 'required');
        $this->form_validation->set_rules('id_program_mbkm', 'Program MBKM', 'required');
        $this->form_validation->set_rules('nama_kegiatan', 'Nama Kegiatan', 'required');
        $this->form_validation->set_rules('semester', 'Semester', 'required');
        $this->form_validation->set_rules('penyelenggara_mbkm', 'Penyelenggara MBKM', 'required');
        $this->form_validation->set_rules('nama_mentor', 'Nama Mentor', 'required');
        $this->form_validation->set_rules('lokasi_kegiatan', 'Lokasi Kegiatan', 'required');
        $this->form_validation->set_message('required', '{field} harus terisi.');

        if ($this->form_validation->run() === FALSE) {
            return $this->response([
                'status' => false,
                'errors' => $this->form_validation->error_array(),
                'data'  => $this->post()
            ], RestController::HTTP_BAD_REQUEST);
        }

        $data = array(
            'id_mhsw' => $this->post('id_mhsw'),
            'jenis_mbkm' => $this->post('jenis_mbkm'),
            'id_program_mbkm' => $this->post('id_program_mbkm'),
            'nama_kegiatan' => $this->post('nama_kegiatan'),
            'id_dosen' => $this->post('id_dosen'),
            'dosen_lainnya' => $this->post('dosen_lainnya'),
            'semester' => $this->post('semester'),
            'lokasi_kegiatan' => $this->post('lokasi_kegiatan'),
            'penyelenggara_mbkm' => $this->post('penyelenggara_mbkm'),
            'nama_mentor' => $this->post('nama_mentor'),
        );

        $this->db->trans_start();
        $id = $this->kegiatan_mbkm_luar_model->post($data);

        if ($id) {
            $kode_mk = $this->post('kode_mk');
            if (is_array($kode_mk)) {
                foreach ($kode_mk as $kd_mk) {
                    $data_mk = array(
                        'id_kegiatan_mbkm_lain' => $id,
                        'kd_mk' => $kd_mk,
                        'id_user' => $this->post('id_mhsw'),
                    );
                    $this->kegiatan_mbkm_luar_model->post_mk($data_mk);
                }
            }
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return $this->response([
                    'status' => false,
                    'message' => 'Gagal menyimpan data'
                ], RestController::HTTP_INTERNAL_SERVER_ERROR);
            }

            return $this->response([
                'status' => true,
                'message' => 'Data berhasil disimpan',
                'id' => $id
            ], RestController::HTTP_CREATED);

        } else {
            return $this->response([
                'status' => false,
                'message' => 'Gagal menyimpan data'
            ], RestController::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function index_put($id)
    {
        // Load library form_validation jika belum autoload
        $this->load->library('form_validation');

        // Set rules
        $this->form_validation->set_data($this->put()); // ambil data dari PUT
        $this->form_validation->set_rules('jenis_mbkm', 'Jenis MBKM', 'required');
        $this->form_validation->set_rules('id_program_mbkm', 'Program MBKM', 'required');
        $this->form_validation->set_rules('nama_kegiatan', 'Nama Kegiatan', 'required');
        $this->form_validation->set_rules('semester', 'Semester', 'required');
        $this->form_validation->set_rules('penyelenggara_mbkm', 'Penyelenggara MBKM', 'required');
        $this->form_validation->set_rules('nama_mentor', 'Nama Mentor', 'required');
        $this->form_validation->set_rules('lokasi_kegiatan', 'Lokasi Kegiatan', 'required');

        $this->form_validation->set_message('required', '{field} harus terisi.');

        if ($this->form_validation->run() === FALSE) {
            return $this->response([
                'status' => false,
                'message' => $this->form_validation->error_array()
            ], RestController::HTTP_BAD_REQUEST);
        }

        $data = array(
            'id_mhsw' => $this->put('id_mhsw'),
            'jenis_mbkm' => $this->put('jenis_mbkm'),
            'id_program_mbkm' => $this->put('id_program_mbkm'),
            'nama_kegiatan' => $this->put('nama_kegiatan'),
            'id_dosen' => $this->put('id_dosen'),
            'dosen_lainnya' => $this->put('dosen_lainnya'),
            'semester' => $this->put('semester'),
            'lokasi_kegiatan' => $this->put('lokasi_kegiatan'),
            'penyelenggara_mbkm' => $this->put('penyelenggara_mbkm'),
            'nama_mentor' => $this->put('nama_mentor'),
        );

        $this->db->trans_start();

        if ($this->kegiatan_mbkm_luar_model->put($data, $id)) {
            $mk_lain = $this->kegiatan_mbkm_luar_model->get_matakuliah_lain_one($id)->result();

            foreach ($mk_lain as $show) {
                $data_mk = array(
                    'kd_mk' => $this->put('kode_mk_' . $show->id),
                    'id_user' => $this->post('id_mhsw'),
                );
                $this->kegiatan_mbkm_luar_model->put_mk($data_mk, $show->id);
            }

            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return $this->response([
                    'status' => false,
                    'message' => 'Gagal memperbarui data'
                ], RestController::HTTP_INTERNAL_SERVER_ERROR);
            } else {
                $this->db->trans_commit();
                return $this->response([
                    'status' => true,
                    'message' => 'Data berhasil diperbarui'
                ], RestController::HTTP_OK);
            }
        } else {
            return $this->response([
                'status' => false,
                'message' => 'Gagal memperbarui data'
            ], RestController::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function kegiatan_mahasiswa_get()
    {

        $id = $this->get('id');

        if ($id) {
            $kegiatan = $this->kegiatan_mbkm_luar_model->get_kegiatan_mbkm_luar($id);
        } else {
            $kegiatan = $this->kegiatan_mbkm_luar_model->get_program_mbkm();
        }

        if ($kegiatan->num_rows() > 0) {
            $this->response([
                'status' => true,
                'data' => $kegiatan->result()
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'No data found'
            ], RestController::HTTP_BAD_REQUEST);
        }

    }

    public function mk_konversi_get($id = null) {
        if (!$id ) {
            $this->response([
                'status' => false,
                'message' => 'Data tidak ditemukan',
                'id' => $id
            ], RestController::HTTP_NOT_FOUND);
        }

        $mk_kegiatan = $this->kegiatan_mbkm_luar_model->get_matakuliah_lain_one(9);
        if ($mk_kegiatan->num_rows() > 0) {
            $this->response([
                'status' => true,
                'data' => $mk_kegiatan->result()
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'No data found',
                'id' => $id
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function mk_konversi_put($id = null) {
        if (!$id ) {
            $this->response([
                'status' => false,
                'message' => 'Data tidak ditemukan',
                'id' => $id
            ], RestController::HTTP_NOT_FOUND);
        }

        $this->load->library('form_validation');
        $this->form_validation->set_data($this->put());
        $this->form_validation->set_rules('kd_mk', 'Kode MK', 'required');
        $this->form_validation->set_message('required', '{field} harus terisi.');

        if ($this->form_validation->run() === FALSE) {
            return $this->response([
                'status' => false,
                'message' => $this->form_validation->error_array()
            ], RestController::HTTP_BAD_REQUEST);
        }

        $data = array(
            'kd_mk' => $this->put('kd_mk')
        );

        if ($this->kegiatan_mbkm_luar_model->put_mk($data, $id)) {
            return $this->response([
                'status' => true,
                'message' => 'Data berhasil diperbarui'
            ], RestController::HTTP_OK);
        } else {
            return $this->response([
                'status' => false,
                'message' => 'Gagal memperbarui data'
            ], RestController::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    public function jenis_get() {
        $this->response([
            'status' => true,
            'data' => [
                ['value' => 'Kementerian', 'label' => 'Kementerian'],
                ['value' => 'Universitas', 'label' => 'Universitas']
            ]
        ], RestController::HTTP_OK);
    }

}