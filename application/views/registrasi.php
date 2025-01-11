<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg col-lg-6 my-5 mx-auto">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Form Register</h1>
                            </div>
                            <form method="post" action="<?php echo base_url('Registrasi/index') ?>" class="user">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Nama Lengkap Anda" name="nama">
                                    <?php echo form_error('nama', '<div class="text-danger small ml-3">', '</div>') ?>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Username" name="username">
                                    <?php echo form_error('username', '<div class="text-danger small ml-3">', '</div>') ?>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="Password" name="password_1">
                                        <?php echo form_error('password_1', '<div class="text-danger small ml-3">', '</div>') ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleRepeatPassword" placeholder="Ulangi Password" name="password_2">
                                        <?php echo form_error('password_2', '<div class="text-danger small ml-3">', '</div>') ?>
                                    </div>
                                </div>
                                
                                <button type="submit" class="btn btn-primary form-control rounded-pill">Register</button>

                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="<?php echo base_url('Auth/login') ?>">Sudah Punya Akun? Silahkan Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
