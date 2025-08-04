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
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">
                    <i class="fas fa-user-plus mr-2"></i>Tambah User
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/User/save_Users" method="post" enctype="multipart/form-data">
            <div class="modal-body">
                    <input type="hidden" name="id">
                    <div class="form-group">
                        <label for="username">
                            <i class="fas fa-user mr-2"></i>Username
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                            </div>
                            <input type="text" class="form-control" id="username" name="username" 
                                placeholder="Username" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">
                            <i class="fas fa-envelope mr-2"></i>Email
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-at"></i></span>
                            </div>
                            <input type="email" class="form-control" id="email" name="email" 
                                placeholder="Email" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="role" class="col-form-label">
                            <i class="fas fa-user-cog mr-2"></i>Role
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user-cog"></i></span>
                            </div>
                            <select class="form-control" name="role_id" required>
                                <option value="">Pilih Role</option>
                                <?php foreach ($roles as $role): ?>
                                    <option value="<?= $role->id ?>"><?= esc($role->name) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">                    
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