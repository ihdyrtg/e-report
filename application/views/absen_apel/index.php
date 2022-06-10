<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?php echo $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <?php echo $this->session->flashdata('message'); ?>
        </div>
    </div>

    <a href="<?php echo base_url('absen_apel/absen/' . $user['id']); ?>" class="btn btn-success">Hadir</a>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->