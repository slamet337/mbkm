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
        <h5>Profil Mitra</span>
      </div>
      <div class="card-body">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item"><a class="nav-link  <?php if($tab == "data_mitra") {echo "active";} ?>" id="data_mitra-tab" data-bs-toggle="tab" href="#data_mitra" role="tab" aria-controls="data_mitra" aria-selected="true">Data Mitra</a></li>
          <li class="nav-item"><a class="nav-link  <?php if($tab == "contact-person") {echo "active";} ?>" id="contact-person-tab" data-bs-toggle="tab" href="#contact-person" role="tab" aria-controls="contact-person" aria-selected="false">Contact Person</a></li>
          <li class="nav-item"><a class="nav-link  <?php if($tab == "perjanjian_kerjasama") {echo "active";} ?>" id="perjanjian_kerjasama-tab" data-bs-toggle="tab" href="#perjanjian_kerjasama" role="tab" aria-controls="perjanjian_kerjasama" aria-selected="false">Perjanjian Kerjasama</a></li>
          <li class="nav-item"><a class="nav-link  <?php if($tab == "setting") {echo "active";} ?>" id="setting-tab" data-bs-toggle="tab" href="#setting" role="tab" aria-controls="setting" aria-selected="false">Setting</a></li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade <?php if($tab == "data_mitra") {echo "show active";} ?>" id="data_mitra" role="tabpanel" aria-labelledby="data_mitra-tab">
            <h5 class="mb-4 mt-4" style="text-align:center">Data Mitra </h5>
            <form class="form theme-form" method="post" action="<?= base_url('admin/profil_mitra/update/').$profil->id; ?>">
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
                    <label class="form-label">Nama Mitra</label>
                    <input class="form-control" type="text" name="nama_mitra" placeholder="Nama Mitra" value="<?= $profil->nama_mitra ?>" >
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3 mt-3">
                    <label class="form-label">Kriteria Mitra</label>
                    <select name="kriteria_mitra" class="form-select">
                      <option label="">- Pilih Kriteria Mitra -</option>
                      <option value='Kementerian/Lembaga Negara' <?php if($profil->kriteria_mitra == 'Kementerian/Lembaga Negara') { echo "selected"; } ?>>Kementerian/Lembaga Negara</option>
                      <option value='Pemerintah Provinsi' <?php if($profil->kriteria_mitra == 'Pemerintah Provinsi') { echo "selected"; } ?>>Pemerintah Provinsi</option>
                      <option value='Pemerintah Kota/Kabupaten' <?php if($profil->kriteria_mitra == 'Pemerintah Kota/Kabupaten') { echo "selected"; } ?>>Pemerintah Kota/Kabupaten</option>
                      <option value='Pemerintah Desa' <?php if($profil->kriteria_mitra == 'Pemerintah Desa') { echo "selected"; } ?>>Pemerintah Desa</option>
                      <option value='Universitas/Perguruan Tinggi (Dalam Negeri)' <?php if($profil->kriteria_mitra == 'Universitas/Perguruan Tinggi (Dalam Negeri)') { echo "selected"; } ?>>Universitas/Perguruan Tinggi (Dalam Negeri)</option>
                      <option value='Universitas/Perguruan Tinggi (Luar Negeri)' <?php if($profil->kriteria_mitra == 'Universitas/Perguruan Tinggi (Luar Negeri)') { echo "selected"; } ?>>Universitas/Perguruan Tinggi (Luar Negeri)</option>
                      <option value='Organisasi Nonlaba Internasional' <?php if($profil->kriteria_mitra == 'Organisasi Nonlaba Internasional') { echo "selected"; } ?>>Organisasi Nonlaba Internasional</option>
                      <option value='Organisasi Nonlaba Nasional/Lokal' <?php if($profil->kriteria_mitra == 'Organisasi Nonlaba Nasional/Lokal') { echo "selected"; } ?>>Organisasi Nonlaba Nasional/Lokal</option>
                      <option value='Lembaga/Organisasi Profesi' <?php if($profil->kriteria_mitra == 'Lembaga/Organisasi Profesi') { echo "selected"; } ?>>Lembaga/Organisasi Profesi</option>
                      <option value='Badan Usaha Milik Negara (BUMN)' <?php if($profil->kriteria_mitra == 'Badan Usaha Milik Negara (BUMN)') { echo "selected"; } ?>>Badan Usaha Milik Negara (BUMN)</option>
                      <option value='Badan Usaha Milik Daerah (BUMD)' <?php if($profil->kriteria_mitra == 'Badan Usaha Milik Daerah (BUMD)') { echo "selected"; } ?>>Badan Usaha Milik Daerah (BUMD)</option>
                      <option value='Badan Usaha Milik Desa (BUMDes)' <?php if($profil->kriteria_mitra == 'Badan Usaha Milik Desa (BUMDes)') { echo "selected"; } ?>>Badan Usaha Milik Desa (BUMDes)</option>
                      <option value='Perusahaan Multinasional' <?php if($profil->kriteria_mitra == 'Perusahaan Multinasional') { echo "selected"; } ?>>Perusahaan Multinasional</option>
                      <option value='Perusahaan Nasional' <?php if($profil->kriteria_mitra == 'Perusahaan Nasional') { echo "selected"; } ?>>Perusahaan Nasional</option>
                      <option value='Pelaku UMKM' <?php if($profil->kriteria_mitra == 'Pelaku UMKM') { echo "selected"; } ?>>Pelaku UMKM</option>
                      <option value='Asosiasi/Perhimpunan Pengusaha' <?php if($profil->kriteria_mitra == 'Asosiasi/Perhimpunan Pengusaha') { echo "selected"; } ?>>Asosiasi/Perhimpunan Pengusaha</option>
                      <option value='Lainnya' <?php if($profil->kriteria_mitra == 'Lainnya') { echo "selected"; } ?>>Lainnya</option>
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
                    <label class="form-label">Nomor HP Mitra</label>
                    <input class="form-control" type="text" name="phone_number" placeholder="Nomor HP" value="<?= $profil->phone_number ?>" >
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Berpartisi Dalam Penyusunan Kurikulum</label>
                    <select name="partisipasi_dalam_kurikulum" class="form-select">
                      <option label="">- Pilih Kriteria Mitra -</option>
                      <option value='Iya' <?php if($profil->partisipasi_dalam_kurikulum == 'Iya') { echo "selected"; } ?>>Iya</option>
                      <option value='Tidak' <?php if($profil->partisipasi_dalam_kurikulum == 'Tidak') { echo "selected"; } ?>>Tidak</option>\
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
          <div class="tab-pane fade <?php if($tab == "contact-person") {echo "show active";} ?>" id="contact-person" role="tabpanel" aria-labelledby="contact-person-tab">
            <h5 class="mb-4 mt-4" style="text-align:center">Contact Person </h5>
            <form class="form theme-form" method="post" action="<?= base_url('admin/profil_mitra/update_cp/').$profil->id; ?>">
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
                    <label class="form-label">Nama Kontak</label>
                    <input class="form-control" type="text" name="nama_cp" placeholder="Nama Kontak" value="<?= $profil->nama_cp ?>" >
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3 mt-3">
                    <label class="form-label">Jabatan</label>
                    <input class="form-control" type="text" name="jabatan_cp" placeholder="Jabatan" value="<?= $profil->jabatan_cp ?>" >
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Email Kontak</label>
                    <input class="form-control" type="email" name="email_cp" placeholder="Email Kontak" value="<?= $profil->email_cp ?>" >
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Nomor HP Kontak</label>
                    <input class="form-control" type="text" name="phone_number_cp" placeholder="Nomor HP Kontak" value="<?= $profil->phone_number_cp ?>" >
                  </div>
                </div>
              </div>
              <button class="btn btn-primary" type="submit">Perbarui Data</button>
            </form>
          </div>
          <div class="tab-pane fade  <?php if($tab == "perjanjian_kerjasama") {echo "show active";} ?>" id="perjanjian_kerjasama" role="tabpanel" aria-labelledby="perjanjian_kerjasama-tab">
          <h5 class="mb-4 mt-4" style="text-align:center">Perjanjian Kerjasama/Memorandum of Agreement (MoA) </h5>
            <form class="form theme-form" method="post" action="<?= base_url('admin/profil_mitra/update_kerjasama/').$profil->id; ?>">
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
                    <label class="form-label">Nomor</label>
                    <input class="form-control" type="text" name="no_moa" placeholder="Nomor" value="<?= $profil->no_moa ?>" >
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3 mt-3">
                    <label class="form-label">Tanggal Mulai</label>
                    <input class="datepicker-here form-control digits" name="tanggal_mulai_moa" type="text" data-language="id" value="<?php if($profil->tanggal_mulai_moa == NULL || $profil->tanggal_mulai_moa == "" || $profil->tanggal_mulai_moa == "0000-00-00") { echo ""; } else { echo $CI->tgl_indo_1($profil->tanggal_mulai_moa); } ?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3 mt-3">
                    <label class="form-label">Tanggal Berakhir</label>
                    <input class="datepicker-here form-control digits" name="tanggal_berakhir_moa" type="text" data-language="id" value="<?php if($profil->tanggal_berakhir_moa == NULL || $profil->tanggal_berakhir_moa == "" || $profil->tanggal_berakhir_moa == "0000-00-00") { echo ""; } else { echo $CI->tgl_indo_1($profil->tanggal_berakhir_moa); } ?>">
                  </div>
                </div>
              </div>
              <button class="btn btn-primary" type="submit">Perbarui Data</button>
            </form>
          </div>
          <div class="tab-pane fade <?php if($tab == "setting") {echo "show active";} ?>" id="setting" role="tabpanel" aria-labelledby="data_mitra-tab">
            <h5 class="mb-4 mt-4" style="text-align:center">Setting</h5>
            <form class="form theme-form" method="post" action="<?= base_url('admin/profil_mitra/setting/').$profil->id; ?>">
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
          <div class="tab-pane fade <?php if($tab == "download") {echo "show active";} ?>" id="download" role="tabpanel" aria-labelledby="data_mitra-tab">
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
                    <input class="form-check-input" type="checkbox" name="perjanjian_kerjasama" value="perjanjian_kerjasama">
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