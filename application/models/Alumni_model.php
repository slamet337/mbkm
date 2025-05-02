<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alumni_model extends CI_Model {    
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_alumni($id)
	{
		$query = $this->db->query("SELECT * FROM riwayat_alumni WHERE id_mhsw='$id' ORDER BY tanggal_mulai ASC");
		return $query;
	}
	
	public function get_alumni_one($id)
	{
		$query = $this->db->query("SELECT * FROM riwayat_alumni WHERE id='$id'");
		return $query;
	}

	public function get_alumni_all()
	{
		$query = $this->db->query("SELECT a.*, m.full_name as nama FROM riwayat_alumni a LEFT JOIN users_mhsw m ON a.id_mhsw=m.id");
		return $query;
	}

	public function get_alumni_all_prodi($kd_prodi)
	{
		$query = $this->db->query("SELECT a.*, m.full_name as nama FROM riwayat_alumni a LEFT JOIN users_mhsw m ON a.id_mhsw=m.id WHERE m.kd_prodi='$kd_prodi'");
		return $query;
	}
	
	public function post($data)
	{
		return ($this->db->insert('riwayat_alumni', $data)) ? TRUE : FALSE;
	}

	public function put($data, $id)
	{
		return ($this->db->update('riwayat_alumni', $data, "id = '$id'")) ? TRUE : FALSE;
	}

	public function delete($id)
	{
		return ($this->db->delete('riwayat_alumni', "id = '$id'")) ? TRUE : FALSE;
	}
}
?>
