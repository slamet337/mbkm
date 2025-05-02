<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_model extends CI_Model {    
	public function __construct()
	{
		parent::__construct();
	}

	public function get_all_alumni()
	{
		$query = $this->db->query("SELECT m.*, j.nama_prodi, YEAR(rp.tanggal_yudisium) as tahun_lulus FROM mahasiswa m LEFT JOIN users_mhsw u ON m.id_user=u.id LEFT JOIN prodi j ON m.kd_prodi=j.kd_prodi LEFT JOIN riwayat_pendidikan rp ON j.jenjang=rp.jenjang WHERE u.level='alumni' GROUP BY m.id_user");
		return $query;
	}

	public function get_alumni_prodi($kd_prodi)
	{
		$query = $this->db->query("SELECT m.*, j.nama_prodi, YEAR(rp.tanggal_yudisium) as tahun_lulus FROM mahasiswa m LEFT JOIN users_mhsw u ON m.id_user=u.id LEFT JOIN prodi j ON m.kd_prodi=j.kd_prodi LEFT JOIN riwayat_pendidikan rp ON j.jenjang=rp.jenjang WHERE m.kd_prodi='$kd_prodi' AND u.level='alumni' GROUP BY m.id_user");
		return $query;
	}

	public function get_alumni_tahun($tahun_lulus)
	{
		$query = $this->db->query("SELECT m.*, j.nama_prodi, YEAR(rp.tanggal_yudisium) as tahun_lulus FROM mahasiswa m LEFT JOIN users_mhsw u ON m.id_user=u.id LEFT JOIN prodi j ON m.kd_prodi=j.kd_prodi LEFT JOIN riwayat_pendidikan rp ON j.jenjang=rp.jenjang WHERE m.tahun_lulus='$tahun_lulus' AND u.level='alumni' GROUP BY m.id_user");
		return $query;
	}
	
	public function get_all_mahasiswa()
	{
		$query = $this->db->query("SELECT m.*, j.nama_prodi FROM mahasiswa m LEFT JOIN prodi j ON m.kd_prodi=j.kd_prodi");
		return $query;
	}
	
	public function get_mahasiswa_prodi($kd_prodi)
	{
		$query = $this->db->query("SELECT m.*, j.nama_prodi FROM mahasiswa m LEFT JOIN prodi j ON m.kd_prodi=j.kd_prodi WHERE m.kd_prodi='$kd_prodi'");
		return $query;
	}

  public function get_pendaftar_mbkm()
  {
		$query = $this->db->query("SELECT p.*, k.nama_kegiatan, m.nama_program, d.nama as nama_dosen, mhs.nama, mhs.nim, mhs.nik, j.nama_prodi, mhs.no_hp, mhs.alamat, mt.nama as nama_mentor FROM pendaftaran p LEFT JOIN program_kegiatan k ON p.id_kegiatan=k.id LEFT JOIN program_mbkm m ON k.id_program=m.id LEFT JOIN dosen d ON p.id_dosen=d.id LEFT JOIN mahasiswa mhs ON p.id_mhsw = mhs.id LEFT JOIN prodi j ON mhs.kd_prodi=j.kd_prodi LEFT JOIN mentor mt ON p.id_mentor=mt.id ");
		return $query;
  }

  public function get_matakuliah_konversi($id)
  {
		$query = $this->db->query("SELECT mk.* FROM konversi_matakuliah k LEFT JOIN matakuliah mk ON k.kd_mk = mk.kd_mk WHERE k.id_pendaftaran='$id'");
		return $query;
  }

  public function get_pendaftar_prodi($kd_prodi, $st_daftar, $st_kegiatan)
  {
		$query = $this->db->query("SELECT p.*, k.nama_kegiatan, m.nama_program, d.nama as nama_dosen, mhs.nama, mhs.nim, mhs.nik, j.nama_prodi, mhs.no_hp, mhs.alamat, mt.nama as nama_mentor FROM pendaftaran p LEFT JOIN program_kegiatan k ON p.id_kegiatan=k.id LEFT JOIN program_mbkm m ON k.id_program=m.id LEFT JOIN dosen d ON p.id_dosen=d.id LEFT JOIN mahasiswa mhs ON p.id_mhsw = mhs.id LEFT JOIN prodi j ON mhs.kd_prodi=j.kd_prodi LEFT JOIN mentor mt ON p.id_mentor=mt.id WHERE mhs.kd_prodi='$kd_prodi' AND p.status_pendaftaran='$st_daftar' AND p.status_kegiatan='$st_kegiatan'");
		return $query;
  }

	public function get_pendaftar()
	{
		$query = $this->db->query("SELECT p.*, k.nama_kegiatan, mhs.nama, mhs.nim, m.nama_program FROM pendaftaran p LEFT JOIN program_kegiatan k ON p.id_kegiatan=k.id LEFT JOIN mahasiswa mhs ON p.id_mhsw = mhs.id LEFT JOIN program_mbkm m ON k.id_program=m.id WHERE p.status_pendaftaran='Diterima' AND p.status_kegiatan='Selesai'");
		return $query;
	}

	public function get_pendaftar_jur($kd_prodi)
	{
		$query = $this->db->query("SELECT p.*, k.nama_kegiatan, mhs.nama, mhs.nim, m.nama_program FROM pendaftaran p LEFT JOIN program_kegiatan k ON p.id_kegiatan=k.id LEFT JOIN mahasiswa mhs ON p.id_mhsw = mhs.id LEFT JOIN program_mbkm m ON k.id_program=m.id WHERE p.status_pendaftaran='Diterima' AND p.status_kegiatan='Selesai' AND mhs.kd_prodi='$kd_prodi'");
		return $query;
	}
	
	public function get_mahasiswa_detail($id)
	{
		$query = $this->db->query("SELECT mhs.*, k.nama_kegiatan, m.nama_program FROM pendaftaran p LEFT JOIN program_kegiatan k ON p.id_kegiatan=k.id LEFT JOIN program_mbkm m ON k.id_program=m.id LEFT JOIN mahasiswa mhs ON p.id_mhsw = mhs.id WHERE p.id='$id'");
		return $query;
	}
	
	public function get_nilai($id)
	{
		$query = $this->db->query("SELECT n.*, m.matakuliah, m.kd_mk, d.nama FROM nilai_kegiatan n  LEFT JOIN konversi_matakuliah k ON n.id_matakuliah = k.id LEFT JOIN matakuliah m ON k.kd_mk=m.kd_mk LEFT JOIN dosen d ON m.id_dosen = d.id WHERE n.id_pendaftaran = '$id'");
		return $query;
	}

	public function get_pendaftar_semester($semester)
	{
		$query = $this->db->query("SELECT p.*, k.nama_kegiatan, mhs.nama, mhs.nim, m.nama_program FROM pendaftaran p LEFT JOIN program_kegiatan k ON p.id_kegiatan=k.id LEFT JOIN mahasiswa mhs ON p.id_mhsw = mhs.id LEFT JOIN program_mbkm m ON k.id_program=m.id WHERE p.status_pendaftaran='Diterima' AND p.status_kegiatan='Selesai' AND p.semester='$semester'");
		return $query;
	}

	public function get_pendaftar_jur_semester($kd_prodi, $semester)
	{
		$query = $this->db->query("SELECT p.*, k.nama_kegiatan, mhs.nama, mhs.nim, m.nama_program FROM pendaftaran p LEFT JOIN program_kegiatan k ON p.id_kegiatan=k.id LEFT JOIN mahasiswa mhs ON p.id_mhsw = mhs.id LEFT JOIN program_mbkm m ON k.id_program=m.id WHERE p.status_pendaftaran='Diterima' AND p.status_kegiatan='Selesai' AND mhs.kd_prodi='$kd_prodi' AND p.semester='$semester'");
		return $query;
	}

	public function get_all_mitra()
	{
		$query = $this->db->query("SELECT * FROM mitra");
		return $query;
	}

	public function get_all_mentor()
	{
		$query = $this->db->query("SELECT mtr.*, m.nama_mitra FROM mentor mtr LEFT JOIN mitra m ON mtr.id_mitra=m.id ORDER BY mtr.id_mitra, mtr.nama ASC");
		return $query;
	}

	public function get_mentor_mitra($id_mitra)
	{
		$query = $this->db->query("SELECT mtr.*, m.nama_mitra FROM mentor mtr LEFT JOIN mitra m ON mtr.id_mitra=m.id WHERE mtr.id_mitra='$id_mitra' ORDER BY mtr.id_mitra, mtr.nama ASC");
		return $query;
	}

	public function get_pendaftar_mbkm_univ()
	{
		$query = $this->db->query("SELECT r.*, m.nama, m.nim, m.nik, j.nama_prodi, p.nama_program FROM riwayat_kegiatan_mhsw r LEFT JOIN mahasiswa m ON r.id_mhsw=m.id LEFT JOIN prodi j ON m.kd_prodi=j.kd_prodi LEFT JOIN program_mbkm p ON r.id_program_mbkm=p.id WHERE r.tipe='MBKM Universitas' OR r.tipe='MBKM Kementrian'");
		return $query;
	}

	public function get_pendaftar_mbkm_univ_prodi($kd_prodi)
	{
		$query = $this->db->query("SELECT r.*, m.nama, m.nim, m.nik, j.nama_prodi, p.nama_program FROM riwayat_kegiatan_mhsw r LEFT JOIN mahasiswa m ON r.id_mhsw=m.id LEFT JOIN prodi j ON m.kd_prodi=j.kd_prodi LEFT JOIN program_mbkm p ON r.id_program_mbkm=p.id WHERE (r.tipe='MBKM Universitas' OR r.tipe='MBKM Kementrian') AND m.kd_prodi='$kd_prodi'");
		return $query;
	}

	//IKU
	public function get_prodi_one($kd_prodi)
	{
		$query = $this->db->query("SELECT kd_prodi, nama_prodi FROM prodi WHERE kd_prodi='$kd_prodi'");
		return $query;
	}

	public function get_pendidikan_yudisium()
	{
		$query = $this->db->query("SELECT rp.id_mhsw, rp.tanggal_yudisium, rp.jenjang, YEAR(rp.tanggal_yudisium) as tahun_lulus, p.nama_prodi FROM riwayat_pendidikan rp LEFT JOIN mahasiswa m ON rp.id_mhsw=m.id LEFT JOIN users_mhsw um ON m.id_user=um.id LEFT JOIN prodi p ON m.kd_prodi=p.kd_prodi WHERE um.level='alumni' AND rp.jenjang=p.jenjang");
		return $query;
	}

	public function get_lulusan_pekerjaan($id_mhsw, $tgl_yudisium, $umr)
	{
		$query = $this->db->query("SELECT rp.*,m.nama, TIMESTAMPDIFF(MONTH, '$tgl_yudisium', rp.tanggal_masuk) as masa_tunggu FROM riwayat_pekerjaan rp LEFT JOIN mahasiswa m ON rp.id_mhsw=m.id WHERE rp.id_mhsw='$id_mhsw' AND rp.gaji >='$umr' AND rp.tanggal_masuk BETWEEN '$tgl_yudisium' AND DATE_ADD('$tgl_yudisium', INTERVAL 6 MONTH) - INTERVAL 1 DAY ORDER BY rp.tanggal_masuk limit 1");
		return $query;
	}

	public function get_lulusan_wirausaha($id_mhsw, $tgl_yudisium, $umr)
	{
		$query = $this->db->query("SELECT rw.*,m.nama, TIMESTAMPDIFF(MONTH, '$tgl_yudisium', rw.tanggal_mulai) as masa_tunggu FROM riwayat_wirausaha rw LEFT JOIN mahasiswa m ON rw.id_mhsw=m.id WHERE rw.id_mhsw='$id_mhsw' AND rw.rata_rata_omset >='$umr' AND rw.tanggal_mulai BETWEEN '$tgl_yudisium' AND DATE_ADD('$tgl_yudisium', INTERVAL 6 MONTH) - INTERVAL 1 DAY ORDER BY rw.tanggal_mulai limit 1");
		return $query;
	}

	public function get_lulusan_sebelum_wirausaha($id_mhsw, $tgl_yudisium, $umr)
	{
		$query = $this->db->query("SELECT rw.*,m.nama, TIMESTAMPDIFF(MONTH, '$tgl_yudisium', rw.tanggal_mulai) as masa_tunggu FROM riwayat_wirausaha rw LEFT JOIN mahasiswa m ON rw.id_mhsw=m.id WHERE rw.id_mhsw='$id_mhsw' AND rw.rata_rata_omset >='$umr' AND rw.tanggal_mulai <= '$tgl_yudisium' ORDER BY rw.tanggal_mulai limit 1");
		return $query;
	}

	public function get_pendidikan_yudisium_prodi($kd_prodi)
	{
		$query = $this->db->query("SELECT rp.id_mhsw, rp.tanggal_yudisium, rp.jenjang, YEAR(rp.tanggal_yudisium) as tahun_lulus, p.nama_prodi FROM riwayat_pendidikan rp LEFT JOIN mahasiswa m ON rp.id_mhsw=m.id LEFT JOIN users_mhsw um ON m.id_user=um.id LEFT JOIN prodi p ON m.kd_prodi=p.kd_prodi WHERE um.level='alumni' AND rp.jenjang=p.jenjang AND m.kd_prodi='$kd_prodi'");
		return $query;
	}

	public function get_pendidikan_yudisium_tanggal($tanggal_mulai, $tanggal_sampai)
	{
		$query = $this->db->query("SELECT rp.id_mhsw, rp.tanggal_yudisium, rp.jenjang, YEAR(rp.tanggal_yudisium) as tahun_lulus, p.nama_prodi FROM riwayat_pendidikan rp LEFT JOIN mahasiswa m ON rp.id_mhsw=m.id LEFT JOIN users_mhsw um ON m.id_user=um.id LEFT JOIN prodi p ON m.kd_prodi=p.kd_prodi WHERE um.level='alumni' AND rp.jenjang=p.jenjang AND ( rp.tanggal_yudisium >= '$tanggal_mulai' AND rp.tanggal_yudisium <= '$tanggal_sampai' )");
		return $query;
	}

	public function get_pendidikan_yudisium_prodi_tanggal($kd_prodi, $tanggal_mulai, $tanggal_sampai)
	{
		$query = $this->db->query("SELECT rp.id_mhsw, rp.tanggal_yudisium, rp.jenjang, YEAR(rp.tanggal_yudisium) as tahun_lulus, p.nama_prodi FROM riwayat_pendidikan rp LEFT JOIN mahasiswa m ON rp.id_mhsw=m.id LEFT JOIN users_mhsw um ON m.id_user=um.id  LEFT JOIN prodi p ON m.kd_prodi=p.kd_prodi WHERE um.level='alumni' AND rp.jenjang=p.jenjang AND m.kd_prodi='$kd_prodi' AND ( rp.tanggal_yudisium >= '$tanggal_mulai' AND rp.tanggal_yudisium <= '$tanggal_sampai' )");
		return $query;
	}

	public function get_lulusan_sebelum_kerja($id_mhsw, $tgl_yudisium, $umr)
	{
		$query = $this->db->query("SELECT rp.*,m.nama FROM riwayat_pekerjaan rp LEFT JOIN mahasiswa m ON rp.id_mhsw=m.id WHERE rp.id_mhsw='$id_mhsw' AND rp.gaji >='$umr' AND rp.tanggal_masuk <= '$tgl_yudisium' ORDER BY rp.tanggal_masuk limit 1");
		return $query;
	}

	public function get_lulusan_pendidikan()
	{
		$query = $this->db->query("SELECT rp.*, m.nama, YEAR(rp.tanggal_yudisium) as tahun_lulus, YEAR(rp.tanggal_masuk) as tahun_masuk, p.nama_prodi FROM riwayat_pendidikan rp LEFT JOIN mahasiswa m ON rp.id_mhsw=m.id LEFT JOIN users_mhsw um ON m.id_user=um.id LEFT JOIN prodi p ON m.kd_prodi=p.kd_prodi WHERE um.level='alumni' AND rp.jenjang = p.jenjang GROUP BY m.id ORDER BY m.nama");
		return $query;
	}

	public function get_lulusan_after($jenjang, $id)
	{
		$query = $this->db->query("SELECT rp.*, m.nama, YEAR(rp.tanggal_yudisium) as tahun_lulus, YEAR(rp.tanggal_masuk) as tahun_masuk, p.nama_prodi FROM riwayat_pendidikan rp LEFT JOIN mahasiswa m ON rp.id_mhsw=m.id LEFT JOIN users_mhsw um ON m.id_user=um.id LEFT JOIN prodi p ON m.kd_prodi=p.kd_prodi WHERE um.level='alumni' AND rp.jenjang != '$jenjang' AND rp.id_mhsw = '$id' ORDER BY rp.jenjang limit 1");
		return $query;
	}

	public function get_lulusan_pendidikan_prodi($kd_prodi)
	{
		$query = $this->db->query("SELECT rp.*, m.nama, YEAR(rp.tanggal_yudisium) as tahun_lulus, YEAR(rp.tanggal_masuk) as tahun_masuk, p.nama_prodi FROM riwayat_pendidikan rp LEFT JOIN mahasiswa m ON rp.id_mhsw=m.id LEFT JOIN users_mhsw um ON m.id_user=um.id LEFT JOIN prodi p ON m.kd_prodi=p.kd_prodi WHERE um.level='alumni' AND rp.jenjang = p.jenjang AND m.kd_prodi='$kd_prodi' GROUP BY m.id ORDER BY m.nama");
		return $query;
	}

	public function get_lulusan_pendidikan_tanggal($tanggal_mulai, $tanggal_sampai)
	{
		$query = $this->db->query("SELECT rp.*, m.nama, YEAR(rp.tanggal_yudisium) as tahun_lulus, YEAR(rp.tanggal_masuk) as tahun_masuk, p.nama_prodi FROM riwayat_pendidikan rp LEFT JOIN mahasiswa m ON rp.id_mhsw=m.id LEFT JOIN users_mhsw um ON m.id_user=um.id LEFT JOIN prodi p ON m.kd_prodi=p.kd_prodi WHERE um.level='alumni' AND rp.jenjang = p.jenjang AND ( rp.tanggal_yudisium >= '$tanggal_mulai' AND rp.tanggal_yudisium <= '$tanggal_sampai' ) ORDER BY m.nama");
		return $query;
	}

	public function get_lulusan_pendidikan_prodi_tanggal($kd_prodi, $tanggal_mulai, $tanggal_sampai)
	{
		$query = $this->db->query("SELECT rp.*, m.nama, p.jenjang as jenjang_awal, YEAR(rp.tanggal_yudisium) as tahun_lulus, YEAR(rp.tanggal_masuk) as tahun_masuk, p.nama_prodi FROM riwayat_pendidikan rp LEFT JOIN mahasiswa m ON rp.id_mhsw=m.id LEFT JOIN users_mhsw um ON m.id_user=um.id LEFT JOIN prodi p ON m.kd_prodi=p.kd_prodi WHERE um.level='alumni' AND m.kd_prodi='$kd_prodi' AND ( rp.tanggal_yudisium >= '$tanggal_mulai' AND rp.tanggal_yudisium <= '$tanggal_sampai' ) ORDER BY m.nama");
		return $query;
	}

	public function get_pendaftaran_mbkm()
	{
		$query = $this->db->query("SELECT p.id ,p.semester, m.nama, m.nim, pr.jenjang, pr.nama_prodi, m.angkatan, 'Fakultas' as jenis_mbkm, pm.nama_program, k.nama_kegiatan, k.waktu_mulai, k.waktu_selesai, k.lokasi_kegiatan, mt.nama_mitra FROM pendaftaran p LEFT JOIN mahasiswa m ON p.id_mhsw=m.id LEFT JOIN program_kegiatan k ON p.id_kegiatan=k.id LEFT JOIN program_mbkm pm ON k.id_program=pm.id LEFT JOIN prodi pr ON m.kd_prodi=pr.kd_prodi LEFT JOIN mitra mt ON k.id_mitra=mt.id LEFT JOIN users_mhsw u ON m.id_user=u.id WHERE u.level='mahasiswa' AND p.status_pendaftaran = 'Diterima' AND k.id_program!='1'");
		return $query;
	}

	public function get_pendaftaran_mbkm_prodi($kd_prodi)
	{
		$query = $this->db->query("SELECT p.id ,p.semester, m.nama, m.nim, pr.jenjang, pr.nama_prodi, m.angkatan, 'Fakultas' as jenis_mbkm, pm.nama_program, k.nama_kegiatan, k.waktu_mulai, k.waktu_selesai, k.lokasi_kegiatan, mt.nama_mitra FROM pendaftaran p LEFT JOIN mahasiswa m ON p.id_mhsw=m.id LEFT JOIN program_kegiatan k ON p.id_kegiatan=k.id LEFT JOIN program_mbkm pm ON k.id_program=pm.id LEFT JOIN prodi pr ON m.kd_prodi=pr.kd_prodi LEFT JOIN mitra mt ON k.id_mitra=mt.id LEFT JOIN users_mhsw u ON m.id_user=u.id WHERE u.level='mahasiswa' AND p.status_pendaftaran = 'Diterima' AND k.id_program!='1' AND m.kd_prodi='$kd_prodi'");
		return $query;
	}

	public function get_pendaftaran_mbkm_semester($semester)
	{
		$query = $this->db->query("SELECT p.id ,p.semester, m.nama, m.nim, pr.jenjang, pr.nama_prodi, m.angkatan, 'Fakultas' as jenis_mbkm, pm.nama_program, k.nama_kegiatan, k.waktu_mulai, k.waktu_selesai, k.lokasi_kegiatan, mt.nama_mitra FROM pendaftaran p LEFT JOIN mahasiswa m ON p.id_mhsw=m.id LEFT JOIN program_kegiatan k ON p.id_kegiatan=k.id LEFT JOIN program_mbkm pm ON k.id_program=pm.id LEFT JOIN prodi pr ON m.kd_prodi=pr.kd_prodi LEFT JOIN mitra mt ON k.id_mitra=mt.id LEFT JOIN users_mhsw u ON m.id_user=u.id WHERE u.level='mahasiswa' AND p.status_pendaftaran = 'Diterima' AND k.id_program!='1' AND p.semester='$semester'");
		return $query;
	}

	public function get_pendaftaran_mbkm_prodi_semester($kd_prodi, $semester)
	{
		$query = $this->db->query("SELECT p.id ,p.semester, m.nama, m.nim, pr.jenjang, pr.nama_prodi, m.angkatan, 'Fakultas' as jenis_mbkm, pm.nama_program, k.nama_kegiatan, k.waktu_mulai, k.waktu_selesai, k.lokasi_kegiatan, mt.nama_mitra FROM pendaftaran p LEFT JOIN mahasiswa m ON p.id_mhsw=m.id LEFT JOIN program_kegiatan k ON p.id_kegiatan=k.id LEFT JOIN program_mbkm pm ON k.id_program=pm.id LEFT JOIN prodi pr ON m.kd_prodi=pr.kd_prodi LEFT JOIN mitra mt ON k.id_mitra=mt.id LEFT JOIN users_mhsw u ON m.id_user=u.id WHERE u.level='mahasiswa' AND p.status_pendaftaran = 'Diterima' AND k.id_program!='1' AND m.kd_prodi='$kd_prodi' AND p.semester='$semester'");
		return $query;
	}

	public function get_jumlah_sks($id_pendaftaran)
	{
		$query = $this->db->query("SELECT sum(m.sks) as jumlah_sks FROM konversi_matakuliah k LEFT JOIN matakuliah m ON k.kd_mk=m.kd_mk WHERE k.id_pendaftaran='$id_pendaftaran'");
		return $query;
	}

	public function get_pendaftaran_mbkm_pertukaran()
	{
		$query = $this->db->query("SELECT p.id ,p.semester, m.nama, m.nim, pr.jenjang, pr.nama_prodi, m.angkatan, 'Fakultas' as jenis_mbkm, pm.nama_program, k.nama_kegiatan, k.waktu_mulai, k.waktu_selesai, k.lokasi_kegiatan, mt.nama_mitra FROM pendaftaran p LEFT JOIN mahasiswa m ON p.id_mhsw=m.id LEFT JOIN program_kegiatan k ON p.id_kegiatan=k.id LEFT JOIN program_mbkm pm ON k.id_program=pm.id LEFT JOIN prodi pr ON m.kd_prodi=pr.kd_prodi LEFT JOIN mitra mt ON k.id_mitra=mt.id LEFT JOIN users_mhsw u ON m.id_user=u.id WHERE u.level='mahasiswa' AND p.status_pendaftaran = 'Diterima' AND k.id_program='1'");
		return $query;
	}

	public function get_pendaftaran_mbkm_pertukaran_prodi($kd_prodi)
	{
		$query = $this->db->query("SELECT p.id ,p.semester, m.nama, m.nim, pr.jenjang, pr.nama_prodi, m.angkatan, 'Fakultas' as jenis_mbkm, pm.nama_program, k.nama_kegiatan, k.waktu_mulai, k.waktu_selesai, k.lokasi_kegiatan, mt.nama_mitra FROM pendaftaran p LEFT JOIN mahasiswa m ON p.id_mhsw=m.id LEFT JOIN program_kegiatan k ON p.id_kegiatan=k.id LEFT JOIN program_mbkm pm ON k.id_program=pm.id LEFT JOIN prodi pr ON m.kd_prodi=pr.kd_prodi LEFT JOIN mitra mt ON k.id_mitra=mt.id LEFT JOIN users_mhsw u ON m.id_user=u.id WHERE u.level='mahasiswa' AND p.status_pendaftaran = 'Diterima' AND k.id_program='1' AND m.kd_prodi='$kd_prodi'");
		return $query;
	}

	public function get_pendaftaran_mbkm_pertukaran_semester($semester)
	{
		$query = $this->db->query("SELECT p.id ,p.semester, m.nama, m.nim, pr.jenjang, pr.nama_prodi, m.angkatan, 'Fakultas' as jenis_mbkm, pm.nama_program, k.nama_kegiatan, k.waktu_mulai, k.waktu_selesai, k.lokasi_kegiatan, mt.nama_mitra FROM pendaftaran p LEFT JOIN mahasiswa m ON p.id_mhsw=m.id LEFT JOIN program_kegiatan k ON p.id_kegiatan=k.id LEFT JOIN program_mbkm pm ON k.id_program=pm.id LEFT JOIN prodi pr ON m.kd_prodi=pr.kd_prodi LEFT JOIN mitra mt ON k.id_mitra=mt.id LEFT JOIN users_mhsw u ON m.id_user=u.id WHERE u.level='mahasiswa' AND p.status_pendaftaran = 'Diterima' AND k.id_program='1' AND p.semester='$semester'");
		return $query;
	}

	public function get_pendaftaran_mbkm_pertukaran_prodi_semester($kd_prodi, $semester)
	{
		$query = $this->db->query("SELECT p.id ,p.semester, m.nama, m.nim, pr.jenjang, pr.nama_prodi, m.angkatan, 'Fakultas' as jenis_mbkm, pm.nama_program, k.nama_kegiatan, k.waktu_mulai, k.waktu_selesai, k.lokasi_kegiatan, mt.nama_mitra FROM pendaftaran p LEFT JOIN mahasiswa m ON p.id_mhsw=m.id LEFT JOIN program_kegiatan k ON p.id_kegiatan=k.id LEFT JOIN program_mbkm pm ON k.id_program=pm.id LEFT JOIN prodi pr ON m.kd_prodi=pr.kd_prodi LEFT JOIN mitra mt ON k.id_mitra=mt.id LEFT JOIN users_mhsw u ON m.id_user=u.id WHERE u.level='mahasiswa' AND p.status_pendaftaran = 'Diterima' AND k.id_program='1' AND m.kd_prodi='$kd_prodi' AND p.semester='$semester'");
		return $query;
	}


	public function get_jumlah_sks_pertukaran($id_pendaftaran)
	{
		$query = $this->db->query("SELECT sum(m.sks) as jumlah_sks FROM konversi_mk_pertukaran k LEFT JOIN matakuliah m ON k.kd_mk=m.kd_mk WHERE k.id_pendaftaran='$id_pendaftaran'");
		return $query;
	}

	public function get_pendaftaran_mbkm_kegiatan_lain()
	{
		$query = $this->db->query("SELECT k.id, k.semester, m.nama, m.nim, pr.jenjang, pr.nama_prodi, m.angkatan, k.jenis_mbkm, pm.nama_program, k.nama_kegiatan, '' as waktu_mulai, '' as waktu_selesai, k.penyelenggara_mbkm as nama_mitra FROM kegiatan_mbkm_lain k LEFT JOIN mahasiswa m ON k.id_mhsw = m.id LEFT JOIN program_mbkm pm ON k.id_program_mbkm = pm.id LEFT JOIN prodi pr ON m.kd_prodi=pr.kd_prodi LEFT JOIN users_mhsw u ON m.id_user=u.id WHERE u.level = 'mahasiswa'");
		return $query;
	}

	public function get_pendaftaran_mbkm_kegiatan_lain_prodi($kd_prodi)
	{
		$query = $this->db->query("SELECT k.id, k.semester, m.nama, m.nim, pr.jenjang, pr.nama_prodi, m.angkatan, k.jenis_mbkm, pm.nama_program, k.nama_kegiatan, '' as waktu_mulai, '' as waktu_selesai, k.penyelenggara_mbkm as nama_mitra FROM kegiatan_mbkm_lain k LEFT JOIN mahasiswa m ON k.id_mhsw = m.id LEFT JOIN program_mbkm pm ON k.id_program_mbkm = pm.id LEFT JOIN prodi pr ON m.kd_prodi=pr.kd_prodi LEFT JOIN users_mhsw u ON m.id_user=u.id WHERE u.level = 'mahasiswa' AND m.kd_prodi='$kd_prodi'");
		return $query;
	}

	public function get_pendaftaran_mbkm_kegiatan_lain_semester($semester)
	{
		$query = $this->db->query("SELECT k.id, k.semester, m.nama, m.nim, pr.jenjang, pr.nama_prodi, m.angkatan, k.jenis_mbkm, pm.nama_program, k.nama_kegiatan, '' as waktu_mulai, '' as waktu_selesai, k.penyelenggara_mbkm as nama_mitra FROM kegiatan_mbkm_lain k LEFT JOIN mahasiswa m ON k.id_mhsw = m.id LEFT JOIN program_mbkm pm ON k.id_program_mbkm = pm.id LEFT JOIN prodi pr ON m.kd_prodi=pr.kd_prodi LEFT JOIN users_mhsw u ON m.id_user=u.id WHERE u.level = 'mahasiswa' AND k.semester='$semester'");
		return $query;
	}

	public function get_pendaftaran_mbkm_kegiatan_lain_prodi_semester($kd_prodi, $semester)
	{
		$query = $this->db->query("SELECT k.id, k.semester, m.nama, m.nim, pr.jenjang, pr.nama_prodi, m.angkatan, k.jenis_mbkm, pm.nama_program, k.nama_kegiatan, '' as waktu_mulai, '' as waktu_selesai, k.penyelenggara_mbkm as nama_mitra FROM kegiatan_mbkm_lain k LEFT JOIN mahasiswa m ON k.id_mhsw = m.id LEFT JOIN program_mbkm pm ON k.id_program_mbkm = pm.id LEFT JOIN prodi pr ON m.kd_prodi=pr.kd_prodi LEFT JOIN users_mhsw u ON m.id_user=u.id WHERE u.level = 'mahasiswa' AND m.kd_prodi='$kd_prodi' AND k.semester='$semester'");
		return $query;
	}

	public function get_jumlah_sks_kegiatan_lain($id_kegiatan_lain)
	{
		$query = $this->db->query("SELECT SUM(m.sks) as jumlah_sks FROM mk_kegiatan mk LEFT JOIN kegiatan_mbkm_lain k ON mk.id_kegiatan_mbkm_lain=k.id LEFT JOIN matakuliah m ON mk.kd_mk=m.kd_mk WHERE k.id = '$id_kegiatan_lain'");
		return $query;
	}

	public function get_prestasi()
	{
		$query = $this->db->query("SELECT r.*, m.nama, m.nim, m.angkatan, pr.jenjang, pr.nama_prodi FROM riwayat_prestasi r LEFT JOIN mahasiswa m ON r.id_mhsw = m.id LEFT JOIN users_mhsw u ON m.id_user=u.id LEFT JOIN prodi pr ON m.kd_prodi=pr.kd_prodi WHERE u.level='mahasiswa'");
		return $query;
	}

	public function get_prestasi_prodi($kd_prodi)
	{
		$query = $this->db->query("SELECT r.*, m.nama, m.nim, m.angkatan, pr.jenjang, pr.nama_prodi FROM riwayat_prestasi r LEFT JOIN mahasiswa m ON r.id_mhsw = m.id LEFT JOIN users_mhsw u ON m.id_user=u.id LEFT JOIN prodi pr ON m.kd_prodi=pr.kd_prodi WHERE u.level='mahasiswa' AND m.kd_prodi='$kd_prodi'");
		return $query;
	}

	public function get_prestasi_tingkat($tingkat_kegiatan)
	{
		$query = $this->db->query("SELECT r.*, m.nama, m.nim, m.angkatan, pr.jenjang, pr.nama_prodi FROM riwayat_prestasi r LEFT JOIN mahasiswa m ON r.id_mhsw = m.id LEFT JOIN users_mhsw u ON m.id_user=u.id LEFT JOIN prodi pr ON m.kd_prodi=pr.kd_prodi WHERE u.level='mahasiswa' AND r.tingkat_kegiatan='$tingkat_kegiatan'");
		return $query;
	}

	public function get_prestasi_prodi_tingkat($kd_prodi, $tingkat_kegiatan)
	{
		$query = $this->db->query("SELECT r.*, m.nama, m.nim, m.angkatan, pr.jenjang, pr.nama_prodi FROM riwayat_prestasi r LEFT JOIN mahasiswa m ON r.id_mhsw = m.id LEFT JOIN users_mhsw u ON m.id_user=u.id LEFT JOIN prodi pr ON m.kd_prodi=pr.kd_prodi WHERE u.level='mahasiswa' AND m.kd_prodi='$kd_prodi' AND r.tingkat_kegiatan='$tingkat_kegiatan'");
		return $query;
	}

	public function get_pekerjaan_dosen()
	{
		$query = $this->db->query("SELECT m.*, mt.nama_mitra FROM mentor m LEFT JOIN mitra mt ON m.id_mitra=mt.id WHERE m.jenis_personil='Dosen Praktisi'");
		return $query;
	}

	public function get_wirausaha_dosen()
	{
		$query = $this->db->query("SELECT r.*, d.nama, d.nip, d.pangkat_gol, d.jabatan_fungsional, p.nama_prodi FROM riwayat_wirausaha_dosen r LEFT JOIN dosen d ON r.id_dosen=d.id LEFT JOIN prodi p ON d.kd_prodi=p.kd_prodi");
		return $query;
	}

	public function get_pekerjaan_dosen_prodi($kd_prodi)
	{
		$query = $this->db->query("SELECT r.*, d.nama, d.nip, d.pangkat_gol, d.jabatan_fungsional, p.nama_prodi FROM riwayat_pekerjaan_dosen r LEFT JOIN dosen d ON r.id_dosen=d.id LEFT JOIN prodi p ON d.kd_prodi=p.kd_prodi WHERE r.jenis_pekerjaan='Luar Kampus' AND d.kd_prodi='$kd_prodi'");
		return $query;
	}

	public function get_wirausaha_dosen_prodi($kd_prodi)
	{
		$query = $this->db->query("SELECT r.*, d.nama, d.nip, d.pangkat_gol, d.jabatan_fungsional, p.nama_prodi FROM riwayat_wirausaha_dosen r LEFT JOIN dosen d ON r.id_dosen=d.id LEFT JOIN prodi p ON d.kd_prodi=p.kd_prodi WHERE d.kd_prodi='$kd_prodi'");
		return $query;
	}

	public function get_pekerjaan_dosen_waktu($tanggal_mulai, $tanggal_sampai)
	{
		$query = $this->db->query("SELECT r.*, d.nama, d.nip, d.pangkat_gol, d.jabatan_fungsional, p.nama_prodi FROM riwayat_pekerjaan_dosen r LEFT JOIN dosen d ON r.id_dosen=d.id LEFT JOIN prodi p ON d.kd_prodi=p.kd_prodi WHERE r.jenis_pekerjaan='Luar Kampus' AND (r.tanggal_masuk >= '$tanggal_mulai' AND r.tanggal_masuk <= '$tanggal_sampai' )");
		return $query;
	}

	public function get_wirausaha_dosen_waktu($tanggal_mulai, $tanggal_sampai)
	{
		$query = $this->db->query("SELECT r.*, d.nama, d.nip, d.pangkat_gol, d.jabatan_fungsional, p.nama_prodi FROM riwayat_wirausaha_dosen r LEFT JOIN dosen d ON r.id_dosen=d.id LEFT JOIN prodi p ON d.kd_prodi=p.kd_prodi WHERE (r.tanggal_mulai >= '$tanggal_mulai' AND r.tanggal_mulai <= '$tanggal_sampai' )");
		return $query;
	}

	public function get_pekerjaan_dosen_prodi_waktu($kd_prodi, $tanggal_mulai, $tanggal_sampai)
	{
		$query = $this->db->query("SELECT r.*, d.nama, d.nip, d.pangkat_gol, d.jabatan_fungsional, p.nama_prodi FROM riwayat_pekerjaan_dosen r LEFT JOIN dosen d ON r.id_dosen=d.id LEFT JOIN prodi p ON d.kd_prodi=p.kd_prodi WHERE r.jenis_pekerjaan='Luar Kampus' AND d.kd_prodi='$kd_prodi' AND (r.tanggal_masuk >= '$tanggal_mulai' AND r.tanggal_masuk <= '$tanggal_sampai' )");
		return $query;
	}

	public function get_wirausaha_dosen_prodi_waktu($kd_prodi, $tanggal_mulai, $tanggal_sampai)
	{
		$query = $this->db->query("SELECT r.*, d.nama, d.nip, d.pangkat_gol, d.jabatan_fungsional, p.nama_prodi FROM riwayat_wirausaha_dosen r LEFT JOIN dosen d ON r.id_dosen=d.id LEFT JOIN prodi p ON d.kd_prodi=p.kd_prodi WHERE d.kd_prodi='$kd_prodi' AND (r.tanggal_mulai >= '$tanggal_mulai' AND r.tanggal_mulai <= '$tanggal_sampai' )");
		return $query;
	}

	public function get_pendidikan_s3_dosen()
	{
		$query = $this->db->query("SELECT r.*, d.nama, d.nip, d.pangkat_gol, d.jabatan_fungsional, p.nama_prodi FROM riwayat_pendidikan_dosen r LEFT JOIN dosen d ON r.id_dosen=d.id LEFT JOIN prodi p ON d.kd_prodi=p.kd_prodi WHERE r.jenjang='S3'");
		return $query;
	}

	public function get_sertifikasi_dosen()
	{
		$query = $this->db->query("SELECT r.*, d.nama, d.nip, d.pangkat_gol, d.jabatan_fungsional, p.nama_prodi FROM riwayat_seminar_dosen r LEFT JOIN dosen d ON r.id_dosen=d.id LEFT JOIN prodi p ON d.kd_prodi=p.kd_prodi");
		return $query;
	}

	public function get_pendidikan_s3_dosen_prodi($kd_prodi)
	{
		$query = $this->db->query("SELECT r.*, d.nama, d.nip, d.pangkat_gol, d.jabatan_fungsional, p.nama_prodi FROM riwayat_pendidikan_dosen r LEFT JOIN dosen d ON r.id_dosen=d.id LEFT JOIN prodi p ON d.kd_prodi=p.kd_prodi WHERE r.jenjang='S3' AND d.kd_prodi='$kd_prodi'");
		return $query;
	}

	public function get_sertifikasi_dosen_prodi($kd_prodi)
	{
		$query = $this->db->query("SELECT r.*, d.nama, d.nip, d.pangkat_gol, d.jabatan_fungsional, p.nama_prodi FROM riwayat_seminar_dosen r LEFT JOIN dosen d ON r.id_dosen=d.id LEFT JOIN prodi p ON d.kd_prodi=p.kd_prodi WHERE d.kd_prodi='$kd_prodi'");
		return $query;
	}

	public function get_karya_ilmiah()
	{
		$query = $this->db->query("SELECT r.*, d.nama, d.nip, d.pangkat_gol, d.jabatan_fungsional, p.nama_prodi FROM riwayat_karya_ilmiah_dosen r LEFT JOIN dosen d ON r.id_dosen=d.id LEFT JOIN prodi p ON d.kd_prodi=p.kd_prodi");
		return $query;
	}

	public function get_karya_ilmiah_prodi($kd_prodi)
	{
		$query = $this->db->query("SELECT r.*, d.nama, d.nip, d.pangkat_gol, d.jabatan_fungsional, p.nama_prodi FROM riwayat_karya_ilmiah_dosen r LEFT JOIN dosen d ON r.id_dosen=d.id LEFT JOIN prodi p ON d.kd_prodi=p.kd_prodi WHERE d.kd_prodi='$kd_prodi'");
		return $query;
	}

	public function get_karya_ilmiah_tahun($tahun)
	{
		$query = $this->db->query("SELECT r.*, d.nama, d.nip, d.pangkat_gol, d.jabatan_fungsional, p.nama_prodi FROM riwayat_karya_ilmiah_dosen r LEFT JOIN dosen d ON r.id_dosen=d.id LEFT JOIN prodi p ON d.kd_prodi=p.kd_prodi WHERE r.tahun='$tahun'");
		return $query;
	}

	public function get_karya_ilmiah_prodi_tahun($kd_prodi, $tahun)
	{
		$query = $this->db->query("SELECT r.*, d.nama, d.nip, d.pangkat_gol, d.jabatan_fungsional, p.nama_prodi FROM riwayat_karya_ilmiah_dosen r LEFT JOIN dosen d ON r.id_dosen=d.id LEFT JOIN prodi p ON d.kd_prodi=p.kd_prodi WHERE d.kd_prodi='$kd_prodi' AND r.tahun='$tahun'");
		return $query;
	}

	public function get_mitra()
	{
		$query = $this->db->query("SELECT * from mitra");
		return $query;
	}

	public function get_mitra_kurikulum()
	{
		$query = $this->db->query("SELECT * from mitra WHERE partisipasi_dalam_kurikulum = 'Iya'");
		return $query;
	}

	public function get_mitra_magang()
	{
		$query = $this->db->query("SELECT m.* from mitra m LEFT JOIN program_kegiatan p ON m.id=p.id_mitra WHERE p.id_program='2' GROUP BY m.id");
		return $query;
	}

	public function get_matakuliah()
	{
		$query = $this->db->query("SELECT * from matakuliah");
		return $query;
	}

	public function get_matakuliah_inbound_aktif()
	{
		$query = $this->db->query("SELECT j.*, m.matakuliah, m.sks from jadwal_kuliah_inbound j LEFT JOIN matakuliah m ON j.kd_mk=m.kd_mk WHERE (j.waktu_mulai <= CURDATE() AND j.waktu_selesai >= CURDATE())");
		return $query;
	}

	public function get_matakuliah_inbound()
	{
		$query = $this->db->query("SELECT j.*, m.matakuliah, m.sks from jadwal_kuliah_inbound j LEFT JOIN matakuliah m ON j.kd_mk=m.kd_mk");
		return $query;
	}
}
?>
