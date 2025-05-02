<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logbook_model extends CI_Model {    
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_logbook($id)
	{
		$query = $this->db->query("SELECT l.*,k.nama_kegiatan FROM logbook l LEFT JOIN pendaftaran p ON l.id_pendaftaran=p.id LEFT JOIN program_kegiatan k ON p.id_kegiatan=k.id WHERE l.id_mhsw='$id' AND (p.status_pendaftaran='Diterima' AND p.status_kegiatan='Aktif') ORDER BY l.tanggal DESC");
		return $query;
	}
	
	public function get_logbook_inbound($id)
	{
		$query = $this->db->query("SELECT l.* FROM logbook_inbound l, pendaftaran_inbound p, mahasiswa_inbound m WHERE l.semester = p.semester AND l.id_mhsw=p.id_mhsw AND p.id_mhsw = m.id AND m.id_user='$id' AND (p.status_pendaftaran='Diterima' AND p.status_kegiatan='Aktif') GROUP BY l.id ORDER BY l.tanggal DESC");
		return $query;
	}
	
	
	public function get_logbook_dosen($id)
	{
		$query = $this->db->query("SELECT l.*,k.nama_kegiatan FROM logbook l LEFT JOIN pendaftaran p ON l.id_pendaftaran=p.id LEFT JOIN program_kegiatan k ON p.id_kegiatan=k.id WHERE l.id_pendaftaran='$id'");
		return $query;
	}

	public function get_logbook_inbound_one($id_mhsw, $semester)
	{
		$query = $this->db->query("SELECT * FROM logbook_inbound WHERE id_mhsw='$id_mhsw' AND semester='$semester'");
		return $query;
	}
	
	public function get_logbook_one($id)
	{
		$query = $this->db->query("SELECT * FROM logbook WHERE id='$id'");
		return $query;
	}

	public function get_logbook_one_inbound($id)
	{
		$query = $this->db->query("SELECT * FROM logbook_inbound WHERE id='$id'");
		return $query;
	}

	public function get_id_daftar($id)
	{
		$query = $this->db->query("SELECT * from pendaftaran WHERE id_mhsw='$id' AND status_pendaftaran='Diterima' AND status_kegiatan='Aktif'");
		return $query;
	}

	public function get_id_pendaftaran_inb($id)
	{
		$query = $this->db->query("SELECT p.semester, p.id_mhsw from pendaftaran_inbound p LEFT JOIN mahasiswa_inbound m ON p.id_mhsw=m.id WHERE m.id_user='$id' AND p.status_pendaftaran='Diterima' AND p.status_kegiatan='Aktif' GROUP BY p.semester, p.id_mhsw");
		return $query;
	}
	
	public function post($data)
	{
		return ($this->db->insert('logbook', $data)) ? TRUE : FALSE;
	}

	public function post_inbound($data)
	{
		return ($this->db->insert('logbook_inbound', $data)) ? TRUE : FALSE;
	}

	public function put($data, $id)
	{
		return ($this->db->update('logbook', $data, "id = '$id'")) ? TRUE : FALSE;
	}

	public function put_inbound($data, $id)
	{
		return ($this->db->update('logbook_inbound', $data, "id = '$id'")) ? TRUE : FALSE;
	}

	public function delete($id)
	{
		return ($this->db->delete('logbook', "id = '$id'")) ? TRUE : FALSE;
	}

	public function delete_inbound($id)
	{
		return ($this->db->delete('logbook_inbound', "id = '$id'")) ? TRUE : FALSE;
	}
}
?>
