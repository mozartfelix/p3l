<div class="container-fluid">
    <h3><i class="fas fa-edit"></i>EDIT DATA BARANG</h3>

    <?php foreach ($barang as $brg) : ?>

        <form method="post" action="<?php echo base_url(). 'admin/Data_barang/update' ?>" enctype="multipart/form-data">
            
            <div class="form-group">
                <label>Nama Barang</label>
                <input type="text" name="nama_brg" class="form-control" value="<?php echo $brg->nama_brg ?>">
            </div>
            
            <div class="form-group">
                <label>Keterangan</label>
                <input type="hidden" name="id_brg" class="form-control" value="<?php echo $brg->id_brg ?>">
                <input type="text" name="keterangan" class="form-control" value="<?php echo $brg->keterangan ?>">
            </div>

            <div class="form-group">
                <label>Kategori</label>
                <select class="form-control" name="kategori" value="<?php echo $brg->kategori ?>">
                    <option>Sepatu Pria</option>
                    <option>Sepatu Wanita</option>
                    <option>Sepatu Anak-anak</option>
                    <option>Sepatu Olahraga</option>
                    <option>Sepatu Casual</option>
                </select>
            </div>

            <div class="form-group">
                <label>Harga</label>
                <input type="text" name="harga" class="form-control" value="<?php echo $brg->harga ?>">

            <div class="form-group">
                <label>Stok</label>
                <input type="text" name="stok" class="form-control" value="<?php echo $brg->stok ?>">
            </div>

            <div class="form-group">
                <label>Gambar Barang</label><br>
                <img src="<?php echo base_url('uploads/') . $brg->gambar; ?>" class="img-thumbnail" width="200"><br><br>
                <input type="file" name="gambar" class="form-control">
            </div>

            <button type="button" class="btn btn-danger btn-sm mt-3" onclick="window.location.href='<?php echo base_url('admin/data_barang'); ?>'">Batal</button>
            <button type="submit" class="btn btn-primary btn-sm mt-3">Simpan</button>

        </form>

    <?php endforeach; ?>
</div>