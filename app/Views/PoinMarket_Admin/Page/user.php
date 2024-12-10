<?= $this->extend('PoinMarket_Admin/Template/dashboard'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">

    <div class="content-header">

        <h3>
            <center>Data Pengguna<center>
        </h3>

    </div>

    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-sm-12">
                    <?= $this->include('PoinMarket_Admin/Tabel/tabel_user'); ?>
                </div>
            </div>

    </section>
</div>



<?= $this->endsection(); ?>