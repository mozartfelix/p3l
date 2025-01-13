<?php 

class Invoice extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if($this->session->userdata('role_id') != '1') {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    Anda Belum Login!
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    </div>');
            redirect('Auth/login');
        }
    }

    public function index() {
        $data['invoice'] = $this->model_invoice->tampil_data();
        if ($data['invoice'] === false) {
            $data['invoice'] = []; // Jika tidak ada data, kirim array kosong
        }
        $this->load->view('template_admin/header');
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/invoice', $data);
        $this->load->view('template_admin/footer');
    }

    public function detail($id_invoice) {
        $data['invoice'] = $this->model_invoice->ambil_id_invoice($id_invoice);
        $data['pesanan'] = $this->model_invoice->ambil_id_pesanan($id_invoice);
        
        // Periksa apakah $pesanan adalah array atau objek
        if ($data['pesanan'] === false) {
            $data['pesanan'] = []; // Jika tidak ada data pesanan, beri array kosong
        }

        $this->load->view('template_admin/header');
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/detail_invoice', $data);
        $this->load->view('template_admin/footer');
    }

    public function hapus($id_invoice) {
        // Hapus data invoice berdasarkan ID
        $hapus_invoice = $this->model_invoice->hapus_invoice($id_invoice);
        
        if ($hapus_invoice) {
            // Setelah berhasil menghapus invoice, redirect ke halaman invoice dengan pesan sukses
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                                        Invoice berhasil dihapus!
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    </div>');
            // Redirect ke halaman utama invoice admin
            redirect('admin/Invoice');
        } else {
            // Jika gagal, tampilkan pesan error
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                        Gagal menghapus invoice!
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    </div>');
            redirect('admin/Invoice');
        }
    }

    public function get_dashboard_data() {
        // Mendapatkan data pendapatan bulanan dan tahunan
        $pendapatan_bulanan = $this->model_invoice->get_pendapatan_bulanan();
        $pendapatan_tahunan = $this->model_invoice->get_pendapatan_tahunan();

        $data['pendapatan_bulanan'] = $pendapatan_bulanan !== null ? $pendapatan_bulanan : 0;
        $data['pendapatan_tahunan'] = $pendapatan_tahunan !== null ? $pendapatan_tahunan : 0;

        // Mengirimkan data ke view dashboard
        $this->load->view('template_admin/header');
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/dashboard', $data);
        $this->load->view('template_admin/footer');
    }

}