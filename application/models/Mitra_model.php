<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mitra_model extends CI_Model {    
	public function __construct()
	{
		parent::__construct();
	}

	public function get_detail_mitra($id)
	{
		$query = $this->db->query("SELECT * FROM program_kegiatan WHERE id_mitra='$id' AND (waktu_mulai <= CURDATE() AND waktu_selesai >= CURDATE())");
		return $query;
	}
	
	public function get_matakuliah_pertukaran($id_kegiatan)
	{
		$query = $this->db->query("SELECT * FROM matakuliah_pertukaran WHERE id_program_kegiatan='$id_kegiatan'");
		return $query;
	}
	
	public function get_mitra()
	{
		$query = $this->db->query("SELECT * FROM mitra");
		return $query;
	}

	public function get_mitra_one($id)
	{
		$query = $this->db->query("SELECT * from mitra WHERE id='$id'");
		return $query;
	}
	
	public function post($data)
	{
		return ($this->db->insert('mitra', $data)) ? TRUE : FALSE;
	}

	public function put($data, $id)
	{
		return ($this->db->update('mitra', $data, "id = '$id'")) ? TRUE : FALSE;
	}

	public function delete($id)
	{
		return ($this->db->delete('mitra', "id = '$id'")) ? TRUE : FALSE;
	}
}
?>
