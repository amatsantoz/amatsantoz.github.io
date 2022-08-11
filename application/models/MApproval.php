<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MApproval extends CI_model {

	public function getData()
	{
		$this->db->select('*');
		$this->db->from('approve');
		return $this->db->get()->result();
		// $data = $this->db->get('laporan');
		// return $data;
	}

	public function hapus($id) {
		$this->db->where('id',$id);
		$this->db->delete('keberangkatan');
			}
			
     public function ubah($data,$id) {
	
		$this->db->where('id',$id);
		$this->db->update('approve', $data);
	}

	public function insert($data) {
		$this->db->insert('keberangkatan', $data);
	}
	public function insert_batch($data) {
		$this->db->insert_batch('approve', $data);
		
		return $this->db->affected_rows();
	}
	
	
}
?>	 