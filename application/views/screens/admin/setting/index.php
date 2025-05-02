<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-6">
        <h3>Setting</h3>
      </div>
      <div class="col-6">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url('admin/menu'); ?>"><i data-feather="home"></i></a></li>
          <li class="breadcrumb-item active">Setting</li>
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
        <h5>Setting</span>
      </div>
      <div class="card-body">
        <form class="form theme-form" method="post" action="<?= base_url('admin/setting/setting'); ?>">
          <?php
            $CI =& get_instance();
            if (validation_errors()) {
          ?>
            <div class="alert alert-danger dark alert-dismissible fade show m-20 m-b-0" role="alert">
              <i data-feather="alert-triangle"></i>
              <p><?= validation_errors(); ?></p>
              <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <?php
            } elseif (isset($error)) {
          ?>
            <div class="alert alert-danger dark alert-dismissible fade show m-20 m-b-0" role="alert">
              <i data-feather="alert-triangle"></i>
              <p><?= $error; ?></p>
              <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <?php
            }
          ?>
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3 mt-3">
                <label class="form-label">Password Lama</label>
                <input class="form-control" type="password" name="old_password" placeholder="Password Lama">
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3 mt-3">
                <label class="form-label">Password Baru</label>
                <input class="form-control" type="password" name="new_password" placeholder="Password Baru">
              </div>
            </div>
          </div>
          <button class="btn btn-primary" type="submit">Perbarui Data</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Container-fluid Ends-->
</div>