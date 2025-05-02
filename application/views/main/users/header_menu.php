<?php
  if(!isset($this->session->level)) {
    redirect('auth');
  }
?>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="MBKM Fakultas Ekonomi dan Bisnis (FEB)">
  <meta name="keywords" content="MBKM Fakultas Ekonomi dan Bisnis (FEB)">
  <meta name="author" content="Rachmad Kurniawan">
  <link rel="icon" href="<?= base_url('assets/images/favicon.png'); ?>" type="image/x-icon">
  <link rel="shortcut icon" href="<?= base_url('assets/images/favicon.png'); ?>" type="image/x-icon">
  <title>MBKM Fakultas Ekonomi dan Bisnis (FEB)</title>
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
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/vendors/scrollbar.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/vendors/scrollable.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/vendors/animate.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/vendors/chartist.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/vendors/date-picker.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/vendors/datatables.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/vendors/select2.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/vendors/sweetalert2.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/vendors/photoswipe.css'); ?>">
  <!-- Plugins css Ends-->
  <!-- Bootstrap css-->
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/vendors/bootstrap.css'); ?>">
  <!-- App css-->
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/style.css'); ?>">
  <link id="color" rel="stylesheet" href="<?= base_url('assets/css/color-1.css'); ?>" media="screen">
  <!-- Responsive css-->
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/responsive.css'); ?>">
</head>
<body onload="startTime()">
  <!-- tap on top starts-->
  <div class="tap-top"><i data-feather="chevrons-up"></i></div>
  <!-- tap on tap ends-->
  <!-- page-wrapper Start-->
  <div class="page-wrapper compact-wrapper" id="pageWrapper">
    <!-- Page Header Start-->
    <div class="page-header">
      <div class="header-wrapper row m-0">
        <div class="header-logo-wrapper col-auto p-0">
          <div class="logo-wrapper"><a href="index.html"><img class="img-fluid" src="<?= base_url('assets/images/logo/logo.png'); ?>" alt=""></a></div>
          <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i></div>
        </div>
        <div class="left-header col horizontal-wrapper ps-0"></div>
        <div class="nav-right col-8 pull-right right-header p-0">
          <ul class="nav-menus">
            <li class="maximize"><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a></li>
            <li class="profile-nav onhover-dropdown p-0 me-0">
              <div class="media profile-media"><img class="b-r-10" src="<?= base_url('assets/images/dashboard/profile.jpg'); ?>" alt="">
                <div class="media-body"><span><?= $this->session->nama; ?></span>
                  <p class="mb-0 font-roboto"><?= $this->session->level; ?> <i class="middle fa fa-angle-down"></i></p>
                </div>
              </div>
              <ul class="profile-dropdown onhover-show-div">
                <li><a href="<?= base_url('profil') ?>"><i data-feather="user"></i><span>Profil </span></a></li>
                <li><a href="<?= base_url('auth/logout') ?>"><i data-feather="log-out"> </i><span>Log Out</span></a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- Page Header Ends -->