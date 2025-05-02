<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-6">
        <h3>Logbook</h3>
      </div>
      <div class="col-6">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url('home'); ?>"><i data-feather="home"></i></a></li>
          <li class="breadcrumb-item"><a href="<?= base_url('admin/pendaftaran_dosen'); ?>"><i data-feather="users"></i></a></li>
          <li class="breadcrumb-item active">Logbook</li>
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
        <h5>Logbook</h5>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="display" id="basic-1">
            <thead>
              <tr>
                <th>Tanggal</th>
                <th>Kegiatan Dilakukan</th>
                <th>Lokasi</th>
                <th>File foto kegiatan</th>
                <th>File Laporan</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $CI =& get_instance();
                foreach ($logbook as $show) {
                  echo "
                    <tr>
                      <td>".$CI->tgl_indo($show->tanggal)."</td>
                      <td>".$show->kegiatan_dilakukan."</td>
                      <td>".$show->lokasi."</td>
                      <td><a href='".base_url($show->foto_kegiatan)."' class='btn btn-primary'>Download</a></td>
                      <td><a href='".base_url($show->file_laporan)."' class='btn btn-primary'>Download</a></td>
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