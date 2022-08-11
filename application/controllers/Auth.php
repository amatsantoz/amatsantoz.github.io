<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('MAuth');
		
	}
	
	public function index() {
		// $session = $this->session->userdata('status');

		// if ($session == '') {
			// $this->load->view('login');
		// } else {
		// 	redirect('Home');
		// }
		$this->load->library('form_validation');
		if($this->MAuth->is_logged_in())
            {
                //jika memang session sudah terdaftar, maka redirect ke halaman dahsboard
                redirect("Home");

            }else {
		
		$this->form_validation->set_rules('username', 'Username', 'required|min_length[4]|max_length[15]');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == TRUE) {
			$username = trim($_POST['username']);
			$password = trim($_POST['password']);

			$checking = $this->MAuth->check_login('user', array('username' => $username), array('password' => $password));

                //jika ditemukan, maka create session
                if ($checking != FALSE) {
                    foreach ($checking as $apps) {

                        $session_data = array(
                            'user_id'   => $apps->id,
                            'user_name' => $apps->username,
							'user_pass' => $apps->password
                        );
                        //set session userdata
                        $this->session->set_userdata($session_data);

			// $data = $this->MAuth->login($username, $password);

			// if ($data == false) {
			// 	$this->session->set_flashdata('error_msg', 'Username / Password Anda Salah.');
			// 	redirect('Auth');
			// } else {
			// 	$session = [
			// 		'userdata' => $data,
			// 		'status' => "Loged in"
			// 	];
				if ($this->session->userdata('user_name') == "admin") {
					redirect('Home');
				} elseif ($this->session->userdata('user_name') == "jktid") {
					redirect('jktid/Home');
				} elseif ($this->session->userdata('user_name') == "agi") {
					redirect('agi/home');
				}
					
			}
		} else {
			$this->session->set_flashdata('error_msg', validation_errors());
			redirect('Auth');
		}

	}else{

		$this->load->view('login');
	}
	}
}
	// else{

	// 	$this->load->view('login');
	// }

	public function logout() {
		$this->session->sess_destroy();
		redirect('Auth');
	}
}
