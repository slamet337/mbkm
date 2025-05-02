<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_akhir_model extends CI_Model {    
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_laporan_akhir($id)
	{
		$query = $this->db->query("SELECT p.*,k.nama_kegiatan, k.id_program, d.nama, mt.nama as nama_mentor FROM pendaftaran p LEFT JOIN program_kegiatan k ON p.id_kegiatan=k.id LEFT JOIN dosen d ON p.id_dosen=d.id LEFT JOIN mentor mt ON p.id_mentor = mt.id WHERE p.id_mhsw='$id' AND p.status_pendaftaran='Diterima'");
		return $query;
	}

	public function get_laporan_akhir_inbound($id)
	{
		$query = $this->db->query("SELECT p.*, d.nama FROM pendaftaran_inbound p LEFT JOIN dosen d ON p.id_dosen=d.id LEFT JOIN mahasiswa_inbound m ON p.id_mhsw=m.id WHERE m.id_user='$id' AND p.status_pendaftaran='Diterima' GROUP BY p.semester");
		return $query;
	}

  public function get_laporan_akhir_one($id)
	{
		$query = $this->db->query("SELECT * FROM pendaftaran WHERE id='$id'");
		return $query;
	}

	public function get_laporan_akhir_one_inbound($id)
	{
		$query = $this->db->query("SELECT * FROM pendaftaran_inbound WHERE id='$id'");
		return $query;
	}

  public function get_nilai($id)
	{
		$query = $this->db->query("SELECT n.*, m.matakuliah FROM nilai_kegiatan n LEFT JOIN konversi_matakuliah k ON n.id_matakuliah = k.id LEFT JOIN matakuliah m ON k.kd_mk=m.kd_mk WHERE n.id_pendaftaran='$id'");
		return $query;
	}

	public function get_pendaftaran_adm_prodi_one_inbound($id)
	{
		$query = $this->db->query("SELECT p.*, m.angkatan FROM pendaftaran_inbound p LEFT JOIN mahasiswa_inbound m ON p.id_mhsw=m.id WHERE p.id='$id'");
		return $query;	
	}
	
  public function get_nilai_inbound($id_mhsw, $semester)
	{
		$query = $this->db->query("SELECT n.*, m.matakuliah,m.kd_mk,m.sks FROM nilai_inbound n LEFT JOIN pendaftaran_inbound p ON n.id_pendaftaran_inbound=p.id LEFT JOIN jadwal_kuliah_inbound j ON p.id_jadwal = j.id LEFT JOIN matakuliah m ON j.kd_mk=m.kd_mk WHERE n.id_mhsw = '$id_mhsw' AND n.semester='$semester'");
		return $query;
	}

  public function get_nilai_pertukaran($id)
	{
		$query = $this->db->query("SELECT n.*, m.matakuliah FROM nilai_mk_pertukaran n LEFT JOIN konversi_mk_pertukaran k ON n.id_matakuliah_pertukaran = k.id LEFT JOIN matakuliah m ON k.kd_mk=m.kd_mk WHERE n.id_pendaftaran='$id'");
		return $query;
	}

	public function check_nilai_kegiatan($id_pendaftaran)
	{
		$query = $this->db->query("SELECT * FROM nilai_kegiatan WHERE id_pendaftaran='$id_pendaftaran'");
		return $query;
	}

	public function check_nilai_inbound($id_mhsw, $semester)
	{
		$query = $this->db->query("SELECT * FROM nilai_inbound WHERE id_mhsw='$id_mhsw' AND semester='$semester'");
		return $query;
	}

	public function check_nilai_pertukaran($id_pendaftaran)
	{
		$query = $this->db->query("SELECT * FROM nilai_mk_pertukaran WHERE id_pendaftaran='$id_pendaftaran'");
		return $query;
	}

	public function put($data, $id)
	{
		return ($this->db->update('pendaftaran', $data, "id = '$id'")) ? TRUE : FALSE;
	}

	public function put_inbound($data, $id)
	{
		return ($this->db->update('pendaftaran_inbound', $data, "id = '$id'")) ? TRUE : FALSE;
	}
}
?>
