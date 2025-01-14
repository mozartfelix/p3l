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
                <p><strong>Nama:</strong> <?php echo $invoice->nama; ?></p>
                <p><strong>Alamat:</strong> <?php echo $invoice->alamat; ?></p>
                <p><strong>No. Telepon:</strong> <?php echo $invoice->no_telp; ?></p>
                <p><strong>Jasa Pengiriman:</strong> <?php echo $invoice->jasa_pengiriman; ?></p>
                <p><strong>Bank:</strong> <?php echo $invoice->bank; ?></p>
                <p><strong>Tanggal Pesan:</strong> <?php echo $invoice->tgl_pesan; ?></p>
                <p><strong>Batas Bayar:</strong> <?php echo $invoice->batas_bayar; ?></p>
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
                foreach ($pesanan as $item) :
                    $subtotal = $item->jumlah * $item->harga;
                    $total += $subtotal;
                ?>
                    <tr>
                        <td>
                            <img src="<?php echo base_url('uploads/' . $item->gambar); ?>" alt="<?php echo $item->nama_brg; ?>" style="width: 100px; height: auto;">
                        </td>
                        <td><?php echo $item->nama_brg; ?></td>
                        <td><?php echo $item->jumlah; ?></td>
                        <td>Rp. <?php echo number_format($item->harga, 0, ',', '.'); ?></td>
                        <td>Rp. <?php echo number_format($subtotal, 0, ',', '.'); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h4>Total Pembayaran: Rp. <?php echo number_format($total, 0, ',', '.'); ?></h4>

        <hr>
        <div class="text-center">
            <a href="<?php echo base_url('Dashboard/daftar_invoice'); ?>" class="btn btn-danger">Kembali</a>
            <a href="<?php echo base_url('Dashboard/selesai_pesanan'); ?>" class="btn btn-success">Selesai</a>
        </div>
    <?php endif; ?>
</div>
