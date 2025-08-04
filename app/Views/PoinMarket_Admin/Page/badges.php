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
        <div class="modal-header bg-success text-white">
                <h5 class="modal-title">
                    <i class="fas fa-plus-circle mr-2"></i>Tambah Badges
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="max-height: 450px; overflow-y: auto;">
                <form action="/Badges" method="post" enctype="multipart/form-data">
                
                    <div class="form-group">
                        <label for="detail">
                            <i class="fas fa-medal mr-2"></i>Nama Badges
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                            </div>
                            <input type="text" class="form-control" id="detail" name="detail" 
                                placeholder="Nama Badges" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nama">
                            <i class="fas fa-layer-group mr-2"></i>Level
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                            </div>
                            <input type="text" class="form-control" id="nama" name="nama" 
                                placeholder="Level" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="point">
                            <i class="fas fa-coins mr-2"></i>Point
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-wallet"></i></span>
                            </div>
                            <input type="text" class="form-control" id="point" name="point" 
                                placeholder="Point" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="keterangan">
                            <i class="fas fa-list mr-2"></i>Detail 
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-sticky-note"></i></span>
                            </div>
                            <textarea class="form-control" id="keterangan" name="keterangan" 
                                placeholder="Detail" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="badges">
                            <i class="fas fa-image mr-2"></i>Gambar 
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-file-image"></i></span>
                            </div>
                            <input type="file" class="form-control" id="badges" name="badges" accept="image/png, image/jpg, image/jpeg" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times"></i> Batal
                </button>
            </div>
        </div>
        </form>
    </div>
</div>

<?= $this->endsection(); ?>