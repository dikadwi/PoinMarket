<?= $this->extend('PoinMarket_Admin/Template/dashboard'); ?>

<?= $this->section('content'); ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<div class="content-wrapper">

    <div class="content-header">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalDataTransaksi">Input</button>
        <h3>
            <center>Data <?= $title; ?> <center>
        </h3>
    </div>

    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-sm-12">
                    <?= $this->include('PoinMarket_Admin/Tabel/tabel_misitambah'); ?>
                </div>
            </div>
    </section>
</div>

<!--Data Modal Box Tambah Data-->
<div class="modal fade" id="modalDataTransaksi">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah Data Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/Misi_tambah/save_Misi" method="post" enctype="multipart/form-data">
                    <div class="form-group ">
                        <label for="id_transaksi" class="col-form-label"></label>
                        <div class="col-sm-10">
                            <input type="hidden" class="form-control" id="id_transaksi" name="id_transaksi" required>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="npm" class="col-form-label">NPM</label>
                        <div class="col-sm-10">
                            <select name="npm" id="npm" class="form-control" required oninvalid="this.setCustomValidity('Pilih Salah Satu')" oninput="setCustomValidity('')">
                                <option value="">Pilih NPM</option>
                                <?php foreach ($npm as $n) : ?>
                                    <option value="<?= $n['npm'] ?>"><?= $n['npm'] ?> - <?= $n['nama'] ?></option>
                                <?php endforeach; ?>
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