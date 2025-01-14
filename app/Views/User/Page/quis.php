<?= $this->extend('User/Template/dashboard'); ?>

<?= $this->section('content_user'); ?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Quis</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/Role_User">User</a></li>
                        <li class="breadcrumb-item active">Quis</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Pertanyaan :</h3>
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url('Role_User/kirimJawaban') ?>" method="post">
                                <?php
                                // Ambil gaya belajar dari session
                                $gayaBelajarMahasiswa = session('gaya_belajar');

                                // Filter quis berdasarkan gaya belajar
                                $quisFiltered = array_filter($quis, function ($quiz) use ($gayaBelajarMahasiswa) {
                                    return strpos($quiz['kategori'], $gayaBelajarMahasiswa) !== false;
                                });

                                // Periksa apakah quis sudah selesai dikerjakan
                                if (session('quis_selesai')) {
                                    // Sembunyikan quis
                                    $quisFiltered = [];
                                } else {
                                    $no = 1;
                                    foreach ($quisFiltered as $quiz) : ?>
                                        <div class="form-group">
                                            <label for="pertanyaan"><?= $no . '. ' . $quiz['pertanyaan'] ?></label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="jawaban[<?= $quiz['id'] ?>]" value="A">
                                                <label class="form-check-label" for="opsi_a"><strong>A.</strong> <?= $quiz['opsi_a'] ?></label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="jawaban[<?= $quiz['id'] ?>]" value="B">
                                                <label class="form-check-label" for="opsi_b"><strong>B.</strong> <?= $quiz['opsi_b'] ?></label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="jawaban[<?= $quiz['id'] ?>]" value="C">
                                                <label class="form-check-label" for="opsi_c"><strong>C.</strong> <?= $quiz['opsi_c'] ?></label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="jawaban[<?= $quiz['id'] ?>]" value="D">
                                                <label class="form-check-label" for="opsi_d"><strong>D.</strong> <?= $quiz['opsi_d'] ?></label>
                                            </div>
                                        </div>
                                        <?php $no++; ?>
                                    <?php endforeach; ?>
                                    <button type="submit" class="btn btn-primary">Kirim Jawaban</button>
                                    <?php session()->set('quis_selesai', true); ?>
                                <?php } ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

<?= $this->endsection(); ?>