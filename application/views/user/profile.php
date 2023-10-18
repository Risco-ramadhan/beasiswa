<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
    <div class="card mb-3" style="max-width: 540px;">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img src="<?= base_url('assets/img/profile/') . $user['image'] ?>" width="180px">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?= $user['name'] ?></h5>
                    <p class="card-text"><?= $user['email'] ?></p>
                    <p class="card-text"><small class="text-muted">Member since <?= date('d F Y', $user['date_created']) ?></small></p>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"> <i class="fas fa-fw fa-edit"></i></button>
    </div>
</div>
<!-- /.container-fluid -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('auth/updateDataUser/') ?>" method="POST" id="kirimEdit">
                    <?= $this->session->flashdata('message'); ?>

                    <div class="mb-3">
                        <input type="text" value="" class="form-control" name="oldNIM" hidden>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Nama</label>
                        <input type="text" value="<?= $user['name'] ?>" class="form-control" name="name" id="name" placeholder="Masukan Nama ">
                        <?= form_error('Name', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Kode </label>
                        <input type="text" class="form-control form-control-user" id="NIM" placeholder="ID" name="NIM" value="<?= $user['NIM'] ?>">
                        <?= form_error('NIM', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Email </label>
                        <input type="email" class="form-control form-control-user" id="Email" placeholder="Email Address" name="Email" value="<?= $user['email'] ?>">
                        <!-- <input type="text" value="" class="form-control" name="Email" id="Email" placeholder="Masukan Email"> -->
                        <?= form_error('Email', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="kirimEdit">Kirim</button>

            </div>
        </div>
    </div>
</div>