<?= $this->extend('PoinMarket_Admin/Template/dashboard'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">

    <div class="content-header">
        <?php if (in_groups('admin')) : ?>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalTambahBadges">Input</button>
        <?php endif ?>
        <h3>
            <center>Data Badges<center>
        </h3>

    </div>

    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-sm-12">
                    <?= $this->include('PoinMarket_Admin/Tabel/tabel_badges'); ?>
                </div>
            </div>

    </section>
</div>

<!--Data Modal Box Tambah Data-->
<div class="modal fade" id="modalTambahBadges">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah Badges</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/Badges/save_badges" method="post" enctype="multipart/form-data">
                    <div class="form-group ">
                        <label for="nama" class="col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')">
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="point" class="col-form-label">Point</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="point" name="point" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')">
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="detail" class="col-form-label">Detail</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="detail" name="detail" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')">
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="keterangan" class="col-form-label">Keterangan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="keterangan" name="keterangan" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')">
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="badges" class="col-form-label">Badges(Upload Gambar)</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" id="badges" name="badges" accept="image/png, image/jpg, image/jpeg" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Tambah</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
        </div>
        </form>
    </div>
</div>

<?= $this->endsection(); ?>