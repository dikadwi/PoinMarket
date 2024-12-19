<?= $this->extend('PoinMarket_Admin/Template/dashboard'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
    <div class="content">
        <h1>Buat Halaman Baru</h1>
        <form action="/cms/store" method="post">
            <div class="form-group">
                <label for="title">Judul:</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="url">URL:</label>
                <input type="text" name="url" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Deskripsi:</label>
                <textarea name="description" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="menu_position">Menu Position:</label>
                <select name="menu_position" id="menu_position">
                    <option value="none">None</option>
                    <option value="topmenu">Top Menu</option>
                    <option value="sidemenu">Side Menu</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
        <a href="/cms" class="btn btn-secondary">Kembali ke Daftar Halaman</a>
    </div>
</div>
<?= $this->endSection(); ?>