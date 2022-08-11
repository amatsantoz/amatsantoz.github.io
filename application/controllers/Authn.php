<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Authn extends MY_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->model('UserModel');
  }
  
  public function index(){
    if($this->session->userdata('authenticated')) // Jika user sudah login (Session authenticated ditemukan)
      redirect('home'); // Redirect ke page welcome
    $this->load->view('login'); // Load view login.php
    }

    public function login(){
    $username = $this->input->post('username'); // Ambil isi dari inputan username pada form login
    $password = md5($this->input->post('password')); // Ambil isi dari inputan password pada form login dan encrypt dengan md5
    $user = $this->UserModel->get($username); // Panggil fungsi get yang ada di UserModel.php
    
    if(empty($user)){ // Jika hasilnya kosong / user tidak ditemukan
      $this->session->set_flashdata('message', 'Username tidak ditemukan'); // Buat session flashdata
      redirect('authn'); // Redirect ke halaman login
    }else{

      if($password == $user->password){ // Jika password yang diinput sama dengan password yang didatabase
        $session = array(
          'authenticated'=>true, // Buat session authenticated dengan value true
          'username'=>$user->username,  // Buat session username 
        );
        $this->session->set_userdata($session); // Buat session sesuai $session
        
        if($this->session->userdata("username") == "admin"){
            redirect('home');

        }elseif ($this->session->userdata("username") == "jktid"){
            redirect('jktid/home/');
        }elseif($this->session->userdata("username") == "agi"){
            redirect('agi/home/');
        }else {
        $this->session->set_flashdata('message', 'Password salah'); // Buat session flashdata
        redirect('authn'); // Redirect ke halaman login
        }
    }
    }   
}
    public function logout(){
    $this->session->sess_destroy(); // Hapus semua session
    redirect('authn'); // Redirect ke halaman login
    }
}

