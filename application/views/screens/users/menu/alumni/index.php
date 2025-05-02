<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-6">
        <h3>Riwayat Alumni</h3>
      </div>
      <div class="col-6">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url('home'); ?>"><i data-feather="home"></i></a></li>
          <li class="breadcrumb-item active">Riwayat Alumni</li>
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
        <h5>Riwayat Alumni</h5>
      </div>
      <div class="card-body">
        <div class="mb-4 ">
          <a class="btn btn-outline-primary" href="<?= base_url('alumni/add'); ?>">Tambah Riwayat</a>
        </div>
        <div class="table-responsive">
          <table class="display" id="basic-1">
            <thead>
              <tr>
                <th>Jenis Riwayat</th>
                <th>Riwayat</th>
                <th>Lokasi</th>
                <th>Status Kerja</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $CI =& get_instance();
                foreach ($alumni as $show) {
                  if($show->tanggal_selesai == NULL || $show->tanggal_selesai == "" || $show->tanggal_selesai == '0000-00-00') {
                    $tgl_selesai = "Sampai Sekarang";
                  } else {
                    $tgl_selesai = $CI->tgl_indo($show->tanggal_selesai);
                  }
                  echo "
                    <tr>
                      <td>".$show->tipe."</td>
                      <td>".$show->riwayat."</td>
                      <td>".$show->lokasi."</td>
                      <td>".$show->status_kerja."</td>
                      <td>".$CI->tgl_indo($show->tanggal_mulai)."</td>
                      <td>".$tgl_selesai."</td>
                      <td>
                        <a class='btn btn-outline-warning' href='".base_url('alumni/edit/').$show->id."'>Edit</a>
                        <a href='javascript:deleteData(\"".$show->id."\", \"alumni\");' class='btn btn-outline-danger'>Hapus</a>
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