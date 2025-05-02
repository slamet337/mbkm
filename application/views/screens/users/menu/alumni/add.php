<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-6">
        <h3>Alumni</h3>
      </div>
      <div class="col-6">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url('home'); ?>"><i data-feather="home"></i></a></li>
          <li class="breadcrumb-item"><a href="<?= base_url('alumni'); ?>"><i data-feather="user"></i></a></li>
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
        <h5>Add Riwayat Alumni</h5>
      </div>
      <form class="form theme-form" method="post" action="<?= base_url('alumni/post') ?>">
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
                <label class="form-label">Jenis Riwayat</label>
                <select name="tipe" class="form-select js-example-basic-single">
                  <option label="">- Pilih Jenis Riwayat -</option>
                  <option value="Pekerjaan">Pekerjaan</option>
                  <option value="Pendidikan">Pendidikan</option>
                  <option value="Sertifikasi">Sertifikasi</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Nama Kegiatan</label>
                <input class="form-control" type="text" name="riwayat" placeholder="Nama Kegiatan">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Nama Lembaga</label>
                <input class="form-control" type="text" name="lokasi" placeholder="Nama Lembaga">
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Status Kerja</label>
                <select name="status_kerja" class="form-select js-example-basic-single">
                  <option label="">- Pilih Status Kerja -</option>
                  <option value="Masih Aktif">Masih Aktif</option>
                  <option value="Selesai">Selesai</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Tanggal Mulai</label>
                <div class="input-group">
                  <input class="datepicker-here form-control digits" name="tanggal_mulai" type="text" data-language="id">
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Tanggal Selesai (Jika masih aktif, kosongkan saja)</label>
                <div class="input-group">
                  <input class="datepicker-here form-control digits" name="tanggal_selesai" type="text" data-language="id">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <button class="btn btn-primary" type="submit">Submit</button>
          <a href="<?= base_url('alumni') ?>" class="btn btn-light" >Cancel</a>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Container-fluid Ends-->
</div>