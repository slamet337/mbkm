<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-6">
        <h3>Mitra</h3>
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
        <h5>Manajemen Mitra</h5>
      </div>
      <div class="card-body">
        <div class="mb-4 ">
          <a class="btn btn-outline-primary" href="<?= base_url('admin/user_mitra/add'); ?>">Tambah Mitra</a>
        </div>
        <div class="table-responsive">
          <table class="display" id="basic-1">
            <thead>
              <tr>
                <th>Nama Mitra</th>
                <th>Username</th>
                <th>Nama Lengkap</th>
                <th>Nomor HP</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
                foreach ($user_mitra as $show) {
                  echo "
                    <tr>
                      <td>".$show->nama_mitra."</td>
                      <td>".$show->username."</td>
                      <td>".$show->full_name."</td>
                      <td>".$show->phone_number."</td>
                      <td>
                        <a class='btn btn-outline-warning' href='".base_url('admin/user_mitra/edit/').$show->username."'>Edit</a>
                        <a href='javascript:deleteData(\"".$show->username."\", \"admin/user_mitra\");' class='btn btn-outline-danger'>Hapus</a>
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