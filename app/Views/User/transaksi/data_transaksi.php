<?= $this->extend('User/template/dashboard'); ?>

<?= $this->section('content_user'); ?>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<div class="content-wrapper">

    <div class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <center>
                    <h1 class="m-0 text-dark">Data <?= $title; ?> </h1>
                </center>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/Role_User">User</a></li>
                    <li class="breadcrumb-item active"><?= $title; ?></li>
                </ol>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- Search Belum Jalan -->
                <div class="col-md-8">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalDataTransaksi">Input</button>
                </div>
                <div class="col-md-4">
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
                <div class="col-sm-12">
                    <?= $this->include('User/transaksi/tabel_data'); ?>
                </div>
            </div>
    </section>
</div>



<!-- Ambil npm dan nama dari session -->
<?php $npm_login = session()->get('npm'); ?>
<?php $nama_user = session()->get('username'); ?>
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
                <form action="/Role_User/save_Transaksi" method="post" enctype="multipart/form-data">
                    <div class="form-group ">
                        <label for="id_transaksi" class="col-form-label"></label>
                        <div class="col-sm-10">
                            <input type="hidden" class="form-control" id="id_transaksi" name="id_transaksi" required>
                        </div>
                    </div>
                    <!-- <div class="form-group ">
                        <label for="npm" class="col-form-label">NPM</label>
                        <div class="col-sm-10">
                            <select name="npm" id="npm" class="form-control" required oninvalid="this.setCustomValidity('Pilih Salah Satu')" oninput="setCustomValidity('')">
                                <option value="">Pilih NPM</option>
                                <?php foreach ($npm as $n) : ?>
                                    <option value="<?= $n['npm'] ?>"><?= $n['npm'] ?> - <?= $n['nama'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div> -->
                    <div class="form-group ">
                        <label for="npm" class="col-form-label">NPM - Nama</label>
                        <div class="col-sm-10">
                            <select name="npm" id="npm" class="form-control" required oninvalid="this.setCustomValidity('Pilih Salah Satu')" oninput="setCustomValidity('')">
                                <option value="<?= $npm_login; ?>"><?= $npm_login; ?> - <?= $nama_user; // Ambil nama pengguna berdasarkan NPM 
                                                                                        ?></option>
                                <!-- Jika Anda ingin menampilkan opsi lain, Anda bisa menambahkannya di sini -->
                            </select>
                        </div>
                    </div>
                    <!-- Bagian Jenis Transaksi -->
                    <div class="form-group">
                        <label for="jenis_transaksi" class="col-form-label">Jenis Transaksi</label>
                        <div class="col-sm-10">
                            <select name="jenis_transaksi" id="jenis_transaksi" class="form-control" required oninvalid="this.setCustomValidity('Pilih Salah Satu')" oninput="setCustomValidity('')">
                                <option value="">Pilih Jenis Transaksi</option>
                                <!-- Populate jenis transaksi options -->
                                <?php foreach ($jenis_transaksi as $jenis) : ?>
                                    <option value="<?= $jenis['kode_jenis'] ?>"><?= $jenis['nama_jenistransaksi'] ?> (<?= $jenis['kode_jenis'] ?>)</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <!-- Bagian Nama Transaksi -->
                    <div class="form-group">
                        <label for="nama_transaksi" class="col-form-label">Nama Transaksi</label>
                        <div class="col-sm-10">
                            <select name="nama_transaksi" id="nama_transaksi" class="form-control" required oninvalid="this.setCustomValidity('Pilih Salah Satu')" oninput="setCustomValidity('')">
                                <option value="">Pilih Transaksi</option>
                                <!-- Nama transaksi options will be populated dynamically based on the selection in jenis transaksi -->
                            </select>
                        </div>
                    </div>
                    <!-- Input untuk menampilkan Point yang dipilih -->
                    <div class="form-group ">
                        <label for="poin_digunakan" class="col-form-label">Point Digunakan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="poin_digunakan" name="poin_digunakan">
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

<!-- Script untuk mengatur opsi Nama Transaksi berdasarkan Jenis Transaksi yang dipilih -->
<script>
    var jenisTransaksiSelect = document.getElementById('jenis_transaksi');
    var namaTransaksiSelect = document.getElementById('nama_transaksi');
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