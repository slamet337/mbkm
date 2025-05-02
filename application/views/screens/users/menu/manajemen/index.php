<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-6">
        <h3>Manajemen</h3>
      </div>
      <div class="col-6">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url('home'); ?>"><i data-feather="home"></i></a></li>
          <li class="breadcrumb-item active">Manajemen</li>
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
        <h5>Manajemen</h5>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="display" id="basic-1">
            <thead>
              <tr>
                <th>Nama Kegiatan</th>
                <th>Dosen Pembimbing</th>
                <th>Nama Mentor</th>
                <th>Semester</th>
                <th>Status Pendaftaran</th>
                <th>Status Kegiatan</th>
                <th>Keterangan</th>
              </tr>
            </thead>
            <tbody>
              <?php
                foreach ($manajemen as $show) {
                  if ($show->id_mentor == NULL || $show->id_mentor == "") {
                    $nama_mentor = 'Belum dimasukan';
                  } else {
                    $nama_mentor = $show->nama_mentor;
                  }
                  if ($show->nama == NULL || $show->nama == "") {
                    $nama_dosen = 'Belum dimasukan';
                  } else {
                    $nama_dosen = $show->nama;
                  }
                  $style = "";
                  $btn = "";
                  if($show->status_pendaftaran == 'Diterima') {
                    $style = "style='color: green'";
                  } elseif($show->status_pendaftaran == 'Ditolak') {
                    $style = "style='color: red'";
                  }
                  echo "
                    <tr>
                      <td>".$show->nama_kegiatan."</td>
                      <td>".$nama_dosen."</td>
                      <td>".$nama_mentor."</td>
                      <td>".$show->semester."</td>
                      <td ".$style.">".$show->status_pendaftaran."</td>
                      <td>".$show->status_kegiatan."</td>
                      <td>".$show->keterangan."</td>
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