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
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">
                    <i class="fas fa-plus-circle mr-2"></i>Tambah Item <?= $title; ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <!-- <button type="button" class="btn btn-info" data-toggle="modal" data-target="#guidelinesModal">
                    ?
                </button> -->
            </div>
            <div class="modal-body" style="max-height: 450px; overflow-y: auto;">          
                    <!-- Form Input -->
                    <form action="/Jenis_Transaksi/save_Jenis" method="post" enctype="multipart/form-data">
                    <div class="form-input mr-2" style="flex: 2;">                    
                        <!-- Input Hidden untuk id_transaksi & Valid -->
                        <div class="form-group ">
                            <input type="hidden" class="form-control" id="id_transaksi" name="id_transaksi" required>
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="valid" name="valid" value="wait">
                        </div>
                        <!-- Bagian Jenis Transaksi -->
                        <div class="form-group">
                            <!-- <label for="kode_jenis" class="col-form-label">Kategori Transaksi</label> -->
                            <select name="kode_jenis" id="kode_jenis" class="form-control" required style="display: none;">
                                <option value="101" <?php if ($title == 'Reward') echo 'selected'; ?>>Reward</option>
                                <option value="102" <?php if ($title == 'Pembelian') echo 'selected'; ?>>Pembelian</option>
                                <option value="103" <?php if ($title == 'Punishment') echo 'selected'; ?>>Punishment</option>
                                <option value="105" <?php if ($title == 'Misi Tambahan') echo 'selected'; ?>>Misi Tambahan</option>
                                <option value="106" <?php if ($title == 'Konsultasi') echo 'selected'; ?>>Konsultasi</option>
                            </select>
                        </div>
                        <!-- Bagian Nama Item Transaksi -->
                        <div class="form-group">
                            <label for="nama_transaksi">
                                <i class="fas fa-hashtag mr-2"></i>Nama Item
                                <small class="form-text text-muted">
                                    <i class="fas fa-info-circle"></i> 
                                    Merupakan Nama Item / Produk .
                                </small>
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                </div>
                                <input type="text" class="form-control" id="nama_transaksi" name="nama_transaksi" 
                                    placeholder="Nama item" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')">
                            </div>
                            <small class="form-text text-muted">
                                <i class="fas fa-lightbulb mr-1"></i> 
                                Isi dengan nama yang jelas dan menggambarkan fungsi item sesuai Kategori.
                            </small>
                        </div>
                        <!-- Bagian Rule Item Transaksi -->
                        <div class="form-group">
                            <label for="detail">
                                <i class="fas fa-layer-group mr-2"></i>Rule Item
                                <small class="form-text text-muted">
                                    <i class="fas fa-info-circle"></i> 
                                    Rule Item merupakan aturan untuk Item / Produk Terkait.
                                </small>      
                            </label>  
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-sticky-note"></i></span>
                                </div>
                                <textarea type="text" class="form-control" id="detail" name="detail" 
                                    placeholder="Rule Item" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')"></textarea>
                            </div>
                            <small class="form-text text-muted">
                                <i class="fas fa-lightbulb mr-1"></i> 
                                Isi dengan informasi penjelasan aturan atau ketentuan Item / Produk.
                            </small>
                        </div>
                        <!-- Bagian Feedback ItemTransaksi -->
                        <div class="form-group">
                            <label for="keterangan">
                                <i class="fas fa-layer-group mr-2"></i>Feedback
                                <small class="form-text text-muted">
                                    <i class="fas fa-info-circle"></i> 
                                    Feedback merupakan umpan balik yang diperoleh sesuai dengan Item / Produk Terkait.
                                </small>  
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-sticky-note"></i></span>
                                </div>
                                <textarea type="text" class="form-control" id="keterangan" name="keterangan" 
                                    placeholder="Feedback" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')"></textarea>
                            </div>
                            <small class="form-text text-muted">                               
                                <i class="fas fa-lightbulb mr-1"></i> 
                                Isi dengan informasi umpan balik untuk memotivasi pengguna.
                            </small>
                        </div>
                        <!-- Bagian Gambar Item Transaksi -->
                        <div class="form-group">
                            <label for="gambar">
                                <i class="fas fa-image mr-2"></i>Gambar
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-file-image"></i></span>
                                </div>
                                <input type="file" class="form-control" id="gambar" name="gambar" 
                                    accept="image/png, image/jpg, image/jpeg" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')">
                            </div>
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle"></i> 
                                Sesuaikan gambar dengan Item / Produk Terkait.
                            </small>
                        </div>
                        <!-- Bagian Point Item Transaksi -->
                        <!-- Untuk Add Point -->
                        <?php if ($title === 'Rewards' || $title === 'Misi Tambahan'): ?>
                        <div class="form-group">
                            <label for="poin_diberikan">
                                <i class="fas fa-coins mr-2"></i>Point Reward
                                <small class="form-text text-muted">
                                    <i class="fas fa-info-circle"></i> 
                                    Point Reward merupakan Point yang diberikan berdasarkan Item / Produk Terkait.
                                </small>  
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-gift"></i></span>
                                </div>
                                <input type="number" class="form-control" id="poin_diberikan" name="poin_diberikan" 
                                    placeholder="Point Reward" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')">
                            </div>
                            <small class="form-text text-muted">
                                <i class="fas fa-lightbulb"></i> 
                                Untuk Kategori Add Point : Point yang akan diterima berdasarkan Item / Produk Terkait. (Reward & Misi)
                            </small>
                        </div>
                        <?php endif; ?>
                        <!-- Untuk Deduct Point -->
                        <?php if ($title === 'Pembelian' || $title === 'Punishment' || $title === 'Konsultasi'): ?>
                        <div class="form-group">
                            <label for="poin_digunakan">
                                <i class="fas fa-coins mr-2"></i>Point Harga
                                <small class="form-text text-muted">
                                    <i class="fas fa-info-circle"></i> 
                                    Point Harga merupakan Point yang digunakan untuk Item / Produk Terkait.
                                </small>  
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-wallet"></i></span>
                                </div>
                                <input type="number" class="form-control" id="poin_digunakan" name="poin_digunakan" 
                                    placeholder="Point Harga" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')">
                            </div>
                            <small class="form-text text-muted">
                                <i class="fas fa-lightbulb"></i> 
                                Untuk Kategori Deduct Point : Point yang akan dikurangi berdasarkan Item / Produk Terkait. (Pembelian, Punishment & Konsultasi)
                            </small>
                        </div>
                        <?php endif; ?>

                        <!-- Bagian Creator -->
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="creator" name="creator" value="<?= session()->get('username'); ?>">
                        </div>                       
                    </div>
                </div>
                <div class="modal-footer">
                    <small class="form-text text-muted">
                        <i class="fas fa-info-circle"></i> 
                        Pastikan Semua Field Diisi dengan Benar.
                    </small>
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