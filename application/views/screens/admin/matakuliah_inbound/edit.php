<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-6">
        <h3>Matakuliah Pertukaran Inbound</h3>
      </div>
      <div class="col-6">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url('home'); ?>"><i data-feather="home"></i></a></li>
          <li class="breadcrumb-item"><a href="<?= base_url('admin/matakuliah_inbound'); ?>"><i data-feather="award"></i></a></li>
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
        <h5>Edit Matakuliah Pertukaran Inbound</h5>
      </div>
      <form class="form theme-form" method="post" action="<?= base_url('admin/matakuliah_inbound/update/'.$jadwal->id) ?>">
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
                <label class="form-label">Matakuliah</label>
                <select name="kd_mk" class="form-select js-example-basic-single">
                  <option label="">- Pilih Matakuliah -</option>
                  <?php
                    if(isset($matakuliah)) {
                      foreach ($matakuliah as $show) {
                        $selected = "";
                        if($jadwal->kd_mk == $show->kd_mk) {
                          $selected = "selected";
                        }
                        echo "<option value='".$show->kd_mk."' ".$selected.">".$show->matakuliah." - (".$show->sks." SKS)</option>";
                      }
                    }
                  ?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Jenis Kegiatan</label>
                <select name="status" class="form-select js-example-basic-single">
                  <option label="">- Pilih Jenis Kegiatan -</option>
                  <option value="daring" <?php if($jadwal->status=='daring') { echo 'selected'; } ?>>Daring</option>
                  <option value="luring" <?php if($jadwal->status=='luring') { echo 'selected'; } ?>>Luring</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Tanggal Mulai Pendaftaran</label>
                <div class="input-group">
                  <input class="datepicker-here form-control digits" name="waktu_mulai" type="text" data-language="id" value="<?= $tgl_mulai ?>">
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Tanggal Tutup Pendaftaran</label>
                <div class="input-group">
                  <input class="datepicker-here form-control digits" name="waktu_selesai" type="text" data-language="id" value="<?= $tgl_selesai ?>">
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                  <label class="form-label">Kuota</label>
                  <input class="form-control" type="number" name="kuota" value="<?= $jadwal->kuota ?>" placeholder="Kuota">
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                  <label class="form-label">Kelas</label>
                  <input class="form-control" type="text" name="kelas" value="<?= $jadwal->kelas ?>" placeholder="Kelas">
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Hari</label>
                <select name="hari" class="form-select js-example-basic-single">
                  <option label="">- Pilih Hari -</option>
                  <option value="Senin" <?php if($jadwal->hari=='Senin') { echo 'selected'; } ?>>Senin</option>
                  <option value="Selasa" <?php if($jadwal->hari=='Selasa') { echo 'selected'; } ?>>Selasa</option>
                  <option value="Rabu" <?php if($jadwal->hari=='Rabu') { echo 'selected'; } ?>>Rabu</option>
                  <option value="Kamis" <?php if($jadwal->hari=='Kamis') { echo 'selected'; } ?>>Kamis</option>
                  <option value="Jumat" <?php if($jadwal->hari=='Jumat') { echo 'selected'; } ?>>Jumat</option>
                  <option value="Sabtu" <?php if($jadwal->hari=='Sabtu') { echo 'selected'; } ?>>Sabtu</option>
                  <option value="Minggu" <?php if($jadwal->hari=='Minggu') { echo 'selected'; } ?>>Minggu</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Jam Mulai Matakuliah</label>
                <div class="input-group clockpicker">
                  <input class="form-control" type="text" value="<?= $jadwal->jam_mulai ?>" name="jam_mulai"><span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Jam Selesai Matakuliah</label>
                <div class="input-group clockpicker">
                  <input class="form-control" type="text" value="<?= $jadwal->jam_selesai ?>" name="jam_selesai"><span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                </div>
              </div>
            </div>
            <div class="col-md-6">
							<div class="mb-3">
								<label class="form-label">Deskripsi</label>
								<textarea name="description" rows="3" class="form-control" placeholder="Deskripsi"><?= $jadwal->description ?></textarea>
							</div>
						</div>
          </div>
        </div>
        <div class="card-footer">
          <button class="btn btn-primary" type="submit">Submit</button>
          <a href="<?= base_url('admin/matakuliah_inbound') ?>" class="btn btn-light" >Cancel</a>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Container-fluid Ends-->
</div>