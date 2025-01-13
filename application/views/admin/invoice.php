<div class="container-fluid">
    <h4>Invoice Pemesanan Produk</h4>

    <!-- Tabel Responsif -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead class="thead-dark">
                <tr align="center">
                    <th>Id Invoice</th>
                    <th>Nama Pemesan</th>
                    <th>Alamat Pengiriman</th>
                    <th>Tanggal Pemesanan</th>
                    <th>Batas Pembayaran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($invoice)) : ?>
                    <?php foreach ($invoice as $inv) : ?>
                    <tr>
                        <td align="center"><?php echo $inv->id ?></td>
                        <td><?php echo $inv->nama ?></td>
                        <td><?php echo $inv->alamat ?></td>
                        <td><?php echo $inv->tgl_pesan ?></td>
                        <td><?php echo $inv->batas_bayar ?></td>
                        <td align="center">
                            <?php echo anchor('admin/Invoice/detail/'.$inv->id, 
                                '<div class="btn btn-sm btn-primary">Detail</div>') ?>
                            <!-- Button Hapus -->
                            <form action="<?php echo base_url('admin/Invoice/hapus/'.$inv->id); ?>" method="post" style="display:inline;">
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus invoice ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="6" align="center">Tidak ada data invoice yang tersedia.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
