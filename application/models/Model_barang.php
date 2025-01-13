<?php

class Model_barang extends CI_Model {
    public function tampil_data() {
        return $this->db->get('tb_barang');
    }

    public function tambah_barang($data, $table) {
        $this->db->insert($table, $data);
    }

    public function get_barang_by_id($id) {
        $this->db->where('id_brg', $id);
        return $this->db->get('tb_barang')->row();
    }
    
    public function edit_barang($where, $table) {
        return $this->db->get_where($table, $where);
    }

    public function update_data($where, $data, $table) {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function hapus_data($where, $table) {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function find($id) {
        $result = $this->db->where('id_brg', $id)->limit(1)->get('tb_barang');
        if($result->num_rows() > 0) {
            return $result->row();
        } else {
            return array();
        }
    }

    public function detail_brg($id_brg) {
        $result = $this->db->where('id_brg', $id_brg)->get('tb_barang');
        if($result->num_rows() > 0) {
            return $result->result();
        } else {
            return false;
        }
    }

    public function search_barang($keyword) {
        $this->db->like('nama_brg', $keyword);  // Menyaring nama barang yang mengandung kata kunci
        $this->db->or_like('deskripsi_brg', $keyword); // Menyaring deskripsi barang yang mengandung kata kunci
        $query = $this->db->get('barang');  // Asumsikan tabel barang
        return $query->result();
    }
}
