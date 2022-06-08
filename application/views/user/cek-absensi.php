<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg">
            <!-- Collapsable Card Example -->
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">Jadwal Absensi</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardExample">
                    <div class="card-body">
                        Absen masuk mulai <strong><?php echo $jam_masuk['start']; ?> - <?php echo $jam_masuk['finish']; ?></strong>, dan Absen pulang mulai <strong><?php echo $jam_pulang['start']; ?> - <?php echo $jam_pulang['finish']; ?></strong>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Absen Harian</h4>
                </div>
                <div class="card-body">
                    <table class="table w-100">
                        <thead>
                            <th>Tanggal</th>
                            <th>Absen Masuk</th>
                            <th>Absen Pulang</th>
                        </thead>
                        <tbody>
                            <tr>
                                <?php if (is_weekend()) : ?>
                                    <td class="bg-light text-danger font-weight-bold" colspan="4">Hari ini libur. Tidak Perlu absen</td>
                                <?php elseif ($absen == 2) : ?>
                                    <td class="bg-light text-success font-weight-bold" colspan="4">Absen masuk dan pulang telah dicatat! Tidak Perlu absen lagi</td>
                                <?php elseif ($absen == 1) : ?>
                                    <td><?= tgl_hari(date('d-m-Y')) ?></td>
                                    <td>
                                        <a href="" class="btn btn-dark btn-sm btn-fill" <?= ($absen == 1 || $absen == 2) ? 'disabled style="cursor:not-allowed"' : '' ?>>Absen Masuk</a>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('user/absen/pulang') ?>" class="btn btn-success btn-sm btn-fill" <?= ($absen !== 1 || $absen == 2) ? 'disabled style="cursor:not-allowed"' : '' ?>>Absen Pulang</a>
                                    </td>
                                <?php else : ?>
                                    <td><?= tgl_hari(date('d-m-Y')) ?></td>
                                    <td>
                                        <a href="<?= base_url('user/absen/masuk') ?>" class="btn btn-primary btn-sm btn-fill" <?= ($absen == 1 || $absen == 2) ? 'disabled style="cursor:not-allowed"' : '' ?>>Absen Masuk</a>
                                    </td>
                                    <td>
                                        <a href="" class="btn btn-dark btn-sm btn-fill" <?= ($absen !== 1 || $absen == 2) ? 'disabled style="cursor:not-allowed"' : '' ?>>Absen Pulang</a>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->