 <!-- Main content -->
 <div class="content">
     <div class="container-fluid">
         <div class="row">
             <div class="col-lg">
                 <div class="card">
                     <div class="card-body">
                         <h5 class="card-title">Masukan data yang diperlukan</h5><br>
                         <div class="mb-3">
                             <table class="table table-striped">
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
                                                 <a href=" <?= base_url('admin/detailEditData/' . $x->ID_Kriteria) ?>">
                                                     <button type="button" class="btn btn-info">Ubah</button>
                                                 </a>
                                                 <br>
                                                 <a href=" <?= base_url('admin/delete/' . $x->ID_Kriteria) ?>">
                                                     <button type="button" class="btn btn-danger">Hapus</button>
                                                 </a>
                                             </td>
                                         </tr>
                                     <?php } ?>

                                 </tbody>
                             </table>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <!-- /.row -->
     </div><!-- /.container-fluid -->
 </div>