<div class="container-fluid">
    <button class="btn btn-sm btn-primary mb-3" data-toggle="modal" data-target="#tambah_barang">
        <i class="fas fa-plus fa-sm"></i> Tambah Barang
    </button>

    <!-- Tabel Responsif -->
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr align="center">
                    <th>NO</th>
                    <th>NAMA BARANG</th>
                    <th>KETERANGAN</th>
                    <th>KATEGORI</th>
                    <th>HARGA</th>
                    <th>STOK</th>
                    <th colspan="3">AKSI</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                foreach ($barang as $brg) : ?>
                    <tr>
                        <td align="center"><?php echo $no++ ?></td>
                        <td><?php echo $brg->nama_brg ?></td>
                        <td><?php echo $brg->keterangan ?></td>
                        <td><?php echo $brg->kategori ?></td>
                        <td align="right">Rp. <?php echo number_format($brg->harga, 0,',','.') ?></td>
                        <td align="center"><?php echo $brg->stok ?></td>
                        <td align="center">
                            <?php echo anchor('admin/Data_barang/detail/'.$brg->id_brg, 
                                '<div class="btn btn-success btn-sm"><i class="fas fa-search-plus"></i></div>') ?>
                        </td>
                        <td align="center">
                            <?php echo anchor('admin/Data_barang/edit/' .$brg->id_brg, 
                                '<div class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></div>') ?>
                        </td>
                        <td align="center">
                            <?php echo anchor('admin/Data_barang/hapus/' .$brg->id_brg, 
                                '<div class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></div>') ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="tambah_barang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">FORM INPUT PRODUK</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url(). 'admin/Data_barang/tambah_aksi'; ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" name="nama_brg" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Keterangan</label>
                        <input type="text" name="keterangan" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Kategori</label>
                        <select class="form-control" name="kategori">
                            <option>Sepatu Pria</option>
                            <option>Sepatu Wanita</option>
                            <option>Sepatu Anak-anak</option>
                            <option>Sepatu Olahraga</option>
                            <option>Sepatu Casual</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Harga</label>
                        <input type="text" name="harga" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Stok</label>
                        <input type="text" name="stok" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Gambar Produk</label><br>
                        <input type="file" name="gambar" class="form-control">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
