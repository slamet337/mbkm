<!DOCTYPE html>
<html lang="en">
  <?php $this->load->view('main/admin/header'); ?>
    <!-- Page Body Start-->
    <div class="page-body-wrapper">
      <?php $this->load->view('main/admin/sidebar'); ?>
      <div class="page-body">
        <?php
          if(isset($data)) {
            $this->load->view('screens/admin/'.$content, $data); 
          } else {
            $this->load->view('screens/admin/'.$content); 
          }
          $this->load->view('main/admin/footer');
        ?>
</html>