<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Data_expired extends CI_Controller {
	
	public function  __construct() {
		parent::__construct();
		$this->load->model('MData_expired', 'modal');
		$this->load->library('form_validation');
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
		ini_set('max_excution_time',0);
	}
    
    public function index() {
		$template = array(
			'menusidebar' => $this->load->view('template/menu', '', true),
			'judulkonten' => 'Pengambilan License Cockpit Crew',
			'konten' => $this->load->view('data_expired/viewdata', '', true),
            'dataexpired' => $this->modal->getData()
		);
		$this->parser->parse('template/halaman', $template);
	}
    
    public function simpan() {
        $nopengambilan = $this->input->post('nopengambilan');
		$nopegawai = $this->input->post('nopegawai');
		$namapegawai = $this->input->post('namapegawai');
		$tanggalpengambilan = $this->input->post('tanggalpengambilan');
		$keterangan = $this->input->post('keterangan');
		$status = $this->input->post('status');
		$data = array(
			'no_pengambilan' => $nopengambilan,
			'no_pegawai' => $nopegawai,
			'nama' => $namapegawai,
			'tgl_pengambilan' => $tanggalpengambilan,
			'keterangan' =>$keterangan,
			'status' => $status);
        if ($nopengambilan == null || $nopengambilan == "") {
			$this->modal->insert($data);
			$this->session->set_flashdata('suksess', "Data Berhasil Ditambahkan");
		} else {
			$this->modal->ubah($data,$nopengambilan);
			$this->session->set_flashdata('suksess', "Data Berhasil Diubah");
		}
        
		redirect('license');
	}
    public function hapus($nopengambilan)
	{
		$this->modal->hapus($nopengambilan);

		$this->session->set_flashdata('suksess', "Data Berhasil Dihapus");
		redirect('license');
	}

	public function import(){
		$fileName = $this->input->post('file', TRUE);
	  
		$config['upload_path'] = './assets/upload_excel/'; 
		$config['file_name'] = $fileName;
		$config['allowed_types'] = 'xls|xlsx|csv|ods|ots';
		$config['max_size'] = 1000000;
	  
		$this->load->library('upload', $config);
		$this->upload->initialize($config); 
		
		if (!$this->upload->do_upload('file')) {
		 $error = array('error' => $this->upload->display_errors());
		 $this->session->set_flashdata('msg','Ada kesalah dalam upload'); 
		 redirect('Welcome'); 
		} else {
		 $media = $this->upload->data();
		 $inputFileName = './assets/upload_excel/'.$media['file_name'];
		 
		 try {
		  $inputFileType = IOFactory::identify($inputFileName);
		  $objReader = IOFactory::createReader($inputFileType);
		  $objPHPExcel = $objReader->load($inputFileName);
		 } catch(Exception $e) {
		  die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
		 }
	  
		 $sheet = $objPHPExcel->getSheet(0);
		 $highestRow = $sheet->getHighestRow();
		 $highestColumn = $sheet->getHighestColumn();
	  
		 for ($row = 2; $row <= $highestRow; $row++){  
		   $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
			 NULL,
			 TRUE,
			 FALSE);
		   $data = array(
		   "id"=> $rowData[0][0],
		   "nama"=> $rowData[0][1],
		   "rank"=> $rowData[0][3],
		   "bas"=> $rowData[0][4],
		   "rating"=> $rowData[0][5],
		   "pengajuan"=> $rowData[0][6],
		   "GACCOM737"=> $rowData[0][7],
		   "GACCOM330"=> $rowData[0][8],
		   "GACCOM777"=> $rowData[0][9],
		   "GACCOMCRJ"=> $rowData[0][10],
		   "GACCOMATR7"=> $rowData[0][11],
		   "GACREC"=> $rowData[0][12]
		  );
		  $this->db->insert("data_expired",$data);
		 } 
		 $this->session->set_flashdata('msg','Berhasil upload ...!!'); 
		 redirect('data_expired/');
		}  
	   } 

    public function export(){
		// Load plugin PHPExcel nya
		include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		
		// Panggil class PHPExcel nya
		$excel = new PHPExcel();
		// Settingan awal fil excel
		$excel->getProperties()->setCreator('Garuda Indonesia')
					 ->setLastModifiedBy('Garuda Indonesia')
					 ->setTitle("Data Laporan")
					 ->setSubject("Laporan")
					 ->setDescription("Laporan")
					 ->setKeywords("Data Laporan");
		// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
		$style_col = array(
		  'font' => array('bold' => true), // Set font nya jadi bold
		  'alignment' => array(
			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
		  ),
		  'borders' => array(
			'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
			'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
			'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
			'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
		  )
		);
		// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
		$style_row = array(
		  'alignment' => array(
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
		  ),
		  'borders' => array(
			'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
			'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
			'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
			'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
		  )
		);
		$excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA LAPORAN LICENCE"); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->getActiveSheet()->mergeCells('A1:H1'); // Set Merge Cell pada kolom A1 sampai E1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
		
        // Buat header tabel nya pada baris ke 3
		$excel->setActiveSheetIndex(0)->setCellValue('A3', "NO");
		$excel->setActiveSheetIndex(0)->setCellValue('B3', "NO PENGAMBILAN"); // Set kolom A3 dengan tulisan "NO"
		$excel->setActiveSheetIndex(0)->setCellValue('C3', "NO PEGAWAI"); // Set kolom B3 dengan tulisan "NIS"
		$excel->setActiveSheetIndex(0)->setCellValue('D3', "NAMA"); 

		$excel->setActiveSheetIndex(0)->setCellValue('E3', "TANGGAL PENGAMBILAN"); // Set kolom C3 dengan tulisan "NAMA"
		$excel->setActiveSheetIndex(0)->setCellValue('F3', "KETERANGAN"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
		$excel->setActiveSheetIndex(0)->setCellValue('G3', "STATUS"); // Set kolom E3 dengan tulisan "ALAMAT"

		// Apply style header yang telah kita buat tadi ke masing-masing kolom header
		$excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);

		// Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
		$laporanlicence = $this->modal->getData();
		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
		foreach($laporanlicence as $data){ // Lakukan looping pada variabel siswa
		  $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
		  $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->no_pengambilan);
		  $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->no_pegawai);
		  $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->nama);
		  $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->tgl_pengambilan);
		  $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data->keterangan);
		  $excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data->status);


		  
		  // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
		  $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);

		  
		  $no++; // Tambah 1 setiap kali looping
		  $numrow++; // Tambah 1 setiap kali looping
		}
		// Set width kolom
		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(15); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(25); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('E')->setWidth(15); // Set width kolom E
		$excel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
		$excel->getActiveSheet()->getColumnDimension('G')->setWidth(15);

		// Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
		$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
		// Set orientasi kertas jadi LANDSCAPE
		$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		// Set judul file excel nya
		$excel->getActiveSheet(0)->setTitle("Data Laporan Licence");
		$excel->setActiveSheetIndex(0);
		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Data Laporan Licence.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');
		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
	  }
}
?>