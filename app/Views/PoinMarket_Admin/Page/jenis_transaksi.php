<?= $this->extend('PoinMarket_Admin/Template/dashboard'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">

    <div class="content-header">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalTambahJenisTransaksi">Input</button>
        <h3>
            <center>Data <?= $title; ?> <center>
        </h3>
    </div>

    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-sm-12">
                    <?= $this->include('PoinMarket_Admin/tabel/tabel_jenis'); ?>
                </div>
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
                        <div class="col-sm-10">
                            <input type="hidden" class="form-control" id="id_transaksi" name="id_transaksi" required>
                        </div>
                    </div>

                    <!-- Bagian Jenis Transaksi -->
                    <div class="form-group">
                        <label for="kode_jenis" class="col-form-label">Jenis Transaksi</label>
                        <div class="col-sm-10">
                            <select name="kode_jenis" id="kode_jenis" class="form-control" required>
                                <option value="101" <?php if ($title == 'Reward') echo 'selected'; ?>>Reward</option>
                                <option value="102" <?php if ($title == 'Pembelian') echo 'selected'; ?>>Pembelian</option>
                                <option value="103" <?php if ($title == 'Punishment') echo 'selected'; ?>>Punishment</option>
                                <option value="105" <?php if ($title == 'Misi Tambahan') echo 'selected'; ?>>Misi Tambahan</option>
                            </select>
                        </div>
                    </div>

                    <!-- Bagian Nama Transaksi -->
                    <div class="form-group">
                        <label for="nama_transaksi" class="col-form-label">Nama Transaksi</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama_transaksi" name="nama_transaksi">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="detail" class="col-form-label">Detail</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="detail" name="detail">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="keterangan" class="col-form-label">Keterangan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="keterangan" name="keterangan">
                        </div>
                    </div>

                    <!-- Input untuk menampilkan Point yang dipilih -->
                    <div class="form-group ">
                        <label for="poin_digunakan" class="col-form-label">Point Harga</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="poin_digunakan" name="poin_digunakan">
                        </div>
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