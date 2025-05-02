<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-6">
        <h3>Report Pendaftar MBKM</h3>
      </div>
      <div class="col-6">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url('home'); ?>"><i data-feather="home"></i></a></li>
          <li class="breadcrumb-item active">Report Pendaftar MBKM</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<!-- Container-fluid starts-->
<div class="container-fluid">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-header">
        <h5>Report Pendaftar MBKM</h5>
      </div>
      <div class="card-body">
        <form class="form theme-form" method="post" action="<?= base_url('admin/report/cetak_pendaftar_all') ?>">
          <div class="mb-12 row">
            <label class="col-md-5 form-label">Download Semua Pendaftar MBKM Fakultas</label>
            <div class="col-md-3">
              <button class="btn btn-primary" type="submit">Submit</button>
            </div>
          </div>
        </form>
        <br>
        <form class="form theme-form" method="post" action="<?= base_url('admin/report/cetak_pendaftar_prodi') ?>">
          <div class="mb-3 row">
            <label class="col-md-12 form-label"><b>Download Data Pendaftar MBKM Fakultas berdasarkan prodi : </b></label>
          </div>
          <div class="mb-3 row">
            <div class="col-md-4">
              <select name="kd_prodi" class="form-select">
                <option value="">- Pilih Prodi - </option>
                <?php
                  foreach ($prodi as $show) {
                    echo "<option value='".$show->kd_prodi."'>".$show->nama_prodi."</option>";
                  }
                ?>
              </select>
            </div>
            <div class="col-md-4">
              <select name="st_daftar" class="form-select">
                <option value="">- Pilih Status Pendaftaran - </option>
                <option value="On Process">On Process</option>
                <option value="Diterima">Diterima</option>
                <option value="Ditolak">Ditolak</option>
              </select>
            </div>
            <div class="col-md-4">
              <select name="st_kegiatan" class="form-select">
                <option value="">- Pilih Status Kegiatan - </option>
                <option value="Selesai">Selesai</option>
                <option value="Belum Aktif">Belum Aktif</option>
                <option value="Aktif">Aktif</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <button class="btn btn-primary" type="submit">Submit</button>
            </div>
          </div>
        </form>
        <br>
        <form class="form theme-form" method="post" action="<?= base_url('admin/report/cetak_pendaftar_univ_all') ?>">
          <div class="mb-12 row">
            <label class="col-md-7 form-label">Download Semua Pendaftar MBKM Universitas dan Kementrian</label>
            <div class="col-md-3">
              <button class="btn btn-primary" type="submit">Submit</button>
            </div>
          </div>
        </form>
        <br>
        <form class="form theme-form" method="post" action="<?= base_url('admin/report/cetak_pendaftar_univ_prodi') ?>">
          <div class="mb-3 row">
            <label class="col-md-12 form-label"><b>Download Data Pendaftar MBKM Universitas dan Kementrian berdasarkan prodi : </b></label>
          </div>
          <div class="mb-3 row">
            <div class="col-md-4">
              <select name="kd_prodi" class="form-select">
                <option value="">- Pilih Prodi - </option>
                <?php
                  foreach ($prodi as $show) {
                    echo "<option value='".$show->kd_prodi."'>".$show->nama_prodi."</option>";
                  }
                ?>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <button class="btn btn-primary" type="submit">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Container-fluid Ends-->
</div>