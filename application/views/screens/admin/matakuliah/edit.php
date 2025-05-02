<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-6">
        <h3>Matakuliah</h3>
      </div>
      <div class="col-6">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url('home'); ?>"><i data-feather="home"></i></a></li>
          <li class="breadcrumb-item"><a href="<?= base_url('admin/matakuliah'); ?>"><i data-feather="repeat"></i></a></li>
          <li class="breadcrumb-item active">Edit</li>
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
        <h5>Edit Matakuliah</h5>
      </div>
      <form class="form theme-form" method="post" action="<?= base_url('admin/matakuliah/update/'.$matakuliah->kd_mk) ?>">
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
                <label class="form-label">Kode Matakuliah (Sesuai Siakad)</label>
                <input class="form-control" type="text" name="kd_mk" placeholder="Kode Matakuliah" value="<?= $matakuliah->kd_mk; ?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Nama Matakuliah</label>
                <input class="form-control" type="text" name="matakuliah" placeholder="Nama Matakuliah" value="<?= $matakuliah->matakuliah; ?>">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="mb-3">
                <label class="form-label">SKS</label>
                <input class="form-control" type="number" name="sks" placeholder="SKS" value="<?= $matakuliah->sks; ?>">
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <button class="btn btn-primary" type="submit">Submit</button>
          <a href="<?= base_url('admin/matakuliah') ?>" class="btn btn-light" >Cancel</a>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Container-fluid Ends-->
</div>