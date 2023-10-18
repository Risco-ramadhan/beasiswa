<!-- table -->
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Masukan Data Kriteria</h1>
    <?= $this->session->flashdata('message'); ?>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Kriteria</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Kriteria</th>
                            <th scope="col">Bobot Kriteria</th>
                            <th scope="col">Normalisasi Kriteria</th>
                            <th scope="col">Nilai Kriteria 1</th>
                            <th scope="col">Nilai Kriteria 2</th>
                            <th scope="col">Nilai Kriteria 3</th>
                            <th scope="col">Nilai Kriteria 4</th>
                            <th scope="col">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1 ?>
                        <?php
                        foreach ($dataKriteria as $x) {


                        ?>
                            <tr>
                                <th scope="row"><?= $no++ ?></th>
                                <td><?= $x->Nama_Kriteria ?></td>
                                <td><?= $x->Bobot_Kriteria ?></td>
                                <td><?= $x->Normalisasi_Kriteria ?></td>
                                <td><?= $x->Nilai_Kriteria_1 ?></td>
                                <td><?= $x->Nilai_Kriteria_2 ?></td>
                                <td><?= $x->Nilai_Kriteria_3 ?></td>
                                <td><?= $x->Nilai_Kriteria_4 ?></td>
                                <td>
                                    <a href=" <?= base_url('admin/editKriteria/' . $x->ID_Kriteria) ?>">
                                        <button type="button" class="btn btn-info">
                                            <i class="fas fa-fw fa-edit"></i>

                                        </button>
                                    </a>


                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal<?= $x->ID_Kriteria ?>" data-whatever="@mdo">
                                        <i class="far fa-trash-alt"></i></button>
                                </td>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
                <a href="<?= base_url('admin/input') ?>">
                    <button class="btn btn-success">
                        Tambah Kriteria
                    </button>
                </a>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
<!-- end Table -->


<!-- Start Modal -->
<?php
foreach ($dataKriteria as $row) {
?>
    <div class="modal fade" id="exampleModal<?= $row->ID_Kriteria ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">apakah anda yakin menghapus data tersebut ? </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a href=" <?= base_url('admin/delete/' . $row->ID_Kriteria) ?>">
                        <button type="button" class="btn btn-danger">Hapus</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<!-- End Modal -->
<!-- <script>
    $('#exampleModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text('New message to ' + recipient)
        modal.find('.modal-body input').val(recipient)
    })
</script> -->