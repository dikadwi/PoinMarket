<table class="table table-bordered table-striped">
    <thead class="bg-info">
        <tr>
            <th scope="col">Judul</th>
            <th scope="col">URL</th>
            <th scope="col">Icon</th>
            <th scope="col">Status</th>
            <th scope="col">Menu</th>
            <th scope="col" colspan="3">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($pages as $page): ?>
            <t>
                <td><?= esc($page['title']); ?></td>
                <td><a href="<?= esc($page['url']); ?>" target="_blank"><?= esc($page['url']); ?></a></td>
                <td> <i class="fas <?= esc($page['icon']); ?>"></i></td>
                <td><?= esc($page['status']); ?></td>
                <td><?= esc($page['menu_position']); ?></td>
                <td>
                    <button type=" button" class="btn btn-info" data-toggle="modal" data-target="#modalDetail<?php echo $page['id']; ?>"><i class="fas fa-eye"></i><span class="d-none d-md-inline"> Detail</span></button>
                </td>
                <td>
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalEdit<?php echo $page['id']; ?>"><i class="fas fa-edit"></i><span class="d-none d-md-inline"> Edit</span></button>
                </td>
                <td>
                    <a href="/cms/delete/<?= $page['id']; ?>" class="btn btn-danger btn-hapus"><i class="fas fa-trash"></i><span class="d-none d-md-inline"> Hapus</span></a>
                </td>
                </tr>
            <?php endforeach; ?>
    </tbody>
</table>

<!-- Modal Detail -->
<?php foreach ($pages as $page): ?>
    <div class="modal fade" id="modalDetail<?php echo $page['id']; ?>">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Detail <?= $page['title']; ?> </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="max-height: 500px; overflow-y: auto;">
                    <div class="col-lg-13">
                        <div class="card mb-3">
                            <div class="row g-0">
                                <div class="col-md-12">
                                    <div class="card-body">
                                        <ul class="list-group list-group-flush">
                                            <h5 class="card-title"><b>Title :</b></h5>
                                            <li class="list-group-item">
                                                <h4><?= $page['title']; ?></h4>
                                            </li>
                                            <h5 class="card-title"><b>URL :</b></h5>
                                            <li class="list-group-item">
                                                <h4><a href="<?= $page['url']; ?>"><?= $page['url']; ?></a></h4>
                                            </li>
                                            <h5 class="card-title"><b>Icon :</b></h5>
                                            <li class="list-group-item">
                                                <i class="fas <?= esc($page['icon']); ?>"></i>
                                            </li>
                                            <h5 class="card-title"><b>Status :</b></h5>
                                            <li class="list-group-item">
                                                <h4><?= $page['status']; ?></h4>
                                            </li>
                                            <h5 class="card-title"><b>Menu Position :</b></h5>
                                            <li class="list-group-item">
                                                <h4><?= $page['menu_position']; ?></h4>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal Update/Edit -->
