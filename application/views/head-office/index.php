<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800 pl-1"><?php echo $title; ?></h1>

    <?php echo $this->session->flashdata('message'); ?>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Waktu Jam Kerja</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Keterangan</th>
                            <th>Jam Mulai</th>
                            <th>Jam Selesai</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($jam as $j) : ?>
                            <tr>
                                <td width="30px"><?php echo $i; ?></td>
                                <td><?php echo $j['keterangan']; ?></td>
                                <td><?php echo $j['start']; ?></td>
                                <td><?php echo $j['finish']; ?></td>
                                <td width="100px">
                                    <a href="" class="btn btn-primary btn-sm btn-edit font-weight-bold" data-toggle="modal" data-target="#editJam<?php echo $j['id']; ?>"><i class="fa fa-edit"></i> Edit</a>
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

<!--Modal Edit Jam -->
<?php $no = 0;
foreach ($jam as $j) : $no++ ?>
    <div class="modal fade" id="editJam<?php echo $j['id']; ?>" tabindex="-1" aria-labelledby="editJamLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editJamLabel">Edit Jam <?php echo $j['keterangan']; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo base_url('admin/editJam'); ?>" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id" value="<?php echo $j['id']; ?>">
                        <div class="form-group">
                            <label for="start">Jam Mulai :</label>
                            <input type="time" class="form-control" id="start" name="start" value="<?php echo $j['start']; ?>" required="required">
                        </div>
                        <div class="form-group">
                            <label for="start">Jam Selesai :</label>
                            <input type="time" class="form-control" id="finish" name="finish" value="<?php echo $j['finish']; ?>" required="required">
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
<!-- End Modal Edit Jam -->