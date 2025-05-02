<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengumuman_model extends CI_Model {    
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_pengumuman()
	{
		$query = $this->db->query("SELECT * FROM pengumuman");
		return $query;
	}

	public function get_pengumuman_one($id)
	{
		$query = $this->db->query("SELECT * from pengumuman WHERE id='$id'");
		return $query;
	}

	public function get_mahasiswa()
	{
		$query = $this->db->query("SELECT m.email from mahasiswa m LEFT JOIN users_mhsw u ON m.id_user = u.id WHERE u.level='mahasiswa'");
		return $query;
	}

	public function get_mahasiswa_prodi($prodi)
	{
		$query = $this->db->query("SELECT m.email from mahasiswa m LEFT JOIN users_mhsw u ON m.id_user = u.id WHERE u.level='mahasiswa' AND kd_prodi='$prodi'");
		return $query;
	}

	public function get_mitra()
	{
		$query = $this->db->query("SELECT email from mitra");
		return $query;
	}

	public function get_mahasiswa_inbound()
	{
		$query = $this->db->query("SELECT email from mahasiswa_inbound");
		return $query;
	}

	public function get_dosen()
	{
		$query = $this->db->query("SELECT email from dosen");
		return $query;
	}

	public function get_alumni()
	{
		$query = $this->db->query("SELECT m.email from mahasiswa m LEFT JOIN users_mhsw u ON m.id_user = u.id WHERE u.level='alumni'");
		return $query;
	}
	
	public function post($data)
	{
		return ($this->db->insert('pengumuman', $data)) ? TRUE : FALSE;
	}

	public function put($data, $id)
	{
		return ($this->db->update('pengumuman', $data, "id = '$id'")) ? TRUE : FALSE;
	}

	public function delete($id)
	{
		return ($this->db->delete('pengumuman', "id = '$id'")) ? TRUE : FALSE;
	}
}
?>
