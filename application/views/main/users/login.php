<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>MBKM UNTAD</title>
    <meta name="description" content="Merdeka Belajar - Kampus Merdeka Universitas Tadulako" />
    <!-- Favicon Tags Start -->
    <link rel="untad-icon-precomposed" sizes="57x57" href="<?= base_url('assets/users/img/favicon/untad-57x57.png'); ?>" />
    <link rel="untad-icon-precomposed" sizes="114x114" href="<?= base_url('assets/users/img/favicon/untad-114x114.png'); ?>" />
    <link rel="untad-icon-precomposed" sizes="72x72" href="<?= base_url('assets/users/img/favicon/untad-72x72.png'); ?>" />
    <link rel="untad-icon-precomposed" sizes="144x144" href="<?= base_url('assets/users/img/favicon/untad-144x144.png'); ?>" />
    <link rel="untad-icon-precomposed" sizes="60x60" href="<?= base_url('assets/users/img/favicon/untad-60x60.png'); ?>" />
    <link rel="untad-icon-precomposed" sizes="120x120" href="<?= base_url('assets/users/img/favicon/untad-120x120.png'); ?>" />
    <link rel="untad-icon-precomposed" sizes="76x76" href="<?= base_url('assets/users/img/favicon/untad-76x76.png'); ?>" />
    <link rel="untad-icon-precomposed" sizes="152x152" href="<?= base_url('assets/users/img/favicon/untad-152x152.png'); ?>" />
    <link rel="icon" type="image/png" href="<?= base_url('assets/users/img/favicon/favicon-196x196.png'); ?>" sizes="196x196" />
    <link rel="icon" type="image/png" href="<?= base_url('assets/users/img/favicon/favicon-96x96.png'); ?>" sizes="96x96" />
    <link rel="icon" type="image/png" href="<?= base_url('assets/users/img/favicon/favicon-32x32.png'); ?>" sizes="32x32" />
    <link rel="icon" type="image/png" href="<?= base_url('assets/users/img/favicon/favicon-16x16.png'); ?>" sizes="16x16" />
    <link rel="icon" type="image/png" href="<?= base_url('assets/users/img/favicon/favicon-128.png'); ?>" sizes="128x128" />
    <meta name="application-name" content="&nbsp;" />
    <meta name="msapplication-TileColor" content="#FFFFFF" />
    <!-- Favicon Tags End -->
    <!-- Font Tags Start -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url('assets/users/font/CS-Interface/style.css'); ?>" />
    <!-- Font Tags End -->
    <!-- Vendor Styles Start -->
    <link rel="stylesheet" href="<?= base_url('assets/users/css/vendor/bootstrap.min.css'); ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/users/css/vendor/OverlayScrollbars.min.css'); ?>" />

    <!-- Vendor Styles End -->
    <!-- Template Base Styles Start -->
    <link rel="stylesheet" href="<?= base_url('assets/users/css/styles.css'); ?>" />
    <!-- Template Base Styles End -->

    <link rel="stylesheet" href="<?= base_url('assets/users/css/main.css'); ?>" />
    <script src="<?= base_url('assets/users/js/base/loader.js'); ?>"></script>
  </head>

  <body class="h-100">
    <div id="root" class="h-100">
      <!-- Background Start -->
      <div class="fixed-background"></div>
      <!-- Background End -->

      <div class="container-fluid p-0 h-100 position-relative">
        <div class="row g-0 h-100">
          <!-- Left Side Start -->
          <div class="offset-0 col-12 d-none d-lg-flex offset-md-1 col-lg h-lg-100"></div>
          <!-- Left Side End -->

          <!-- Right Side Start -->
          <div class="col-12 col-lg-auto h-100 pb-4 px-4 pt-0 p-lg-0">
            <div class="sw-lg-70 min-h-100 bg-foreground d-flex justify-content-center align-items-center shadow-deep py-5 full-page-content-right-border">
              <div class="sw-lg-50 px-5">
                <div class="sh-11">
                  <a href="<?= base_url(); ?>">
                    <img src="<?= base_url('assets/users/img/logo/untad-mbkm.png') ?>" alt="">
                  </a>
                </div>
                <div class="mb-5" style="margin-top: 3rem">
                  <?php
                    if (isset($error)) {
                  ?>
                    <div class="alert alert-danger dark alert-dismissible fade show m-b-20" role="alert">
                      <i data-feather="alert-triangle"></i>
                      <p><?= $error; ?></p>
                      <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                  <?php
                    }
                  ?>
                  <p class="h6">Gunakan email dan password yang terdaftar.</p>
                  <p class="h6">
                    Jika belum mendaftar klik link berikut
                    <a href="<?= base_url('auth/register') ?>">Daftar</a>
                    .
                  </p>
                </div>
                <div>
                  <form class="tooltip-end-bottom" method="post" action="<?= base_url('auth/proc_login') ?>">
                    <div class="mb-3 filled form-group tooltip-end-top">
                      <i data-cs-icon="email"></i>
                      <input class="form-control" placeholder="Email" name="email" />
                    </div>
                    <div class="mb-3 filled form-group tooltip-end-top">
                      <i data-cs-icon="lock-off"></i>
                      <input class="form-control pe-7" name="password" type="password" placeholder="Password" />
                    </div>
                    <div class="mb-3 filled form-group tooltip-end-top">
                      <div class="recaptcha">
                        <?= $recaptcha; ?>
                      </div>
                    </div>

                    <button type="submit" class="btn btn-lg btn-primary">Login</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- Right Side End -->
        </div>
      </div>
    </div>

    <!-- Vendor Scripts Start -->
    <script src="<?= base_url('assets/users/js/vendor/jquery-3.5.1.min.js'); ?>"></script>
    <script src="<?= base_url('assets/users/js/vendor/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?= base_url('assets/users/js/vendor/OverlayScrollbars.min.js'); ?>"></script>
    <script src="<?= base_url('assets/users/js/vendor/autoComplete.min.js'); ?>"></script>
    <script src="<?= base_url('assets/users/js/vendor/clamp.min.js'); ?>"></script>
    <script src="<?= base_url('assets/users/js/vendor/jquery.validate/jquery.validate.min.js'); ?>"></script>
    <script src="<?= base_url('assets/users/js/vendor/jquery.validate/additional-methods.min.js'); ?>"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <!-- Vendor Scripts End -->

    <!-- Template Base Scripts Start -->
    <script src="font/CS-Line/csicons.min.js'); ?>"></script>
    <script src="<?= base_url('assets/users/js/base/helpers.js'); ?>"></script>
    <script src="<?= base_url('assets/users/js/base/globals.js'); ?>"></script>
    <script src="<?= base_url('assets/users/js/base/nav.js'); ?>"></script>
    <script src="<?= base_url('assets/users/js/base/search.js'); ?>"></script>
    <script src="<?= base_url('assets/users/js/base/settings.js'); ?>"></script>
    <script src="<?= base_url('assets/users/js/base/init.js'); ?>"></script>
    <!-- Template Base Scripts End -->
    <!-- Page Specific Scripts Start -->
    <script src="<?= base_url('assets/users/js/pages/auth.login.js'); ?>"></script>
    <script src="<?= base_url('assets/users/js/common.js'); ?>"></script>
    <script src="<?= base_url('assets/users/js/scripts.js'); ?>"></script>
    <!-- Page Specific Scripts End -->
  </body>
</html>
