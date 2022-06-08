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
            <a href="" class="btn btn-primary" data-toggle="modal" data-target="#addNewSubmenu">Add new Submenu</a>
        </div>
    </div>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Submenu</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Menu</th>
                            <th>Submenu</th>
                            <th>Url</th>
                            <th>Icon</th>
                            <th>Active</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($subMenu as $sm) : ?>
                            <tr>
                                <td width="30px"><?php echo $i; ?></td>
                                <td><?php echo $sm['menu']; ?></td>
                                <td><?php echo $sm['title']; ?></td>
                                <td><?php echo $sm['url']; ?></td>
                                <td><?php echo $sm['icon']; ?></td>
                                <td><?php echo $sm['is_active']; ?></td>
                                <td>
                                    <a href="" class="btn btn-primary btn-sm btn-edit font-weight-bold" data-toggle="modal" data-target="#editSubmenu<?php echo $sm['id']; ?>"><i class="fa fa-edit"></i> Edit</a>
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

<!-- Modal Add Menu-->
<div class="modal fade" id="addNewSubmenu" tabindex="-1" aria-labelledby="addNewSubmenuLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewSubmenuLabel">Add New Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo base_url('menu/submenu'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <select name="menu_id" id="menu_id" class="form-control">
                            <option value="">Select Menu</option>
                            <?php foreach ($menu as $m) : ?>
                                <option value="<?php echo $m['id']; ?>"><?php echo $m['menu']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Submenu name">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="url" name="url" placeholder="Url">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="icon" name="icon" placeholder="Icon">
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
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal End Add Menu-->

<!-- Model Edit Submenu -->
<?php $no = 0;
foreach ($subMenu as $sm) : $no++ ?>
    <div class="modal fade" id="editSubmenu<?php echo $sm['id']; ?>" tabindex="-1" aria-labelledby="editSubmenuLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSubmenuLabel">Edit Submenu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo base_url('menu/editSubmenu'); ?>" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id" value="<?php echo $sm['id']; ?>">
                        <div class="form-group">
                            <select name="menu_id" id="menu_id" class="form-control">
                                <?php foreach ($menu as $m) : ?>
                                    <?php if ($m['id'] == $subMenu['menu_id']) : ?>
                                        <option value="<?php echo $m['id']; ?>" selected><?php echo $m['menu']; ?></option>
                                    <?php else : ?>
                                        <option value="<?php echo $m['id']; ?>"><?php echo $m['menu']; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="title" name="title" value="<?php echo $sm['title']; ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="url" name="url" value="<?php echo $sm['url']; ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="icon" name="icon" value="<?php echo $sm['icon']; ?>">
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
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- End Model Edit Submenu -->