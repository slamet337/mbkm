<main>
  <div class="container">
    <div class="row">
      <div class="col">
        </div>
        <!-- Form Row Start -->
        <section class="scroll-section" id="formRow">
          <h1 style="font-weight: bold; color: #166DB5">Register Alumni</h1>
          <div class="card mb-5">
            <div class="card-body">
              <form class="row g-3" method="post" action="<?= base_url('auth/post_alumni') ?>" >
              <?php
						    if (validation_errors() || isset($error)) {
              ?>
                <div class="col-md-12">
                  <div class="alert alert-danger dark alert-dismissible fade show m-20 m-b-0" role="alert">
                    <i data-feather="alert-triangle"></i>
                    <p><?= validation_errors() ?></p>
                    <p><?php if (isset($error)) { echo $error; } ?></p>
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                </div>
              <?php
                }
              ?>
                <div class="col-md-6">
                  <label class="form-label">Nama</label>
                  <input type="text" class="form-control" require name="nama" id="nama" />
                </div>
                <div class="col-md-6">
                  <label class="form-label">No. HP</label>
                  <input type="text" class="form-control" require name="no_hp" id="no_hp" />
                </div>
                <div class="col-md-6">
                  <label class="form-label">Fakultas</label>
                  <select name="fakultas" class="form-select select2Basic" id="fakultasOption">
                    <option label="">- pilih fakultas -</option>
                    <?php
                      foreach ($fakultas as $show) {
                        echo "<option value='".$show->kd_fak."'>".$show->nama_fakultas."</option>";
                      }
                    ?>
                  </select>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Prodi</label>
                  <select name="prodi" class="form-select" id="jurusanOption" onchange="setNim(this.value)">
                    <option label="">- pilih prodi -</option>
                    <?php
                      foreach ($prodi as $show) {
                        echo "<option value='".$show->kd_prodi."'>".$show->nama_prodi."</option>";
                      }
                    ?>
                  </select>
                </div>
                <div class="col-md-6">
                  <label class="form-label">NIK (Nomor Induk Kependudukan)</label>
                  <input type="text" class="form-control" require name="nik" id="nik" />
                </div>
                <div class="col-md-6">
                  <label class="form-label">NIM</label>
                  <input type="text" class="form-control" require name="nim" id="nim" />
                </div>
                <div class="col-md-6">
                  <label class="form-label">Email</label>
                  <input type="email" class="form-control" require name="email" id="email" />
                </div>
                <div class="col-md-6">
                  <label class="form-label">Password</label>
                  <input type="password" class="form-control" require name="password" id="password" />
                </div>
                <div class="col-12">
                  <label class="form-label">Alamat</label>
                  <textarea name="alamat" id="alamat" class="form-control" rows="3"></textarea>
                </div>
                <div class="col-md-6">
                  <div class="recaptcha">
                    <?= $recaptcha; ?>
                  </div>
                </div>
                <div class="col-12">
                  <button type="submit" class="btn btn-primary">Daftar</button>
                </div>
              </form>
            </div>
          </div>
        </section>
        <!-- Form Row End -->
    </div>
  </div>
</main>
