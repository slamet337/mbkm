<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-6">
        <h3>Profil</h3>
      </div>
      <div class="col-6">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url('menu'); ?>"><i data-feather="home"></i></a></li>
          <li class="breadcrumb-item active">Profil</li>
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
        <h5>Profil Mahasiswa Inbound</span>
      </div>
      <div class="card-body">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item"><a class="nav-link  <?php if($tab == "biodata") {echo "active";} ?>" id="biodata-tab" data-bs-toggle="tab" href="#biodata" role="tab" aria-controls="biodata" aria-selected="true">Biodata</a></li>
          <li class="nav-item"><a class="nav-link  <?php if($tab == "setting") {echo "active";} ?>" id="setting-tab" data-bs-toggle="tab" href="#setting" role="tab" aria-controls="setting" aria-selected="false">Setting</a></li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade <?php if($tab == "biodata") {echo "show active";} ?>" id="biodata" role="tabpanel" aria-labelledby="biodata-tab">
            <h5 class="mb-4 mt-4" style="text-align:center">Biodata Mahasiswa Inbound</h5>
            <form class="form theme-form" method="post" action="<?= base_url('profil_inbound/update/').$profil->id; ?>">
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
                }
              ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3 mt-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input class="form-control" type="text" name="nama" placeholder="Nama Lengkap" value="<?= $profil->nama ?>" >
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3 mt-3">
                    <label class="form-label">Nomor Induk Kependudukan</label>
                    <input class="form-control" type="text" name="nik" placeholder="Nomor Induk Kependudukan" value="<?= $profil->nik ?>" >
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Nomor Stambuk Asal</label>
                    <input class="form-control" type="text" name="stambuk_asal" placeholder="Stambuk Asal" value="<?= $profil->stambuk_asal ?>" >
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Nomor HP</label>
                    <input class="form-control" type="text" name="no_hp" placeholder="Nomor HP" value="<?= $profil->no_hp ?>" >
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Universitas Asal</label>
                    <input type="text" class="form-control" require name="universitas_asal" value="<?= $profil->universitas_asal ?>" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Fakultas Asal</label>
                    <input type="text" class="form-control" require name="fakultas_asal" value="<?= $profil->fakultas_asal ?>" />
                  </div>
                </div>
              </div>
              <div class="row">              
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Prodi Asal</label>
                    <input type="text" class="form-control" require name="prodi_asal" value="<?= $profil->prodi_asal ?>" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Status Pernikahan</label>
                    <select name="status_pernikahan" class="form-select">
                      <option label=""  value=''>- Pilih Status Pernikahan -</option>
                      <option value='Belum Menikah' <?php if($profil->status_pernikahan == 'Belum Menikah') { echo "selected"; } ?>>Belum Menikah</option>
                      <option value='Sudah Menikah' <?php if($profil->status_pernikahan == 'Sudah Menikah') { echo "selected"; } ?>>Sudah Menikah</option>
                      <option value='Cerai' <?php if($profil->status_pernikahan == 'Cerai') { echo "selected"; } ?>>Cerai</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Tempat Lahir</label>
                    <input class="form-control" type="text" name="tempat_lahir" placeholder="Tempat Lahir" value="<?= $profil->tempat_lahir ?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Tanggal Lahir</label>
                    <div class="input-group">
                      <input class="datepicker-here form-control digits" name="tanggal_lahir" type="text" data-language="id" value="<?php if ($profil->tanggal_lahir == NULL || $profil->tanggal_lahir == '' || $profil->tanggal_lahir == '0000-00-00') { echo '';} else { echo $CI->tgl_indo_1($profil->tanggal_lahir);}?>">
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-select">
                      <option label="">- Pilih Jenis Kelamin -</option>
                      <option value='L' <?php if($profil->jenis_kelamin == 'L') { echo "selected"; } ?>>Laki-laki</option>
                      <option value='P' <?php if($profil->jenis_kelamin == 'P') { echo "selected"; } ?>>Perempuan</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Agama</label>
                    <select name="agama" class="form-select">
                      <option label="" value=''>- Pilih Agama -</option>
                      <option value='Islam'  <?php if($profil->agama == 'Islam') { echo "selected"; } ?>>Islam</option>
                      <option value='Protestan'  <?php if($profil->agama == 'Protestan') { echo "selected"; } ?>>Protestan</option>
                      <option value='Katolik'  <?php if($profil->agama == 'Katolik') { echo "selected"; } ?>>Katolik</option>
                      <option value='Hindu'  <?php if($profil->agama == 'Hindu') { echo "selected"; } ?>>Hindu</option>
                      <option value='Buddha'  <?php if($profil->agama == 'Buddha') { echo "selected"; } ?>>Buddha</option>
                      <option value='Khonghucu'  <?php if($profil->agama == 'Khonghucu') { echo "selected"; } ?>>Khonghucu</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Email (Email tidak dapat dirubah)</label>
                    <input class="form-control" type="email" name="email" placeholder="Email" value="<?= $profil->email ?>" disabled style="background-color: #ededed">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" rows="5" class="form-control" style="color: #898989;"><?= $profil->alamat ?></textarea>
                  </div>
                </div>
              </div>
              <button class="btn btn-primary" type="submit">Perbarui Data</button>
            </form>
          </div>
          <div class="tab-pane fade <?php if($tab == "setting") {echo "show active";} ?>" id="setting" role="tabpanel" aria-labelledby="biodata-tab">
            <h5 class="mb-4 mt-4" style="text-align:center">Setting</h5>
            <form class="form theme-form" method="post" action="<?= base_url('profil_inbound/setting/').$profil->id; ?>">
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
  </div>
</div>
<!-- Container-fluid Ends-->
</div>