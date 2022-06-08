<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800 pl-1"><?php echo $title; ?></h1>

    <?php echo $this->session->flashdata('message'); ?>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th width="10%"></th>
                            <th>Name</th>
                            <th>Email</th>
                            <th width="150px">Terdaftar Sejak</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($User as $u) : ?>
                            <tr>
                                <td width="30px"><?php echo $i; ?></td>
                                <td>
                                    <div class="row">
                                        <div class="col">
                                            <img src="<?php echo base_url('assets/img/profile/' . $u['image']) ?>" alt="Img Profil" height="100" width="100" class="img-thumbnail rounded-circle">
                                        </div>
                                    </div>
                                </td>
                                <td><?php echo $u['name']; ?></td>
                                <td><?php echo $u['email']; ?></td>
                                <td><?php echo date('d F Y', $u['date_created']); ?></td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->