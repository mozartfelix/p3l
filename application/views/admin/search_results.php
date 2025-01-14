<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Hasil Pencarian</h1>
    <?php if (!empty($results)) : ?>
        <div class="row">
            <?php foreach ($results as $barang) : ?>
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card">
                        <img class="card-img-top" src="<?php echo base_url('uploads/' . $barang->gambar); ?>" alt="<?php echo $barang->nama_brg; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $barang->nama_brg; ?></h5>
                            <p class="card-text"><?php echo $barang->keterangan; ?></p>
                            <a href="<?php echo base_url('Dashboard/detail/' . $barang->id_brg); ?>" class="btn btn-primary">Detail</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else : ?>
        <p class="text-center">Tidak ada hasil untuk kata kunci yang dimasukkan.</p>
    <?php endif; ?>
</div>
