<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Matakuliah_model extends CI_Model {    
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_matakuliah()
	{
		$query = $this->db->query("SELECT m.*, mb.nama_program, k.nama_kegiatan, d.nama, mk.matakuliah FROM konversi_matakuliah m LEFT JOIN program_kegiatan k ON m.id_program_kegiatan=k.id LEFT JOIN program_mbkm mb ON k.id_program=mb.id LEFT JOIN matakuliah mk ON m.kd_mk=mk.kd_mk LEFT JOIN dosen d ON mk.id_dosen=d.id");
		return $query;
	}

	public function get_matakuliah_one($id)
	{
		$query = $this->db->query("SELECT * from konversi_matakuliah WHERE id='$id'");
		return $query;
	}

	public function get_kegiatan()
	{
		$query = $this->db->query("SELECT k.*, m.nama_mitra FROM program_kegiatan k LEFT JOIN mitra m ON k.id_mitra=m.id");
		return $query;
	}

	public function get_dosen()
	{
		$query = $this->db->query("SELECT * FROM dosen");
		return $query;
	}
	
	public function post($data)
	{
		return ($this->db->insert('konversi_matakuliah', $data)) ? TRUE : FALSE;
	}
	
	public function put($data, $id)
	{
		return ($this->db->update('konversi_matakuliah', $data, "id = '$id'")) ? TRUE : FALSE;
	}

	public function delete($id)
	{
		return ($this->db->delete('konversi_matakuliah', "id = '$id'")) ? TRUE : FALSE;
	}

	public function get_matakuliah_prodi()
	{
		
		$query = $this->db->query("SELECT * from matakuliah");
		return $query;
	}
	
	public function post_matakuliah($data)
	{
		return ($this->db->insert('matakuliah', $data)) ? TRUE : FALSE;
	}

	public function get_list_matakuliah_one($id)
	{
		$query = $this->db->query("SELECT * from matakuliah WHERE kd_mk='$id'");
		return $query;
	}
	
	public function put_matakuliah($data, $id)
	{
		return ($this->db->update('matakuliah', $data, "kd_mk = '$id'")) ? TRUE : FALSE;
	}

	public function delete_matakuliah($id)
	{
		return ($this->db->delete('matakuliah', "kd_mk = '$id'")) ? TRUE : FALSE;
	}
}
?>
