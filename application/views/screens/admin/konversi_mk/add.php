<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-6">
        <h3>Konversi Matakuliah</h3>
      </div>
      <div class="col-6">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url('home'); ?>"><i data-feather="home"></i></a></li>
          <li class="breadcrumb-item"><a href="<?= base_url('admin/konversi_mk'); ?>"><i data-feather="repeat"></i></a></li>
          <li class="breadcrumb-item active">Add</li>
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
        <h5>Add Matakuliah</h5>
      </div>
      <form class="form theme-form" method="post" action="<?= base_url('admin/konversi_mk/post') ?>">
          <?php
						if (validation_errors()) {
					?>
            <div class="alert alert-danger dark alert-dismissible fade show m-20 m-b-0" role="alert">
              <i data-feather="alert-triangle"></i>
              <p><?= validation_errors(); ?></p>
							<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
					<?php
						}
					?>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Kegiatan MBKM</label>
                <select name="id_program_kegiatan" class="form-select js-example-basic-single">
                  <option label="">- Pilih Kegiatan -</option>
                  <?php
                    foreach ($kegiatan as $show) {
                      echo "<option value='".$show->id."'>(".$show->nama_mitra.") ".$show->nama_kegiatan." </option>";
                    }
                  ?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Kode Matakuliah (Sesuai Siakad)</label>
                <select name="kd_mk" class="form-select js-example-basic-single">
                  <option label="">- Pilih Matakuliah -</option>
                  <?php
                    foreach ($matakuliah as $show) {
                      echo "<option value='".$show->kd_mk."'>(".$show->kd_mk.") ".$show->matakuliah." </option>";
                    }
                  ?>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <button class="btn btn-primary" type="submit">Submit</button>
          <a href="<?= base_url('admin/konversi_mk') ?>" class="btn btn-light" >Cancel</a>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Container-fluid Ends-->
</div>