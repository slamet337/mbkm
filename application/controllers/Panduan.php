<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Panduan extends CI_Controller {
    function __construct(){
      parent::__construct();
      $this->load->model("panduan_model");
      date_default_timezone_set("Asia/Makassar");
    }

    public function index()
    {
      $data['panduan'] = $this->panduan_model->get_panduan()->result();
      $data['content'] = 'panduan/index';
      $this->load->view('main/users/index', $data);
    }
  }
?>
