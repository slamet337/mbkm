<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Matakuliah_inbound_model extends CI_Model {    
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_jadwal($kd_prodi)
	{
		$query = $this->db->query("SELECT j.*, m.matakuliah FROM jadwal_kuliah_inbound j LEFT JOIN matakuliah m ON j.kd_mk = m.kd_mk WHERE j.kd_prodi='$kd_prodi'");
		return $query;
	}
	
	public function get_jadwal_one($id)
	{
		$query = $this->db->query("SELECT j.*, m.matakuliah FROM jadwal_kuliah_inbound j LEFT JOIN matakuliah m ON j.kd_mk = m.kd_mk WHERE j.id='$id'");
		return $query;
	}
	
	public function get_matakuliah()
	{
		$query = $this->db->query("SELECT * FROM matakuliah");
		return $query;
	}

	public function post($data)
	{
		return ($this->db->insert('jadwal_kuliah_inbound', $data)) ? TRUE : FALSE;
	}
	
	public function put($data, $id)
	{
		return ($this->db->update('jadwal_kuliah_inbound', $data, "id = '$id'")) ? TRUE : FALSE;
	}

	public function delete($id)
	{
		return ($this->db->delete('jadwal_kuliah_inbound', "id = '$id'")) ? TRUE : FALSE;
	}
}
?>
