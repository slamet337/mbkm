<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-6">
        <h3>Laporan Akhir</h3>
      </div>
      <div class="col-6">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url('home'); ?>"><i data-feather="home"></i></a></li>
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
      <div class="card-body">
        <div class="table-responsive">
          <table class="display" id="basic-1">
            <thead>
              <tr>
                <th>Kegiatan MBKM</th>
                <th>Semester</th>
                <th>Nama Dosen</th>
                <th>Nama Mentor</th>
                <th>File Laporan Akhir</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
                foreach ($laporan_akhir as $show) {
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
                  $btn = "Menunggu Nilai dari Dosen Pembimbing";
                  if($show->file_laporan_akhir == "" || $show->file_laporan_akhir == NULL) {
                    $btn = "<a class='btn btn-success' href='".base_url('laporan_akhir/upload_tugas/').$show->id."'>Upload</a>";
                  }
                  $CI =& get_instance();

                  $check_nilai = $CI->laporan_akhir_model->check_nilai_kegiatan($show->id)->num_rows();
                  if($check_nilai>0) {
                    $btn = "<a class='btn btn-success' href='".base_url('laporan_akhir/nilai/').$show->id."/".$show->id_program."'>Lihat Nilai</a>";
                  }

                  $check_nilai_tukar = $CI->laporan_akhir_model->check_nilai_pertukaran($show->id)->num_rows();
                  if($check_nilai_tukar>0) {
                    $btn = "<a class='btn btn-success' href='".base_url('laporan_akhir/nilai/').$show->id."/".$show->id_program."'>Lihat Nilai</a>";
                  }

                  echo "
                    <tr>
                      <td>".$show->nama_kegiatan."</td>
                      <td>".$show->semester."</td>
                      <td>".$nama_dosen."</td>
                      <td>".$nama_mentor."</td>
                      <td><a href='".base_url($show->file_laporan_akhir)."' class='btn btn-primary'>Download</a></td>
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