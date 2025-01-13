<div class="container-fluid">
    <!-- Content Row -->
    <div class="row">
        <!-- Pendapatan (Bulanan) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow-lg h-100 py-4">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xl font-weight-bold text-primary text-uppercase mb-1">
                                Pendapatan (Bulanan)
                            </div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800">
                                Rp. <?php echo isset($pendapatan_bulanan) ? number_format($pendapatan_bulanan, 0, ',', '.') : '0'; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-3x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pendapatan (Tahunan) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow-lg h-100 py-4">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xl font-weight-bold text-success text-uppercase mb-1">
                                Pendapatan (Tahunan)
                            </div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800">
                                Rp. <?php echo isset($pendapatan_tahunan) ? number_format($pendapatan_tahunan, 0, ',', '.') : '0'; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-3x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- End of Content Row -->

    <!-- Another row for additional data or cards if needed -->
</div>
