<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-6">
        <h3>Users</h3>
      </div>
      <div class="col-6">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url('home'); ?>"><i data-feather="home"></i></a></li>
          <li class="breadcrumb-item"><a href="<?= base_url('users'); ?>"><i data-feather="users"></i></a></li>
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
        <h5>Edit User</h5>
      </div>
      <form class="form theme-form" method="post" action="<?= base_url('users/update/').$user->username; ?>">
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
            <div class="col">
              <div class="mb-3">
                <label class="form-label">Username</label>
                <input class="form-control" type="text" name="username" placeholder="Username" value="<?= $user->username ?>" disabled>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="mb-3">
                <label class="form-label">Password</label>
                <input class="form-control" type="password" name="password" placeholder="Masukkan Password jika ingin dirubah">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input class="form-control" type="text" name="full_name" placeholder="Nama Lengkap" value="<?= $user->full_name ?>" >
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="mb-3">
                <label class="form-label">Nomor HP</label>
                <input class="form-control" type="text" name="phone_number" placeholder="Nomor HP" value="<?= $user->phone_number ?>" >
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="mb-3">
                <label class="form-label">Level</label>
                <select class="form-select" name='level'>
                  <option>- Pilih Level -</option>
                  <?php
                    $level_id = $user->level_id;
                    foreach ($level as $show) {
                      $selected = "";
                      if($level_id==$show->id) {
                        $selected = "selected";
                      }
                      echo "<option value='".$show->id."' ".$selected.">".$show->level."</option>";  
                    }
                  ?>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <button class="btn btn-primary" type="submit">Submit</button>
          <a href="<?= base_url('users') ?>" class="btn btn-light" >Cancel</a>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Container-fluid Ends-->
</div>