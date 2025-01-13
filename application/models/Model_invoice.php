<?php 

class Model_invoice extends CI_Model {
    public function index() {
        date_default_timezone_set('Asia/Jakarta');
        $nama   = $this->input->post('nama');
        $alamat = $this->input->post('alamat');

        $invoice = array (
            'nama'          => $nama,
            'alamat'        => $alamat,
            'tgl_pesan'     => date('Y-m-d H:i:s'),
            'batas_bayar'   => date('Y-m-d H:i:s', mktime( date('H'), date('i'), date('s'), date('m'), date('d') + 1, date('Y'))),
        );
        $this->db->insert('tb_invoice', $invoice);
        $id_invoice = $this->db->insert_id();

        foreach ($this->cart->contents() as $item) {
            $data = array (
                'id_invoice'    => $id_invoice,
                'id_brg'        => $item['id'],
                'nama_brg'      => $item['name'],
                'jumlah'        => $item['qty'],
                'harga'         => $item['price'],
            );
            $this->db->insert('tb_pesanan', $data);
        }

        return TRUE;
    }

    public function tampil_data() {
        $result = $this->db->get('tb_invoice');
        if($result->num_rows() > 0) {
            return $result->result();
        } else {
            return false;
        }
    }

    public function ambil_id_invoice($id_invoice) {
        $result = $this->db->where('id', $id_invoice)->limit(1)->get('tb_invoice');
        if($result->num_rows() > 0) {
            return $result->row();
        } else {
            return false;
        }
    }
    
    public function ambil_id_pesanan($id_invoice) {
        $result = $this->db->where('id_invoice', $id_invoice)->get('tb_pesanan');
        if($result->num_rows() > 0) {
            return $result->result();  // Mengembalikan array objek hasil query
        } else {
            return false; // Jika tidak ada data, kembalikan false
        }
    }

    public function get_invoice_by_id($id_invoice) {
        return $this->db->get_where('tb_invoice', ['id' => $id_invoice])->row();
    }

    public function hapus_invoice($id_invoice) {
        // Hapus data invoice dari tabel invoice
        $this->db->where('id', $id_invoice);
        $hapus = $this->db->delete('tb_invoice');
        
        if ($hapus) {
            // Hapus pesanan terkait
            $this->db->where('id_invoice', $id_invoice);
            $this->db->delete('tb_pesanan');
        }
        
        return $hapus;
    }

    public function get_pendapatan_bulanan() {
        // Mendapatkan bulan saat ini
        $bulan_ini = date('m');
        $tahun_ini = date('Y');

        // Query untuk mendapatkan total pendapatan bulan ini
        $this->db->select_sum('tb_pesanan.jumlah * tb_pesanan.harga', 'pendapatan');
        $this->db->from('tb_pesanan');
        $this->db->join('tb_invoice', 'tb_invoice.id = tb_pesanan.id_invoice');
        $this->db->where('MONTH(tb_invoice.tgl_pesan)', $bulan_ini);
        $this->db->where('YEAR(tb_invoice.tgl_pesan)', $tahun_ini);

        $result = $this->db->get()->row();
        return isset($result->pendapatan) ? $result->pendapatan : 0; // Gunakan isset() untuk memeriksa nilai
    }

    public function get_pendapatan_tahunan() {
        // Mendapatkan tahun saat ini
        $tahun_ini = date('Y');

        // Query untuk mendapatkan total pendapatan tahun ini
        $this->db->select_sum('tb_pesanan.jumlah * tb_pesanan.harga', 'pendapatan');
        $this->db->from('tb_pesanan');
        $this->db->join('tb_invoice', 'tb_invoice.id = tb_pesanan.id_invoice');
        $this->db->where('YEAR(tb_invoice.tgl_pesan)', $tahun_ini);

        $result = $this->db->get()->row();
        return isset($result->pendapatan) ? $result->pendapatan : 0; // Gunakan isset() untuk memeriksa nilai
    }

}
