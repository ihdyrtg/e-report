<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800 pl-1"><?php echo $title; ?></h1>

    <div class="row pl-1">
        <div class="col-lg-6">
            <?php echo $this->session->flashdata('message'); ?>
            <form action="<?php echo base_url('profile/ubahpassword'); ?>" method="post">
                <div class="form-group row">
                    <label for="current_password" class="col-sm-4 col-form-label">Password saat ini</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" id="current_password" name="current_password"><?php echo form_error('current_password', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="new_password1" class="col-sm-4 col-form-label">Password baru</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" id="new_password1" name="new_password1">
                        <?php echo form_error('new_password1', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="new_password2" class="col-sm-4 col-form-label">Ulangi password</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" id="new_password2" name="new_password2">
                        <?php echo form_error('new_password2', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Ubah Password</button>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->