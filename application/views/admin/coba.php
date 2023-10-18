<!-- Main content -->

<!-- <div class="content">
     <div class="container-fluid">
         <div class="row">
             <div class="col-lg">
                 <div class="card">
                     <div class="card-body">
                         <h5 class="card-title">Hasil Akhir</h5><br>
                         <?= $this->session->flashdata('message'); ?>

                         <div class="mb-3">
                             <table class="table table-striped">
                                 <thead>
                                     <tr>
                                         <th scope="col">No</th>
                                         <th scope="col">NIM</th>
                                         <?php foreach ($datakriteria as $x) { ?>
                                             <th scope="col"><?= $x->Nama_Kriteria ?></th>
                                         <?php } ?>
                                         <th scope="col">Hasil AKhir</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     <?php $no = 1 ?>
                                     <?php foreach ($nilai as $z) { ?>
                                         <tr>
                                             <th scope="row"><?= $no++ ?></th>
                                             <td><?= $z['NIM']  ?></td>
                                             <?php foreach ($datakriteria as $x) {
                                                    $nama = $x->Nama_Kriteria
                                                ?>

                                                 <td><?= $z[$nama] ?></td>
                                             <?php } ?>
                                             <td><?= $z['NilaiAkhir'] ?></td>

                                         </tr>
                                     <?php } ?>
                                    </tbody>
                             </table>
                             <div>

                                 <a href="importexcel"><button class="btn btn-success" type="submit">Import Data</button></a>
                                 <a href="normalisasikriteria"><button class="btn btn-info">Hitung</button></a>
                                 <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Publish hasil AKhir</button>

                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div> -->
<!-- table -->
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Hasil Akhir</h1>
    <?= $this->session->flashdata('message'); ?>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Penilaian siswa Menggunakan Metode SMART</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Kode</th>
                            <?php foreach ($datakriteria as $x) { ?>
                                <th scope="col"><?= $x->Nama_Kriteria ?></th>
                            <?php } ?>
                            <th scope="col">Hasil AKhir</th>
                            <th scope="col">Rank</th>
                            <th scope="col">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1 ?>
                        <?php foreach ($nilai as $z) { ?>
                            <tr>
                                <td scope="row"><?= $no ?></td>
                                <td><?= $z['NIM']  ?></td>
                                <?php foreach ($datakriteria as $x) {
                                    $nama = $x->Nama_Kriteria
                                ?>

                                    <td><?= $z[$nama] ?></td>
                                <?php } ?>
                                <td><?= $z['NilaiAkhir'] ?></td>
                                <td><?= $no ?></td>
                                <td>


                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#edit<?= $z['NIM'] ?>" data-whatever="@mdo">
                                        <i class="fas fa-fw fa-edit"></i>
                                    </button>

                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#HapusModal<?= $z['NIM'] ?>" data-whatever="@mdo">
                                        <i class="far fa-trash-alt"></i>
                                    </button>


                                </td>
                            </tr>
                        <?php $no++;
                        } ?>
                    </tbody>
                </table>
                <div>

                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahModal" data-whatever="@mdo">Tambah Data</button>
                    <a href="importexcel"><button class="btn btn-success" type="submit">Import Data</button></a>
                    <a href="normalisasikriteria"><button class="btn btn-info">Hitung</button></a>
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Publish Hasil AKhir</button>

                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
<!-- end Table -->




<!-- Start Modal -->
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
                <form action="<?= base_url('admin/publishHasil') ?>" method="POST" id="formPublish">
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Jumlah Kuota Penerima Beasiswa </label>
                        <input class="form-control" id="message-text" name="jmlh">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="formPublish">Kirim</button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->
<script>
    $('#exampleModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text('New message to ' + recipient)
        modal.find('.modal-body input').val(recipient)
    })
</script>

<!-- <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('') ?>" method="POST" id="formPublish">
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Jumlah Kuota Penerima Beasiswa </label>
                        <input class="form-control" id="message-text" name="jmlh">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="formPublish">Kirim</button>
            </div>
        </div>
    </div>
</div> -->


<?php
foreach ($datauser as $row) {
?>
    <div class="modal fade" id="HapusModal<?= $row->NIM ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <a href=" <?= base_url('admin/deletDataNilai/' . $row->NIM) ?>">
                        <button type="button" class="btn btn-danger">Hapus</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<!-- EDIT DATA -->
<?php
foreach ($nilai as $row) {
?>
    <div class="modal fade" id="edit<?= $row['NIM'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('admin/editNilai/') ?>" method="POST" id="kirimEdit<?= $row['NIM']  ?>">
                        <input type="hidden" name="NIM" value="<?= $row['NIM']  ?>">
                        <?php foreach ($query as $abc) {
                        ?>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label"><?= $abc->Nama_Kriteria ?></label>
                                <input value="<?= $row[$abc->Nama_Kriteria]  ?>" type="text" class="form-control" name="<?= $abc->Nama_Kriteria ?>" placeholder="Masukan data <?= $abc->Nama_Kriteria ?>  ">
                            </div>
                        <?php } ?>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" form="kirimEdit<?= $row['NIM']  ?>">Kirim</button>

                </div>
            </div>
        </div>
    </div>
<?php } ?>

<!-- TAMBAH DATA -->


<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('admin/inputDataNilai/') ?>" method="POST" id="TambahData?>">
                    <div>
                        <label for="" class="form-label">Kode Beasiswa</label>
                        <input class="form-control" type="text" name="NIM" placeholder="Masukan Kode Beasiswa">
                    </div>

                    <div>
                        <label for="" class="form-label">Nama</label>
                        <input class="form-control" type="text" name="nama" placeholder="Masukan Nama">
                    </div>
                    <?php foreach ($query as $abc) {
                    ?>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label"><?= $abc->Nama_Kriteria ?></label>
                            <input type="text" class="form-control" name="<?= $abc->Nama_Kriteria ?>" placeholder="Masukan data <?= $abc->Nama_Kriteria ?>  ">
                        </div>
                    <?php } ?>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="TambahData?>">Kirim</button>

            </div>
        </div>
    </div>
</div>