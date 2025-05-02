<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil_model extends CI_Model {    
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_profil_one($id)
	{
		$query = $this->db->query("SELECT * from mahasiswa WHERE id='$id'");
		return $query;
	}
	
	public function get_profil_inbound_one($id)
	{
		$query = $this->db->query("SELECT * from mahasiswa_inbound WHERE id_user='$id'");
		return $query;
	}
	
	public function get_user_one($id)
	{
		$query = $this->db->query("SELECT * from users_mhsw WHERE id='$id'");
		return $query;
	}
	
	public function get_prodi_all()
	{
		$query = $this->db->query("SELECT * FROM prodi");
		return $query;
	}
	
	public function put($data, $id)
	{
		return ($this->db->update('mahasiswa', $data, "id = '$id'")) ? TRUE : FALSE;
	}
	
	public function put_inbound($data, $id)
	{
		return ($this->db->update('mahasiswa_inbound', $data, "id = '$id'")) ? TRUE : FALSE;
	}

	public function get_pendidikan($id)
	{
		$query = $this->db->query("SELECT * from riwayat_pendidikan WHERE id_mhsw='$id'");
		return $query;
	}

	public function post_pendidikan($data)
	{
		return ($this->db->insert('riwayat_pendidikan', $data)) ? TRUE : FALSE;
	}
	
	public function put_pendidikan($data, $id)
	{
		return ($this->db->update('riwayat_pendidikan', $data, "id = '$id'")) ? TRUE : FALSE;
	}

	public function delete_pendidikan($id)
	{
		return ($this->db->delete('riwayat_pendidikan', "id = '$id'")) ? TRUE : FALSE;
	}

	public function get_pekerjaan($id)
	{
		$query = $this->db->query("SELECT * from riwayat_pekerjaan WHERE id_mhsw='$id'");
		return $query;
	}

	public function post_pekerjaan($data)
	{
		return ($this->db->insert('riwayat_pekerjaan', $data)) ? TRUE : FALSE;
	}
	
	public function put_pekerjaan($data, $id)
	{
		return ($this->db->update('riwayat_pekerjaan', $data, "id = '$id'")) ? TRUE : FALSE;
	}

	public function delete_pekerjaan($id)
	{
		return ($this->db->delete('riwayat_pekerjaan', "id = '$id'")) ? TRUE : FALSE;
	}

	public function get_jabatan($id)
	{
		$query = $this->db->query("SELECT * from riwayat_jabatan WHERE id_mhsw='$id'");
		return $query;
	}

	public function post_jabatan($data)
	{
		return ($this->db->insert('riwayat_jabatan', $data)) ? TRUE : FALSE;
	}
	
	public function put_jabatan($data, $id)
	{
		return ($this->db->update('riwayat_jabatan', $data, "id = '$id'")) ? TRUE : FALSE;
	}

	public function delete_jabatan($id)
	{
		return ($this->db->delete('riwayat_jabatan', "id = '$id'")) ? TRUE : FALSE;
	}

	public function get_wirausaha($id)
	{
		$query = $this->db->query("SELECT * from riwayat_wirausaha WHERE id_mhsw='$id'");
		return $query;
	}

	public function post_wirausaha($data)
	{
		return ($this->db->insert('riwayat_wirausaha', $data)) ? TRUE : FALSE;
	}
	
	public function put_wirausaha($data, $id)
	{
		return ($this->db->update('riwayat_wirausaha', $data, "id = '$id'")) ? TRUE : FALSE;
	}

	public function delete_wirausaha($id)
	{
		return ($this->db->delete('riwayat_wirausaha', "id = '$id'")) ? TRUE : FALSE;
	}

	public function get_seminar($id)
	{
		$query = $this->db->query("SELECT * from riwayat_seminar WHERE id_mhsw='$id'");
		return $query;
	}

	public function post_seminar($data)
	{
		return ($this->db->insert('riwayat_seminar', $data)) ? TRUE : FALSE;
	}
	
	public function put_seminar($data, $id)
	{
		return ($this->db->update('riwayat_seminar', $data, "id = '$id'")) ? TRUE : FALSE;
	}

	public function delete_seminar($id)
	{
		return ($this->db->delete('riwayat_seminar', "id = '$id'")) ? TRUE : FALSE;
	}

	public function get_prestasi($id)
	{
		$query = $this->db->query("SELECT * from riwayat_prestasi WHERE id_mhsw='$id'");
		return $query;
	}

	public function post_prestasi($data)
	{
		return ($this->db->insert('riwayat_prestasi', $data)) ? TRUE : FALSE;
	}
	
	public function put_prestasi($data, $id)
	{
		return ($this->db->update('riwayat_prestasi', $data, "id = '$id'")) ? TRUE : FALSE;
	}

	public function delete_prestasi($id)
	{
		return ($this->db->delete('riwayat_prestasi', "id = '$id'")) ? TRUE : FALSE;
	}

	public function get_karya_ilmiah($id)
	{
		$query = $this->db->query("SELECT * from riwayat_karya_ilmiah WHERE id_mhsw='$id'");
		return $query;
	}

	public function post_karya_ilmiah($data)
	{
		return ($this->db->insert('riwayat_karya_ilmiah', $data)) ? TRUE : FALSE;
	}
	
	public function put_karya_ilmiah($data, $id)
	{
		return ($this->db->update('riwayat_karya_ilmiah', $data, "id = '$id'")) ? TRUE : FALSE;
	}

	public function delete_karya_ilmiah($id)
	{
		return ($this->db->delete('riwayat_karya_ilmiah', "id = '$id'")) ? TRUE : FALSE;
	}

	public function get_organisasi($id)
	{
		$query = $this->db->query("SELECT * from riwayat_organisasi WHERE id_mhsw='$id'");
		return $query;
	}

	public function post_organisasi($data)
	{
		return ($this->db->insert('riwayat_organisasi', $data)) ? TRUE : FALSE;
	}
	
	public function put_organisasi($data, $id)
	{
		return ($this->db->update('riwayat_organisasi', $data, "id = '$id'")) ? TRUE : FALSE;
	}

	public function delete_organisasi($id)
	{
		return ($this->db->delete('riwayat_organisasi', "id = '$id'")) ? TRUE : FALSE;
	}

	public function put_setting($data_setting, $id)
	{
		return ($this->db->update('users_mhsw', $data_setting, "id = '$id'")) ? TRUE : FALSE;
	}

	public function get_mbkm($id)
	{
		$query = $this->db->query("SELECT p.semester, pk.lokasi_kegiatan, pk.nama_kegiatan, pm.nama_program, m.nama_mitra, p.status_pendaftaran, p.status_kegiatan from pendaftaran p LEFT JOIN program_kegiatan pk ON p.id_kegiatan = pk.id LEFT JOIN program_mbkm pm ON pk.id_program = pm.id LEFT JOIN mitra m ON pk.id_mitra=m.id WHERE p.id_mhsw='$id'");
		return $query;
	}

	public function get_mbkm_luar($id)
	{
		$query = $this->db->query("SELECT km.jenis_mbkm, km.semester, km.lokasi_kegiatan, km.nama_kegiatan, pm.nama_program, km.penyelenggara_mbkm as nama_mitra from kegiatan_mbkm_lain km LEFT JOIN program_mbkm pm ON km.id_program_mbkm=pm.id WHERE km.id_mhsw='$id'");
		return $query;
	}

	//DOSEN

	public function get_profil_dosen_one($id)
	{
		$query = $this->db->query("SELECT d.*, p.nama_prodi from dosen d LEFT JOIN prodi p ON d.kd_prodi = p.kd_prodi WHERE d.id_user='$id'");
		return $query;
	}
	
	public function put_dosen($data, $id)
	{
		return ($this->db->update('dosen', $data, "id = '$id'")) ? TRUE : FALSE;
	}

	public function get_pendidikan_dosen($id)
	{
		$query = $this->db->query("SELECT * from riwayat_pendidikan_dosen WHERE id_dosen='$id'");
		return $query;
	}

	public function post_pendidikan_dosen($data)
	{
		return ($this->db->insert('riwayat_pendidikan_dosen', $data)) ? TRUE : FALSE;
	}
	
	public function put_pendidikan_dosen($data, $id)
	{
		return ($this->db->update('riwayat_pendidikan_dosen', $data, "id = '$id'")) ? TRUE : FALSE;
	}

	public function delete_pendidikan_dosen($id)
	{
		return ($this->db->delete('riwayat_pendidikan_dosen', "id = '$id'")) ? TRUE : FALSE;
	}

	public function get_pekerjaan_dosen($id)
	{
		$query = $this->db->query("SELECT * from riwayat_pekerjaan_dosen WHERE id_dosen='$id'");
		return $query;
	}

	public function post_pekerjaan_dosen($data)
	{
		return ($this->db->insert('riwayat_pekerjaan_dosen', $data)) ? TRUE : FALSE;
	}
	
	public function put_pekerjaan_dosen($data, $id)
	{
		return ($this->db->update('riwayat_pekerjaan_dosen', $data, "id = '$id'")) ? TRUE : FALSE;
	}

	public function delete_pekerjaan_dosen($id)
	{
		return ($this->db->delete('riwayat_pekerjaan_dosen', "id = '$id'")) ? TRUE : FALSE;
	}

	public function get_jabatan_dosen($id)
	{
		$query = $this->db->query("SELECT * from riwayat_jabatan_dosen WHERE id_dosen='$id'");
		return $query;
	}

	public function post_jabatan_dosen($data)
	{
		return ($this->db->insert('riwayat_jabatan_dosen', $data)) ? TRUE : FALSE;
	}
	
	public function put_jabatan_dosen($data, $id)
	{
		return ($this->db->update('riwayat_jabatan_dosen', $data, "id = '$id'")) ? TRUE : FALSE;
	}

	public function delete_jabatan_dosen($id)
	{
		return ($this->db->delete('riwayat_jabatan_dosen', "id = '$id'")) ? TRUE : FALSE;
	}

	public function get_wirausaha_dosen($id)
	{
		$query = $this->db->query("SELECT * from riwayat_wirausaha_dosen WHERE id_dosen='$id'");
		return $query;
	}

	public function post_wirausaha_dosen($data)
	{
		return ($this->db->insert('riwayat_wirausaha_dosen', $data)) ? TRUE : FALSE;
	}
	
	public function put_wirausaha_dosen($data, $id)
	{
		return ($this->db->update('riwayat_wirausaha_dosen', $data, "id = '$id'")) ? TRUE : FALSE;
	}

	public function delete_wirausaha_dosen($id)
	{
		return ($this->db->delete('riwayat_wirausaha_dosen', "id = '$id'")) ? TRUE : FALSE;
	}

	public function get_seminar_dosen($id)
	{
		$query = $this->db->query("SELECT * from riwayat_seminar_dosen WHERE id_dosen='$id'");
		return $query;
	}

	public function post_seminar_dosen($data)
	{
		return ($this->db->insert('riwayat_seminar_dosen', $data)) ? TRUE : FALSE;
	}
	
	public function put_seminar_dosen($data, $id)
	{
		return ($this->db->update('riwayat_seminar_dosen', $data, "id = '$id'")) ? TRUE : FALSE;
	}

	public function delete_seminar_dosen($id)
	{
		return ($this->db->delete('riwayat_seminar_dosen', "id = '$id'")) ? TRUE : FALSE;
	}

	public function get_prestasi_dosen($id)
	{
		$query = $this->db->query("SELECT * from riwayat_prestasi_dosen WHERE id_dosen='$id'");
		return $query;
	}

	public function post_prestasi_dosen($data)
	{
		return ($this->db->insert('riwayat_prestasi_dosen', $data)) ? TRUE : FALSE;
	}
	
	public function put_prestasi_dosen($data, $id)
	{
		return ($this->db->update('riwayat_prestasi_dosen', $data, "id = '$id'")) ? TRUE : FALSE;
	}

	public function delete_prestasi_dosen($id)
	{
		return ($this->db->delete('riwayat_prestasi_dosen', "id = '$id'")) ? TRUE : FALSE;
	}

	public function get_karya_ilmiah_dosen($id)
	{
		$query = $this->db->query("SELECT * from riwayat_karya_ilmiah_dosen WHERE id_dosen='$id'");
		return $query;
	}

	public function post_karya_ilmiah_dosen($data)
	{
		return ($this->db->insert('riwayat_karya_ilmiah_dosen', $data)) ? TRUE : FALSE;
	}
	
	public function put_karya_ilmiah_dosen($data, $id)
	{
		return ($this->db->update('riwayat_karya_ilmiah_dosen', $data, "id = '$id'")) ? TRUE : FALSE;
	}

	public function delete_karya_ilmiah_dosen($id)
	{
		return ($this->db->delete('riwayat_karya_ilmiah_dosen', "id = '$id'")) ? TRUE : FALSE;
	}

	public function get_organisasi_dosen($id)
	{
		$query = $this->db->query("SELECT * from riwayat_organisasi_dosen WHERE id_dosen='$id'");
		return $query;
	}

	public function post_organisasi_dosen($data)
	{
		return ($this->db->insert('riwayat_organisasi_dosen', $data)) ? TRUE : FALSE;
	}
	
	public function put_organisasi_dosen($data, $id)
	{
		return ($this->db->update('riwayat_organisasi_dosen', $data, "id = '$id'")) ? TRUE : FALSE;
	}

	public function delete_organisasi_dosen($id)
	{
		return ($this->db->delete('riwayat_organisasi_dosen', "id = '$id'")) ? TRUE : FALSE;
	}

	public function put_setting_dosen($data_setting_dosen, $id)
	{
		return ($this->db->update('users', $data_setting_dosen, "id = '$id'")) ? TRUE : FALSE;
	}
	
	public function get_user_dosen_one($id)
	{
		$query = $this->db->query("SELECT * from users WHERE id='$id'");
		return $query;
	}

	public function get_mbkm_dosen($id)
	{
		$query = $this->db->query("SELECT mhsw.nama as nama_mhsw, mhsw.nim, p.semester, pk.lokasi_kegiatan, pk.nama_kegiatan, pm.nama_program, m.nama_mitra, p.status_pendaftaran, p.status_kegiatan from pendaftaran p LEFT JOIN program_kegiatan pk ON p.id_kegiatan = pk.id LEFT JOIN program_mbkm pm ON pk.id_program = pm.id LEFT JOIN mitra m ON pk.id_mitra=m.id LEFT JOIN mahasiswa mhsw ON p.id_mhsw=mhsw.id WHERE p.id_dosen='$id'");
		return $query;
	}

	public function get_mbkm_luar_dosen($id)
	{
		$query = $this->db->query("SELECT mhsw.nama as nama_mhsw, mhsw.nim, km.jenis_mbkm, km.semester, km.lokasi_kegiatan, km.nama_kegiatan, pm.nama_program, km.penyelenggara_mbkm as nama_mitra from kegiatan_mbkm_lain km LEFT JOIN program_mbkm pm ON km.id_program_mbkm=pm.id LEFT JOIN mahasiswa mhsw ON km.id_mhsw=mhsw.id WHERE km.id_dosen='$id'");
		return $query;
	}

	//MITRA

	public function put_setting_mitra($data_setting, $id)
	{
		return ($this->db->update('users', $data_setting, "id = '$id'")) ? TRUE : FALSE;
	}
}
?>
