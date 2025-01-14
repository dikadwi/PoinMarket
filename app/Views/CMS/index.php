<?= $this->extend('PoinMarket_Admin/Template/dashboard'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="row mb-2">
            <div class="col-sm-12 col-md-6">
                <center>
                    <h1 class="m-0 text-dark"> <?= $title; ?> </h1>
                </center>
            </div>
            <div class="col-sm-12 col-md-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item active"><?= $title; ?></li>
                </ol>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-12 col-md-6 mb-3"><!-- User yang dimaksud adalah staf bukan mahasiswa -->
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalTambahHalaman">Buat Halaman Baru</button>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <?= $this->include('CMS/tabel'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Data Modal Box Tambah Data-->
<div class="modal fade" id="modalTambahHalaman">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah Halaman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/cms/store" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="title">Judul:</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="url">URL:</label>
                        <input type="text" name="url" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="icon">Pilih Ikon:</label>
                        <i id="AddiconPreview" class="fas ml-2"></i>
                        <select name="icon" id="icon" class="form-control" required onchange="AddIconPreview(this.value)">
                            <option value="">-- Pilih Ikon --</option>
                            <option value="fa-home">Home</option>
                            <option value="fa-info">Info</option>
                            <option value="fa-edit">Edit</option>
                            <option value="fa-money-check-alt">Money</option>
                            <option value="fa-envelope">Envelope</option>
                            <option value="fa-user">User</option>
                            <option value="fa-users">Users </option>
                            <option value="fa-user-cog">User Cog</option>
                            <option value="fa-print">Print</option>
                            <option value="fa-gift">Gift</option>
                            <option value="fa-shopping-cart">Shopping Cart</option>
                            <option value="fa-flag">Flag</option>
                            <option value="fa-rocket">Rocket</option>
                            <option value="fa-comments">Comments</option>
                            <option value="fa-cog">Settings</option>
                            <option value="fa-star">Star</option>
                            <option value="fa-search">Search</option>
                            <option value="fa-bell">Bell</option>
                            <option value="fa-calendar">Calendar</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Deskripsi:</label>
                        <textarea name="description" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="menu_position">Menu Position:</label>
                        <select name="menu_position" id="menu_position" class="form-control">
                            <option value="none">None</option>
                            <option value="topmenu">Top Menu</option>
                            <option value="sidemenu">Side Menu</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
        </div>
        </form>
    </div>
</div>

<script>
    function AddIconPreview(icon) {
        document.getElementById("AddiconPreview").className = "fas " + icon;
    }
</script>
<?= $this->endSection(); ?>