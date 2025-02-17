<?= $this->extend('PoinMarket_Admin/Template/dashboard'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">

    <div class="content-header">
        <div class="row mb-2">
            <div class="col-sm-12 col-md-6">
                <center>
                    <h1 class="m-0 text-dark">Item / Produk</h1>
                </center>
            </div><!-- /.col -->
            <div class="col-sm-12 col-md-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">Semua <?= $title; ?></li>
                </ol>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <?php if (in_groups(['superadmin', 'dosen'])) : ?>
                    <div class="col-12 col-md-6 mb-3">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalTambahJenisTransaksi"><i class="fas fa-plus"></i><span class="d-none d-md-inline"> Input</span></button>
                    </div>
                <?php endif; ?>
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
                    <?= $this->include('PoinMarket_Admin/Card/item'); ?>
                </div>
                <?php if (in_groups(['superadmin'])) : ?>
                    <h4>Tabel Item </h4>
                    <div class="col-12">
                        <div class="table-responsive">
                            <?= $this->include('PoinMarket_Admin/Tabel/tabel_jenis'); ?>
                        </div>
                    </div>
                <?php endif ?>
            </div>
    </section>
</div>

<!-- Modal Box Input Data berdasarkan Jenis-->
<div class="modal fade" id="modalTambahJenisTransaksi">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah <?= $title; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/Jenis_Transaksi/save_Jenis" method="post" enctype="multipart/form-data">
                    <div class="form-group ">
                        <label for="id_transaksi" class="col-form-label"></label>
                        <input type="hidden" class="form-control" id="id_transaksi" name="id_transaksi" required>
                    </div>
                    <!-- Bagian Jenis Transaksi -->
                    <div class="form-group">
                        <label for="kode_jenis" class="col-form-label">Jenis Transaksi</label>
                        <select name="kode_jenis" id="kode_jenis" class="form-control" required>
                            <option value="101" <?php if ($title == 'Reward') echo 'selected'; ?>>Reward</option>
                            <option value="102" <?php if ($title == 'Pembelian') echo 'selected'; ?>>Pembelian</option>
                            <!-- <option value="103" <php if ($title == 'Punishment') echo 'selected'; ?>>Punishment</option> -->
                            <option value="105" <?php if ($title == 'Misi Tambahan') echo 'selected'; ?>>Misi Tambahan</option>
                            <option value="106" <?php if ($title == 'Misi Tambahan') echo 'selected'; ?>>Konsultasi</option>
                        </select>
                    </div>

                    <!-- Bagian Nama Transaksi -->
                    <div class="form-group">
                        <label for="nama_transaksi" class="col-form-label">Nama Transaksi</label>
                        <input type="text" class="form-control" id="nama_transaksi" name="nama_transaksi">
                    </div>
                    <div class="form-group">
                        <label for="detail" class="col-form-label">Detail</label>
                        <input type="text" class="form-control" id="detail" name="detail">
                    </div>
                    <div class="form-group">
                        <label for="keterangan" class="col-form-label">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan">
                    </div>
                    <!-- Input untuk menampilkan Point yang dipilih -->
                    <div class="form-group ">
                        <label for="poin_digunakan" class="col-form-label">Point Harga</label>
                        <input type="number" class="form-control" id="poin_digunakan" name="poin_digunakan">
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