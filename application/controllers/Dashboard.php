<?php

class Dashboard extends CI_Controller {

    public function index() {
        $data['barang'] = $this->model_barang->tampil_data()->result();
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('dashboard', $data);
        $this->load->view('template/footer');
    }

    public function tambah_ke_keranjang($id) {
        $barang = $this->model_barang->find($id);

        $data = array(
                'id'      => $barang->id_brg,
                'qty'     => 1,
                'price'   => $barang->harga,
                'name'    => $barang->nama_brg
        );

        $this->cart->insert($data);
        redirect('dashboard');
    }

    public function detail_keranjang() {
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('keranjang');
        $this->load->view('template/footer');
    }

    public function hapus_keranjang() {
        $this->cart->destroy();
        redirect('dashboard/index');
    }

    public function pembayaran() {
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pembayaran');
        $this->load->view('template/footer');
    }

    public function proses_pesanan() {
        $this->cart->destroy();
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('proses_pesanan');
        $this->load->view('template/footer');
    }
}
