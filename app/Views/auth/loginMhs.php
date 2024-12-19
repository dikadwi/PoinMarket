<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Log in </title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url() ?>/template/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url() ?>/template/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>/template/dist/css/adminlte.min.css">
    <style>
        .body {
            background-color: aquamarine;
        }

        .alert {
            text-align: center;
        }
    </style>
</head>

<body class="hold-transition login-page body">

    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="../../index2.html" class="h1"><b>Login</b></a>
            </div>

            <div class="card-body">

                <?= view('Myth\Auth\Views\_message_block') ?>

                <?php if (session()->getFlashdata('pesan')) : ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('pesan') ?>
                    </div>
                <?php endif; ?>

                <form action="/Login/process" method="post">
                    <?= csrf_field() ?>

                    <div class="input-group mb-3">
                        <input type="text" class="form-control " name="npm_or_username" placeholder="NPM atau Username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control " placeholder=" Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-2 col-12 ">
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </div>
                        <!-- <div class="col-5 ">
                            <a href="/register" class="btn btn-warning btn-block">Register</a>
                          <button type="submit" class="btn btn-danger btn-block">Register</button>
                        </div> -->
                        <!-- /.col -->
                    </div>

                    <p><a href="/registerMhs">Buat Akun Baru</a></p>

                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?= base_url() ?>/template/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url() ?>/template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url() ?>/template/dist/js/adminlte.min.js"></script>
</body>

</html>