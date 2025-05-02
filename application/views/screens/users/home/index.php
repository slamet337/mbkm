<div style="padding-left: 0 px; padding-right: 0px; margin-top: 79px; width: 100%">
  <img style="width: 100%" src="<?= base_url('assets/images/banner/landing-img.jpg') ?>" alt="UNTAD MBKM">
</div>
<main style="padding-top: 40px">
  <div class="container">
    <div class="row">
      <div class="col-12 col-xl-12">
        <div class="mb-5">
          <h1 style="font-weight: bold; color: #166DB5">Kegiatan Pembelajaran</h1>
          <div class="card mb-2 h-auto" style="margin-top: 20px">
            <div class="card-body">
              <p>Berdasarkan Permendikbud No 3 Tahun 2020 Pasal 15 ayat 1 dapat dilakukan di dalam Program Studi dan di luar Program Studi meliputi:</p>
              <div class="row">
                <div class="col-md-3 col-sm-12" style="margin-top: 5px; margin-bottom: 5px;">
                  <div class="h-100">
                    <img style="border-radius: 8px;" src="<?= base_url('assets/images/featured/1.jpg') ?>" class="card-img-top sh-19" alt="card image" />
                    <h5 class="heading mb-3 mt-3 text-center">
                      <span class="clamp-line sh-5" style="color: #166DB5; font-size: 14px; font-weight: bold;">Pertukaran Pelajar</span>
                    </h5>
                  </div>
                </div>
                <div class="col-md-3 col-sm-12" style="margin-top: 5px; margin-bottom: 5px;">
                  <div class="h-100">
                    <img style="border-radius: 8px;" src="<?= base_url('assets/images/featured/2.jpg') ?>" class="card-img-top sh-19" alt="card image" />
                    <h5 class="heading mb-3 mt-3 text-center">
                      <span class="clamp-line sh-5" style="color: #166DB5; font-size: 14px; font-weight: bold;">Magang/Praktik Kerja</span>
                    </h5>
                  </div>
                </div>
                <div class="col-md-3 col-sm-12" style="margin-top: 5px; margin-bottom: 5px;">
                  <div class="h-100">
                    <img style="border-radius: 8px;" src="<?= base_url('assets/images/featured/3.jpg') ?>" class="card-img-top sh-19" alt="card image" />
                    <h5 class="heading mb-3 mt-3 text-center">
                      <span class="clamp-line sh-5" style="color: #166DB5; font-size: 14px; font-weight: bold;">Asistensi Mengajar di Satuan Pendidikan</span>
                    </h5>
                  </div>
                </div>
                <div class="col-md-3 col-sm-12" style="margin-top: 5px; margin-bottom: 5px;">
                  <div class="h-100">
                    <img style="border-radius: 8px;" src="<?= base_url('assets/images/featured/4.jpg') ?>" class="card-img-top sh-19" alt="card image" />
                    <h5 class="heading mb-3 mt-3 text-center">
                      <span class="clamp-line sh-5" style="color: #166DB5; font-size: 14px; font-weight: bold;">Penelitian/Riset</span>
                    </h5>
                  </div>
                </div>
                <div class="col-md-3 col-sm-12" style="margin-top: 15px; margin-bottom: 5px;">
                  <div class="h-100">
                    <img style="border-radius: 8px;" src="<?= base_url('assets/images/featured/5.jpg') ?>" class="card-img-top sh-19" alt="card image" />
                    <h5 class="heading mb-3 mt-3 text-center">
                      <span class="clamp-line sh-5" style="color: #166DB5; font-size: 14px; font-weight: bold;">Proyek Kemanusiaan</span>
                    </h5>
                  </div>
                </div>
                <div class="col-md-3 col-sm-12" style="margin-top: 15px; margin-bottom: 5px;">
                  <div class="h-100">
                    <img style="border-radius: 8px;" src="<?= base_url('assets/images/featured/6.jpg') ?>" class="card-img-top sh-19" alt="card image" />
                    <h5 class="heading mb-3 mt-3 text-center">
                      <span class="clamp-line sh-5" style="color: #166DB5; font-size: 14px; font-weight: bold;">Kegiatan Wirausaha</span>
                    </h5>
                  </div>
                </div>
                <div class="col-md-3 col-sm-12" style="margin-top: 15px; margin-bottom: 5px;">
                  <div class="h-100">
                    <img style="border-radius: 8px;" src="<?= base_url('assets/images/featured/7.jpg') ?>" class="card-img-top sh-19" alt="card image" />
                    <h5 class="heading mb-3 mt-3 text-center">
                      <span class="clamp-line sh-5" style="color: #166DB5; font-size: 14px; font-weight: bold;">Studi/Proyek Independen</span>
                    </h5>
                  </div>
                </div>
                <div class="col-md-3 col-sm-12" style="margin-top: 15px; margin-bottom: 5px;">
                  <div class="h-100">
                    <img style="border-radius: 8px;" src="<?= base_url('assets/images/featured/8.jpg') ?>" class="card-img-top sh-19" alt="card image" />
                    <h5 class="heading mb-3 mt-3 text-center">
                      <span class="clamp-line sh-5" style="color: #166DB5; font-size: 14px; font-weight: bold;">Membangun Desa/Kuliah Kerja Nyata Tematik</span>
                    </h5>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>              
      </div>          
    </div>
    <div class="row">
      <div class="col-12 col-xl-12">
        <div class="mb-5">
          <h1 style="font-weight: bold; color: #166DB5">Pengumuman</h1>
          <div class="card mb-2 h-auto" style="margin-top: 20px">
            <div class="card-body">
              <?php
                foreach ($pengumuman as $show) {
              ?>
                <div class="card mt-5">
                  <div class="card-header">
                    <h3><?= $show->title; ?></h3>
                  </div>
                  <div class="card-body">
                    <?= $show->text; ?>
                  </div>
                </div>
              <?php
                }
              ?>
            </div>
          </div>
        </div>              
      </div>          
    </div>
  </div>
</main>
