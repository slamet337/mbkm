<!DOCTYPE html>
<html lang="en">
  <?php $this->load->view('main/users/header_menu'); ?>
    <!-- Page Body Start-->
    <div class="page-body-wrapper">
      <?php $this->load->view('main/users/sidebar_menu'); ?>
      <div class="page-body">
        <?php
          if(isset($data)) {
            $this->load->view('screens/users/'.$content, $data); 
          } else {
            $this->load->view('screens/users/'.$content); 
          }
          $this->load->view('main/users/footer_menu');
        ?>
</html>