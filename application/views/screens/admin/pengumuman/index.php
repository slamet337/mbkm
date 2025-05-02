<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-6">
        <h3>Pengumuman</h3>
      </div>
      <div class="col-6">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url('home'); ?>"><i data-feather="home"></i></a></li>
          <li class="breadcrumb-item active">Pengumuman</li>
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
        <h5>Pengumuman</h5>
      </div>
      <div class="card-body">
        <div class="mb-4 ">
          <a class="btn btn-outline-primary" href="<?= base_url('admin/pengumuman/add'); ?>">Tambah Pengumuman</a>
        </div>
        <div class="table-responsive">
          <table class="display" id="basic-1">
            <thead>
              <tr>
                <th>Judul</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
                foreach ($pengumuman as $show) {
                  echo "
                    <tr>
                      <td>".$show->title."</td>
                      <td>
                        <button class='btn btn-success' type='button' data-bs-toggle='modal' data-bs-target='#broadcastModal".$show->id."'>Broadcast</button>
                        <div class='modal fade' id='broadcastModal".$show->id."' tabindex='-1' role='dialog' aria-hidden='true'>
                          <div class='modal-dialog' role='document'>
                            <div class='modal-content'>
                              <form class='form theme-form' method='post' action='".base_url('admin/pengumuman/send/'.$show->id)."'>
                                <div class='modal-header'>
                                  <h5 class='modal-title'>Broadcast Email</h5>
                                  <button class='btn-close' type='button' data-bs-dismiss='modal' aria-label='Close'></button>
                                </div>
                                <div class='modal-body'>
                                  <div class='row'>
                                    <div class='col-md-12s'>
                                      <div class='mb-3'>
                                        <label class='form-label'>Tujuan Broadcast</label>
                                        <select name='tujuan' class='form-select'>
                                          <option value=''>- Pilih Tujuan Broadcast -</option>
                                          <option value='1'>Seluruh Mahasiswa FEB</option>
                                          <option value='2'>Mahasiswa S1 IESP</option>
                                          <option value='3'>Mahasiswa D3 PEMASARAN</option>
                                          <option value='4'>Mahasiswa S1 MANAJEMEN</option>
                                          <option value='5'>Mahasiswa D3 AKUNTANSI</option>
                                          <option value='6'>Mahasiswa S1 AKUNTANSI</option>
                                          <option value='7'>Mahasiswa Inbound</option>
                                          <option value='8'>Seluruh Mitra</option>
                                          <option value='9'>Mitra & Mahasiswa Keseluruhan</option>
                                          <option value='10'>Dosen</option>
                                          <option value='11'>Alumni</option>
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class='modal-footer'>
                                  <button class='btn btn-primary' type='submit'>Broadcast</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                        <a class='btn btn-warning' href='".base_url('admin/pengumuman/edit/').$show->id."'>Edit</a>
                        <a href='javascript:deleteData(\"".$show->id."\",  \"admin/pengumuman\");' class='btn btn-danger'>Hapus</a>
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