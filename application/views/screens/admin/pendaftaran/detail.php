<style>
  .pswp img {
    max-width: none;
    object-fit: contain;
  }
</style>
<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-6">
        <h3>Detail Pendaftaran</h3>
      </div>
      <div class="col-6">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url('home'); ?>"><i data-feather="home"></i></a></li>
          <li class="breadcrumb-item"><a href="<?= base_url('admin/pendaftaran'); ?>"><i data-feather="users"></i></a></li>
          <li class="breadcrumb-item active">detail</li>
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
        <h5>Detail Pendaftaran</h5>
      </div>
      <div>
        <div class="row">
          <div class="my-gallery card-body row gallery-with-description" itemscope="">
            <?php
              foreach ($persyaratan as $show) {
            ?>
              <figure class="col-md-3" itemprop="associatedMedia" itemscope=""><a href="<?= base_url($show->file_upload); ?>" itemprop="contentUrl" data-size="1600x950"><img src="<?= base_url($show->file_upload); ?>" itemprop="thumbnail" alt="Image description">
                  <div class="caption">
                    <h4><?= $show->persyaratan ?></h4>
                  </div></a>
              </figure>
            <?php
              }
            ?>
          </div>
          <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
            <!--
            Background of PhotoSwipe.
            It's a separate element, as animating opacity is faster than rgba().
            -->
            <div class="pswp__bg"></div>
            <!-- Slides wrapper with overflow:hidden.-->
            <div class="pswp__scroll-wrap">
              <!-- Container that holds slides. PhotoSwipe keeps only 3 slides in DOM to save memory.-->
              <!-- don't modify these 3 pswp__item elements, data is added later on.-->
              <div class="pswp__container">
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
              </div>
              <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed.-->
              <div class="pswp__ui pswp__ui--hidden">
                <div class="pswp__top-bar">
                  <!-- Controls are self-explanatory. Order can be changed.-->
                  <div class="pswp__counter"></div>
                  <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                  <button class="pswp__button pswp__button--share" title="Share"></button>
                  <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                  <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                  <!-- Preloader demo https://codepen.io/dimsemenov/pen/yyBWoR-->
                  <!-- element will get class pswp__preloader--active when preloader is running-->
                  <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                      <div class="pswp__preloader__cut">
                        <div class="pswp__preloader__donut"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                  <div class="pswp__share-tooltip"></div>
                </div>
                <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button>
                <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>
                <div class="pswp__caption">
                  <div class="pswp__caption__center"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php
        if(isset($matakuliah) && $id_program == 1) {
      ?>
        <div class="card-body">
          <div class="row">
            <div class="table-responsive">
              <table class="display" id="basic-1">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>MK mitra</th>
                    <th>SKS Mitra</th>
                    <th>MK Konversi</th>
                    <th>SKS Konversi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $i=1;
                    foreach ($matakuliah as $show) {
                      echo "
                        <tr>
                          <td>".$i."</td>
                          <td>".$show->matakuliah."</td>
                          <td>".$show->sks."</td>
                          <td>".$show->matakuliah_konversi."</td>
                          <td>".$show->sks_konversi."</td>
                        </tr>
                      ";
                      $i++;
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      <?php
        } elseif ($id_program != '1') {
      ?>
        <div class="card-body">
          <div class="row">
            <div class="table-responsive">
              <table class="display" id="basic-1">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>MK Konversi</th>
                    <th>SKS Konversi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $i=1;
                    foreach ($matakuliah as $show) {
                      echo "
                        <tr>
                          <td>".$i."</td>
                          <td>".$show->matakuliah."</td>
                          <td>".$show->sks."</td>
                        </tr>
                      ";
                      $i++;
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      <?php
        }
      ?>
      <form class="form theme-form" method="post" action="<?= base_url('admin/pendaftaran/update/'.$pendaftaran->id.'/'.$id_program) ?>">
          <?php
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
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Dosen Pembimbing</label>
                <select name="id_dosen" class="form-select js-example-basic-single">
                  <option label="">- Pilih Dosen Pembimbing -</option>
                  <?php
                    foreach ($dosen as $show) {
                      echo "<option value='".$show->id."'>(".$show->nip.") ".$show->nama." </option>";
                    }
                  ?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Verifikasi</label>
                <select name="status_pendaftaran" class="form-select js-example-basic-single">
                  <option label="">- Pilih Status -</option>
                  <option label="Diterima">Diterima</option>
                  <option label="Ditolak">Ditolak</option>
                </select>
              </div>
            </div>
            <div class="col-md-12">
              <div class="mb-3">
                <label class="form-label">Keterangan jika ditolak</label>
                <Textarea class="form-control" name="keterangan"></Textarea>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <button class="btn btn-primary" type="submit">Submit</button>
          <a href="<?= base_url('admin/pendaftaran') ?>" class="btn btn-light" >Cancel</a>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Container-fluid Ends-->
</div>