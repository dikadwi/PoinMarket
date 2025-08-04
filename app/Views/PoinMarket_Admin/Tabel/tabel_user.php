<?php
// Tentukan jumlah data per halaman
$limit = 10;

// Ambil halaman saat ini dari URL, jika tidak ada, set ke 1
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Hitung total data
$total_data = count($users);

// Hitung total halaman
$total_pages = ceil($total_data / $limit);

// Hitung offset untuk query
$offset = ($page - 1) * $limit;

// Ambil data untuk halaman saat ini
$users = array_slice($users, $offset, $limit);

// Hitung data yang ditampilkan
$start = $offset + 1; // Data pertama yang ditampilkan
$end = min($offset + $limit, $total_data); // Data terakhir yang ditampilkan
?>

<table class="table table-bordered table-striped">
    <thead class="bg-info">
        <tr>
            <th scope="col">No</th>
            <th scope="col">Username</th>
            <th scope="col">Email</th>
            <th scope="col">Role</th>
            <th scope="col">Waktu Dibuat</th>
            <th scope="col" colspan="3">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        <?php
        // Cari data pengguna berdasarkan kata kunci dan role
        if (isset($_GET['search']) || isset($_GET['role'])) {
            $search = strtolower($_GET['search'] ?? '');  // Mengonversi kata kunci pencarian menjadi huruf kecil
            $role = $_GET['role'] ?? ''; // Mengambil role yang dipilih

            $users = array_filter($users, function ($data) use ($search, $role) {
                $matchesSearch = strpos(strtolower($data->username), $search) !== false ||
                    strpos(strtolower($data->email), $search) !== false;
                $matchesRole = empty($role) || strtolower($data->name) === strtolower($role);

                return $matchesSearch && $matchesRole;
            });
            // Perbarui total data setelah pencarian
            $total_data = count($users); // Total data setelah filter

            // Hitung total halaman
            $total_pages = ceil($total_data / $limit); // Total halaman berdasarkan limit

            // Hitung offset untuk query
            $offset = ($page - 1) * $limit; // Offset untuk data yang diambil

            // Ambil data untuk halaman saat ini
            $users = array_slice($users, $offset, $limit); // Ambil data sesuai offset dan limit

            // Hitung data yang ditampilkan
            $start = $offset + 1; // Data pertama yang ditampilkan
            $end = min($offset + $limit, $total_data); // Data terakhir yang ditampilkan

            // Jika total data adalah 6, maka end akan menjadi 6
            if ($total_data < $limit) {
                $end = $total_data; // Set end ke total data jika kurang dari limit
            }
        }
        foreach ($users as $u) : ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><?= $u->username; ?></td>
                <td><?= $u->email; ?></td>
                <td>
                    <span class="badge badge-<?php
                                                if ($u->name === 'superadmin') {
                                                    echo 'success';
                                                } elseif ($u->name === 'admin') {
                                                    echo 'warning';
                                                } elseif ($u->name === 'dosen') {
                                                    echo 'danger';
                                                } else {
                                                    echo 'info';
                                                }
                                                ?>">
                        <?php echo $u->name; ?>
                    </span>
                </td>
                <td><?= date('d-m-Y', strtotime($u->created_at)); ?></td>
                <!-- <td><?= $u->created_at; ?></td> -->
                <td>
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalDetail<?php echo $u->userid; ?>"><i class="fas fa-eye"></i><span class="d-none d-md-inline"> Detail</span></button>
                </td>
                <?php if (in_groups('superadmin')) : ?>
                    <td>
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalEdit<?php echo $u->userid; ?>"><i class="fas fa-edit"></i><span class="d-none d-md-inline"> Edit</span></button>
                    </td>
                    <td>
                        <a href="/User/delete_User/<?= $u->userid; ?>" class="btn btn-danger btn-hapus"><i class="fas fa-trash"></i><span class="d-none d-md-inline"> Hapus</span></a>
                    </td>
                <?php endif ?>
            </tr>
        <?php endforeach; ?>
    </tbody>

</table>

