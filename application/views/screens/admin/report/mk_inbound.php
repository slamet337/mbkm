<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-6">
        <h3>Report Matakuliah Inbound</h3>
      </div>
      <div class="col-6">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url('home'); ?>"><i data-feather="home"></i></a></li>
          <li class="breadcrumb-item active">Report Matakuliah Inbound</li>
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
        <h5>Report Matakuliah Inbound</h5>
      </div>
      <div class="card-body">
        <form class="form theme-form" method="post" action="<?= base_url('admin/report/cetak_mk_inbound') ?>">
          <div class="mb-3 row">
            <div class="col-md-4">
              <label class="col-md-12 form-label"><b>Download Matakuliah Inbound yang Aktif </b></label>
            </div>
            <div class="col-md-3">
              <button class="btn btn-primary" type="submit">Submit</button>
            </div>
          </div>
        </form>
        <form class="form theme-form" method="post" action="<?= base_url('admin/report/cetak_mk_inbound_all') ?>">
          <div class="mb-3 row">
            <div class="col-md-5">
              <label class="col-md-12 form-label"><b>Download Matakuliah Inbound Keseluruhan</b></label>
            </div>
            <div class="col-md-3">
              <button class="btn btn-primary" type="submit">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Container-fluid Ends-->
</div>