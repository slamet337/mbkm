<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-6">
        <h3>Report Alumni</h3>
      </div>
      <div class="col-6">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url('home'); ?>"><i data-feather="home"></i></a></li>
          <li class="breadcrumb-item active">Report Alumni</li>
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
        <h5>Report Alumni</h5>
      </div>
      <div class="card-body">
        <form class="form theme-form" method="post" action="<?= base_url('admin/report/cetak_alumni_all') ?>">
          <div class="mb-3 row">
            <label class="col-md-4 form-label">Download Semua Alumni</label>
            <div class="col-md-3">
              <button class="btn btn-primary" type="submit">Submit</button>
            </div>
          </div>
        </form>
        <br>
        <form class="form theme-form" method="post" action="<?= base_url('admin/report/cetak_alumni_prodi') ?>">
          <div class="mb-3 row">
            <label class="col-md-12 form-label"><b>Download Data Alumni berdasarkan prodi : </b></label>
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
            <div class="col-md-3">
              <button class="btn btn-primary" type="submit">Submit</button>
            </div>
          </div>
        </form>
        <form class="form theme-form" method="post" action="<?= base_url('admin/report/cetak_alumni_tahun') ?>">
          <div class="mb-3 row">
            <div class="col-md-5">
              <label class="col-md-12 mt-1 form-label"><b>Download Data Alumni berdasarkan Tahun Lulus: </b></label>
            </div>
            <div class="col-md-4">
              <input type="text" class="form-control" name='tahun_lulus' placeholder="Tahun Lulus">
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