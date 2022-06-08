<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800 pl-1"><?php echo $title; ?></h1>

    <?php if (validation_errors()) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo validation_errors(); ?>
        </div>
    <?php endif; ?>

    <?php echo $this->session->flashdata('message'); ?>

    <div class="row">
        <div class="col-lg mb-3 ml-1">
            <a href="" class="btn btn-primary" data-toggle="modal" data-target="#addPublisher">Tambah Penerbit</a>
        </div>
    </div>

    <!-- DataTales Publisher -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Penerbit</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Penerbit</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($publisher as $p) : ?>
                            <tr>
                                <td width="30px"><?php echo $i; ?></td>
                                <td><?php echo $p['name']; ?></td>
                                <td width="30px"><?php echo $p['is_active']; ?></td>
                                <td width="10px">
                                    <a href="" class="btn btn-primary btn-sm btn-edit font-weight-bold" data-toggle="modal" data-target="#editPublisher<?php echo $p['id']; ?>"><i class="fa fa-edit"></i> Edit</a>
                                </td>
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

<!-- Modal Add Publisher -->
<div class="modal fade" id="addPublisher" tabindex="-1" aria-labelledby="addPublisherLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPublisherLabel">Tambah Penerbit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo base_url('staff/publisher'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="publisher" name="publisher" placeholder="nama penerbit">
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" checked>
                            <label class="form-check-label" for="is_active">
                                Active?
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal End Add Publisher -->

<!-- Model Edit Publisher -->
<?php $no = 0;
foreach ($publisher as $p) : $no++ ?>
    <div class="modal fade" id="editPublisher<?php echo $p['id']; ?>" tabindex="-1" aria-labelledby="editPublisher<?php echo $p['id']; ?>Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPublisher<?php echo $p['id']; ?>Label">Perbaharui Penerbit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo base_url('staff/editPublisher'); ?>" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id" value="<?php echo $p['id']; ?>">
                        <div class="form-group">
                            <input type="text" class="form-control" id="publisher" name="publisher" value="<?php echo $p['name']; ?>">
                        </div>
                        <div class="form-group">
                            <div class="form-check pl-0">
                                <input class="form-check-input-" type="checkbox" value="1" id="is_active" name="is_active" checked>
                                <label class="form-check-label" for="is_active">
                                    Active?
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                        <button type="submit" class="btn btn-primary">Perbaharui</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- End Model Edit Publisher -->