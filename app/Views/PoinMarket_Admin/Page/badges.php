<?= $this->extend('PoinMarket_Admin/Template/dashboard'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">

    <div class="content-header">
        <div class="row mb-2">
            <div class="col-sm-12 col-md-6">
                <center>
                    <h1 class="m-0 text-dark">Data <?= $title; ?> </h1>
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

    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-12 col-md-6 mb-3">
                    <?php if (in_groups(['superadmin', 'admin'])) : ?>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalTambahBadges"><i class="fas fa-plus"></i><span class="d-none d-md-inline"> Input</button>
                    <?php endif ?>
                </div>
                <!-- Search Belum Jalan -->
                <div class="col-12 col-md-6 mb-3">
                    <form action="" method="get">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Cari...">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <?= $this->include('PoinMarket_Admin/Card/badges'); ?>
                </div>
                <?php if (in_groups(['superadmin'])) : ?>
                    <div class="col-12">
                        <div class="table-responsive">
                            <?= $this->include('PoinMarket_Admin/Tabel/tabel_badges'); ?>
                        </div>
                    </div>
                <?php endif ?>
            </div>

    </section>
</div>

<!--Data Modal Box Tambah Data-->
<div class="modal fade" id="modalTambahBadges">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah Badges</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="max-height: 450px; overflow-y: auto;">
                <form action="/Badges" method="post" enctype="multipart/form-data">
                    <div class="form-group ">
                        <label for="nama" class="col-form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')">
                    </div>
                    <div class="form-group ">
                        <label for="point" class="col-form-label">Point</label>
                        <input type="number" class="form-control" id="point" name="point" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')">
                    </div>
                    <div class="form-group ">
                        <label for="detail" class="col-form-label">Detail</label>
                        <input type="text" class="form-control" id="detail" name="detail" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')">
                    </div>
                    <div class="form-group ">
                        <label for="keterangan" class="col-form-label">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')"></textarea>
                    </div>
                    <div class="form-group ">
                        <label for="badges" class="col-form-label">Badges(Upload Gambar)</label>
                        <input type="file" class="form-control" id="badges" name="badges" accept="image/png, image/jpg, image/jpeg" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Tambah</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
        </div>
        </form>
    </div>
</div>

<?= $this->endsection(); ?>