    <table class="table table-bordered border-dark">
        <thead class="bg-info">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Waktu Dibuat</th>
                <th scope="col" colspan="2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($users as $u) : ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $u->username; ?></td>
                    <td><?= $u->email; ?></td>
                    <td>
                        <span class="badge badge-<?php
                                                    if ($u->name === 'admin') {
                                                        echo 'success';
                                                    } elseif ($u->name === 'user') {
                                                        echo 'warning';
                                                    } elseif ($u->name === 'validator') {
                                                        echo 'danger';
                                                    } else {
                                                        echo 'info';
                                                    }
                                                    ?>">
                            <?php echo $u->name; ?>
                        </span>
                    </td>
                    <td><?= $u->created_at; ?></td>
                    <td>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalDetail<?php echo $u->userid; ?>">Detail</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>

    </table>



    <?php foreach ($users as $u) : ?>
        <div class="modal fade" id="modalDetail<?php echo $u->userid; ?>">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Profil : <?= $u->username; ?> </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-lg-13">
                            <div class="card mb-3">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="/img/admin.jpg" class="img-fluid rounded-start" alt="<?= $u->username; ?>">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <ul class="list-group list-group-flush">
                                                <h5 class="card-title"><b>Nama :</b></h5>
                                                <li class="list-group-item">
                                                    <h4><?= $u->username; ?></h4>
                                                </li>
                                                <h5 class="card-title"><b>Email :</b></h5>
                                                <li class="list-group-item">
                                                    <h4><?= $u->email; ?></h4>
                                                </li>
                                                <li class="list-group-item">
                                                    <span class="badge badge-<?php
                                                                                if ($u->name === 'admin') {
                                                                                    echo 'success';
                                                                                } elseif ($u->name === 'user') {
                                                                                    echo 'warning';
                                                                                } else {
                                                                                    echo 'danger';
                                                                                }
                                                                                ?>">
                                                        <?php echo $u->name; ?>
                                                    </span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    <?php endforeach; ?>