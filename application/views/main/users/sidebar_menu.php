<!-- Page Sidebar Start-->
<div class="sidebar-wrapper">
  <div>
    <div class="logo-wrapper"><a href="<?= base_url() ?>"><img class="img-fluid for-light" src="<?= base_url('assets/images/logo/logo.png'); ?>" alt=""><img class="img-fluid for-dark" src="<?= base_url('assets/images/logo/logo_dark.png'); ?>" alt=""></a>
      <div class="back-btn"><i class="fa fa-angle-left"></i></div>
      <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
    </div>
    <div class="logo-icon-wrapper"><a href="<?= base_url() ?>"><img class="img-fluid" src="<?= base_url('assets/images/logo/logo-icon.png'); ?>" alt=""></a></div>
    <nav class="sidebar-main">
      <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
      <div id="sidebar-menu">
        <ul class="sidebar-links" id="simple-bar">
          <li class="back-btn"><a href="<?= base_url() ?>"><img class="img-fluid" src="<?= base_url('assets/images/logo/logo-icon.png'); ?>" alt=""></a>
            <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
          </li>
          <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="<?= base_url('menu'); ?>"><i data-feather="home"> </i><span>Home</span></a></li>

          <?php
            if($this->session->level=='alumni') {
          ?>
            <!-- <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="<?= base_url('alumni'); ?>"><i data-feather="archive"> </i><span>Riwayat Alumni</span></a></li> -->
            <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="<?= base_url('profil'); ?>"><i data-feather="user"> </i><span>Profil saya</span></a></li>
          <?php
            } elseif($this->session->level=='mahasiswa') {
          ?>
            <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="<?= base_url('kegiatan_mbkm_luar'); ?>"><i data-feather="archive"> </i><span>MBKM Luar Fakultas</span></a></li>
            <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="<?= base_url('profil'); ?>"><i data-feather="user"> </i><span>Profil saya</span></a></li>

            <?php
              $CI =& get_instance();

              $CI->load->model("pendaftaran_model");
              $menu = $CI->pendaftaran_model->get_status($this->session->id_mhsw)->num_rows();

              if($menu > 0) {
            ?>
                <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="<?= base_url('manajemen'); ?>"><i data-feather="monitor"> </i><span>Manajemen</span></a></li>
                <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="<?= base_url('logbook'); ?>"><i data-feather="book-open"> </i><span>Logbook</span></a></li>
                <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="<?= base_url('laporan_akhir'); ?>"><i data-feather="clipboard"> </i><span>Laporan Akhir</span></a></li>
            <?php
              } else {
            ?>      
                <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="<?= base_url('pendaftaran'); ?>"><i data-feather="edit-3"> </i><span>Pendaftaran MBKM</span></a></li>
                <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="<?= base_url('manajemen'); ?>"><i data-feather="monitor"> </i><span>Manajemen</span></a></li>
            <?php
                $menu_akhir = $CI->pendaftaran_model->get_status_kegiatan($this->session->id_mhsw)->num_rows();
                if($menu_akhir > 0) {
            ?>
                <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="<?= base_url('laporan_akhir'); ?>"><i data-feather="clipboard"> </i><span>Laporan Akhir</span></a></li>
            <?php
                }
              }
            ?>
          <?php
            } elseif($this->session->level=='inbound') {
          ?>
            <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="<?= base_url('profil_inbound'); ?>"><i data-feather="user"> </i><span>Profil saya</span></a></li>

            <?php
              $CI =& get_instance();

              $CI->load->model("pendaftaran_model");
              $menu = $CI->pendaftaran_model->get_status_inbound($this->session->id)->num_rows();

              if($menu > 0) {
            ?>
                <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="<?= base_url('manajemen_inbound'); ?>"><i data-feather="monitor"> </i><span>Manajemen</span></a></li>
                <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="<?= base_url('logbook_inbound'); ?>"><i data-feather="book-open"> </i><span>Logbook</span></a></li>
                <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="<?= base_url('laporan_akhir_inbound'); ?>"><i data-feather="clipboard"> </i><span>Laporan Akhir</span></a></li>
            <?php
              } else {
            ?>      
                <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="<?= base_url('pendaftaran_inbound'); ?>"><i data-feather="edit-3"> </i><span>Pendaftaran MBKM</span></a></li>
                <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="<?= base_url('manajemen_inbound'); ?>"><i data-feather="monitor"> </i><span>Manajemen</span></a></li>
            <?php
                $menu_akhir = $CI->pendaftaran_model->get_status_kegiatan_inbound($this->session->id)->num_rows();
                if($menu_akhir > 0) {
            ?>
                <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="<?= base_url('laporan_akhir_inbound'); ?>"><i data-feather="clipboard"> </i><span>Laporan Akhir</span></a></li>
            <?php
                }
              }
            ?>
          <?php
            }
          ?>
        </ul>
      </div>
      <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
    </nav>
  </div>
</div>
<!-- Page Sidebar Ends-->
