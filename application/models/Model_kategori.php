<?php 

class Model_kategori extends CI_Model {

    public function data_sepatu_pria() {
        return $this->db->get_where("tb_barang",array('kategori' => 'Sepatu Pria'));
    }
    
    public function data_sepatu_wanita() {
        return $this->db->get_where("tb_barang",array('kategori' => 'Sepatu Wanita'));
    }
    
    public function data_sepatu_anak_anak() {
        return $this->db->get_where("tb_barang",array('kategori' => 'Sepatu Anak-anak'));
    }
    
    public function data_sepatu_olahraga() {
        return $this->db->get_where("tb_barang",array('kategori' => 'Sepatu Olahraga'));
    }
    
    public function data_sepatu_casual() {
        return $this->db->get_where("tb_barang",array('kategori' => 'Sepatu Casual'));
    }
}
