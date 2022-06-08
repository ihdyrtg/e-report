<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800 pl-1"><?php echo $title; ?></h1>

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
                            <?php for ($i = date('Y'); $i >= (date('Y') - 1); $i--) : ?>
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
                                    <a href="<?= base_url('admin/exportPDF/' . $this->uri->segment(3) . "?bulan=$bulan&tahun=$tahun") ?>" class="dropdown-item" target="_blank"><i class="fas fa-file-pdf pr-2"></i> PDF</a>
                                    <a href="<?= base_url('admin/exportExcel/' . $this->uri->segment(3) . "?bulan=$bulan&tahun=$tahun") ?>" class="dropdown-item" target="_blank"><i class="fas fa-file-excel pr-2"></i> Exel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="card-title mb-4 font-weight-bold pl-2">Absen Bulan : <?php echo bulan($bulan) . ' ' . $tahun; ?></h5>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <th width="10px">No</th>
                                <th>Tanggal</th>
                                <th>Jam Masuk</th>
                                <th>Jam Keluar</th>
                            </thead>
                            <tbody>
                                <?php if ($absen) : ?>
                                    <?php foreach ($hari as $i => $h) : ?>
                                        <?php
                                        $absen_harian = array_search($h['tgl'], array_column($absen, 'tgl')) !== false ? $absen[array_search($h['tgl'], array_column($absen, 'tgl'))] : '';
                                        ?>
                                        <tr <?php echo (in_array($h['hari'], ['Sabtu', 'Minggu'])) ? 'class="bg-dark text-white"' : '' ?> <?php echo ($absen_harian == '') ? 'class="bg-danger text-white"' : '' ?>>
                                            <td> <?php echo ($i + 1); ?></td>
                                            <td><?php echo $h['hari'] . ', ' . $h['tgl']; ?></td>
                                            <td class="text-center"><?php echo is_weekend($h['tgl']) ? 'Libur Akhir Pekan' : check_jam(@$absen_harian['jam_masuk'], 'masuk') ?></td>
                                            <td class="text-center"><?= is_weekend($h['tgl']) ? 'Libur Akhir Pekan' : check_jam(@$absen_harian['jam_pulang'], 'pulang') ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td class="bg-light" colspan="4">Tidak ada absen bulan <strong><?php echo bulan($bulan) . ' ' . $tahun; ?></strong></td>
                                    </tr>
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