 <!-- Main content -->
 <div class="content">
     <div class="container-fluid">
         <div class="row">
             <div class="col-lg">
                 <div class="card">
                     <div class="card-body">
                         <h5 class="card-title">Hasil Akhir</h5><br>
                         <?= $this->session->flashdata('message'); ?>

                         <div class="mb-3">
                             <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                 <thead>
                                     <tr>
                                         <th scope="col">No</th>
                                         <th scope="col">Kode</th>
                                         <th scope="col">Nama</th>
                                         <th scope="col">Tahun</th>
                                         <th scope="col">Keterangan</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     <?php $i = 1 ?>
                                     <?php foreach ($hasil as $row) {
                                        ?>
                                         <tr>
                                             <td><?= $i++ ?></td>
                                             <td><?= $row->NIM ?></td>
                                             <td><?= $row->name ?></td>
                                             <td><?= $row->tahun ?></td>
                                             <td class="text-success">Diterima</td>

                                         </tr>
                                     <?php
                                        } ?>

                                 </tbody>
                             </table>
                             </table>
                             <div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>