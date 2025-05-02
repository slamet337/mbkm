<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mentor_model extends CI_Model {    
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_mentor($id_mitra)
	{
		$query = $this->db->query("SELECT * FROM mentor WHERE id_mitra='$id_mitra'");
		return $query;
	}

	public function get_mentor_one($id)
	{
		$query = $this->db->query("SELECT * from mentor WHERE id='$id'");
		return $query;
	}

	public function post($data)
	{
		return ($this->db->insert('mentor', $data)) ? TRUE : FALSE;
	}
	
	public function put($data, $id)
	{
		return ($this->db->update('mentor', $data, "id = '$id'")) ? TRUE : FALSE;
	}

	public function delete($id)
	{
		return ($this->db->delete('mentor', "id = '$id'")) ? TRUE : FALSE;
	}
}
?>
