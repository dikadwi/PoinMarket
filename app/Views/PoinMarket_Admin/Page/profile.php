<?= $this->extend('PoinMarket_Admin/Template/dashboard'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">
    <div class="container">
        <div class="content-header">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <center>
                        <h1 class="m-0 text-dark"><?= $title; ?> </h1>
                    </center>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active"><?= $title; ?></li>
                    </ol>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="col-lg-8">
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="/img/admin.jpg" class="img-fluid rounded-start" alt="<?= $user->username; ?>">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <h5 class="card-title"><b>Nama :</b></h5>
                                        <li class="list-group-item">
                                            <h4><?= $user->username; ?></h4>
                                        </li>
                                        <h5 class="card-title"><b>Email :</b></h5>
                                        <li class="list-group-item">
                                            <h4><?= $user->email; ?></h4>
                                        </li>
                                        <h5 class="card-title"><b>Alamat IP :</b></h5>
                                        <li class="list-group-item">
                                            <!-- <h4><?= session('user_ip'); ?></h4> <!- Menampilkan alamat IP dari sesi -->
                                            <h4><?= $_SERVER['REMOTE_ADDR']; ?></h4>
                                        </li>
                                        <li class="list-group-item">
                                            <span class="badge badge-<?= ($user->name == 'admin') ? 'success' : 'warning'; ?>"><?= $user->name; ?></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
</div>





<?= $this->endsection(); ?>