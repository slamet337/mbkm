<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-6">
        <h3>Logbook</h3>
      </div>
      <div class="col-6">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url('home'); ?>"><i data-feather="home"></i></a></li>
          <li class="breadcrumb-item"><a href="<?= base_url('logbook'); ?>"><i data-feather="book-open"></i></a></li>
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
        <h5>Edit Logbook</h5>
      </div>
      <form class="form theme-form" method="post" action="<?= base_url('logbook/update/'.$logbook->id) ?>" enctype="multipart/form-data">
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
            <div class="col-md-3">
              <div class="mb-3">
                <label class="form-label">Tanggal</label>
                <div class="input-group">
                  <input class="datepicker-here form-control digits" name="tanggal" type="text" data-language="id" value="<?= $CI->tgl_indo_1($logbook->tanggal); ?>">
                </div>
              </div>
            </div>
            <div class="col-md-9">
              <div class="mb-3">
                <label class="form-label">Kegiatan yang dilakukan</label>
                <input class="form-control" type="text" name="kegiatan_dilakukan" placeholder="Kegiatan yang dilakukan" value="<?= $logbook->kegiatan_dilakukan; ?>">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="mb-3">
                <label class="form-label">Lokasi</label>
                <textarea name="lokasi" rows="3" class="form-control"><?= $logbook->lokasi ?></textarea>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Foto Kegiatan (max size 1 MB)</label>
                <input class="form-control" type="file" name="foto_kegiatan">
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">File Laporan (Optional, max size 1 MB) </label>
                <input class="form-control" type="file" name="file_laporan">
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <button class="btn btn-primary" type="submit">Submit</button>
          <a href="<?= base_url('logbook') ?>" class="btn btn-light" >Cancel</a>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Container-fluid Ends-->
</div>