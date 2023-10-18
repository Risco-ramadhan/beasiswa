<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Dashboard </h1>
    <?= $this->session->flashdata('message'); ?>
    <div class="row">

        <div class="col">

            <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Pemberitahuan</h6>
                </div>
                <div class="card-body">

                    <?= $berita ?>
                </div>
            </div>
        </div>

    </div>

</div>
<!-- /.container-fluid -->