<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran_luar_model extends CI_Model {    
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_pendaftar_prodi($kd_prodi)
	{
		$query = $this->db->query("SELECT k.*,m.nama,pm.nama_program, d.nama as nama_dosen FROM kegiatan_mbkm_lain k LEFT JOIN mahasiswa m ON k.id_mhsw=m.id LEFT JOIN program_mbkm pm ON k.id_program_mbkm=pm.id LEFT JOIN dosen d ON k.id_dosen = d.id WHERE m.kd_prodi='$kd_prodi'");
		return $query;
	}
	
	public function get_mk_luar_prodi($id_kegiatan_mbkm_lain)
	{
		$query = $this->db->query("SELECT id from mk_kegiatan WHERE id_kegiatan_mbkm_lain='$id_kegiatan_mbkm_lain'");
		return $query->num_rows();
	}
	
	public function get_mk_luar_prodi_with_nilai($id_kegiatan_mbkm_lain)
	{
		$query = $this->db->query("SELECT id from mk_kegiatan WHERE id_kegiatan_mbkm_lain='$id_kegiatan_mbkm_lain' AND (nilai IS NOT NULL OR nilai != '0' )");
		return $query->num_rows();
	}

	public function get_matakuliah_kegiatan_lain($id)
	{
		$query = $this->db->query("SELECT mk.*, m.matakuliah FROM mk_kegiatan mk LEFT JOIN matakuliah m ON mk.kd_mk=m.kd_mk WHERE id_kegiatan_mbkm_lain='$id'");
		return $query;
	}

	public function get_mahasiswa($id)
	{
		$query = $this->db->query("SELECT k.id, m.angkatan FROM kegiatan_mbkm_lain k LEFT JOIN mahasiswa m ON k.id_mhsw=m.id WHERE k.id='$id'");
		return $query;
	}

	public function post($data)
	{
		return ($this->db->insert('pendaftaran', $data)) ? $this->db->insert_id() : FALSE;
	}

	public function post_mk_pertukaran($data)
	{
		return ($this->db->insert('konversi_mk_pertukaran', $data)) ? TRUE : FALSE;
	}

	public function post_mk_temp_konversi($data)
	{
		return ($this->db->insert('temp_mk_pertukaran', $data)) ? TRUE : FALSE;
	}

	public function post_konversi_mk($data)
	{
		return ($this->db->insert('konversi_matakuliah', $data)) ? TRUE : FALSE;
	}

	public function post_persyaratan($data)
	{
		return ($this->db->insert('persyaratan_pendaftaran', $data)) ? TRUE : FALSE;
	}

	public function post_nilai($data)
	{
		return ($this->db->insert('nilai_kegiatan', $data)) ? TRUE : FALSE;
	}

	public function post_nilai_pertukaran($data)
	{
		return ($this->db->insert('nilai_mk_pertukaran', $data)) ? TRUE : FALSE;
	}

	public function put($data, $id)
	{
		return ($this->db->update('pendaftaran', $data, "id = '$id'")) ? TRUE : FALSE;
	}

	public function put_ditolak($id, $id_mhsw)
	{
		$sql = $this->db->query("UPDATE pendaftaran p JOIN program_kegiatan AS k ON p.id_kegiatan = k.id SET p.status_pendaftaran = 'Ditolak' WHERE k.id_program != '1' AND p.id_mhsw = '$id_mhsw' AND p.id != '$id' AND p.status_kegiatan='Belum Aktif'");
		return $sql ? TRUE : FALSE;
	}

	public function put_kuota_kegiatan($data, $id)
	{
		return ($this->db->update('program_kegiatan', $data, "id = '$id'")) ? TRUE : FALSE;
	}

	public function put_kuota_kegiatan_pertukaran($data, $id)
	{
		return ($this->db->update('matakuliah_pertukaran', $data, "id = '$id'")) ? TRUE : FALSE;
	}

	public function put_nilai_mk_lain($data, $id)
	{
		return ($this->db->update('mk_kegiatan', $data, "id = '$id'")) ? TRUE : FALSE;
	}

	public function delete($id)
	{
		return ($this->db->delete('pendaftaran', "id = '$id'")) ? TRUE : FALSE;
	}
}
?>
