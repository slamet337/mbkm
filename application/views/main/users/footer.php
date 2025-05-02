    <!-- Layout Footer Start -->
    <footer>
      <div class="footer-content">
        <div class="container">
          <div class="row">
            <div class="col-12 col-sm-12">
              <p class="mb-0 text-muted text-medium" style="text-align: center">Copyright © MBKM UNTAD 2021</p>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <!-- Layout Footer End -->
  </div>

  <!-- Vendor Scripts Start -->
  <script src="<?= base_url('assets/users/js/vendor/jquery-3.5.1.min.js'); ?>"></script>
  <script src="<?= base_url('assets/users/js/vendor/bootstrap.bundle.min.js'); ?>"></script>
  <script src="<?= base_url('assets/users/js/vendor/OverlayScrollbars.min.js'); ?>"></script>
  <script src="<?= base_url('assets/users/js/vendor/autoComplete.min.js'); ?>"></script>
  <script src="<?= base_url('assets/users/js/vendor/clamp.min.js'); ?>"></script>
  <script src="<?= base_url('assets/users/js/vendor/Chart.bundle.min.js'); ?>"></script>
  <script src="<?= base_url('assets/users/js/vendor/chartjs-plugin-datalabels.js'); ?>"></script>
  <script src="<?= base_url('assets/users/js/vendor/chartjs-plugin-rounded-bar.min.js'); ?>"></script>
  <script src="<?= base_url('assets/users/js/vendor/glide.min.js'); ?>"></script>
  <script src="<?= base_url('assets/users/js/vendor/intro.min.js'); ?>"></script>
  <script src="<?= base_url('assets/users/js/vendor/select2.full.min.js'); ?>"></script>
  <script src="<?= base_url('assets/users/js/vendor/plyr.min.js'); ?>"></script>
  <!-- Vendor Scripts End -->

  <!-- Template Base Scripts Start -->
  <script src="<?= base_url('assets/users/font/CS-Line/csicons.min.js'); ?>"></script>
  <script src="<?= base_url('assets/users/js/base/helpers.js'); ?>"></script>
  <script src="<?= base_url('assets/users/js/base/globals.js'); ?>"></script>
  <script src="<?= base_url('assets/users/js/base/nav.js'); ?>"></script>
  <script src="<?= base_url('assets/users/js/base/search.js'); ?>"></script>
  <script src="<?= base_url('assets/users/js/base/settings.js'); ?>"></script>
  <script src="<?= base_url('assets/users/js/base/init.js'); ?>"></script>
  <script src="<?= base_url('assets/js/sweet-alert/sweetalert.min.js'); ?>"></script>
  <script src="<?= base_url('assets/js/sweet-alert/app.js'); ?>"></script>
  <script src='https://www.google.com/recaptcha/api.js'></script>
  <!-- Template Base Scripts End -->
  <!-- Page Specific Scripts Start -->
  <script src="<?= base_url('assets/js/datepicker/date-picker/datepicker.js'); ?>"></script>
  <script src="<?= base_url('assets/js/datepicker/date-picker/datepicker.id.js'); ?>"></script>
  <script src="<?= base_url('assets/js/datepicker/date-picker/datepicker.custom.js'); ?>"></script>
  <script src="<?= base_url('assets/users/js/cs/glide.custom.js'); ?>"></script>
  <script src="<?= base_url('assets/users/js/cs/charts.extend.js'); ?>"></script>
  <script src="<?= base_url('assets/users/js/pages/dashboard.default.js'); ?>"></script>
  <script src="<?= base_url('assets/users/js/common.js'); ?>"></script>
  <script src="<?= base_url('assets/users/js/scripts.js'); ?>"></script>
  <script src="<?= base_url('assets/users/js/forms/controls.select2.js'); ?>"></script>
  <!-- Page Specific Scripts End -->
  <script>
    <?php
      if($this->session->flashdata('success_save')){
    ?>
        swal("Sukses", "Data berhasil tersimpan, silahkan pilih menu login", "success").then(function() {
          window.location = "<?= base_url('auth'); ?>";
        });;
    <?php
        $this->session->unset_userdata('success_save');
      } else if($this->session->flashdata('error_save')){
    ?>
        swal("Gagal", "Data gagal tersimpan, Hubungi Admin", "error");
    <?php
        $this->session->unset_userdata('error_save');        
      } else if($this->session->flashdata('success_update')){
    ?>
        swal("Sukses", "Data berhasil terubah", "success");
    <?php
        $this->session->unset_userdata('success_update');
      }  else if($this->session->flashdata('error_update')){
    ?>
        swal("Gagal", "Data gagal terubah", "error");
    <?php
        $this->session->unset_userdata('error_update');
      }
    ?>
    function setNim(kdprodi) {
      $("#nim").val(`${kdprodi}`);
    }
  </script>
</body>