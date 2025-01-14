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

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-6 mb-3">
                    <?php if (in_groups(['admin', 'validator'])) : ?>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambahPertanyaanModal"> <i class="fas fa-plus"></i> Input </button>
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
                        <?= $this->include('PoinMarket_Admin/Tabel/tabel_quis'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

<!-- Modal Box untuk Tambah Pertanyaan -->
<div class="modal fade" id="tambahPertanyaanModal" tabindex="-1" role="dialog" aria-labelledby="tambahPertanyaanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahPertanyaanModalLabel">Tambah Pertanyaan Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form Tambah Pertanyaan -->
                <form action="<?= base_url('Quis/simpanQuis') ?>" method="post">
                    <div class="form-group">
                        <label for="pertanyaan">Pertanyaan</label>
                        <textarea class="form-control" id="pertanyaan" name="pertanyaan" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="opsi_a">Opsi A</label>
                        <input type="text" class="form-control" id="opsi_a" name="opsi_a" required>
                    </div>
                    <div class="form-group">
                        <label for="opsi_b">Opsi B</label>
                        <input type="text" class="form-control" id="opsi_b" name="opsi_b" required>
                    </div>
                    <div class="form-group">
                        <label for="opsi_c">Opsi C</label>
                        <input type="text" class="form-control" id="opsi_c" name="opsi_c" required>
                    </div>
                    <div class="form-group">
                        <label for="opsi_d">Opsi D</label>
                        <input type="text" class="form-control" id="opsi_d" name="opsi_d" required>
                    </div>
                    <div class="form-group">
                        <label for="jawaban_benar">Jawaban Benar</label>
                        <select class="form-control" id="jawaban_benar" name="jawaban_benar" required>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="poin">Poin</label>
                        <input type="number" class="form-control" id="poin" name="poin" required>
                    </div>
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="kategori[]" value="Kinestetik" id="kinestetik">
                            <label class="form-check-label" for="kinestetik">Kinestetik</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="kategori[]" value="Auditori" id="auditori">
                            <label class="form-check-label" for="auditori">Auditori</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="kategori[]" value="Visual" id="visual">
                            <label class="form-check-label" for="visual">Visual</label>
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <select class="form-control" id="kategori" name="kategori" required>
                            <option value="Kinestetik">Kinestetik</option>
                            <option value="Auditori">Auditori</option>
                            <option value="Visual">Visual</option>
                        </select>
                    </div> -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endsection(); ?>