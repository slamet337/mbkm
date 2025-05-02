<!DOCTYPE html>
<html lang="en" data-footer="true" data-layout="boxed" data-radius="standard">
  <?php $this->load->view('main/users/header'); ?>
  <?php
    if(isset($data)) {
      $this->load->view('screens/users/'.$content, $data); 
    } else {
      $this->load->view('screens/users/'.$content); 
    }
    $this->load->view('main/users/footer');
  ?>
</html>