<!-- Begin Page Content -->
<div class="container-fluid">
    <div id="content">


        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Edit Berita</h1>
            </div>

            <div class="row">

                <div class="col">

                    <!-- Basic Card Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Pemberitahuan</h6>
                        </div>
                        <div class="card-body">

                            <form action="<?= base_url('admin/inputBeritaDb') ?>" method="POST">
                                <div>
                                    <label for="content">Konten</label>
                                    <textarea class="form-control" id="editor" name="content" cols="30" rows="10" placeholder="Tuliskan isi pikiranmu..."><?= set_value('content') ?></textarea>
                                </div>

                                <div>
                                    <br>
                                    <button type="submit" name="draft" class="btn btn-success" value="false">Publish</button>
                                    <div class="invalid-feedback">
                                        <?= form_error('draft') ?>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
</div>
<!-- /.container-fluid -->