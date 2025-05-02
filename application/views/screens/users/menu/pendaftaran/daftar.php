<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-6">
        <h3>Pendaftaran</h3>
      </div>
      <div class="col-6">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url('menu'); ?>"><i data-feather="home"></i></a></li>
          <li class="breadcrumb-item active">Pendaftaran</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<!-- Container-fluid starts-->
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <?php
          if($kegiatan->num_rows() == 0) {
        ?>
          <h4 style="text-align: center; color: #d92916; height: 400px; padding-top: 180px;">Belum Terdapat Mitra pada Program MBKM ini</h4>
        <?php
          }else{
        ?>
          <form class="form theme-form" method="post" action="<?= base_url('pendaftaran/post') ?>" enctype="multipart/form-data">
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
            <?php
              if (isset($error)) {
            ?>
              <div class="alert alert-danger dark alert-dismissible fade show m-20 m-b-0" role="alert">
                <i data-feather="alert-triangle"></i>
                <p><?php print_r($error); ?></p>
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            <?php
              } 
            ?>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label">Kegiatan MBKM</label>
                  <select name="id_kegiatan" class="form-select js-example-basic-single" onchange="kegiatan_mbkm(this.value)">
                    <option label="">- Pilih Kegiatan -</option>
                    <?php
                      foreach ($kegiatan->result() as $show) {
                        echo "<option value='".$show->id."'>(".$show->nama_mitra.") ".$show->nama_kegiatan." </option>";
                      }
                    ?>
                  </select>
                  <input type="hidden" name="id" id="id_kegiatan">
                  <input type="hidden" name="id_mbkm" id="id_mbkm" value="<?= $id ?>">
                </div>
              </div>
              <?php
                if($id == 1) {
              ?>
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label class="form-label">Semester Akademik</label>
                      <input class="form-control" type="number" name="semester" placeholder="Contoh : 20211 (untuk tahun 2021 semester ganjil)" onchange="show_mk(this.value)">
                    </div>
                  </div>
                  <div id="output_persyaratan"></div>
                  <div id="output_mk_pertukaran">
                    
                  </div>
              <?php
                } else {
              ?>
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label class="form-label">Semester Akademik</label>
                      <input class="form-control" type="number" name="semester" placeholder="Contoh : 20211 (untuk tahun 2021 semester ganjil)">
                    </div>
                  </div>
                  <div id="output_matakuliah"></div>
                  <div id="output_persyaratan"></div>
              <?php
                }
              ?>
            </div>
          </div>
          <div id="submit_syarat"></div>
          </form>
        <?php
          }
        ?>
      </div>
    </div>
  </div>
</div>
<!-- Container-fluid Ends-->
</div>