            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Masukan data yang diperlukan</h5><br>
                                    <div class="mb-3">
                                        <form action="<?= base_url('user/inputdata') ?>" method="post">
                                            <input type="hidden" name="NIM" value="<?= $user['NIM'] ?>">
                                            <?php foreach ($querykriteria as $row) {
                                            ?>
                                                <div class="mb-3">

                                                    <label for="exampleFormControlInput1" class="form-label"><?= $row->Nama_Kriteria ?></label>
                                                    <input type="text" class="form-control" name="<?= $row->Nama_Kriteria ?>" placeholder="Masukan data <?= $row->Nama_Kriteria ?> ">
                                                </div>
                                            <?php } ?>
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