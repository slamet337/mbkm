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
        <h5>Add Riwayat Kegiatan Mahasiswa</h5>
      </div>
      <form class="form theme-form" method="post" action="<?= base_url('kegiatan_mbkm_luar/post') ?>">
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
                  <option value="Kementerian">Kementerian</option>
                  <option value="Universitas">Universitas</option>
                </select>
              </div>
            </div>
            <!-- <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Jenis Kegiatan</label>
                <select name="jenis_kegiatan" class="form-select js-example-basic-single">
                  <option label="">- Pilih Jenis Kegiatan -</option>
                  <option value="National">National</option>
                  <option value="International">International</option>
                  <option value="Provinsi">Provinsi</option>
                </select>
              </div>
            </div> -->
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Program MBKM</label>
                <select name="id_program_mbkm" class="form-select js-example-basic-single" id='id_program_mbkm'>
                  <option label="" value="">- Pilih Program MBKM -</option>
                  <?php
                    foreach ($mbkm->result() as $show) {
                      echo "<option value='".$show->id."'>".$show->nama_program."</option>";
                    }
                  ?>
                </select>
              </div>
            </div>
            <!-- <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Jumlah Negara</label>
                <select name="juml_negara" class="form-select js-example-basic-single">
                  <option label="">- Pilih Jenis Negara -</option>
                  <option value="< 10 Negara"> < 10 Negara </option>
                  <option value=">= 10 negara"> >= 10 Negara </option>
                   <option value="Provinsi">Provinsi</option> 
                </select>
              </div> -->
            <!-- <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Jumlah PT</label>
                <select name="juml_pt" class="form-select js-example-basic-single">
                  <option label="">- Pilih Jenis PT -</option>
                  <option value="< 10 PT"> < 10 PT </option>
                  <option value=">= 10 PT"> >= 10 PT </option> -->
                  <!-- <option value="Provinsi">Provinsi</option> -->
                <!-- </select>
              </div> -->
          <!-- </div>
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Nama Kegiatan</label>
                <input class="form-control" type="text" name="nama_kegiatan" placeholder="Nama Kegiatan">
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Model Pelaksana</label>
                <select name="model_pelaksana" class="form-select js-example-basic-single">
                  <option label="">- Pilih Model Pelaksana -</option>
                  <option value="Daring"> Daring </option>
                  <option value="Luring"> Luring </option> -->
                  <!-- <option value="Provinsi">Provinsi</option> -->
                <!-- </select>
              </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Jenis Peserta</label>
                <select name="jenis_peserta" class="form-select js-example-basic-single">
                  <option label="">- Pilih Jenis Peserta -</option>
                  <option value="Individu">Individu</option>
                  <option value="Kelompok">Kelompok</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Peringkat</label>
                <input class="form-control" type="text" name="peringkat" placeholder="Peringkat">
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Nomor Sertifikat</label>
                <input class="form-control" type="text" name="nomor_serti" placeholder="Nomor Sertifikat">
              </div>
            </div> -->
            <div class="col-md-3">
              <div class="mb-3">
                <label class="form-label">Dosen Pembimbing</label>
                <select name="id_dosen" class="form-select js-example-basic-single">
                  <option label="">- Pilih Dosen Pembimbing -</option>
                  <?php
                    foreach ($dosen->result() as $show) {
                      echo "<option value='".$show->id."'>".$show->nama."</option>";
                    }
                  ?>
                </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="mb-3">
                <label class="form-label">Dosen Pembimbing</label>
                <input class="form-control" type="text" name="dosen_lainnya" placeholder="Nama Dosen">
                <i>(Jika tidak ada di pilihan)</i>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Semester</label>
                <input class="form-control" type="number" name="semester" placeholder="Semester">
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Penyelenggara Kegiatan</label>
                <input class="form-control" type="text" name="penyelenggara_mbkm" placeholder="Penyelenggara Kegiatan">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Nama Mentor</label>
                <input class="form-control" type="text" name="nama_mentor" placeholder="Nama Mentor">
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Lokasi Pelaksanaan MBKM</label>
                <input class="form-control" type="text" name="lokasi_kegiatan" placeholder="Lokasi Pelaksanaan MBKM">
              </div>
            </div>
          </div>

          <!-- <div class="row">
            <h5>Upload Berkas</h5>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Upload Sertifikat</label>
                  <div class="form-group">
                    <label for="sertifikat">Sertifikat</label>
                    <input type="file" name="sertifikat" class="form-control" accept=".pdf">
                  </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label">Foto</label>
                    <div class="form-group"accept=".pdf">
                      <input type="file" name="foto" class="form-control" accept=".jpeg,.png,.jpg">
                    </div>
                </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label">Surat Tugas</label>
                    <input type="file" name="surat_tugas" class="form-control" accept=".pdf">
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label">Link</label>
                    <input type="file" name="link" class="form-control" accept=".jpeg,.png,.jpg">
                </div>
              </div>
            </div>             -->
          <div class="row mt-3">
            <h5>Matakuliah Konversi</h5>
            <div class="col-md-6">
              <select name="kode_mk[]" class="form-select js-example-basic-single">
                <option label="">- Pilih Matakuliah -</option>
                <?php
                  if(isset($matakuliah)) {
                    foreach ($matakuliah->result() as $show) {
                      echo "<option value='".$show->kd_mk."'>".$show->matakuliah." - (".$show->sks." SKS)</option>";
                    }
                  }
                ?>
              </select>
            </div>
          </div>
          <div class='mt-3'>
            <a href="javascript:void(0)" class="btn btn-primary" onclick="add_mk_lain()">Tambah</a>
          </div>
          <div id="mk_kegiatan_lain"></div>
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