<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-6">
        <h3>Profil</h3>
      </div>
      <div class="col-6">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url('admin/menu'); ?>"><i data-feather="home"></i></a></li>
          <li class="breadcrumb-item active">Profil</li>
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
        <h5>Profil Dosen</span>
      </div>
      <div class="card-body">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item"><a class="nav-link  <?php if($tab == "biodata") {echo "active";} ?>" id="biodata-tab" data-bs-toggle="tab" href="#biodata" role="tab" aria-controls="biodata" aria-selected="true">Biodata</a></li>
          <li class="nav-item"><a class="nav-link  <?php if($tab == "pendidikan") {echo "active";} ?>" id="pendidikan-tab" data-bs-toggle="tab" href="#pendidikan" role="tab" aria-controls="pendidikan" aria-selected="false">Pendidikan</a></li>
          <li class="nav-item"><a class="nav-link  <?php if($tab == "program_mbkm") {echo "active";} ?>" id="program_mbkm-tab" data-bs-toggle="tab" href="#program_mbkm" role="tab" aria-controls="program_mbkm" aria-selected="false">Riwayat MBKM</a></li>
          <li class="nav-item"><a class="nav-link  <?php if($tab == "pekerajan") {echo "active";} ?>" id="pekerjaan-tab" data-bs-toggle="tab" href="#pekerjaan" role="tab" aria-controls="pekerjaan" aria-selected="false">Pekerjaan</a></li>
          <li class="nav-item"><a class="nav-link  <?php if($tab == "jabatan") {echo "active";} ?>" id="jabatan-tab" data-bs-toggle="tab" href="#jabatan" role="tab" aria-controls="jabatan" aria-selected="false">Jabatan</a></li>
          <li class="nav-item"><a class="nav-link  <?php if($tab == "wirausaha") {echo "active";} ?>" id="wirausaha-tab" data-bs-toggle="tab" href="#wirausaha" role="tab" aria-controls="wirausaha" aria-selected="false">Wirausaha</a></li>
          <li class="nav-item"><a class="nav-link  <?php if($tab == "seminar") {echo "active";} ?>" id="seminar-tab" data-bs-toggle="tab" href="#seminar" role="tab" aria-controls="seminar" aria-selected="false">Seminar</a></li>
          <li class="nav-item"><a class="nav-link  <?php if($tab == "prestasi") {echo "active";} ?>" id="prestasi-tab" data-bs-toggle="tab" href="#prestasi" role="tab" aria-controls="prestasi" aria-selected="false">Prestasi</a></li>
          <li class="nav-item"><a class="nav-link  <?php if($tab == "karya-ilmiah") {echo "active";} ?>" id="karya-ilmiah-tab" data-bs-toggle="tab" href="#karya-ilmiah" role="tab" aria-controls="karya-ilmiah" aria-selected="false">Karya Ilmiah</a></li>
          <li class="nav-item"><a class="nav-link  <?php if($tab == "organisasi") {echo "active";} ?>" id="organisasi-tab" data-bs-toggle="tab" href="#organisasi" role="tab" aria-controls="organisasi" aria-selected="false">Organisasi</a></li>
          <li class="nav-item"><a class="nav-link  <?php if($tab == "setting") {echo "active";} ?>" id="setting-tab" data-bs-toggle="tab" href="#setting" role="tab" aria-controls="setting" aria-selected="false">Setting</a></li>
          <li class="nav-item"><a class="nav-link  <?php if($tab == "download") {echo "active";} ?>" id="download-tab" data-bs-toggle="tab" href="#download" role="tab" aria-controls="download" aria-selected="false">Download CV</a></li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade <?php if($tab == "biodata") {echo "show active";} ?>" id="biodata" role="tabpanel" aria-labelledby="biodata-tab">
            <h5 class="mb-4 mt-4" style="text-align:center">Biodata Dosen</h5>
            <form class="form theme-form" method="post" action="<?= base_url('admin/profil/update/').$profil->id; ?>">
              <?php
                $CI =& get_instance();
                if (validation_errors()) {
              ?>
                <div class="alert alert-danger dark alert-dismissible fade show m-20 m-b-0" role="alert">
                  <i data-feather="alert-triangle"></i>
                  <p><?= validation_errors(); ?></p>
                  <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              <?php
                }
              ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3 mt-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input class="form-control" type="text" name="nama" placeholder="Nama Lengkap" value="<?= $profil->nama ?>" >
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3 mt-3">
                    <label class="form-label">Prodi</label>
                    <select name="kd_prodi" class="form-select">
                      <option label="">- Pilih Prodi -</option>
                      <?php
                        foreach ($prodi as $show) {
                          $selected = "";
                          if($show->kd_prodi == $profil->kd_prodi) {
                            $selected = "selected";
                          }
                      ?>
                          <option value='<?= $show->kd_prodi ?>' <?= $selected ?>><?= $show->nama_prodi ?></option>
                      <?php
                        }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">NIK / NIP / NIDN</label>
                    <input class="form-control" type="text" name="nip" placeholder="NIK / NIP / NIDN" value="<?= $profil->nip ?>" >
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Nomor HP</label>
                    <input class="form-control" type="text" name="no_hp" placeholder="Nomor HP" value="<?= $profil->phone_number ?>" >
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Tempat Lahir</label>
                    <input class="form-control" type="text" name="tempat_lahir" placeholder="Tempat Lahir" value="<?= $profil->tempat_lahir ?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Tanggal Lahir</label>
                    <div class="input-group">
                      <input class="datepicker-here form-control digits" name="tanggal_lahir" type="text" data-language="id" value="<?php if ($profil->tanggal_lahir == NULL || $profil->tanggal_lahir == '' || $profil->tanggal_lahir == '0000-00-00') { echo '';} else { echo $CI->tgl_indo_1($profil->tanggal_lahir);}?>">
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-select">
                      <option label="">- Pilih Jenis Kelamin -</option>
                      <option value='L' <?php if($profil->jenis_kelamin == 'L') { echo "selected"; } ?>>Laki-laki</option>
                      <option value='P' <?php if($profil->jenis_kelamin == 'P') { echo "selected"; } ?>>Perempuan</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Agama</label>
                    <select name="agama" class="form-select">
                      <option label="" value=''>- Pilih Agama -</option>
                      <option value='Islam'  <?php if($profil->agama == 'Islam') { echo "selected"; } ?>>Islam</option>
                      <option value='Protestan'  <?php if($profil->agama == 'Protestan') { echo "selected"; } ?>>Protestan</option>
                      <option value='Katolik'  <?php if($profil->agama == 'Katolik') { echo "selected"; } ?>>Katolik</option>
                      <option value='Hindu'  <?php if($profil->agama == 'Hindu') { echo "selected"; } ?>>Hindu</option>
                      <option value='Buddha'  <?php if($profil->agama == 'Buddha') { echo "selected"; } ?>>Buddha</option>
                      <option value='Khonghucu'  <?php if($profil->agama == 'Khonghucu') { echo "selected"; } ?>>Khonghucu</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Jabatan Fungsional</label>
                    <input class="form-control" type="text" name="jabatan_fungsional" placeholder="Jabatan Fungsional" value="<?= $profil->jabatan_fungsional ?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Status Pernikahan</label>
                    <select name="status_pernikahan" class="form-select">
                      <option label=""  value=''>- Pilih Status Pernikahan -</option>
                      <option value='Belum Menikah' <?php if($profil->status_pernikahan == 'Belum Menikah') { echo "selected"; } ?>>Belum Menikah</option>
                      <option value='Sudah Menikah' <?php if($profil->status_pernikahan == 'Sudah Menikah') { echo "selected"; } ?>>Sudah Menikah</option>
                      <option value='Cerai' <?php if($profil->status_pernikahan == 'Cerai') { echo "selected"; } ?>>Cerai</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input class="form-control" type="email" name="email" placeholder="Email" value="<?= $profil->email ?>" >
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Pangkat/Golongan</label>
                    <input class="form-control" type="text" name="pangkat_gol" placeholder="Pangkat/Golongan" value="<?= $profil->pangkat_gol ?>" >
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Golongan Darah</label>
                    <select name="gol_darah" class="form-select">
                      <option label=""  value=''>- Pilih Golongan Darah -</option>
                      <option value='A' <?php if($profil->gol_darah == 'A') { echo "selected"; } ?>>A</option>
                      <option value='B' <?php if($profil->gol_darah == 'B') { echo "selected"; } ?>>B</option>
                      <option value='AB' <?php if($profil->gol_darah == 'AB') { echo "selected"; } ?>>AB</option>
                      <option value='O' <?php if($profil->gol_darah == 'O') { echo "selected"; } ?>>O</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" rows="5" class="form-control" style="color: #898989;"><?= $profil->alamat ?></textarea>
                  </div>
                </div>
              </div>
              <button class="btn btn-primary" type="submit">Perbarui Data</button>
            </form>
          </div>
          <div class="tab-pane fade  <?php if($tab == "pendidikan") {echo "show active";} ?>" id="pendidikan" role="tabpanel" aria-labelledby="pendidikan-tab">
            <h5 class="mb-4 mt-4" style="text-align:center">Riwayat Pendidikan Tinggi</h5>
            <div class="mb-4">
              <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target=".add-modal-mbkm">Tambah Pendidikan</button>
              <div class="modal fade add-modal-mbkm" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="myLargeModalLabel">Tambah Pendidikan</h4>
                      <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form class="form theme-form" method="post" action="<?= base_url('admin/profil/post_pendidikan/').$profil->id; ?>">
                        <?php
                          $CI =& get_instance();
                          if (validation_errors()) {
                        ?>
                          <div class="alert alert-danger dark alert-dismissible fade show m-20 m-b-0" role="alert">
                            <i data-feather="alert-triangle"></i>
                            <p><?= validation_errors(); ?></p>
                            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                        <?php
                          }
                        ?>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3 mt-3">
                              <label class="form-label">Jenjang</label>
                              <select name="jenjang" class="form-select">
                                <option label="" value="">- Pilih Jenjang -</option>
                                <option value='D3'>D3</option>
                                <option value='D4'>D4</option>
                                <option value='S1'>S1</option>
                                <option value='S2'>S2</option>
                                <option value='S3'>S3</option>
                                <option value='Pendidikan Profesi'>Pendidikan Profesi</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="mb-3 mt-3">
                              <label class="form-label">Nama Universitas</label>
                              <input class="form-control" type="text" name="nama_sekolah" placeholder="Nama Universitas">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3 mt-3">
                              <label class="form-label">Fakultas</label>
                              <input class="form-control" type="text" name="fakultas" placeholder="Nama Fakultas">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="mb-3 mt-3">
                              <label class="form-label">Jurusan</label>
                              <input class="form-control" type="text" name="jurusan" placeholder="Nama Jurusan">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3 mt-3">
                              <label class="form-label">Prodi</label>
                              <input class="form-control" type="text" name="prodi" placeholder="Nama Prodi">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="mb-3 mt-3">
                              <label class="form-label">Dosen Pembimbing</label>
                              <input class="form-control" type="text" name="dosen_pembimbing" placeholder="Nama Dosen">
                              <i>* Jika lebih dari 1 dosen pembimbing gunakan tanda ";" (titik koma) untuk memisahkan nama dosen</i>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3 mt-3">
                              <label class="form-label">Tanggal Masuk</label>
                              <div class="input-group">
                                <input class="datepicker-here form-control digits" name="tanggal_masuk" type="text" data-language="id">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="mb-3 mt-3">
                              <label class="form-label">Tanggal Yudisium</label>
                              <div class="input-group">
                                <input class="datepicker-here form-control digits" name="tanggal_yudisium" type="text" data-language="id">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3 mt-3">
                              <label class="form-label">Konsentrasi</label>
                              <input class="form-control" type="text" name="konsentrasi" placeholder="Konsentrasi">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="mb-3 mt-3">
                              <label class="form-label">Judul Laporan/Skripsi/Tesis/Disertasi</label>
                              <input class="form-control" type="text" name="tugas_akhir" placeholder="Judul Tugas Akhir">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3 mt-3">
                              <label class="form-label">IPK</label>
                              <input class="form-control" type="number" name="ipk" placeholder="IPK" step="any" >
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="mb-3 mt-3">
                              <label class="form-label">Gelar</label>
                              <input class="form-control" type="text" name="gelar" placeholder="Gelar">
                            </div>
                          </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Tambah Pendidikan</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="display basic-1">
                <thead>
                  <tr>
                    <th>Jenjang</th>
                    <th>Nama Universitas</th>
                    <th>Fakultas</th>
                    <th>Jurusan</th>
                    <th>Prodi</th>
                    <th>Tanggal Masuk</th>
                    <th>Tanggal Yudisium</th>
                    <th>Judul Laporan/Skripsi/Tesis/Disertasi</th>
                    <th>IPK</th>
                    <th>Gelar</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    foreach ($pendidikan as $show) {
                      $btn = '<button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target=".edit-modal-mbkm-'.$show->id.'">Edit</button>
                      <div class="modal fade edit-modal-mbkm-'.$show->id.'" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title" id="myLargeModalLabel">Edit Pendidikan</h4>
                              <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <form class="form theme-form" method="post" action="'.base_url('admin/profil/put_pendidikan/').$show->id.'">';
                      if (validation_errors()) {
                        $btn = $btn.'<div class="alert alert-danger dark alert-dismissible fade show m-20 m-b-0" role="alert">
                          <i data-feather="alert-triangle"></i>
                          <p>'.validation_errors().'</p>
                          <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                      }
                      
                      $d3 = "";
                      $d4 = "";
                      $s1 = "";
                      $s2 = "";
                      $s3 = "";
                      switch ($show->jenjang) {
                        case 'D3':
                          $d3 = "selected";
                          break;
                        case 'D4':
                          $d4 = "selected";
                          break;
                        case 'S1':
                          $s1 = "selected";
                          break;
                        case 'S2':
                          $s2 = "selected";
                          break;
                        case 'S3':
                          $s3 = "selected";
                          break;
                        default:
                          # code...
                          break;
                      }

                      $btn = $btn.'<div class="row">
                                  <div class="col-md-6">
                                    <div class="mb-3 mt-3">
                                      <label class="form-label">Jenjang</label>
                                      <select name="jenjang" class="form-select">
                                        <option label="" value="">- Pilih Jenjang -</option>
                                        <option value="D3" '.$d3.'>D3</option>
                                        <option value="D4" '.$d4.'>D4</option>
                                        <option value="S1" '.$s1.'>S1</option>
                                        <option value="S2" '.$s2.'>S2</option>
                                        <option value="S3" '.$s3.'>S3</option>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="mb-3 mt-3">
                                      <label class="form-label">Nama Universitas</label>
                                      <input class="form-control" type="text" name="nama_sekolah" placeholder="Nama Universitas" value="'.$show->nama_sekolah.'">
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="mb-3 mt-3">
                                      <label class="form-label">Fakultas</label>
                                      <input class="form-control" type="text" name="fakultas" placeholder="Nama Fakultas" value="'.$show->fakultas.'">
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="mb-3 mt-3">
                                      <label class="form-label">Jurusan</label>
                                      <input class="form-control" type="text" name="jurusan" placeholder="Nama Jurusan" value="'.$show->jurusan.'">
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="mb-3 mt-3">
                                      <label class="form-label">Prodi</label>
                                      <input class="form-control" type="text" name="prodi" placeholder="Nama Prodi" value="'.$show->prodi.'">
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="mb-3 mt-3">
                                      <label class="form-label">Dosen Pembimbing</label>
                                      <input class="form-control" type="text" name="dosen_pembimbing" placeholder="Nama Dosen" value="'.$show->dosen_pembimbing.'">
                                      <i>* Jika lebih dari 1 dosen pembimbing gunakan tanda ";" (titik koma) untuk memisahkan nama dosen</i>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="mb-3 mt-3">
                                      <label class="form-label">Tanggal Masuk</label>
                                      <div class="input-group">
                                        <input class="datepicker-here form-control digits" name="tanggal_masuk" type="text" data-language="id"  value="'.$CI->tgl_indo_1($show->tanggal_masuk).'">
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="mb-3 mt-3">
                                      <label class="form-label">Tanggal Yudisium</label>
                                      <div class="input-group">
                                        <input class="datepicker-here form-control digits" name="tanggal_yudisium" type="text" data-language="id" value="'.$CI->tgl_indo_1($show->tanggal_yudisium).'">
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="mb-3 mt-3">
                                      <label class="form-label">Konsentrasi</label>
                                      <input class="form-control" type="text" name="konsentrasi" placeholder="Konsentrasi" value="'.$show->konsentrasi.'">
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="mb-3 mt-3">
                                      <label class="form-label">Judul Laporan/Skripsi/Tesis/Disertasi</label>
                                      <input class="form-control" type="text" name="tugas_akhir" placeholder="Judul Tugas Akhir" value="'.$show->tugas_akhir.'">
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="mb-3 mt-3">
                                      <label class="form-label">IPK</label>
                                      <input class="form-control" type="number" name="ipk" placeholder="IPK" step="any"  value="'.$show->ipk.'">
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="mb-3 mt-3">
                                      <label class="form-label">Gelar</label>
                                      <input class="form-control" type="text" name="gelar" placeholder="Gelar" value="'.$show->gelar.'">
                                    </div>
                                  </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Edit Data</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>';

                      $btn = $btn."<a href='javascript:deleteData(\"".$show->id."\", \"admin/profil\");' class='btn btn-danger'>Hapus</a>";

                      echo "
                        <tr>
                          <td>".$show->jenjang."</td>
                          <td>".$show->nama_sekolah."</td>
                          <td>".$show->fakultas."</td>
                          <td>".$show->jurusan."</td>
                          <td>".$show->prodi."</td>
                          <td>".$CI->tgl_indo($show->tanggal_masuk)."</td>
                          <td>".$CI->tgl_indo($show->tanggal_yudisium)."</td>
                          <td>".$show->tugas_akhir."</td>
                          <td>".$show->ipk."</td>
                          <td>".$show->gelar."</td>
                          <td>".$btn."</td>
                        </tr>
                      ";
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="tab-pane fade  <?php if($tab == "program_mbkm") {echo "show active";} ?>" id="program_mbkm" role="tabpanel" aria-labelledby="program_mbkm-tab">
          <h5 class="mb-4 mt-4" style="text-align:center">Riwayat Program MBKM</h5>
            <div class="table-responsive">
              <table class="display basic-1">
                <thead>
                  <tr>
                    <th>Nama Mahasiswa</th>
                    <th>Jenis MBKM</th>
                    <th>Jenis Program MBKM</th>
                    <th>Kegiatan MBKM</th>
                    <th>Semester</th>
                    <th>Penyelenggara Kegiatan</th>
                    <th>Lokasi Kegiatan</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    foreach ($mbkm as $show) {
                      $status = "";
                      if ($show->status_pendaftaran == "Ditolak") {
                        $status = "Ditolak";
                      } else if ($show->status_pendaftaran == "Diterima" && $show->status_kegiatan == "Selesai") {
                        $status = "Selesai";
                      } else if ($show->status_pendaftaran == "On Process") {
                        $status = "On Process";
                      } else if ($show->status_pendaftaran == "Diterima") {
                        $status = "Aktif";
                      }
                      echo "
                        <tr>
                          <td>".$show->nama_mhsw." (".$show->nim.")</td>
                          <td>FEB</td>
                          <td>".$show->nama_program."</td>
                          <td>".$show->nama_kegiatan."</td>
                          <td>".$show->semester."</td>
                          <td>".$show->nama_mitra."</td>
                          <td>".$show->lokasi_kegiatan."</td>
                          <td>".$status."</td>
                        </tr>
                      ";
                    }

                    foreach ($mbkm_luar as $show) {
                      echo "
                        <tr>
                          <td>".$show->nama_mhsw." (".$show->nim.")</td>
                          <td>".$show->jenis_mbkm."</td>
                          <td>".$show->nama_program."</td>
                          <td>".$show->nama_kegiatan."</td>
                          <td>".$show->semester."</td>
                          <td>".$show->nama_mitra."</td>
                          <td>".$show->lokasi_kegiatan."</td>
                          <td>Selesai</td>
                        </tr>
                      ";
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="tab-pane fade  <?php if($tab == "pekerjaan") {echo "show active";} ?>" id="pekerjaan" role="tabpanel" aria-labelledby="pekerjaan-tab">
            <h5 class="mb-4 mt-4" style="text-align:center">Riwayat Pekerjaan</h5>
            <div class="mb-4">
              <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target=".add-modal-pekerjaan">Tambah Pekerjaan</button>
              <div class="modal fade add-modal-pekerjaan" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="myLargeModalLabel">Tambah Pekerjaan</h4>
                      <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form class="form theme-form" method="post" action="<?= base_url('admin/profil/post_pekerjaan/').$profil->id; ?>">
                        <?php
                          $CI =& get_instance();
                          if (validation_errors()) {
                        ?>
                          <div class="alert alert-danger dark alert-dismissible fade show m-20 m-b-0" role="alert">
                            <i data-feather="alert-triangle"></i>
                            <p><?= validation_errors(); ?></p>
                            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                        <?php
                          }
                        ?>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3 mt-3">
                              <label class="form-label">Nama Instansi / Perusahaan</label>
                              <input class="form-control" type="text" name="nama_perusahaan" placeholder="Nama Instansi / Perusahaan">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="mb-3 mt-3">
                              <label class="form-label">Bergerak dibidang</label>
                              <input class="form-control" type="text" name="bergerak_bidang" placeholder="Bergerak dibidang">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3 mt-3">
                              <label class="form-label">Tanggal Masuk</label>
                              <div class="input-group">
                                <input class="datepicker-here form-control digits" name="tanggal_masuk" type="text" data-language="id">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="mb-3 mt-3">
                              <label class="form-label">Tanggal Berhenti</label>
                              <div class="input-group">
                                <input class="datepicker-here form-control digits" name="tanggal_berhenti" type="text" data-language="id">
                              </div>
                              <i>* Kosongkan bila masih bekerja</i>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3 mt-3">
                              <label class="form-label">Gaji</label>
                              <input class="form-control" type="number" name="gaji" placeholder="Gaji">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="mb-3 mt-3">
                              <label class="form-label">Jabatan</label>
                              <input class="form-control" type="text" name="jabatan" placeholder="Jabatan">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3">
                              <label class="form-label">Jenis Pekerjaan</label>
                              <select name="jenis_pekerjaan" class="form-select">
                                <option label="">- Pilih Jenis Pekerjaan -</option>
                                <option value='Dalam Kampus'>Dalam Kampus</option>
                                <option value='Luar Kampus'>Luar Kampus</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="mb-3 mt-3">
                              <label class="form-label">Alamat</label>
                              <textarea name="alamat" class="form-control" row="3"></textarea>
                            </div>
                          </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Tambah Pekerjaan</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="display basic-1">
                <thead>
                  <tr>
                    <th>Nama Instansi / Perusahaan</th>
                    <th>Tanggal Masuk</th>
                    <th>Tanggal Berhenti</th>
                    <th>Gaji</th>
                    <th>Bergerak dibidang</th>
                    <th>Jabatan</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    foreach ($pekerjaan as $show) {
                      $dalam = "";
                      $luar = "";
                      switch ($show->jenis_pekerjaan) {
                        case 'Dalam Kampus':
                          $dalam = "selected";
                          break;
                        case 'Luar Kampus':
                          $luar = "selected";
                          break;
                        default:
                          # code...
                          break;
                      }
                      $btn = '<button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target=".edit-modal-pekerjaan-'.$show->id.'">Edit</button>
                      <div class="modal fade edit-modal-pekerjaan-'.$show->id.'" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title" id="myLargeModalLabel">Edit Pekerjaan</h4>
                              <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <form class="form theme-form" method="post" action="'.base_url('admin/profil/put_pekerjaan/').$show->id.'">';

                              if (validation_errors()) {
                                $btn = $btn.'<div class="alert alert-danger dark alert-dismissible fade show m-20 m-b-0" role="alert">
                                  <i data-feather="alert-triangle"></i>
                                  <p>'.validation_errors().'</p>
                                  <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>';
                              }
                      $btn = $btn.'<div class="row">
                                  <div class="col-md-6">
                                    <div class="mb-3 mt-3">
                                      <label class="form-label">Nama Instansi / Perusahaan</label>
                                      <input class="form-control" type="text" name="nama_perusahaan" placeholder="Nama Instansi / Perusahaan"  value="'.$show->nama_perusahaan.'">
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="mb-3 mt-3">
                                      <label class="form-label">Bergerak dibidang</label>
                                      <input class="form-control" type="text" name="bergerak_bidang" placeholder="Bergerak dibidang"  value="'.$show->bergerak_bidang.'">
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="mb-3 mt-3">
                                      <label class="form-label">Tanggal Masuk</label>
                                      <div class="input-group">
                                        <input class="datepicker-here form-control digits" name="tanggal_masuk" type="text" data-language="id"  value="'.$CI->tgl_indo_1($show->tanggal_masuk).'">
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="mb-3 mt-3">
                                      <label class="form-label">Tanggal Berhenti</label>
                                      <div class="input-group">
                                        <input class="datepicker-here form-control digits" name="tanggal_berhenti" type="text" data-language="id"  value="'.$CI->tgl_indo_1($show->tanggal_berhenti).'">
                                      </div>
                                      <i>* Kosongkan bila masih bekerja</i>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="mb-3 mt-3">
                                      <label class="form-label">Gaji</label>
                                      <input class="form-control" type="number" name="gaji" placeholder="Gaji" value="'.$show->gaji.'">
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="mb-3 mt-3">
                                      <label class="form-label">Jabatan</label>
                                      <input class="form-control" type="text" name="jabatan" placeholder="Jabatan" value="'.$show->jabatan.'">
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="mb-3">
                                      <label class="form-label">Jenis Pekerjaan</label>
                                      <select name="jenis_pekerjaan" class="form-select">
                                        <option label="">- Pilih Jenis Pekerjaan -</option>
                                        <option value="Dalam Kampus" '.$dalam.'>Dalam Kampus</option>
                                        <option value="Luar Kampus" '.$luar.'>Luar Kampus</option>
                                      </select>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="mb-3 mt-3">
                                      <label class="form-label">Alamat</label>
                                      <textarea name="alamat" class="form-control" row="3">'.$show->alamat.'</textarea>
                                    </div>
                                  </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Ubah Pekerjaan</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>';

                      $btn = $btn."<a href='javascript:deleteDataPekerjaan(\"".$show->id."\", \"admin/profil\");' class='btn btn-danger'>Hapus</a>";

                      if ($show->tanggal_berhenti == "0000-00-00") {
                        $tanggal_berhenti = "Masih aktif";
                      } else {
                        $tanggal_berhenti = $CI->tgl_indo($show->tanggal_berhenti); 

                      }
                      echo "
                        <tr>
                          <td>".$show->nama_perusahaan."</td>
                          <td>".$CI->tgl_indo($show->tanggal_masuk)."</td>
                          <td>".$tanggal_berhenti."</td>
                          <td>".$show->gaji."</td>
                          <td>".$show->bergerak_bidang."</td>
                          <td>".$show->jabatan."</td>
                          <td>".$show->alamat."</td>
                          <td>".$btn."</td>
                        </tr>
                      ";
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="tab-pane fade  <?php if($tab == "jabatan") {echo "show active";} ?>" id="jabatan" role="tabpanel" aria-labelledby="jabatan-tab">
            <h5 class="mb-4 mt-4" style="text-align:center">Riwayat Jabatan</h5>
            <div class="mb-4">
              <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target=".add-modal-jabatan">Tambah Jabatan</button>
              <div class="modal fade add-modal-jabatan" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="myLargeModalLabel">Tambah Jabatan</h4>
                      <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form class="form theme-form" method="post" action="<?= base_url('admin/profil/post_jabatan/').$profil->id; ?>">
                        <?php
                          $CI =& get_instance();
                          if (validation_errors()) {
                        ?>
                          <div class="alert alert-danger dark alert-dismissible fade show m-20 m-b-0" role="alert">
                            <i data-feather="alert-triangle"></i>
                            <p><?= validation_errors(); ?></p>
                            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                        <?php
                          }
                        ?>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3 mt-3">
                              <label class="form-label">Nama Instansi</label>
                              <input class="form-control" type="text" name="instansi" placeholder="Nama Instansi">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="mb-3 mt-3">
                              <label class="form-label">Jabatan</label>
                              <input class="form-control" type="text" name="jabatan" placeholder="Jabatan">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3 mt-3">
                              <label class="form-label">Tanggal Mulai</label>
                              <div class="input-group">
                                <input class="datepicker-here form-control digits" name="tanggal_masuk" type="text" data-language="id">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="mb-3 mt-3">
                              <label class="form-label">Tanggal Selesai</label>
                              <div class="input-group">
                                <input class="datepicker-here form-control digits" name="tanggal_selesai" type="text" data-language="id">
                              </div>
                              <i>* Kosongkan bila masih menjabat</i>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3">
                              <label class="form-label">Jenis Jabatan</label>
                              <select name="jenis_jabatan" class="form-select">
                                <option label="">- Pilih Jenis Jabatan -</option>
                                <option value='Dalam Kampus'>Dalam Kampus</option>
                                <option value='Luar Kampus'>Luar Kampus</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="mb-3 mt-3">
                              <label class="form-label">Alamat</label>
                              <textarea name="alamat" class="form-control" row="3"></textarea>
                            </div>
                          </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Tambah Jabatan</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="display basic-1">
                <thead>
                  <tr>
                    <th>Nama Instansi</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Jabatan</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    foreach ($jabatan as $show) {
                      $dalam = "";
                      $luar = "";
                      switch ($show->jenis_jabatan) {
                        case 'Dalam Kampus':
                          $dalam = "selected";
                          break;
                        case 'Luar Kampus':
                          $luar = "selected";
                          break;
                        default:
                          # code...
                          break;
                      }
                      $btn = '<button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target=".edit-modal-jabatan-'.$show->id.'">Edit</button>
                      <div class="modal fade edit-modal-jabatan-'.$show->id.'" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title" id="myLargeModalLabel">Edit Jabatan</h4>
                              <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <form class="form theme-form" method="post" action="'.base_url('admin/profil/put_jabatan/').$show->id.'">';

                              if (validation_errors()) {
                                $btn = $btn.'<div class="alert alert-danger dark alert-dismissible fade show m-20 m-b-0" role="alert">
                                  <i data-feather="alert-triangle"></i>
                                  <p>'.validation_errors().'</p>
                                  <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>';
                              }
                      $btn = $btn.'<div class="row">
                                  <div class="col-md-6">
                                    <div class="mb-3 mt-3">
                                      <label class="form-label">Nama Instansi</label>
                                      <input class="form-control" type="text" name="instansi" placeholder="Nama Instansi" value="'.$show->instansi.'">
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="mb-3 mt-3">
                                      <label class="form-label">Jabatan</label>
                                      <input class="form-control" type="text" name="jabatan" placeholder="Jabatan" value="'.$show->jabatan.'">
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="mb-3 mt-3">
                                      <label class="form-label">Tanggal Mulai</label>
                                      <div class="input-group">
                                        <input class="datepicker-here form-control digits" name="tanggal_masuk" type="text" data-language="id" value="'.$CI->tgl_indo_1($show->tanggal_mulai).'">
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="mb-3 mt-3">
                                      <label class="form-label">Tanggal Selesai</label>
                                      <div class="input-group">
                                        <input class="datepicker-here form-control digits" name="tanggal_selesai" type="text" data-language="id" value="'.$CI->tgl_indo_1($show->tanggal_selesai).'">
                                      </div>
                                      <i>* Kosongkan bila masih menjabat</i>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="mb-3">
                                      <label class="form-label">Jenis Jabatan</label>
                                      <select name="jenis_jabatan" class="form-select">
                                        <option label="">- Pilih Jenis Jabatan -</option>
                                        <option value="Dalam Kampus" '.$dalam.'>Dalam Kampus</option>
                                        <option value="Luar Kampus" '.$luar.'>Luar Kampus</option>
                                      </select>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="mb-3 mt-3">
                                      <label class="form-label">Alamat</label>
                                      <textarea name="alamat" class="form-control" row="3">'.$show->alamat.'</textarea>
                                    </div>
                                  </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Ubah Jabatan</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>';

                      $btn = $btn."<a href='javascript:deleteDataJabatan(\"".$show->id."\", \"admin/profil\");' class='btn btn-danger'>Hapus</a>";

                      if ($show->tanggal_selesai == "0000-00-00") {
                        $tanggal_selesai = "Masih aktif";
                      } else {
                        $tanggal_selesai = $CI->tgl_indo($show->tanggal_selesai); 

                      }
                      echo "
                        <tr>
                          <td>".$show->instansi."</td>
                          <td>".$CI->tgl_indo($show->tanggal_mulai)."</td>
                          <td>".$tanggal_selesai."</td>
                          <td>".$show->jabatan."</td>
                          <td>".$show->alamat."</td>
                          <td>".$btn."</td>
                        </tr>
                      ";
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="tab-pane fade  <?php if($tab == "wirausaha") {echo "show active";} ?>" id="wirausaha" role="tabpanel" aria-labelledby="wirausaha-tab">
            <h5 class="mb-4 mt-4" style="text-align:center">Riwayat Wirausaha</h5>
            <div class="mb-4">
              <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target=".add-modal-wirausaha">Tambah Wirausaha</button>
              <div class="modal fade add-modal-wirausaha" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="myLargeModalLabel">Tambah Wirausaha</h4>
                      <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form class="form theme-form" method="post" action="<?= base_url('admin/profil/post_wirausaha/').$profil->id; ?>">
                        <?php
                          $CI =& get_instance();
                          if (validation_errors()) {
                        ?>
                          <div class="alert alert-danger dark alert-dismissible fade show m-20 m-b-0" role="alert">
                            <i data-feather="alert-triangle"></i>
                            <p><?= validation_errors(); ?></p>
                            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                        <?php
                          }
                        ?>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3 mt-3">
                              <label class="form-label">Nama Usaha</label>
                              <input class="form-control" type="text" name="nama_usaha" placeholder="Nama Usaha">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="mb-3 mt-3">
                              <label class="form-label">Jenis Usaha</label>
                              <input class="form-control" type="text" name="jenis_usaha" placeholder="Jenis Usaha">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3 mt-3">
                              <label class="form-label">Tanggal Mulai</label>
                              <div class="input-group">
                                <input class="datepicker-here form-control digits" name="tanggal_mulai" type="text" data-language="id">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="mb-3 mt-3">
                              <label class="form-label">Tanggal Selesai</label>
                              <div class="input-group">
                                <input class="datepicker-here form-control digits" name="tanggal_selesai" type="text" data-language="id">
                              </div>
                              <i>* Kosongkan bila masih menjalankan usaha</i>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3 mt-3">
                              <label class="form-label">Rata-rata Omset</label>
                              <input class="form-control" type="number" name="rata_rata_omset" placeholder="Rata-rata Omset">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="mb-3 mt-3">
                              <label class="form-label">Alamat Usaha</label>
                              <textarea name="alamat_usaha" class="form-control" row="3"></textarea>
                            </div>
                          </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Tambah Wirausaha</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="display basic-1">
                <thead>
                  <tr>
                    <th>Nama Usaha</th>
                    <th>Jenis Usaha</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Rata-rata Omset</th>
                    <th>Alamat Usaha</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    foreach ($wirausaha as $show) {
                      $btn = '<button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target=".edit-modal-wirausaha-'.$show->id.'">Edit</button>
                      <div class="modal fade edit-modal-wirausaha-'.$show->id.'" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title" id="myLargeModalLabel">Edit Wirausaha</h4>
                              <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <form class="form theme-form" method="post" action="'.base_url('admin/profil/put_wirausaha/').$show->id.'">';

                              if (validation_errors()) {
                                $btn = $btn.'<div class="alert alert-danger dark alert-dismissible fade show m-20 m-b-0" role="alert">
                                  <i data-feather="alert-triangle"></i>
                                  <p>'.validation_errors().'</p>
                                  <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>';
                              }
                      $btn = $btn.'<div class="row">
                                  <div class="col-md-6">
                                    <div class="mb-3 mt-3">
                                      <label class="form-label">Nama Usaha</label>
                                      <input class="form-control" type="text" name="nama_usaha" placeholder="Nama Usaha"  value="'.$show->nama_usaha.'">
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="mb-3 mt-3">
                                      <label class="form-label">Jenis Usaha</label>
                                      <input class="form-control" type="text" name="jenis_usaha" placeholder="Jenis Usaha" value="'.$show->jenis_usaha.'">
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="mb-3 mt-3">
                                      <label class="form-label">Tanggal Mulai</label>
                                      <div class="input-group">
                                        <input class="datepicker-here form-control digits" name="tanggal_mulai" type="text" data-language="id"  value="'.$CI->tgl_indo_1($show->tanggal_mulai).'">
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="mb-3 mt-3">
                                      <label class="form-label">Tanggal Selesai</label>
                                      <div class="input-group">
                                        <input class="datepicker-here form-control digits" name="tanggal_selesai" type="text" data-language="id"  value="'.$CI->tgl_indo_1($show->tanggal_selesai).'">
                                      </div>
                                      <i>* Kosongkan bila masih menjalankan usaha</i>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="mb-3 mt-3">
                                      <label class="form-label">Rata-rata Omset</label>
                                      <input class="form-control" type="number" name="rata_rata_omset" placeholder="Rata-rata Omset" value="'.$show->rata_rata_omset.'">
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="mb-3 mt-3">
                                      <label class="form-label">Alamat Usaha</label>
                                      <textarea name="alamat_usaha" class="form-control" row="3">'.$show->alamat_usaha.'</textarea>
                                    </div>
                                  </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Ubah Wirausaha</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>';

                      $btn = $btn."<a href='javascript:deleteDataWirausaha(\"".$show->id."\", \"admin/profil\");' class='btn btn-danger'>Hapus</a>";

                      if ($show->tanggal_selesai == "0000-00-00") {
                        $tanggal_selesai = "Masih aktif";
                      } else {
                        $tanggal_selesai = $CI->tgl_indo($show->tanggal_selesai); 

                      }
                      echo "
                        <tr>
                          <td>".$show->nama_usaha."</td>
                          <td>".$show->jenis_usaha."</td>
                          <td>".$CI->tgl_indo($show->tanggal_mulai)."</td>
                          <td>".$tanggal_selesai."</td>
                          <td>".$show->rata_rata_omset."</td>
                          <td>".$show->alamat_usaha."</td>
                          <td>".$btn."</td>
                        </tr>
                      ";
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="tab-pane fade  <?php if($tab == "seminar") {echo "show active";} ?>" id="seminar" role="tabpanel" aria-labelledby="seminar-tab">
            <h5 class="mb-4 mt-4" style="text-align:center">Riwayat Seminar/Pelatihan/Sertifikasi</h5>
            <div class="mb-4">
              <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target=".add-modal-seminar">Tambah Seminar</button>
              <div class="modal fade add-modal-seminar" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="myLargeModalLabel">Tambah Seminar</h4>
                      <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form class="form theme-form" method="post" action="<?= base_url('admin/profil/post_seminar/').$profil->id; ?>">
                        <?php
                          $CI =& get_instance();
                          if (validation_errors()) {
                        ?>
                          <div class="alert alert-danger dark alert-dismissible fade show m-20 m-b-0" role="alert">
                            <i data-feather="alert-triangle"></i>
                            <p><?= validation_errors(); ?></p>
                            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                        <?php
                          }
                        ?>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3 mt-3">
                              <label class="form-label">Nama Kegiatan</label>
                              <input class="form-control" type="text" name="nama_kegiatan" placeholder="Nama Kegiatan">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="mb-3 mt-3">
                              <label class="form-label">Pelaksana Kegiatan</label>
                              <input class="form-control" type="text" name="pelaksana_kegiatan" placeholder="Pelaksana Kegiatan">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3 mt-3">
                              <label class="form-label">Jenis Kegiatan</label>
                              <input class="form-control" type="text" name="jenis_kegiatan" placeholder="Jenis Kegiatan">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="mb-3 mt-3">
                              <label class="form-label">Tingkat Kegiatan</label>
                              <select name="tingkat_kegiatan" class="form-select">
                                <option label="" value="">- Pilih Tingkat Kegiatan -</option>
                                <option value='Lokal'>Lokal</option>
                                <option value='Regional'>Regional</option>
                                <option value='Nasional'>Nasional</option>
                                <option value='Internasional'>Internasional</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3 mt-3">
                              <label class="form-label">Tanggal Mulai</label>
                              <div class="input-group">
                                <input class="datepicker-here form-control digits" name="tanggal_mulai" type="text" data-language="id">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="mb-3 mt-3">
                              <label class="form-label">Tanggal Selesai</label>
                              <div class="input-group">
                                <input class="datepicker-here form-control digits" name="tanggal_selesai" type="text" data-language="id">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3 mt-3">
                              <label class="form-label">Peran</label>
                              <select name="peran" class="form-select">
                                <option label="" value="">- Pilih Peran -</option>
                                <option value='Peserta'>Peserta</option>
                                <option value='Panitia'>Panitia</option>
                                <option value='Moderator'>Moderator</option>
                                <option value='Pemateri'>Pemateri</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="mb-3 mt-3">
                              <label class="form-label">Keterangan</label>
                              <textarea name="keterangan" class="form-control" row="3"></textarea>
                            </div>
                          </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Tambah Seminar</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="display basic-1">
                <thead>
                  <tr>
                    <th>Nama Kegiatan</th>
                    <th>Pelaksana Kegiatan</th>
                    <th>Jenis Kegiatan</th>
                    <th>Tingkat Kegiatan</th>
                    <th>Peran</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    foreach ($seminar as $show) {
                      $peserta = "";
                      $panitia = "";
                      $moderator = "";
                      $pemateri = "";
                      switch ($show->peran) {
                        case 'Peserta':
                          $peserta = "selected";
                          break;
                        case 'Panitia':
                          $panitia = "selected";
                          break;
                        case 'Moderator':
                          $moderator = "selected";
                          break;
                        case 'Pemateri':
                          $pemateri = "selected";
                          break;
                        default:
                          # code...
                          break;
                      }

                      $lokal = "";
                      $regional = "";
                      $nasional = "";
                      $internasional = "";
                      switch ($show->tingkat_kegiatan) {
                        case 'Lokal':
                          $lokal = "selected";
                          break;
                        case 'Regional':
                          $regional = "selected";
                          break;
                        case 'Nasional':
                          $nasional = "selected";
                          break;
                        case 'Internasional':
                          $internasional = "selected";
                          break;
                        default:
                          # code...
                          break;
                      }
                      $btn = '<button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target=".edit-modal-seminar-'.$show->id.'">Edit</button>
                      <div class="modal fade edit-modal-seminar-'.$show->id.'" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title" id="myLargeModalLabel">Edit Seminar</h4>
                              <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <form class="form theme-form" method="post" action="'.base_url('admin/profil/put_seminar/').$show->id.'">';

                              if (validation_errors()) {
                                $btn = $btn.'<div class="alert alert-danger dark alert-dismissible fade show m-20 m-b-0" role="alert">
                                  <i data-feather="alert-triangle"></i>
                                  <p>'.validation_errors().'</p>
                                  <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>';
                              }
                      $btn = $btn.'<div class="row">
                                  <div class="col-md-6">
                                    <div class="mb-3 mt-3">
                                      <label class="form-label">Nama Kegiatan</label>
                                      <input class="form-control" type="text" name="nama_kegiatan" placeholder="Nama Kegiatan"  value="'.$show->nama_kegiatan.'">
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="mb-3 mt-3">
                                      <label class="form-label">Pelaksana Kegiatan</label>
                                      <input class="form-control" type="text" name="pelaksana_kegiatan" placeholder="Pelaksana Kegiatan" value="'.$show->pelaksana_kegiatan.'">
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="mb-3 mt-3">
                                      <label class="form-label">Jenis Kegiatan</label>
                                      <input class="form-control" type="text" name="jenis_kegiatan" placeholder="Jenis Kegiatan"  value="'.$show->jenis_kegiatan.'">
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="mb-3 mt-3">
                                      <label class="form-label">Tingkat Kegiatan</label>
                                      <select name="tingkat_kegiatan" class="form-select">
                                        <option label="" value="">- Pilih Tingkat Kegiatan -</option>
                                        <option value="Lokal" '.$lokal.'>Lokal</option>
                                        <option value="Regional" '.$regional.'>Regional</option>
                                        <option value="Nasional" '.$nasional.'>Nasional</option>
                                        <option value="Internasional" '.$internasional.'>Internasional</option>
                                      </select>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="mb-3 mt-3">
                                      <label class="form-label">Tanggal Mulai</label>
                                      <div class="input-group">
                                        <input class="datepicker-here form-control digits" name="tanggal_mulai" type="text" data-language="id"  value="'.$CI->tgl_indo_1($show->tanggal_mulai).'">
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="mb-3 mt-3">
                                      <label class="form-label">Tanggal Selesai</label>
                                      <div class="input-group">
                                        <input class="datepicker-here form-control digits" name="tanggal_selesai" type="text" data-language="id"  value="'.$CI->tgl_indo_1($show->tanggal_selesai).'">
                                      </div>
                                      <i>* Kosongkan bila masih menjalankan usaha</i>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="mb-3 mt-3">
                                      <label class="form-label">Peran</label>
                                      <select name="peran" class="form-select">
                                        <option label="" value="">- Pilih Peran -</option>
                                        <option value="Peserta" '.$peserta.'>Peserta</option>
                                        <option value="Panitia" '.$panitia.'>Panitia</option>
                                        <option value="Moderator" '.$moderator.'>Moderator</option>
                                        <option value="Pemateri" '.$pemateri.'>Pemateri</option>
                                      </select>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="mb-3 mt-3">
                                      <label class="form-label">Keterangan</label>
                                      <textarea name="keterangan" class="form-control" row="3">'.$show->keterangan.'</textarea>
                                    </div>
                                  </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Ubah Seminar</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>';

                      $btn = $btn."<a href='javascript:deleteDataSeminar(\"".$show->id."\", \"admin/profil\");' class='btn btn-danger'>Hapus</a>";

                      if ($show->tanggal_selesai == "0000-00-00") {
                        $tanggal_selesai = "Masih aktif";
                      } else {
                        $tanggal_selesai = $CI->tgl_indo($show->tanggal_selesai); 

                      }
                      echo "
                        <tr>
                          <td>".$show->nama_kegiatan."</td>
                          <td>".$show->pelaksana_kegiatan."</td>
                          <td>".$show->jenis_kegiatan."</td>
                          <td>".$show->tingkat_kegiatan."</td>
                          <td>".$show->peran."</td>
                          <td>".$CI->tgl_indo($show->tanggal_mulai)."</td>
                          <td>".$tanggal_selesai."</td>
                          <td>".$show->keterangan."</td>
                          <td>".$btn."</td>
                        </tr>
                      ";
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="tab-pane fade  <?php if($tab == "prestasi") {echo "show active";} ?>" id="prestasi" role="tabpanel" aria-labelledby="prestasi-tab">
            <h5 class="mb-4 mt-4" style="text-align:center">Riwayat Prestasi/Hibah</h5>
            <div class="mb-4">
              <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target=".add-modal-prestasi">Tambah Prestasi</button>
              <div class="modal fade add-modal-prestasi" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="myLargeModalLabel">Tambah Prestasi</h4>
                      <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form class="form theme-form" method="post" action="<?= base_url('admin/profil/post_prestasi/').$profil->id; ?>">
                        <?php
                          $CI =& get_instance();
                          if (validation_errors()) {
                        ?>
                          <div class="alert alert-danger dark alert-dismissible fade show m-20 m-b-0" role="alert">
                            <i data-feather="alert-triangle"></i>
                            <p><?= validation_errors(); ?></p>
                            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                        <?php
                          }
                        ?>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3 mt-3">
                              <label class="form-label">Nama Kegiatan</label>
                              <input class="form-control" type="text" name="nama_kegiatan" placeholder="Nama Kegiatan">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="mb-3 mt-3">
                              <label class="form-label">Nama Pelaksana</label>
                              <input class="form-control" type="text" name="nama_pelaksana" placeholder="Pelaksana Kegiatan">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3 mt-3">
                              <label class="form-label">Tingkat Kegiatan</label>
                              <select name="tingkat_kegiatan" class="form-select">
                                <option label="" value="">- Pilih Tingkat Kegiatan -</option>
                                <option value='Lokal'>Lokal</option>
                                <option value='Regional'>Regional</option>
                                <option value='Nasional'>Nasional</option>
                                <option value='Internasional'>Internasional</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="mb-3 mt-3">
                              <label class="form-label">Nama Pembimbing/Anggota lainnya</label>
                              <input class="form-control" type="text" name="nama_pembimbing" placeholder="Nama Pembimbing/Anggota lainnya">
                              <i>* Jika lebih dari satu orang pisahkan dengan ";" (titik koma)</i>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3 mt-3">
                              <label class="form-label">Dana yang diterima</label>
                              <input class="form-control" type="number" name="dana_diterima" placeholder="Dana yang diterima" value="0">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="mb-3 mt-3">
                              <label class="form-label">Keterangan</label>
                              <textarea name="keterangan" class="form-control" row="3"></textarea>
                            </div>
                          </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Tambah Prestasi</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="display basic-1">
                <thead>
                  <tr>
                    <th>Nama Kegiatan</th>
                    <th>Nama Pelaksana</th>
                    <th>Tingkat Kegiatan</th>
                    <th>Nama Pembimbing/Anggota Lainnya</th>
                    <th>Dana Diterima</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    foreach ($prestasi as $show) {
                      $lokal = "";
                      $regional = "";
                      $nasional = "";
                      $internasional = "";
                      switch ($show->tingkat_kegiatan) {
                        case 'Lokal':
                          $lokal = "selected";
                          break;
                        case 'Regional':
                          $regional = "selected";
                          break;
                        case 'Nasional':
                          $nasional = "selected";
                          break;
                        case 'Internasional':
                          $internasional = "selected";
                          break;
                        default:
                          # code...
                          break;
                      }
                      $btn = '<button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target=".edit-modal-prestasi-'.$show->id.'">Edit</button>
                      <div class="modal fade edit-modal-prestasi-'.$show->id.'" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title" id="myLargeModalLabel">Edit Prestasi</h4>
                              <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <form class="form theme-form" method="post" action="'.base_url('admin/profil/put_prestasi/').$show->id.'">';

                              if (validation_errors()) {
                                $btn = $btn.'<div class="alert alert-danger dark alert-dismissible fade show m-20 m-b-0" role="alert">
                                  <i data-feather="alert-triangle"></i>
                                  <p>'.validation_errors().'</p>
                                  <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>';
                              }
                      $btn = $btn.'<div class="row">
                                  <div class="col-md-6">
                                    <div class="mb-3 mt-3">
                                      <label class="form-label">Nama Kegiatan</label>
                                      <input class="form-control" type="text" name="nama_kegiatan" placeholder="Nama Kegiatan" value="'.$show->nama_kegiatan.'">
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="mb-3 mt-3">
                                      <label class="form-label">Nama Pelaksana</label>
                                      <input class="form-control" type="text" name="nama_pelaksana" placeholder="Pelaksana Kegiatan" value="'.$show->nama_pelaksana.'">
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="mb-3 mt-3">
                                      <label class="form-label">Tingkat Kegiatan</label>
                                      <select name="tingkat_kegiatan" class="form-select">
                                        <option label="" value="">- Pilih Tingkat Kegiatan -</option>
                                        <option value="Lokal" '.$lokal.'>Lokal</option>
                                        <option value="Regional" '.$regional.'>Regional</option>
                                        <option value="Nasional" '.$nasional.'>Nasional</option>
                                        <option value="Internasional" '.$internasional.'>Internasional</option>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="mb-3 mt-3">
                                      <label class="form-label">Nama Pembimbing/Anggota lainnya</label>
                                      <input class="form-control" type="text" name="nama_pembimbing" placeholder="Nama Pembimbing/Anggota lainnya" value="'.$show->nama_pembimbing.'">
                                      <i>* Jika lebih dari satu orang pisahkan dengan ";" (titik koma)</i>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="mb-3 mt-3">
                                      <label class="form-label">Dana yang diterima</label>
                                      <input class="form-control" type="number" name="dana_diterima" placeholder="Dana yang diterima" value="'.$show->dana_diterima.'">
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="mb-3 mt-3">
                                      <label class="form-label">Keterangan</label>
                                      <textarea name="keterangan" class="form-control" row="3">'.$show->keterangan.'</textarea>
                                    </div>
                                  </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Ubah Prestasi</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>';

                      $btn = $btn."<a href='javascript:deleteDataPrestasi(\"".$show->id."\", \"admin/profil\");' class='btn btn-danger'>Hapus</a>";

                      echo "
                        <tr>
                          <td>".$show->nama_kegiatan."</td>
                          <td>".$show->nama_pelaksana."</td>
                          <td>".$show->tingkat_kegiatan."</td>
                          <td>".$show->nama_pembimbing."</td>
                          <td>".$show->dana_diterima."</td>
                          <td>".$show->keterangan."</td>
                          <td>".$btn."</td>
                        </tr>
                      ";
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="tab-pane fade  <?php if($tab == "karya-ilmiah") {echo "show active";} ?>" id="karya-ilmiah" role="tabpanel" aria-labelledby="karya-ilmiah-tab">
            <h5 class="mb-4 mt-4" style="text-align:center">Riwayat Karya Ilmiah</h5>
            <div class="mb-4">
              <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target=".add-modal-karya-ilmiah">Tambah Karya Ilmiah</button>
              <div class="modal fade add-modal-karya-ilmiah" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="myLargeModalLabel">Tambah Karya Ilmiah</h4>
                      <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form class="form theme-form" method="post" action="<?= base_url('admin/profil/post_karya_ilmiah/').$profil->id; ?>">
                        <?php
                          $CI =& get_instance();
                          if (validation_errors()) {
                        ?>
                          <div class="alert alert-danger dark alert-dismissible fade show m-20 m-b-0" role="alert">
                            <i data-feather="alert-triangle"></i>
                            <p><?= validation_errors(); ?></p>
                            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                        <?php
                          }
                        ?>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3 mt-3">
                              <label class="form-label">Judul Karya Ilmiah</label>
                              <input class="form-control" type="text" name="judul_karya_ilmiah" placeholder="Judul Karya Ilmiah">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="mb-3 mt-3">
                              <label class="form-label">Jenis Karya Ilmiah</label>
                              <select name="jenis_karya_ilmiah" class="form-select">
                                <option label="" value="">- Pilih Jenis Karya Ilmiah -</option>
                                <option value='Buku'>Buku</option>
                                <option value='Chapter'>Chapter</option>
                                <option value='Artikel'>Artikel</option>
                                <option value='HAKI'>HAKI</option>
                                <option value='Bahan Ajar'>Bahan Ajar</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3 mt-3">
                              <label class="form-label">Jenis Luaran</label>
                              <select name="jenis_luaran" class="form-select">
                                <option label="" value="">- Pilih Jenis Luaran -</option>
                                <option value='Penelitian'>Penelitian</option>
                                <option value='Pengabdian'>Pengabdian</option>
                                <option value='Lainnya'>Lainnya</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="mb-3 mt-3">
                              <label class="form-label">Nama Jurnal/Penerbit</label>
                              <input class="form-control" type="text" name="nama_jurnal" placeholder="Nama Jurnal/Penerbit">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3 mt-3">
                              <label class="form-label">Tahun</label>
                              <input class="form-control" type="number" name="tahun" placeholder="Tahun">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="mb-3 mt-3">
                              <label class="form-label">Edisi</label>
                              <input class="form-control" type="text" name="edisi" placeholder="Edisi">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3 mt-3">
                              <label class="form-label">Halaman</label>
                              <input class="form-control" type="text" name="halaman" placeholder="Halaman">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="mb-3 mt-3">
                              <label class="form-label">Sumber Dana</label>
                              <input class="form-control" type="text" name="sumber_dana" placeholder="Sumber Dana">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3 mt-3">
                              <label class="form-label">Peran</label>
                              <select name="peran" class="form-select">
                                <option label="" value="">- Pilih peran -</option>
                                <option value='Ketua'>Ketua</option>
                                <option value='Korespondesi'>Korespondesi</option>
                                <option value='Ketua sekaligus Korespondensi'>Ketua sekaligus Korespondensi</option>
                                <option value='Anggota'>Anggota</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="mb-3 mt-3">
                              <label class="form-label">Alamat URL Karya Ilmiah</label>
                              <input class="form-control" type="text" name="alamat_url_karya_ilmiah" placeholder="Alamat URL Karya Ilmiah">
                            </div>
                          </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Tambah Karya Ilmiah</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="display basic-1">
                <thead>
                  <tr>
                    <th>Judul Karya Ilmiah</th>
                    <th>Jenis Karya Ilmiah</th>
                    <th>Jenis Luaran</th>
                    <th>Peran</th>
                    <th>Nama Jurnal/Penerbit</th>
                    <th>Tahun</th>
                    <th>Edisi</th>
                    <th>Halaman</th>
                    <th>Sumber Dana</th>
                    <th>Alamat Url Karya Ilmiah</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    foreach ($karya_ilmiah as $show) {
                      $buku = "";
                      $chapter = "";
                      $artikel = "";
                      $haki = "";
                      $ajar = "";
                      switch ($show->jenis_karya_ilmiah) {
                        case 'Buku':
                          $buku = "selected";
                          break;
                        case 'Chapter':
                          $chapter = "selected";
                          break;
                        case 'Artikel':
                          $artikel = "selected";
                          break;
                        case 'HAKI':
                          $haki = "selected";
                          break;
                        case 'Bahan Ajar':
                          $ajar = "selected";
                          break;
                        default:
                          # code...
                          break;
                      }

                      $ketua = "";
                      $korespondesi = "";
                      $ketua_korespondesi = "";
                      $anggota = "";
                      switch ($show->peran) {
                        case 'Ketua':
                          $ketua = "selected";
                          break;
                        case 'Korespondesi':
                          $korespondesi = "selected";
                          break;
                        case 'Ketua sekaligus Korespondensi':
                          $ketua_korespondesi = "selected";
                          break;
                        case 'Anggota':
                          $anggota = "selected";
                          break;
                        default:
                          # code...
                          break;
                      }

                      $penelitian = "";
                      $pengabdian = "";
                      $lainnya = "";
                      switch ($show->jenis_luaran) {
                        case 'Penelitian':
                          $penelitian = "selected";
                          break;
                        case 'Pengabdian':
                          $pengabdian = "selected";
                          break;
                        case 'Lainnya':
                          $lainnya = "selected";
                          break;
                        default:
                          # code...
                          break;
                      }

                      $btn = '<button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target=".edit-modal-karya-ilmiah-'.$show->id.'">Edit</button>
                      <div class="modal fade edit-modal-karya-ilmiah-'.$show->id.'" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title" id="myLargeModalLabel">Edit Karya Ilmiah</h4>
                              <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <form class="form theme-form" method="post" action="'.base_url('admin/profil/put_karya_ilmiah/').$show->id.'">';

                              if (validation_errors()) {
                                $btn = $btn.'<div class="alert alert-danger dark alert-dismissible fade show m-20 m-b-0" role="alert">
                                  <i data-feather="alert-triangle"></i>
                                  <p>'.validation_errors().'</p>
                                  <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>';
                              }
                      $btn = $btn.'<div class="row">
                                  <div class="col-md-6">
                                    <div class="mb-3 mt-3">
                                      <label class="form-label">Judul Karya Ilmiah</label>
                                      <input class="form-control" type="text" name="judul_karya_ilmiah" placeholder="Judul Karya Ilmiah" value="'.$show->judul_karya_ilmiah.'">
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="mb-3 mt-3">
                                      <label class="form-label">Jenis Karya Ilmiah</label>
                                      <select name="jenis_karya_ilmiah" class="form-select">
                                        <option label="" value="">- Pilih Jenis Karya Ilmiah -</option>
                                        <option value="Buku" '.$buku.'>Buku</option>
                                        <option value="Chapter" '.$chapter.'>Chapter</option>
                                        <option value="Artikel" '.$artikel.'>Artikel</option>
                                        <option value="HAKI" '.$haki.'>HAKI</option>
                                        <option value="Bahan Ajar" '.$ajar.'>Bahan Ajar</option>
                                      </select>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="mb-3 mt-3">
                                      <label class="form-label">Jenis Luaran</label>
                                      <select name="jenis_luaran" class="form-select">
                                        <option label="" value="">- Pilih Jenis Luaran -</option>
                                        <option value="Penelitian" '.$penelitian.'>Penelitian</option>
                                        <option value="Pengabdian" '.$pengabdian.'>Pengabdian</option>
                                        <option value="Lainnya" '.$lainnya.'>Lainnya</option>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="mb-3 mt-3">
                                      <label class="form-label">Nama Jurnal/Penerbit</label>
                                      <input class="form-control" type="text" name="nama_jurnal" placeholder="Nama Jurnal/Penerbit" value="'.$show->nama_jurnal.'">
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="mb-3 mt-3">
                                      <label class="form-label">Tahun</label>
                                      <input class="form-control" type="number" name="tahun" placeholder="Tahun" value="'.$show->tahun.'">
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="mb-3 mt-3">
                                      <label class="form-label">Edisi</label>
                                      <input class="form-control" type="text" name="edisi" placeholder="Edisi" value="'.$show->edisi.'">
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="mb-3 mt-3">
                                      <label class="form-label">Halaman</label>
                                      <input class="form-control" type="text" name="halaman" placeholder="Halaman" value="'.$show->halaman.'">
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="mb-3 mt-3">
                                      <label class="form-label">Sumber Dana</label>
                                      <input class="form-control" type="text" name="sumber_dana" placeholder="Sumber Dana" value="'.$show->sumber_dana.'">
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="mb-3 mt-3">
                                      <label class="form-label">Peran</label>
                                      <select name="peran" class="form-select">
                                        <option label="" value="">- Pilih peran -</option>
                                        <option value="Ketua" '.$ketua.'>Ketua</option>
                                        <option value="Korespondesi" '.$korespondesi.'>Korespondesi</option>
                                        <option value="Ketua sekaligus Korespondensi" '.$ketua_korespondesi.'>Ketua sekaligus Korespondensi</option>
                                        <option value="Anggota" '.$anggota.'>Anggota</option>
                                      </select>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="mb-3 mt-3">
                                      <label class="form-label">Alamat URL Karya Ilmiah</label>
                                      <input class="form-control" type="text" name="alamat_url_karya_ilmiah" placeholder="Alamat URL Karya Ilmiah" value="'.$show->alamat_url_karya_ilmiah.'">
                                    </div>
                                  </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Ubah Karya Ilmiah</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>';

                      $btn = $btn."<a href='javascript:deleteDataKaryaIlmiah(\"".$show->id."\", \"admin/profil\");' class='btn btn-danger'>Hapus</a>";

                      echo "
                        <tr>
                          <td>".$show->judul_karya_ilmiah."</td>
                          <td>".$show->jenis_karya_ilmiah."</td>
                          <td>".$show->jenis_luaran."</td>
                          <td>".$show->peran."</td>
                          <td>".$show->nama_jurnal."</td>
                          <td>".$show->tahun."</td>
                          <td>".$show->edisi."</td>
                          <td>".$show->halaman."</td>
                          <td>".$show->sumber_dana."</td>
                          <td>".$show->alamat_url_karya_ilmiah."</td>
                          <td>".$btn."</td>
                        </tr>
                      ";
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="tab-pane fade  <?php if($tab == "organisasi") {echo "show active";} ?>" id="organisasi" role="tabpanel" aria-labelledby="organisasi-tab">
            <h5 class="mb-4 mt-4" style="text-align:center">Riwayat Organisasi</h5>
            <div class="mb-4">
              <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target=".add-modal-organisasi">Tambah Organisasi</button>
              <div class="modal fade add-modal-organisasi" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="myLargeModalLabel">Tambah Organisasi</h4>
                      <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form class="form theme-form" method="post" action="<?= base_url('admin/profil/post_organisasi/').$profil->id; ?>">
                        <?php
                          $CI =& get_instance();
                          if (validation_errors()) {
                        ?>
                          <div class="alert alert-danger dark alert-dismissible fade show m-20 m-b-0" role="alert">
                            <i data-feather="alert-triangle"></i>
                            <p><?= validation_errors(); ?></p>
                            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                        <?php
                          }
                        ?>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3 mt-3">
                              <label class="form-label">Nama Lembaga</label>
                              <input class="form-control" type="text" name="nama_lembaga" placeholder="Nama Lembaga">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="mb-3 mt-3">
                              <label class="form-label">Jabatan</label>
                              <input class="form-control" type="text" name="jabatan" placeholder="Jabatan">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3 mt-3">
                              <label class="form-label">Tanggal Bergabung</label>
                              <div class="input-group">
                                <input class="datepicker-here form-control digits" name="tanggal_bergabung" type="text" data-language="id">
                              </div>
                            </div>
                          </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Tambah Organisasi</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="display basic-1">
                <thead>
                  <tr>
                    <th>Nama Lembaga</th>
                    <th>Jabatan</th>
                    <th>Tanggal Bergabung</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    foreach ($organisasi as $show) {
                      $btn = '<button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target=".edit-modal-organisasi-'.$show->id.'">Edit</button>
                      <div class="modal fade edit-modal-organisasi-'.$show->id.'" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title" id="myLargeModalLabel">Edit Organisasi</h4>
                              <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <form class="form theme-form" method="post" action="'.base_url('admin/profil/put_organisasi/').$show->id.'">';

                              if (validation_errors()) {
                                $btn = $btn.'<div class="alert alert-danger dark alert-dismissible fade show m-20 m-b-0" role="alert">
                                  <i data-feather="alert-triangle"></i>
                                  <p>'.validation_errors().'</p>
                                  <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>';
                              }
                      $btn = $btn.'<div class="row">
                                  <div class="col-md-6">
                                    <div class="mb-3 mt-3">
                                      <label class="form-label">Nama Lembaga</label>
                                      <input class="form-control" type="text" name="nama_lembaga" value="'.$show->nama_lembaga.'" placeholder="Nama Lembaga">
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="mb-3 mt-3">
                                      <label class="form-label">Jabatan</label>
                                      <input class="form-control" type="text" name="jabatan" value="'.$show->jabatan.'" placeholder="Jabatan">
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="mb-3 mt-3">
                                      <label class="form-label">Tanggal Bergabung</label>
                                      <div class="input-group">
                                        <input class="datepicker-here form-control digits" name="tanggal_bergabung" value="'.$CI->tgl_indo_1($show->tanggal_bergabung).'" type="text" data-language="id">
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Ubah Organisasi</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>';

                      $btn = $btn."<a href='javascript:deleteDataOrganisasi(\"".$show->id."\", \"admin/profil\");' class='btn btn-danger'>Hapus</a>";

                      echo "
                        <tr>
                          <td>".$show->nama_lembaga."</td>
                          <td>".$show->jabatan."</td>
                          <td>".$CI->tgl_indo($show->tanggal_bergabung)."</td>
                          <td>".$btn."</td>
                        </tr>
                      ";
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="tab-pane fade <?php if($tab == "setting") {echo "show active";} ?>" id="setting" role="tabpanel" aria-labelledby="biodata-tab">
            <h5 class="mb-4 mt-4" style="text-align:center">Setting</h5>
            <form class="form theme-form" method="post" action="<?= base_url('admin/profil/setting/').$profil->id; ?>">
              <?php
                $CI =& get_instance();
                if (validation_errors()) {
              ?>
                <div class="alert alert-danger dark alert-dismissible fade show m-20 m-b-0" role="alert">
                  <i data-feather="alert-triangle"></i>
                  <p><?= validation_errors(); ?></p>
                  <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              <?php
                } elseif (isset($error)) {
              ?>
                <div class="alert alert-danger dark alert-dismissible fade show m-20 m-b-0" role="alert">
                  <i data-feather="alert-triangle"></i>
                  <p><?= $error; ?></p>
                  <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              <?php
                }
              ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3 mt-3">
                    <label class="form-label">Password Lama</label>
                    <input class="form-control" type="password" name="old_password" placeholder="Password Lama">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3 mt-3">
                    <label class="form-label">Password Baru</label>
                    <input class="form-control" type="password" name="new_password" placeholder="Password Baru">
                  </div>
                </div>
              </div>
              <button class="btn btn-primary" type="submit">Perbarui Data</button>
            </form>
          </div>
          <div class="tab-pane fade <?php if($tab == "download") {echo "show active";} ?>" id="download" role="tabpanel" aria-labelledby="biodata-tab">
            <h5 class="mb-4 mt-4" style="text-align:center">Download CV</h5>
            <form class="form theme-form" method="post" action="<?= base_url('admin/profil/download/').$profil->id; ?>">
              <?php
                $CI =& get_instance();
                if (validation_errors()) {
              ?>
                <div class="alert alert-danger dark alert-dismissible fade show m-20 m-b-0" role="alert">
                  <i data-feather="alert-triangle"></i>
                  <p><?= validation_errors(); ?></p>
                  <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              <?php
                } elseif (isset($error)) {
              ?>
                <div class="alert alert-danger dark alert-dismissible fade show m-20 m-b-0" role="alert">
                  <i data-feather="alert-triangle"></i>
                  <p><?= $error; ?></p>
                  <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              <?php
                }
              ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3 mt-3">
                    <input class="form-check-input" type="checkbox" name="pendidikan" value="pendidikan">
                    <label class="form-check-label" >Riwayat Pendidikan</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3 mt-3">
                    <input class="form-check-input" type="checkbox" name="pekerjaan" value="pekerjaan">
                    <label class="form-check-label" >Riwayat Pekerjaan</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3 mt-3">
                    <input class="form-check-input" type="checkbox" name="jabatan" value="jabatan">
                    <label class="form-check-label" >Riwayat Jabatan</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3 mt-3">
                    <input class="form-check-input" type="checkbox" name="wirausaha" value="wirausaha">
                    <label class="form-check-label" >Riwayat Wirausaha</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3 mt-3">
                    <input class="form-check-input" type="checkbox" name="seminar" value="seminar">
                    <label class="form-check-label" >Riwayat Seminar/Pelatihan/Sertifikasi</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3 mt-3">
                    <input class="form-check-input" type="checkbox" name="prestasi" value="prestasi">
                    <label class="form-check-label" >Riwayat Prestasi/Hibah</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3 mt-3">
                    <input class="form-check-input" type="checkbox" name="karya_ilmiah" value="karya_ilmiah">
                    <label class="form-check-label" >Riwayat Karya Ilmiah</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3 mt-3">
                    <input class="form-check-input" type="checkbox" name="organisasi" value="organisasi">
                    <label class="form-check-label" >Riwayat Organisasi</label>
                  </div>
                </div>
              </div>
              <button class="btn btn-primary" type="submit">Download CV</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Container-fluid Ends-->
</div>