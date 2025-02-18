<?= $this->extend('PoinMarket_Admin/Template/dashboard'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 col-md-6">
                    <center>
                        <h1 class="m-0 text-dark"><?= $title; ?> Management</h1>
                    </center>
                </div><!-- /.col -->
                <div class="col-sm-12 col-md-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item active"><?= $title; ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <?= $this->include('PoinMarket_Admin/Card/market'); ?>
                </div>
            </div>
        </div>
    </section>
</div>

<?= $this->endsection(); ?>