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
            <div class="row">
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