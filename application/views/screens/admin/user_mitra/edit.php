<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-6">
        <h3>Mitra</h3>
      </div>
      <div class="col-6">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url('home'); ?>"><i data-feather="home"></i></a></li>
          <li class="breadcrumb-item"><a href="<?= base_url('admin/user_mitra'); ?>"><i data-feather="users"></i></a></li>
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
        <h5>Edit Admin Mitra</h5>
      </div>
      <form class="form theme-form" method="post" action="<?= base_url('admin/user_mitra/update/'.$user_mitra->username) ?>">
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
                <label class="form-label">Username</label>
                <input class="form-control" type="text" name="username" placeholder="username" value="<?= $user_mitra->username ?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Password (Masukkan jika ingin merubah password)</label>
                <input class="form-control" type="password" name="password" placeholder="Password">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input class="form-control" type="text" name="full_name" placeholder="Nama Lengkap" value="<?= $user_mitra->full_name ?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Nomor HP</label>
                <input class="form-control" type="text" name="phone_number" placeholder="Nomor HP" value="<?= $user_mitra->phone_number ?>">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Mitra</label>
                <select name="id_mitra" class="form-select js-example-basic-single">
                  <option label="">- Pilih mitra -</option>
                  <?php
                    foreach ($mitra as $show) {
                      $selected = "";
                      if($user_mitra->id_mitra == $show->id) {
                        $selected = "selected";
                      }
                      echo "<option value='".$show->id."' ".$selected.">".$show->nama_mitra."</option>";
                    }
                  ?>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <button class="btn btn-primary" type="submit">Submit</button>
          <a href="<?= base_url('admin/user_mitra') ?>" class="btn btn-light" >Cancel</a>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Container-fluid Ends-->
</div>