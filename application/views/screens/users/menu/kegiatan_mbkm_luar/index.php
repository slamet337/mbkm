<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-6">
        <h3>Kegiatan MBKM Luar Prodi</h3>
      </div>
      <div class="col-6">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url('home'); ?>"><i data-feather="home"></i></a></li>
          <li class="breadcrumb-item active">Kegiatan MBKM Luar Prodi</li>
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
        <h5>Kegiatan MBKM Luar Prodi</h5>
      </div>
      <div class="card-body">
        <div class="mb-4 ">
          <a class="btn btn-outline-primary" href="<?= base_url('kegiatan_mbkm_luar/add'); ?>">Tambah Kegiatan MBKM</a>
        </div>
        <div class="table-responsive">
          <table class="display" id="basic-1">
            <thead>
              <tr>
                <th>Jenis MBKM</th>
                <th>Program</th>
                <th>Kegiatan</th>
                <th>Semester</th>
                <th>Penyelenggara</th>
                <th>Lokasi Pelaksanaan</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
                foreach ($kegiatan_mbkm_luar as $show) {
                  echo "
                    <tr>
                      <td>".$show->jenis_mbkm."</td>
                      <td>".$show->nama_program."</td>
                      <td>".$show->nama_kegiatan."</td>
                      <td>".$show->semester."</td>
                      <td>".$show->penyelenggara_mbkm."</td>
                      <td>".$show->lokasi_kegiatan."</td>
                      <td>
                        <a class='btn btn-outline-warning' href='".base_url('kegiatan_mbkm_luar/edit/').$show->id."'>Edit</a>
                        <a href='javascript:deleteData(\"".$show->id."\", \"".'kegiatan_mbkm_luar'."\");' class='btn btn-outline-danger'>Hapus</a>
                      </td>
                    </tr>
                  ";
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Container-fluid Ends-->
</div>