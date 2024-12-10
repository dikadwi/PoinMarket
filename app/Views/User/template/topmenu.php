<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item">
            <a href="/Role_User" class="nav-link">
                <i class="nav-icon fa fa-home"> Dashboard</i>
            </a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fas fa-tags">Jenis Transaksi</i> <!-- Ganti ikon sesuai kebutuhan -->
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- Isi dropdown menu dengan link atau konten lain -->
                <a href="/Role_User/reward" class="dropdown-item">
                    <i class="fas fa-ribbon mr-2"></i>Rewards</a>
                <div class="dropdown-divider"></div>
                <a href="/Role_User/pembelian" class="dropdown-item">
                    <i class="fas fa-cart-plus mr-2"></i>Pembelian</a>
                <div class="dropdown-divider"></div>
                <a href="/Role_User/punishment" class="dropdown-item">
                    <i class="fas fa-clipboard mr-2"></i>Punishment</a>
                <div class="dropdown-divider"></div>
                <a href="/Role_User/misi_tambahan" class="dropdown-item">
                    <i class="fas fa-clipboard-list mr-2"></i>Misi Tambahan</a>
            </div>
        </li>
        <li class="nav-item">
            <a href="/Role_User/badges" class="nav-link">
                <i class="nav-icon fa fa-ribbon"> Badges</i>
            </a>
        </li>
        <li class="nav-item">
            <a href="#Challange" class="nav-link">
                <i class="nav-icon fa fa-trophy"> Challange</i>
            </a>
        </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fa fa-clock"> <?php echo date(' d F Y '); ?></i>
                <!-- date_default_timezone_set('Asia/Jakarta'); echo date(' d-M-Y / H:i:s a'); -->
            </a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header"><?= $username; ?></span>
                <div class="dropdown-divider"></div>
                <a href="/Role_User/profile" class="dropdown-item">
                    <i class="fas fa-user mr-2"></i> Profil
                </a>
                <div class="dropdown-divider"></div>
                <a href="/logoutM" class="dropdown-item">
                    <i class="fas fa-reply"></i> Logout
                </a>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>

    </ul>
</nav>

<!--Data Modal Box Tambah Data-->
<div class="modal fade" id="modalTambah">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah Transaksi </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/Admin/save_transaksi" method="post" enctype="multipart/form-data">
                    <div class="form-group ">
                        <label for="id" class="col-form-label"></label>
                        <div class="col-sm-10">
                            <input type="hidden" class="form-control" id="id" name="id" required>
                        </div>
                    </div>
                    <div class="form-group ">
                        <!-- Mengambil transaksi untuk menampilkan dropdown menu dari dB -->
                        <label for="kode_jenis" class="col-form-label">Jenis Transaksi</label>
                        <div class="col-sm-10">
                            <select name="kode_jenis" id="kode_jenis" class="form-control" required oninvalid="this.setCustomValidity('Pilih Salah Satu')" oninput="setCustomValidity('')">
                                <option value="">--Pilih Transaksi--</option>
                                <?php foreach ($jenis_transaksi as $j) : ?>
                                    <option value="<?= $j['kode_jenis'] ?>"><?= $j['nama_jenistransaksi'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="nama" class="col-form-label">Nama Transaksi</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')">
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="detail" class="col-form-label">Detail Transaksi</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="detail" name="detail" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')">
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="keterangan" class="col-form-label">Keterangan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="keterangan" name="keterangan" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')">
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="point" class="col-form-label">Point</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="point" name="point" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')">
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