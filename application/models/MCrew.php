<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MCrew extends CI_model {

	public function upload_file($filename){

		// Load librari upload
		
		$config['upload_path'] = './assets/upload_excel/'; 
		$config['allowed_types'] = 'xls|xlsx|csv|ods|ots';
		$config['max_size'] = 10000;
		$config['overwrite'] = true;
		$config['file_name'] = $filename;

		$this->load->library('upload'); 
		$this->upload->initialize($config); // Load konfigurasi uploadnya
		if($this->upload->do_upload('file')){ // Lakukan upload dan Cek jika proses upload berhasil
		  // Jika berhasil :
			$return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
			return $return;
		}else{
		  // Jika gagal :
			$return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
		return $return;
		}
	}
	
	  // Buat sebuah fungsi untuk melakukan insert lebih dari 1 data
	public function insert_multiple($data){
		$this->db->insert_batch('crew', $data);
		$this->db->insert_batch('approve', $data);
	}
	


	public function getData()
	{
		$this->db->select('*');
		$this->db->from('crew');
		return $this->db->get()->result();
		// $data = $this->db->get('laporan');
		// return $data;
	}

	public function insert($data) {
		$this->db->insert('crew', $data);
		$this->db->insert('approve', $data);
		
			}
			
    public function ubah($data,$id) {
		$this->db->where('id',$id);
		$this->db->update('approve', $data);
		$this->db->where('id',$id);
		$this->db->update('crew', $data);

	}

	// public function insert_batch($data) {
	// 	$this->db->insert_batch('crew', $data);
	// 	$this->db->insert_batch('approve', $data);
		
	// 	return $this->db->affected_rows();
	// }
	
	public function hapus($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('crew');
		$this->db->where('id',$id);
		$this->db->delete('approve');
		$this->db->where('id',$id);
		$this->db->delete('keberangkatan');
	}
}
?>	 