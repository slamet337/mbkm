<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-6">
        <h3>Dosen</h3>
      </div>
      <div class="col-6">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url('home'); ?>"><i data-feather="home"></i></a></li>
          <li class="breadcrumb-item active">Home</li>
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
        <h5>Manajemen Dosen</h5>
      </div>
      <div class="card-body">
        <div class="mb-4 ">
          <a class="btn btn-outline-primary" href="<?= base_url('admin/dosen/add'); ?>">Tambah Dosen</a>
        </div>
        <div class="table-responsive">
          <table class="display" id="basic-1">
            <thead>
              <tr>
                <th>Nama Dosen</th>
                <th>NIP</th>
                <th>Email</th>
                <th>Prodi</th>
                <th>Nomor HP</th>
                <th>Alamat</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
                foreach ($dosen as $show) {
                  echo "
                    <tr>
                      <td>".$show->full_name."</td>
                      <td>".$show->nip."</td>
                      <td>".$show->email."</td>
                      <td>".$show->nama_prodi."</td>
                      <td>".$show->phone_number."</td>
                      <td>".$show->alamat."</td>
                      <td>
                        <a class='btn btn-outline-warning' href='".base_url('admin/dosen/edit/').$show->id."'>Edit</a>
                        <a href='javascript:deleteData(\"".$show->id."\",  \"admin/dosen\");' class='btn btn-outline-danger'>Hapus</a>
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