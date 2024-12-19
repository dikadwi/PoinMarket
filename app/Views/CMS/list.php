<?= $this->extend('PoinMarket_Admin/Template/dashboard'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
    <div class="content">
        <h1>Daftar Halaman</h1>
        <a href="/cms/create" class="btn btn-primary">Buat Halaman Baru</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>URL</th>
                    <th>Status</th>
                    <th>Menu</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pages as $page): ?>
                    <tr>
                        <td><?= esc($page['title']); ?></td>
                        <td><a href="<?= esc($page['url']); ?>" target="_blank"><?= esc($page['url']); ?></a></td>
                        <td><?= esc($page['status']); ?></td>
                        <td><?= esc($page['menu_position']); ?></td>
                        <td>
                            <a href="/cms/view/<?= $page['id']; ?>" class="btn btn-info">Lihat</a>
                            <a href="/cms/edit/<?= $page['id']; ?>" class="btn btn-warning">Edit</a>
                            <a href="/cms/delete/<?= $page['id']; ?>" class="btn btn-danger btn-hapus">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection(); ?>