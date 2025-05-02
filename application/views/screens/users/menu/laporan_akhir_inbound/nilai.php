<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-6">
        <h3>Daftar Nilai</h3>
      </div>
      <div class="col-6">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url('home'); ?>"><i data-feather="home"></i></a></li>
          <li class="breadcrumb-item active">Daftar Nilai</li>
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
        <h5>Daftar Nilai</h5>
      </div>
      <div class="card-body">
        <div class="mb-4 ">
          <a class="btn btn-outline-primary" href="<?= base_url('laporan_akhir_inbound/cetak_transkip/'.$id); ?>">Download Transkip Nilai</a>
        </div>
        <div class="table-responsive">
          <table class="display" id="basic-1">
            <thead>
              <tr>
                <th>Matakuliah</th>
                <th>Nilai</th>
                <th>Grade</th>
              </tr>
            </thead>
            <tbody>
              <?php
                foreach ($nilai as $show) {
                  echo "
                    <tr>
                      <td>".$show->matakuliah."</td>
                      <td>".$show->nilai."</td>
                      <td>".$show->grade."</td>
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