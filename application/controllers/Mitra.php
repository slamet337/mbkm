<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Mitra extends CI_Controller {
    function __construct(){
      parent::__construct();
      $this->load->model("mitra_model");
      date_default_timezone_set("Asia/Makassar");
    }

    public function index()
    {
      $data['mitra'] = $this->mitra_model->get_mitra();
      $data['content'] = 'mitra/index';
      $this->load->view('main/users/index', $data);
    }

    public function get_detail_mitra($id)
    {
      return $this->mitra_model->get_detail_mitra($id);
    }

    public function tgl_indo($tanggal){
      $bulan = array (
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
      );
      $pecahkan = explode('-', $tanggal);
     
      return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
    }
  }
?>
