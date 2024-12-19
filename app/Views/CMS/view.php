<?= $this->extend('PoinMarket_Admin/Template/dashboard'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
    <p class="content">
    <h1><?= esc($page['title']); ?></h1>
    <p><strong>URL:</strong> <a href="<?= esc($page['url']); ?>" target="_blank"><?= esc($page['url']); ?></a></p>
    <p><strong>Deskripsi:</strong> </p>
    <div>
        <?= nl2br(esc($page['description'])); ?>
    </div>
    <p><strong>Status : </strong><?= esc($page['status']); ?></a></p>
    <p><strong>Menu : </strong><?= esc($page['menu_position']); ?></a></p>
    <a href="/cms" class="btn btn-secondary">Kembali ke Daftar Halaman</a>
</div>
</div>
<?= $this->endSection(); ?>