<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800 pl-1"><?php echo $title; ?></h1>

    <?php echo form_error('role', '<div class="alert alert-danger" role="alert">', '</div>'); ?>

    <?php echo $this->session->flashdata('message'); ?>

    <div class="row">
        <div class="col-lg mb-3 ml-1">
            <a href="" class="btn btn-primary" data-toggle="modal" data-target="#addNewRole">Add new Role</a>
        </div>
    </div>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Role</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($role as $r) : ?>
                            <tr>
                                <td width="30px"><?php echo $i; ?></td>
                                <td><?php echo $r['role']; ?></td>
                                <td width="250px">
                                    <a href="<?php echo base_url('administrator/roleaccess/') . $r['id']; ?>" class="btn btn-success btn-sm btn-edit font-weight-bold"><i class="fa fa-check"></i> Access</a>
                                    <a href="" class="btn btn-primary btn-sm btn-edit font-weight-bold" data-toggle="modal" data-target="#editRole<?php echo $r['id']; ?>"><i class="fa fa-edit"></i> Edit</a>
                                    <a href="<?php echo base_url('administrator/deleteRole/') . $r['id']; ?>" class="btn btn-danger btn-sm btn-edit font-weight-bold" onclick="return confirm('Delete ?');"><i class="fa fa-trash"></i> Delete</a>
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

<!-- Modal Add Role-->
<div class="modal fade" id="addNewRole" tabindex="-1" aria-labelledby="addNewRoleLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewRoleLabel">Add Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo base_url('administrator/role'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="role" name="role" placeholder="Role name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal End Add Role-->

<!-- Modal Edit Role -->
<?php $no = 0;
foreach ($role as $r) : $no++ ?>
    <div class="modal fade" id="editRole<?php echo $r['id']; ?>" tabindex="-1" aria-labelledby="editRoleLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editRoleLabel">Edit Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo base_url('administrator/editRole'); ?>" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id" value="<?php echo $r['id']; ?>">
                        <div class="form-group">
                            <input type="text" class="form-control" id="role" name="role" value="<?php echo $r['role']; ?>">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- End Modal Edit Role -->