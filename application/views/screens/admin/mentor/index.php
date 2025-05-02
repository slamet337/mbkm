<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-6">
        <h3>Mentor</h3>
      </div>
      <div class="col-6">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url('home'); ?>"><i data-feather="home"></i></a></li>
          <li class="breadcrumb-item active">Mentor</li>
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
        <h5>Mentor</h5>
      </div>
      <div class="card-body">
        <div class="mb-4 ">
          <a class="btn btn-outline-primary" href="<?= base_url('admin/mentor/add'); ?>">Tambah Mentor</a>
        </div>
        <div class="table-responsive">
          <table class="display" id="basic-1">
            <thead>
              <tr>
                <th>Nama Mentor</th>
                <th>Jenis Personil</th>
                <th>Email</th>
                <th>No. HP</th>
                <th>Jabatan</th>
                <th>Alamat</th>
                <th>Pendidikan Terakhir</th>
                <th>Sertifikasi/Keahlian</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
                foreach ($mentor as $show) {
                  echo "
                    <tr>
                      <td>".$show->nama."</td>
                      <td>".$show->jenis_personil."</td>
                      <td>".$show->email."</td>
                      <td>".$show->phone_number."</td>
                      <td>".$show->jabatan."</td>
                      <td>".$show->alamat."</td>
                      <td>".$show->pendidikan_terakhir."</td>
                      <td>".$show->sertifikasi_keahlian."</td>
                      <td>
                        <a class='btn btn-outline-warning' href='".base_url('admin/mentor/edit/').$show->id."'>Edit</a>
                        <a href='javascript:deleteData(\"".$show->id."\",  \"admin/mentor\");' class='btn btn-outline-danger'>Hapus</a>
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