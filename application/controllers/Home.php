<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Home extends CI_Controller {
    function __construct(){
      parent::__construct();
      $this->load->model("pengumuman_model");
      date_default_timezone_set("Asia/Makassar");
    }

    public function index()
    {
      $data['pengumuman'] = $this->pengumuman_model->get_pengumuman()->result();
      $data['content'] = 'home/index';
      $this->load->view('main/users/index', $data);
    }
  }
?>
