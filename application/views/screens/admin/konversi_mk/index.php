<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-6">
        <h3>Konversi Matakuliah</h3>
      </div>
      <div class="col-6">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url('home'); ?>"><i data-feather="home"></i></a></li>
          <li class="breadcrumb-item active">Konversi Matakuliah</li>
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
        <h5>Konversi Matakuliah</h5>
      </div>
      <div class="card-body">
        <div class="mb-4 ">
          <a class="btn btn-outline-primary" href="<?= base_url('admin/konversi_mk/add'); ?>">Tambah Matakuliah</a>
        </div>
        <div class="table-responsive">
          <table class="display" id="basic-1">
            <thead>
              <tr>
                <th>Program MBKM</th>
                <th>Kegiatan MBKM</th>
                <th>Kode Matakuliah</th>
                <th>Matakuliah</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
                foreach ($matakuliah as $show) {
                  echo "
                    <tr>
                      <td>".$show->nama_program."</td>
                      <td>".$show->nama_kegiatan."</td>
                      <td>".$show->kd_mk."</td>
                      <td>".$show->matakuliah."</td>
                      <td>
                        <a class='btn btn-outline-warning' href='".base_url('admin/konversi_mk/edit/').$show->id."'>Edit</a>
                        <a href='javascript:deleteData(\"".$show->id."\",  \"admin/konversi_mk\");' class='btn btn-outline-danger'>Hapus</a>
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