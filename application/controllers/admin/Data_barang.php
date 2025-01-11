<?php

class Data_barang extends CI_Controller {
    public function index() {
        $data['barang'] = $this->model_barang->tampil_data()->result();
        $this->load->view('template_admin/header');
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/Data_barang', $data);
        $this->load->view('template_admin/footer');
    }

    public function tambah_aksi() {
        $nama_brg   = $this->input->post('nama_brg');
        $keterangan = $this->input->post('keterangan');
        $kategori   = $this->input->post('kategori');
        $harga      = $this->input->post('harga');
        $stok       = $this->input->post('stok');
        $gambar = $_FILES['gambar']['name'];
        if ($gambar = '') {} else {
            $config ['upload_path'] = './uploads';
            $config ['allowed_types'] = 'jpg|jpeg|png|gif';

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('gambar')) {
                echo "Gambar Gagal di Upload!";
            } else {
                $gambar = $this->upload->data('file_name');
            }
        }

        $data = array (
            'nama_brg'      => $nama_brg,
            'keterangan'    => $keterangan,
            'kategori'      => $kategori,
            'harga'         => $harga,
            'stok'          => $stok,
            'gambar'        => $gambar
        );

        $this->model_barang->tambah_barang($data, 'tb_barang');
        redirect('admin/data_barang/index');
    }

    public function detail($id_brg) {
        $data['barang'] = $this->model_barang->detail_brg($id_brg);
        $this->load->view('template_admin/header');
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/detail_barang', $data);
        $this->load->view('template_admin/footer');
    }

    public function edit($id) {
        $where = array('id_brg' => $id);
        $data['barang'] = $this->model_barang->edit_barang($where, 'tb_barang')->result();
        $this->load->view('template_admin/header');
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/edit_barang', $data);
        $this->load->view('template_admin/footer');
    }

    public function update() {
        $id         = $this->input->post('id_brg');
        $nama_brg   = $this->input->post('nama_brg');
        $keterangan = $this->input->post('keterangan');
        $kategori   = $this->input->post('kategori');
        $harga      = $this->input->post('harga');
        $stok       = $this->input->post('stok');
        $gambar     = $_FILES['gambar']['name'];

        if ($gambar) {
            $config['upload_path']   = './uploads';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('gambar')) {
                $gambar = $this->upload->data('file_name');

                // Hapus gambar lama jika ada
                $barang = $this->model_barang->get_barang_by_id($id);
                if ($barang->gambar && file_exists('./uploads/' . $barang->gambar)) {
                    unlink('./uploads/' . $barang->gambar);
                }
            } else {
                echo "Gambar gagal diupload!";
            }
        } else {
            $gambar = $this->model_barang->get_barang_by_id($id)->gambar;
        }

        $data = array(
            'nama_brg'      => $nama_brg,
            'keterangan'    => $keterangan,
            'kategori'      => $kategori,
            'harga'         => $harga,
            'stok'          => $stok,
            'gambar'        => $gambar
        );

        $where = array(
            'id_brg' => $id
        );

        $this->model_barang->update_data($where, $data, 'tb_barang');
        redirect('admin/data_barang/index');
    }

    public function hapus($id) {
        $barang = $this->model_barang->get_barang_by_id($id);

        // Hapus file gambar jika ada
        if ($barang->gambar && file_exists('./uploads/' . $barang->gambar)) {
            unlink('./uploads/' . $barang->gambar); // Hapus file gambar
        }

        // Hapus data dari database
        $where = array('id_brg' => $id);
        $this->model_barang->hapus_data($where, 'tb_barang');
        redirect('admin/data_barang/index');
    }
}
