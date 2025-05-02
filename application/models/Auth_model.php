<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {    
	public function __construct()
	{
		parent::__construct();
	}

	public function get_fakultas() {
		$query = $this->db->query("SELECT * FROM fakultas");
		return $query;
	}

	public function get_prodi() {
		$query = $this->db->query("SELECT * FROM prodi");
		return $query;
	}

	public function search_jurusan($kd_fak, $prodi) {
		$query = $this->db->query("SELECT * FROM prodi WHERE kd_fak='$kd_fak' AND nama_prodi LIKE '%$prodi%'");
		return $query;
	}
	
	public function login($email)
	{
		$query = $this->db->query("SELECT u.*, m.nim, m.nik, m.id as id_mhsw FROM users_mhsw u LEFT JOIN mahasiswa m ON u.id=m.id_user WHERE u.email='$email'");
		return $query;
	}
	
	public function login_admin($username)
	{
		$query = $this->db->query("SELECT u.*,l.level, m.nama_mitra FROM users u LEFT JOIN level l ON u.id_level=l.id LEFT JOIN mitra m on u.id_mitra=m.id WHERE u.username='$username'");
		return $query;
	}

	public function post($data)
	{
		return ($this->db->insert('mahasiswa', $data)) ? TRUE : FALSE;
	}

	public function post_inbound($data)
	{
		return ($this->db->insert('mahasiswa_inbound', $data)) ? TRUE : FALSE;
	}

	public function post_user($data)
	{
		return ($this->db->insert('users_mhsw', $data)) ? $this->db->insert_id() : FALSE;
	}
}
?>
