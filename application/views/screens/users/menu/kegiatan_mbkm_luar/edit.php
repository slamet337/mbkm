<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-6">
        <h5>Kegiatan Mahasiswa</h3>
      </div>
      <div class="col-6">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url('home'); ?>"><i data-feather="home"></i></a></li>
          <li class="breadcrumb-item"><a href="<?= base_url('kegiatan_mbkm_luar'); ?>"><i data-feather="user"></i></a></li>
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
        <h5>Edit Riwayat Kegiatan Mahasiswa</h5>
      </div>
      <form class="form theme-form" method="post" action="<?= base_url('kegiatan_mbkm_luar/update/'.$kegiatan->id) ?>">
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
                <label class="form-label">Jenis MBKM</label>
                <select name="jenis_mbkm" class="form-select js-example-basic-single">
                  <option label="">- Pilih Jenis MBKM -</option>
                  <option value="Kementerian" <?php if ($kegiatan->jenis_mbkm == "Kementrian") {echo "selected";} ?>>Kementerian</option>
                  <option value="Universitas" <?php if ($kegiatan->jenis_mbkm == "Universitas") {echo "selected";} ?>>Universitas</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Program MBKM</label>
                <select name="id_program_mbkm" class="form-select js-example-basic-single" id='id_program_mbkm'>
                  <option label="" value="">- Pilih Program MBKM -</option>
                  <?php
                    foreach ($mbkm->result() as $show) {
                      $selected = "";
                      if($kegiatan->id_program_mbkm == $show->id) {
                        $selected = "selected";
                      }
                      echo "<option value='".$show->id."' ".$selected.">".$show->nama_program."</option>";
                    }
                  ?>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Nama Kegiatan</label>
                <input class="form-control" type="text" name="nama_kegiatan" placeholder="Nama Kegiatan" value="<?= $kegiatan->nama_kegiatan ?>">
              </div>
            </div>
            <div class="col-md-3">
              <div class="mb-3">
                <label class="form-label">Dosen Pembimbing</label>
                <select name="id_dosen" class="form-select js-example-basic-single">
                  <option label="">- Pilih Dosen Pembimbing -</option>
                  <?php
                    foreach ($dosen->result() as $show) {
                      $selected = "";
                      if($kegiatan->id_dosen == $show->id) {
                        $selected = "selected";
                      }
                      echo "<option value='".$show->id."' ".$selected.">".$show->nama."</option>";
                    }
                  ?>
                </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="mb-3">
                <label class="form-label">Dosen Pembimbing</label>
                <input class="form-control" type="text" name="dosen_lainnya" placeholder="Nama Dosen" value="<?= $kegiatan->dosen_lainnya ?>">
                <i>(Jika tidak ada di pilihan)</i>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Semester</label>
                <input class="form-control" type="number" name="semester" placeholder="Semester" value="<?= $kegiatan->semester ?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Penyelenggara Kegiatan</label>
                <input class="form-control" type="text" name="penyelenggara_mbkm" placeholder="Penyelenggara Kegiatan" value="<?= $kegiatan->penyelenggara_mbkm ?>">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Nama Mentor</label>
                <input class="form-control" type="text" name="nama_mentor" placeholder="Nama Mentor" value="<?= $kegiatan->nama_mentor ?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Lokasi Pelaksanaan MBKM</label>
                <input class="form-control" type="text" name="lokasi_kegiatan" placeholder="Lokasi Pelaksanaan MBKM" value="<?= $kegiatan->lokasi_kegiatan ?>">
              </div>
            </div>
          </div>
          <div class="row mt-3">
            <h5>Matakuliah Konversi</h5>
            <?php
              foreach ($matakuliah_lain as $show) {
            ?>
            <div class="row mb-3">
              <div class="col-md-6">
                <select name="kode_mk_<?= $show->id; ?>" class="form-select js-example-basic-single">
                  <option label="">- Pilih Matakuliah -</option>
                  <?php
                    if(isset($matakuliah)) {
                      foreach ($matakuliah->result() as $show_mk) {
                        $selected = "";
                        if($show->kd_mk == $show_mk->kd_mk) {
                          $selected = "selected";  
                        }
                        echo "<option value='".$show_mk->kd_mk."' ".$selected.">".$show_mk->matakuliah." - (".$show_mk->sks." SKS)</option>";
                      }
                    }
                  ?>
                </select>
              </div>
            </div>
            <?php
              }
            ?>
          </div>
        </div>
        <div class="card-footer">
          <button class="btn btn-primary" type="submit">Submit</button>
          <a href="<?= base_url('kegiatan_mbkm_luar') ?>" class="btn btn-light" >Cancel</a>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Container-fluid Ends-->
</div>