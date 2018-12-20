<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Admin extends CI_Model {

	public function cekLogin($data){
		return $this->db->get_where('admin', $data)->num_rows();
	}

	public function tambah_data($data = array()) {
        return $this->db->insert("table_buku_tamu", $data);
    }

    public function baca_data($data) {
        $this->db->select('*');
        $this->db->from('table_buku_tamu');
        $this->db->where($data);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    // Update
    public function ubah_data($data = array(), $id = array()) {
        return $this->db->update('table_buku_tamu', $data, $id);
    }

    public function hapus() {
        return $this->db->empty_table('table_buku_tamu'); // Hapus semua data yang ada di tabel
    }


}