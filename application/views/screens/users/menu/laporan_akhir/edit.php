<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-6">
        <h3>Laporan Akhir</h3>
      </div>
      <div class="col-6">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url('home'); ?>"><i data-feather="home"></i></a></li>
          <li class="breadcrumb-item"><a href="<?= base_url('laporan_akhir'); ?>"><i data-feather="clipboard"></i></a></li>
          <li class="breadcrumb-item active">Laporan Akhir</li>
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
        <h5>Laporan Akhir</h5>
      </div>
      <form class="form theme-form" method="post" action="<?= base_url('laporan_akhir/update/'.$laporan_akhir->id) ?>" enctype="multipart/form-data">
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
            <div class="col-md-12">
              <div class="mb-3">
                <label class="form-label">File Laporan Tugas Akhir (File Size Max 1 Mb, Ext: doc, docx atau Pdf)</label>
                <input class="form-control" type="file" name="file_laporan_akhir">
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <button class="btn btn-primary" type="submit">Submit</button>
          <a href="<?= base_url('laporan_akhir') ?>" class="btn btn-light" >Cancel</a>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Container-fluid Ends-->
</div>