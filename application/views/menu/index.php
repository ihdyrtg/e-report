<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800 pl-1"><?php echo $title; ?></h1>

    <?php echo form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>

    <?php echo $this->session->flashdata('message'); ?>

    <div class="row">
        <div class="col-lg mb-3 ml-1">
            <a href="" class="btn btn-primary" data-toggle="modal" data-target="#addNewMenu">Add new Menu</a>
        </div>
    </div>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Menu</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Menu</th>
                            <th>Order</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($menu as $m) : ?>
                            <tr>
                                <td width="30px"><?php echo $i; ?></td>
                                <td><?php echo $m['menu']; ?></td>
                                <td width="30px"><?php echo $m['order']; ?></td>
                                <td width="10px">
                                    <a href="" class="btn btn-primary btn-sm btn-edit font-weight-bold" data-toggle="modal" data-target="#editMenu<?php echo $m['id']; ?>"><i class="fa fa-edit"></i> Edit</a>
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
<div class="modal fade" id="addNewMenu" tabindex="-1" aria-labelledby="addNewMenuLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewMenuLabel">Add New Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo base_url('menu'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="menu" name="menu" placeholder="Menu name">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="order" name="order" placeholder="Menu order">
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

<!-- Model Edit Menu -->
<?php $no = 0;
foreach ($menu as $m) : $no++ ?>
    <div class="modal fade" id="editMenu<?php echo $m['id']; ?>" tabindex="-1" aria-labelledby="editMenu<?php echo $m['id']; ?>Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editMenu<?php echo $m['id']; ?>Label">Edit Menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo base_url('menu/editMenu'); ?>" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id" value="<?php echo $m['id']; ?>">
                        <div class="form-group">
                            <input type="text" class="form-control" id="menu" name="menu" value="<?php echo $m['menu']; ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="order" name="order" value="<?php echo $m['order']; ?>">
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
<!-- End Model Edit Menu -->