<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Menu extends CI_Controller {
    function __construct(){
      parent::__construct();
    }

    public function index()
    {
      $data['content'] = 'menu/home/index';
      $this->load->view('main/users/index_menu', $data);
    }
  }
?>
