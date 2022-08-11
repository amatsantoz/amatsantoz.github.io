<?php

class Home extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
	}

	public function index() {
		if($this->session->userdata('level')==='Full Akses'){
			$template = array(
				'menusidebar' => $this->load->view('template/menu', '', true),
				'judulkonten' => 'Home',
				'konten' => $this->load->view('template/beranda', '', true)
			);
			$this->parser->parse('template/halaman', $template);
		}
		// 	echo "Access Denied";
		// }
		
	}

	public function jktid() {
		if($this->session->userdata('level')==='Approval'){
			$template = array(
				'menusidebar' => $this->load->view('template/menu2', '', true),
				'judulkonten' => 'Approval',
				'konten' => $this->load->view('approval/viewdata', '', true)
			);
			$this->parser->parse('template/halaman', $template);
			
		}else{
		    echo "Access Denied";
		}
	
	}

	public function agi() {
		 //Allowing akses to author only
		if($this->session->userdata('level')==='Keberangkatan'){
			
			$template = array(
				'menusidebar' => $this->load->view('template/menu3', '', true),
				'judulkonten' => 'Keberangkatan',
				'konten' => $this->load->view('keberangkatan/viewdata', '', true)
			);
			$this->parser->parse('template/halaman', $template);
		}else{
			echo "Access Denied";
		} 
	}

}