<?= $this->extend('PoinMarket_Admin/Template/dashboard'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">

    <div class="content-header">
        <div class="row mb-2">
            <div class="col-sm-12 col-md-6">
                <center>
                    <h1 class="m-0 text-dark">Data <?= $title; ?> </h1>
                </center>
            </div><!-- /.col -->
            <div class="col-sm-12 col-md-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item active"><?= $title; ?></li>
                </ol>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row ">
                <!-- Search Belum Jalan -->
                <div class="col-12 col-md-6 mb-3">
                    <?php if (in_groups(['superadmin'])) : ?>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalTambahUser"><i class="fas fa-plus"></i> Input</button>
                    <?php endif ?>
                </div>
                <div class="col-12 col-md-3 mb-3">
                    <!-- Form Pencarian Role -->
                    <form method="GET">
                        <div class="input-group">
                            <select name="role" class="form-control">
                                <option value="">Semua Role</option>
                                <option value="admin" <?= (isset($_GET['role']) && $_GET['role'] === 'admin') ? 'selected' : ''; ?>>Admin</option>
                                <option value="validator" <?= (isset($_GET['role']) && $_GET['role'] === 'validator') ? 'selected' : ''; ?>>Validator</option>
                                <option value="user" <?= (isset($_GET['role']) && $_GET['role'] === 'user') ? 'selected' : ''; ?>>User </option>
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-success" type="submit">Filter Role</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-12 col-md-3 mb-3">
                    <!-- Form Pencarian Username/Email -->
                    <form method="GET">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Cari..." value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
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
                    <div class="table-responsive">
                        <?= $this->include('PoinMarket_Admin/Tabel/tabel_user'); ?>
                    </div>
                </div>
            </div>
    </section>
</div>

<!--Data Modal Box Tambah User-->
<div class="modal fade" id="modalTambahUser">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/User/save_Users" method="post" enctype="multipart/form-data">
                    <!-- <div class="form-group">
                        <label for="id" class="col-form-label">ID</label>
                        <input type="number" class="form-control" id="id" name="id" readonly>
                    </div> -->
                    <input type="hidden" name="id">
                    <div class="form-group ">
                        <label for="username" class="col-form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')">
                    </div>
                    <div class="form-group ">
                        <label for="email" class="col-form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')">
                    </div>
                    <div class="form-group ">
                        <label for="role" class="col-form-label">Role</label>
                        <select class="form-control" name="role_id" required>
                            <option value="">Pilih Role</option>
                            <?php foreach ($roles as $role): ?>
                                <option value="<?= $role->id ?>"><?= esc($role->name) ?></option>
                            <?php endforeach; ?>
                        </select>
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