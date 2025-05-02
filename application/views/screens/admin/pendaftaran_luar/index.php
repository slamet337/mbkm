<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-6">
        <h3>Pendaftar Kegiatan Luar Prodi</h3>
      </div>
      <div class="col-6">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url('home'); ?>"><i data-feather="home"></i></a></li>
          <li class="breadcrumb-item active">Pendaftar Kegiatan Luar Prodi</li>
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
        <h5>Pendaftar Kegiatan Luar Prodi</h5>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="display" id="basic-1">
            <thead>
              <tr>
                <th>Nama Mahasiswa</th>
                <th>Jenis MBKM</th>
                <th>Program MBKM</th>
                <th>Nama Kegiatan</th>
                <th>Dosen Pembimbing</th>
                <th>Nama Mentor</th>
                <th>Semester</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $CI = get_instance();
                foreach ($pendaftaran as $show) {
                  if($show->id_dosen == 0 ) {
                    $dosen = $show->dosen_lainnya;
                  } else {
                    $dosen = $show->nama_dosen;
                  }

                  $btn = "";
                  if($CI->pendaftaran_luar_model->get_mk_luar_prodi($show->id) == $CI->pendaftaran_luar_model->get_mk_luar_prodi_with_nilai($show->id)) {
                    $btn = "Nilai sudah di inputkan";
                  } else {
                    $btn = "<a class='btn btn-info' href='".base_url('admin/pendaftaran_luar/input_nilai/'.$show->id)."'>Penilaian</a>";
                  }
                  
                  echo "
                    <tr>
                      <td>".$show->nama."</td>
                      <td>".$show->jenis_mbkm."</td>
                      <td>".$show->nama_program."</td>
                      <td>".$show->nama_kegiatan."</td>
                      <td>".$dosen."</td>
                      <td>".$show->nama_mentor."</td>
                      <td>".$show->semester."</td>
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