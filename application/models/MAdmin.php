<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MAdmin extends CI_model {

	public function getData()
	{
		$this->db->select('*');
		$this->db->from('user');
		return $this->db->get()->result();
		// $data = $this->db->get('laporan');
		// return $data;
	}

	public function insert($data) {
		$this->db->insert('user', $data);	
	}
			
    public function ubah($data,$id) {
		$this->db->where('id',$id);
		$this->db->update('user', $data);
	}

	public function insert_batch($data) {
		$this->db->insert_batch('crew', $data);
		
		return $this->db->affected_rows();
	}
	
	public function hapus($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('user');
	}
}
?>	 