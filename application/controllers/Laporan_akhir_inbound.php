<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Dompdf\Dompdf;
use Dompdf\Options;

class Laporan_akhir_inbound extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model("laporan_akhir_model");
    date_default_timezone_set("Asia/Makassar");
	}

	public function index()
	{
		$data['data'] = array(
			'laporan_akhir_inbound' => $this->laporan_akhir_model->get_laporan_akhir_inbound($this->session->id)->result(),
			'nilai_kegiatan' => $this->laporan_akhir_model->check_nilai_kegiatan($this->session->id)->num_rows(),
		);
		$data['content'] = 'menu/laporan_akhir_inbound/index';
    $this->load->view('main/users/index_menu', $data);
	}

	public function nilai($id)
  {
    $pendaftaran = $this->laporan_akhir_model->get_pendaftaran_adm_prodi_one_inbound($id)->row();
    $data['data'] = array(
      'nilai' => $this->laporan_akhir_model->get_nilai_inbound($pendaftaran->id_mhsw, $pendaftaran->semester)->result(),
      'id' => $id
    );
    $data['content'] = 'menu/laporan_akhir_inbound/nilai';
    $this->load->view('main/users/index_menu', $data);
	}

  public function cetak_transkip($id)
  {
    $pendaftaran = $this->laporan_akhir_model->get_pendaftaran_adm_prodi_one_inbound($id)->row();
    $nilai = $this->laporan_akhir_model->get_nilai_inbound($pendaftaran->id_mhsw, $pendaftaran->semester)->result();
    $options = new Options();
    $options->set('isRemoteEnabled',true);      
    $dompdf = new Dompdf( $options );
    $dataNilai= '';
    $no = 1;
    foreach ($nilai as $show) {
      $dataNilai = $dataNilai.'<tr>
        <td style="text-align: center">'.$no.'</td>
        <td style="text-align: center">'.$show->kd_mk.'</td>
        <td>'.$show->matakuliah.'</td>
        <td style="text-align: center">'.$show->sks.'</td>
        <td style="text-align: center">'.$show->nilai.'</td>
        <td style="text-align: center">'.$show->grade.'</td>
      </tr>';
      $no++;
    }
    $dompdf->loadHtml('
      <!DOCTYPE html>
      <html lang="en">
        <head>
          <meta charset="UTF-8" />
          <meta http-equiv="X-UA-Compatible" content="IE=edge" />
          <meta name="viewport" content="width=device-width, initial-scale=1.0" />
          <style>
            #mbkm {
              font-family: Arial, Helvetica, sans-serif;
              border-collapse: collapse;
              width: 100%;
            }
      
            #mbkm td,
            #mbkm th {
              border: 1px solid rgb(0, 0, 0);
              padding: 8px;
            }
      
            #mbkm tr:nth-child(even) {
              background-color: #f2f2f2;
            }
      
            #mbkm tr:hover {
              background-color: #ddd;
            }
      
            #mbkm th {
              padding-top: 12px;
              padding-bottom: 12px;
              text-align: left;
              background-color: #d3d3d3;
              color: rgb(0, 0, 0);
              font-weight: 500;
            }

            #top {
              border-collapse: collapse;
              width: 100%;
            }
            
            #top td {
              border-bottom: 2px solid rgb(0, 0, 0);
              padding: 8px;
            }
          </style>
          <title>Transkip Nilai</title>
        </head>
        <body>
          <table id="top">
            <tr style="border-bottom: 2px solid #000">
              <td style="vertical-align: 0px; padding-left: 30px; width: 15%">
                <img
                  src="'.base_url("assets/images/logo/logo_untad.png").'"
                  alt=""
                  style="width: 100px"
                />
              </td>
              <td style="width: 85%">
                <h4 style="text-align: center; margin: 0px">
                  KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN
                </h4>
                <h3 style="text-align: center; margin: 0px">UNIVERSITAS TADULAKO</h3>
                <h4 style="text-align: center; margin: 0px">
                  FAKULTAS EKONOMI DAN BISNIS (FEB)
                </h4>
                <p style="text-align: center; font-size: 9px; margin-top: 5px">
                  Kampus Bumi Tadulako Tondo<br />Jl. Soekarno Hatta Km. 9 Telp:
                  (0451) 422611 - 422355 Fax: (0451) 422844<br />email:
                  untad@untad.ac.id
                </p>
              </td>
            </tr>
          </table>
          <h3 style="text-align: center">TRANSKIP NILAI AKADEMIK</h3>
          <table>
            <tr>
              <td width="120px">Nama</td>
              <td>: Wawan</td>
            </tr>
            <tr>
              <td width="120px">Stambuk Asal</td>
              <td>: 8768712</td>
            </tr>
            <tr>
              <td width="120px">Universitas Asal</td>
              <td>: STMIK Adhi Guna</td>
            </tr>
          </table>
          <table id="mbkm">
            <tr>
              <th style="text-align: center">No.</th>
              <th style="text-align: center">Kode MK</th>
              <th style="text-align: center">Nama Matakuliah</th>
              <th style="text-align: center">SKS</th>
              <th style="text-align: center">Nilai</th>
              <th style="text-align: center">Grade</th>
            </tr>
            '.$dataNilai.'
          </table>
        </body>
      </html>
    ');

    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'potrait');

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF to Browser
    $dompdf->stream();
  }

  public function upload_tugas($id)
	{
    $data['laporan_akhir_inbound'] = $this->laporan_akhir_model->get_laporan_akhir_one_inbound($id)->row();
		$data['content'] = 'menu/laporan_akhir_inbound/edit';
    $this->load->view('main/users/index_menu', $data);
	}

  public function update($id) {
    if (!is_dir('images/laporan_akhir_inbound/' . $this->session->id)) {
      mkdir('./images/laporan_akhir_inbound/' . $this->session->id, 0777, TRUE);
    }

    $config = array(
      'upload_path'   => 'images/laporan_akhir_inbound/' . $this->session->id,
      'allowed_types' => 'pdf|doc|docx',
      'max_size'      => 5000,
      'overwrite'     => TRUE,     
    );

    $this->load->library('upload', $config);      

    if (!empty($_FILES['file_laporan_akhir']['name'])) {
      $config['file_name'] = $this->session->id."_tgs_akhir";
        
      $this->upload->initialize($config);

      if ($this->upload->do_upload('file_laporan_akhir')) {
        $this->upload->data();

        $file_upload = 'images/laporan_akhir_inbound/'.$this->session->id.'/'.$this->session->id."_tgs_akhir".$this->upload->data('file_ext');
        $data_laporan = array(
          'file_laporan_akhir' => $file_upload,
        );

        if ($this->laporan_akhir_model->put_inbound($data_laporan, $id)) {
          $this->session->set_flashdata('success_update', TRUE);            
        } else {
          $this->session->set_flashdata('error_update', TRUE);
        }
    
        redirect('/laporan_akhir_inbound');
      } else {
        $data['error'] = $this->upload->display_errors();
        $data['laporan_akhir_inbound'] = $this->laporan_akhir_model->get_laporan_akhir_one_inbound($id)->row();
        $data['content'] = 'menu/laporan_akhir_inbound/edit';
        $this->load->view('main/users/index_menu', $data);
      }
    } else {
      $data['error'] = "File Tugas Harus diisi";
      $data['laporan_akhir_inbound'] = $this->laporan_akhir_model->get_laporan_akhir_one_inbound($id)->row();
      $data['content'] = 'menu/laporan_akhir_inbound/edit';
      $this->load->view('main/users/index_menu', $data);
    }
  }
}
?>