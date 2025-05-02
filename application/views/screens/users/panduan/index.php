<main style="padding-top: 40px; margin-top: 79px;">
  <div class="container">
    <div class="row">
      <div class="col-12 col-xl-12">
        <div class="mb-5">
          <h1 style="font-weight: bold; color: #166DB5">Panduan Mahasiswa</h1>
          <div class="card mb-2 h-auto" style="margin-top: 20px">
            <div class="card-body">
              <?php
                foreach ($panduan as $show) {
              ?>
                <div class="card mt-5">
                  <div class="card-header">
                    <h1 style="font-weight: bold;"><?= $show->title; ?></h1>
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
