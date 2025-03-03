<?= $this->extend('PoinMarket_Admin/Template/dashboard'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">

    <div class="content-header">
        <div class="row mb-2">
            <div class="col-sm-12 col-md-6">
                <center>
                    <h1 class="m-0 text-dark">Item <?= $title; ?> </h1>
                </center>
            </div><!-- /.col -->
            <div class="col-sm-12 col-md-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item "><a href="/Jenis_Transaksi">Kategori Item</a></li>
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
                    <?php if ((in_groups('superadmin')) || (in_groups('dosen') && (in_array('101', $jenis) || in_array('102', $jenis) || in_array('105', $jenis) || in_array('106', $jenis))) || (in_groups('admin') && (in_array('103', $jenis)))) : ?>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalTambahJenisTransaksi"><i class="fas fa-plus"></i><span class="d-none d-md-inline"> Input</span></button>
                    <?php endif ?>
                </div>
                <!-- Search Belum Jalan -->
                <div class="col-12 col-md-6 mb-3">
                    <form action="" method="get">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Cari... "> <!--Buat Filter Sesuai $title -->
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
                <h5 class=" modal-title" id="staticBackdropLabel">Tambah <?= $title; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="max-height: 450px; overflow-y: auto;">
                <form action="/Jenis_Transaksi/save_Jenis" method="post" enctype="multipart/form-data">
                    <!-- Input Hidden untuk id_transaksi & Valid -->
                    <div class="form-group ">
                        <label for="id_transaksi" class="col-form-label"></label>
                        <input type="hidden" class="form-control" id="id_transaksi" name="id_transaksi" required>
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="valid" name="valid" value="wait">
                    </div>
                    <!-- Bagian Jenis Transaksi -->
                    <div class="form-group">
                        <label for="kode_jenis" class="col-form-label">Jenis Transaksi</label>
                        <select name="kode_jenis" id="kode_jenis" class="form-control" required>
                            <option value="101" <?php if ($title == 'Reward') echo 'selected'; ?>>Reward</option>
                            <option value="102" <?php if ($title == 'Pembelian') echo 'selected'; ?>>Pembelian</option>
                            <option value="103" <?php if ($title == 'Punishment') echo 'selected'; ?>>Punishment</option>
                            <option value="105" <?php if ($title == 'Misi Tambahan') echo 'selected'; ?>>Misi Tambahan</option>
                            <option value="106" <?php if ($title == 'Konsultasi') echo 'selected'; ?>>Konsultasi</option>
                        </select>
                    </div>
                    <!-- Bagian Nama Transaksi -->
                    <div class="form-group">
                        <label for="nama_transaksi" class="col-form-label">Nama Transaksi</label>
                        <input type="text" class="form-control" id="nama_transaksi" name="nama_transaksi" required>
                    </div>
                    <div class="form-group">
                        <label for="detail" class="col-form-label">Detail</label>
                        <input type="text" class="form-control" id="detail" name="detail" required>
                    </div>
                    <div class="form-group">
                        <label for="keterangan" class="col-form-label">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan" required>
                    </div>
                    <!-- Bagian Gambar -->
                    <div class="form-group">
                        <label for="gambar" class="col-form-label">Gambar</label>
                        <input type="file" class="form-control" id="gambar" name="gambar" required>
                    </div>
                    <div class="form-group ">
                        <label for="poin_digunakan" class="col-form-label">Point Harga</label>
                        <input type="number" class="form-control" id="poin_digunakan" name="poin_digunakan" required>
                    </div>
                    <!-- Bagian Creator -->
                    <div class="form-group">
                        <label for="creator" class="col-form-label"></label>
                        <input type="hidden" class="form-control" id="creator" name="creator" value="<?= session()->get('username'); ?>">
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