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