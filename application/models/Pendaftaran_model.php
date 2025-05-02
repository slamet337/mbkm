<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran_model extends CI_Model {    
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_program_mbkm()
	{
		$query = $this->db->query("SELECT * FROM program_mbkm");
		return $query;
	}
	
	public function get_program_mbkm_one($id)
	{
		$query = $this->db->query("SELECT * FROM program_mbkm WHERE id='$id'");
		return $query;
	}

	public function get_description($kd_mk)
	{
		$query = $this->db->query("SELECT * FROM matakuliah_pertukaran WHERE kd_mk='$kd_mk'");
		return $query;
	}

	public function get_description_inbound($kd_mk)
	{
		$query = $this->db->query("SELECT description FROM jadwal_kuliah_inbound WHERE id='$kd_mk'");
		return $query;
	}

	public function get_kegiatan($id)
	{
		if ($id != 1) {
			$query = $this->db->query("SELECT p.*, m.nama_mitra FROM program_kegiatan p LEFT JOIN mitra m ON p.id_mitra=m.id WHERE id_program='$id' AND (p.waktu_mulai <= CURDATE() AND p.waktu_selesai >= CURDATE()) AND sisa_kuota != '0'");
		} else {
			$query = $this->db->query("SELECT p.*, m.nama_mitra FROM program_kegiatan p LEFT JOIN mitra m ON p.id_mitra=m.id WHERE id_program='$id' AND (p.waktu_mulai <= CURDATE() AND p.waktu_selesai >= CURDATE())");
		}
		return $query;
	}

	public function get_jadwal()
	{
		$query = $this->db->query("SELECT * FROM jadwal_kuliah_inbound WHERE (waktu_mulai <= CURDATE() AND waktu_selesai >= CURDATE()) AND sisa_kuota != '0'");
		return $query;
	}

	public function get_id_mahasiswa($id)
	{
		$query = $this->db->query("SELECT id FROM mahasiswa_inbound WHERE id_user='$id'");
		return $query;
	}

	public function get_kegiatan_one($id)
	{
		$query = $this->db->query("SELECT * FROM program_kegiatan WHERE id='$id'");
		return $query;
	}

  public function get_matakuliah($id, $kd_prodi)
  {
		$query = $this->db->query("SELECT m.kd_mk, m.matakuliah FROM konversi_matakuliah k LEFT JOIN matakuliah m ON k.kd_mk=m.kd_mk WHERE k.id_program_kegiatan='$id' AND k.kd_prodi='$kd_prodi'");
		return $query;
  }

  public function get_persyaratan($id)
  {
		$query = $this->db->query("SELECT id, persyaratan FROM persyaratan_kegiatan WHERE id_kegiatan='$id'");
		return $query;
  }
  
  public function get_pendaftaran()
	{
		$query = $this->db->query("SELECT * FROM pendaftaran");
		return $query;
	}

	public function get_pendaftaran_one($id)
	{
		$query = $this->db->query("SELECT p.*, d.nama, k.nama_kegiatan, mt.nama as nama_mentor from pendaftaran p LEFT JOIN dosen d ON p.id_dosen = d.id LEFT JOIN program_kegiatan k ON p.id_kegiatan=k.id LEFT JOIN mentor mt ON p.id_mentor=mt.id WHERE p.id_mhsw='$id'");
		return $query;
	}

	public function get_pendaftaran_inbound_one($id)
	{
		$query = $this->db->query("SELECT p.*, d.nama from pendaftaran_inbound p LEFT JOIN dosen d ON p.id_dosen = d.id LEFT JOIN mahasiswa_inbound m ON p.id_mhsw=m.id WHERE m.id_user='$id' GROUP BY p.semester");
		return $query;
	}

	public function get_pendaftaran_adm_prodi($kd_prodi)
	{
		$query = $this->db->query("SELECT p.*, d.nama, m.nama as nama_mhsw, k.nama_kegiatan, k.id_program, mt.nama as nama_mentor from pendaftaran p LEFT JOIN dosen d ON p.id_dosen = d.id LEFT JOIN program_kegiatan k ON p.id_kegiatan=k.id LEFT JOIN mahasiswa m ON p.id_mhsw=m.id LEFT JOIN mentor mt ON p.id_mentor=mt.id WHERE m.kd_prodi='$kd_prodi'");
		return $query;
	}

	public function get_pendaftaran_inbound_prodi($kd_prodi)
	{
		$query = $this->db->query("SELECT p.*, d.nama, m.nama as nama_mhsw from pendaftaran_inbound p LEFT JOIN dosen d ON p.id_dosen = d.id LEFT JOIN mahasiswa m ON p.id_mhsw=m.id LEFT JOIN jadwal_kuliah_inbound j ON p.id_jadwal = j.id WHERE j.kd_prodi='$kd_prodi' GROUP BY p.semester, p.id_mhsw, p.status_pendaftaran");
		return $query;
	}

	public function get_jadwal_mahasiswa_inbound($id_mhsw, $semester, $status_pendaftaran)
	{
		$query = $this->db->query("SELECT j.* from pendaftaran_inbound p LEFT JOIN jadwal_kuliah_inbound j ON p.id_jadwal=j.id WHERE p.id_mhsw='$id_mhsw' AND p.semester='$semester' AND p.status_pendaftaran='$status_pendaftaran'");
		return $query;
	}

	public function get_pendaftaran_adm_prodi_one($id)
	{
		$query = $this->db->query("SELECT p.*, m.nim, m.angkatan FROM pendaftaran p LEFT JOIN mahasiswa m ON p.id_mhsw=m.id WHERE p.id='$id'");
		return $query;	
	}

	public function get_pendaftaran_adm_prodi_one_inbound($id)
	{
		$query = $this->db->query("SELECT p.*, m.angkatan FROM pendaftaran_inbound p LEFT JOIN mahasiswa_inbound m ON p.id_mhsw=m.id WHERE p.id='$id'");
		return $query;	
	}

	public function get_detail_jadwal($id_mhsw, $semester)
	{
		$query = $this->db->query("SELECT p.*, m.matakuliah, m.sks FROM pendaftaran_inbound p LEFT JOIN jadwal_kuliah_inbound j ON p.id_jadwal=j.id LEFT JOIN matakuliah m ON j.kd_mk=m.kd_mk WHERE p.id_mhsw='$id_mhsw' AND p.semester='$semester'");
		return $query;	
	}

	public function get_persyaratan_adm_prodi($id)
	{
		$query = $this->db->query("SELECT pp.*, pk.persyaratan FROM persyaratan_pendaftaran pp LEFT JOIN persyaratan_kegiatan pk ON pp.id_persyaratan=pk.id WHERE pp.id_pendaftaran='$id'");
		return $query;
	}

	public function get_persyaratan_adm_prodi_inbound($id)
	{
		$query = $this->db->query("SELECT * FROM persyaratan_inbound WHERE id_pendaftaran='$id'");
		return $query;
	}

  public function get_nilai($id)
	{
		$query = $this->db->query("SELECT n.*, m.matakuliah FROM nilai_kegiatan n LEFT JOIN konversi_matakuliah k ON n.id_matakuliah = k.id LEFT JOIN matakuliah m ON k.kd_mk=m.kd_mk WHERE n.id_pendaftaran='$id'");
		return $query;
	}

  public function get_nilai_inbound($id_mhsw, $semester)
	{
		$query = $this->db->query("SELECT n.*, m.matakuliah FROM nilai_inbound n LEFT JOIN pendaftaran_inbound p ON n.id_pendaftaran_inbound=p.id LEFT JOIN jadwal_kuliah_inbound j ON p.id_jadwal = j.id LEFT JOIN matakuliah m ON j.kd_mk=m.kd_mk WHERE n.id_mhsw = '$id_mhsw' AND n.semester='$semester'");
		return $query;
	}

	public function get_pendaftaran_mitra($id_mitra)
	{
		$query = $this->db->query("SELECT p.*, d.nama, m.nama as nama_mhsw, k.nama_kegiatan, k.id_program, mt.nama as nama_mentor from pendaftaran p LEFT JOIN dosen d ON p.id_dosen = d.id LEFT JOIN program_kegiatan k ON p.id_kegiatan=k.id LEFT JOIN mahasiswa m ON p.id_mhsw=m.id LEFT JOIN mentor mt ON p.id_mentor=mt.id WHERE k.id_mitra='$id_mitra' AND p.status_pendaftaran='Diterima' AND p.status_kegiatan='Aktif'");
		return $query;
	}

	public function get_pendaftaran_mitra_one($id)
	{
		$query = $this->db->query("SELECT * FROM pendaftaran WHERE id='$id'");
		return $query;
	}
	
	public function get_pendaftaran_dosen($id_dosen)
	{
		$query = $this->db->query("SELECT p.*, d.nama, m.nama as nama_mhsw, k.nama_kegiatan, k.id_program, mt.nama as nama_mentor from pendaftaran p LEFT JOIN dosen d ON p.id_dosen = d.id LEFT JOIN program_kegiatan k ON p.id_kegiatan=k.id LEFT JOIN mahasiswa m ON p.id_mhsw=m.id LEFT JOIN mentor mt ON p.id_mentor=mt.id WHERE p.id_dosen='$id_dosen' AND p.status_pendaftaran='Diterima' AND p.status_kegiatan='Aktif'");
		return $query;
	}
	
	public function get_pendaftaran_dosen_inbound($id_dosen)
	{
		$query = $this->db->query("SELECT p.*, d.nama, m.nama as nama_mhsw from pendaftaran_inbound p LEFT JOIN dosen d ON p.id_dosen = d.id LEFT JOIN mahasiswa_inbound m ON p.id_mhsw=m.id WHERE p.id_dosen='$id_dosen' AND p.status_pendaftaran='Diterima' AND p.status_kegiatan='Aktif' GROUP BY p.semester, p.id_mhsw");
		return $query;
	}

	public function get_matakuliah_dosen($id_daftar)
	{
		$query = $this->db->query("SELECT k.*, m.matakuliah from konversi_matakuliah k LEFT JOIN matakuliah m ON k.kd_mk=m.kd_mk WHERE k.id_pendaftaran='$id_daftar'");
		return $query;
	}

	public function get_matakuliah_dosen_inbound(Type $var = null)
	{
		# code...
	}

	public function get_matakuliah_konversi_pertukaran($id_daftar)
	{
		$query = $this->db->query("SELECT k.*, m.matakuliah, mk.matakuliah as matakuliah_pertukaran from konversi_mk_pertukaran k LEFT JOIN matakuliah m ON k.kd_mk=m.kd_mk LEFT JOIN matakuliah_pertukaran mk ON k.kd_mk_pertukaran=mk.kd_mk LEFT JOIN pendaftaran p ON k.id_pendaftaran=p.id WHERE k.id_pendaftaran='$id_daftar' AND p.id_kegiatan=mk.id_program_kegiatan");
		return $query;
	}

	public function get_status($id)
	{
		$query = $this->db->query("SELECT * FROM pendaftaran WHERE status_pendaftaran='Diterima' AND status_kegiatan='Aktif' AND id_mhsw='$id'");
		return $query;
	}

	public function get_status_inbound($id)
	{
		$query = $this->db->query("SELECT p.* FROM pendaftaran_inbound p LEFT JOIN mahasiswa_inbound m ON p.id_mhsw=m.id WHERE p.status_pendaftaran='Diterima' AND p.status_kegiatan='Aktif' AND m.id_user='$id'");
		return $query;
	}

	public function get_status_kegiatan($id)
	{
		$query = $this->db->query("SELECT * FROM pendaftaran WHERE status_pendaftaran='Diterima' AND status_kegiatan='Selesai' AND id_mhsw='$id'");
		return $query;
	}

	public function get_status_kegiatan_inbound($id)
	{
		$query = $this->db->query("SELECT p.* FROM pendaftaran_inbound p LEFT JOIN mahasiswa_inbound m ON p.id_mhsw=m.id WHERE p.status_pendaftaran='Diterima' AND p.status_kegiatan='Selesai' AND m.id_user='$id'");
		return $query;
	}

	public function get_matakuliah_pertukaran($id_kegiatan)
	{
		$query = $this->db->query("SELECT * FROM matakuliah_pertukaran WHERE id_program_kegiatan='$id_kegiatan'");
		return $query;
	}

	public function get_matakuliah_inbound()
	{
		$query = $this->db->query("SELECT j.*, m.matakuliah, m.sks, m.id_dosen FROM jadwal_kuliah_inbound j LEFT JOIN matakuliah m ON j.kd_mk=m.kd_mk WHERE j.sisa_kuota !='0' AND (j.waktu_mulai <= CURDATE() AND j.waktu_selesai >= CURDATE())");
		return $query;
	}

	public function get_total_sks($semester, $id_mhsw)
	{
		$query = $this->db->query("SELECT SUM(m.sks) as total_sks FROM konversi_mk_pertukaran k LEFT JOIN pendaftaran p ON k.id_pendaftaran=p.id LEFT JOIN matakuliah m ON k.kd_mk=m.kd_mk WHERE p.id_mhsw='$id_mhsw' AND p.semester='$semester' AND p.status_pendaftaran!='Ditolak' GROUP BY p.semester");
		return $query;
	}

	public function get_total_sks_inbound($semester, $id)
	{
		$query = $this->db->query("SELECT SUM(m.sks) as total_sks FROM pendaftaran_inbound p LEFT JOIN jadwal_kuliah_inbound j ON p.id_jadwal=j.id LEFT JOIN matakuliah m ON j.kd_mk=m.kd_mk LEFT JOIN mahasiswa_inbound mhs ON p.id_mhsw=mhs.id WHERE mhs.id_user='$id' AND p.semester='$semester' AND p.status_pendaftaran!='Ditolak' GROUP BY p.semester");
		return $query;
	}

	public function get_matakuliah_konversi()
	{
		$query = $this->db->query("SELECT * FROM matakuliah");
		return $query;
	}

	public function get_detail_matakuliah_konversi($id_daftar)
	{
		$query = $this->db->query("SELECT k.*, m.matakuliah as matakuliah_konversi, m.sks as sks_konversi, mp.matakuliah, mp.sks FROM konversi_mk_pertukaran k LEFT JOIN matakuliah m ON k.kd_mk=m.kd_mk LEFT JOIN matakuliah_pertukaran mp ON k.kd_mk_pertukaran=mp.kd_mk LEFT JOIN pendaftaran p ON k.id_pendaftaran=p.id  WHERE k.id_pendaftaran='$id_daftar' AND p.id_kegiatan=mp.id_program_kegiatan");
		return $query;
	}

	public function get_detail_matakuliah_konversi_kegiatan_lain($id_daftar)
	{
		$query = $this->db->query("SELECT t.*, m. matakuliah, m.sks from temp_mk_pertukaran t LEFT JOIN matakuliah m ON t.kd_mk=m.kd_mk WHERE t.id_pendaftaran='$id_daftar'");
		return $query;
	}

	public function search_dosen($id)
	{
		$query = $this->db->query("SELECT * FROM dosen WHERE id_user='$id'");
		return $query;
	}

	public function post($data)
	{
		return ($this->db->insert('pendaftaran', $data)) ? $this->db->insert_id() : FALSE;
	}

	public function post_inbound($data)
	{
		return ($this->db->insert('pendaftaran_inbound', $data)) ? $this->db->insert_id() : FALSE;
	}

	public function post_mk_pertukaran($data)
	{
		return ($this->db->insert('konversi_mk_pertukaran', $data)) ? TRUE : FALSE;
	}

	public function post_mk_temp_konversi($data)
	{
		return ($this->db->insert('temp_mk_pertukaran', $data)) ? TRUE : FALSE;
	}

	public function post_konversi_mk($data)
	{
		return ($this->db->insert('konversi_matakuliah', $data)) ? TRUE : FALSE;
	}

	public function post_persyaratan($data)
	{
		return ($this->db->insert('persyaratan_pendaftaran', $data)) ? TRUE : FALSE;
	}

	public function post_persyaratan_inbound($data)
	{
		return ($this->db->insert('persyaratan_inbound', $data)) ? TRUE : FALSE;
	}

	public function post_nilai($data)
	{
		return ($this->db->insert('nilai_kegiatan', $data)) ? TRUE : FALSE;
	}

	public function post_nilai_inbound($data)
	{
		return ($this->db->insert('nilai_inbound', $data)) ? TRUE : FALSE;
	}

	public function post_nilai_pertukaran($data)
	{
		return ($this->db->insert('nilai_mk_pertukaran', $data)) ? TRUE : FALSE;
	}

	public function put($data, $id)
	{
		return ($this->db->update('pendaftaran', $data, "id = '$id'")) ? TRUE : FALSE;
	}

	public function put_inbound($data, $id_mhsw, $semester, $status_pendaftaran)
	{
		return ($this->db->update('pendaftaran_inbound', $data, "id_mhsw = '$id_mhsw' AND semester='$semester' AND status_pendaftaran='$status_pendaftaran'")) ? TRUE : FALSE;
	}

	public function put_ditolak($id, $id_mhsw)
	{
		$sql = $this->db->query("UPDATE pendaftaran p JOIN program_kegiatan AS k ON p.id_kegiatan = k.id SET p.status_pendaftaran = 'Ditolak' WHERE k.id_program != '1' AND p.id_mhsw = '$id_mhsw' AND p.id != '$id' AND p.status_kegiatan='Belum Aktif'");
		return $sql ? TRUE : FALSE;
	}

	public function put_kuota_kegiatan($data, $id)
	{
		return ($this->db->update('program_kegiatan', $data, "id = '$id'")) ? TRUE : FALSE;
	}

	public function put_kuota_jadwal_inbound($data, $id)
	{
		return ($this->db->update('jadwal_kuliah_inbound', $data, "id = '$id'")) ? TRUE : FALSE;
	}

	public function put_kuota_kegiatan_pertukaran($data, $id)
	{
		return ($this->db->update('matakuliah_pertukaran', $data, "id = '$id'")) ? TRUE : FALSE;
	}

	public function delete($id)
	{
		return ($this->db->delete('pendaftaran', "id = '$id'")) ? TRUE : FALSE;
	}
}
?>
