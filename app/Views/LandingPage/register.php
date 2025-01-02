<?= $this->extend('LandingPage/Template/dashboard'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="register-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <h2>Registrasi</h2>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Buat Akun Baru</p>

                <?= view('Myth\Auth\Views\_message_block') ?>

                <form action="/Register/add" method="post" class="user">
                    <?= csrf_field() ?>

                    <div class="input-group mb-3">
                        <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" placeholder="Email" value="<?= old('email') ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" name="nama" placeholder="Nama" value="<?= old('username') ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" name="npm" placeholder="NPM" value="<?= old('npm') ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" name="password" placeholder="Password" autocomplete="off">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" name="pass_confirm" placeholder="Repeat Password" autocomplete="off">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <!-- /.col -->
                        <div class="mb-2 col-12">
                            <button type="submit" class="btn btn-warning btn-block">
                                Register
                            </button>
                        </div>
                        <!-- <div class="col-5 ">
                            <a href="/login" class="btn btn-warning btn-block">Sign In</a>
                             <button type="submit" class="btn btn-danger btn-block">Register</button>
                    </div> -->
                        <!-- /.col -->
                    </div>
                    <p><?= lang('Auth.alreadyRegistered') ?> <a href="/loginMhs"><?= lang('Auth.signIn') ?></a></p>
                </form>

            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
</div>

<?= $this->endsection(); ?>