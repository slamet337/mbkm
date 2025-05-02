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
          if($jadwal->num_rows() == 0) {
        ?>
          <h4 style="text-align: center; color: #d92916; height: 400px; padding-top: 180px;">Belum Terdapat Mitra pada Program MBKM ini</h4>
        <?php
          }else{
        ?>
          <form class="form theme-form" method="post" action="<?= base_url('pendaftaran_inbound/post/'.$id) ?>" enctype="multipart/form-data">
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
                  <label class="form-label">Semester Akademik</label>
                  <input class="form-control" type="number" name="semester" placeholder="Contoh : 20211 (untuk tahun 2021 semester ganjil)" onchange="show_mk_inbound(this.value)">
                </div>
              </div>
              <div id="output_persyaratan">
                <div style="margin-top: 20px;">Peryaratan (Ukuran file masing-masing tidak boleh melebihi 500 KB, format file harus jpg, jpeg atau png) : </div>
                <div class="row" style="margin-top: 10px;">
                  <div class="col">
                    <div class="mb-3">
                      <label class="form-label">Scan Transkip Nilai</label>
                      <input class="form-control" type="file" name="transkip_nilai">
                    </div>
                  </div>
                </div>
                <div class="row" style="margin-top: 10px;">
                  <div class="col">
                    <div class="mb-3">
                      <label class="form-label">Scan Surat Permohonan</label>
                      <input class="form-control" type="file" name="surat_permohonan">
                    </div>
                  </div>
                </div>
              </div>
              <div id="output_mk_inbound">
                
              </div>
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