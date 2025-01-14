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
                        <li class="breadcrumb-item active">Semua <?= $title; ?></li>
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
                <h3>Semua Kategori</h3>
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
    </section>
</div>

<!--Data Modal Box Tambah Data-->
<div class="modal fade" id="modalDataTransaksi">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/Transaksi/save_Transaksi" method="post" enctype="multipart/form-data">
                    <div class="form-group ">
                        <label for="id_transaksi" class="col-form-label"></label>
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
                        <label for="kode_jenis" class="col-form-label">Jenis Transaksi</label>
                        <select name="kode_jenis" id="DD_jenis_transaksi" class="form-control" required oninvalid="this.setCustomValidity('Pilih Salah Satu')" oninput="setCustomValidity('')">
                            <option value="">Pilih Jenis Transaksi</option>
                            <!-- Populate jenis transaksi options -->
                            <?php foreach ($jenis_transaksi as $jenis) : ?>
                                <option value="<?= $jenis['kode_jenis'] ?>"><?= $jenis['nama_jenistransaksi'] ?> (<?= $jenis['kode_jenis'] ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- Bagian Nama Transaksi -->
                    <div class="form-group">
                        <label for="nama_transaksi" class="col-form-label">Nama Transaksi</label>
                        <select name="nama_transaksi" id="DD_nama_transaksi" class="form-control" required oninvalid="this.setCustomValidity('Pilih Salah Satu')" oninput="setCustomValidity('')">
                            <option value="">Pilih Transaksi</option>
                            <!-- Nama transaksi options will be populated dynamically based on the selection in jenis transaksi -->
                        </select>
                    </div>
                    <!-- Input untuk menampilkan Point yang dipilih -->
                    <div class="form-group ">
                        <label for="poin_digunakan" class="col-form-label">Point Digunakan</label>
                        <input type="text" class="form-control" id="poin_digunakan" name="poin_digunakan">
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

<!-- Script untuk mengatur opsi Nama Transaksi berdasarkan Jenis Transaksi yang dipilih -->
<script>
    var jenisTransaksiSelect = document.getElementById('DD_jenis_transaksi');
    var namaTransaksiSelect = document.getElementById('DD_nama_transaksi');
    var poinDigunakanInput = document.getElementById('poin_digunakan');

    // Mendengarkan perubahan pada dropdown Jenis Transaksi
    jenisTransaksiSelect.addEventListener('change', function() {
        var selectedJenisTransaksi = this.value;

        // Mengosongkan opsi Nama Transaksi terlebih dahulu
        namaTransaksiSelect.innerHTML = '<option value="">Pilih Transaksi</option>';
        poinDigunakanInput.value = '';

        // Memperoleh daftar Nama Transaksi yang sesuai dengan Jenis Transaksi yang dipilih
        var transaksiOptions = <?php echo json_encode($transaksi); ?>;

        for (var i = 0; i < transaksiOptions.length; i++) {
            if (transaksiOptions[i]['kode_jenis'] == selectedJenisTransaksi) {
                var option = document.createElement('option');
                option.value = transaksiOptions[i]['nama_transaksi'];
                option.text = transaksiOptions[i]['nama_transaksi'];
                namaTransaksiSelect.appendChild(option);
            }
        }
    });

    // Event saat terjadi perubahan pada select Nama Transaksi
    namaTransaksiSelect.addEventListener('change', function() {
        var selectedNamaTransaksi = this.value;
        var transaksiOptions = <?php echo json_encode($transaksi); ?>;

        // Memperoleh point yang dipilih sesuai dengan Nama Transaksi yang dipilih
        for (var i = 0; i < transaksiOptions.length; i++) {
            if (transaksiOptions[i]['nama_transaksi'] == selectedNamaTransaksi) {
                poinDigunakanInput.value = transaksiOptions[i]['poin_digunakan'];
                break; // Hentikan perulangan setelah menemukan nilai Point
            }
        }
    });
</script>



<?= $this->endsection(); ?>