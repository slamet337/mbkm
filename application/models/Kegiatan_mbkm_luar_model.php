<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kegiatan_mbkm_luar_model extends CI_Model {    
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_kegiatan_mbkm_luar($id)
	{
		$query = $this->db->query("SELECT k.*, p.nama_program from kegiatan_mbkm_lain k LEFT JOIN program_mbkm p ON k.id_program_mbkm = p.id WHERE k.id_mhsw='$id'");
		return $query;
	}
	
	public function get_kegiatan_mbkm_luar_one($id)
	{
		$query = $this->db->query("SELECT k.*, p.nama_program from kegiatan_mbkm_lain k LEFT JOIN program_mbkm p ON k.id_program_mbkm = p.id WHERE k.id='$id'");
		return $query;
	}

	public function get_matakuliah_lain_one($id)
	{
		$query = $this->db->query("SELECT * FROM mk_kegiatan WHERE id_kegiatan_mbkm_lain='$id'");
		return $query;
	}

	public function get_program_mbkm()
	{
		$query = $this->db->query("SELECT * from program_mbkm");
		return $query;
	}

	public function get_dosen()
	{
		$query = $this->db->query("SELECT * from dosen");
		return $query;
	}

	public function get_matakuliah()
	{
		$query = $this->db->query("SELECT * from matakuliah");
		return $query;
	}
	
	public function post($data)
	{
		return ($this->db->insert('kegiatan_mbkm_lain', $data)) ? $this->db->insert_id() : FALSE;
	}
	
	public function post_mk($data)
	{
		return ($this->db->insert('mk_kegiatan', $data)) ? TRUE : FALSE;
	}

	public function put($data, $id)
	{
		return ($this->db->update('kegiatan_mbkm_lain', $data, "id = '$id'")) ? TRUE : FALSE;
	}

	public function put_mk($data, $id)
	{
		return ($this->db->update('mk_kegiatan', $data, "id = '$id'")) ? TRUE : FALSE;
	}

	public function delete($id)
	{
		$kegiatan = $this->db->delete('kegiatan_mbkm_lain', "id = '$id'") ? TRUE : FALSE;
		$mk = $this->db->delete('mk_kegiatan', "id_kegiatan_mbkm_lain = '$id'") ? TRUE : FALSE;
		return ($kegiatan && $mk);
	}
}
?>
