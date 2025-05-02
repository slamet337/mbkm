<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-6">
        <h3>Mentor</h3>
      </div>
      <div class="col-6">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url('home'); ?>"><i data-feather="home"></i></a></li>
          <li class="breadcrumb-item"><a href="<?= base_url('admin/mentor'); ?>"><i data-feather="users"></i></a></li>
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
        <h5>Edit Mentor</h5>
      </div>
      <form class="form theme-form" method="post" action="<?= base_url('admin/mentor/update/'.$mentor->id) ?>">
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
                <label class="form-label">Nama Mentor</label>
                <input class="form-control" type="text" name="nama" placeholder="Nama Lengkap" value="<?= $mentor->nama; ?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Nomor HP</label>
                <input class="form-control" type="number" name="phone_number" placeholder="Nomor HP" value="<?= $mentor->phone_number; ?>">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Email</label>
                <input class="form-control" type="email" name="email" placeholder="Email" value="<?= $mentor->email; ?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Jabatan</label>
                <input class="form-control" type="text" name="jabatan" placeholder="Jabatan" value="<?= $mentor->jabatan; ?>">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Pendidikan Terakhir</label>
                <input class="form-control" type="text" name="pendidikan_terakhir" placeholder="Pendidikan Terakhir" value="<?= $mentor->pendidikan_terakhir; ?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Sertifikasi/Keahlian</label>
                <input class="form-control" type="text" name="sertifikasi_keahlian" placeholder="Sertifikasi/Keahlian" value="<?= $mentor->sertifikasi_keahlian; ?>">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Jenis Personil</label>
                <select name="jenis_personil" class="form-select">
                  <option value="">- Pilih Jenis Personil - </option>
                  <option value="Mentor" <?php if($mentor->jenis_personil == "Mentor") { echo 'selected'; } ?>>Mentor</option>
                  <option value="Dosen Penanggung Jawab" <?php if($mentor->jenis_personil == "Dosen Penanggung Jawab") { echo 'selected'; } ?>>Dosen Penanggung Jawab</option>
                  <option value="Dosen Praktisi" <?php if($mentor->jenis_personil == "Dosen Praktisi") { echo 'selected'; } ?>>Dosen Praktisi</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" rows="3" class="form-control" placeholder="Alamat"><?= $mentor->alamat ?></textarea>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <button class="btn btn-primary" type="submit">Submit</button>
          <a href="<?= base_url('admin/mentor') ?>" class="btn btn-light" >Cancel</a>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Container-fluid Ends-->
</div>