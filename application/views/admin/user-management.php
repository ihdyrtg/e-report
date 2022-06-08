<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800 pl-1"><?php echo $title; ?></h1>

    <?php echo $this->session->flashdata('message'); ?>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar User</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th></th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>User Role</th>
                            <th>Active</th>
                            <th>Date Created</th>
                            <th>Action</th>
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
                                <td><?php echo $u['role']; ?></td>
                                <td><?php echo $u['is_active']; ?></td>
                                <td><?php echo date('d F Y', $u['date_created']); ?></td>
                                <td width="10px">
                                    <a href="" class="btn btn-primary btn-sm btn-edit font-weight-bold" data-toggle="modal" data-target="#editUser<?php echo $u['id']; ?>"><i class="fa fa-edit"></i> Edit</a>
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

<!-- Model Edit User -->
<?php $no = 0;
foreach ($User as $u) : $no++ ?>
    <div class="modal fade" id="editUser<?php echo $u['id']; ?>" tabindex="-1" aria-labelledby="editUser<?php echo $u['id']; ?>Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUser<?php echo $u['id']; ?>Label">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo base_url('administrator/editUser'); ?>" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id" value="<?php echo $u['id']; ?>">
                        <div class="form-group">
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $u['name']; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="email" name="email" value="<?php echo $u['email']; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <select name="role_id" id="role_id" class="form-control">
                                <?php foreach ($role as $r) : ?>
                                    <?php if ($r['id'] == $User['role_id']) : ?>
                                        <option value="<?php echo $r['id']; ?>" selected><?php echo $r['role']; ?></option>
                                    <?php else : ?>
                                        <option value="<?php echo $r['id']; ?>"><?php echo $r['role']; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
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
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- End Model Edit User -->