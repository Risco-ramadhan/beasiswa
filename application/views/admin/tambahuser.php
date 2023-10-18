<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Masukan data yang diperlukan</h5><br>
                        <div class="mb-3">
                            <form class="user" method="post" action="<?= base_url('admin/registration') ?>">
                                <div class="form-group row">
                                    <div class="col">
                                        <input type="text" class="form-control" id="Name" placeholder="Name" name="Name" value="<?= set_value('Name') ?>">
                                        <?= form_error('Name', '<small class="text-danger pl-3">', '</small>') ?>
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <div class="col">
                                        <input type="text" class="form-control" id="NIM" placeholder="NIM" name="NIM" value="<?= set_value('NIM') ?>">
                                        <?= form_error('NIM', '<small class="text-danger pl-3">', '</small>') ?>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" id="Email" placeholder="Email Address" name="Email" value="<?= set_value('Email') ?>">
                                    <?= form_error('Email', '<small class="text-danger pl-3">', '</small>') ?>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control" id="password" placeholder="Password" name="Password1">
                                        <?= form_error('Password1', '<small class="text-danger pl-3">', '</small>') ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control" id="password" placeholder="Repeat Password" name="Password2">
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>