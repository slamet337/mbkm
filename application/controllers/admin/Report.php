<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as ReaderXlsx;


class Report extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model("users_model");
		$this->load->model("report_model");
    date_default_timezone_set("Asia/Makassar");
	}

	public function mahasiswa()
	{
		$data['prodi'] = $this->users_model->get_prodi_all()->result();
		$data['content'] = 'report/mahasiswa';
		$this->load->view('main/admin/index', $data);
	}

  public function mk_inbound()
	{
		$data['content'] = 'report/mk_inbound';
		$this->load->view('main/admin/index', $data);
	}

  public function iku()
	{
		$data['prodi'] = $this->users_model->get_prodi_all()->result();
		$data['content'] = 'report/iku';
		$this->load->view('main/admin/index', $data);
	}

  public function alumni()
	{
		$data['prodi'] = $this->users_model->get_prodi_all()->result();
		$data['content'] = 'report/alumni';
		$this->load->view('main/admin/index', $data);
	}

  public function nilai()
	{
    if($this->session->level == '2') {
      $data['pendaftar'] = $this->report_model->get_pendaftar_jur($this->session->kd_prodi)->result();      
    } else {
      $data['pendaftar'] = $this->report_model->get_pendaftar()->result();
    }
		$data['content'] = 'report/nilai';
		$this->load->view('main/admin/index', $data);
	}

  public function pendaftar_mbkm()
  {
    $data['prodi'] = $this->users_model->get_prodi_all()->result();
		$data['content'] = 'report/pendaftar_mbkm';
		$this->load->view('main/admin/index', $data);
  }

  public function mitra()
	{
		$data['content'] = 'report/mitra';
		$this->load->view('main/admin/index', $data);
	}

  public function mentor()
	{
    $data['mitra'] = $this->report_model->get_all_mitra()->result();
		$data['content'] = 'report/mentor';
		$this->load->view('main/admin/index', $data);
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

  public function cetak_pendaftar_univ_all()
  {
    $headerStyle = [
      'font' => [
          'bold' => true,
          'size' => 14
      ],
      'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
          'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
      ]
    ];

    $borderHeaderStyle = [
      'font' => [
          'bold' => true,
          'size' => 11
      ],
      'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
          'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ],
      'fill' => array(
          'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
          'startColor' => array('argb' => 'd5dadb')
      )
    ];

    $borderBodyStyle = [
      'font' => [
          'size' => 11
      ],
      'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
          'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ]
    ];

    $spreadsheet = new Spreadsheet();
    
    $sheet = $spreadsheet->getActiveSheet();
    
    $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5);
    $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(25);
    $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(25);
    $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(20);
    $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(20);
    $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(25);
    $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(30);
    $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(35);
    $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(25);
    $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(40);
    $spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(15);
    $spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(15);
    $sheet->setCellValue('A1', 'Daftar Pendaftar MBKM Universitas dan Kementrian');
    $sheet->setCellValue('A3', 'No');
    $sheet->setCellValue('B3', 'Jenis MBKM');
    $sheet->setCellValue('C3', 'Nama');
    $sheet->setCellValue('D3', 'NIM');
    $sheet->setCellValue('E3', 'NIK');
    $sheet->setCellValue('F3', 'Prodi');
    $sheet->setCellValue('G3', 'Nama Program');
    $sheet->setCellValue('H3', 'Nama Kegiatan');
    $sheet->setCellValue('I3', 'Lokasi');
    $sheet->setCellValue('J3', 'Uraian');
    $sheet->setCellValue('K3', 'Tanggal Mulai');
    $sheet->setCellValue('L3', 'Tanggal Selesai');

    $spreadsheet->getActiveSheet()->mergeCells('A1:L1');
    $spreadsheet->getActiveSheet()->getStyle('A1')->applyFromArray($headerStyle);
    $spreadsheet->getActiveSheet()->getStyle('A3:L3')->applyFromArray($borderHeaderStyle);

    $list_data = $this->report_model->get_pendaftar_mbkm_univ()->result();

    $i = 4;
    $number = 1;
    foreach($list_data as $row) {
      if($row->tanggal_selesai == NULL || $row->tanggal_selesai == "" || $row->tanggal_selesai == '0000-00-00') {
        $tgl_selesai = "Sampai Sekarang";
      } else {
        $tgl_selesai = $this->tgl_indo($row->tanggal_selesai);
      }
      $sheet->setCellValue('A'.$i, $number);
      $sheet->setCellValue('B'.$i, $row->tipe);
      $sheet->setCellValue('C'.$i, $row->nama);
      $sheet->setCellValueExplicit('D'.$i, $row->nim, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
      $sheet->setCellValueExplicit('E'.$i, $row->nik, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
      $sheet->setCellValue('F'.$i, $row->nama_prodi);
      $sheet->setCellValue('G'.$i, $row->nama_program);
      $sheet->setCellValue('H'.$i, $row->riwayat);
      $sheet->setCellValue('I'.$i, $row->lokasi);
      $sheet->setCellValue('J'.$i, $row->uraian);
      $sheet->setCellValueExplicit('K'.$i, $this->tgl_indo($row->tanggal_mulai), \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
      $sheet->setCellValueExplicit('L'.$i, $tgl_selesai, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
      
      $i++;
      $number++;
    }

    $i--;
    $spreadsheet->getActiveSheet()->getStyle('A4:L'.$i--)->applyFromArray($borderBodyStyle);
    
    $writer = new Xlsx($spreadsheet);
    $filename = 'report_pendaftar_mbkm_universitas_dan_kementrian';
    
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
  }

  public function cetak_pendaftar_univ_prodi()
  {
    $headerStyle = [
      'font' => [
          'bold' => true,
          'size' => 14
      ],
      'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
      ]
    ];

    $borderHeaderStyle = [
      'font' => [
          'bold' => true,
          'size' => 12
      ],
      'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ],
      'fill' => array(
          'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
          'startColor' => array('argb' => 'd5dadb')
      )
    ];

    $borderBodyStyle = [
      'font' => [
          'size' => 12
      ],
      'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ]
    ];

    $spreadsheet = new Spreadsheet();
    
    $sheet = $spreadsheet->getActiveSheet();
    
    $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5);
    $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(25);
    $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(25);
    $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(20);
    $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(20);
    $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(25);
    $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(30);
    $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(35);
    $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(25);
    $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(40);
    $spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(15);
    $spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(15);
    $sheet->setCellValue('A1', 'Daftar Pendaftar MBKM Universitas dan Kementrian');
    $sheet->setCellValue('A3', 'No');
    $sheet->setCellValue('B3', 'Jenis MBKM');
    $sheet->setCellValue('C3', 'Nama');
    $sheet->setCellValue('D3', 'NIM');
    $sheet->setCellValue('E3', 'NIK');
    $sheet->setCellValue('F3', 'Prodi');
    $sheet->setCellValue('G3', 'Nama Program');
    $sheet->setCellValue('H3', 'Nama Kegiatan');
    $sheet->setCellValue('I3', 'Lokasi');
    $sheet->setCellValue('J3', 'Uraian');
    $sheet->setCellValue('K3', 'Tanggal Mulai');
    $sheet->setCellValue('L3', 'Tanggal Selesai');

    $spreadsheet->getActiveSheet()->mergeCells('A1:L1');
    $spreadsheet->getActiveSheet()->getStyle('A1')->applyFromArray($headerStyle);
    $spreadsheet->getActiveSheet()->getStyle('A3:L3')->applyFromArray($borderHeaderStyle);

    $kd_prodi = $this->input->post('kd_prodi');
    $list_data = $this->report_model->get_pendaftar_mbkm_univ_prodi($kd_prodi)->result();

    $i = 4;
    $number = 1;
    foreach($list_data as $row) {
      if($row->tanggal_selesai == NULL || $row->tanggal_selesai == "" || $row->tanggal_selesai == '0000-00-00') {
        $tgl_selesai = "Sampai Sekarang";
      } else {
        $tgl_selesai = $this->tgl_indo($row->tanggal_selesai);
      }
      $sheet->setCellValue('A'.$i, $number);
      $sheet->setCellValue('B'.$i, $row->tipe);
      $sheet->setCellValue('C'.$i, $row->nama);
      $sheet->setCellValueExplicit('D'.$i, $row->nim, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
      $sheet->setCellValueExplicit('E'.$i, $row->nik, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
      $sheet->setCellValue('F'.$i, $row->nama_prodi);
      $sheet->setCellValue('G'.$i, $row->nama_program);
      $sheet->setCellValue('H'.$i, $row->riwayat);
      $sheet->setCellValue('I'.$i, $row->lokasi);
      $sheet->setCellValue('J'.$i, $row->uraian);
      $sheet->setCellValueExplicit('K'.$i, $this->tgl_indo($row->tanggal_mulai), \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
      $sheet->setCellValueExplicit('L'.$i, $tgl_selesai, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
      
      $i++;
      $number++;
    }

    $i--;
    $spreadsheet->getActiveSheet()->getStyle('A4:L'.$i--)->applyFromArray($borderBodyStyle);
    
    $writer = new Xlsx($spreadsheet);
    $filename = 'report_pendaftar_mbkm_universitas_dan_kementrian';
    
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
  }

  public function cetak_mentor_all()
  {
    $headerStyle = [
      'font' => [
          'bold' => true,
          'size' => 14
      ],
      'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
      ]
    ];

    $borderHeaderStyle = [
      'font' => [
          'bold' => true,
          'size' => 12
      ],
      'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ],
      'fill' => array(
          'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
          'startColor' => array('argb' => 'd5dadb')
      )
    ];

    $borderBodyStyle = [
      'font' => [
          'size' => 12
      ],
      'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ]
    ];

    $spreadsheet = new Spreadsheet();
    
    $sheet = $spreadsheet->getActiveSheet();
    
    $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5);
    $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(28);
    $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(28);
    $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(28);
    $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(20);
    $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(28);
    $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(15);
    $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(32);
    $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(35);
    $sheet->setCellValue('A1', 'Daftar Mentor MBKM FEB');
    $sheet->setCellValue('A3', 'No');
    $sheet->setCellValue('B3', 'Nama Mitra');
    $sheet->setCellValue('C3', 'Nama Mentor');
    $sheet->setCellValue('D3', 'Jabatan');
    $sheet->setCellValue('E3', 'Pendidikan Terakhir');
    $sheet->setCellValue('F3', 'Sertifikasi/Keahlian');
    $sheet->setCellValue('G3', 'Nomor HP');
    $sheet->setCellValue('H3', 'Email');
    $sheet->setCellValue('I3', 'Alamat');

    $spreadsheet->getActiveSheet()->mergeCells('A1:I1');
    $spreadsheet->getActiveSheet()->getStyle('A1')->applyFromArray($headerStyle);
    $spreadsheet->getActiveSheet()->getStyle('A3:I3')->applyFromArray($borderHeaderStyle);

    $list_data = $this->report_model->get_all_mentor()->result();

    $i = 4;
    $number = 1;
    foreach($list_data as $row) {
      $sheet->setCellValue('A'.$i, $number);
      $sheet->setCellValue('B'.$i, $row->nama_mitra);
      $sheet->setCellValue('C'.$i, $row->nama);
      $sheet->setCellValue('D'.$i, $row->jabatan);
      $sheet->setCellValue('E'.$i, $row->pendidikan_terakhir);
      $sheet->setCellValue('F'.$i, $row->sertifikasi_keahlian);
      $sheet->setCellValueExplicit('G'.$i, $row->phone_number, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
      $sheet->setCellValue('H'.$i, $row->email);
      $sheet->setCellValue('I'.$i, $row->alamat);
      
      $i++;
      $number++;
    }

    $i--;
    $spreadsheet->getActiveSheet()->getStyle('A4:I'.$i--)->applyFromArray($borderBodyStyle);
    
    $writer = new Xlsx($spreadsheet);
    $filename = 'report_mentor';
    
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
  }

  public function cetak_mentor_mitra()
  {
    $headerStyle = [
      'font' => [
          'bold' => true,
          'size' => 14
      ],
      'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
      ]
    ];

    $borderHeaderStyle = [
      'font' => [
          'bold' => true,
          'size' => 12
      ],
      'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ],
      'fill' => array(
          'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
          'startColor' => array('argb' => 'd5dadb')
      )
    ];

    $borderBodyStyle = [
      'font' => [
          'size' => 12
      ],
      'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ]
    ];

    $spreadsheet = new Spreadsheet();
    
    $sheet = $spreadsheet->getActiveSheet();
    
    $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5);
    $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(28);
    $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(28);
    $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(28);
    $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(20);
    $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(28);
    $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(15);
    $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(32);
    $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(35);
    $sheet->setCellValue('A1', 'Daftar Mentor MBKM FEB');
    $sheet->setCellValue('A3', 'No');
    $sheet->setCellValue('B3', 'Nama Mitra');
    $sheet->setCellValue('C3', 'Nama Mentor');
    $sheet->setCellValue('D3', 'Jabatan');
    $sheet->setCellValue('E3', 'Pendidikan Terakhir');
    $sheet->setCellValue('F3', 'Sertifikasi/Keahlian');
    $sheet->setCellValue('G3', 'Nomor HP');
    $sheet->setCellValue('H3', 'Email');
    $sheet->setCellValue('I3', 'Alamat');

    $spreadsheet->getActiveSheet()->mergeCells('A1:I1');
    $spreadsheet->getActiveSheet()->getStyle('A1')->applyFromArray($headerStyle);
    $spreadsheet->getActiveSheet()->getStyle('A3:I3')->applyFromArray($borderHeaderStyle);

    $id_mitra = $this->input->post('id_mitra');
    $list_data = $this->report_model->get_mentor_mitra($id_mitra)->result();

    $i = 4;
    $number = 1;
    foreach($list_data as $row) {
      $sheet->setCellValue('A'.$i, $number);
      $sheet->setCellValue('B'.$i, $row->nama_mitra);
      $sheet->setCellValue('C'.$i, $row->nama);
      $sheet->setCellValue('D'.$i, $row->jabatan);
      $sheet->setCellValue('E'.$i, $row->pendidikan_terakhir);
      $sheet->setCellValue('F'.$i, $row->sertifikasi_keahlian);
      $sheet->setCellValueExplicit('G'.$i, $row->phone_number, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
      $sheet->setCellValue('H'.$i, $row->email);
      $sheet->setCellValue('I'.$i, $row->alamat);
      
      $i++;
      $number++;
    }

    $i--;
    $spreadsheet->getActiveSheet()->getStyle('A4:I'.$i--)->applyFromArray($borderBodyStyle);
    
    $writer = new Xlsx($spreadsheet);
    $filename = 'report_mentor';
    
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
  }

  public function cetak_mitra_all()
  {
    $headerStyle = [
      'font' => [
          'bold' => true,
          'size' => 14
      ],
      'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
      ]
    ];

    $borderHeaderStyle = [
      'font' => [
          'bold' => true,
          'size' => 12
      ],
      'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ],
      'fill' => array(
          'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
          'startColor' => array('argb' => 'd5dadb')
      )
    ];

    $borderBodyStyle = [
      'font' => [
          'size' => 12
      ],
      'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ]
    ];

    $spreadsheet = new Spreadsheet();
    
    $sheet = $spreadsheet->getActiveSheet();
    
    $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(7);
    $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(25);
    $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(20);
    $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(15);
    $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(35);
    $sheet->setCellValue('A1', 'Daftar Mitra MBKM FEB');
    $sheet->setCellValue('A3', 'No');
    $sheet->setCellValue('B3', 'Nama');
    $sheet->setCellValue('C3', 'Email');
    $sheet->setCellValue('D3', 'Nomor HP');
    $sheet->setCellValue('E3', 'Alamat');

    $spreadsheet->getActiveSheet()->mergeCells('A1:E1');
    $spreadsheet->getActiveSheet()->getStyle('A1')->applyFromArray($headerStyle);
    $spreadsheet->getActiveSheet()->getStyle('A3:E3')->applyFromArray($borderHeaderStyle);

    $list_data = $this->report_model->get_all_mitra()->result();

    $i = 4;
    $number = 1;
    foreach($list_data as $row) {
      $sheet->setCellValue('A'.$i, $number);
      $sheet->setCellValue('B'.$i, $row->nama_mitra);
      $sheet->setCellValue('C'.$i, $row->email);
      $sheet->setCellValueExplicit('D'.$i, $row->phone_number, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
      $sheet->setCellValue('E'.$i, $row->alamat);
      
      $i++;
      $number++;
    }

    $i--;
    $spreadsheet->getActiveSheet()->getStyle('A4:E'.$i--)->applyFromArray($borderBodyStyle);
    
    $writer = new Xlsx($spreadsheet);
    $filename = 'report_mitra';
    
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
  }

  public function cetak_mahasiswa_all()
  {
		$this->load->model("report_model");
    $headerStyle = [
      'font' => [
          'bold' => true,
          'size' => 14
      ],
      'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
      ]
    ];

    $borderHeaderStyle = [
      'font' => [
          'bold' => true,
          'size' => 12
      ],
      'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ],
      'fill' => array(
          'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
          'startColor' => array('argb' => 'd5dadb')
      )
    ];

    $borderBodyStyle = [
      'font' => [
          'size' => 12
      ],
      'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ]
    ];

    $spreadsheet = new Spreadsheet();
    
    $sheet = $spreadsheet->getActiveSheet();
    
    $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(7);
    $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(25);
    $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(20);
    $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(20);
    $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(25);
    $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(20);
    $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(35);
    $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(15);
    $sheet->setCellValue('A1', 'Daftar Mahasiswa Fekon MBKM');
    $sheet->setCellValue('A3', 'No');
    $sheet->setCellValue('B3', 'Nama');
    $sheet->setCellValue('C3', 'NIM');
    $sheet->setCellValue('D3', 'NIK');
    $sheet->setCellValue('E3', 'Prodi');
    $sheet->setCellValue('F3', 'No. HP');
    $sheet->setCellValue('G3', 'Alamat');
    $sheet->setCellValue('H3', 'Angkatan');

    $spreadsheet->getActiveSheet()->mergeCells('A1:H1');
    $spreadsheet->getActiveSheet()->getStyle('A1')->applyFromArray($headerStyle);
    $spreadsheet->getActiveSheet()->getStyle('A3:H3')->applyFromArray($borderHeaderStyle);

    $list_data = $this->report_model->get_all_mahasiswa()->result();

    $i = 4;
    $number = 1;
    foreach($list_data as $row) {
      $sheet->setCellValue('A'.$i, $number);
      $sheet->setCellValue('B'.$i, $row->nama);
      $sheet->setCellValueExplicit('C'.$i, $row->nim, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
      $sheet->setCellValueExplicit('D'.$i, $row->nik, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
      $sheet->setCellValue('E'.$i, $row->nama_prodi);
      $sheet->setCellValueExplicit('F'.$i, $row->no_hp, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
      $sheet->setCellValue('G'.$i, $row->alamat);
      $sheet->setCellValue('H'.$i, $row->angkatan);
      
      $i++;
      $number++;
    }

    $i--;
    $spreadsheet->getActiveSheet()->getStyle('A4:H'.$i--)->applyFromArray($borderBodyStyle);
    
    $writer = new Xlsx($spreadsheet);
    $filename = 'report_mahasiswa';
    
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
  }

  public function cetak_mahasiswa_prodi()
  {
    $kd_prodi = $this->input->post('kd_prodi');
		$this->load->model("report_model");
    $headerStyle = [
      'font' => [
          'bold' => true,
          'size' => 14
      ],
      'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
      ]
    ];

    $borderHeaderStyle = [
      'font' => [
          'bold' => true,
          'size' => 12
      ],
      'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ],
      'fill' => array(
          'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
          'startColor' => array('argb' => 'd5dadb')
      )
    ];

    $borderBodyStyle = [
      'font' => [
          'size' => 12
      ],
      'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ]
    ];

    $spreadsheet = new Spreadsheet();
    
    $sheet = $spreadsheet->getActiveSheet();
    
    $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(7);
    $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(25);
    $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(20);
    $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(20);
    $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(25);
    $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(20);
    $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(35);
    $sheet->setCellValue('A1', 'Daftar Mahasiswa Fekon MBKM');
    $sheet->setCellValue('A3', 'No');
    $sheet->setCellValue('B3', 'Nama');
    $sheet->setCellValue('C3', 'NIM');
    $sheet->setCellValue('D3', 'NIK');
    $sheet->setCellValue('E3', 'Prodi');
    $sheet->setCellValue('F3', 'No. HP');
    $sheet->setCellValue('G3', 'Alamat');

    $spreadsheet->getActiveSheet()->mergeCells('A1:G1');
    $spreadsheet->getActiveSheet()->getStyle('A1')->applyFromArray($headerStyle);
    $spreadsheet->getActiveSheet()->getStyle('A3:G3')->applyFromArray($borderHeaderStyle);

    $list_data = $this->report_model->get_mahasiswa_prodi($kd_prodi)->result();

    $i = 4;
    $number = 1;
    foreach($list_data as $row) {
      $sheet->setCellValue('A'.$i, $number);
      $sheet->setCellValue('B'.$i, $row->nama);
      $sheet->setCellValueExplicit('C'.$i, $row->nim, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
      $sheet->setCellValueExplicit('D'.$i, $row->nik, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
      $sheet->setCellValue('E'.$i, $row->nama_prodi);
      $sheet->setCellValueExplicit('F'.$i, $row->no_hp, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
      $sheet->setCellValue('G'.$i, $row->alamat);
      
      $i++;
      $number++;
    }

    $i--;
    $spreadsheet->getActiveSheet()->getStyle('A4:G'.$i--)->applyFromArray($borderBodyStyle);
    
    $writer = new Xlsx($spreadsheet);
    $filename = 'report_mahasiswa';
    
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
  }

  public function cetak_alumni_all()
  {
    $headerStyle = [
      'font' => [
          'bold' => true,
          'size' => 14
      ],
      'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
      ]
    ];

    $borderHeaderStyle = [
      'font' => [
          'bold' => true,
          'size' => 12
      ],
      'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ],
      'fill' => array(
          'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
          'startColor' => array('argb' => 'd5dadb')
      )
    ];

    $borderBodyStyle = [
      'font' => [
          'size' => 12
      ],
      'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ]
    ];

    $spreadsheet = new Spreadsheet();
    
    $sheet = $spreadsheet->getActiveSheet();
    
    $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(7);
    $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(25);
    $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(20);
    $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(20);
    $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(25);
    $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(20);
    $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(35);
    $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(15);
    $sheet->setCellValue('A1', 'Daftar Alumni Fekon MBKM');
    $sheet->setCellValue('A3', 'No');
    $sheet->setCellValue('B3', 'Nama');
    $sheet->setCellValue('C3', 'NIM');
    $sheet->setCellValue('D3', 'NIK');
    $sheet->setCellValue('E3', 'Prodi');
    $sheet->setCellValue('F3', 'No. HP');
    $sheet->setCellValue('G3', 'Alamat');
    $sheet->setCellValue('H3', 'Tahun Lulus');

    $spreadsheet->getActiveSheet()->mergeCells('A1:H1');
    $spreadsheet->getActiveSheet()->getStyle('A1')->applyFromArray($headerStyle);
    $spreadsheet->getActiveSheet()->getStyle('A3:H3')->applyFromArray($borderHeaderStyle);

    $list_data = $this->report_model->get_all_alumni()->result();

    $i = 4;
    $number = 1;
    foreach($list_data as $row) {
      $sheet->setCellValue('A'.$i, $number);
      $sheet->setCellValue('B'.$i, $row->nama);
      $sheet->setCellValueExplicit('C'.$i, $row->nim, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
      $sheet->setCellValueExplicit('D'.$i, $row->nik, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
      $sheet->setCellValue('E'.$i, $row->nama_prodi);
      $sheet->setCellValueExplicit('F'.$i, $row->no_hp, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
      $sheet->setCellValue('G'.$i, $row->alamat);
      $sheet->setCellValue('H'.$i, $row->tahun_lulus);
      
      $i++;
      $number++;
    }

    $i--;
    $spreadsheet->getActiveSheet()->getStyle('A4:H'.$i--)->applyFromArray($borderBodyStyle);
    
    $writer = new Xlsx($spreadsheet);
    $filename = 'report_alumni';
    
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
  }

  public function cetak_alumni_prodi()
  {
    $kd_prodi = $this->input->post('kd_prodi');
    $headerStyle = [
      'font' => [
          'bold' => true,
          'size' => 14
      ],
      'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
      ]
    ];

    $borderHeaderStyle = [
      'font' => [
          'bold' => true,
          'size' => 12
      ],
      'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ],
      'fill' => array(
          'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
          'startColor' => array('argb' => 'd5dadb')
      )
    ];

    $borderBodyStyle = [
      'font' => [
          'size' => 12
      ],
      'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ]
    ];

    $spreadsheet = new Spreadsheet();
    
    $sheet = $spreadsheet->getActiveSheet();
    
    $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(7);
    $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(25);
    $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(20);
    $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(20);
    $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(25);
    $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(20);
    $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(35);
    $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(15);
    $sheet->setCellValue('A1', 'Daftar Alumni Fekon MBKM');
    $sheet->setCellValue('A3', 'No');
    $sheet->setCellValue('B3', 'Nama');
    $sheet->setCellValue('C3', 'NIM');
    $sheet->setCellValue('D3', 'NIK');
    $sheet->setCellValue('E3', 'Prodi');
    $sheet->setCellValue('F3', 'No. HP');
    $sheet->setCellValue('G3', 'Alamat');
    $sheet->setCellValue('H3', 'Tahun Lulus');

    $spreadsheet->getActiveSheet()->mergeCells('A1:H1');
    $spreadsheet->getActiveSheet()->getStyle('A1')->applyFromArray($headerStyle);
    $spreadsheet->getActiveSheet()->getStyle('A3:H3')->applyFromArray($borderHeaderStyle);

    $list_data = $this->report_model->get_alumni_prodi($kd_prodi)->result();

    $i = 4;
    $number = 1;
    foreach($list_data as $row) {
      $sheet->setCellValue('A'.$i, $number);
      $sheet->setCellValue('B'.$i, $row->nama);
      $sheet->setCellValueExplicit('C'.$i, $row->nim, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
      $sheet->setCellValueExplicit('D'.$i, $row->nik, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
      $sheet->setCellValue('E'.$i, $row->nama_prodi);
      $sheet->setCellValueExplicit('F'.$i, $row->no_hp, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
      $sheet->setCellValue('G'.$i, $row->alamat);
      $sheet->setCellValue('H'.$i, $row->tahun_lulus);
      
      $i++;
      $number++;
    }

    $i--;
    $spreadsheet->getActiveSheet()->getStyle('A4:H'.$i--)->applyFromArray($borderBodyStyle);
    
    $writer = new Xlsx($spreadsheet);
    $filename = 'report_alumni';
    
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
  }

  public function cetak_alumni_tahun()
  {
    $tahun_lulus = $this->input->post('tahun_lulus');
    $headerStyle = [
      'font' => [
          'bold' => true,
          'size' => 14
      ],
      'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
      ]
    ];

    $borderHeaderStyle = [
      'font' => [
          'bold' => true,
          'size' => 12
      ],
      'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ],
      'fill' => array(
          'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
          'startColor' => array('argb' => 'd5dadb')
      )
    ];

    $borderBodyStyle = [
      'font' => [
          'size' => 12
      ],
      'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ]
    ];

    $spreadsheet = new Spreadsheet();
    
    $sheet = $spreadsheet->getActiveSheet();
    
    $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(7);
    $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(25);
    $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(20);
    $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(20);
    $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(25);
    $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(20);
    $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(35);
    $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(15);
    $sheet->setCellValue('A1', 'Daftar Alumni Fekon MBKM');
    $sheet->setCellValue('A3', 'No');
    $sheet->setCellValue('B3', 'Nama');
    $sheet->setCellValue('C3', 'NIM');
    $sheet->setCellValue('D3', 'NIK');
    $sheet->setCellValue('E3', 'Prodi');
    $sheet->setCellValue('F3', 'No. HP');
    $sheet->setCellValue('G3', 'Alamat');
    $sheet->setCellValue('H3', 'Tahun Lulus');

    $spreadsheet->getActiveSheet()->mergeCells('A1:H1');
    $spreadsheet->getActiveSheet()->getStyle('A1')->applyFromArray($headerStyle);
    $spreadsheet->getActiveSheet()->getStyle('A3:H3')->applyFromArray($borderHeaderStyle);

    $list_data = $this->report_model->get_alumni_tahun($tahun_lulus)->result();

    $i = 4;
    $number = 1;
    foreach($list_data as $row) {
      $sheet->setCellValue('A'.$i, $number);
      $sheet->setCellValue('B'.$i, $row->nama);
      $sheet->setCellValueExplicit('C'.$i, $row->nim, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
      $sheet->setCellValueExplicit('D'.$i, $row->nik, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
      $sheet->setCellValue('E'.$i, $row->nama_prodi);
      $sheet->setCellValueExplicit('F'.$i, $row->no_hp, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
      $sheet->setCellValue('G'.$i, $row->alamat);
      $sheet->setCellValue('H'.$i, $row->tahun_lulus);
      
      $i++;
      $number++;
    }

    $i--;
    $spreadsheet->getActiveSheet()->getStyle('A4:H'.$i--)->applyFromArray($borderBodyStyle);
    
    $writer = new Xlsx($spreadsheet);
    $filename = 'report_alumni';
    
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
  }

  public function cetak_pendaftar_all()
  {
		$this->load->model("report_model");
    $headerStyle = [
      'font' => [
          'bold' => true,
          'size' => 14
      ],
      'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
      ]
    ];

    $borderHeaderStyle = [
      'font' => [
          'bold' => true,
          'size' => 12
      ],
      'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ],
      'fill' => array(
          'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
          'startColor' => array('argb' => 'd5dadb')
      )
    ];

    $borderBodyStyle = [
      'font' => [
          'size' => 12
      ],
      'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ]
    ];

    $spreadsheet = new Spreadsheet();
    
    $sheet = $spreadsheet->getActiveSheet();
    
    $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(7);
    $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(25);
    $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(20);
    $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(20);
    $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(25);
    $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(25);
    $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(25);
    $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(35);
    $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(45);
    $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(15);
    $spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(15);
    $spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(25);
    $spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(35);
    $spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(15);
    $spreadsheet->getActiveSheet()->getColumnDimension('O')->setWidth(30);
    $spreadsheet->getActiveSheet()->getColumnDimension('P')->setWidth(18);
    $sheet->setCellValue('A1', 'Daftar Pendaftar Program Kegiatan Fekon MBKM');
    $sheet->setCellValue('A3', 'No');
    $sheet->setCellValue('B3', 'Nama');
    $sheet->setCellValue('C3', 'NIM');
    $sheet->setCellValue('D3', 'NIK');
    $sheet->setCellValue('E3', 'Prodi');
    $sheet->setCellValue('F3', 'Dosen Pembimbing');
    $sheet->setCellValue('G3', 'Mentor');
    $sheet->setCellValue('H3', 'Nama Program');
    $sheet->setCellValue('I3', 'Nama Kegiatan');
    $sheet->setCellValue('J3', 'Status Pendaftaran');
    $sheet->setCellValue('K3', 'Status Kegiatan');
    $sheet->setCellValue('L3', 'No. HP');
    $sheet->setCellValue('M3', 'Alamat');
    $sheet->setCellValue('N3', 'Semester');
    $sheet->setCellValue('O3', 'Matakuliah Konversi');
    $sheet->setCellValue('P3', 'Jumlah SKS');

    $spreadsheet->getActiveSheet()->mergeCells('A1:B1');
    $spreadsheet->getActiveSheet()->getStyle('A1')->applyFromArray($headerStyle);
    $spreadsheet->getActiveSheet()->getStyle('A3:P3')->applyFromArray($borderHeaderStyle);

    $list_data = $this->report_model->get_pendaftar_mbkm()->result();

    $i = 4;
    $number = 1;
    foreach($list_data as $row) {
      $sheet->setCellValue('A'.$i, $number);
      $sheet->setCellValue('B'.$i, $row->nama);
      $sheet->setCellValueExplicit('C'.$i, $row->nim, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
      $sheet->setCellValueExplicit('D'.$i, $row->nik, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
      $sheet->setCellValue('E'.$i, $row->nama_prodi);
      $sheet->setCellValue('F'.$i, $row->nama_dosen);
      $sheet->setCellValue('G'.$i, $row->nama_mentor);
      $sheet->setCellValue('H'.$i, $row->nama_program);
      $sheet->setCellValue('I'.$i, $row->nama_kegiatan);
      $sheet->setCellValue('J'.$i, $row->status_pendaftaran);
      $sheet->setCellValue('K'.$i, $row->status_kegiatan);
      $sheet->setCellValueExplicit('L'.$i, $row->no_hp, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
      $sheet->setCellValue('M'.$i, $row->alamat);
      $sheet->setCellValue('N'.$i, $row->semester);

      $jumlah_sks = 0;
      $matakuliah = '';
      
      $data_mk = $this->report_model->get_matakuliah_konversi($row->id);

      $check_mk = $data_mk->num_rows();
      if($check_mk > 0) {
        foreach ($data_mk->result() as $show_mk) {
          $jumlah_sks = $jumlah_sks + $show_mk->sks;
          $matakuliah = $show_mk->matakuliah.','.$matakuliah;
        }
      }
      
      $sheet->setCellValue('O'.$i, $matakuliah);
      $sheet->setCellValue('P'.$i, $jumlah_sks);
      
      $i++;
      $number++;
    }

    $i--;
    $spreadsheet->getActiveSheet()->getStyle('A4:P'.$i--)->applyFromArray($borderBodyStyle);
    
    $writer = new Xlsx($spreadsheet);
    $filename = 'report_pendaftar_mbkm';
    
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
  }

  public function cetak_pendaftar_prodi()
  {
    $headerStyle = [
      'font' => [
          'bold' => true,
          'size' => 14
      ],
      'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
      ]
    ];

    $borderHeaderStyle = [
      'font' => [
          'bold' => true,
          'size' => 12
      ],
      'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ],
      'fill' => array(
          'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
          'startColor' => array('argb' => 'd5dadb')
      )
    ];

    $borderBodyStyle = [
      'font' => [
          'size' => 12
      ],
      'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ]
    ];

    $spreadsheet = new Spreadsheet();
    
    $sheet = $spreadsheet->getActiveSheet();
    
    $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(7);
    $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(25);
    $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(20);
    $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(20);
    $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(25);
    $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(25);
    $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(25);
    $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(35);
    $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(45);
    $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(15);
    $spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(15);
    $spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(25);
    $spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(35);
    $spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(15);
    $sheet->setCellValue('A1', 'Daftar Pendaftar Program Kegiatan Fekon MBKM');
    $sheet->setCellValue('A3', 'No');
    $sheet->setCellValue('B3', 'Nama');
    $sheet->setCellValue('C3', 'NIM');
    $sheet->setCellValue('D3', 'NIK');
    $sheet->setCellValue('E3', 'Prodi');
    $sheet->setCellValue('F3', 'Dosen Pembimbing');
    $sheet->setCellValue('G3', 'Mentor');
    $sheet->setCellValue('H3', 'Nama Program');
    $sheet->setCellValue('I3', 'Nama Kegiatan');
    $sheet->setCellValue('J3', 'Status Pendaftaran');
    $sheet->setCellValue('K3', 'Status Kegiatan');
    $sheet->setCellValue('L3', 'No. HP');
    $sheet->setCellValue('M3', 'Alamat');
    $sheet->setCellValue('N3', 'Semester');

    $spreadsheet->getActiveSheet()->mergeCells('A1:N1');
    $spreadsheet->getActiveSheet()->getStyle('A1')->applyFromArray($headerStyle);
    $spreadsheet->getActiveSheet()->getStyle('A3:N3')->applyFromArray($borderHeaderStyle);

    $kd_prodi = $this->input->post('kd_prodi');
    $st_daftar = $this->input->post('st_daftar');
    $st_kegiatan = $this->input->post('st_kegiatan');
    $list_data = $this->report_model->get_pendaftar_prodi($kd_prodi, $st_daftar, $st_kegiatan)->result();

    $i = 4;
    $number = 1;
    foreach($list_data as $row) {
      $sheet->setCellValue('A'.$i, $number);
      $sheet->setCellValue('B'.$i, $row->nama);
      $sheet->setCellValueExplicit('C'.$i, $row->nim, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
      $sheet->setCellValueExplicit('D'.$i, $row->nik, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
      $sheet->setCellValue('E'.$i, $row->nama_prodi);
      $sheet->setCellValue('F'.$i, $row->nama_dosen);
      $sheet->setCellValue('G'.$i, $row->nama_mentor);
      $sheet->setCellValue('H'.$i, $row->nama_program);
      $sheet->setCellValue('I'.$i, $row->nama_kegiatan);
      $sheet->setCellValue('J'.$i, $row->status_pendaftaran);
      $sheet->setCellValue('K'.$i, $row->status_kegiatan);
      $sheet->setCellValueExplicit('L'.$i, $row->no_hp, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
      $sheet->setCellValue('M'.$i, $row->alamat);
      $sheet->setCellValue('N'.$i, $row->semester);
      
      $i++;
      $number++;
    }

    $i--;
    $spreadsheet->getActiveSheet()->getStyle('A4:N'.$i--)->applyFromArray($borderBodyStyle);
    
    $writer = new Xlsx($spreadsheet);
    $filename = 'report_pendaftar_mbkm';
    
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
  }

  public function cetak_nilai() {
    $id_pendaftaran = $this->input->post('id_pendaftaran');
    $headerStyle = [
      'font' => [
          'bold' => true,
          'size' => 14
      ],
      'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
      ]
    ];

    $borderHeaderStyle = [
      'font' => [
          'bold' => true,
          'size' => 12
      ],
      'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ],
      'fill' => array(
          'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
          'startColor' => array('argb' => 'd5dadb')
      )
    ];

    $borderBodyStyle = [
      'font' => [
          'size' => 12
      ],
      'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ]
    ];

    $spreadsheet = new Spreadsheet();
    
    $sheet = $spreadsheet->getActiveSheet();

    
    $detail_mahasiswa = $this->report_model->get_mahasiswa_detail($id_pendaftaran)->row();
    
    $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(10);
    $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(2);
    $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(23);
    $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(20);
    $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(25);
    $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(15);
    $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(15);
    $sheet->setCellValue('A1', 'Nilai Mahasiswa MBKM FEB');
    $sheet->setCellValue('A2', 'Nama');
    $sheet->setCellValue('A3', 'NIM');
    $sheet->setCellValue('A4', 'Program');
    $sheet->setCellValue('A5', 'Kegiatan');
    $sheet->setCellValue('B2', ':');
    $sheet->setCellValue('B3', ':');
    $sheet->setCellValue('B4', ':');
    $sheet->setCellValue('B5', ':');
    $sheet->setCellValue('C2', $detail_mahasiswa->nama);
    $sheet->setCellValue('C3', $detail_mahasiswa->nim);
    $sheet->setCellValue('C4', $detail_mahasiswa->nama_program);
    $sheet->setCellValue('C5', $detail_mahasiswa->nama_kegiatan);
    $sheet->setCellValue('A7', 'No');
    $sheet->setCellValue('B7', 'Nama Matakuliah');
    $sheet->setCellValue('D7', 'Kode Matakuliah');
    $sheet->setCellValue('E7', 'Dosen Matakuliah');
    $sheet->setCellValue('F7', 'Nilai');
    $sheet->setCellValue('G7', 'Grade');

    $spreadsheet->getActiveSheet()->mergeCells('A1:G1');
    $spreadsheet->getActiveSheet()->mergeCells('B7:C7');
    $spreadsheet->getActiveSheet()->getStyle('A1')->applyFromArray($headerStyle);
    $spreadsheet->getActiveSheet()->getStyle('A7:G7')->applyFromArray($borderHeaderStyle);

    $list_data = $this->report_model->get_nilai($id_pendaftaran)->result();

    $i = 8;
    $number = 1;
    foreach($list_data as $row) {
      $spreadsheet->getActiveSheet()->mergeCells('B'.$i.':C'.$i);
      $sheet->setCellValue('A'.$i, $number);
      $sheet->setCellValue('B'.$i, $row->matakuliah);
      $sheet->setCellValue('D'.$i, $row->kd_mk);
      $sheet->setCellValue('E'.$i, $row->nama);
      $sheet->setCellValue('F'.$i, $row->nilai);
      $sheet->setCellValue('G'.$i, $row->grade);
      
      $i++;
      $number++;
    }

    $i--;
    $spreadsheet->getActiveSheet()->getStyle('A8:G'.$i--)->applyFromArray($borderBodyStyle);
    
    $writer = new Xlsx($spreadsheet);
    $filename = 'report_nilai';
    
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
  }

  public function cetak_nilai_all()
  {
    $headerStyle = [
      'font' => [
          'bold' => true,
          'size' => 14
      ],
      'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
      ]
    ];

    $borderHeaderStyle = [
      'font' => [
          'bold' => true,
          'size' => 12
      ],
      'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ],
      'fill' => array(
          'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
          'startColor' => array('argb' => 'd5dadb')
      )
    ];

    $borderBodyStyle = [
      'font' => [
          'size' => 12
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ]
    ];

    $textTopStyle = [
      'font' => [
          'size' => 12
      ],
      'alignment' => [
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP,
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ]
    ];

    $textTopCenterStyle = [
      'font' => [
          'size' => 12
      ],
      'alignment' => [
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP,
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ]
    ];

    $spreadsheet = new Spreadsheet();
    
    $sheet = $spreadsheet->getActiveSheet();

    $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5);
    $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(25);
    $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(25);
    $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(10);
    $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(25);
    $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(47);
    $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(17);
    $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(25);
    $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(25);
    $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(8);
    $spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(8);
    $sheet->setCellValue('A1', 'Nilai Mahasiswa MBKM FEB');
    $sheet->setCellValue('A3', 'No');
    $sheet->setCellValue('B3', 'Nama');
    $sheet->setCellValue('C3', 'Stambuk');
    $sheet->setCellValue('D3', 'Semester');
    $sheet->setCellValue('E3', 'Program');
    $sheet->setCellValue('F3', 'Kegiatan');
    $sheet->setCellValue('G3', 'Kode Matakuliah');
    $sheet->setCellValue('H3', 'Matakuliah');
    $sheet->setCellValue('I3', 'Dosen');
    $sheet->setCellValue('J3', 'Nilai');
    $sheet->setCellValue('K3', 'Grade');

    $spreadsheet->getActiveSheet()->mergeCells('A1:K1');
    $spreadsheet->getActiveSheet()->getStyle('A1')->applyFromArray($headerStyle);
    $spreadsheet->getActiveSheet()->getStyle('A3:K3')->applyFromArray($borderHeaderStyle);

    if($this->session->level == '2') {
      $list_data = $this->report_model->get_pendaftar_jur($this->session->kd_prodi)->result();
    } else {
      $list_data = $this->report_model->get_pendaftar()->result();
    }

    $i = 4;
    $number = 1;
    foreach($list_data as $row) {
      $sheet->setCellValue('A'.$i, $number);
      $sheet->setCellValue('B'.$i, $row->nama);
      $sheet->setCellValue('C'.$i, $row->nim);
      $sheet->setCellValue('D'.$i, $row->semester);
      $sheet->setCellValue('E'.$i, $row->nama_program);
      $sheet->setCellValue('F'.$i, $row->nama_kegiatan);
      
      $list_nilai = $this->report_model->get_nilai($row->id)->result();
      $temp_i = $i;
      foreach ($list_nilai as $row_nilai) {
        $sheet->setCellValue('G'.$i, $row_nilai->kd_mk);
        $sheet->setCellValue('H'.$i, $row_nilai->matakuliah);
        $sheet->setCellValue('I'.$i, $row_nilai->nama);
        $sheet->setCellValue('J'.$i, $row_nilai->nilai);
        $sheet->setCellValue('K'.$i, $row_nilai->grade);
        $i++;
      }
      $i--;
      $spreadsheet->getActiveSheet()->mergeCells('A'.$temp_i.':A'.$i);
      $spreadsheet->getActiveSheet()->mergeCells('B'.$temp_i.':B'.$i);
      $spreadsheet->getActiveSheet()->mergeCells('C'.$temp_i.':C'.$i);
      $spreadsheet->getActiveSheet()->mergeCells('D'.$temp_i.':D'.$i);
      $spreadsheet->getActiveSheet()->mergeCells('E'.$temp_i.':E'.$i);
      $spreadsheet->getActiveSheet()->mergeCells('F'.$temp_i.':F'.$i);
      
      $spreadsheet->getActiveSheet()->getStyle('A'.$temp_i)->applyFromArray($textTopCenterStyle);
      $spreadsheet->getActiveSheet()->getStyle('B'.$temp_i)->applyFromArray($textTopStyle);
      $spreadsheet->getActiveSheet()->getStyle('C'.$temp_i)->applyFromArray($textTopCenterStyle);
      $spreadsheet->getActiveSheet()->getStyle('D'.$temp_i)->applyFromArray($textTopCenterStyle);
      $spreadsheet->getActiveSheet()->getStyle('E'.$temp_i)->applyFromArray($textTopCenterStyle);
      $spreadsheet->getActiveSheet()->getStyle('F'.$temp_i)->applyFromArray($textTopStyle);
      $i++;
      $number++;
    }

    $i--;
    $spreadsheet->getActiveSheet()->getStyle('A4:K'.$i--)->applyFromArray($borderBodyStyle);
    
    $writer = new Xlsx($spreadsheet);
    $filename = 'report_nilai';
    
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
  }

  public function cetak_nilai_semester()
  {
    $headerStyle = [
      'font' => [
          'bold' => true,
          'size' => 14
      ],
      'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
      ]
    ];

    $borderHeaderStyle = [
      'font' => [
          'bold' => true,
          'size' => 12
      ],
      'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ],
      'fill' => array(
          'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
          'startColor' => array('argb' => 'd5dadb')
      )
    ];

    $borderBodyStyle = [
      'font' => [
          'size' => 12
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ]
    ];

    $textTopStyle = [
      'font' => [
          'size' => 12
      ],
      'alignment' => [
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP,
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ]
    ];

    $textTopCenterStyle = [
      'font' => [
          'size' => 12
      ],
      'alignment' => [
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP,
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ]
    ];

    $spreadsheet = new Spreadsheet();
    
    $sheet = $spreadsheet->getActiveSheet();

    $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5);
    $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(25);
    $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(25);
    $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(10);
    $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(25);
    $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(47);
    $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(17);
    $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(25);
    $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(25);
    $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(8);
    $spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(8);
    $sheet->setCellValue('A1', 'Nilai Mahasiswa MBKM FEB');
    $sheet->setCellValue('A3', 'No');
    $sheet->setCellValue('B3', 'Nama');
    $sheet->setCellValue('C3', 'Stambuk');
    $sheet->setCellValue('D3', 'Semester');
    $sheet->setCellValue('E3', 'Program');
    $sheet->setCellValue('F3', 'Kegiatan');
    $sheet->setCellValue('G3', 'Kode Matakuliah');
    $sheet->setCellValue('H3', 'Matakuliah');
    $sheet->setCellValue('I3', 'Dosen');
    $sheet->setCellValue('J3', 'Nilai');
    $sheet->setCellValue('K3', 'Grade');

    $spreadsheet->getActiveSheet()->mergeCells('A1:K1');
    $spreadsheet->getActiveSheet()->getStyle('A1')->applyFromArray($headerStyle);
    $spreadsheet->getActiveSheet()->getStyle('A3:K3')->applyFromArray($borderHeaderStyle);

    if($this->session->level == '2') {
      $list_data = $this->report_model->get_pendaftar_jur_semester($this->session->kd_prodi, $this->input->post('semester'))->result();
    } else {
      $list_data = $this->report_model->get_pendaftar_semester($this->input->post('semester'))->result();
    }

    $i = 4;
    $number = 1;
    foreach($list_data as $row) {
      $sheet->setCellValue('A'.$i, $number);
      $sheet->setCellValue('B'.$i, $row->nama);
      $sheet->setCellValue('C'.$i, $row->nim);
      $sheet->setCellValue('D'.$i, $row->semester);
      $sheet->setCellValue('E'.$i, $row->nama_program);
      $sheet->setCellValue('F'.$i, $row->nama_kegiatan);
      
      $list_nilai = $this->report_model->get_nilai($row->id)->result();
      $temp_i = $i;
      foreach ($list_nilai as $row_nilai) {
        $sheet->setCellValue('G'.$i, $row_nilai->kd_mk);
        $sheet->setCellValue('H'.$i, $row_nilai->matakuliah);
        $sheet->setCellValue('I'.$i, $row_nilai->nama);
        $sheet->setCellValue('J'.$i, $row_nilai->nilai);
        $sheet->setCellValue('K'.$i, $row_nilai->grade);
        $i++;
      }
      $i--;
      $spreadsheet->getActiveSheet()->mergeCells('A'.$temp_i.':A'.$i);
      $spreadsheet->getActiveSheet()->mergeCells('B'.$temp_i.':B'.$i);
      $spreadsheet->getActiveSheet()->mergeCells('C'.$temp_i.':C'.$i);
      $spreadsheet->getActiveSheet()->mergeCells('D'.$temp_i.':D'.$i);
      $spreadsheet->getActiveSheet()->mergeCells('E'.$temp_i.':E'.$i);
      $spreadsheet->getActiveSheet()->mergeCells('F'.$temp_i.':F'.$i);
      
      $spreadsheet->getActiveSheet()->getStyle('A'.$temp_i)->applyFromArray($textTopCenterStyle);
      $spreadsheet->getActiveSheet()->getStyle('B'.$temp_i)->applyFromArray($textTopStyle);
      $spreadsheet->getActiveSheet()->getStyle('C'.$temp_i)->applyFromArray($textTopCenterStyle);
      $spreadsheet->getActiveSheet()->getStyle('D'.$temp_i)->applyFromArray($textTopCenterStyle);
      $spreadsheet->getActiveSheet()->getStyle('E'.$temp_i)->applyFromArray($textTopCenterStyle);
      $spreadsheet->getActiveSheet()->getStyle('F'.$temp_i)->applyFromArray($textTopStyle);
      $i++;
      $number++;
    }

    $i--;
    $spreadsheet->getActiveSheet()->getStyle('A4:K'.$i--)->applyFromArray($borderBodyStyle);
    
    $writer = new Xlsx($spreadsheet);
    $filename = 'report_nilai';
    
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
  }

  public function data_lulusan_6_bln()
  {
    $headerStyle = [
      'font' => [
          'bold' => true,
          'size' => 14
      ],
      'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
      ]
    ];

    $borderHeaderStyle = [
      'font' => [
          'bold' => true,
          'size' => 11
      ],
      'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
          'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ],
      'fill' => array(
          'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
          'startColor' => array('argb' => 'fcba03')
      )
    ];

    $borderBodyStyle = [
      'font' => [
          'size' => 11
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ]
    ];

    $borderBodyCenterStyle = [
      'font' => [
          'size' => 11
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ],
      'alignment' => [
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
      ],
    ];

    $borderBodyRightStyle = [
      'font' => [
          'size' => 11
      ],
      'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
      ],
      'alignment' => [
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
      ],
    ];

    $textTopStyle = [
      'font' => [
          'size' => 11
      ],
      'alignment' => [
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP,
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ]
    ];

    $textTopCenterStyle = [
      'font' => [
          'size' => 11
      ],
      'alignment' => [
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP,
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ]
    ];

    $spreadsheet = new Spreadsheet();
    
    $sheet = $spreadsheet->getActiveSheet();

    if ($this->input->post('jenis_print') == '1') {
      $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5);
      $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(30);
      $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(15);
      $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(13);
      $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(13);
      $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(12);
      $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(30);
      $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(13);
      $sheet->setCellValue('A1', 'DATA LULUSAN DENGAN MASA TUNGGU < 6 BULAN DAN GAJI > 1,2 KALI UMR');
      $sheet->setCellValue('A2', 'FAKULTAS EKONOMI DAN BISNIS UNIVERSITAS TADULAKO');
      $sheet->setCellValue('A4', 'No');
      $sheet->setCellValue('B4', 'Nama');
      $sheet->setCellValue('C4', 'Jenjang Studi');
      $sheet->setCellValue('D4', 'Prodi');
      $sheet->setCellValue('E4', 'Tahun Lulus');
      $sheet->setCellValue('F4', 'Masa Tunggu (Bulan)');
      $sheet->setCellValue('G4', 'Tempat Kerja');
      $sheet->setCellValue('H4', 'Penghasilan');

      $spreadsheet->getActiveSheet()->mergeCells('A1:H1');
      $spreadsheet->getActiveSheet()->getStyle('A1')->applyFromArray($headerStyle);
      $spreadsheet->getActiveSheet()->mergeCells('A2:H2');
      $spreadsheet->getActiveSheet()->getStyle('A2')->applyFromArray($headerStyle);
      $spreadsheet->getActiveSheet()->getStyle('A4:H4')->applyFromArray($borderHeaderStyle);
      $spreadsheet->getActiveSheet()->getStyle('A4:H4')->getAlignment()->setWrapText(true);

      $list_data = $this->report_model->get_pendidikan_yudisium()->result();
  
      $umr = 2303711;
      $gaji_1_2_kali = $umr * 1.2; //2,764,453.2
  
      $i = 5;
      $number = 1;
      foreach ($list_data as $row) {
        $list_lulusan = $this->report_model->get_lulusan_pekerjaan($row->id_mhsw, $row->tanggal_yudisium, $gaji_1_2_kali)->result();
        foreach ($list_lulusan as $row_1) {
          $sheet->setCellValue('A'.$i, $number);
          $sheet->setCellValue('B'.$i, $row_1->nama);
          $sheet->setCellValue('C'.$i, $row->jenjang);
          $sheet->setCellValue('D'.$i, $row->nama_prodi);
          $sheet->setCellValue('E'.$i, $row->tahun_lulus);
          $sheet->setCellValue('F'.$i, $row_1->masa_tunggu);
          $sheet->setCellValue('G'.$i, $row_1->nama_perusahaan);
          $sheet->setCellValue('H'.$i, "Rp " . number_format($row_1->gaji,0,',-','.'));
          $i++;
          $number++;
        }
      }
      
      $i--;
      $count = $i--;
      $spreadsheet->getActiveSheet()->getStyle('A5:A'.$count)->applyFromArray($borderBodyCenterStyle);
      $spreadsheet->getActiveSheet()->getStyle('B5:B'.$count)->applyFromArray($borderBodyStyle);
      $spreadsheet->getActiveSheet()->getStyle('C5:E'.$count)->applyFromArray($borderBodyCenterStyle);
      $spreadsheet->getActiveSheet()->getStyle('F5:G'.$count)->applyFromArray($borderBodyStyle);
      $spreadsheet->getActiveSheet()->getStyle('H5:H'.$count)->applyFromArray($borderBodyRightStyle);
    } elseif ($this->input->post('jenis_print') == '2') {
      $prodi = $this->report_model->get_prodi_one($this->input->post('kd_prodi'))->row();

      $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5);
      $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(30);
      $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(15);
      $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(13);
      $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(13);
      $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(12);
      $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(30);
      $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(13);
      $sheet->setCellValue('A1', 'DATA LULUSAN DENGAN MASA TUNGGU < 6 BULAN DAN GAJI > 1,2 KALI UMR');
      $sheet->setCellValue('A2', 'PROGRAM STUDI '.$prodi->nama_prodi);
      $sheet->setCellValue('A3', 'FAKULTAS EKONOMI DAN BISNIS UNIVERSITAS TADULAKO');
      $sheet->setCellValue('A5', 'No');
      $sheet->setCellValue('B5', 'Nama');
      $sheet->setCellValue('C5', 'Jenjang Studi');
      $sheet->setCellValue('D5', 'Prodi');
      $sheet->setCellValue('E5', 'Tahun Lulus');
      $sheet->setCellValue('F5', 'Masa Tunggu (Bulan)');
      $sheet->setCellValue('G5', 'Tempat Kerja');
      $sheet->setCellValue('H5', 'Penghasilan');

      $spreadsheet->getActiveSheet()->mergeCells('A1:H1');
      $spreadsheet->getActiveSheet()->getStyle('A1')->applyFromArray($headerStyle);
      $spreadsheet->getActiveSheet()->mergeCells('A2:H2');
      $spreadsheet->getActiveSheet()->getStyle('A2')->applyFromArray($headerStyle);
      $spreadsheet->getActiveSheet()->mergeCells('A3:H3');
      $spreadsheet->getActiveSheet()->getStyle('A3')->applyFromArray($headerStyle);
      $spreadsheet->getActiveSheet()->getStyle('A5:H5')->applyFromArray($borderHeaderStyle);
      $spreadsheet->getActiveSheet()->getStyle('A5:H5')->getAlignment()->setWrapText(true);


      $list_data = $this->report_model->get_pendidikan_yudisium_prodi($this->input->post('kd_prodi'))->result();

      $umr = 2303711;
      $gaji_1_2_kali = $umr * 1.2; //2,764,453.2

      $i = 6;
      $number = 1;
      foreach ($list_data as $row) {
        $list_lulusan = $this->report_model->get_lulusan_pekerjaan($row->id_mhsw, $row->tanggal_yudisium, $gaji_1_2_kali)->result();
        foreach ($list_lulusan as $row_1) {
          $sheet->setCellValue('A'.$i, $number);
          $sheet->setCellValue('B'.$i, $row_1->nama);
          $sheet->setCellValue('C'.$i, $row->jenjang);
          $sheet->setCellValue('D'.$i, $row->nama_prodi);
          $sheet->setCellValue('E'.$i, $row->tahun_lulus);
          $sheet->setCellValue('F'.$i, $row_1->masa_tunggu);
          $sheet->setCellValue('G'.$i, $row_1->nama_perusahaan);
          $sheet->setCellValue('H'.$i, "Rp " . number_format($row_1->gaji,0,',-','.'));
          $i++;
          $number++;
        }
      }
      
      $i--;
      $count = $i--;
      $spreadsheet->getActiveSheet()->getStyle('A5:A'.$count)->applyFromArray($borderBodyCenterStyle);
      $spreadsheet->getActiveSheet()->getStyle('B5:B'.$count)->applyFromArray($borderBodyStyle);
      $spreadsheet->getActiveSheet()->getStyle('C5:E'.$count)->applyFromArray($borderBodyCenterStyle);
      $spreadsheet->getActiveSheet()->getStyle('F5:G'.$count)->applyFromArray($borderBodyStyle);
      $spreadsheet->getActiveSheet()->getStyle('H5:H'.$count)->applyFromArray($borderBodyRightStyle);
    } elseif ($this->input->post('jenis_print') == '3') {
      $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5);
      $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(30);
      $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(15);
      $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(13);
      $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(13);
      $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(12);
      $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(30);
      $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(13);
      $sheet->setCellValue('A1', 'DATA LULUSAN DENGAN MASA TUNGGU < 6 BULAN DAN GAJI > 1,2 KALI UMR');
      $sheet->setCellValue('A2', 'FAKULTAS EKONOMI DAN BISNIS UNIVERSITAS TADULAKO');
      $sheet->setCellValue('A4', 'No');
      $sheet->setCellValue('B4', 'Nama');
      $sheet->setCellValue('C4', 'Jenjang Studi');
      $sheet->setCellValue('D4', 'Prodi');
      $sheet->setCellValue('E4', 'Tahun Lulus');
      $sheet->setCellValue('F4', 'Masa Tunggu (Bulan)');
      $sheet->setCellValue('G4', 'Tempat Kerja');
      $sheet->setCellValue('H4', 'Penghasilan');

      $spreadsheet->getActiveSheet()->mergeCells('A1:H1');
      $spreadsheet->getActiveSheet()->getStyle('A1')->applyFromArray($headerStyle);
      $spreadsheet->getActiveSheet()->mergeCells('A2:H2');
      $spreadsheet->getActiveSheet()->getStyle('A2')->applyFromArray($headerStyle);
      $spreadsheet->getActiveSheet()->getStyle('A4:H4')->applyFromArray($borderHeaderStyle);
      $spreadsheet->getActiveSheet()->getStyle('A4:H4')->getAlignment()->setWrapText(true);

      $list_data = $this->report_model->get_pendidikan_yudisium_tanggal($this->input->post('date_from'), $this->input->post('date_to'))->result();
  
      $umr = 2303711;
      $gaji_1_2_kali = $umr * 1.2; //2,764,453.2
  
      $i = 5;
      $number = 1;
      foreach ($list_data as $row) {
        $list_lulusan = $this->report_model->get_lulusan_pekerjaan($row->id_mhsw, $row->tanggal_yudisium, $gaji_1_2_kali)->result();
        foreach ($list_lulusan as $row_1) {
          $sheet->setCellValue('A'.$i, $number);
          $sheet->setCellValue('B'.$i, $row_1->nama);
          $sheet->setCellValue('C'.$i, $row->jenjang);
          $sheet->setCellValue('D'.$i, $row->nama_prodi);
          $sheet->setCellValue('E'.$i, $row->tahun_lulus);
          $sheet->setCellValue('F'.$i, $row_1->masa_tunggu);
          $sheet->setCellValue('G'.$i, $row_1->nama_perusahaan);
          $sheet->setCellValue('H'.$i, "Rp " . number_format($row_1->gaji,0,',-','.'));
          $i++;
          $number++;
        }
      }
      
      $i--;
      $count = $i--;
      $spreadsheet->getActiveSheet()->getStyle('A5:A'.$count)->applyFromArray($borderBodyCenterStyle);
      $spreadsheet->getActiveSheet()->getStyle('B5:B'.$count)->applyFromArray($borderBodyStyle);
      $spreadsheet->getActiveSheet()->getStyle('C5:E'.$count)->applyFromArray($borderBodyCenterStyle);
      $spreadsheet->getActiveSheet()->getStyle('F5:G'.$count)->applyFromArray($borderBodyStyle);
      $spreadsheet->getActiveSheet()->getStyle('H5:H'.$count)->applyFromArray($borderBodyRightStyle);
    } elseif ($this->input->post('jenis_print') == '4') {
      $prodi = $this->report_model->get_prodi_one($this->input->post('kd_prodi'))->row();

      $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5);
      $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(30);
      $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(15);
      $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(13);
      $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(13);
      $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(12);
      $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(30);
      $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(13);
      $sheet->setCellValue('A1', 'DATA LULUSAN DENGAN MASA TUNGGU < 6 BULAN DAN GAJI > 1,2 KALI UMR');
      $sheet->setCellValue('A2', 'PROGRAM STUDI '.$prodi->nama_prodi);
      $sheet->setCellValue('A3', 'FAKULTAS EKONOMI DAN BISNIS UNIVERSITAS TADULAKO');
      $sheet->setCellValue('A5', 'No');
      $sheet->setCellValue('B5', 'Nama');
      $sheet->setCellValue('C5', 'Jenjang Studi');
      $sheet->setCellValue('D5', 'Prodi');
      $sheet->setCellValue('E5', 'Tahun Lulus');
      $sheet->setCellValue('F5', 'Masa Tunggu (Bulan)');
      $sheet->setCellValue('G5', 'Tempat Kerja');
      $sheet->setCellValue('H5', 'Penghasilan');

      $spreadsheet->getActiveSheet()->mergeCells('A1:H1');
      $spreadsheet->getActiveSheet()->getStyle('A1')->applyFromArray($headerStyle);
      $spreadsheet->getActiveSheet()->mergeCells('A2:H2');
      $spreadsheet->getActiveSheet()->getStyle('A2')->applyFromArray($headerStyle);
      $spreadsheet->getActiveSheet()->mergeCells('A3:H3');
      $spreadsheet->getActiveSheet()->getStyle('A3')->applyFromArray($headerStyle);
      $spreadsheet->getActiveSheet()->getStyle('A5:H5')->applyFromArray($borderHeaderStyle);
      $spreadsheet->getActiveSheet()->getStyle('A5:H5')->getAlignment()->setWrapText(true);

      $list_data = $this->report_model->get_pendidikan_yudisium_prodi_tanggal($this->input->post('kd_prodi'),$this->input->post('date_from'), $this->input->post('date_to'))->result();

      $umr = 2303711;
      $gaji_1_2_kali = $umr * 1.2; //2,764,453.2

      $i = 6;
      $number = 1;
      foreach ($list_data as $row) {
        $list_lulusan = $this->report_model->get_lulusan_pekerjaan($row->id_mhsw, $row->tanggal_yudisium, $gaji_1_2_kali)->result();
        foreach ($list_lulusan as $row_1) {
          $sheet->setCellValue('A'.$i, $number);
          $sheet->setCellValue('B'.$i, $row_1->nama);
          $sheet->setCellValue('C'.$i, $row->jenjang);
          $sheet->setCellValue('D'.$i, $row->nama_prodi);
          $sheet->setCellValue('E'.$i, $row->tahun_lulus);
          $sheet->setCellValue('F'.$i, $row_1->masa_tunggu);
          $sheet->setCellValue('G'.$i, $row_1->nama_perusahaan);
          $sheet->setCellValue('H'.$i, "Rp " . number_format($row_1->gaji,0,',-','.'));
          $i++;
          $number++;
        }
      }
      
      $i--;
      $count = $i--;
      $spreadsheet->getActiveSheet()->getStyle('A5:A'.$count)->applyFromArray($borderBodyCenterStyle);
      $spreadsheet->getActiveSheet()->getStyle('B5:B'.$count)->applyFromArray($borderBodyStyle);
      $spreadsheet->getActiveSheet()->getStyle('C5:E'.$count)->applyFromArray($borderBodyCenterStyle);
      $spreadsheet->getActiveSheet()->getStyle('F5:G'.$count)->applyFromArray($borderBodyStyle);
      $spreadsheet->getActiveSheet()->getStyle('H5:H'.$count)->applyFromArray($borderBodyRightStyle);
    }


    
    $writer = new Xlsx($spreadsheet);
    $filename = 'REPORT DATA LULUSAN DENGAN MASA TUNGGU KD 6 BULAN DAN GAJI LD 1,2 KALI UMR';
    
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
  }

  public function data_lulusan_1_2_kali()
  {
    $headerStyle = [
      'font' => [
          'bold' => true,
          'size' => 14
      ],
      'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
      ]
    ];

    $borderHeaderStyle = [
      'font' => [
          'bold' => true,
          'size' => 11
      ],
      'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
          'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ],
      'fill' => array(
          'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
          'startColor' => array('argb' => 'fcba03')
      )
    ];

    $borderBodyStyle = [
      'font' => [
          'size' => 11
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ]
    ];

    $borderBodyCenterStyle = [
      'font' => [
          'size' => 11
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ],
      'alignment' => [
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
      ],
    ];

    $borderBodyRightStyle = [
      'font' => [
          'size' => 11
      ],
      'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
      ],
      'alignment' => [
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
      ],
    ];

    $textTopStyle = [
      'font' => [
          'size' => 11
      ],
      'alignment' => [
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP,
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ]
    ];

    $textTopCenterStyle = [
      'font' => [
          'size' => 11
      ],
      'alignment' => [
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP,
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ]
    ];

    $spreadsheet = new Spreadsheet();
    
    $sheet = $spreadsheet->getActiveSheet();

    if ($this->input->post('jenis_print') == '1') {
      $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5);
      $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(30);
      $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(15);
      $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(13);
      $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(13);
      $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(15);
      $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(30);
      $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(13);
      $sheet->setCellValue('A1', 'DATA LULUSAN YANG TELAH BERPENGHASILAN > 1,2 KALI UMR SEBELUM LULUS');
      $sheet->setCellValue('A2', 'FAKULTAS EKONOMI DAN BISNIS UNIVERSITAS TADULAKO');
      $sheet->setCellValue('A4', 'No');
      $sheet->setCellValue('B4', 'Nama');
      $sheet->setCellValue('C4', 'Jenjang Studi');
      $sheet->setCellValue('D4', 'Prodi');
      $sheet->setCellValue('E4', 'Tahun Lulus');
      $sheet->setCellValue('F4', 'Jenis Pekerjaan');
      $sheet->setCellValue('G4', 'Tempat Kerja');
      $sheet->setCellValue('H4', 'Penghasilan');

      $spreadsheet->getActiveSheet()->mergeCells('A1:H1');
      $spreadsheet->getActiveSheet()->getStyle('A1')->applyFromArray($headerStyle);
      $spreadsheet->getActiveSheet()->mergeCells('A2:H2');
      $spreadsheet->getActiveSheet()->getStyle('A2')->applyFromArray($headerStyle);
      $spreadsheet->getActiveSheet()->getStyle('A4:H4')->applyFromArray($borderHeaderStyle);
      $spreadsheet->getActiveSheet()->getStyle('A4:H4')->getAlignment()->setWrapText(true);

      $list_data = $this->report_model->get_pendidikan_yudisium()->result();
  
      $umr = 2303711;
      $gaji_1_2_kali = $umr * 1.2; //2,764,453.2
  
      $i = 5;
      $number = 1;
      foreach ($list_data as $row) {
        $list_lulusan = $this->report_model->get_lulusan_sebelum_kerja($row->id_mhsw, $row->tanggal_yudisium, $gaji_1_2_kali)->result();
        foreach ($list_lulusan as $row_1) {
          $sheet->setCellValue('A'.$i, $number);
          $sheet->setCellValue('B'.$i, $row_1->nama);
          $sheet->setCellValue('C'.$i, $row->jenjang);
          $sheet->setCellValue('D'.$i, $row->nama_prodi);
          $sheet->setCellValue('E'.$i, $row->tahun_lulus);
          $sheet->setCellValue('F'.$i, $row_1->bergerak_bidang);
          $sheet->setCellValue('G'.$i, $row_1->nama_perusahaan);
          $sheet->setCellValue('H'.$i, "Rp " . number_format($row_1->gaji,0,',-','.'));
          $i++;
          $number++;
        }
      }
      
      $i--;
      $count = $i--;
      $spreadsheet->getActiveSheet()->getStyle('A5:A'.$count)->applyFromArray($borderBodyCenterStyle);
      $spreadsheet->getActiveSheet()->getStyle('B5:B'.$count)->applyFromArray($borderBodyStyle);
      $spreadsheet->getActiveSheet()->getStyle('C5:E'.$count)->applyFromArray($borderBodyCenterStyle);
      $spreadsheet->getActiveSheet()->getStyle('F5:G'.$count)->applyFromArray($borderBodyStyle);
      $spreadsheet->getActiveSheet()->getStyle('H5:H'.$count)->applyFromArray($borderBodyRightStyle);
    } elseif ($this->input->post('jenis_print') == '2') {
      $prodi = $this->report_model->get_prodi_one($this->input->post('kd_prodi'))->row();

      $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5);
      $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(30);
      $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(15);
      $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(13);
      $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(13);
      $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(12);
      $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(30);
      $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(13);
      $sheet->setCellValue('A1', 'DATA LULUSAN YANG TELAH BERPENGHASILAN > 1,2 KALI UMR SEBELUM LULUS');
      $sheet->setCellValue('A2', 'PROGRAM STUDI '.$prodi->nama_prodi);
      $sheet->setCellValue('A3', 'FAKULTAS EKONOMI DAN BISNIS UNIVERSITAS TADULAKO');
      $sheet->setCellValue('A5', 'No');
      $sheet->setCellValue('B5', 'Nama');
      $sheet->setCellValue('C5', 'Jenjang Studi');
      $sheet->setCellValue('D5', 'Prodi');
      $sheet->setCellValue('E5', 'Tahun Lulus');
      $sheet->setCellValue('F5', 'Jenis Pekerjaan');
      $sheet->setCellValue('G5', 'Tempat Kerja');
      $sheet->setCellValue('H5', 'Penghasilan');

      $spreadsheet->getActiveSheet()->mergeCells('A1:H1');
      $spreadsheet->getActiveSheet()->getStyle('A1')->applyFromArray($headerStyle);
      $spreadsheet->getActiveSheet()->mergeCells('A2:H2');
      $spreadsheet->getActiveSheet()->getStyle('A2')->applyFromArray($headerStyle);
      $spreadsheet->getActiveSheet()->mergeCells('A3:H3');
      $spreadsheet->getActiveSheet()->getStyle('A3')->applyFromArray($headerStyle);
      $spreadsheet->getActiveSheet()->getStyle('A5:H5')->applyFromArray($borderHeaderStyle);
      $spreadsheet->getActiveSheet()->getStyle('A5:H5')->getAlignment()->setWrapText(true);

      $list_data = $this->report_model->get_pendidikan_yudisium_prodi($this->input->post('kd_prodi'))->result();

      $umr = 2303711;
      $gaji_1_2_kali = $umr * 1.2; //2,764,453.2

      $i = 6;
      $number = 1;
      foreach ($list_data as $row) {
        $list_lulusan = $this->report_model->get_lulusan_sebelum_kerja($row->id_mhsw, $row->tanggal_yudisium, $gaji_1_2_kali)->result();
        foreach ($list_lulusan as $row_1) {
          $sheet->setCellValue('A'.$i, $number);
          $sheet->setCellValue('B'.$i, $row_1->nama);
          $sheet->setCellValue('C'.$i, $row->jenjang);
          $sheet->setCellValue('D'.$i, $row->nama_prodi);
          $sheet->setCellValue('E'.$i, $row->tahun_lulus);
          $sheet->setCellValue('F'.$i, $row_1->bergerak_bidang);
          $sheet->setCellValue('G'.$i, $row_1->nama_perusahaan);
          $sheet->setCellValue('H'.$i, "Rp " . number_format($row_1->gaji,0,',-','.'));
          $i++;
          $number++;
        }
      }
      
      $i--;
      $count = $i--;
      $spreadsheet->getActiveSheet()->getStyle('A5:A'.$count)->applyFromArray($borderBodyCenterStyle);
      $spreadsheet->getActiveSheet()->getStyle('B5:B'.$count)->applyFromArray($borderBodyStyle);
      $spreadsheet->getActiveSheet()->getStyle('C5:E'.$count)->applyFromArray($borderBodyCenterStyle);
      $spreadsheet->getActiveSheet()->getStyle('F5:G'.$count)->applyFromArray($borderBodyStyle);
      $spreadsheet->getActiveSheet()->getStyle('H5:H'.$count)->applyFromArray($borderBodyRightStyle);
    } elseif ($this->input->post('jenis_print') == '3') {
      $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5);
      $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(30);
      $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(15);
      $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(13);
      $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(13);
      $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(15);
      $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(30);
      $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(13);
      $sheet->setCellValue('A1', 'DATA LULUSAN YANG TELAH BERPENGHASILAN > 1,2 KALI UMR SEBELUM LULUS');
      $sheet->setCellValue('A2', 'FAKULTAS EKONOMI DAN BISNIS UNIVERSITAS TADULAKO');
      $sheet->setCellValue('A4', 'No');
      $sheet->setCellValue('B4', 'Nama');
      $sheet->setCellValue('C4', 'Jenjang Studi');
      $sheet->setCellValue('D4', 'Prodi');
      $sheet->setCellValue('E4', 'Tahun Lulus');
      $sheet->setCellValue('F4', 'Jenis Pekerjaan');
      $sheet->setCellValue('G4', 'Tempat Kerja');
      $sheet->setCellValue('H4', 'Penghasilan');

      $spreadsheet->getActiveSheet()->mergeCells('A1:H1');
      $spreadsheet->getActiveSheet()->getStyle('A1')->applyFromArray($headerStyle);
      $spreadsheet->getActiveSheet()->mergeCells('A2:H2');
      $spreadsheet->getActiveSheet()->getStyle('A2')->applyFromArray($headerStyle);
      $spreadsheet->getActiveSheet()->getStyle('A4:H4')->applyFromArray($borderHeaderStyle);
      $spreadsheet->getActiveSheet()->getStyle('A4:H4')->getAlignment()->setWrapText(true);

      $list_data = $this->report_model->get_pendidikan_yudisium_tanggal($this->input->post('date_from'), $this->input->post('date_to'))->result();
  
      $umr = 2303711;
      $gaji_1_2_kali = $umr * 1.2; //2,764,453.2
  
      $i = 5;
      $number = 1;
      foreach ($list_data as $row) {
        $list_lulusan = $this->report_model->get_lulusan_sebelum_kerja($row->id_mhsw, $row->tanggal_yudisium, $gaji_1_2_kali)->result();
        foreach ($list_lulusan as $row_1) {
          $sheet->setCellValue('A'.$i, $number);
          $sheet->setCellValue('B'.$i, $row_1->nama);
          $sheet->setCellValue('C'.$i, $row->jenjang);
          $sheet->setCellValue('D'.$i, $row->nama_prodi);
          $sheet->setCellValue('E'.$i, $row->tahun_lulus);
          $sheet->setCellValue('F'.$i, $row_1->bergerak_bidang);
          $sheet->setCellValue('G'.$i, $row_1->nama_perusahaan);
          $sheet->setCellValue('H'.$i, "Rp " . number_format($row_1->gaji,0,',-','.'));
          $i++;
          $number++;
        }
      }
      
      $i--;
      $count = $i--;
      $spreadsheet->getActiveSheet()->getStyle('A5:A'.$count)->applyFromArray($borderBodyCenterStyle);
      $spreadsheet->getActiveSheet()->getStyle('B5:B'.$count)->applyFromArray($borderBodyStyle);
      $spreadsheet->getActiveSheet()->getStyle('C5:E'.$count)->applyFromArray($borderBodyCenterStyle);
      $spreadsheet->getActiveSheet()->getStyle('F5:G'.$count)->applyFromArray($borderBodyStyle);
      $spreadsheet->getActiveSheet()->getStyle('H5:H'.$count)->applyFromArray($borderBodyRightStyle);
    } elseif ($this->input->post('jenis_print') == '4') {
      $prodi = $this->report_model->get_prodi_one($this->input->post('kd_prodi'))->row();

      $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5);
      $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(30);
      $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(15);
      $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(13);
      $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(13);
      $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(12);
      $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(30);
      $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(13);
      $sheet->setCellValue('A1', 'DATA LULUSAN YANG TELAH BERPENGHASILAN > 1,2 KALI UMR SEBELUM LULUS');
      $sheet->setCellValue('A2', 'PROGRAM STUDI '.$prodi->nama_prodi);
      $sheet->setCellValue('A3', 'FAKULTAS EKONOMI DAN BISNIS UNIVERSITAS TADULAKO');
      $sheet->setCellValue('A5', 'No');
      $sheet->setCellValue('B5', 'Nama');
      $sheet->setCellValue('C5', 'Jenjang Studi');
      $sheet->setCellValue('D5', 'Prodi');
      $sheet->setCellValue('E5', 'Tahun Lulus');
      $sheet->setCellValue('F5', 'Jenis Pekerjaan');
      $sheet->setCellValue('G5', 'Tempat Kerja');
      $sheet->setCellValue('H5', 'Penghasilan');

      $spreadsheet->getActiveSheet()->mergeCells('A1:H1');
      $spreadsheet->getActiveSheet()->getStyle('A1')->applyFromArray($headerStyle);
      $spreadsheet->getActiveSheet()->mergeCells('A2:H2');
      $spreadsheet->getActiveSheet()->getStyle('A2')->applyFromArray($headerStyle);
      $spreadsheet->getActiveSheet()->mergeCells('A3:H3');
      $spreadsheet->getActiveSheet()->getStyle('A3')->applyFromArray($headerStyle);
      $spreadsheet->getActiveSheet()->getStyle('A5:H5')->applyFromArray($borderHeaderStyle);
      $spreadsheet->getActiveSheet()->getStyle('A5:H5')->getAlignment()->setWrapText(true);

      $list_data = $this->report_model->get_pendidikan_yudisium_prodi_tanggal($this->input->post('kd_prodi'),$this->input->post('date_from'), $this->input->post('date_to'))->result();

      $umr = 2303711;
      $gaji_1_2_kali = $umr * 1.2; //2,764,453.2

      $i = 6;
      $number = 1;
      foreach ($list_data as $row) {
        $list_lulusan = $this->report_model->get_lulusan_sebelum_kerja($row->id_mhsw, $row->tanggal_yudisium, $gaji_1_2_kali)->result();
        foreach ($list_lulusan as $row_1) {
          $sheet->setCellValue('A'.$i, $number);
          $sheet->setCellValue('B'.$i, $row_1->nama);
          $sheet->setCellValue('C'.$i, $row->jenjang);
          $sheet->setCellValue('D'.$i, $row->nama_prodi);
          $sheet->setCellValue('E'.$i, $row->tahun_lulus);
          $sheet->setCellValue('F'.$i, $row_1->bergerak_bidang);
          $sheet->setCellValue('G'.$i, $row_1->nama_perusahaan);
          $sheet->setCellValue('H'.$i, "Rp " . number_format($row_1->gaji,0,',-','.'));
          $i++;
          $number++;
        }
      }
      
      $i--;
      $count = $i--;
      $spreadsheet->getActiveSheet()->getStyle('A5:A'.$count)->applyFromArray($borderBodyCenterStyle);
      $spreadsheet->getActiveSheet()->getStyle('B5:B'.$count)->applyFromArray($borderBodyStyle);
      $spreadsheet->getActiveSheet()->getStyle('C5:E'.$count)->applyFromArray($borderBodyCenterStyle);
      $spreadsheet->getActiveSheet()->getStyle('F5:G'.$count)->applyFromArray($borderBodyStyle);
      $spreadsheet->getActiveSheet()->getStyle('H5:H'.$count)->applyFromArray($borderBodyRightStyle);
    }


    
    $writer = new Xlsx($spreadsheet);
    $filename = 'REPORT DATA LULUSAN YANG TELAH BERPENGHASILAN LD 1,2 KALI UMR SEBELUM LULUS';
    
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
  }

  public function data_lulusan_lanjut_pendidikan()
  {
    $headerStyle = [
      'font' => [
          'bold' => true,
          'size' => 14
      ],
      'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
      ]
    ];

    $borderHeaderStyle = [
      'font' => [
          'bold' => true,
          'size' => 11
      ],
      'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
          'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ],
      'fill' => array(
          'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
          'startColor' => array('argb' => 'fcba03')
      )
    ];

    $borderHeaderStyle2 = [
      'font' => [
          'bold' => true,
          'size' => 11
      ],
      'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
          'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ],
      'fill' => array(
          'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
          'startColor' => array('argb' => '148fb5')
      )
    ];

    $borderBodyStyle = [
      'font' => [
          'size' => 11
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ]
    ];

    $borderBodyCenterStyle = [
      'font' => [
          'size' => 11
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ],
      'alignment' => [
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
      ],
    ];

    $borderBodyRightStyle = [
      'font' => [
          'size' => 11
      ],
      'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
      ],
      'alignment' => [
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
      ],
    ];

    $textTopStyle = [
      'font' => [
          'size' => 11
      ],
      'alignment' => [
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP,
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ]
    ];

    $textTopCenterStyle = [
      'font' => [
          'size' => 11
      ],
      'alignment' => [
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP,
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ]
    ];

    $spreadsheet = new Spreadsheet();
    
    $sheet = $spreadsheet->getActiveSheet();

    if ($this->input->post('jenis_print') == '1') {
      $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5);
      $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(30);
      $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(15);
      $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(13);
      $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(13);
      $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(15);
      $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(13);
      $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(30);
      $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(13);
      $sheet->setCellValue('A1', 'DATA LULUSAN YANG MELANJUTKAN PENDIDIKAN KE JENJANG YANG LEBIH TINGGI');
      $sheet->setCellValue('A2', 'FAKULTAS EKONOMI DAN BISNIS UNIVERSITAS TADULAKO');
      $sheet->setCellValue('A4', 'No');
      $sheet->setCellValue('B4', 'Nama');
      $sheet->setCellValue('C4', 'Jenjang Studi');
      $sheet->setCellValue('D4', 'Prodi');
      $sheet->setCellValue('E4', 'Tahun Lulus');
      $sheet->setCellValue('F4', 'Perguruan Tinggi Tujuan');
      $sheet->setCellValue('G4', 'Jenjang Studi Tujuan');
      $sheet->setCellValue('H4', 'Program Studi Tujuan');
      $sheet->setCellValue('I4', 'Tahun Lanjut Studi');

      $spreadsheet->getActiveSheet()->mergeCells('A1:I1');
      $spreadsheet->getActiveSheet()->getStyle('A1')->applyFromArray($headerStyle);
      $spreadsheet->getActiveSheet()->mergeCells('A2:I2');
      $spreadsheet->getActiveSheet()->getStyle('A2')->applyFromArray($headerStyle);
      $spreadsheet->getActiveSheet()->getStyle('A4:E4')->applyFromArray($borderHeaderStyle);
      $spreadsheet->getActiveSheet()->getStyle('F4:I4')->applyFromArray($borderHeaderStyle2);
      $spreadsheet->getActiveSheet()->getStyle('A4:I4')->getAlignment()->setWrapText(true);

      $list_data = $this->report_model->get_lulusan_pendidikan()->result();
    
      $i = 5;
      $number = 1;
      foreach ($list_data as $row) {
        if($this->report_model->get_lulusan_after($row->jenjang, $row->id_mhsw)->num_rows() > 0) {
          $data_pendidikan_after = $this->report_model->get_lulusan_after($row->jenjang, $row->id_mhsw)->row();
          $sheet->setCellValue('A'.$i, $number);
          $sheet->setCellValue('B'.$i, $row->nama);
          $sheet->setCellValue('C'.$i, $row->jenjang);
          $sheet->setCellValue('D'.$i, $row->nama_prodi);
          $sheet->setCellValue('E'.$i, $row->tahun_lulus);
          $sheet->setCellValue('F'.$i, $data_pendidikan_after->nama_sekolah);
          $sheet->setCellValue('G'.$i, $data_pendidikan_after->jenjang);
          $sheet->setCellValue('H'.$i, $data_pendidikan_after->prodi);
          $sheet->setCellValue('I'.$i, $data_pendidikan_after->tahun_masuk);
          $i++;
          $number++;  
        }
      }
      
      $i--;
      $count = $i--;
      $spreadsheet->getActiveSheet()->getStyle('A5:A'.$count)->applyFromArray($borderBodyCenterStyle);
      $spreadsheet->getActiveSheet()->getStyle('B5:B'.$count)->applyFromArray($borderBodyStyle);
      $spreadsheet->getActiveSheet()->getStyle('C5:C'.$count)->applyFromArray($borderBodyCenterStyle);
      $spreadsheet->getActiveSheet()->getStyle('D5:E'.$count)->applyFromArray($borderBodyCenterStyle);
      $spreadsheet->getActiveSheet()->getStyle('F5:G'.$count)->applyFromArray($borderBodyStyle);
      $spreadsheet->getActiveSheet()->getStyle('H5:I'.$count)->applyFromArray($borderBodyCenterStyle );
    } elseif ($this->input->post('jenis_print') == '2') {
      $prodi = $this->report_model->get_prodi_one($this->input->post('kd_prodi'))->row();
      
      $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5);
      $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(30);
      $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(15);
      $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(13);
      $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(13);
      $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(15);
      $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(13);
      $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(30);
      $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(13);
      $sheet->setCellValue('A1', 'DATA LULUSAN YANG MELANJUTKAN PENDIDIKAN KE JENJANG YANG LEBIH TINGGI');
      $sheet->setCellValue('A2', 'PROGRAM STUDI '.$prodi->nama_prodi);
      $sheet->setCellValue('A3', 'FAKULTAS EKONOMI DAN BISNIS UNIVERSITAS TADULAKO');
      $sheet->setCellValue('A5', 'No');
      $sheet->setCellValue('B5', 'Nama');
      $sheet->setCellValue('C5', 'Jenjang Studi');
      $sheet->setCellValue('D5', 'Prodi');
      $sheet->setCellValue('E5', 'Tahun Lulus');
      $sheet->setCellValue('F5', 'Perguruan Tinggi Tujuan');
      $sheet->setCellValue('G5', 'Jenjang Studi Tujuan');
      $sheet->setCellValue('H5', 'Program Studi Tujuan');
      $sheet->setCellValue('I5', 'Tahun Lanjut Studi');

      $spreadsheet->getActiveSheet()->mergeCells('A1:I1');
      $spreadsheet->getActiveSheet()->getStyle('A1')->applyFromArray($headerStyle);
      $spreadsheet->getActiveSheet()->mergeCells('A2:I2');
      $spreadsheet->getActiveSheet()->getStyle('A2')->applyFromArray($headerStyle);
      $spreadsheet->getActiveSheet()->mergeCells('A3:I3');
      $spreadsheet->getActiveSheet()->getStyle('A3')->applyFromArray($headerStyle);
      $spreadsheet->getActiveSheet()->getStyle('A5:E5')->applyFromArray($borderHeaderStyle);
      $spreadsheet->getActiveSheet()->getStyle('F5:I5')->applyFromArray($borderHeaderStyle2);
      $spreadsheet->getActiveSheet()->getStyle('A5:I5')->getAlignment()->setWrapText(true);

      $list_data = $this->report_model->get_lulusan_pendidikan_prodi($prodi->kd_prodi)->result();
    
      $i = 6;
      $number = 1;
      foreach ($list_data as $row) {
        if($this->report_model->get_lulusan_after($row->jenjang, $row->id_mhsw)->num_rows() > 0) {
          $data_pendidikan_after = $this->report_model->get_lulusan_after($row->jenjang, $row->id_mhsw)->row();
          $sheet->setCellValue('A'.$i, $number);
          $sheet->setCellValue('B'.$i, $row->nama);
          $sheet->setCellValue('C'.$i, $row->jenjang);
          $sheet->setCellValue('D'.$i, $row->nama_prodi);
          $sheet->setCellValue('E'.$i, $row->tahun_lulus);
          $sheet->setCellValue('F'.$i, $data_pendidikan_after->nama_sekolah);
          $sheet->setCellValue('G'.$i, $data_pendidikan_after->jenjang);
          $sheet->setCellValue('H'.$i, $data_pendidikan_after->prodi);
          $sheet->setCellValue('I'.$i, $data_pendidikan_after->tahun_masuk);
          $i++;
          $number++;  
        }
      }
      
      $i--;
      $count = $i--;
      $spreadsheet->getActiveSheet()->getStyle('A6:A'.$count)->applyFromArray($borderBodyCenterStyle);
      $spreadsheet->getActiveSheet()->getStyle('B6:B'.$count)->applyFromArray($borderBodyStyle);
      $spreadsheet->getActiveSheet()->getStyle('C6:C'.$count)->applyFromArray($borderBodyCenterStyle);
      $spreadsheet->getActiveSheet()->getStyle('D6:E'.$count)->applyFromArray($borderBodyCenterStyle);
      $spreadsheet->getActiveSheet()->getStyle('F6:G'.$count)->applyFromArray($borderBodyStyle);
      $spreadsheet->getActiveSheet()->getStyle('H6:I'.$count)->applyFromArray($borderBodyCenterStyle );
    } elseif ($this->input->post('jenis_print') == '3') {
      $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5);
      $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(30);
      $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(15);
      $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(13);
      $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(13);
      $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(15);
      $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(13);
      $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(30);
      $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(13);
      $sheet->setCellValue('A1', 'DATA LULUSAN YANG MELANJUTKAN PENDIDIKAN KE JENJANG YANG LEBIH TINGGI');
      $sheet->setCellValue('A2', 'FAKULTAS EKONOMI DAN BISNIS UNIVERSITAS TADULAKO');
      $sheet->setCellValue('A4', 'No');
      $sheet->setCellValue('B4', 'Nama');
      $sheet->setCellValue('C4', 'Jenjang Studi');
      $sheet->setCellValue('D4', 'Prodi');
      $sheet->setCellValue('E4', 'Tahun Lulus');
      $sheet->setCellValue('F4', 'Perguruan Tinggi Tujuan');
      $sheet->setCellValue('G4', 'Jenjang Studi Tujuan');
      $sheet->setCellValue('H4', 'Program Studi Tujuan');
      $sheet->setCellValue('I4', 'Tahun Lanjut Studi');

      $spreadsheet->getActiveSheet()->mergeCells('A1:I1');
      $spreadsheet->getActiveSheet()->getStyle('A1')->applyFromArray($headerStyle);
      $spreadsheet->getActiveSheet()->mergeCells('A2:I2');
      $spreadsheet->getActiveSheet()->getStyle('A2')->applyFromArray($headerStyle);
      $spreadsheet->getActiveSheet()->getStyle('A4:E4')->applyFromArray($borderHeaderStyle);
      $spreadsheet->getActiveSheet()->getStyle('F4:I4')->applyFromArray($borderHeaderStyle2);
      $spreadsheet->getActiveSheet()->getStyle('A4:I4')->getAlignment()->setWrapText(true);

      $list_data = $this->report_model->get_lulusan_pendidikan_tanggal($this->input->post('date_from'), $this->input->post('date_to'))->result();
    
      $i = 5;
      $number = 1;
      foreach ($list_data as $row) {
        if($this->report_model->get_lulusan_after($row->jenjang, $row->id_mhsw)->num_rows() > 0) {
          $data_pendidikan_after = $this->report_model->get_lulusan_after($row->jenjang, $row->id_mhsw)->row();
          $sheet->setCellValue('A'.$i, $number);
          $sheet->setCellValue('B'.$i, $row->nama);
          $sheet->setCellValue('C'.$i, $row->jenjang);
          $sheet->setCellValue('D'.$i, $row->nama_prodi);
          $sheet->setCellValue('E'.$i, $row->tahun_lulus);
          $sheet->setCellValue('F'.$i, $data_pendidikan_after->nama_sekolah);
          $sheet->setCellValue('G'.$i, $data_pendidikan_after->jenjang);
          $sheet->setCellValue('H'.$i, $data_pendidikan_after->prodi);
          $sheet->setCellValue('I'.$i, $data_pendidikan_after->tahun_masuk);
          $i++;
          $number++;  
        }
      }
      
      $i--;
      $count = $i--;
      $spreadsheet->getActiveSheet()->getStyle('A5:A'.$count)->applyFromArray($borderBodyCenterStyle);
      $spreadsheet->getActiveSheet()->getStyle('B5:B'.$count)->applyFromArray($borderBodyStyle);
      $spreadsheet->getActiveSheet()->getStyle('C5:C'.$count)->applyFromArray($borderBodyCenterStyle);
      $spreadsheet->getActiveSheet()->getStyle('D5:E'.$count)->applyFromArray($borderBodyCenterStyle);
      $spreadsheet->getActiveSheet()->getStyle('F5:G'.$count)->applyFromArray($borderBodyStyle);
      $spreadsheet->getActiveSheet()->getStyle('H5:I'.$count)->applyFromArray($borderBodyCenterStyle );
    } elseif ($this->input->post('jenis_print') == '4') {
      $prodi = $this->report_model->get_prodi_one($this->input->post('kd_prodi'))->row();

      $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5);
      $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(30);
      $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(15);
      $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(13);
      $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(13);
      $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(15);
      $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(13);
      $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(30);
      $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(13);
      $sheet->setCellValue('A1', 'DATA LULUSAN YANG MELANJUTKAN PENDIDIKAN KE JENJANG YANG LEBIH TINGGI');
      $sheet->setCellValue('A2', 'PROGRAM STUDI '.$prodi->nama_prodi);
      $sheet->setCellValue('A3', 'FAKULTAS EKONOMI DAN BISNIS UNIVERSITAS TADULAKO');
      $sheet->setCellValue('A5', 'No');
      $sheet->setCellValue('B5', 'Nama');
      $sheet->setCellValue('C5', 'Jenjang Studi');
      $sheet->setCellValue('D5', 'Prodi');
      $sheet->setCellValue('E5', 'Tahun Lulus');
      $sheet->setCellValue('F5', 'Perguruan Tinggi Tujuan');
      $sheet->setCellValue('G5', 'Jenjang Studi Tujuan');
      $sheet->setCellValue('H5', 'Program Studi Tujuan');
      $sheet->setCellValue('I5', 'Tahun Lanjut Studi');

      $spreadsheet->getActiveSheet()->mergeCells('A1:I1');
      $spreadsheet->getActiveSheet()->getStyle('A1')->applyFromArray($headerStyle);
      $spreadsheet->getActiveSheet()->mergeCells('A2:I2');
      $spreadsheet->getActiveSheet()->getStyle('A2')->applyFromArray($headerStyle);
      $spreadsheet->getActiveSheet()->mergeCells('A3:I3');
      $spreadsheet->getActiveSheet()->getStyle('A3')->applyFromArray($headerStyle);
      $spreadsheet->getActiveSheet()->getStyle('A5:E5')->applyFromArray($borderHeaderStyle);
      $spreadsheet->getActiveSheet()->getStyle('F5:I5')->applyFromArray($borderHeaderStyle2);
      $spreadsheet->getActiveSheet()->getStyle('A5:I5')->getAlignment()->setWrapText(true);

      $list_data = $this->report_model->get_lulusan_pendidikan_prodi_tanggal($this->input->post('kd_prodi'), $this->input->post('date_from'), $this->input->post('date_to'))->result();
    
      $i = 6;
      $number = 1;
      foreach ($list_data as $row) {
        if($this->report_model->get_lulusan_after($row->jenjang, $row->id_mhsw)->num_rows() > 0) {
          $data_pendidikan_after = $this->report_model->get_lulusan_after($row->jenjang, $row->id_mhsw)->row();
          $sheet->setCellValue('A'.$i, $number);
          $sheet->setCellValue('B'.$i, $row->nama);
          $sheet->setCellValue('C'.$i, $row->jenjang);
          $sheet->setCellValue('D'.$i, $row->nama_prodi);
          $sheet->setCellValue('E'.$i, $row->tahun_lulus);
          $sheet->setCellValue('F'.$i, $data_pendidikan_after->nama_sekolah);
          $sheet->setCellValue('G'.$i, $data_pendidikan_after->jenjang);
          $sheet->setCellValue('H'.$i, $data_pendidikan_after->prodi);
          $sheet->setCellValue('I'.$i, $data_pendidikan_after->tahun_masuk);
          $i++;
          $number++;  
        }
      }
      
      $i--;
      $count = $i--;
      $spreadsheet->getActiveSheet()->getStyle('A6:A'.$count)->applyFromArray($borderBodyCenterStyle);
      $spreadsheet->getActiveSheet()->getStyle('B6:B'.$count)->applyFromArray($borderBodyStyle);
      $spreadsheet->getActiveSheet()->getStyle('C6:C'.$count)->applyFromArray($borderBodyCenterStyle);
      $spreadsheet->getActiveSheet()->getStyle('D6:E'.$count)->applyFromArray($borderBodyCenterStyle);
      $spreadsheet->getActiveSheet()->getStyle('F6:G'.$count)->applyFromArray($borderBodyStyle);
      $spreadsheet->getActiveSheet()->getStyle('H6:I'.$count)->applyFromArray($borderBodyCenterStyle );
    }


    
    $writer = new Xlsx($spreadsheet);
    $filename = 'REPORT DATA LULUSAN YANG MELANJUTKAN PENDIDIKAN KE JENJANG YANG LEBIH TINGGI';
    
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
  }

  public function data_lulusan_wirausaha_6_bulan()
  {
    $headerStyle = [
      'font' => [
          'bold' => true,
          'size' => 14
      ],
      'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
      ]
    ];

    $borderHeaderStyle = [
      'font' => [
          'bold' => true,
          'size' => 11
      ],
      'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
          'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ],
      'fill' => array(
          'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
          'startColor' => array('argb' => 'fcba03')
      )
    ];

    $borderBodyStyle = [
      'font' => [
          'size' => 11
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ]
    ];

    $borderBodyCenterStyle = [
      'font' => [
          'size' => 11
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ],
      'alignment' => [
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
      ],
    ];

    $borderBodyRightStyle = [
      'font' => [
          'size' => 11
      ],
      'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
      ],
      'alignment' => [
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
      ],
    ];

    $textTopStyle = [
      'font' => [
          'size' => 11
      ],
      'alignment' => [
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP,
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ]
    ];

    $textTopCenterStyle = [
      'font' => [
          'size' => 11
      ],
      'alignment' => [
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP,
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ]
    ];

    $spreadsheet = new Spreadsheet();
    
    $sheet = $spreadsheet->getActiveSheet();

    if ($this->input->post('jenis_print') == '1') {
      $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5);
      $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(30);
      $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(15);
      $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(15);
      $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(13);
      $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(12);
      $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(12);
      $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(12);
      $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(12);
      $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(12);
      $sheet->setCellValue('A1', 'DATA LULUSAN YANG BERWIRAUSAHA DALAM KURUN WAKTU < 6 BULAN SETELAH LULUS & BERPENGHASILAN 1,2 X UMR');
      $sheet->setCellValue('A2', 'FAKULTAS EKONOMI DAN BISNIS UNIVERSITAS TADULAKO');
      $sheet->setCellValue('A4', 'No');
      $sheet->setCellValue('B4', 'Nama');
      $sheet->setCellValue('C4', 'Program Studi');
      $sheet->setCellValue('D4', 'Jenjang Studi');
      $sheet->setCellValue('E4', 'Tahun Lulus');
      $sheet->setCellValue('F4', 'Kurun Waktu Memulai Usaha Setalah Lulus (Bulan)');
      $sheet->setCellValue('G4', 'Nama Usaha');
      $sheet->setCellValue('H4', 'Bidang Usaha');
      $sheet->setCellValue('I4', 'Alamat/ Tempat Usaha');
      $sheet->setCellValue('J4', 'Penghasilan (Rp)');

      $spreadsheet->getActiveSheet()->mergeCells('A1:J1');
      $spreadsheet->getActiveSheet()->getStyle('A1')->applyFromArray($headerStyle);
      $spreadsheet->getActiveSheet()->mergeCells('A2:J2');
      $spreadsheet->getActiveSheet()->getStyle('A2')->applyFromArray($headerStyle);
      $spreadsheet->getActiveSheet()->getStyle('A4:J4')->applyFromArray($borderHeaderStyle);
      $spreadsheet->getActiveSheet()->getStyle('A4:J4')->getAlignment()->setWrapText(true);

      $list_data = $this->report_model->get_pendidikan_yudisium()->result();
  
      $umr = 2303711;
      $gaji_1_2_kali = $umr * 1.2; //2,764,453.2
  
      $i = 5;
      $number = 1;
      foreach ($list_data as $row) {
        $list_lulusan = $this->report_model->get_lulusan_wirausaha($row->id_mhsw, $row->tanggal_yudisium, $gaji_1_2_kali)->result();
        foreach ($list_lulusan as $row_1) {
          $sheet->setCellValue('A'.$i, $number);
          $sheet->setCellValue('B'.$i, $row_1->nama);
          $sheet->setCellValue('C'.$i, $row->nama_prodi);
          $sheet->setCellValue('D'.$i, $row->jenjang);
          $sheet->setCellValue('E'.$i, $row->tahun_lulus);
          $sheet->setCellValue('F'.$i, $row_1->masa_tunggu);
          $sheet->setCellValue('G'.$i, $row_1->nama_usaha);
          $sheet->setCellValue('H'.$i, $row_1->jenis_usaha);
          $sheet->setCellValue('I'.$i, $row_1->alamat_usaha);
          $sheet->setCellValue('J'.$i, "Rp " . number_format($row_1->rata_rata_omset,0,',-','.'));
          $i++;
          $number++;
        }
      }
      
      $i--;
      $count = $i--;
      $spreadsheet->getActiveSheet()->getStyle('A5:A'.$count)->applyFromArray($borderBodyCenterStyle);
      $spreadsheet->getActiveSheet()->getStyle('B5:C'.$count)->applyFromArray($borderBodyStyle);
      $spreadsheet->getActiveSheet()->getStyle('D5:F'.$count)->applyFromArray($borderBodyCenterStyle);
      $spreadsheet->getActiveSheet()->getStyle('G5:I'.$count)->applyFromArray($borderBodyStyle);
      $spreadsheet->getActiveSheet()->getStyle('J5:J'.$count)->applyFromArray($borderBodyRightStyle);
    } elseif ($this->input->post('jenis_print') == '2') {
      $prodi = $this->report_model->get_prodi_one($this->input->post('kd_prodi'))->row();
      
      $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5);
      $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(30);
      $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(15);
      $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(15);
      $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(13);
      $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(12);
      $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(12);
      $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(12);
      $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(12);
      $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(12);
      $sheet->setCellValue('A1', 'DATA LULUSAN YANG BERWIRAUSAHA DALAM KURUN WAKTU < 6 BULAN SETELAH LULUS & BERPENGHASILAN 1,2 X UMR');
      $sheet->setCellValue('A2', 'PROGRAM STUDI '.$prodi->nama_prodi);
      $sheet->setCellValue('A3', 'FAKULTAS EKONOMI DAN BISNIS UNIVERSITAS TADULAKO');
      $sheet->setCellValue('A5', 'No');
      $sheet->setCellValue('B5', 'Nama');
      $sheet->setCellValue('C5', 'Program Studi');
      $sheet->setCellValue('D5', 'Jenjang Studi');
      $sheet->setCellValue('E5', 'Tahun Lulus');
      $sheet->setCellValue('F5', 'Kurun Waktu Memulai Usaha Setalah Lulus (Bulan)');
      $sheet->setCellValue('G5', 'Nama Usaha');
      $sheet->setCellValue('H5', 'Bidang Usaha');
      $sheet->setCellValue('I5', 'Alamat/ Tempat Usaha');
      $sheet->setCellValue('J5', 'Penghasilan (Rp)');

      $spreadsheet->getActiveSheet()->mergeCells('A1:J1');
      $spreadsheet->getActiveSheet()->getStyle('A1')->applyFromArray($headerStyle);
      $spreadsheet->getActiveSheet()->mergeCells('A2:J2');
      $spreadsheet->getActiveSheet()->getStyle('A2')->applyFromArray($headerStyle);
      $spreadsheet->getActiveSheet()->mergeCells('A3:J3');
      $spreadsheet->getActiveSheet()->getStyle('A3')->applyFromArray($headerStyle);
      $spreadsheet->getActiveSheet()->getStyle('A5:J5')->applyFromArray($borderHeaderStyle);
      $spreadsheet->getActiveSheet()->getStyle('A5:J5')->getAlignment()->setWrapText(true);

      $list_data = $this->report_model->get_pendidikan_yudisium_prodi($this->input->post('kd_prodi'))->result();
  
      $umr = 2303711;
      $gaji_1_2_kali = $umr * 1.2; //2,764,453.2
  
      $i = 6;
      $number = 1;
      foreach ($list_data as $row) {
        $list_lulusan = $this->report_model->get_lulusan_wirausaha($row->id_mhsw, $row->tanggal_yudisium, $gaji_1_2_kali)->result();
        foreach ($list_lulusan as $row_1) {
          $sheet->setCellValue('A'.$i, $number);
          $sheet->setCellValue('B'.$i, $row_1->nama);
          $sheet->setCellValue('C'.$i, $row->nama_prodi);
          $sheet->setCellValue('D'.$i, $row->jenjang);
          $sheet->setCellValue('E'.$i, $row->tahun_lulus);
          $sheet->setCellValue('F'.$i, $row_1->masa_tunggu);
          $sheet->setCellValue('G'.$i, $row_1->nama_usaha);
          $sheet->setCellValue('H'.$i, $row_1->jenis_usaha);
          $sheet->setCellValue('I'.$i, $row_1->alamat_usaha);
          $sheet->setCellValue('J'.$i, "Rp " . number_format($row_1->rata_rata_omset,0,',-','.'));
          $i++;
          $number++;
        }
      }
      
      $i--;
      $count = $i--;
      $spreadsheet->getActiveSheet()->getStyle('A6:A'.$count)->applyFromArray($borderBodyCenterStyle);
      $spreadsheet->getActiveSheet()->getStyle('B6:C'.$count)->applyFromArray($borderBodyStyle);
      $spreadsheet->getActiveSheet()->getStyle('D6:F'.$count)->applyFromArray($borderBodyCenterStyle);
      $spreadsheet->getActiveSheet()->getStyle('G6:I'.$count)->applyFromArray($borderBodyStyle);
      $spreadsheet->getActiveSheet()->getStyle('J6:J'.$count)->applyFromArray($borderBodyRightStyle);
    } elseif ($this->input->post('jenis_print') == '3') {
      $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5);
      $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(30);
      $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(15);
      $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(15);
      $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(13);
      $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(12);
      $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(12);
      $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(12);
      $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(12);
      $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(12);
      $sheet->setCellValue('A1', 'DATA LULUSAN YANG BERWIRAUSAHA DALAM KURUN WAKTU < 6 BULAN SETELAH LULUS & BERPENGHASILAN 1,2 X UMR');
      $sheet->setCellValue('A2', 'FAKULTAS EKONOMI DAN BISNIS UNIVERSITAS TADULAKO');
      $sheet->setCellValue('A4', 'No');
      $sheet->setCellValue('B4', 'Nama');
      $sheet->setCellValue('C4', 'Program Studi');
      $sheet->setCellValue('D4', 'Jenjang Studi');
      $sheet->setCellValue('E4', 'Tahun Lulus');
      $sheet->setCellValue('F4', 'Kurun Waktu Memulai Usaha Setalah Lulus (Bulan)');
      $sheet->setCellValue('G4', 'Nama Usaha');
      $sheet->setCellValue('H4', 'Bidang Usaha');
      $sheet->setCellValue('I4', 'Alamat/ Tempat Usaha');
      $sheet->setCellValue('J4', 'Penghasilan (Rp)');

      $spreadsheet->getActiveSheet()->mergeCells('A1:J1');
      $spreadsheet->getActiveSheet()->getStyle('A1')->applyFromArray($headerStyle);
      $spreadsheet->getActiveSheet()->mergeCells('A2:J2');
      $spreadsheet->getActiveSheet()->getStyle('A2')->applyFromArray($headerStyle);
      $spreadsheet->getActiveSheet()->getStyle('A4:J4')->applyFromArray($borderHeaderStyle);
      $spreadsheet->getActiveSheet()->getStyle('A4:J4')->getAlignment()->setWrapText(true);

      $list_data = $this->report_model->get_pendidikan_yudisium_tanggal($this->input->post('date_from'), $this->input->post('date_to'))->result();
  
      $umr = 2303711;
      $gaji_1_2_kali = $umr * 1.2; //2,764,453.2
  
      $i = 5;
      $number = 1;
      foreach ($list_data as $row) {
        $list_lulusan = $this->report_model->get_lulusan_wirausaha($row->id_mhsw, $row->tanggal_yudisium, $gaji_1_2_kali)->result();
        foreach ($list_lulusan as $row_1) {
          $sheet->setCellValue('A'.$i, $number);
          $sheet->setCellValue('B'.$i, $row_1->nama);
          $sheet->setCellValue('C'.$i, $row->nama_prodi);
          $sheet->setCellValue('D'.$i, $row->jenjang);
          $sheet->setCellValue('E'.$i, $row->tahun_lulus);
          $sheet->setCellValue('F'.$i, $row_1->masa_tunggu);
          $sheet->setCellValue('G'.$i, $row_1->nama_usaha);
          $sheet->setCellValue('H'.$i, $row_1->jenis_usaha);
          $sheet->setCellValue('I'.$i, $row_1->alamat_usaha);
          $sheet->setCellValue('J'.$i, "Rp " . number_format($row_1->rata_rata_omset,0,',-','.'));
          $i++;
          $number++;
        }
      }
      
      $i--;
      $count = $i--;
      $spreadsheet->getActiveSheet()->getStyle('A5:A'.$count)->applyFromArray($borderBodyCenterStyle);
      $spreadsheet->getActiveSheet()->getStyle('B5:C'.$count)->applyFromArray($borderBodyStyle);
      $spreadsheet->getActiveSheet()->getStyle('D5:F'.$count)->applyFromArray($borderBodyCenterStyle);
      $spreadsheet->getActiveSheet()->getStyle('G5:I'.$count)->applyFromArray($borderBodyStyle);
      $spreadsheet->getActiveSheet()->getStyle('J5:J'.$count)->applyFromArray($borderBodyRightStyle);
    } elseif ($this->input->post('jenis_print') == '4') {
      $prodi = $this->report_model->get_prodi_one($this->input->post('kd_prodi'))->row();
      
      $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5);
      $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(30);
      $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(15);
      $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(15);
      $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(13);
      $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(12);
      $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(12);
      $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(12);
      $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(12);
      $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(12);
      $sheet->setCellValue('A1', 'DATA LULUSAN YANG BERWIRAUSAHA DALAM KURUN WAKTU < 6 BULAN SETELAH LULUS & BERPENGHASILAN 1,2 X UMR');
      $sheet->setCellValue('A2', 'PROGRAM STUDI '.$prodi->nama_prodi);
      $sheet->setCellValue('A3', 'FAKULTAS EKONOMI DAN BISNIS UNIVERSITAS TADULAKO');
      $sheet->setCellValue('A5', 'No');
      $sheet->setCellValue('B5', 'Nama');
      $sheet->setCellValue('C5', 'Program Studi');
      $sheet->setCellValue('D5', 'Jenjang Studi');
      $sheet->setCellValue('E5', 'Tahun Lulus');
      $sheet->setCellValue('F5', 'Kurun Waktu Memulai Usaha Setalah Lulus (Bulan)');
      $sheet->setCellValue('G5', 'Nama Usaha');
      $sheet->setCellValue('H5', 'Bidang Usaha');
      $sheet->setCellValue('I5', 'Alamat/ Tempat Usaha');
      $sheet->setCellValue('J5', 'Penghasilan (Rp)');

      $spreadsheet->getActiveSheet()->mergeCells('A1:J1');
      $spreadsheet->getActiveSheet()->getStyle('A1')->applyFromArray($headerStyle);
      $spreadsheet->getActiveSheet()->mergeCells('A2:J2');
      $spreadsheet->getActiveSheet()->getStyle('A2')->applyFromArray($headerStyle);
      $spreadsheet->getActiveSheet()->mergeCells('A3:J3');
      $spreadsheet->getActiveSheet()->getStyle('A3')->applyFromArray($headerStyle);
      $spreadsheet->getActiveSheet()->getStyle('A5:J5')->applyFromArray($borderHeaderStyle);
      $spreadsheet->getActiveSheet()->getStyle('A5:J5')->getAlignment()->setWrapText(true);

      $list_data = $this->report_model->get_pendidikan_yudisium_prodi_tanggal($this->input->post('kd_prodi'),$this->input->post('date_from'), $this->input->post('date_to'))->result();
  
      $umr = 2303711;
      $gaji_1_2_kali = $umr * 1.2; //2,764,453.2
  
      $i = 6;
      $number = 1;
      foreach ($list_data as $row) {
        $list_lulusan = $this->report_model->get_lulusan_wirausaha($row->id_mhsw, $row->tanggal_yudisium, $gaji_1_2_kali)->result();
        foreach ($list_lulusan as $row_1) {
          $sheet->setCellValue('A'.$i, $number);
          $sheet->setCellValue('B'.$i, $row_1->nama);
          $sheet->setCellValue('C'.$i, $row->nama_prodi);
          $sheet->setCellValue('D'.$i, $row->jenjang);
          $sheet->setCellValue('E'.$i, $row->tahun_lulus);
          $sheet->setCellValue('F'.$i, $row_1->masa_tunggu);
          $sheet->setCellValue('G'.$i, $row_1->nama_usaha);
          $sheet->setCellValue('H'.$i, $row_1->jenis_usaha);
          $sheet->setCellValue('I'.$i, $row_1->alamat_usaha);
          $sheet->setCellValue('J'.$i, "Rp " . number_format($row_1->rata_rata_omset,0,',-','.'));
          $i++;
          $number++;
        }
      }
      
      $i--;
      $count = $i--;
      $spreadsheet->getActiveSheet()->getStyle('A6:A'.$count)->applyFromArray($borderBodyCenterStyle);
      $spreadsheet->getActiveSheet()->getStyle('B6:C'.$count)->applyFromArray($borderBodyStyle);
      $spreadsheet->getActiveSheet()->getStyle('D6:F'.$count)->applyFromArray($borderBodyCenterStyle);
      $spreadsheet->getActiveSheet()->getStyle('G6:I'.$count)->applyFromArray($borderBodyStyle);
      $spreadsheet->getActiveSheet()->getStyle('J6:J'.$count)->applyFromArray($borderBodyRightStyle);
    }


    
    $writer = new Xlsx($spreadsheet);
    $filename = 'DATA LULUSAN YANG BERWIRAUSAHA DALAM KURUN WAKTU KD 6 BULAN SETELAH LULUS & BERPENGHASILAN 1,2 X UMR';
    
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
  }

  public function data_lulusan_wirausaha_1_2_kali()
  {
    $headerStyle = [
      'font' => [
          'bold' => true,
          'size' => 14
      ],
      'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
      ]
    ];

    $borderHeaderStyle = [
      'font' => [
          'bold' => true,
          'size' => 11
      ],
      'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
          'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ],
      'fill' => array(
          'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
          'startColor' => array('argb' => 'fcba03')
      )
    ];

    $borderBodyStyle = [
      'font' => [
          'size' => 11
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ]
    ];

    $borderBodyCenterStyle = [
      'font' => [
          'size' => 11
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ],
      'alignment' => [
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
      ],
    ];

    $borderBodyRightStyle = [
      'font' => [
          'size' => 11
      ],
      'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
      ],
      'alignment' => [
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
      ],
    ];

    $textTopStyle = [
      'font' => [
          'size' => 11
      ],
      'alignment' => [
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP,
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ]
    ];

    $textTopCenterStyle = [
      'font' => [
          'size' => 11
      ],
      'alignment' => [
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP,
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ]
    ];

    $spreadsheet = new Spreadsheet();
    
    $sheet = $spreadsheet->getActiveSheet();

    if ($this->input->post('jenis_print') == '1') {
      $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5);
      $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(30);
      $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(15);
      $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(15);
      $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(13);
      $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(12);
      $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(12);
      $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(12);
      $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(12);
      $sheet->setCellValue('A1', 'DATA LULUSAN YANG BERWIRAUSAHA SEBELUM LULUS & BERPENGHASILAN > 1,2 X UMR');
      $sheet->setCellValue('A2', 'FAKULTAS EKONOMI DAN BISNIS UNIVERSITAS TADULAKO');
      $sheet->setCellValue('A4', 'No');
      $sheet->setCellValue('B4', 'Nama');
      $sheet->setCellValue('C4', 'Program Studi');
      $sheet->setCellValue('D4', 'Jenjang Studi');
      $sheet->setCellValue('E4', 'Tahun Lulus');
      $sheet->setCellValue('F4', 'Nama Usaha');
      $sheet->setCellValue('G4', 'Bidang Usaha');
      $sheet->setCellValue('H4', 'Alamat/ Tempat Usaha');
      $sheet->setCellValue('I4', 'Penghasilan (Rp)');

      $spreadsheet->getActiveSheet()->mergeCells('A1:I1');
      $spreadsheet->getActiveSheet()->getStyle('A1')->applyFromArray($headerStyle);
      $spreadsheet->getActiveSheet()->mergeCells('A2:I2');
      $spreadsheet->getActiveSheet()->getStyle('A2')->applyFromArray($headerStyle);
      $spreadsheet->getActiveSheet()->getStyle('A4:I4')->applyFromArray($borderHeaderStyle);
      $spreadsheet->getActiveSheet()->getStyle('A4:I4')->getAlignment()->setWrapText(true);

      $list_data = $this->report_model->get_pendidikan_yudisium()->result();
  
      $umr = 2303711;
      $gaji_1_2_kali = $umr * 1.2; //2,764,453.2
  
      $i = 5;
      $number = 1;
      foreach ($list_data as $row) {
        $list_lulusan = $this->report_model->get_lulusan_sebelum_wirausaha($row->id_mhsw, $row->tanggal_yudisium, $gaji_1_2_kali)->result();
        foreach ($list_lulusan as $row_1) {
          $sheet->setCellValue('A'.$i, $number);
          $sheet->setCellValue('B'.$i, $row_1->nama);
          $sheet->setCellValue('C'.$i, $row->nama_prodi);
          $sheet->setCellValue('D'.$i, $row->jenjang);
          $sheet->setCellValue('E'.$i, $row->tahun_lulus);
          $sheet->setCellValue('F'.$i, $row_1->nama_usaha);
          $sheet->setCellValue('G'.$i, $row_1->jenis_usaha);
          $sheet->setCellValue('H'.$i, $row_1->alamat_usaha);
          $sheet->setCellValue('I'.$i, "Rp " . number_format($row_1->rata_rata_omset,0,',-','.'));
          $i++;
          $number++;
        }
      }
      
      $i--;
      $count = $i--;
      $spreadsheet->getActiveSheet()->getStyle('A5:A'.$count)->applyFromArray($borderBodyCenterStyle);
      $spreadsheet->getActiveSheet()->getStyle('B5:C'.$count)->applyFromArray($borderBodyStyle);
      $spreadsheet->getActiveSheet()->getStyle('D5:E'.$count)->applyFromArray($borderBodyCenterStyle);
      $spreadsheet->getActiveSheet()->getStyle('F5:H'.$count)->applyFromArray($borderBodyStyle);
      $spreadsheet->getActiveSheet()->getStyle('I5:I'.$count)->applyFromArray($borderBodyRightStyle);
    } elseif ($this->input->post('jenis_print') == '2') {
      $prodi = $this->report_model->get_prodi_one($this->input->post('kd_prodi'))->row();
      
      $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5);
      $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(30);
      $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(15);
      $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(15);
      $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(13);
      $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(12);
      $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(12);
      $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(12);
      $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(12);
      $sheet->setCellValue('A1', 'DATA LULUSAN YANG BERWIRAUSAHA SEBELUM LULUS & BERPENGHASILAN > 1,2 X UMR');
      $sheet->setCellValue('A2', 'PROGRAM STUDI '.$prodi->nama_prodi);
      $sheet->setCellValue('A3', 'FAKULTAS EKONOMI DAN BISNIS UNIVERSITAS TADULAKO');
      $sheet->setCellValue('A5', 'No');
      $sheet->setCellValue('B5', 'Nama');
      $sheet->setCellValue('C5', 'Program Studi');
      $sheet->setCellValue('D5', 'Jenjang Studi');
      $sheet->setCellValue('E5', 'Tahun Lulus');
      $sheet->setCellValue('F5', 'Nama Usaha');
      $sheet->setCellValue('G5', 'Bidang Usaha');
      $sheet->setCellValue('H5', 'Alamat/ Tempat Usaha');
      $sheet->setCellValue('I5', 'Penghasilan (Rp)');

      $spreadsheet->getActiveSheet()->mergeCells('A1:I1');
      $spreadsheet->getActiveSheet()->getStyle('A1')->applyFromArray($headerStyle);
      $spreadsheet->getActiveSheet()->mergeCells('A2:I2');
      $spreadsheet->getActiveSheet()->getStyle('A2')->applyFromArray($headerStyle);
      $spreadsheet->getActiveSheet()->mergeCells('A3:I3');
      $spreadsheet->getActiveSheet()->getStyle('A3')->applyFromArray($headerStyle);
      $spreadsheet->getActiveSheet()->getStyle('A5:I5')->applyFromArray($borderHeaderStyle);
      $spreadsheet->getActiveSheet()->getStyle('A5:I5')->getAlignment()->setWrapText(true);

      $list_data = $this->report_model->get_pendidikan_yudisium_prodi($this->input->post('kd_prodi'))->result();
  
      $umr = 2303711;
      $gaji_1_2_kali = $umr * 1.2; //2,764,453.2
  
      $i = 6;
      $number = 1;
      foreach ($list_data as $row) {
        $list_lulusan = $this->report_model->get_lulusan_sebelum_wirausaha($row->id_mhsw, $row->tanggal_yudisium, $gaji_1_2_kali)->result();
        foreach ($list_lulusan as $row_1) {
          $sheet->setCellValue('A'.$i, $number);
          $sheet->setCellValue('B'.$i, $row_1->nama);
          $sheet->setCellValue('C'.$i, $row->nama_prodi);
          $sheet->setCellValue('D'.$i, $row->jenjang);
          $sheet->setCellValue('E'.$i, $row->tahun_lulus);
          $sheet->setCellValue('F'.$i, $row_1->nama_usaha);
          $sheet->setCellValue('G'.$i, $row_1->jenis_usaha);
          $sheet->setCellValue('H'.$i, $row_1->alamat_usaha);
          $sheet->setCellValue('I'.$i, "Rp " . number_format($row_1->rata_rata_omset,0,',-','.'));
          $i++;
          $number++;
        }
      }
      
      $i--;
      $count = $i--;
      $spreadsheet->getActiveSheet()->getStyle('A6:A'.$count)->applyFromArray($borderBodyCenterStyle);
      $spreadsheet->getActiveSheet()->getStyle('B6:C'.$count)->applyFromArray($borderBodyStyle);
      $spreadsheet->getActiveSheet()->getStyle('D6:E'.$count)->applyFromArray($borderBodyCenterStyle);
      $spreadsheet->getActiveSheet()->getStyle('F6:H'.$count)->applyFromArray($borderBodyStyle);
      $spreadsheet->getActiveSheet()->getStyle('I6:I'.$count)->applyFromArray($borderBodyRightStyle);
    } elseif ($this->input->post('jenis_print') == '3') {
      $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5);
      $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(30);
      $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(15);
      $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(15);
      $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(13);
      $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(12);
      $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(12);
      $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(12);
      $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(12);
      $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(12);
      $sheet->setCellValue('A1', 'DATA LULUSAN YANG BERWIRAUSAHA SEBELUM LULUS & BERPENGHASILAN > 1,2 X UMR');
      $sheet->setCellValue('A2', 'FAKULTAS EKONOMI DAN BISNIS UNIVERSITAS TADULAKO');
      $sheet->setCellValue('A4', 'No');
      $sheet->setCellValue('B4', 'Nama');
      $sheet->setCellValue('C4', 'Program Studi');
      $sheet->setCellValue('D4', 'Jenjang Studi');
      $sheet->setCellValue('E4', 'Tahun Lulus');
      $sheet->setCellValue('F4', 'Nama Usaha');
      $sheet->setCellValue('G4', 'Bidang Usaha');
      $sheet->setCellValue('H4', 'Alamat/ Tempat Usaha');
      $sheet->setCellValue('I4', 'Penghasilan (Rp)');

      $spreadsheet->getActiveSheet()->mergeCells('A1:I1');
      $spreadsheet->getActiveSheet()->getStyle('A1')->applyFromArray($headerStyle);
      $spreadsheet->getActiveSheet()->mergeCells('A2:I2');
      $spreadsheet->getActiveSheet()->getStyle('A2')->applyFromArray($headerStyle);
      $spreadsheet->getActiveSheet()->getStyle('A4:I4')->applyFromArray($borderHeaderStyle);
      $spreadsheet->getActiveSheet()->getStyle('A4:I4')->getAlignment()->setWrapText(true);

      $list_data = $this->report_model->get_pendidikan_yudisium_tanggal($this->input->post('date_from'), $this->input->post('date_to'))->result();
  
      $umr = 2303711;
      $gaji_1_2_kali = $umr * 1.2; //2,764,453.2
  
      $i = 5;
      $number = 1;
      foreach ($list_data as $row) {
        $list_lulusan = $this->report_model->get_lulusan_sebelum_wirausaha($row->id_mhsw, $row->tanggal_yudisium, $gaji_1_2_kali)->result();
        foreach ($list_lulusan as $row_1) {
          $sheet->setCellValue('A'.$i, $number);
          $sheet->setCellValue('B'.$i, $row_1->nama);
          $sheet->setCellValue('C'.$i, $row->nama_prodi);
          $sheet->setCellValue('D'.$i, $row->jenjang);
          $sheet->setCellValue('E'.$i, $row->tahun_lulus);
          $sheet->setCellValue('F'.$i, $row_1->nama_usaha);
          $sheet->setCellValue('G'.$i, $row_1->jenis_usaha);
          $sheet->setCellValue('H'.$i, $row_1->alamat_usaha);
          $sheet->setCellValue('I'.$i, "Rp " . number_format($row_1->rata_rata_omset,0,',-','.'));
          $i++;
          $number++;
        }
      }
      
      $i--;
      $count = $i--;
      $spreadsheet->getActiveSheet()->getStyle('A5:A'.$count)->applyFromArray($borderBodyCenterStyle);
      $spreadsheet->getActiveSheet()->getStyle('B5:C'.$count)->applyFromArray($borderBodyStyle);
      $spreadsheet->getActiveSheet()->getStyle('D5:E'.$count)->applyFromArray($borderBodyCenterStyle);
      $spreadsheet->getActiveSheet()->getStyle('F5:H'.$count)->applyFromArray($borderBodyStyle);
      $spreadsheet->getActiveSheet()->getStyle('I5:I'.$count)->applyFromArray($borderBodyRightStyle);
    } elseif ($this->input->post('jenis_print') == '4') {
      $prodi = $this->report_model->get_prodi_one($this->input->post('kd_prodi'))->row();
      
      $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5);
      $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(30);
      $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(15);
      $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(15);
      $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(13);
      $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(12);
      $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(12);
      $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(12);
      $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(12);
      $sheet->setCellValue('A1', 'DATA LULUSAN YANG BERWIRAUSAHA SEBELUM LULUS & BERPENGHASILAN > 1,2 X UMR');
      $sheet->setCellValue('A2', 'PROGRAM STUDI '.$prodi->nama_prodi);
      $sheet->setCellValue('A3', 'FAKULTAS EKONOMI DAN BISNIS UNIVERSITAS TADULAKO');
      $sheet->setCellValue('A5', 'No');
      $sheet->setCellValue('B5', 'Nama');
      $sheet->setCellValue('C5', 'Program Studi');
      $sheet->setCellValue('D5', 'Jenjang Studi');
      $sheet->setCellValue('E5', 'Tahun Lulus');
      $sheet->setCellValue('F5', 'Nama Usaha');
      $sheet->setCellValue('G5', 'Bidang Usaha');
      $sheet->setCellValue('H5', 'Alamat/ Tempat Usaha');
      $sheet->setCellValue('I5', 'Penghasilan (Rp)');

      $spreadsheet->getActiveSheet()->mergeCells('A1:I1');
      $spreadsheet->getActiveSheet()->getStyle('A1')->applyFromArray($headerStyle);
      $spreadsheet->getActiveSheet()->mergeCells('A2:I2');
      $spreadsheet->getActiveSheet()->getStyle('A2')->applyFromArray($headerStyle);
      $spreadsheet->getActiveSheet()->mergeCells('A3:I3');
      $spreadsheet->getActiveSheet()->getStyle('A3')->applyFromArray($headerStyle);
      $spreadsheet->getActiveSheet()->getStyle('A5:I5')->applyFromArray($borderHeaderStyle);
      $spreadsheet->getActiveSheet()->getStyle('A5:I5')->getAlignment()->setWrapText(true);

      $list_data = $this->report_model->get_pendidikan_yudisium_prodi_tanggal($this->input->post('kd_prodi'),$this->input->post('date_from'), $this->input->post('date_to'))->result();
  
      $umr = 2303711;
      $gaji_1_2_kali = $umr * 1.2; //2,764,453.2
  
      $i = 6;
      $number = 1;
      foreach ($list_data as $row) {
        $list_lulusan = $this->report_model->get_lulusan_sebelum_wirausaha($row->id_mhsw, $row->tanggal_yudisium, $gaji_1_2_kali)->result();
        foreach ($list_lulusan as $row_1) {
          $sheet->setCellValue('A'.$i, $number);
          $sheet->setCellValue('B'.$i, $row_1->nama);
          $sheet->setCellValue('C'.$i, $row->nama_prodi);
          $sheet->setCellValue('D'.$i, $row->jenjang);
          $sheet->setCellValue('E'.$i, $row->tahun_lulus);
          $sheet->setCellValue('F'.$i, $row_1->nama_usaha);
          $sheet->setCellValue('G'.$i, $row_1->jenis_usaha);
          $sheet->setCellValue('H'.$i, $row_1->alamat_usaha);
          $sheet->setCellValue('I'.$i, "Rp " . number_format($row_1->rata_rata_omset,0,',-','.'));
          $i++;
          $number++;
        }
      }
      
      $i--;
      $count = $i--;
      $spreadsheet->getActiveSheet()->getStyle('A6:A'.$count)->applyFromArray($borderBodyCenterStyle);
      $spreadsheet->getActiveSheet()->getStyle('B6:C'.$count)->applyFromArray($borderBodyStyle);
      $spreadsheet->getActiveSheet()->getStyle('D6:E'.$count)->applyFromArray($borderBodyCenterStyle);
      $spreadsheet->getActiveSheet()->getStyle('F6:H'.$count)->applyFromArray($borderBodyStyle);
      $spreadsheet->getActiveSheet()->getStyle('I6:I'.$count)->applyFromArray($borderBodyRightStyle);
    }


    
    $writer = new Xlsx($spreadsheet);
    $filename = 'DATA LULUSAN YANG BERWIRAUSAHA SEBELUM LULUS & BERPENGHASILAN LD 1,2 X UMR';
    
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
  }

  public function iku_2_kegiatan()
  {
    $headerStyle = [
      'font' => [
          'bold' => true,
          'size' => 14
      ],
      'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
      ]
    ];

    $borderHeaderStyle = [
      'font' => [
          'bold' => true,
          'size' => 11
      ],
      'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
          'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ],
      'fill' => array(
          'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
          'startColor' => array('argb' => 'dbdbd9')
      )
    ];

    $borderHeaderStyle1 = [
      'font' => [
          'bold' => true,
          'size' => 11
      ],
      'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
          'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ],
      'fill' => array(
          'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
          'startColor' => array('argb' => '4e96f5')
      )
    ];

    $borderBodyStyle = [
      'font' => [
          'size' => 11
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ]
    ];

    $borderBodyCenterStyle = [
      'font' => [
          'size' => 11
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ],
      'alignment' => [
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
      ],
    ];

    $borderBodyRightStyle = [
      'font' => [
          'size' => 11
      ],
      'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
      ],
      'alignment' => [
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
      ],
    ];

    $textTopStyle = [
      'font' => [
          'size' => 11
      ],
      'alignment' => [
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP,
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ]
    ];

    $textTopCenterStyle = [
      'font' => [
          'size' => 11
      ],
      'alignment' => [
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP,
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
      ],
      'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
      ]
    ];

    $spreadsheet = new Spreadsheet();
    
    $sheet = $spreadsheet->getActiveSheet();
    
    $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5);
    $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(30);
    $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(15);
    $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(15);
    $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(15);
    $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(15);
    $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(15);
    $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(15);
    $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(20);
    $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(45);
    $spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(17);
    $spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(17);
    $spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(22);
    $spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(15);
    $sheet->setCellValue('A1', 'DATA PENGALAMAN MAHASISWA DI LUAR KAMPUS');
    $sheet->setCellValue('A2', 'FAKULTAS EKONOMI DAN BISNIS UNIVERSITAS TADULAKO');
    $sheet->setCellValue('A4', 'No');
    $sheet->setCellValue('B4', 'Nama');
    $sheet->setCellValue('C4', 'NIM');
    $sheet->setCellValue('D4', 'Jenjang Studi');
    $sheet->setCellValue('E4', 'Program Studi');
    $sheet->setCellValue('F4', 'Semester');
    $sheet->setCellValue('G4', 'Angkatan');
    $sheet->setCellValue('H4', 'Jenis MBKM');
    $sheet->setCellValue('I4', 'Jenis Program MBKM');
    $sheet->setCellValue('J4', 'Pengalaman di Luar Kampus (Kegiatan MBKM)');
    $sheet->setCellValue('K4', 'Waktu Mulai Pendaftaran');
    $sheet->setCellValue('L4', 'Waktu Berakhir Pendaftaran');
    $sheet->setCellValue('M4', 'Lokasi / PT / Instansi / perusahaan Tujuan');
    $sheet->setCellValue('N4', 'Jumlah SKS diambil');

    $spreadsheet->getActiveSheet()->mergeCells('A1:N1');
    $spreadsheet->getActiveSheet()->getStyle('A1')->applyFromArray($headerStyle);
    $spreadsheet->getActiveSheet()->mergeCells('A2:N2');
    $spreadsheet->getActiveSheet()->getStyle('A2')->applyFromArray($headerStyle);
    $spreadsheet->getActiveSheet()->getStyle('A4:G4')->applyFromArray($borderHeaderStyle);
    $spreadsheet->getActiveSheet()->getStyle('H4:N4')->applyFromArray($borderHeaderStyle1);
    $spreadsheet->getActiveSheet()->getStyle('A4:N4')->getAlignment()->setWrapText(true);

    if ($this->input->post('jenis_print') == '1') {
      $list_data = $this->report_model->get_pendaftaran_mbkm()->result();
    } elseif ($this->input->post('jenis_print') == '2') {
      $kd_prodi = $this->input->post('kd_prodi');
      $list_data = $this->report_model->get_pendaftaran_mbkm_prodi($kd_prodi)->result();
    } elseif ($this->input->post('jenis_print') == '3') {
      $semester = $this->input->post('semester');
      $list_data = $this->report_model->get_pendaftaran_mbkm_semester($semester)->result();
    } elseif ($this->input->post('jenis_print') == '4') {
      $kd_prodi = $this->input->post('kd_prodi');
      $semester = $this->input->post('semester');
      $list_data = $this->report_model->get_pendaftaran_mbkm_prodi_semester($kd_prodi, $semester)->result();
    }

    $i = 5;
    $number = 1;
    foreach ($list_data as $row) {
      $jumlah_sks = $this->report_model->get_jumlah_sks($row->id)->row()->jumlah_sks;
      
      $sheet->setCellValue('A'.$i, $number);
      $sheet->setCellValue('B'.$i, $row->nama);
      $sheet->setCellValue('C'.$i, $row->nim);
      $sheet->setCellValue('D'.$i, $row->jenjang);
      $sheet->setCellValue('E'.$i, $row->nama_prodi);
      $sheet->setCellValue('F'.$i, $row->semester);
      $sheet->setCellValue('G'.$i, $row->angkatan);
      $sheet->setCellValue('H'.$i, $row->jenis_mbkm);
      $sheet->setCellValue('I'.$i, $row->nama_program);
      $sheet->setCellValue('J'.$i, $row->nama_kegiatan);
      $sheet->setCellValue('K'.$i, $this->tgl_indo($row->waktu_mulai));
      $sheet->setCellValue('L'.$i, $this->tgl_indo($row->waktu_selesai));
      $sheet->setCellValue('M'.$i, $row->nama_mitra);
      $sheet->setCellValue('N'.$i, $jumlah_sks);
      $i++;
      $number++;
    }

    if ($this->input->post('jenis_print') == '1') {
      $list_data_pertukaran = $this->report_model->get_pendaftaran_mbkm_pertukaran()->result();
    } elseif ($this->input->post('jenis_print') == '2') {
      $kd_prodi = $this->input->post('kd_prodi');
      $list_data_pertukaran = $this->report_model->get_pendaftaran_mbkm_pertukaran_prodi($kd_prodi)->result();
    } elseif ($this->input->post('jenis_print') == '3') {
      $semester = $this->input->post('semester');
      $list_data_pertukaran = $this->report_model->get_pendaftaran_mbkm_pertukaran_semester($semester)->result();
    } elseif ($this->input->post('jenis_print') == '4') {
      $kd_prodi = $this->input->post('kd_prodi');
      $semester = $this->input->post('semester');
      $list_data_pertukaran = $this->report_model->get_pendaftaran_mbkm_pertukaran_prodi_semester($kd_prodi, $semester)->result();
    }

    foreach ($list_data_pertukaran as $row) {
      $jumlah_sks = $this->report_model->get_jumlah_sks_pertukaran($row->id)->row()->jumlah_sks;
      $sheet->setCellValue('A'.$i, $number);
      $sheet->setCellValue('B'.$i, $row->nama);
      $sheet->setCellValue('C'.$i, $row->nim);
      $sheet->setCellValue('D'.$i, $row->jenjang);
      $sheet->setCellValue('E'.$i, $row->nama_prodi);
      $sheet->setCellValue('F'.$i, $row->semester);
      $sheet->setCellValue('G'.$i, $row->angkatan);
      $sheet->setCellValue('H'.$i, $row->jenis_mbkm);
      $sheet->setCellValue('I'.$i, $row->nama_program);
      $sheet->setCellValue('J'.$i, $row->nama_kegiatan);
      $sheet->setCellValue('K'.$i, $this->tgl_indo($row->waktu_mulai));
      $sheet->setCellValue('L'.$i, $this->tgl_indo($row->waktu_selesai));
      $sheet->setCellValue('M'.$i, $row->nama_mitra);
      $sheet->setCellValue('N'.$i, $jumlah_sks);
      $i++;
      $number++;
    }

    if ($this->input->post('jenis_print') == '1') {
      $list_data_kegiatan_lain = $this->report_model->get_pendaftaran_mbkm_kegiatan_lain()->result();
    } elseif ($this->input->post('jenis_print') == '2') {
      $kd_prodi = $this->input->post('kd_prodi');
      $list_data_kegiatan_lain = $this->report_model->get_pendaftaran_mbkm_kegiatan_lain_prodi($kd_prodi)->result();
    } elseif ($this->input->post('jenis_print') == '3') {
      $semester = $this->input->post('semester');
      $list_data_kegiatan_lain = $this->report_model->get_pendaftaran_mbkm_kegiatan_lain_semester($semester)->result();
    } elseif ($this->input->post('jenis_print') == '4') {
      $kd_prodi = $this->input->post('kd_prodi');
      $semester = $this->input->post('semester');
      $list_data_kegiatan_lain = $this->report_model->get_pendaftaran_mbkm_kegiatan_lain_prodi_semester($kd_prodi, $semester)->result();
    }

    
    foreach ($list_data_kegiatan_lain as $row) {
      $jumlah_sks = $this->report_model->get_jumlah_sks_kegiatan_lain($row->id)->row()->jumlah_sks;
      $sheet->setCellValue('A'.$i, $number);
      $sheet->setCellValue('B'.$i, $row->nama);
      $sheet->setCellValue('C'.$i, $row->nim);
      $sheet->setCellValue('D'.$i, $row->jenjang);
      $sheet->setCellValue('E'.$i, $row->nama_prodi);
      $sheet->setCellValue('F'.$i, $row->semester);
      $sheet->setCellValue('G'.$i, $row->angkatan);
      $sheet->setCellValue('H'.$i, $row->jenis_mbkm);
      $sheet->setCellValue('I'.$i, $row->nama_program);
      $sheet->setCellValue('J'.$i, $row->nama_kegiatan);
      $sheet->setCellValue('K'.$i, $row->waktu_mulai);
      $sheet->setCellValue('L'.$i, $row->waktu_selesai);
      $sheet->setCellValue('M'.$i, $row->nama_mitra);
      $sheet->setCellValue('N'.$i, $jumlah_sks);
      $i++;
      $number++;
    }
    
    $i--;
    $count = $i--;
    $spreadsheet->getActiveSheet()->getStyle('A5:A'.$count)->applyFromArray($borderBodyCenterStyle);
    $spreadsheet->getActiveSheet()->getStyle('B5:C'.$count)->applyFromArray($borderBodyStyle);
    $spreadsheet->getActiveSheet()->getStyle('C5:H'.$count)->applyFromArray($borderBodyCenterStyle);
    $spreadsheet->getActiveSheet()->getStyle('I5:L'.$count)->applyFromArray($borderBodyStyle);
    $spreadsheet->getActiveSheet()->getStyle('M5:M'.$count)->applyFromArray($borderBodyStyle);
    $spreadsheet->getActiveSheet()->getStyle('N5:N'.$count)->applyFromArray($borderBodyCenterStyle);
    
    $writer = new Xlsx($spreadsheet);
    $filename = 'IKU 2 Kegiatan MBKM';
    
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
  }

  // public function iku_2_prestasi()
  // {
  //   $inputFileName = './docs/IKU 2 - Prestasi.xlsx';

	// 	/** Create a new Xls Reader  **/
	// 	$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
	// 	/** Load $inputFileName to a Spreadsheet Object  **/
		
	// 	$spreadsheet = $reader->load($inputFileName);

	// 	$iku2 = $spreadsheet->getSheetByName('IKU 2');
  //   // $iku2->setCellValue('B3', 'Nomor : '.$data_kuitansi->no_sp);

  //   if($this->input->post('jenis_print') == 1) {
  //     $data_iku2 = $this->report_model->get_prestasi()->result();
  //   } elseif($this->input->post('jenis_print') == 2) {
  //     $data_iku2 = $this->report_model->get_prestasi_prodi($this->input->post('kd_prodi'))->result();
  //   } elseif($this->input->post('jenis_print') == 3) {
  //     $data_iku2 = $this->report_model->get_prestasi_tingkat($this->input->post('tingkat_kegiatan'))->result();
  //   } elseif($this->input->post('jenis_print') == 4) {
  //     $data_iku2 = $this->report_model->get_prestasi_prodi_tingkat($this->input->post('kd_prodi'), $this->input->post('tingkat_kegiatan'))->result();
  //   }

  //   $base_number = 6;
	// 	$i = 6;
	// 	$number = 1;
	// 	foreach ($data_iku2 as $show) {
	// 		$iku2->insertNewRowBefore($i, 1);
	// 		$iku2->setCellValue('A'.$i, $number);
	// 		$iku2->setCellValue('B'.$i, $show->nama);
	// 		$iku2->setCellValue('C'.$i, $show->nim);
	// 		$iku2->setCellValue('D'.$i, $show->jenjang);
	// 		$iku2->setCellValue('E'.$i, $show->nama_prodi);
	// 		$iku2->setCellValue('F'.$i, $show->angkatan);
	// 		$iku2->setCellValue('G'.$i, $show->nama_kegiatan);
	// 		$iku2->setCellValue('H'.$i, $show->nama_pelaksana);
	// 		$iku2->setCellValue('I'.$i, $show->tingkat_kegiatan);
	// 		$iku2->setCellValue('J'.$i, $show->nama_pembimbing);
	// 		$iku2->setCellValue('K'.$i, $show->tanggal_mulai);
	// 		$iku2->setCellValue('L'.$i, $show->tanggal_selesai);
	// 		$iku2->setCellValue('M'.$i, $show->peringkat);
	// 		$iku2->setCellValue('N'.$i, $show->jml_negara);
	// 		$iku2->setCellValue('O'.$i, $show->jml_pt);
	// 		$iku2->setCellValue('P'.$i, $show->jenis_peserta);
	// 		$iku2->setCellValue('Q'.$i, $show->nomor_sertifikat);
	// 		$iku2->setCellValue('R'.$i, $show->m_pelaksana);
	// 		$iku2->setCellValue('S'.$i, $show->nomor_sk);
	// 		$iku2->setCellValue('T'.$i, $show->foto);
	// 		$iku2->setCellValue('U'.$i, $show->sk);
	// 		$iku2->setCellValue('V'.$i, $show->link);
	// 		$iku2->setCellValue('W'.$i, $show->keterangan);
			
	// 		$i++;
	// 		$number++;
	// 	}

	// 	$iku2->removeRow($base_number - 1, 1);
	// 	//$iku2->removeRow($i - 1, 1);

  //   $writer = new Xlsx($spreadsheet);
  //   $filename = 'IKU 2 Prestasi';
    
  //   header('Content-Type: application/vnd.ms-excel');
  //   header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
  //   header('Cache-Control: max-age=0');

  //   $writer->save('php://output');
  // }

  public function iku_2_prestasi()
{
    $inputFileName = './docs/IKU 2 - Prestasi.xlsx';
    $uploadPath = './uploads/prestasi/';
    $base_url = 'http://localhost/mbkm/uploads/prestasi/';

    $reader = new ReaderXlsx();
    $spreadsheet = $reader->load($inputFileName);
    $iku2 = $spreadsheet->getSheetByName('IKU 2');

    // Filter Data
    $jenis_print = $this->input->post('jenis_print');
    if ($jenis_print == 1) {
        $data_iku2 = $this->report_model->get_prestasi()->result();
    } elseif ($jenis_print == 2) {
        $data_iku2 = $this->report_model->get_prestasi_prodi($this->input->post('kd_prodi'))->result();
    } elseif ($jenis_print == 3) {
        $data_iku2 = $this->report_model->get_prestasi_tingkat($this->input->post('tingkat_kegiatan'))->result();
    } elseif ($jenis_print == 4) {
        $data_iku2 = $this->report_model->get_prestasi_prodi_tingkat($this->input->post('kd_prodi'), $this->input->post('tingkat_kegiatan'))->result();
    }

    $base_number = 6;
    $i = $base_number;
    $number = 1;

    foreach ($data_iku2 as $show) {
        $iku2->insertNewRowBefore($i, 1);

        $iku2->setCellValue('A' . $i, $number);
        $iku2->setCellValue('B' . $i, $show->nama);
        $iku2->setCellValue('C' . $i, $show->nim);
        $iku2->setCellValue('D' . $i, $show->jenjang);
        $iku2->setCellValue('E' . $i, $show->nama_prodi);
        $iku2->setCellValue('F' . $i, $show->angkatan);
        $iku2->setCellValue('G' . $i, $show->nama_kegiatan);
        $iku2->setCellValue('H' . $i, $show->nama_pelaksana);
        $iku2->setCellValue('I' . $i, $show->tingkat_kegiatan);
        $iku2->setCellValue('J' . $i, $show->nama_pembimbing);
        $iku2->setCellValue('K' . $i, $show->dana_diterima);
        $iku2->setCellValue('L' . $i, $show->tanggal_mulai);
        $iku2->setCellValue('M' . $i, $show->tanggal_selesai);
        $iku2->setCellValue('N' . $i, $show->peringkat);
        $iku2->setCellValue('O' . $i, $show->jml_negara);
        $iku2->setCellValue('P' . $i, $show->jml_pt);
        $iku2->setCellValue('Q' . $i, $show->jenis_peserta);
        $iku2->setCellValue('R' . $i, $show->nomor_sertifikat);
        $iku2->setCellValue('S' . $i, $show->m_pelaksana);
        $iku2->setCellValue('T' . $i, $show->nomor_sk);

        // === FOTO (Hyperlink)
        $foto_path = $uploadPath . $show->foto;
        if (file_exists($foto_path)) {
            $iku2->getCell('U' . $i)->getHyperlink()->setUrl($base_url . $show->foto);
            $iku2->setCellValue('U' . $i, 'Lihat Foto');
        } else {
            $iku2->setCellValue('U' . $i, 'Tidak ada');
        }

        // === SERTIFIKAT (PDF)
        $sertifikat_path = $uploadPath . $show->sertifikat;
        if (file_exists($sertifikat_path)) {
            $iku2->getCell('V' . $i)->getHyperlink()->setUrl($base_url . $show->sertifikat);
            $iku2->setCellValue('V' . $i, 'Lihat Sertifikat');
        } else {
            $iku2->setCellValue('V' . $i, 'Tidak ada');
        }

        // === SK (PDF)
        $sk_path = $uploadPath . $show->sk;
        if (file_exists($sk_path)) {
            $iku2->getCell('W' . $i)->getHyperlink()->setUrl($base_url . $show->sk);
            $iku2->setCellValue('W' . $i, 'Lihat SK');
        } else {
            $iku2->setCellValue('W' . $i, 'Tidak ada');
        }

        // === LINK (gambar/link)
        $link_path = $uploadPath . $show->link;
        if (file_exists($link_path)) {
            $iku2->getCell('X' . $i)->getHyperlink()->setUrl($base_url . $show->link);
            $iku2->setCellValue('X' . $i, 'Lihat Link');
        } else {
            $iku2->setCellValue('X' . $i, 'Tidak ada');
        }

        // === KETERANGAN
        $iku2->setCellValue('Y' . $i, $show->keterangan);

        $i++;
        $number++;
    }

    // Hapus baris template
    $iku2->removeRow($base_number - 1, 1);

    // Export ke file
    $writer = new Xlsx($spreadsheet);
    $filename = 'IKU_2_Prestasi_' . date('YmdHis') . '.xlsx';

    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'. $filename .'"');
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
}


  public function iku_3_data_dosen()
  {
    $inputFileName = './docs/IKU 3 - Data Dosen Tetap.xlsx';

		/** Create a new Xls Reader  **/
		$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		/** Load $inputFileName to a Spreadsheet Object  **/
		
		$spreadsheet = $reader->load($inputFileName);

		$iku3 = $spreadsheet->getSheetByName('IKU 3');

    if($this->input->post('jenis_print') == 1) {
      $data_iku3 = $this->report_model->get_pekerjaan_dosen()->result();
      $data_wirausaha_iku3 = $this->report_model->get_wirausaha_dosen()->result();
    } elseif($this->input->post('jenis_print') == 2) {
      $data_iku3 = $this->report_model->get_pekerjaan_dosen_prodi($this->input->post('kd_prodi'))->result();
      $data_wirausaha_iku3 = $this->report_model->get_wirausaha_dosen_prodi($this->input->post('kd_prodi'))->result();
    } elseif($this->input->post('jenis_print') == 3) {
      $data_iku3 = $this->report_model->get_pekerjaan_dosen_waktu($this->input->post('date_from'), $this->input->post('date_to'))->result();
      $data_wirausaha_iku3 = $this->report_model->get_wirausaha_dosen_waktu($this->input->post('date_from'), $this->input->post('date_to'))->result();
    } elseif($this->input->post('jenis_print') == 4) {
      $data_iku3 = $this->report_model->get_pekerjaan_dosen_prodi_waktu($this->input->post('kd_prodi'), $this->input->post('date_from'), $this->input->post('date_to'))->result();
      $data_wirausaha_iku3 = $this->report_model->get_wirausaha_dosen_prodi_waktu($this->input->post('kd_prodi'), $this->input->post('date_from'), $this->input->post('date_to'))->result();
    }

    $base_number = 7;
		$i = 7;
		$number = 1;
		foreach ($data_iku3 as $show) {
      $tanggal_selesai = '';
      if($show->tanggal_berhenti == '0000-00-00') {
        $tanggal_selesai = 'Masih Aktif'; 
      } else {
        $tanggal_selesai = $this->tgl_indo($show->tanggal_berhenti);
      }
			$iku3->insertNewRowBefore($i, 1);
			$iku3->setCellValue('A'.$i, $number);
			$iku3->setCellValue('B'.$i, $show->nama);
			$iku3->setCellValue('C'.$i, $show->nip);
			$iku3->setCellValue('D'.$i, $show->nama_prodi);
			$iku3->setCellValue('E'.$i, $show->pangkat_gol);
			$iku3->setCellValue('F'.$i, $show->jabatan_fungsional);
			$iku3->setCellValue('G'.$i, $show->jabatan);
			$iku3->setCellValue('H'.$i, $show->nama_perusahaan);
			$iku3->setCellValue('I'.$i, $this->tgl_indo($show->tanggal_masuk));
			$iku3->setCellValue('J'.$i, $tanggal_selesai);
			
			$i++;
			$number++;
		}

    foreach ($data_wirausaha_iku3 as $show) {
      $tanggal_selesai = '';
      if($show->tanggal_selesai == '0000-00-00') {
        $tanggal_selesai = 'Masih Aktif'; 
      } else {
        $tanggal_selesai = $this->tgl_indo($show->tanggal_selesai);
      }
			$iku3->insertNewRowBefore($i, 1);
			$iku3->setCellValue('A'.$i, $number);
			$iku3->setCellValue('B'.$i, $show->nama);
			$iku3->setCellValue('C'.$i, $show->nip);
			$iku3->setCellValue('D'.$i, $show->nama_prodi);
			$iku3->setCellValue('E'.$i, $show->pangkat_gol);
			$iku3->setCellValue('F'.$i, $show->jabatan_fungsional);
			$iku3->setCellValue('G'.$i, 'Wirausaha');
			$iku3->setCellValue('H'.$i, $show->nama_usaha);
			$iku3->setCellValue('I'.$i, $this->tgl_indo($show->tanggal_mulai));
			$iku3->setCellValue('J'.$i, $tanggal_selesai);
			
			$i++;
			$number++;
		}

		$iku3->removeRow($base_number - 1, 1);
		//$iku3->removeRow($i - 1, 1);

    $writer = new Xlsx($spreadsheet);
    $filename = 'IKU 3 Data Dosen';
    
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
  }

  public function iku_4_data_kualifikasi_dosen()
  {
    $inputFileName = './docs/IKU 4 - Dosen Bersertifikat Profesional.xlsx';

		/** Create a new Xls Reader  **/
		$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		/** Load $inputFileName to a Spreadsheet Object  **/
		
		$spreadsheet = $reader->load($inputFileName);

		$iku4 = $spreadsheet->getSheetByName('IKU 4 Sertifikat');

    if($this->input->post('jenis_print') == 1) {
      $data_iku4 = $this->report_model->get_pendidikan_s3_dosen()->result();
      $data_sertifikasi_iku4 = $this->report_model->get_sertifikasi_dosen()->result();
    } elseif($this->input->post('jenis_print') == 2) {
      $data_iku4 = $this->report_model->get_pendidikan_s3_dosen_prodi($this->input->post('kd_prodi'))->result();
      $data_sertifikasi_iku4 = $this->report_model->get_sertifikasi_dosen_prodi($this->input->post('kd_prodi'))->result();
    }

    $base_number = 7;
		$i = 7;
		$number = 1;
		foreach ($data_iku4 as $show) {
      $tahun_yudisium = '';
      if($show->tanggal_yudisium == '0000-00-00') {
        $tahun_yudisium = 'Masih Aktif'; 
      } else {
        $parts = explode('-', $show->tanggal_yudisium);
        $tahun_yudisium = $parts[0];
      }
			$iku4->insertNewRowBefore($i, 1);
			$iku4->setCellValue('A'.$i, $number);
			$iku4->setCellValue('B'.$i, $show->nama);
			$iku4->setCellValue('C'.$i, $show->nip);
			$iku4->setCellValue('D'.$i, $show->nama_prodi);
			$iku4->setCellValue('E'.$i, $show->pangkat_gol);
			$iku4->setCellValue('F'.$i, $show->jabatan_fungsional);
			$iku4->setCellValue('G'.$i, $show->jenjang);
			$iku4->setCellValue('H'.$i, '-');
			$iku4->setCellValue('I'.$i, $tahun_yudisium);
			
			$i++;
			$number++;
		}

    foreach ($data_sertifikasi_iku4 as $show) {
      $tahun_selesai = '';
      if($show->tanggal_selesai == '0000-00-00') {
        $tahun_selesai = 'Masih Aktif'; 
      } else {
        $parts = explode('-', $show->tanggal_selesai);
        $tahun_selesai = $parts[0];
      }
			$iku4->insertNewRowBefore($i, 1);
			$iku4->setCellValue('A'.$i, $number);
			$iku4->setCellValue('B'.$i, $show->nama);
			$iku4->setCellValue('C'.$i, $show->nip);
			$iku4->setCellValue('D'.$i, $show->nama_prodi);
			$iku4->setCellValue('E'.$i, $show->pangkat_gol);
			$iku4->setCellValue('F'.$i, $show->jabatan_fungsional);
			$iku4->setCellValue('G'.$i, '-');
			$iku4->setCellValue('H'.$i, $show->nama_kegiatan);
			$iku4->setCellValue('I'.$i, $tahun_selesai);
			
			$i++;
			$number++;
		}
    
		$iku4->removeRow($base_number - 1, 1);


    $iku4_profesional = $spreadsheet->getSheetByName('IKU 4 Profesional');

    if($this->input->post('jenis_print') == 1) {
      $data_iku4 = $this->report_model->get_pekerjaan_dosen()->result();
    } elseif($this->input->post('jenis_print') == 2) {
      $data_iku4 = $this->report_model->get_pekerjaan_dosen_prodi($this->input->post('kd_prodi'))->result();
    }

    $base_number = 7;
		$i = 7;
		$number = 1;
		foreach ($data_iku4 as $show) {
			$iku4_profesional->insertNewRowBefore($i, 1);
			$iku4_profesional->setCellValue('A'.$i, $number);
			$iku4_profesional->setCellValue('B'.$i, $show->nama);
			$iku4_profesional->setCellValue('C'.$i, $show->nip);
			$iku4_profesional->setCellValue('D'.$i, $show->nama_prodi);
			$iku4_profesional->setCellValue('E'.$i, $show->pangkat_gol);
			$iku4_profesional->setCellValue('F'.$i, $show->jabatan_fungsional);
			$iku4_profesional->setCellValue('G'.$i, $show->nama_perusahaan);
			$iku4_profesional->setCellValue('H'.$i, $show->jabatan);
			
			$i++;
			$number++;
		}

    $iku4_profesional->removeRow($base_number - 1, 1);

    $writer = new Xlsx($spreadsheet);
    $filename = 'IKU 4 Data Kualifikasi Dosen';
    
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
  }

  public function iku_5_recognisi()
  {
    $inputFileName = './docs/IKU 5 - Recognisi Karya Dosen.xlsx';

		/** Create a new Xls Reader  **/
		$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		/** Load $inputFileName to a Spreadsheet Object  **/
		
		$spreadsheet = $reader->load($inputFileName);

		$iku5 = $spreadsheet->getSheetByName('IKU 5');

    if($this->input->post('jenis_print') == 1) {
      $data_iku5 = $this->report_model->get_karya_ilmiah()->result();
    } elseif($this->input->post('jenis_print') == 2) {
      $data_iku5 = $this->report_model->get_karya_ilmiah_prodi($this->input->post('kd_prodi'))->result();
    } elseif($this->input->post('jenis_print') == 3) {
      $data_iku5 = $this->report_model->get_karya_ilmiah_tahun($this->input->post('tahun'))->result();
    } elseif($this->input->post('jenis_print') == 4) {
      $data_iku5 = $this->report_model->get_karya_ilmiah_prodi_tahun($this->input->post('kd_prodi'), $this->input->post('tahun'))->result();
    }

    $base_number = 6;
		$i = 6;
		$number = 1;
		foreach ($data_iku5 as $show) {
			$iku5->insertNewRowBefore($i, 1);
			$iku5->setCellValue('A'.$i, $number);
			$iku5->setCellValue('B'.$i, $show->nama);
			$iku5->setCellValue('C'.$i, $show->nip);
			$iku5->setCellValue('D'.$i, $show->nama_prodi);
			$iku5->setCellValue('E'.$i, $show->jabatan_fungsional);
			$iku5->setCellValue('F'.$i, $show->jenis_luaran);
			$iku5->setCellValue('G'.$i, $show->jenis_karya_ilmiah);
			$iku5->setCellValue('H'.$i, $show->judul_karya_ilmiah);
			$iku5->setCellValue('I'.$i, $show->nama_jurnal);
			$iku5->setCellValue('J'.$i, $show->tahun);
			
			$i++;
			$number++;
		}

		$iku5->removeRow($base_number - 1, 1);
		//$iku5->removeRow($i - 1, 1);

    $writer = new Xlsx($spreadsheet);
    $filename = 'IKU 5 Recognisi Karya Dosen';
    
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
  }

  public function iku_6_mitra()
  {
    $inputFileName = './docs/IKU 6 - Kerjasama Prodi dengan Mitra.xlsx';

		/** Create a new Xls Reader  **/
		$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		/** Load $inputFileName to a Spreadsheet Object  **/
		
		$spreadsheet = $reader->load($inputFileName);

		$iku6 = $spreadsheet->getSheetByName('IKU 6');

    
    $data_iku6 = $this->report_model->get_mitra()->result();
    $data_iku6_1 = $this->report_model->get_mitra_kurikulum()->result();
    $data_iku6_2 = $this->report_model->get_mitra_magang()->result();
    

    $base_number = 6;
		$i = 6;
		$number = 1;
		foreach ($data_iku6 as $show) {
			$iku6->insertNewRowBefore($i, 1);
			$iku6->setCellValue('A'.$i, $number);
			$iku6->setCellValue('B'.$i, $show->nama_mitra);
			$iku6->setCellValue('C'.$i, $show->kriteria_mitra);
			$iku6->setCellValue('D'.$i, $show->alamat);
			
			$i++;
			$number++;
		}

    $i = 6;
		foreach ($data_iku6_1 as $show) {
			$iku6->setCellValue('E'.$i, $show->nama_mitra);
			$iku6->setCellValue('F'.$i, $show->kriteria_mitra);
			$iku6->setCellValue('G'.$i, $show->alamat);
			
			$i++;
		}

    $i = 6;
		foreach ($data_iku6_2 as $show) {
			$iku6->setCellValue('H'.$i, $show->nama_mitra);
			$iku6->setCellValue('I'.$i, $show->kriteria_mitra);
			$iku6->setCellValue('J'.$i, $show->alamat);
			
			$i++;
		}

		$iku6->removeRow($base_number - 1, 1);
		//$iku6->removeRow($i - 1, 1);

    $writer = new Xlsx($spreadsheet);
    $filename = 'IKU 6 Data Kerjasama Dengan Mitra';
    
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
  }

  public function iku_7_matakuliah()
  {
    $inputFileName = './docs/IKU 7 - Matkul CM TMP Mix.xlsx';

		/** Create a new Xls Reader  **/
		$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		/** Load $inputFileName to a Spreadsheet Object  **/
		
		$spreadsheet = $reader->load($inputFileName);

		$iku7 = $spreadsheet->getSheetByName('IKU 7');

    
    $data_iku7 = $this->report_model->get_matakuliah()->result();
    

    $base_number = 6;
		$i = 6;
		$number = 1;
		foreach ($data_iku7 as $show) {
			$iku7->insertNewRowBefore($i, 1);
			$iku7->setCellValue('A'.$i, $number);
			$iku7->setCellValue('B'.$i, $show->kd_mk);
			$iku7->setCellValue('C'.$i, $show->matakuliah);
			$iku7->setCellValue('D'.$i, $show->sks);
			
			$i++;
			$number++;
		}

    $iku7->removeRow($base_number - 1, 1);
		//$iku7->removeRow($i - 1, 1);

    $writer = new Xlsx($spreadsheet);
    $filename = 'IKU 7 Data Matakuliah';
    
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
  }

  public function cetak_mk_inbound()
  {
    $inputFileName = './docs/Matkul Inbound.xlsx';

		/** Create a new Xls Reader  **/
		$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		/** Load $inputFileName to a Spreadsheet Object  **/
		
		$spreadsheet = $reader->load($inputFileName);

		$iku7 = $spreadsheet->getSheetByName('matakuliah');

    
    $matakuliah = $this->report_model->get_matakuliah_inbound_aktif()->result();
    

    $base_number = 6;
		$i = 6;
		$number = 1;
		foreach ($matakuliah as $show) {
			$iku7->insertNewRowBefore($i, 1);
			$iku7->setCellValue('A'.$i, $number);
			$iku7->setCellValue('B'.$i, $show->kd_mk);
			$iku7->setCellValue('C'.$i, $show->matakuliah);
			$iku7->setCellValue('D'.$i, $show->sks);
			$iku7->setCellValue('E'.$i, $show->status);
			$iku7->setCellValue('F'.$i, $show->kuota);
			$iku7->setCellValue('G'.$i, $show->sisa_kuota);
			$iku7->setCellValue('H'.$i, $show->kelas);
			$iku7->setCellValue('I'.$i, $show->hari);
			$iku7->setCellValue('J'.$i, $show->jam_mulai." - ".$show->jam_selesai);
			$iku7->setCellValue('K'.$i, $this->tgl_indo($show->waktu_mulai)." - ".$this->tgl_indo($show->waktu_selesai));
			
			$i++;
			$number++;
		}

    $iku7->removeRow($base_number - 1, 1);
		//$iku7->removeRow($i - 1, 1);

    $writer = new Xlsx($spreadsheet);
    $filename = 'Matakuliah Inbound';
    
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
  }

  public function cetak_mk_inbound_all()
  {
    $inputFileName = './docs/Matkul Inbound.xlsx';

		/** Create a new Xls Reader  **/
		$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		/** Load $inputFileName to a Spreadsheet Object  **/
		
		$spreadsheet = $reader->load($inputFileName);

		$iku7 = $spreadsheet->getSheetByName('matakuliah');

    
    $matakuliah = $this->report_model->get_matakuliah_inbound()->result();
    

    $base_number = 6;
		$i = 6;
		$number = 1;
		foreach ($matakuliah as $show) {
			$iku7->insertNewRowBefore($i, 1);
			$iku7->setCellValue('A'.$i, $number);
			$iku7->setCellValue('B'.$i, $show->kd_mk);
			$iku7->setCellValue('C'.$i, $show->matakuliah);
			$iku7->setCellValue('D'.$i, $show->sks);
			$iku7->setCellValue('E'.$i, $show->status);
			$iku7->setCellValue('F'.$i, $show->kuota);
			$iku7->setCellValue('G'.$i, $show->sisa_kuota);
			$iku7->setCellValue('H'.$i, $show->kelas);
			$iku7->setCellValue('I'.$i, $show->hari);
			$iku7->setCellValue('J'.$i, $show->jam_mulai." - ".$show->jam_selesai);
			$iku7->setCellValue('K'.$i, $this->tgl_indo($show->waktu_mulai)." - ".$this->tgl_indo($show->waktu_selesai));
			
			$i++;
			$number++;
		}

    $iku7->removeRow($base_number - 1, 1);
		//$iku7->removeRow($i - 1, 1);

    $writer = new Xlsx($spreadsheet);
    $filename = 'Matakuliah Inbound';
    
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
  }
}
?>