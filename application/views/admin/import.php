<div class="col-3">
    <label for="excel">Masukan Data excel</label>
    <div class="custom-file">
        <form action="<?= base_url('admin/import_excel') ?>" method="post" enctype="multipart/form-data">
            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
            <input type="file" name="fileExcel" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">

            <button class="btn btn-success" type="submit">Upload</button>
        </form>
    </div>
</div>