<!-- Begin Page Content -->
<div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('message'); ?>"></div>
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800 pl-1"><?php echo $title; ?></h1>

    <!-- <?php echo $this->session->flashdata('message'); ?> -->

    <div class="row mb-2">
        <div class="col-xs-12 col-sm-6 ml-auto text-right">
            <form action="" method="get">
                <div class="row">
                    <div class="col">
                        <select name="bulan" id="bulan" class="form-control">
                            <option value="" disabled selected>-- Pilih Bulan --</option>
                            <?php foreach ($all_bulan as $bn => $bt) : ?>
                                <option value="<?php echo $bn; ?>" <?php echo ($bn == $bulan) ? 'selected' : ''; ?>><?php echo $bt ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col ">
                        <select name="tahun" id="tahun" class="form-control">
                            <option value="" disabled selected>-- Pilih Tahun --</option>
                            <?php for ($i = date('Y'); $i >= (date('Y') - 2); $i--) : ?>
                                <option value="<?php echo $i; ?>" <?php echo ($i == $tahun) ? 'selected' : ''; ?>><?php echo $i ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <div class="col ">
                        <button type="submit" class="btn btn-primary btn-fill btn-block">Tampilkan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <table class="table border-0">
                                <tr>
                                    <th class="border-0 py-0" width="10px">Nama</th>
                                    <th class="border-0 py-0" width="10px">:</th>
                                    <th class="border-0 py-0"><?php echo $pegawai['name']; ?></th>
                                </tr>
                            </table>
                        </div>
                        <div class="col-xs-12 col-sm-6 ml-auto text-right mb-2">
                            <div class="dropdown d-inline">
                                <button class="btn btn-secondary dropdown-toggle font-weight-bold" type="button" id="droprop-action" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-print"></i>
                                    Export Laporan
                                </button>
                                <div class="dropdown-menu" aria-labelledby="droprop-action">
                                    <a href="<?= base_url('user/exportPDF/' . $this->uri->segment(3) . "?bulan=$bulan&tahun=$tahun") ?>" class="dropdown-item" target="_blank"><i class="fas fa-file-pdf pr-2"></i> PDF</a>
                                    <a href="<?= base_url('user/exportExcel/' . $this->uri->segment(3) . "?bulan=$bulan&tahun=$tahun") ?>" class="dropdown-item" target="_blank"><i class="fas fa-file-excel pr-2"></i> Exel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="card-title mb-4 font-weight-bold pl-2">Absen Bulan : <?php echo bulan($bulan) . ' ' . $tahun; ?></h5>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="" width="100%" cellspacing="0">
                            <thead>
                                <th width="10px">No</th>
                                <th>Tanggal</th>
                                <th>Ketearangan</th>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php if ($absen) : ?>
                                    <?php foreach ($absen as $row) : ?>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo tgl_hari($row['tgl_apel']); ?></td>
                                        <td>Hadir</td>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->