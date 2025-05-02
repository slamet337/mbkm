<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-6">
        <h3>Users</h3>
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
        <h5>Manajemen Users</h5>
      </div>
      <div class="card-body">
        <div class="mb-4 ">
          <a class="btn btn-outline-primary" href="<?= base_url('users/add'); ?>">Tambah Users</a>
        </div>
        <div class="table-responsive">
          <table class="display" id="basic-1">
            <thead>
              <tr>
                <th>Username</th>
                <th>Nama Lengkap</th>
                <th>Level</th>
                <th>Nomor HP</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
                foreach ($users as $show) {
                  echo "
                    <tr>
                      <td>".$show->username."</td>
                      <td>".$show->full_name."</td>
                      <td>".$show->level."</td>
                      <td>".$show->phone_number."</td>
                      <td>
                        <a class='btn btn-outline-warning' href='".base_url('users/edit/').$show->username."'><i class='icon-pencil-alt'></i></a>
                        <a href='javascript:deleteData(\"".$show->username."\", \"users\");' class='btn btn-outline-danger'><i class='icon-trash'></i></a>
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