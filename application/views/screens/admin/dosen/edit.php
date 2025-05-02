<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-6">
        <h3>Dosen</h3>
      </div>
      <div class="col-6">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url('home'); ?>"><i data-feather="home"></i></a></li>
          <li class="breadcrumb-item"><a href="<?= base_url('admin/dosen'); ?>"><i data-feather="users"></i></a></li>
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
        <h5>Edit Admin Dosen</h5>
      </div>
      <form class="form theme-form" method="post" action="<?= base_url('admin/dosen/update/'.$dosen->id) ?>">
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
                <input class="form-control" type="hidden" name="old_username" value="<?= $dosen->username; ?>">
                <input class="form-control" type="text" name="username" placeholder="username" value="<?= $dosen->username; ?>">
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
                <input class="form-control" type="text" name="full_name" placeholder="Nama Lengkap" value="<?= $dosen->full_name; ?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">NIP</label>
                <input class="form-control" type="text" name="nip" placeholder="NIP" value="<?= $dosen->nip; ?>">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Nomor HP</label>
                <input class="form-control" type="text" name="phone_number" placeholder="Nomor HP" value="<?= $dosen->phone_number; ?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Email</label>
                <input class="form-control" type="email" name="email" placeholder="Email" value="<?= $dosen->email; ?>">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Prodi</label>
                <select name="kd_prodi" class="form-select">
                  <option value="">- Pilih Prodi - </option>
                  <?php
                    foreach ($prodi as $show) {
                      $selected = "";
                      if($dosen->kd_prodi == $show->kd_prodi) {
                        $selected = "selected";
                      }
                      echo "<option value='".$show->kd_prodi."' ".$selected.">".$show->nama_prodi."</option>";
                    }
                  ?>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" rows="3" class="form-control" placeholder="Alamat"><?= $dosen->alamat; ?></textarea>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <button class="btn btn-primary" type="submit">Submit</button>
          <a href="<?= base_url('admin/dosen') ?>" class="btn btn-light" >Cancel</a>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Container-fluid Ends-->
</div>