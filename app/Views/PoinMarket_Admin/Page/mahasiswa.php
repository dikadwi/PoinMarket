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
                    <?php if (in_groups(['superadmin', 'dosen'])) : ?>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalInput"><i class="fas fa-plus"></i><span class="d-none d-md-inline"> Input</span></button>
                    <?php endif ?>
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <form action="" method="get">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Cari... ">
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
                    <div class="table-responsive">
                        <?= $this->include('PoinMarket_Admin/Tabel/tabel_mahasiswa'); ?>
                    </div>
                </div>
            </div>
    </section>

</div>

<!-- Modal Input Mahasiswa -->
<div class="modal fade" id="modalInput">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">
                    <i class="fas fa-user-plus mr-2"></i>Tambah Mahasiswa
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/Mahasiswa/save_Mhs" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="npm">
                            <i class="fas fa-hashtag mr-2"></i>NPM
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                            </div>
                            <input type="text" class="form-control" id="npm" name="npm" 
                                placeholder="NPM" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nama">
                            <i class="fas fa-user mr-2"></i>Nama Mahasiswa
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                            </div>
                            <input type="text" class="form-control" id="nama" name="nama" 
                                placeholder="Nama Lengkap" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="gaya_belajar">
                            <i class="fas fa-brain mr-2"></i>Gaya Belajar
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-brain"></i></span>
                            </div>
                            <select class="form-control" id="gaya_belajar" name="gaya_belajar" required>
                                <option value="">Gaya Belajar</option>
                                <option value="Visual">Visual</option>
                                <option value="Auditori">Auditori</option>
                                <option value="Kinestetik">Kinestetik</option>
                            </select>
                        </div>
                    </div>

                    <!-- <div class="form-group">
                        <label for="point">Point Awal</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-coins"></i></span>
                            </div>
                            <input type="number" class="form-control" id="point" name="point" 
                                value="0" min="0" required>
                        </div>
                    </div> -->
                </div>
                <div class="modal-footer">                    
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times"></i> Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>




<?= $this->endsection(); ?>