<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php
        // Ambil segmen URL untuk menentukan menu aktif
        $active_category = $this->uri->segment(2); // 'sepatu_pria', 'sepatu_wanita', dsb.
        ?>

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url('Welcome') ?>">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-store"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SEPATU RUDI</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?php echo $active_category == '' ? 'active' : ''; ?>">
                <a class="nav-link" href="<?php echo base_url('Welcome') ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Nav Item - Invoice Pembelian -->
            <li class="nav-item <?php echo $active_category == 'daftar_invoice' ? 'active' : ''; ?>">
                <a class="nav-link" href="<?php echo base_url('Dashboard/daftar_invoice') ?>">
                    <i class="fas fa-fw fa-file-invoice"></i>
                    <span>Invoice Pembelian</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Kategori
            </div>

            <!-- Nav Item - Sepatu Pria -->
            <li class="nav-item <?php echo $active_category == 'sepatu_pria' ? 'active' : ''; ?>">
                <a class="nav-link" href="<?php echo base_url('Kategori/sepatu_pria') ?>">
                    <i class="fas fa-fw"></i>
                    <span>Sepatu Pria</span>
                </a>
            </li>
            
            <!-- Nav Item - Sepatu Wanita -->
            <li class="nav-item <?php echo $active_category == 'sepatu_wanita' ? 'active' : ''; ?>">
                <a class="nav-link" href="<?php echo base_url('Kategori/sepatu_wanita') ?>">
                    <i class="fas fa-fw"></i>
                    <span>Sepatu Wanita</span>
                </a>
            </li>
            
            <!-- Nav Item - Sepatu Anak-anak -->
            <li class="nav-item <?php echo $active_category == 'sepatu_anak_anak' ? 'active' : ''; ?>">
                <a class="nav-link" href="<?php echo base_url('Kategori/sepatu_anak_anak') ?>">
                    <i class="fas fa-fw"></i>
                    <span>Sepatu Anak-anak</span>
                </a>
            </li>
            
            <!-- Nav Item - Sepatu Olahraga -->
            <li class="nav-item <?php echo $active_category == 'sepatu_olahraga' ? 'active' : ''; ?>">
                <a class="nav-link" href="<?php echo base_url('Kategori/sepatu_olahraga') ?>">
                    <i class="fas fa-fw"></i>
                    <span>Sepatu Olahraga</span>
                </a>
            </li>
            
            <!-- Nav Item - Sepatu Casual -->
            <li class="nav-item <?php echo $active_category == 'sepatu_casual' ? 'active' : ''; ?>">
                <a class="nav-link" href="<?php echo base_url('Kategori/sepatu_casual') ?>">
                    <i class="fas fa-fw"></i>
                    <span>Sepatu Casual</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Navbar Right -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Keranjang Belanja -->
                        <li>
                            <?php 
                            $keranjang = 'Keranjang Belanja: '.$this->cart->total_items(). ' items'; 
                            echo anchor('Dashboard/detail_keranjang', $keranjang);
                            ?>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <ul class="nav navbar-nav navbar-right">
                            <?php if($this->session->userdata('username')) { ?>
                                <li><div>Selamat Datang <?php echo $this->session->userdata('username') ?></div></li>
                                <li class="ml-3"><?php echo anchor('Auth/logout', 'Logout'); ?></li>
                            <?php } else { ?>
                                <li><?php echo anchor('Auth/login', 'Login'); ?></li>
                            <?php } ?>
                        </ul>
                    </ul>

                </nav>
                <!-- End of Topbar -->

