<?php

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if($this->session->userdata('role_id') != '2') {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    Anda Belum Login!
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    </div>');
            redirect('Auth/login');
        }
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
        redirect('welcome');
    }

    public function detail_keranjang() {
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('keranjang');
        $this->load->view('template/footer');
    }

    public function hapus_keranjang() {
        $this->cart->destroy();
        redirect('welcome');
    }

    public function update_keranjang() {
        $action = $this->input->post('action');
        $rowids = $this->input->post('rowid');
        $quantities = $this->input->post('qty');
        $message = '';

        if ($action == 'update') {
            // Perbarui jumlah barang di keranjang
            $is_updated = false;
            foreach ($quantities as $rowid => $qty) {
                $item = $this->cart->get_item($rowid);
                if ($item['qty'] != $qty) {
                    $this->cart->update(['rowid' => $rowid, 'qty' => $qty]);
                    $is_updated = true;
                }
            }
            $message = $is_updated ? 
            'Jumlah barang berhasil diperbarui!' : 
            'Tidak ada perubahan jumlah barang.';
        } elseif ($action == 'hapus') {
            // Hapus barang berdasarkan rowid yang dipilih
            if ($rowids) {
                foreach ($rowids as $rowid) {
                    $this->cart->remove($rowid);
                }
                $message = 'Barang yang dipilih berhasil dihapus!';
            } else {
                $message = 'Tidak ada barang yang dipilih untuk dihapus.';
            }
        } elseif ($action == 'checkout') {
            // Proses checkout barang yang dipilih
            if ($rowids) {
                $barang_checkout = [];
                foreach ($this->cart->contents() as $item) {
                    if (in_array($item['rowid'], $rowids)) {
                        // Ambil gambar barang dari database
                        $barang = $this->model_barang->get_barang_by_id($item['id']);
                        // Tambahkan gambar ke item
                        $item['gambar'] = $barang->gambar;
                        $barang_checkout[] = $item;
                        $this->cart->remove($item['rowid']);
                    }
                }

                $this->session->set_userdata('barang_checkout', $barang_checkout);
                $message = 'Barang berhasil diproses untuk checkout.';
                redirect('Dashboard/pembayaran');
            } else {
                $message = 'Tidak ada barang yang dipilih untuk checkout.';
            }
        }

        $this->session->set_flashdata('pesan', $message);
        redirect('Dashboard/detail_keranjang');
    }

    public function pembayaran() {
        $barang_checkout = $this->session->userdata('barang_checkout');
        if (!$barang_checkout) {
            redirect('Dashboard/detail_keranjang');
        }

        $data['barang_checkout'] = $barang_checkout;

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pembayaran', $data);
        $this->load->view('template/footer');
    }

    // Fungsi untuk menampilkan invoice pembelian
    public function invoice_pembelian($id_invoice) {
        $barang_checkout = $this->session->userdata('barang_checkout');
        $nama = $this->session->userdata('nama');
        
        // Pastikan `$pesan` selalu diinisialisasi
        $data['pesan'] = null; // Nilai default
        if (!$barang_checkout || !$nama) {
            $data['pesan'] = "Transaksi pembelian Anda sedang diproses oleh penjual.";
            $data['barang_checkout'] = [];
        } else {
            // Ambil detail invoice berdasarkan ID
            $data['invoice'] = $this->model_invoice->get_invoice_by_id($id_invoice); // Pastikan ini menggunakan $id_invoice
            $data['barang_checkout'] = $barang_checkout;
            // Ambil detail pesanan terkait dengan invoice
            $data['pesanan'] = $this->model_invoice->ambil_id_pesanan($id_invoice); // Tambahkan ini
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('proses_pesanan', $data);
        $this->load->view('template/footer');
    }

    public function proses_pesanan() {
        // Load library form validation
        $this->load->library('form_validation');

        // Aturan validasi untuk setiap input
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required', [
            'required' => 'Nama Lengkap wajib diisi!'
        ]);
        $this->form_validation->set_rules('alamat', 'Alamat Lengkap', 'required', [
            'required' => 'Alamat Lengkap wajib diisi!'
        ]);
        $this->form_validation->set_rules('no_telp', 'Nomor Telepon', 'required|numeric', [
            'required' => 'Nomor Telepon wajib diisi!',
            'numeric'  => 'Nomor Telepon hanya boleh berisi angka!'
        ]);

        // Jika validasi gagal
        if ($this->form_validation->run() == FALSE) {
            // Tampilkan kembali halaman pembayaran dengan pesan error
            $this->load->view('template/header');
            $this->load->view('template/sidebar');
            $this->load->view('pembayaran');
            $this->load->view('template/footer');
        } else {
            // Simpan data ke session untuk digunakan pada invoice
            $this->session->set_userdata([
                'nama'            => $this->input->post('nama'),
                'alamat'          => $this->input->post('alamat'),
                'no_telp'         => $this->input->post('no_telp'),
                'jasa_pengiriman' => $this->input->post('jasa_pengiriman'),
                'bank'            => $this->input->post('bank'),
                'nomor_rekening'  => $this->get_rekening_by_bank($this->input->post('bank'))
            ]);

            // Ambil barang yang telah di-checkout dari session
            $barang_checkout = $this->session->userdata('barang_checkout');
            if (!$barang_checkout) {
                redirect('Dashboard/detail_keranjang');
            }

            // Jika validasi berhasil, proses pesanan dan masukkan data invoice
            $is_processed = $this->model_invoice->index();
            if($is_processed){
                $data['barang_checkout'] = $barang_checkout; // Kirim data barang checkout ke view
                $this->load->view('template/header');
                $this->load->view('template/sidebar');
                $this->load->view('proses_pesanan', $data);
                $this->load->view('template/footer');
            } else {
                echo "Maaf, Pesanan Anda Gagal diproses!";
            }
        }
    }

    // Fungsi untuk mendapatkan nomor rekening berdasarkan bank yang dipilih
    private function get_rekening_by_bank($bank) {
        switch ($bank) {
            case 'BCA':
                return '1008027510';
            case 'BNI':
                return '5022143035';
            case 'BRI':
                return '312255007281390';
            case 'Mandiri':
                return '8020015379102';
            default:
                return '';
        }
    }

    public function daftar_invoice() {
        $data['invoice'] = $this->model_invoice->tampil_data();
        if ($data['invoice'] === false) {
            $data['invoice'] = []; // Jika tidak ada data, kirim array kosong
        }
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('invoice', $data);
        $this->load->view('template/footer');
    }

    public function selesai_pesanan() {
        // Menghapus data barang di keranjang (session)
        $this->session->unset_userdata('barang_checkout');
        
        // Menghapus atau mengosongkan data lain yang relevan jika diperlukan
        $this->session->unset_userdata('nama');
        $this->session->unset_userdata('alamat');
        $this->session->unset_userdata('no_telp');
        $this->session->unset_userdata('jasa_pengiriman');
        $this->session->unset_userdata('bank');
        $this->session->unset_userdata('nomor_rekening');
        
        // Set pesan informasi
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    Proses pembelian Anda telah selesai!
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                </div>');
        
        // Redirect ke halaman yang sesuai, misalnya dashboard atau halaman lain
        redirect('Welcome');
    }

    public function detail($id_brg) {
        $data['barang'] = $this->model_barang->detail_brg($id_brg);
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('detail_barang', $data);
        $this->load->view('template/footer');
    }

}
