<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-6">
        <h3>List Pendaftaran</h3>
      </div>
      <div class="col-6">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url('home'); ?>"><i data-feather="home"></i></a></li>
          <li class="breadcrumb-item active">List Pendaftaran</li>
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
        <h5>List Pendaftaran</h5>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="display" id="basic-1">
            <thead>
              <tr>
                <th>Nama Mahasiswa</th>
                <th>Nama Kegiatan</th>
                <th>Dosen Pembimbing</th>
                <th>Nama Mentor</th>
                <th>Semester</th>
                <th>Status Pendaftaran</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
                foreach ($pendaftaran as $show) {
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
                    
                    if($show->id_program == 1) {
                      $btn = "Persyaratan diterima <a class='btn btn-primary' href='".base_url('admin/pendaftaran/logbook/'.$show->id)."'>Logbook</a>
                      <a class='btn btn-success' href='".base_url($show->file_laporan_akhir)."'>Laporan Akhir</a>";
                    } else {
                      $btn = "Persyaratan diterima <a class='btn btn-primary' href='".base_url('admin/pendaftaran/logbook/'.$show->id)."'>Logbook</a>
                      <a class='btn btn-success' href='".base_url($show->file_laporan_akhir)."'>Laporan Akhir</a>
                      <a class='btn btn-info' href='".base_url('admin/pendaftaran/input_nilai/'.$show->id.'/'.$show->id_kegiatan)."'>Penilaian</a>";
                    }
                  } elseif($show->status_pendaftaran == 'Ditolak') {
                    $style = "style='color: red'";
                    $btn = "Persyaratan ditolak";
                  } else {
                    $btn = "<a class='btn btn-primary' href='".base_url('admin/pendaftaran/detail/'.$show->id.'/'.$show->id_program)."'>Detail</a>";
                  }

                  if($show->status_kegiatan == 'Selesai') {
                    $btn = "Persyaratan diterima <a class='btn btn-primary' href='".base_url('admin/pendaftaran/nilai/'.$show->id)."'>Lihat Nilai</a>";
                  }
                  echo "
                    <tr>
                      <td>".$show->nama_mhsw."</td>
                      <td>".$show->nama_kegiatan."</td>
                      <td>".$nama_dosen."</td>
                      <td>".$nama_mentor."</td>
                      <td>".$show->semester."</td>
                      <td ".$style.">".$show->status_pendaftaran."</td>
                      <td>".$btn."</td>
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