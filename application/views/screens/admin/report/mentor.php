<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-6">
        <h3>Report Mentor</h3>
      </div>
      <div class="col-6">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url('home'); ?>"><i data-feather="home"></i></a></li>
          <li class="breadcrumb-item active">Report Mentor</li>
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
        <h5>Report Mentor</h5>
      </div>
      <div class="card-body">
        <form class="form theme-form" method="post" action="<?= base_url('admin/report/cetak_mentor_all') ?>">
          <div class="mb-3 row">
            <label class="col-md-4 form-label">Download Semua Mentor</label>
            <div class="col-md-3">
              <button class="btn btn-primary" type="submit">Submit</button>
            </div>
          </div>
        </form>
        <br>
        <form class="form theme-form" method="post" action="<?= base_url('admin/report/cetak_mentor_mitra') ?>">
          <div class="mb-3 row">
            <label class="col-md-12 form-label"><b>Download Data Mentor berdasarkan Mitra : </b></label>
          </div>
          <div class="mb-3 row">
            <div class="col-md-4">
              <select name="id_mitra" class="form-select">
                <option value="">- Pilih Mitra - </option>
                <?php
                  foreach ($mitra as $show) {
                    echo "<option value='".$show->id."'>".$show->nama_mitra."</option>";
                  }
                ?>
              </select>
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