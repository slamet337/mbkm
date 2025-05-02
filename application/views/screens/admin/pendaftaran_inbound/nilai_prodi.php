<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-6">
        <h3>Penilaian</h3>
      </div>
      <div class="col-6">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url('home'); ?>"><i data-feather="home"></i></a></li>
          <li class="breadcrumb-item"><a href="<?= base_url('admin/pendaftaran_inbound'); ?>"><i data-feather="users"></i></a></li>
          <li class="breadcrumb-item active">penilaian</li>
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
        <h5>Penilaian</h5>
      </div>
      <form class="form theme-form" method="post" action="<?= base_url('admin/pendaftaran_inbound/update_nilai/'.$pendaftaran->id) ?>">
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
          <?php
            foreach ($matakuliah as $show) {
          ?>
            <div class="mb-3 row">
              <label class="col-md-3 form-label"><?= $show->matakuliah; ?></label>
              <div class="col-md-3">
                  <input class="form-control" type="hidden" name="id_pendaftaran[]" value="<?= $show->id; ?>">
                  <input class="form-control" type="number" name="nilai[]" placeholder="Nilai" onkeyup="convertNilai(this.value, '<?= $show->id ?>', 2016)">
              </div>
              <div class="col-md-3">
                  <input class="form-control" type="text" name="grade[]" readonly placeholder="Grade" id="grade_<?= $show->id; ?>">
              </div>
            </div>

          <?php
            }
          ?>
        </div>
        <div class="card-footer">
          <button class="btn btn-primary" type="submit">Submit</button>
          <a href="<?= base_url('admin/pendaftaran_inbound') ?>" class="btn btn-light" >Cancel</a>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Container-fluid Ends-->
</div>