<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="MBKM Fakultas Ekonomi dan Bisnis (FEB)">
    <meta name="keywords" content="MBKM Fakultas Ekonomi dan Bisnis (FEB)">
    <meta name="author" content="Rachmad Kurniawan">
    <link rel="icon" href="<?= base_url('assets/images/favicon.png'); ?>" type="image/x-icon">
    <link rel="shortcut icon" href="<?= base_url('assets/images/favicon.png'); ?>" type="image/x-icon">
    <title>MBKM FEB</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/fontawesome.css'); ?>">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/vendors/icofont.css'); ?>">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/vendors/themify.css'); ?>">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/vendors/flag-icon.css'); ?>">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/vendors/feather-icon.css'); ?>">
    <!-- Plugins css start-->
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/vendors/bootstrap.css'); ?>">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/style.css'); ?>">
    <link id="color" rel="stylesheet" href="<?= base_url('assets/css/color-1.css'); ?>" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/responsive.css'); ?>">
    <style>
      .recaptcha div div {
        margin-top: 20px;
        margin-left: auto;
        margin-right: auto;
      }
    </style>
  </head>
  <body>
    <!-- login page start-->
    <div class="container-fluid p-0">
      <div class="row m-0">
        <div class="col-12 p-0">    
          <div class="login-card">
            <div>
              <div><img style="width: 80%; display: block; margin-left: auto; margin-right: auto; margin-bottom: 20px;" class="img-fluid for-light" src="<?= base_url('assets/images/logo/login.png'); ?>" alt="looginpage"><img class="img-fluid for-dark" src="<?= base_url('assets/images/logo/logo_dark.png'); ?>" alt="looginpage"></div>
              <div class="login-main"> 
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
                <form class="theme-form" method="post" action="<?= base_url('admin/auth/proc_login') ?>">
                  <h4>Login</h4>
                  <p>Masukkan username dan password untuk login</p>
                  <div class="form-group">
                    <label class="col-form-label">Username</label>
                    <input class="form-control" type="text" required="" placeholder="username" name="username">
                  </div>
                  <div class="form-group">
                    <label class="col-form-label">Password</label>
                    <input class="form-control" type="password" name="password" required="" placeholder="*********">
                    <div class="show-hide"><span class="show"></span></div>
                  </div>
                  <div class="form-group">
                    <div class="recaptcha">
                      <?= $recaptcha; ?>
                    </div>
                  </div>
                  <div class="form-group mb-0">
                    <button class="btn btn-primary btn-block" type="submit">Sign in</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- latest jquery-->
      <script src="<?= base_url('assets/js/jquery-3.5.1.min.js'); ?>"></script>
      <!-- Bootstrap js-->
      <script src="<?= base_url('assets/js/bootstrap/bootstrap.bundle.min.js'); ?>"></script>
      <!-- feather icon js-->
      <script src="<?= base_url('assets/js/icons/feather-icon/feather.min.js'); ?>"></script>
      <script src="<?= base_url('assets/js/icons/feather-icon/feather-icon.js'); ?>"></script>
      <!-- scrollbar js-->
      <!-- Sidebar jquery-->
      <script src="<?= base_url('assets/js/config.js'); ?>"></script>
      <!-- Plugins JS start-->
      <script src='https://www.google.com/recaptcha/api.js'></script>
      <!-- Plugins JS Ends-->
      <!-- Theme js-->
      <script src="<?= base_url('assets/js/script.js'); ?>"></script>
      <!-- login js-->
      <!-- Plugin used-->
    </div>
  </body>
</html>