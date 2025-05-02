<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-6">
        <h3>Report Nilai</h3>
      </div>
      <div class="col-6">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url('home'); ?>"><i data-feather="home"></i></a></li>
          <li class="breadcrumb-item active">Report Nilai</li>
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
        <h5>Report Nilai</h5>
      </div>
      <div class="card-body">
        <form class="form theme-form" method="post" action="<?= base_url('admin/report/cetak_nilai') ?>">
          <div class="mb-3 row">
            <label class="col-md-12 form-label"><b>Download Nilai Mahasiswa : </b></label>
          </div>
          <div class="mb-3 row">
            <div class="col-md-6">
              <select name="id_pendaftaran" class="form-select js-example-basic-single">
                <option value="">- Pilih Mahasiswa - </option>
                <?php
                  foreach ($pendaftar as $show) {
                    echo "<option value='".$show->id."'>(".$show->nim." - ".$show->nama.") ".$show->nama_kegiatan." semester ".$show->semester."</option>";
                  }
                ?>
              </select>
            </div>
            <div class="col-md-3">
              <button class="btn btn-primary" type="submit">Submit</button>
            </div>
          </div>
        </form>
        <form class="form theme-form" method="post" action="<?= base_url('admin/report/cetak_nilai_all') ?>">
          <div class="mb-3 row">
            <div class="col-md-4">
              <label class="col-md-12 mt-1 form-label"><b>Download Nilai Semua Kegiatan: </b></label>
            </div>
            <div class="col-md-3">
              <button class="btn btn-primary" type="submit">Submit</button>
            </div>
          </div>
        </form>
        <form class="form theme-form" method="post" action="<?= base_url('admin/report/cetak_nilai_semester') ?>">
          <div class="mb-3 row">
            <div class="col-md-5">
              <label class="col-md-12 mt-1 form-label"><b>Download Nilai berdasarkan Semester: </b></label>
            </div>
            <div class="col-md-4">
              <input type="text" class="form-control" name='semester' placeholder="Semester">
            </div>
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