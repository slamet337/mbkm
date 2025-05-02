<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil_mitra_model extends CI_Model {    
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_profil_mitra($id)
	{
		$query = $this->db->query("SELECT * from mitra WHERE id='$id'");
		return $query;
	}
	
	public function get_profil_mitra_one($id)
	{
		$query = $this->db->query("SELECT * from users WHERE id='$id'");
		return $query;
	}
	
	public function put($data, $id)
	{
		return ($this->db->update('mitra', $data, "id = '$id'")) ? TRUE : FALSE;
	}

	
	public function put_setting_dosen($data_setting_dosen, $id)
	{
		return ($this->db->update('users', $data_setting_dosen, "id = '$id'")) ? TRUE : FALSE;
	}
}
?>
