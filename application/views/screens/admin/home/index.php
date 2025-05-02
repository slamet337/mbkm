<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-6">
        <h3>Home</h3>
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
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <?php
          $CI =& get_instance();
          if($CI->session->level == "2" || $CI->session->level == "1") {
        ?>
          <div class="card-body">
            <div class="row">
              <div class="col-sm-6 col-xl-4 col-lg-6">
                <div class="card o-hidden">
                  <div class="bg-primary b-r-4 card-body">
                    <div class="media static-top-widget">
                      <div class="align-self-center text-center"><i data-feather="user-plus"></i></div>
                      <div class="media-body"><span class="m-0">Mahasiswa</span>
                        <h4 class="mb-0 counter"><?= $jml_mhsw; ?></h4><i class="icon-bg" data-feather="user-plus"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-xl-4 col-lg-6">
                <div class="card o-hidden">
                  <div class="bg-secondary b-r-4 card-body">
                    <div class="media static-top-widget">
                      <div class="align-self-center text-center"><i data-feather="user-plus"></i></div>
                      <div class="media-body"><span class="m-0">Alumni</span>
                        <h4 class="mb-0 counter"><?= $jml_alumni; ?></h4><i class="icon-bg" data-feather="user-plus"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-xl-4 col-lg-6">
                <div class="card o-hidden">
                  <div class="bg-success b-r-4 card-body">
                    <div class="media static-top-widget">
                      <div class="align-self-center text-center"><i data-feather="user-plus"></i></div>
                      <div class="media-body"><span class="m-0">Dosen</span>
                        <h4 class="mb-0 counter"><?= $jml_dosen; ?></h4><i class="icon-bg" data-feather="user-plus"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-xl-4 col-lg-6">
                <div class="card o-hidden">
                  <div class="bg-info b-r-4 card-body">
                    <div class="media static-top-widget">
                      <div class="align-self-center text-center"><i data-feather="user-plus"></i></div>
                      <div class="media-body"><span class="m-0">Mitra</span>
                        <h4 class="mb-0 counter"><?= $jml_mitra; ?></h4><i class="icon-bg" data-feather="user-plus"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-xl-4 col-lg-6">
                <div class="card o-hidden">
                  <div class="bg-primary b-r-4 card-body">
                    <div class="media static-top-widget">
                      <div class="align-self-center text-center"><i data-feather="user-plus"></i></div>
                      <div class="media-body"><span class="m-0">Mitra Aktif</span>
                        <h4 class="mb-0 counter"><?= $jml_mitra_aktif; ?></h4><i class="icon-bg" data-feather="user-plus"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header">
                <h5>Pendaftar Kegiatan MBKM</h5>
              </div>
              <div class="card-body">
                <div class="user-status table-responsive">
                  <table class="display" id="basic-1">
                    <thead>
                      <tr>
                        <th scope="col">Jenis MBKM</th>
                        <th scope="col">Status</th>
                        <th scope="col">Jumlah</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>FEB</td>
                        <td class="font-success">Diterima</td>
                        <td class="digits"><?= $jml_feb_diterima ?></td>
                      </tr>
                      <tr>
                        <td>FEB</td>
                        <td class="font-danger">Ditolak</td>
                        <td class="digits"><?= $jml_feb_ditolak ?></td>
                      </tr>
                      <tr>
                        <td>FEB</td>
                        <td class="font-warning">Pending</td>
                        <td class="digits"><?= $jml_feb_pending ?></td>
                      </tr>
                      <tr>
                        <td>FEB</td>
                        <td class="font-primary">Selesai</td>
                        <td class="digits"><?= $jml_feb_selesai ?></td>
                      </tr>
                      <tr>
                        <td>Kementerian</td>
                        <td class="font-warning">Belum diberi Nilai</td>
                        <td class="digits"><?= $jml_kementerian_null ?></td>
                      </tr>
                      <tr>
                        <td>Kementerian</td>
                        <td class="font-success">Telah diberi Nilai</td>
                        <td class="digits"><?= $jml_kementerian_nilai ?></td>
                      </tr>
                      <tr>
                        <td>Universitas</td>
                        <td class="font-warning">Belum diberi Nilai</td>
                        <td class="digits"><?= $jml_universitas_null ?></td>
                      </tr>
                      <tr>
                        <td>Universitas</td>
                        <td class="font-success">Telah diberi Nilai</td>
                        <td class="digits"><?= $jml_universitas_nilai ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        <?php
          } else if($CI->session->level == "3") {
        ?>
          <div class="card-body">
            <div class="row">
              <div class="col-sm-6 col-xl-4 col-lg-6">
                <div class="card o-hidden">
                  <div class="bg-secondary b-r-4 card-body">
                    <div class="media static-top-widget">
                      <div class="align-self-center text-center"><i data-feather="user-plus"></i></div>
                      <div class="media-body"><span class="m-0">Mentor</span>
                        <h4 class="mb-0 counter"><?= $jml_mentor; ?></h4><i class="icon-bg" data-feather="user-plus"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-xl-4 col-lg-6">
                <div class="card o-hidden">
                  <div class="bg-primary b-r-4 card-body">
                    <div class="media static-top-widget">
                      <div class="align-self-center text-center"><i data-feather="user-plus"></i></div>
                      <div class="media-body"><span class="m-0">Dosen PJ</span>
                        <h4 class="mb-0 counter"><?= $jml_dpj; ?></h4><i class="icon-bg" data-feather="user-plus"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-xl-4 col-lg-6">
                <div class="card o-hidden">
                  <div class="bg-warning b-r-4 card-body">
                    <div class="media static-top-widget">
                      <div class="align-self-center text-center"><i data-feather="user-plus"></i></div>
                      <div class="media-body"><span class="m-0">Dosen Praktisi</span>
                        <h4 class="mb-0 counter"><?= $jml_dp; ?></h4><i class="icon-bg" data-feather="user-plus"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-xl-4 col-lg-6">
                <div class="card o-hidden">
                  <div class="bg-success b-r-4 card-body">
                    <div class="media static-top-widget">
                      <div class="align-self-center text-center"><i data-feather="user-plus"></i></div>
                      <div class="media-body"><span class="m-0">Pendaftar</span>
                        <h4 class="mb-0 counter"><?= $jml_pendaftar; ?></h4><i class="icon-bg" data-feather="user-plus"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-xl-4 col-lg-6">
                <div class="card o-hidden">
                  <div class="bg-info b-r-4 card-body">
                    <div class="media static-top-widget">
                      <div class="align-self-center text-center"><i data-feather="database"></i></div>
                      <div class="media-body"><span class="m-0">Kegiatan</span>
                        <h4 class="mb-0 counter"><?= $jml_kegiatan; ?></h4><i class="icon-bg" data-feather="database"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-body" style="padding: 150px;">
                <img src="<?= base_url('assets/images/logo/login.png') ?>" style="width:250px; display: block; margin-left: auto; margin-right: auto;">
                <p style="text-align:center; font-size: 18px; margin-top:50px;">Selamat Datang, pada Halaman Sistem Informasi MBKM Fakultas Ekonomi dan Bisnis (FEB)<br>Silahkan pilih menu di samping</p>
              </div>
            </div>
          </div>
        <?php
          } else {
        ?>
          <div class="card-body" style="padding: 150px;">
            <img src="<?= base_url('assets/images/logo/login.png') ?>" style="width:250px; display: block; margin-left: auto; margin-right: auto;">
            <p style="text-align:center; font-size: 18px; margin-top:50px;">Selamat Datang, pada Halaman Sistem Informasi MBKM Fakultas Ekonomi dan Bisnis (FEB)<br>Silahkan pilih menu di samping</p>
          </div>
        <?php
          }
        ?>
      </div>
    </div>
  </div>
</div>
<!-- Container-fluid Ends-->
</div>