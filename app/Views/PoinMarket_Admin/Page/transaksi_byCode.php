<?= $this->extend('PoinMarket_Admin/Template/dashboard'); ?>

<?= $this->section('content'); ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 col-md-6">
                    <center>
                        <h1 class="m-0 text-dark">Data <?= $title; ?> </h1>
                    </center>
                </div><!-- /.col -->
                <div class="col-sm-12 col-md-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="/Transaksi">Kategori Pesanan</a></li>
                        <li class="breadcrumb-item active"><?= $title; ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <!-- Baris untuk button dan filter -->
            <div class="row">
                <div class="col-12 col-md-6 mb-3">
                    <?php if (in_groups(['superadmin', 'dosen'])) : ?>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalDataTransaksi"><i class="fas fa-plus"></i><span class="d-none d-md-inline"> Input</span></button>
                    <?php endif ?>
                </div>
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
                    <?= $this->include('PoinMarket_Admin/Card/pesanan'); ?>
                </div>
                <?php if (in_groups(['superadmin'])) : ?>
                    <div class="col-12">
                        <div class="table-responsive">
                            <?= $this->include('PoinMarket_Admin/Tabel/tabel_transaksi'); ?>
                        </div>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </section>
</div>

<!--Data Modal Box Tambah Data-->
<div class="modal fade" id="modalDataTransaksi">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah <?= $title; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/Transaksi/save_Transaksi" method="post" enctype="multipart/form-data">
                    <div class="form-group ">
                        <!-- <label for="id_transaksi" class="col-form-label"></label> -->
                        <input type="hidden" class="form-control" id="id_transaksi" name="id_transaksi" required>
                    </div>
                    <div class="form-group ">
                        <label for="npm" class="col-form-label">NPM</label>
                        <select name="npm" id="npm" class="form-control" required oninvalid="this.setCustomValidity('Pilih Salah Satu')" oninput="setCustomValidity('')">
                            <option value="">Pilih NPM</option>
                            <?php foreach ($npm as $n) : ?>
                                <option value="<?= $n['npm'] ?>"><?= $n['npm'] ?> - <?= $n['nama'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- Bagian Jenis Transaksi -->
                    <div class="form-group">
                        <!-- <label for="kode_jenis" class="col-form-label">Jenis Transaksi</label> -->
                        <select name="kode_jenis" id="kode_jenis" class="form-control" required style="display: none;">
                            <option value="101" <?php if ($title == 'Reward') echo 'selected'; ?>>Reward</option>
                            <option value="102" <?php if ($title == 'Pembelian') echo 'selected'; ?>>Pembelian</option>
                            <option value="103" <?php if ($title == 'Punishment') echo 'selected'; ?>>Punishment</option>
                            <option value="105" <?php if ($title == 'Misi Tambahan') echo 'selected'; ?>>Misi Tambahan</option>
                            <option value="106" <?php if ($title == 'Konsultasi') echo 'selected'; ?>>Konsultasi</option>
                        </select>
                    </div>
                    <!-- Bagian Nama Transaksi -->
                    <div class="form-group">
                        <label for="nama_transaksi" class="col-form-label">Item</label>
                        <select name="nama_transaksi" id="DD_nama_transaksi" class="form-control" required oninvalid="this.setCustomValidity('Pilih Salah Satu')" oninput="setCustomValidity('')">
                            <option value="">Pilih Item</option>
                            <?php foreach ($transaksi as $nama) : ?>
                                <?php if ($nama['poin_digunakan'] !== null && $nama['poin_diberikan'] !== null) : ?>
                                    <option value="<?= $nama['nama_transaksi'] ?>" data-poin="<?= $nama['poin_digunakan'] ?>" data-poin-diberikan="<?= $nama['poin_diberikan'] ?>"><?= $nama['nama_transaksi'] ?></option>
                                <?php elseif ($nama['poin_digunakan'] !== null) : ?>
                                    <option value="<?= $nama['nama_transaksi'] ?>" data-poin="<?= $nama['poin_digunakan'] ?>"><?= $nama['nama_transaksi'] ?></option>
                                <?php elseif ($nama['poin_diberikan'] !== null) : ?>
                                    <option value="<?= $nama['nama_transaksi'] ?>" data-poin-diberikan="<?= $nama['poin_diberikan'] ?>"><?= $nama['nama_transaksi'] ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- Tambahkan kondisi jika punishment poin dikurangi, jika pembelian poin harga, jika reward poin diberikan -->
                    <!-- Input untuk menampilkan Point yang dipilih -->
                    <div class="form-group" id="poin-digunakan-group" style="display: none;">
                        <label for="poin_digunakan" class="col-form-label">Point Digunakan</label>
                        <input type="text" class="form-control" id="poin_digunakan" name="poin_digunakan" readonly>
                    </div>
                    <!-- Input untuk menampilkan Point yang diberikan -->
                    <div class="form-group" id="poin-diberikan-group" style="display: none;">
                        <label for="poin_diberikan" class="col-form-label">Point Diberikan</label>
                        <input type="text" class="form-control" id="poin_diberikan" name="poin_diberikan" readonly>
                    </div>
                    <!-- Inputkan Keterangan -->
                    <!-- <div class="form-group">
                        <label for="keterangan" class="col-form-label">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan" required>
                    </div>                 -->
                    <!-- Gambar/ ambil dari item(gambar), dan pindah ke data_transaksi(gambar), tanpa upload -->
                    <!-- <div class="form-group">
                        <label for="gambar" class="col-form-label">Gambar</label>
                        <input type="file" class="form-control" id="gambar" name="gambar" required>
                    </div> -->
                    <!-- Creator -->
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

<!-- Tambahkan jQuery dan Script untuk Menangani Perubahan -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#DD_nama_transaksi').change(function() {
            var selectedPoin = $(this).find(':selected').data('poin');
            var selectedPoinDiberikan = $(this).find(':selected').data('poin-diberikan');

            if (selectedPoin !== undefined) {
                $('#poin_digunakan').val(selectedPoin);
                $('#poin-digunakan-group').show();
            } else {
                $('#poin-digunakan-group').hide();
            }

            if (selectedPoinDiberikan !== null && selectedPoinDiberikan !== undefined) {
                $('#poin_diberikan').val(selectedPoinDiberikan);
                $('#poin-diberikan-group').show();
            } else {
                $('#poin-diberikan-group').hide();
            }
        });
    });
</script>

<?= $this->endsection(); ?>