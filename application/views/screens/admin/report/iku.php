<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-6">
        <h3>Report IKU</h3>
      </div>
      <div class="col-6">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url('home'); ?>"><i data-feather="home"></i></a></li>
          <li class="breadcrumb-item active">Report IKU</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<!-- Container-fluid starts-->
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12 col-md-6">
      <div class="card card-absolute">
        <div class="card-header bg-primary">
          <h5 class="text-white">Data Lulusan dengan masa tunggu < 6 bulan & > 1,2 kali UMR </h5>
        </div>
        <form class="form theme-form" method="post" action="<?= base_url('admin/report/data_lulusan_6_bln') ?>">
          <div class="card-body">
            <br>
            <div class="row">
              <div class="col-md-12">
                <select name="jenis_print" class="form-select" onchange="jenis_print_lulus(this.value)">
                  <option value="">- Pilih Jenis Print - </option>
                  <option value="1">Download Keseluruhan</option>
                  <option value="2">Download Berdasarkan Prodi</option>
                  <option value="3">Download Berdasarkan Tanggal Yudisium</option>
                  <option value="4">Download Berdasarkan Prodi & Tanggal Yudisium</option>
                </select>
              </div>
            </div>
            <div class="row" id="container_print_lulusan">
              
            </div>
          </div>
          <div class="card-footer" style="padding: 20px;">
              <button class="btn btn-primary" type="submit">Download</button>
          </div>
        </form>
      </div>
    </div>
    <div class="col-sm-12 col-md-6">
      <div class="card card-absolute">
        <div class="card-header bg-primary">
          <h5 class="text-white">Data Lulusan yang telah berpenghasilan > 1,2 Kali UMR Sebelum Lulus</h5>
        </div>
        <form class="form theme-form" method="post" action="<?= base_url('admin/report/data_lulusan_1_2_kali') ?>">
          <div class="card-body">
            <br>
            <div class="row">
              <div class="col-md-12">
                <select name="jenis_print" class="form-select" onchange="jenis_print_lulus_1(this.value)">
                  <option value="">- Pilih Jenis Print - </option>
                  <option value="1">Download Keseluruhan</option>
                  <option value="2">Download Berdasarkan Prodi</option>
                  <option value="3">Download Berdasarkan Tanggal Yudisium</option>
                  <option value="4">Download Berdasarkan Prodi & Tanggal Yudisium</option>
                </select>
              </div>
            </div>
            <div class="row" id="container_print_lulusan_1">
              
            </div>
          </div>
          <div class="card-footer" style="padding: 20px;">
              <button class="btn btn-primary" type="submit">Download</button>
          </div>
        </form>
      </div>
    </div>
    <div class="col-sm-12 col-md-6">
      <div class="card card-absolute">
        <div class="card-header bg-primary">
          <h5 class="text-white">Data Lulusan yang Melanjutkan Pendidikan ke jenjang yang lebih tinggi</h5>
        </div>
        <form class="form theme-form" method="post" action="<?= base_url('admin/report/data_lulusan_lanjut_pendidikan') ?>">
          <div class="card-body">
            <br>
            <div class="row">
              <div class="col-md-12">
                <select name="jenis_print" class="form-select" onchange="jenis_print_lulus_2(this.value)">
                  <option value="">- Pilih Jenis Print - </option>
                  <option value="1">Download Keseluruhan</option>
                  <option value="2">Download Berdasarkan Prodi</option>
                  <option value="3">Download Berdasarkan Tanggal Yudisium</option>
                  <option value="4">Download Berdasarkan Prodi & Tanggal Yudisium</option>
                </select>
              </div>
            </div>
            <div class="row" id="container_print_lulusan_2">
              
            </div>
          </div>
          <div class="card-footer" style="padding: 20px;">
              <button class="btn btn-primary" type="submit">Download</button>
          </div>
        </form>
      </div>
    </div>
    <div class="col-sm-12 col-md-6">
      <div class="card card-absolute">
        <div class="card-header bg-primary">
          <h5 class="text-white">Data Lulusan yang Berwirausaha dalam Kurun Waktu < 6 Bulan Setelah Lulus & Berpenghasilan 1,2 X UMR</h5>
        </div>
        <form class="form theme-form" method="post" action="<?= base_url('admin/report/data_lulusan_wirausaha_6_bulan') ?>">
          <div class="card-body">
            <br>
            <div class="row">
              <div class="col-md-12">
                <select name="jenis_print" class="form-select" onchange="jenis_print_lulus_3(this.value)">
                  <option value="">- Pilih Jenis Print - </option>
                  <option value="1">Download Keseluruhan</option>
                  <option value="2">Download Berdasarkan Prodi</option>
                  <option value="3">Download Berdasarkan Tanggal Yudisium</option>
                  <option value="4">Download Berdasarkan Prodi & Tanggal Yudisium</option>
                </select>
              </div>
            </div>
            <div class="row" id="container_print_lulusan_3">
              
            </div>
          </div>
          <div class="card-footer" style="padding: 20px;">
              <button class="btn btn-primary" type="submit">Download</button>
          </div>
        </form>
      </div>
    </div>
    <div class="col-sm-12 col-md-6">
      <div class="card card-absolute">
        <div class="card-header bg-primary">
          <h5 class="text-white">Data Lulusan yang Berwirausaha Sebelum Lulus & Berpenghasilan 1,2 X UMR</h5>
        </div>
        <form class="form theme-form" method="post" action="<?= base_url('admin/report/data_lulusan_wirausaha_1_2_kali') ?>">
          <div class="card-body">
            <br>
            <div class="row">
              <div class="col-md-12">
                <select name="jenis_print" class="form-select" onchange="jenis_print_lulus_4(this.value)">
                  <option value="">- Pilih Jenis Print - </option>
                  <option value="1">Download Keseluruhan</option>
                  <option value="2">Download Berdasarkan Prodi</option>
                  <option value="3">Download Berdasarkan Tanggal Yudisium</option>
                  <option value="4">Download Berdasarkan Prodi & Tanggal Yudisium</option>
                </select>
              </div>
            </div>
            <div class="row" id="container_print_lulusan_4">
              
            </div>
          </div>
          <div class="card-footer" style="padding: 20px;">
              <button class="btn btn-primary" type="submit">Download</button>
          </div>
        </form>
      </div>
    </div>
    <div class="col-sm-12 col-md-6">
      <div class="card card-absolute">
        <div class="card-header bg-primary">
          <h5 class="text-white">IKU 2 Kegiatan MBKM</h5>
        </div>
        <form class="form theme-form" method="post" action="<?= base_url('admin/report/iku_2_kegiatan') ?>">
          <div class="card-body">
            <br>
            <div class="row">
              <div class="col-md-12">
                <select name="jenis_print" class="form-select" onchange="jenis_print_lulus_5(this.value)">
                  <option value="">- Pilih Jenis Print - </option>
                  <option value="1">Download Keseluruhan</option>
                  <option value="2">Download Berdasarkan Prodi</option>
                  <option value="3">Download Berdasarkan Semester</option>
                  <option value="4">Download Berdasarkan Prodi & Semester</option>
                </select>
              </div>
            </div>
            <div class="row" id="container_print_lulusan_5">
              
            </div>
          </div>
          <div class="card-footer" style="padding: 20px;">
              <button class="btn btn-primary" type="submit">Download</button>
          </div>
        </form>
      </div>
    </div>
    <div class="col-sm-12 col-md-6">
      <div class="card card-absolute">
        <div class="card-header bg-primary">
          <h5 class="text-white">IKU 2 Riwayat Prestasi</h5>
        </div>
        <form class="form theme-form" method="post" action="<?= base_url('admin/report/iku_2_prestasi') ?>">
          <div class="card-body">
            <br>
            <div class="row">
              <div class="col-md-12">
                <select name="jenis_print" class="form-select" onchange="jenis_print_lulus_6(this.value)">
                  <option value="">- Pilih Jenis Print - </option>
                  <option value="1">Download Keseluruhan</option>
                  <option value="2">Download Berdasarkan Prodi</option>
                  <option value="3">Download Berdasarkan Tingkat Kegiatan</option>
                  <option value="4">Download Berdasarkan Prodi & Tingkat Kegiatan</option>
                </select>
              </div>
            </div>
            <div class="row" id="container_print_lulusan_6">
              
            </div>
          </div>
          <div class="card-footer" style="padding: 20px;">
              <button class="btn btn-primary" type="submit">Download</button>
          </div>
        </form>
      </div>
    </div>
    <div class="col-sm-12 col-md-6">
      <div class="card card-absolute">
        <div class="card-header bg-primary">
          <h5 class="text-white">IKU 3 Data Dosen Tetap</h5>
        </div>
        <form class="form theme-form" method="post" action="<?= base_url('admin/report/iku_3_data_dosen') ?>">
          <div class="card-body">
            <br>
            <div class="row">
              <div class="col-md-12">
                <select name="jenis_print" class="form-select" onchange="jenis_print_lulus_7(this.value)">
                  <option value="">- Pilih Jenis Print - </option>
                  <option value="1">Download Keseluruhan</option>
                  <option value="2">Download Berdasarkan Prodi</option>
                  <option value="3">Download Berdasarkan Tanggal Mulai/Masuk</option>
                  <option value="4">Download Berdasarkan Prodi & Tanggal Mulai</option>
                </select>
              </div>
            </div>
            <div class="row" id="container_print_lulusan_7">
              
            </div>
          </div>
          <div class="card-footer" style="padding: 20px;">
              <button class="btn btn-primary" type="submit">Download</button>
          </div>
        </form>
      </div>
    </div>
    <div class="col-sm-12 col-md-6">
      <div class="card card-absolute">
        <div class="card-header bg-primary">
          <h5 class="text-white">IKU 4 DATA KUALIFIKASI DOSEN</h5>
        </div>
        <form class="form theme-form" method="post" action="<?= base_url('admin/report/iku_4_data_kualifikasi_dosen') ?>">
          <div class="card-body">
            <br>
            <div class="row">
              <div class="col-md-12">
                <select name="jenis_print" class="form-select" onchange="jenis_print_lulus_8(this.value)">
                  <option value="">- Pilih Jenis Print - </option>
                  <option value="1">Download Keseluruhan</option>
                  <option value="2">Download Berdasarkan Prodi</option>
                </select>
              </div>
            </div>
            <div class="row" id="container_print_lulusan_8">
              
            </div>
          </div>
          <div class="card-footer" style="padding: 20px;">
              <button class="btn btn-primary" type="submit">Download</button>
          </div>
        </form>
      </div>
    </div>
    <div class="col-sm-12 col-md-6">
      <div class="card card-absolute">
        <div class="card-header bg-primary">
          <h5 class="text-white">IKU 5 Recognisi Karya Dosen</h5>
        </div>
        <form class="form theme-form" method="post" action="<?= base_url('admin/report/iku_5_recognisi') ?>">
          <div class="card-body">
            <br>
            <div class="row">
              <div class="col-md-12">
                <select name="jenis_print" class="form-select" onchange="jenis_print_lulus_9(this.value)">
                  <option value="">- Pilih Jenis Print - </option>
                  <option value="1">Download Keseluruhan</option>
                  <option value="2">Download Berdasarkan Prodi</option>
                  <option value="3">Download Berdasarkan Tahun Penerbitan</option>
                  <option value="4">Download Berdasarkan Prodi & Tahun Penerbitan</option>
                </select>
              </div>
            </div>
            <div class="row" id="container_print_lulusan_9">
              
            </div>
          </div>
          <div class="card-footer" style="padding: 20px;">
              <button class="btn btn-primary" type="submit">Download</button>
          </div>
        </form>
      </div>
    </div>
    <div class="col-sm-12 col-md-6">
      <div class="card card-absolute">
        <div class="card-header bg-primary">
          <h5 class="text-white">IKU 6 DATA KERJASAMA DENGAN MITRA</h5>
        </div>
        <form class="form theme-form" method="post" action="<?= base_url('admin/report/iku_6_mitra') ?>">
          <div class="card-footer mt-4" style="padding: 20px;">
              <button class="btn btn-primary" type="submit">Download</button>
          </div>
        </form>
      </div>
    </div>
    <div class="col-sm-12 col-md-6">
      <div class="card card-absolute">
        <div class="card-header bg-primary">
          <h5 class="text-white">IKU 7 DATA MATAKULIAH</h5>
        </div>
        <form class="form theme-form" method="post" action="<?= base_url('admin/report/iku_7_matakuliah') ?>">
          <div class="card-footer mt-4" style="padding: 20px;">
              <button class="btn btn-primary" type="submit">Download</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Container-fluid Ends-->
</div>