<!-- Pagination -->
<nav class="d-flex justify-content-between align-items-center" aria-label="Page navigation">
    <!-- Menampilkan informasi jumlah data di kiri -->
    <div class="mb-3">
        Showing <?= $start; ?> to <?= $end; ?> of <?= $total_data; ?> entries
    </div>
    <!-- Menampilkan pagination di kanan -->
    <ul class="pagination mb-0">
        <!-- Tombol Previous -->
        <li class="page-item <?= ($page <= 1) ? 'disabled' : ''; ?>">
            <a class="page-link" href="?page=<?= $page - 1; ?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>

        <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
            <li class="page-item <?= ($i == $page) ? 'active' : ''; ?>">
                <a class="page-link" href="?page=<?= $i; ?>">
                    <?= $i; ?>
                </a>
            </li>
        <?php endfor; ?>

        <!-- Tombol Next -->
        <li class="page-item <?= ($page >= $total_pages) ? 'disabled' : ''; ?>">
            <a class="page-link" href="?page=<?= $page + 1; ?>" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>
</nav>

<!-- Modal Box Detail -->
<?php foreach ($users as $u) : ?>
    <div class="modal fade" id="modalDetail<?php echo $u->userid; ?>">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-list mr-2"></i>Detail User
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label><i class="fas fa-user mr-2"></i>Username</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                            </div>
                            <input type="text" class="form-control" value="<?= $u->username; ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label><i class="fas fa-envelope mr-2"></i>Email</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-at"></i></span>
                            </div>
                            <input type="text" class="form-control" value="<?= $u->email; ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label><i class="fas fa-user-cog mr-2"></i>Role</label>
                        <div class="alert <?= ($u->name === 'superadmin') ? 'alert-success' : 
                                        (($u->name === 'admin') ? 'alert-warning' : 
                                        (($u->name === 'dosen') ? 'alert-danger' : 'alert-info')); ?>" 
                            role="alert">
                            <i class="fas <?= ($u->name === 'superadmin') ? 'fa-user-shield' : 
                                        (($u->name === 'admin') ? 'fa-user-cog' : 
                                        (($u->name === 'dosen') ? 'fa-chalkboard-teacher' : 'fa-user')); ?>">
                            </i>
                            <?= ucfirst($u->name); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label><i class="fas fa-clock mr-2"></i>Waktu Dibuat</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control" value="<?= date('d F Y H:i', strtotime($u->created_at)); ?>" readonly>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times mr-2"></i> Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal Box Edit -->
<?php foreach ($users as $u) : ?>
    <div class="modal fade" id="modalEdit<?php echo $u->userid; ?>">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-edit mr-2"></i>Edit User
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/User/update_User" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="user_id" value="<?= $u->userid; ?>">
                        
                        <div class="form-group">
                            <label for="username<?= $u->userid; ?>">
                                <i class="fas fa-user mr-2"></i>Username
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                </div>
                                <input type="text" class="form-control" id="username<?= $u->userid; ?>" 
                                    name="username" value="<?= $u->username; ?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email<?= $u->userid; ?>">
                                <i class="fas fa-envelope mr-2"></i>Email
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-at"></i></span>
                                </div>
                                <input type="email" class="form-control" id="email<?= $u->userid; ?>" 
                                    name="email" value="<?= $u->email; ?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="role<?= $u->userid; ?>">
                                <i class="fas fa-user-cog mr-2"></i>Role
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                    <i class="fas <?= ($u->name === 'superadmin') ? 'fa-user-shield' : 
                                        (($u->name === 'admin') ? 'fa-user-cog' : 
                                        (($u->name === 'dosen') ? 'fa-chalkboard-teacher' : 'fa-user')); ?>"></i>
                                    </span>
                                </div>
                                <select class="form-control" id="role<?= $u->userid; ?>" name="role_id" required>
                                    <?php foreach ($roles as $role) : ?>
                                        <option value="<?= $role->id ?>" <?= ($role->name === $u->name) ? 'selected' : '' ?>>
                                            <?= ucfirst($role->name) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password<?= $u->userid; ?>">
                                <i class="fas fa-lock mr-2"></i>Password Baru (Opsional)
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                </div>
                                <input type="password" class="form-control" id="password<?= $u->userid; ?>" 
                                    name="password" minlength="8">
                            </div>
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle"></i> 
                                Kosongkan jika tidak ingin mengubah password. Minimal 8 karakter jika diisi.
                            </small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-2"></i> Simpan
                        </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <i class="fas fa-times mr-2"></i> Batal
                        </button>                       
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>
