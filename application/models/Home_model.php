<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model {    
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_mahasiswa($level, $kd_prodi = "")
	{
		if ($level == "1") {
			$query = $this->db->query("SELECT u.id FROM users_mhsw u LEFT JOIN mahasiswa m ON u.id = m.id_user WHERE level='mahasiswa'");
		} else {
			$query = $this->db->query("SELECT u.id FROM users_mhsw u LEFT JOIN mahasiswa m ON u.id = m.id_user WHERE level='mahasiswa' AND u.kd_prodi='$kd_prodi'");
		}
		return $query;
	}
	
	public function get_alumni($level, $kd_prodi = "")
	{
		if ($level == "1") {
			$query = $this->db->query("SELECT u.id FROM users_mhsw u LEFT JOIN mahasiswa m ON u.id = m.id_user WHERE level='alumni'");
		} else {
			$query = $this->db->query("SELECT u.id FROM users_mhsw u LEFT JOIN mahasiswa m ON u.id = m.id_user WHERE level='alumni' AND u.kd_prodi='$kd_prodi'");
		}
		return $query;
	}
	
	public function get_dosen($level, $kd_prodi = "")
	{
		if ($level == "1") {
			$query = $this->db->query("SELECT id FROM dosen");
		} else {
			$query = $this->db->query("SELECT id FROM dosen WHERE kd_prodi='$kd_prodi'");
		}
		return $query;
	}
	
	public function get_mitra()
	{
		$query = $this->db->query("SELECT id FROM mitra");
		return $query;
	}
	
	public function get_mitra_aktif()
	{
		$query = $this->db->query("SELECT p.id_mitra FROM program_kegiatan p LEFT JOIN mitra m ON p.id_mitra=m.id WHERE p.waktu_mulai <= CURDATE() AND p.waktu_selesai >= CURDATE()");
		return $query;
	}
	
	public function get_feb($level, $status_daftar, $status_kegiatan, $kd_prodi = "")
	{
		if ($level == "1") {
			if($status_daftar == "Ditolak") {
				$query = $this->db->query("SELECT p.id FROM pendaftaran p LEFT JOIN mahasiswa m ON p.id_mhsw=m.id WHERE p.status_pendaftaran = '$status_daftar'");
			} else {
				$query = $this->db->query("SELECT p.id FROM pendaftaran p LEFT JOIN mahasiswa m ON p.id_mhsw=m.id WHERE p.status_pendaftaran = '$status_daftar' AND p.status_kegiatan = '$status_kegiatan'");
			}
		} else {
			if($status_daftar == "Ditolak") {
				$query = $this->db->query("SELECT p.id FROM pendaftaran p LEFT JOIN mahasiswa m ON p.id_mhsw=m.id WHERE m.kd_prodi='$kd_prodi' AND p.status_pendaftaran = '$status_daftar'");
			} else {
				$query = $this->db->query("SELECT p.id FROM pendaftaran p LEFT JOIN mahasiswa m ON p.id_mhsw=m.id WHERE m.kd_prodi='$kd_prodi' AND p.status_pendaftaran = '$status_daftar' AND p.status_kegiatan = '$status_kegiatan'");
			}
		}
		return $query;
	}
	
	public function get_kementerian_null($level, $jenis, $kd_prodi = "")
	{
		if ($level == "1") {
			$query = $this->db->query("SELECT * FROM kegiatan_mbkm_lain k LEFT JOIN mk_kegiatan m ON k.id=m.id_kegiatan_mbkm_lain LEFT JOIN mahasiswa mhs ON k.id_mhsw=mhs.id WHERE k.jenis_mbkm='$jenis' AND m.nilai is NULL  GROUP BY k.id");
		} else {
			$query = $this->db->query("SELECT * FROM kegiatan_mbkm_lain k LEFT JOIN mk_kegiatan m ON k.id=m.id_kegiatan_mbkm_lain LEFT JOIN mahasiswa mhs ON k.id_mhsw=mhs.id WHERE k.jenis_mbkm='$jenis' AND m.nilai is NULL AND mhs.kd_prodi='$kd_prodi' GROUP BY k.id");
		}
		return $query;
	}
	
	public function get_kementerian_nilai($level, $jenis, $kd_prodi = "")
	{
		if ($level == "1") {
			$query = $this->db->query("SELECT * FROM kegiatan_mbkm_lain k LEFT JOIN mk_kegiatan m ON k.id=m.id_kegiatan_mbkm_lain LEFT JOIN mahasiswa mhs ON k.id_mhsw=mhs.id WHERE k.jenis_mbkm='$jenis' AND m.nilai is NOT NULL  GROUP BY k.id");
		} else {
			$query = $this->db->query("SELECT * FROM kegiatan_mbkm_lain k LEFT JOIN mk_kegiatan m ON k.id=m.id_kegiatan_mbkm_lain LEFT JOIN mahasiswa mhs ON k.id_mhsw=mhs.id WHERE k.jenis_mbkm='$jenis' AND m.nilai is NOT NULL AND mhs.kd_prodi='$kd_prodi' GROUP BY k.id");
		}
		return $query;
	}
	
	public function get_mentor($id, $jenis_personil)
	{
		$query = $this->db->query("SELECT id FROM mentor WHERE id_mitra = '$id' AND jenis_personil = '$jenis_personil'");
		return $query;
	}
	
	public function get_kegiatan($id)
	{
		$query = $this->db->query("SELECT id FROM program_kegiatan WHERE id_mitra = '$id'");
		return $query;
	}
	
	public function get_pendaftar($id)
	{
		$query = $this->db->query("SELECT p.id FROM pendaftaran p LEFT JOIN program_kegiatan pk ON p.id_kegiatan=pk.id WHERE p.status_pendaftaran='Diterima' AND pk.id_mitra = '$id'");
		return $query;
	}
}
?>
