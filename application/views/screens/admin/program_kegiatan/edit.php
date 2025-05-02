<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-6">
        <h3>Program Kegiatan MBKM</h3>
      </div>
      <div class="col-6">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url('home'); ?>"><i data-feather="home"></i></a></li>
          <li class="breadcrumb-item"><a href="<?= base_url('admin/program_kegiatan'); ?>"><i data-feather="award"></i></a></li>
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
        <h5>Edit Program Kegiatan MBKM</h5>
      </div>
      <form class="form theme-form" method="post" action="<?= base_url('admin/program_kegiatan/update/'.$kegiatan->id) ?>">
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
                <label class="form-label">Program MBKM</label>
                <select name="id_program" class="form-select js-example-basic-single">
                  <option label="">- Pilih Program -</option>
                  <?php
                    foreach ($mbkm as $show) {
                      $selected = "";
                      if($kegiatan->id_program == $show->id) {
                        $selected = "selected";
                      }
                      echo "<option value='".$show->id."' ".$selected.">".$show->nama_program."</option>";
                    }
                  ?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Nama Kegiatan / Jenis Pekerjaan</label>
                <input class="form-control" type="text" name="nama_kegiatan" placeholder="Nama Kegiatan / Jenis Pekerjaan" value="<?= $kegiatan->nama_kegiatan ?>">
              </div>
            </div>
          </div>
          <div class="row">
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
          </div>
          <?php
            if($kegiatan->id_program != 1) {
          ?>
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label">Kuota</label>
                  <input class="form-control" type="number" name="kuota" placeholder="Kuota" value="<?= $kegiatan->kuota ?>">
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label">Job Description</label>
                  <textarea name="job_desc" rows="3" class="form-control" placeholder="Job Description"><?= $kegiatan->job_desc ?></textarea>
                </div>
              </div>
            </div>
          <?php
            }
          ?>
          <?php
            if($kegiatan->id_program == 1) {
              if(isset($matakuliah_pertukaran)) {
          ?>
                <hr />
                <div class="row">
                  <div class="col-md-12">
                    <h3>Matakuliah</h3>
                  </div>
                </div>
          <?php
                foreach ($matakuliah_pertukaran as $show) {
          ?>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-3">
                        <input type="hidden" name="id" value="<?= $show->id ?>">
                        <label class="form-label">Kode Matakuliah</label>
                        <input class="form-control" type="text" name="kode_mk_<?= $show->id ?>" placeholder="Kode Matakuliah" value="<?= $show->kd_mk ?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label class="form-label">Matakuliah</label>
                        <input class="form-control" type="text" name="matakuliah_<?= $show->id ?>" placeholder="Matakuliah" value="<?= $show->matakuliah ?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label class="form-label">SKS</label>
                        <input class="form-control" type="number" name="sks_<?= $show->id ?>" placeholder="SKS" value="<?= $show->sks ?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label class="form-label">Mentor/Dosen</label>
                        <select name="id_mentor_<?= $show->id ?>" class="form-select js-example-basic-single">
                          <option label="">- Pilih Mentor/Dosen -</option>
                          <?php
                            if(isset($mentor)) {
                              foreach ($mentor as $show_mentor) {
                                $selected = "";
                                if($show->id_mentor == $show_mentor->id) {
                                  $selected = "selected";
                                }
                                echo "<option value='".$show_mentor->id."' ".$selected.">".$show_mentor->nama." (".$show_mentor->jabatan.")</option>";
                              }
                            }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                          <label class="form-label">Kuota</label>
                          <input class="form-control" type="number" name="kuota_<?= $show->id ?>" placeholder="Kuota" value="<?= $show->kuota ?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                          <label class="form-label">Sisa Kuota</label>
                          <input class="form-control" type="number" readonly value="<?= $show->sisa_kuota ?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="description_<?= $show->id ?>" rows="3" class="form-control" placeholder="Deskripsi"><?= $show->description ?></textarea>
                      </div>
                    </div>
                  </div>
                  <hr />
          <?php
                }
              }
            }
          ?>
        </div>
        <div class="card-footer">
          <button class="btn btn-primary" type="submit">Submit</button>
          <a href="<?= base_url('admin/program_kegiatan') ?>" class="btn btn-light" >Cancel</a>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Container-fluid Ends-->
</div>