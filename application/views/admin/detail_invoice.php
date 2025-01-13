<div class="container-fluid">
    <h4>Detail Pesanan <div class="btn btn-sm btn-success">Id. Invoice: <?php echo $invoice->id ?></div> </h4>

    <table class="table table-bordered table-hover table-striped">
        <tr align="center">
            <th>ID BARANG</th>
            <th>NAMA PRODUK</th>
            <th>JUMLAH PESANAN</th>
            <th>HARGA SATUAN</th>
            <th>SUB-TOTAL</th>
        </tr>

        <?php if (!empty($pesanan)) : ?>
            <?php 
            $total = 0;
            foreach ($pesanan as $psn) :
                $subtotal = $psn->jumlah * $psn->harga;
                $total += $subtotal;
            ?>

            <tr>
                <td align="center"><?php echo $psn->id_brg ?></td>
                <td><?php echo $psn->nama_brg ?></td>
                <td align="center"><?php echo $psn->jumlah ?></td>
                <td align="right">Rp. <?php echo number_format($psn->harga, 0,',','.') ?></td>
                <td align="right">Rp. <?php echo number_format($subtotal, 0,',','.') ?></td>
            </tr>

            <?php endforeach; ?>

            <tr>
                <td colspan="4" align="right"><strong>Grand Total:</strong></td>
                <td align="right">Rp. <?php echo number_format($total, 0,',','.') ?></td>
            </tr>
        <?php else : ?>
            <tr>
                <td colspan="5" align="center">Tidak ada pesanan untuk invoice ini.</td>
            </tr>
        <?php endif; ?>

    </table>

    <a href="<?php echo base_url('admin/invoice/index') ?>"><div class="btn btn-sm btn-danger">Kembali</div></a>
</div>