<div class="container-fluid">
    <?php if (isset($pesan) && $pesan): ?>
        <div class="alert alert-warning">
            <p class="text-center align-middle"><?php echo $pesan; ?></p>
        </div>
    <?php else: ?>
        <div class="alert alert-success">
            <p class="text-center align-middle">Selamat, Pesanan Anda telah Berhasil diproses!!!</p>
        </div>

        <h3 class="text-center">Invoice Pembelian</h3>

        <div class="row">
            <div class="col-md-6">
                <h4>Data Pembeli</h4>
                <p><strong>Nama:</strong> <?php echo $this->session->userdata('nama'); ?></p>
                <p><strong>Alamat:</strong> <?php echo $this->session->userdata('alamat'); ?></p>
                <p><strong>No. Telepon:</strong> <?php echo $this->session->userdata('no_telp'); ?></p>
                <p><strong>Jasa Pengiriman:</strong> <?php echo $this->session->userdata('jasa_pengiriman'); ?></p>
                <p><strong>Bank:</strong> <?php echo $this->session->userdata('bank'); ?></p>
                <p><strong>Nomor Rekening:</strong> <?php echo $this->session->userdata('nomor_rekening'); ?></p>
            </div>

            <div class="col-md-6">
                <h4>Informasi Pembayaran</h4>
                <p>Silahkan transfer ke rekening yang terlampir di bawah ini:</p>
                <ul>
                    <li>BCA - 1008027510</li>
                    <li>BNI - 5022143035</li>
                    <li>BRI - 312255007281390</li>
                    <li>Mandiri - 8020015379102</li>
                </ul>
            </div>
        </div>

        <hr>

        <h4>Detail Barang</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $total = 0;
                foreach ($barang_checkout as $item) :
                    $total += $item['subtotal'];
                ?>
                    <tr>
                        <td><img src="<?php echo base_url('uploads/' . $item['gambar']); ?>" alt="<?php echo $item['name']; ?>" style="width: 50px;"></td>
                        <td><?php echo $item['name']; ?></td>
                        <td><?php echo $item['qty']; ?></td>
                        <td>Rp. <?php echo number_format($item['price'], 0, ',', '.'); ?></td>
                        <td>Rp. <?php echo number_format($item['subtotal'], 0, ',', '.'); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h4>Total Pembayaran: Rp. <?php echo number_format($total, 0, ',', '.'); ?></h4>

        <hr>
        <div class="text-center">
            <a href="<?php echo base_url('Dashboard/daftar_invoice'); ?>" class="btn btn-danger">Kembali</a>
            <!-- Tombol Selesai -->
            <a href="<?php echo base_url('Dashboard/selesai_pesanan'); ?>" class="btn btn-success">Selesai</a>
        </div>
    <?php endif; ?>
</div>
