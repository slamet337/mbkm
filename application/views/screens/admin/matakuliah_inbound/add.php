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
        <h5>Add Matakuliah Pertukaran Inbound</h5>
      </div>
      <form class="form theme-form" method="post" action="<?= base_url('admin/matakuliah_inbound/post') ?>">
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
                        echo "<option value='".$show->kd_mk."'>".$show->matakuliah." - (".$show->sks." SKS)</option>";
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
                  <option value="daring">Daring</option>
                  <option value="luring">Luring</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Tanggal Mulai Pendaftaran</label>
                <div class="input-group">
                  <input class="datepicker-here form-control digits" name="waktu_mulai" type="text" data-language="id">
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Tanggal Tutup Pendaftaran</label>
                <div class="input-group">
                  <input class="datepicker-here form-control digits" name="waktu_selesai" type="text" data-language="id">
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                  <label class="form-label">Kuota</label>
                  <input class="form-control" type="number" name="kuota" placeholder="Kuota">
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                  <label class="form-label">Kelas</label>
                  <input class="form-control" type="text" name="kelas" placeholder="Kelas">
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Hari</label>
                <select name="hari" class="form-select js-example-basic-single">
                  <option label="">- Pilih Hari -</option>
                  <option value="Senin">Senin</option>
                  <option value="Selasa">Selasa</option>
                  <option value="Rabu">Rabu</option>
                  <option value="Kamis">Kamis</option>
                  <option value="Jumat">Jumat</option>
                  <option value="Sabtu">Sabtu</option>
                  <option value="Minggu">Minggu</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Jam Mulai Matakuliah</label>
                <div class="input-group clockpicker">
                  <input class="form-control" type="text" value="07:30" name="jam_mulai"><span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Jam Selesai Matakuliah</label>
                <div class="input-group clockpicker">
                  <input class="form-control" type="text" value="09:00" name="jam_selesai"><span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                </div>
              </div>
            </div>
            <div class="col-md-6">
							<div class="mb-3">
								<label class="form-label">Deskripsi</label>
								<textarea name="description" rows="3" class="form-control" placeholder="Deskripsi"></textarea>
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