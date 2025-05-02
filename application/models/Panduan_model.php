<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Panduan_model extends CI_Model {    
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_panduan()
	{
		$query = $this->db->query("SELECT * FROM panduan");
		return $query;
	}

	public function get_panduan_one($id)
	{
		$query = $this->db->query("SELECT * from panduan WHERE id='$id'");
		return $query;
	}

	public function post($data)
	{
		return ($this->db->insert('panduan', $data)) ? TRUE : FALSE;
	}

	public function put($data, $id)
	{
		return ($this->db->update('panduan', $data, "id = '$id'")) ? TRUE : FALSE;
	}

	public function delete($id)
	{
		return ($this->db->delete('panduan', "id = '$id'")) ? TRUE : FALSE;
	}
}
?>
