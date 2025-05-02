<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-6">
        <h3>Matakuliah Pertukaran Mahasiswa Inbound</h3>
      </div>
      <div class="col-6">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url('home'); ?>"><i data-feather="home"></i></a></li>
          <li class="breadcrumb-item active">Matakuliah Pertukaran Mahasiswa Inbound</li>
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
        <h5>Matakuliah Pertukaran Mahasiswa Inbound</h5>
      </div>
      <div class="card-body">
        <div class="mb-4 ">
          <a class="btn btn-outline-primary" href="<?= base_url('admin/matakuliah_inbound/add'); ?>">Tambah Matakuliah Mahasiswa Inbound</a>
        </div>
        <div class="table-responsive">
          <table class="display" id="basic-1">
            <thead>
              <tr>
                <th>Matakuliah</th>
                <th>Hari</th>
                <th>Kelas</th>
                <th>Jam</th>
                <th>Status</th>
                <th>Kuota</th>
                <th>Sisa Kuota</th>
                <th>Batas Waktu</th>
                <th>Description</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $CI =& get_instance();
                foreach ($jadwal as $show) {
                  echo "
                    <tr>
                      <td>".$show->matakuliah."</td>
                      <td>".$show->hari."</td>
                      <td>".$show->kelas."</td>
                      <td>".$show->jam_mulai." - ".$show->jam_selesai."</td>
                      <td>".$show->status."</td>
                      <td>".$show->kuota."</td>
                      <td>".$show->sisa_kuota."</td>
                      <td>".$CI->tgl_indo($show->waktu_mulai)." - ".$CI->tgl_indo($show->waktu_selesai)."</td>
                      <td>".$show->description."</td>
                      <td>
                        <a class='btn btn-outline-warning' href='".base_url('admin/matakuliah_inbound/edit/').$show->id."'>Edit</a>
                        <a href='javascript:deleteData(\"".$show->id."\",  \"admin/matakuliah_inbound\");' class='btn btn-outline-danger'>Hapus</a>
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