<?= $this->extend('PoinMarket_Admin/Template/dashboard'); ?>

<?= $this->section('content'); ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<div class="content-wrapper">

    <div class="content-header">
        <h3>
            <center> <?= $title; ?> Data Transaksi<center>
        </h3>
    </div>

    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-sm-12">
                    <?= $this->include('PoinMarket_Admin/Tabel/tabel_validasi'); ?>
                </div>
            </div>
    </section>
</div>

<?= $this->endsection(); ?>