<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Guestbook_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    // Create
    public function tambah_data($data = array()) {
        return $this->db->insert("data_tamu", $data);
    }

    // Read
    public function baca_data($data) {
        $this->db->select('*');
        $this->db->from('data_tamu');
        $this->db->where($data);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    // Update
    public function ubah_data($data = array(), $id = array()) {
        return $this->db->update('data_tamu', $data, $id);
    }

    // Delete

    // public function hapus_data($data = array()) {
    //     $this->db->delete('data_tamu', $data);
    // }

    public function hapus() {
        return $this->db->empty_table('data_tamu'); // Hapus semua data yang ada di tabel
    }

}