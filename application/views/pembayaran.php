<div class="container-fluid">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="btn btn-sm btn-success">
                <?php 
                $grand_total = 0;
                $barang_checkout = $this->session->userdata('barang_checkout');
                if ($barang_checkout) {
                    foreach ($barang_checkout as $item) {
                        $grand_total += $item['subtotal'];
                    }

                    echo "<h4>Total Belanja Anda: Rp. " . number_format($grand_total, 0, ',', '.');
                ?>
            </div><br><br>

            <h3 class="mb-3">Input Alamat Pengirirman dan Pembayaran</h3>

            <form method="post" action="<?php echo base_url('Dashboard/proses_pesanan') ?>">
                
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama" placeholder="Nama Lengkap Anda" class="form-control" value="<?php echo set_value('nama'); ?>">
                    <?php echo form_error('nama', '<div class="text-danger small">', '</div>'); ?>
                </div>
                
                <div class="form-group">
                    <label>Alamat Lengkap</label>
                    <input type="text" name="alamat" placeholder="Alamat Lengkap Anda" class="form-control" value="<?php echo set_value('alamat'); ?>">
                    <?php echo form_error('alamat', '<div class="text-danger small">', '</div>'); ?>
                </div>
                
                <div class="form-group">
                    <label>No. Telepon</label>
                    <input type="text" name="no_telp" placeholder="Nomor Telepon Anda" class="form-control" value="<?php echo set_value('no_telp'); ?>">
                    <?php echo form_error('no_telp', '<div class="text-danger small">', '</div>'); ?>
                </div>
                
                <div class="form-group">
                    <label>Jasa Pengiriman</label>
                    <select class="form-control" name="jasa_pengiriman">
                        <option value="JNE">JNE</option>
                        <option value="TIKI">TIKI</option>
                        <option value="POS Indonesia">POS Indonesia</option>
                        <option value="GOJEK">GOJEK</option>
                        <option value="GRAB">GRAB</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Pilih Bank</label>
                    <select class="form-control" name="bank">
                        <option value="BCA">BCA - 1008027510</option>
                        <option value="BNI">BNI - 5022143035</option>
                        <option value="BRI">BRI - 312255007281390</option>
                        <option value="Mandiri">Mandiri - 8020015379102</option>
                    </select>
                </div>

                <a href="<?php echo base_url('Dashboard/detail_keranjang'); ?>" class="btn btn-sm btn-danger">Kembali</a>
                <button type="submit" class="btn btn-sm btn-success my-3">Checkout</button>

            </form>

            <?php 
                } else {
                    echo "<h4>Keranjang Belanja Anda Masih Kosong";
                }
            ?>
        </div>

        <div class="col-md-2"></div>
    </div>
</div>