<?php foreach ($pages as $page): ?>
    <div class="modal fade" id="modalEdit<?php echo $page['id']; ?>">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit <?= $page['title']; ?> </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body" style="max-height: 450px; overflow-y: auto;">
                    <form action="/cms/update/<?= $page['id']; ?>" method="post">
                        <div class="form-group">
                            <label for="title">Judul:</label>
                            <input type="text" name="title" class="form-control" value="<?= esc($page['title']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="url">URL:</label>
                            <input type="text" name="url" class="form-control" value="<?= esc($page['url']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="icon">Pilih Ikon:</label>
                            <i id="icon-preview" class="fas <?= esc($page['icon']); ?>"></i>
                            <select name="icon" id="icon" class="form-control" required onchange="updateIconPreview(this.value)">
                                <option value="">-- Pilih Ikon --</option>
                                <option value="fa-home" <?= ($page['icon'] == 'fa-home') ? 'selected' : ''; ?>>Home</option>
                                <option value="fa-info" <?= ($page['icon'] == 'fa-info') ? 'selected' : ''; ?>>Info</option>
                                <option value="fa-edit" <?= ($page['icon'] == 'fa-edit') ? 'selected' : ''; ?>>Edit</option>
                                <option value="fa-money-check-alt" <?= ($page['icon'] == 'fa-money-check-alt') ? 'selected' : ''; ?>>Money</option>
                                <option value="fa-envelope" <?= ($page['icon'] == 'fa-envelope') ? 'selected' : ''; ?>>Envelope</option>
                                <option value="fa-user" <?= ($page['icon'] == 'fa-user') ? 'selected' : ''; ?>>User</option>
                                <option value="fa-users" <?= ($page['icon'] == 'fa-users') ? 'selected' : ''; ?>>Users </option>
                                <option value="fa-user-cog" <?= ($page['icon'] == 'fa-user-cog') ? 'selected' : ''; ?>>User Cog</option>
                                <option value="fa-print" <?= ($page['icon'] == 'fa-print') ? 'selected' : ''; ?>>Print</option>
                                <option value="fa-gift" <?= ($page['icon'] == 'fa-gift') ? 'selected' : ''; ?>>Gift</option>
                                <option value="fa-shopping-cart" <?= ($page['icon'] == 'fa-shopping-cart') ? 'selected' : ''; ?>>Shopping Cart</option>
                                <option value="fa-flag" <?= ($page['icon'] == 'fa-flag') ? 'selected' : ''; ?>>Flag</option>
                                <option value="fa-rocket" <?= ($page['icon'] == 'fa-rocket') ? 'selected' : ''; ?>>Rocket</option>
                                <option value="fa-comments" <?= ($page['icon'] == 'fa-comments') ? 'selected' : ''; ?>>Comments</option>
                                <option value="fa-cog" <?= ($page['icon'] == 'fa-cog') ? 'selected' : ''; ?>>Settings</option>
                                <option value="fa-star" <?= ($page['icon'] == 'fa-star') ? 'selected' : ''; ?>>Star</option>
                                <option value="fa-search" <?= ($page['icon'] == 'fa-search') ? 'selected' : ''; ?>>Search</option>
                                <option value="fa-bell" <?= ($page['icon'] == 'fa-bell') ? 'selected' : ''; ?>>Bell</option>
                                <option value="fa-calendar" <?= ($page['icon'] == 'fa-calender') ? 'selected' : ''; ?>>Calendar</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status">Status:</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="active" <?= ($page['status'] == 'active') ? 'selected' : ''; ?>>Active</option>
                                <option value="inactive" <?= ($page['status'] == 'inactive') ? 'selected' : ''; ?>>Inactive</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">Deskripsi:</label>
                            <textarea name="description" class="form-control" required><?= esc($page['description']); ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="menu_position">Menu Position:</label>
                            <select name="menu_position" id="menu_position" class="form-control">
                                <option value="none" <?= ($page['menu_position'] == 'none') ? 'selected' : ''; ?>>None</option>
                                <option value="topmenu" <?= ($page['menu_position'] == 'topmenu') ? 'selected' : ''; ?>>Top Menu</option>
                                <option value="sidemenu" <?= ($page['menu_position'] == 'sidemenu') ? 'selected' : ''; ?>>Side Menu</option>
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </div>
            </form>
        </div>
    </div>

    <script>
        function updateIconPreview(icon) {
            document.getElementById('icon-preview').className = 'fas ' + icon;
        }
    </script>

    <!-- <script>
        // Fungsi untuk mengupdate preview ikon
        function updateIconPreview(icon) {
            const iconPreview = document.getElementById('iconPreview');
            iconPreview.className = `fas ${icon}`;
        }

        // Set nilai awal preview ikon saat modal dibuka
        document.addEventListener('DOMContentLoaded', function() {
            const selectedIcon = "<?= esc($page['icon']); ?>";
            if (selectedIcon) {
                updateIconPreview(selectedIcon);
            }
        });
    </script> -->
<?php endforeach; ?>