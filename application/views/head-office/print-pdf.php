<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Absen <?php echo $pegawai['nama'] ?> bulan <?= bulan($bulan) . ', ' . $tahun ?></title>

    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
</head>

<body>
    <div class="row mt-2">
        <div class="mt-2">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex">
                            <div class="float-left">
                                <table class="table">
                                    <tr>
                                        <th class="border-0 py-0" width="10px">Nama</th>
                                        <th class="border-0 py-0" width="10px">:</th>
                                        <th class="border-0 py-0"><?php echo $pegawai['name']; ?></th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title mb-4">Absen Bulan : <?php echo bulan($bulan) . ' ' . $tahun ?></h5>
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th width="10px">No</th>
                                        <th>Tanggal</th>
                                        <th>Jam Masuk</th>
                                        <th>Jam Keluar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($hari as $i => $h) : ?>
                                        <?php
                                        $absen_harian = array_search($h['tgl'], array_column($absen, 'tgl')) !== false ? $absen[array_search($h['tgl'], array_column($absen, 'tgl'))] : '';
                                        ?>
                                        <tr <?= (in_array($h['hari'], ['Sabtu', 'Minggu'])) ? 'class="bg-dark text-white"' : '' ?> <?= ($absen_harian == '') ? 'class="bg-danger text-white"' : '' ?>>
                                            <td><?= ($i + 1) ?></td>
                                            <td><?= $h['hari'] . ', ' . $h['tgl'] ?></td>
                                            <td class="text-center"><?= (in_array($h['hari'], ['Sabtu', 'Minggu'])) ? 'Libur Akhir Pekan' : check_jam(@$absen_harian['jam_masuk'], 'masuk') ?></td>
                                            <td class="text-center"><?= (in_array($h['hari'], ['Sabtu', 'Minggu'])) ? 'Libur Akhir Pekan' : check_jam(@$absen_harian['jam_pulang'], 'pulang') ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>