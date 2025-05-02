  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>MBKM FEB</title>
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
    <link rel="stylesheet" href="<?= base_url('assets/users/css/vendor/glide.core.min.css'); ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/users/css/vendor/glide.core.min.css'); ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/users/css/vendor/introjs.min.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/vendors/date-picker.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/users/css/vendor/select2.min.css'); ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/users/css/vendor/select2-bootstrap4.min.css'); ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/users/css/vendor/plyr.css'); ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/vendors/sweetalert2.css'); ?>">
    <!-- Vendor Styles End -->
    <!-- Template Base Styles Start -->
    <link rel="stylesheet" href="<?= base_url('assets/users/css/styles.css'); ?>" />
    <!-- Template Base Styles End -->

    <link rel="stylesheet" href="<?= base_url('assets/users/css/main.css'); ?>" />
    <script src="<?= base_url('assets/users/js/base/loader.js'); ?>"></script>
  </head>

  <body>
    <div id="root">
      <div id="nav" class="nav-container d-flex">
        <div class="nav-content d-flex">
          <!-- Logo Start -->
          <div class="logo position-relative">
            <a href="<?= base_url(); ?>">
              <!-- Logo can be added directly -->
              <img src="<?= base_url('assets/users/img/logo/untad-mbkm.png') ?>" alt="logo" />
            </a>
          </div>
          <!-- Logo End -->

          <!-- Menu Start -->
          <div class="menu-container flex-grow-1">
            <ul id="menu" class="menu">
              <li>
                <a href="<?= base_url('home') ?>" data-href="<?= base_url('home') ?>">
                  <i data-cs-icon="home-garage" class="icon" data-cs-size="18"></i>
                  <span class="label">Home</span>
                </a>
              </li>
              <li>
                <a href="<?= base_url('mitra') ?>" data-href="<?= base_url('mitra') ?>">
                  <i data-cs-icon="suitcase" class="icon" data-cs-size="18"></i>
                  <span class="label">Mitra</span>
                </a>
              </li>
              <li>
                <a href="<?= base_url('panduan') ?>" data-href="<?= base_url('panduan') ?>">
                  <i data-cs-icon="notebook-2" class="icon" data-cs-size="18"></i>
                  <span class="label">Panduan</span>
                </a>
              </li>
              <li>
                <a href="#register">
                  <i data-cs-icon="user-plus" class="icon" data-cs-size="18"></i>
                  <span class="label">Register</span>
                </a>
                <ul id="register">
                  <li>
                    <a href="<?= base_url('auth/register') ?>">
                      <span class="label">Mahasiswa</span>
                    </a>
                  </li>
                  <li>
                    <a href="<?= base_url('auth/register_inbound') ?>">
                      <span class="label">Mahasiswa Inbound</span>
                    </a>
                  </li>
                  <li>
                    <a href="<?= base_url('auth/register_alumni') ?>">
                      <span class="label">Alumni</span>
                    </a>
                  </li>
                </ul>
              </li>
              <li>
                <a href="<?= base_url('auth') ?>" data-href="<?= base_url('auth') ?>">
                  <i data-cs-icon="login" class="icon" data-cs-size="18"></i>
                  <span class="label">Login</span>
                </a>
              </li>
              <li>
                <a href="<?= base_url('admin') ?>" data-href="<?= base_url('auth') ?>">
                  <i data-cs-icon="login" class="icon" data-cs-size="18"></i>
                  <span class="label">Login Dosen/Mitra</span>
                </a>
              </li>
            </ul>
          </div>
          <!-- Menu End -->

          <!-- Mobile Buttons Start -->
          <div class="mobile-buttons-container">
            <!-- Scrollspy Mobile Button Start -->
            <a href="#" id="scrollSpyButton" class="spy-button" data-bs-toggle="dropdown">
              <i data-cs-icon="menu-dropdown"></i>
            </a>
            <!-- Scrollspy Mobile Button End -->

            <!-- Scrollspy Mobile Dropdown Start -->
            <div class="dropdown-menu dropdown-menu-end" id="scrollSpyDropdown"></div>
            <!-- Scrollspy Mobile Dropdown End -->

            <!-- Menu Button Start -->
            <a href="#" id="mobileMenuButton" class="menu-button">
              <i data-cs-icon="menu"></i>
            </a>
            <!-- Menu Button End -->
          </div>
          <!-- Mobile Buttons End -->
        </div>
        <div class="nav-shadow"></div>
      </div>