 <!-- Main content -->
 <div class="content">
     <div class="container-fluid">
         <div class="row">
             <div class="col-lg">
                 <div class="card">
                     <div class="card-body">
                         <h5 class="card-title">Masukan data yang diperlukan</h5><br>
                         <div class="mb-3">
                             <form action="<?= base_url('admin/inputdata') ?>" method="post">

                                 <div class="mb-3">
                                     <label for="exampleFormControlInput1" class="form-label">Kriteria</label>
                                     <input type="text" class="form-control" name="kriteria" placeholder="Masukan Nama Kriteria ">
                                 </div>
                                 <div class="mb-3">
                                     <label for="exampleFormControlInput1" class="form-label">Nilai Bobot Antara Tiap Kriteria (1-100) </label>
                                     <input type="text" class="form-control" name="bobot" placeholder="Masukan Nilai Kriteria">
                                 </div>
                                 <div class="mb-3">
                                     <label for="exampleFormControlInput1" class="form-label">Nilai Kriteria</label>
                                     <select class="form-control" aria-label="Default select example" name="status" required>
                                         <option selected>Pilih</option>
                                         <option value="1">Lebih Besar Nilai Lebih Baik</option>
                                         <option value="2">Lebih kecil Nilai Lebih Baik</option>
                                     </select>
                                 </div>
                                 <div class="mb-3">
                                     <label for="exampleFormControlInput1" class="form-label">Nilai Minimal Kritria Sangat Baik</label>
                                     <input required type="text" class="form-control" name="nilaikriteria1" placeholder="Masukan Nilai Kriteria">
                                 </div>
                                 <div class="mb-3">
                                     <label for="exampleFormControlInput1" class="form-label">Nilai Minimal Kritria Baik</label>
                                     <input required type="text" class="form-control" name="nilaikriteria2" placeholder="Masukan Nilai Kriteria">
                                 </div>
                                 <div class="mb-3">
                                     <label for="exampleFormControlInput1" class="form-label">Nilai Minimal Kritria Cukup</label>
                                     <input required type="text" class="form-control" name="nilaikriteria3" placeholder="Masukan Nilai Kriteria">
                                 </div>
                                 <div class="mb-3">
                                     <label for="exampleFormControlInput1" class="form-label">Nilai Minimal Kritria Kurang</label>
                                     <input required type="text" class="form-control" name="nilaikriteria4" placeholder="Masukan Nilai Kriteria">
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