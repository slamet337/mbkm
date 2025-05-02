<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {    
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_admin()
	{
		$query = $this->db->query("SELECT u.*,l.level FROM users u left join level l ON u.id_level = l.id WHERE l.id = '1'");
		return $query;
	}
	
	public function get_admin_one($id)
	{
		$query = $this->db->query("SELECT * from users WHERE username='$id'");
		return $query;
	}
	
	public function get_prodi()
	{
		$query = $this->db->query("SELECT u.*,l.level,j.nama_prodi FROM users u left join level l ON u.id_level = l.id LEFT JOIN prodi j on u.kd_prodi=j.kd_prodi WHERE l.id = '2'");
		return $query;
	}

	public function get_prodi_one($id)
	{
		$query = $this->db->query("SELECT u.*, p.kd_jur from users u LEFT JOIN prodi p ON u.kd_prodi=p.kd_prodi WHERE u.username='$id'");
		return $query;
	}

	public function get_prodi_kd_jur($kd_jur)
	{
		$query = $this->db->query("SELECT * from prodi WHERE kd_jur='$kd_jur'");
		return $query;
	}

	public function get_mitra() {
		$query = $this->db->query("SELECT * from mitra");
		return $query;
	}
	
	public function get_user_mitra()
	{
		$query = $this->db->query("SELECT u.*,m.nama_mitra FROM users u left join mitra m ON u.id_mitra = m.id WHERE u.id_level = '3'");
		return $query;
	}

	public function get_user_mitra_one($id)
	{
		$query = $this->db->query("SELECT * from users WHERE username='$id'");
		return $query;
	}

	public function get_dosen()
	{
		$query = $this->db->query("SELECT u.*, d.nip, d.email, d.alamat, j.nama_prodi FROM users u left join dosen d ON u.id = d.id_user LEFT JOIN prodi j ON d.kd_prodi=j.kd_prodi WHERE u.id_level = '4'");
		return $query;
	}

	public function get_dosen_one($id)
	{
		$query = $this->db->query("SELECT u.*, d.nip, d.email, d.alamat from users u LEFT JOIN dosen d ON u.id = d.id_user WHERE u.id='$id'");
		return $query;
	}
	
	public function get_prodi_all()
	{
		$query = $this->db->query("SELECT * FROM prodi");
		return $query;
	}
	
	public function get_jurusan()
	{
		$query = $this->db->query("SELECT * FROM jurusan");
		return $query;
	}
	
	public function post($data)
	{
		return ($this->db->insert('users', $data)) ? TRUE : FALSE;
	}
	
	public function post_user_dosen($data)
	{
		return ($this->db->insert('users', $data)) ? $this->db->insert_id() : FALSE;
	}
	
	public function post_dosen($data)
	{
		return ($this->db->insert('dosen', $data)) ? TRUE : FALSE;
	}

	public function put($data, $id)
	{
		return ($this->db->update('users', $data, "username = '$id'")) ? TRUE : FALSE;
	}

	public function put_user_dosen($data, $id)
	{
		return ($this->db->update('users', $data, "id = '$id'")) ? TRUE : FALSE;
	}

	public function put_dosen($data, $id)
	{
		return ($this->db->update('dosen', $data, "id_user = '$id'")) ? TRUE : FALSE;
	}

	public function delete($id)
	{
		return ($this->db->delete('users', "username = '$id'")) ? TRUE : FALSE;
	}

	public function delete_user_dosen($id)
	{
		return ($this->db->delete('users', "id = '$id'")) ? TRUE : FALSE;
	}

	public function delete_dosen($id)
	{
		return ($this->db->delete('dosen', "id_user = '$id'")) ? TRUE : FALSE;
	}

	public function get_menu($level_id)
	{
		$query = $this->db->query("SELECT r.*,m.id as id_menu, m.menu, m.link, m.icon, m.type FROM role_menu r LEFT JOIN menu m ON r.menu_id = m.id WHERE (m.type='single_link' OR m.type='main_menu') AND r.level_id='$level_id' AND r.read='y' AND r.deleted_at is NULL  AND m.deleted_at is NULL ORDER BY m.urutan ASC");
		return $query;
	}

	public function get_submenu($id_parent,$level_id)
	{
		$query = $this->db->query("SELECT r.*,m.id as id_menu, m.menu, m.link, m.icon, m.type FROM role_menu r LEFT JOIN menu m ON r.menu_id = m.id WHERE m.id_parent='$id_parent' AND m.type='sub_menu' AND r.level_id='$level_id' AND r.read='y' AND r.deleted_at is NULL  AND m.deleted_at is NULL");
		return $query;
	}
}
?>
