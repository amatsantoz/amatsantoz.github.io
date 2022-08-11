<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	public function  __construct() {
		parent::__construct();
		$this->load->model('MAdmin', 'modal');
		$this->load->library('form_validation');
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
    
	}

	public function index() {
		if($this->session->userdata('level')==='Full Akses'){	
		$template = array(
			'menusidebar' => $this->load->view('template/menu', '', true),
			'judulkonten' => 'Manage User',
			'konten' => $this->load->view('admin/viewdata', '', true),
			'datalaporan' => $this->modal->getData()
		);
		$this->parser->parse('template/halaman', $template);
		}else{
			echo "Access Denied";
		} 
	}

	public function simpan() {

		$id = $this->input->post('id');
		$uname = $this->input->post('uname');
		$pass = md5($this->input->post('pass'));
		$level = $this->input->post('level');
		$data = array(
			'username' => $uname,
			'password' => $pass,
			'level'=> $level
			
		);
		if ($id == null || $id == "") {
			$this->modal->insert($data);
			$this->session->set_flashdata('suksess', "Data Berhasil Ditambahkan");
		} else {
			$this->modal->ubah($data,$id);
			$this->session->set_flashdata('suksess', "Data Berhasil Diubah");
		}
		redirect('admin');
	}

	public function ubah() {
		$id = $this->input->post('id');
		$uname = $this->input->post('uname');
		$password = md5($this->input->post('password',TRUE));
		$level = $this->input->post('level');
		$data = array(
			'id' => $id,
			'username' => $uname,
			'password' => $pass,
			'level'=> $level
		);
			$this->modal->ubah($data,$id);
			$this->session->set_flashdata('suksess', "Data Berhasil Diubah");
		redirect('admin');
	}
	

	public function hapus($id)
	{
		$this->modal->hapus($id);

		$this->session->set_flashdata('suksess', "Data Berhasil Dihapus");
		redirect('admin');
	}


	public function import(){
		$fileName = $this->input->post('file', TRUE);
	  
		$config['upload_path'] = './assets/upload_excel/'; 
		$config['file_name'] = $fileName;
		$config['allowed_types'] = 'xls|xlsx|csv|ods|ots';
		$config['max_size'] = 10000;
	  
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
	  
		 for ($row = 3; $row <= $highestRow; $row++){  
		   $rowData = $sheet->rangeToArray('B' . $row . ':' . $highestColumn . $row,
			 NULL,
			 TRUE,
			 FALSE);
		   $data = array(
		   "id"=> $rowData[0][0],
		   "nama"=> $rowData[0][1],
		   "jabatan"=> $rowData[0][2],
			"unit"=> $rowData[0][3],
			"agt_klrg"=> $rowData[0][4],
			"tgl_30"=>  $rowData[0][5],
			"tgl_validity"=> $rowData[0][6]
		  );
		  $this->db->insert("crew",$data);
		 } 
		 $this->session->set_flashdata('msg','Berhasil upload ...!!'); 
		 redirect('crew');
		}  
	   } 

	// public function import(){
    //     $fileName = time().$_FILES['file']['name'];
    //     $config['upload_path'] = './assets/upload_excel/'; //buat folder dengan nama assets di root folder
    //     $config['file_name'] = $fileName;
    //     $config['allowed_types'] = 'xls|xlsx|csv';
    //     $config['max_size'] = 10000;
         
    //     $this->load->library('upload');
	// 	$this->upload->initialize($config);
		
	// 	if ( ! $this->upload->do_upload('file')){
	// 		$error = array('error' => $this->upload->display_errors());
	// 		print_r($error); die();
	// 	}
	// 	else{
	// 		$data = $this->upload->data();
	// 		$this->upload->do_upload('file');
	// 	}
    //     // if($this->upload->do_upload('file') )
    //     // $this->upload->display_errors();
             
    //     $media = $this->upload->data('file');
    //     $inputFileName = './assets/upload_excel/'.$media['file_name'];
         
    //     try {
	// 		$inputFileType = IOFactory::identify($inputFileName);
	// 		$objReader = IOFactory::createReader($inputFileType);
    //             // $inputFileType = IOFactory::identify($inputFileName);
    //             // $objReader = IOFactory::createReader($inputFileType);
    //             $objPHPExcel = $objReader->load($inputFileName);
    //         } catch(Exception $e) {
    //             die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
    //         }
 
    //         $sheet = $objPHPExcel->getSheet(0);
    //         $highestRow = $sheet->getHighestRow();
    //         $highestColumn = $sheet->getHighestColumn();
             
    //         for ($row = 2; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
    //             $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
    //                                             NULL,
    //                                             TRUE,
    //                                             FALSE);
                                                 
    //             //Sesuaikan sama nama kolom tabel di database                                
    //              $data = array(
    //                 "id"=> $rowData[0][0],
    //                 "nama"=> $rowData[0][1],
    //                 "unit"=> $rowData[0][2]
    //             );
                 
    //             //sesuaikan nama dengan nama tabel
    //             $insert = $this->db->insert("crew",$data);
    //             delete_files($media['file_path']);
                     
    //         }
    //     redirect('crew/');
    // }



	// public function import() {
	// 	$this->form_validation->set_rules('excel', 'File', 'trim|required');

	// 	if ($_FILES['excel']['name'] == '') {
	// 		$this->session->setflashdata('msg', 'File harus diisi');
	// 	} else {
	// 		$config['upload_path'] = './assets/upload_excel/';
	// 		$config['allowed_types'] = 'xls|xlsx';
			
	// 		$this->load->library('upload', $config);
			
	// 		if ( ! $this->upload->do_upload('excel')){
	// 			$error = array('error' => $this->upload->display_errors());
	// 		}
	// 		else{
	// 			$data = $this->upload->data();
				
	// 			error_reporting(E_ALL);
	// 			date_default_timezone_set('Asia/Jakarta');

	// 			include './assets/phpexcel/Classes/PHPExcel/IOFactory.php';

	// 			$inputFileName = './assets/upload_excel/' .$data['file_name'];
	// 			$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
	// 			$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

	// 			$index = 0;
	// 			foreach ($sheetData as $key => $value) {
	// 				if ($key != 1) {
	// 					$id = md5(DATE('ymdhms').rand());

	// 					if ($check != 1) {
	// 						$resultData[$index]['id'] = $id;
	// 						$resultData[$index]['nama'] = $value['B'];
	// 						$resultData[$index]['unit'] = $value['C'];
	// 					}
	// 				}
	// 				$index++;
	// 			}

	// 			unlink('./assets/upload_excel/' .$data['file_name']);

	// 			if (count($resultData) != 0) {
	// 				$result = $this->MCrew>insert($resultData);
	// 				if ($result > 0) {
	// 					$this->session->set_flashdata('msg', show_succ_msg('Data Pegawai Berhasil diimport ke database'));
	// 					redirect('crew/');
	// 				}
	// 			} else {
	// 				$this->session->set_flashdata('msg', show_msg('Data Pegawai Gagal diimport ke database (Data Sudah terupdate)', 'warning', 'fa-warning'));
	// 				redirect('crew/');
	// 			}

	// 		}
	// 	}
	// }

    // public function import()
    // {
    //                 if(isset($_FILES["file"]["name"]))
    //                     {
    //                         $path = $_FILES["file"]["tmp_name"];
    //                         $object = PHPExcel_IOFactory::load($path);
    //                         foreach($object->getWorksheetIterator() as $worksheet)
    //                         {
    //                             $highestRow = $worksheet->getHighestRow();
    //                             $highestColumn = $worksheet->getHighestColumn();
    //                             for($row=2; $row<=$highestRow; $row++)
    //                             {   
    //                                 $id = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
	// 								$nama= $worksheet->getCellByColumnAndRow(1, $row)->getValue();
    //                                 $unit= $worksheet->getCellByColumnAndRow(1, $row)->getValue();
    //                                 $data[] = array(
    //                                     'id'=>$id,
	// 									'nama'=>$nama,
	// 									'unit'=>$unit
    //                                 );
    //                             }
    //                         }
    //                         $this->MCrew->insert('crew',$data);
                            
    //                     }                
	// 					redirect('crew/');
    // }


	// public function Fexport(){
	// 	// Load plugin PHPExcel nya
	// 	include APPPATH.'libraries/PHPExcel.php';
		
	// 	// Panggil class PHPExcel nya
	// 	$excel = new PHPExcell();
	// 	// Settingan awal fil excel
	// 	$excel->getProperties()->setCreator('Garuda')
	// 				 ->setLastModifiedBy('Garuda')
	// 				 ->setTitle("Format Excel")
	// 				 ->setSubject("Format")
	// 				 ->setDescription("Format Excel")
	// 				 ->setKeywords("Format Excel");
	// 	// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
	// 	$style_col = array(
	// 	  'font' => array('bold' => true), // Set font nya jadi bold
	// 	  'alignment' => array(
	// 		'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
	// 		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
	// 	  ),
	// 	  'borders' => array(
	// 		'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
	// 		'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
	// 		'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
	// 		'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
	// 	  )
	// 	);
	// 	// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
	// 	$style_row = array(
	// 	  'alignment' => array(
	// 		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
	// 	  ),
	// 	  'borders' => array(
	// 		'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
	// 		'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
	// 		'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
	// 		'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
	// 	  )
	// 	);
	// 	$excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA LAPORAN"); // Set kolom A1 dengan tulisan "DATA SISWA"
	// 	$excel->getActiveSheet()->mergeCells('A1:I1'); // Set Merge Cell pada kolom A1 sampai E1
	// 	$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
	// 	$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
	// 	$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
	// 	// Buat header tabel nya pada baris ke 3
	// 	$excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
	// 	$excel->setActiveSheetIndex(0)->setCellValue('B3', "NO LAPORAN"); 
	// 	$excel->setActiveSheetIndex(0)->setCellValue('C3', "NO PEGAWAI"); 
	// 	$excel->setActiveSheetIndex(0)->setCellValue('D3', "NAMA"); 
	// 	$excel->setActiveSheetIndex(0)->setCellValue('E3', "NO HP"); 
	// 	$excel->setActiveSheetIndex(0)->setCellValue('F3', "TANGGAL"); 
	// 	$excel->setActiveSheetIndex(0)->setCellValue('G3', "KETERANGAN");
	// 	$excel->setActiveSheetIndex(0)->setCellValue('H3', "PENANGGUNG JAWAB");
	// 	$excel->setActiveSheetIndex(0)->setCellValue('I3', "STATUS");
	// 	// Apply style header yang telah kita buat tadi ke masing-masing kolom header
	// 	$excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
	// 	$excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
	// 	$excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
	// 	$excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
	// 	$excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
	// 	$excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
	// 	$excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
	// 	$excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
	// 	$excel->getActiveSheet()->getStyle('I3')->applyFromArray($style_col);
	// 	// Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
		
	// 	// Set width kolom
	// 	$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
	// 	$excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
	// 	$excel->getActiveSheet()->getColumnDimension('C')->setWidth(15); // Set width kolom C
	// 	$excel->getActiveSheet()->getColumnDimension('D')->setWidth(25); // Set width kolom D
	// 	$excel->getActiveSheet()->getColumnDimension('E')->setWidth(15); // Set width kolom E
	// 	$excel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
	// 	$excel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
	// 	$excel->getActiveSheet()->getColumnDimension('H')->setWidth(25);
	// 	$excel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
		
	// 	// Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
	// 	$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
	// 	// Set orientasi kertas jadi LANDSCAPE
	// 	$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
	// 	// Set judul file excel nya
	// 	$excel->getActiveSheet(0)->setTitle("Format Excel");
	// 	$excel->setActiveSheetIndex(0);
	// 	// Proses file excel
	// 	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	// 	header('Content-Disposition: attachment; filename="Data Laporan.xlsx"'); // Set nama file excel nya
	// 	header('Cache-Control: max-age=0');
	// 	$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
	// 	$write->save('php://output');
	//   }

	// public function export(){
	// 	// Load plugin PHPExcel nya
	// 	include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		
	// 	// Panggil class PHPExcel nya
	// 	$excel = new PHPExcel();
	// 	// Settingan awal fil excel
	// 	$excel->getProperties()->setCreator('Ryan')
	// 				 ->setLastModifiedBy('Ryan')
	// 				 ->setTitle("Data Laporan")
	// 				 ->setSubject("Laporan")
	// 				 ->setDescription("Laporan")
	// 				 ->setKeywords("Data Laporan");
	// 	// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
	// 	$style_col = array(
	// 	  'font' => array('bold' => true), // Set font nya jadi bold
	// 	  'alignment' => array(
	// 		'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
	// 		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
	// 	  ),
	// 	  'borders' => array(
	// 		'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
	// 		'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
	// 		'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
	// 		'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
	// 	  )
	// 	);
	// 	// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
	// 	$style_row = array(
	// 	  'alignment' => array(
	// 		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
	// 	  ),
	// 	  'borders' => array(
	// 		'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
	// 		'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
	// 		'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
	// 		'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
	// 	  )
	// 	);
	// 	$excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA LAPORAN"); // Set kolom A1 dengan tulisan "DATA SISWA"
	// 	$excel->getActiveSheet()->mergeCells('A1:H1'); // Set Merge Cell pada kolom A1 sampai E1
	// 	$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
	// 	$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
	// 	$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
	// 	// Buat header tabel nya pada baris ke 3
	// 	$excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
	// 	$excel->setActiveSheetIndex(0)->setCellValue('B3', "NO LAPORAN"); 
	// 	$excel->setActiveSheetIndex(0)->setCellValue('C3', "NO PEGAWAI"); 
	// 	$excel->setActiveSheetIndex(0)->setCellValue('D3', "NAMA"); 
	// 	$excel->setActiveSheetIndex(0)->setCellValue('E3', "NO HP"); 
	// 	$excel->setActiveSheetIndex(0)->setCellValue('F3', "TANGGAL"); 
	// 	$excel->setActiveSheetIndex(0)->setCellValue('G3', "KETERANGAN");
	// 	$excel->setActiveSheetIndex(0)->setCellValue('H3', "STATUS");
	// 	// Apply style header yang telah kita buat tadi ke masing-masing kolom header
	// 	$excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
	// 	$excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
	// 	$excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
	// 	$excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
	// 	$excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
	// 	$excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
	// 	$excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
	// 	$excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
	// 	// Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
	// 	$laporan = $this->modal->getData();
	// 	$no = 1; // Untuk penomoran tabel, di awal set dengan 1
	// 	$numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
	// 	foreach($laporan as $data){ 
	// 	  $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
	// 	  $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->no_laporan);
	// 	  $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->no_pegawai);
	// 	  $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->nama);
	// 	  $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->no_hp);
	// 	  $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data->tanggal);
	// 	  $excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data->keterangan);
	// 	  $excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $data->status);
		  
	// 	  // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
	// 	  $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
	// 	  $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
	// 	  $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
	// 	  $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
	// 	  $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
	// 	  $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
	// 	  $excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
	// 	  $excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
		  
	// 	  $no++; // Tambah 1 setiap kali looping
	// 	  $numrow++; // Tambah 1 setiap kali looping
	// 	}
	// 	// Set width kolom
	// 	$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
	// 	$excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
	// 	$excel->getActiveSheet()->getColumnDimension('C')->setWidth(15); // Set width kolom C
	// 	$excel->getActiveSheet()->getColumnDimension('D')->setWidth(25); // Set width kolom D
	// 	$excel->getActiveSheet()->getColumnDimension('E')->setWidth(15); // Set width kolom E
	// 	$excel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
	// 	$excel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
	// 	$excel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
		
	// 	// Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
	// 	$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
	// 	// Set orientasi kertas jadi LANDSCAPE
	// 	$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
	// 	// Set judul file excel nya
	// 	$excel->getActiveSheet(0)->setTitle("Data Laporan");
	// 	$excel->setActiveSheetIndex(0);
	// 	// Proses file excel
	// 	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	// 	header('Content-Disposition: attachment; filename="Data Laporan.xlsx"'); // Set nama file excel nya
	// 	header('Cache-Control: max-age=0');
	// 	$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
	// 	$write->save('php://output');
	//   }
	
	
	}
?>