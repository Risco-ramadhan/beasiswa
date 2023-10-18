 <div class="container-fluid">

     <!-- Page Heading -->
     <h5 class="card-title">Hasil Akhir</h5><br>
     <?= $this->session->flashdata('message'); ?>
     <!-- DataTales Example -->
     <div class="card shadow mb-4">
         <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary">Data Penerima Beasiswa</h6>
         </div>
         <div class="card-body">
             <div class="table-responsive">
                 <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                     <thead>
                         <tr>
                             <th scope="col">No</th>
                             <th scope="col">Kode</th>
                             <th scope="col">Nama</th>
                             <th scope="col">Tahun</th>
                             <th scope="col">Nilai</th>
                             <th scope="col">Rank</th>
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
                                 <td><?= $row->nilai ?></td>

                                 <td><?= $i - 1 ?></td>
                             </tr>
                         <?php
                            } ?>

                     </tbody>
                 </table>
                 <a href="<?= base_url('admin/exportExcel') ?>">
                     <button class="btn btn-success">Export excel</button>
                 </a>
                 <a href="<?= base_url('admin/exportDataBeasiswa') ?>">
                     <button class="btn btn-success">Export pdf</button>
                 </a>
             </div>
         </div>
     </div>

 </div>