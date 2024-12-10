<?= $this->extend('User/template/dashboard'); ?>

<?= $this->section('content_user'); ?>

<div class="content-wrapper">
    <div class="container">
        <h3> Profile </h3>

        <div class="row">
            <!-- <div class="col-lg-6 col-md-12 mb-3">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="/img/admin.jpg" class="img-fluid rounded-start">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <h5 class="card-title"><b>Nama :</b></h5>
                                    <li class="list-group-item">
                                        <h4><?= $username; ?></h4>
                                    </li>
                                    <h5 class="card-title"><b>NPM :</b></h5>
                                    <li class="list-group-item">
                                        <h4><?= $npm; ?></h4>
                                    </li>
                                    <h5 class="card-title"><b>Email :</b></h5>
                                    <li class="list-group-item">
                                        <h4><?= $email; ?></h4>
                                    </li>
                                    <h5 class="card-title"><b>Point :</b></h5>
                                    <li class="list-group-item">
                                        <h4><?= $point; ?></h4>
                                    </li>
                                    <h5 class="card-title"><b>Level : </b> </h5>
                                    <li class="list-group-item">
                                        <h4>
                                            <?php
                                            $selectedBadge = null;
                                            foreach ($badges as $badge) {
                                                if ($point >= $badge['point']) {
                                                    $selectedBadge = $badge;
                                                } else {
                                                    break; // Menghentikan iterasi jika poin mahasiswa tidak cukup untuk badge berikutnya
                                                }
                                            }

                                            if ($selectedBadge !== null) {
                                                echo $selectedBadge['nama'];
                                            } else {
                                                echo 'Tidak ada badge';
                                            }
                                            ?>
                                        </h4>
                                    </li>
                                    <h5 class="card-title"><b>Badges : </b></h5>
                                    <li class="list-group-item">
                                        <?php
                                        $selectedBadge = null;
                                        foreach ($badges as $badge) {
                                            if ($point >= $badge['point']) {
                                                $selectedBadge = $badge;
                                            } else {
                                                break; // Menghentikan iterasi jika poin mahasiswa tidak cukup untuk badge berikutnya
                                            }
                                        }

                                        if ($selectedBadge !== null) {
                                            echo '<img src="data:image/png;base64,' . base64_encode($selectedBadge['badges']) . '" width="85">';
                                        } else {
                                            echo 'Tidak ada badge';
                                        }
                                        ?>
                                    </li>
                                    <button type=" button" class="btn btn-info" data-toggle="modal" data-target="#modalEdit<?= $npm; ?>">Edit Profil</button>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="col-lg-6 col-md-12 mb-3">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="/img/admin.jpg" class="img-fluid rounded-start">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <h5 class="card-title"><b>Nama :</b></h5>
                                    <li class="list-group-item">
                                        <h4><?= $username; ?></h4>
                                    </li>
                                    <h5 class="card-title"><b>NPM :</b></h5>
                                    <li class="list-group-item">
                                        <h4><?= $npm; ?></h4>
                                    </li>
                                    <h5 class="card-title"><b>Email :</b></h5>
                                    <?php if (!empty($email)) : ?>
                                        <li class="list-group-item">
                                            <h4><?= $email; ?></h4>
                                        </li>
                                    <?php else : ?>
                                        <li class="list-group-item">
                                            <a href="javascript:void(0);" data-toggle="modal" data-target="#modalEmail" class="small-box-footer">Tambahkan Email</a>
                                            </h5>
                                        </li>
                                    <?php endif; ?>
                                    <!-- <h5 class="card-title"><b>Point :</b></h5>
                                    <li class="list-group-item">
                                        <h4><?= $point; ?></h4>
                                    </li>
                                    <h5 class="card-title"><b>Level : </b> </h5>
                                    <li class="list-group-item">
                                        <h4>
                                            <?php
                                            $selectedBadge = null;
                                            foreach ($badges as $badge) {
                                                if ($point >= $badge['point']) {
                                                    $selectedBadge = $badge;
                                                } else {
                                                    break; // Menghentikan iterasi jika poin mahasiswa tidak cukup untuk badge berikutnya
                                                }
                                            }

                                            if ($selectedBadge !== null) {
                                                echo $selectedBadge['nama'];
                                            } else {
                                                echo 'Tidak ada badge';
                                            }
                                            ?>
                                        </h4>
                                    </li>
                                    <h5 class="card-title"><b>Badges : </b></h5>
                                    <li class="list-group-item">
                                        <?php
                                        $selectedBadge = null;
                                        foreach ($badges as $badge) {
                                            if ($point >= $badge['point']) {
                                                $selectedBadge = $badge;
                                            } else {
                                                break; // Menghentikan iterasi jika poin mahasiswa tidak cukup untuk badge berikutnya
                                            }
                                        }

                                        if ($selectedBadge !== null) {
                                            echo '<img src="data:image/png;base64,' . base64_encode($selectedBadge['badges']) . '" width="85">';
                                        } else {
                                            echo 'Tidak ada badge';
                                        }
                                        ?>
                                    </li> -->
                                    <button type=" button" class="btn btn-info" data-toggle="modal" data-target="#modalEdit<?= $npm; ?>">Edit Profil</button>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal box Tambah Email -->
<div class="modal fade" id="modalEmail" tabindex="-1" role="dialog" aria-labelledby="addEmailModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEmailModalLabel">Tambahkan Email</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Add your form or content for adding email here -->
                <!-- Example: -->
                <form action="/Role_User/save_email" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $id; ?>">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Email</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!--Data Modal Box Edit Data-->
<div class="modal fade" id="modalEdit<?= $npm; ?>">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit <?= $title; ?> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/Role_User/Update_Profile" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $id; ?>">
                    <div class="form-group ">
                        <label for="nama" class="col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" value="<?= $username; ?>" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')">
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="npm" class="col-form-label">NPM</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="npm" name="npm" value="<?= $npm; ?>" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')">
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="email" class="col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="email" name="email" value="<?= $email; ?>" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')">
                        </div>
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



<?= $this->endsection(); ?>