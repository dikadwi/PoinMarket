<?= $this->extend('Marketplace/Template/dashboard'); ?>

<?= $this->section('content_toko'); ?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <center>
                        <h1 class="text-center">Marketplace</h1>
                    </center>
                </div>
                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/toko">Marketplace </a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-6 col-md-2">
                    <button type="button" class="btn btn-info mr-2 btn-lg" data-toggle="modal">
                        <i class="fas fa-eye"></i> <span class="d-none d-md-inline">Detail</span>
                    </button>
                </div>
                <div class="col-6 col-md-2">
                    <div class="small-box bg-success">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <span>Misi</span>
                                <i class="fas fa-bullseye fa-2x fa-bounce"></i> <!-- Ikon Mouse -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-2">
                    <div class="small-box bg-warning">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <span>Konsultasi</span>
                                <i class="fas fa-comments fa-2x fa-bounce"></i> <!-- Ikon Mouse -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <!-- Reward Transactions -->
                <!-- <= $this->include('Marketplace/Card/reward'); ?> -->
                <!-- Pembelian Transactions -->
                <?= $this->include('Marketplace/Card/belanja'); ?>
                <!-- Pembelian Transactions -->
                <?= $this->include('Marketplace/Card/misi'); ?>
                <!-- Konsultasi Transactions -->
                <?= $this->include('Marketplace/Card/konsultasi'); ?>
            </div>
        </div>
</div>
</section>
</div>

<?= $this->endsection(); ?>