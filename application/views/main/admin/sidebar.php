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
          <?php
            $CI =& get_instance();

            echo "<li class='sidebar-list'><a class='sidebar-link sidebar-title link-nav' href='".base_url('admin/home')."'><i data-feather='home'> </i><span>Home</span></a></li>";

            $menu = $CI->users_model->get_menu($this->session->level)->result();
            foreach ($menu as $show) {
              if($show->type == 'single_link') {
                echo "<li class='sidebar-list'><a class='sidebar-link sidebar-title link-nav' href='".base_url().$show->link."'><i data-feather='".$show->icon."'> </i><span>".$show->menu."</span></a></li>";
              } elseif($show->type == 'main_menu') {
                echo "<li class='sidebar-list'><a class='sidebar-link sidebar-title' href='".$show->link."'><i data-feather='".$show->icon."'></i><span>".$show->menu."</span></a>
                <ul class='sidebar-submenu'>";
                $submenu = $CI->users_model->get_submenu($show->id_menu,$this->session->level)->result();
                foreach ($submenu as $show_submenu) {
                  echo "<li><a href='".base_url().$show_submenu->link."'>".$show_submenu->menu."</a></li>";
                }
                echo "</ul>
                </li>";
              }
            }
          ?>
        </ul>
      </div>
      <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
    </nav>
  </div>
</div>
<!-- Page Sidebar Ends-->
