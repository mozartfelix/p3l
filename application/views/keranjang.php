<div class="container-fluid">
    <h4>Keranjang Belanja</h4>

    <!-- Flash message -->
    <?php if ($this->session->flashdata('pesan')) : ?>
        <div class="alert alert-info"><?php echo $this->session->flashdata('pesan'); ?></div>
    <?php endif; ?>

    <form method="post" action="<?php echo base_url('Dashboard/update_keranjang'); ?>">
        <table class="table table-bordered table-striped table-hover">
            <tr align="center">
                <th>Pilih</th>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Sub-Total</th>
            </tr>

            <?php 
            $no=1;
            foreach ($this->cart->contents() as $items) : ?>

                <tr>
                    <td align="center">
                        <input type="checkbox" name="rowid[]" value="<?php echo $items['rowid']; ?>" class="select-item" 
                            data-subtotal="<?php echo $items['subtotal']; ?>">
                    </td>
                    <td align="center"><?php echo $no++ ?></td>
                    <td><?php echo $items['name'] ?></td>
                    <td align="center">
                        <input type="number" name="qty[<?php echo $items['rowid']; ?>]" value="<?php echo $items['qty']; ?>" min="1" max="99" class="form-control" style="width: 60px;">
                    </td>
                    <td align="right">Rp. <?php echo number_format($items['price'], 0,',','.') ?></td>
                    <td align="right">Rp. <?php echo number_format($items['subtotal'], 0,',','.') ?></td>
                </tr>
                
            <?php endforeach; ?>

            <tr>
                <td colspan="5" align="right"><strong>Total yang Dipilih:</strong></td>
                <td align="right">
                    <span id="total-selected">Rp. 0</span>
                </td>
            </tr>
        </table>

        <div align="right">
            <a href="<?php echo base_url('Welcome/index') ?>"><div class="btn btn-sm btn-danger">Kembali</div></a>
            <button type="submit" name="action" value="update" class="btn btn-sm btn-primary">Perbarui Jumlah</button>
            <button type="submit" name="action" value="hapus" class="btn btn-sm btn-warning">Hapus yang dipilih</button>
            <button type="submit" name="action" value="checkout" class="btn btn-sm btn-success">Checkout yang dipilih</button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkboxes = document.querySelectorAll('.select-item');
        const totalSelectedEl = document.getElementById('total-selected');

        // Function to update total price
        function updateTotal() {
            let total = 0;
            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    total += parseFloat(checkbox.dataset.subtotal);
                }
            });
            totalSelectedEl.textContent = "Rp. " + total.toLocaleString('id-ID', { minimumFractionDigits: 0 });
        }

        // Add event listeners to checkboxes
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateTotal);
        });

        // Initial calculation (if needed)
        updateTotal();
    });
</script>