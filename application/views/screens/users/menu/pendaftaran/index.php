<style>
  .vertical-center {
    margin: 0;
    position: absolute;
    top: 50%;
    left: 50%;
    -ms-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
  }
</style>
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
        <div class="card-body">
          <h4 style="text-align: center; color: #d92916;">PROGRAM KEGIATAN</h4>
          <h5 style="text-align: center; color: #e8a531;">MERDEKA BELAJAR KAMPUS MERDEKA</h5>
          <div class="row">
            <?php
              foreach ($mbkm as $show) {
            ?>
              <div class="col-md-3">
                <a href="<?= base_url('pendaftaran/mbkm/'.$show->id); ?>">
                  <div class="shadow shadow-showcase text-center" style="height: 150px; margin-top: 20px;">
                    <div class="vertical-center">
                      <h5 class="m-0 f-14"><?= $show->nama_program; ?></h5>
                    </div>
                  </div>
                </a>
              </div>
            <?php
              }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Container-fluid Ends-->
</div>