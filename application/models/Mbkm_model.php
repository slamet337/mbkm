<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mbkm_model extends CI_Model {    
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_mbkm()
	{
		$query = $this->db->query("SELECT * FROM program_mbkm");
		return $query;
	}

	public function get_mbkm_one($id)
	{
		$query = $this->db->query("SELECT * from program_mbkm WHERE id='$id'");
		return $query;
	}

	public function get_kegiatan($id_mitra)
	{
		$query = $this->db->query("SELECT k.*, m.nama_program FROM program_kegiatan k LEFT JOIN program_mbkm m ON k.id_program=m.id WHERE k.id_mitra='$id_mitra'");
		return $query;
	}

	public function get_kegiatan_one($id)
	{
		$query = $this->db->query("SELECT * FROM program_kegiatan WHERE id='$id'");
		return $query;
	}

	public function get_mk_pertukaran($id_kegiatan)
	{
		$query = $this->db->query("SELECT * FROM matakuliah_pertukaran WHERE id_program_kegiatan ='$id_kegiatan'");
		return $query;
	}

	public function get_persyaratan()
	{
		$query = $this->db->query("SELECT p.*, k.nama_kegiatan, m.nama_program  FROM persyaratan_kegiatan p LEFT JOIN program_kegiatan k ON p.id_kegiatan=k.id LEFT JOIN program_mbkm m ON k.id_program=m.id");
		return $query;
	}

	public function get_persyaratan_one($id)
	{
		$query = $this->db->query("SELECT * from persyaratan_kegiatan WHERE id='$id'");
		return $query;
	}

	public function get_mentor($id_mitra)
	{
		$query = $this->db->query("SELECT * from mentor WHERE id_mitra='$id_mitra'");
		return $query;
	}
	
	public function post($data)
	{
		return ($this->db->insert('program_mbkm', $data)) ? TRUE : FALSE;
	}
	
	public function post_kegiatan($data)
	{
		return ($this->db->insert('program_kegiatan', $data)) ? $this->db->insert_id() : FALSE;
	}

	public function post_persyaratan($data)
	{
		return ($this->db->insert('persyaratan_kegiatan', $data)) ? TRUE : FALSE;
	}

	public function post_mk_pertukaran($data)
	{
		return ($this->db->insert('matakuliah_pertukaran', $data)) ? TRUE : FALSE;
	}

	public function put($data, $id)
	{
		return ($this->db->update('program_mbkm', $data, "id = '$id'")) ? TRUE : FALSE;
	}

	public function put_kegiatan($data, $id)
	{
		return ($this->db->update('program_kegiatan', $data, "id = '$id'")) ? TRUE : FALSE;
	}

	public function put_matakuliah_tukar($data, $id)
	{
		return ($this->db->update('matakuliah_pertukaran', $data, "id = '$id'")) ? TRUE : FALSE;
	}

	public function put_persyaratan($data, $id)
	{
		return ($this->db->update('persyaratan_kegiatan', $data, "id = '$id'")) ? TRUE : FALSE;
	}

	public function delete($id)
	{
		return ($this->db->delete('program_mbkm', "id = '$id'")) ? TRUE : FALSE;
	}

	public function delete_kegiatan($id)
	{
		return ($this->db->delete('program_kegiatan', "id = '$id'")) ? TRUE : FALSE;
	}

	public function delete_persyaratan($id)
	{
		return ($this->db->delete('persyaratan_kegiatan', "id = '$id'")) ? TRUE : FALSE;
	}
}
?>
