<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->

    <?php if (validation_errors()) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo validation_errors(); ?>
        </div>
    <?php endif; ?>

    <?php echo $this->session->flashdata('message'); ?>

    <div class="row">
        <div class="col-lg mb-3 ml-1">
            <a href="" class="btn btn-primary" data-toggle="modal" data-target="#addNewspaper">Tambah Surat Kabar</a>
        </div>
    </div>


    <!-- DataTales Newspaper -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar surat kabar masuk</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Penerbit</th>
                            <th>Tanggal Masuk</th>
                            <th>Edisi Surat Kabar</th>
                            <th>Halaman</th>
                            <th>Keterangan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($newspaper as $n) : ?>
                            <?php
                            //Untuk memunculkan hari dari tabel newspaper coloum tgl_edisi
                            $tanggal_edisi = $n['tgl_edisi'];
                            $namahari = date('D', strtotime($tanggal_edisi));
                            $tgl = date('d-m-Y', strtotime($tanggal_edisi));

                            if ($namahari == "Sun") $namahari = "Minggu";
                            elseif ($namahari == "Mon") $namahari = "Senin";
                            elseif ($namahari == "Tue") $namahari = "Selasa";
                            elseif ($namahari == "Wed") $namahari = "Rabu";
                            elseif ($namahari == "Thu") $namahari = "Kamis";
                            elseif ($namahari == "Fri") $namahari = "Jum'at";
                            elseif ($namahari == "Sat") $namahari = "Sabtu";

                            //Untuk memunculkan hari dari tabel newspaper coloum tgl_masuk
                            $tanggal_masuk = $n['tgl_masuk'];
                            $hari = date('D', strtotime($tanggal_masuk));
                            $tgl_masuk = date('d-m-Y', strtotime($tanggal_masuk));

                            if ($hari == "Sun") $hari = "Minggu";
                            elseif ($hari == "Mon") $hari = "Senin";
                            elseif ($hari == "Tue") $hari = "Selasa";
                            elseif ($hari == "Wed") $hari = "Rabu";
                            elseif ($hari == "Thu") $hari = "Kamis";
                            elseif ($hari == "Fri") $hari = "Jum'at";
                            elseif ($hari == "Sat") $hari = "Sabtu";
                            ?>
                            <tr>
                                <td width="30px"><?php echo $i; ?></td>
                                <td><?php echo $n['name']; ?></td>
                                <td><?php echo $hari; ?>, <?php echo $tgl_masuk; ?></td>
                                <td><?php echo $namahari; ?>, <?php echo $tgl; ?></td>
                                <td><?php echo $n['page']; ?></td>
                                <td><?php echo $n['keterangan']; ?></td>
                                <td>
                                    <a href="" class="btn btn-primary btn-sm btn-edit font-weight-bold" data-toggle="modal" data-target="#editNewspaper<?php echo $n['id']; ?>"><i class="fa fa-edit"></i> Edit</a>
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

<!-- Modal Add Newspaper-->
<div class="modal fade" id="addNewspaper" tabindex="-1" aria-labelledby="addNewspaperLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewspaperLabel">Tambah Surat Kabar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo base_url('staff'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="publisher">Penerbit :</label>
                        <select name="penerbit" id="penerbit" class="form-control">
                            <option value="">Pilih Penerbit</option>
                            <?php foreach ($publisher as $p) : ?>
                                <option value="<?php echo $p['id']; ?>"><?php echo $p['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="publisher">Tanggal diterima :</label>
                        <input type="date" class="form-control" id="tgl_masuk" name="tgl_masuk">
                    </div>
                    <div class="form-group">
                        <label for="publisher">Tanggal edisi :</label>
                        <input type="date" class="form-control" id="tgl_edisi" name="tgl_edisi">
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" id="page" name="page" placeholder="Jumlah halaman">
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input-n" type="radio" name="keterangan" id="masuk" value="Masuk">
                        <label class="form-check-label pl-1" for="masuk">Masuk</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input-n" type="radio" name="keterangan" id="tmasuk" value="Tidak Masuk">
                        <label class="form-check-label pl-1" for="tmasuk">Tidak Masuk</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal End Add Newspaper-->

<!-- Model Edit Newspaper -->
<?php $no = 0;
foreach ($newspaper as $n) : $no++ ?>
    <div class="modal fade" id="editNewspaper<?php echo $n['id']; ?>" tabindex="-1" aria-labelledby="editNewspaperLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editNewspaperLabel">Perhabarui Surat Kabar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo base_url('staff/editNewspaper'); ?>" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id" value="<?php echo $n['id']; ?>">
                        <div class="form-group">
                            <label for="publisher">Penerbit :</label>
                            <select name="publisher_id" id="publisher_id" class="form-control">
                                <?php foreach ($publisher as $p) : ?>
                                    <?php if ($p['id'] == $newspaper['publisher_id']) : ?>
                                        <option value="<?php echo $p['id']; ?>" selected><?php echo $p['name']; ?></option>
                                    <?php else : ?>
                                        <option value="<?php echo $p['id']; ?>"><?php echo $p['name']; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tgl_masuk">Tanggal diterima :</label>
                            <input type="date" class="form-control" id="tgl_masuk" name="tgl_masuk" value="<?php echo $n['tgl_masuk']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="tgl_edisi">Tanggal edisi :</label>
                            <input type="date" class="form-control" id="tgl_edisi" name="tgl_edisi" value="<?php echo $n['tgl_edisi']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="page">Page :</label>
                            <input type="number" class="form-control" id="page" name="page" value="<?php echo $n['page']; ?>">
                        </div>
                        <?php if ($n['keterangan'] == 'Masuk') : ?>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input-n" type="radio" name="keterangan" id="masuk" value="Masuk" checked>
                                <label class="form-check-label pl-1" for="masuk">Masuk</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input-n" type="radio" name="keterangan" id="tmasuk" value="Tidak Masuk">
                                <label class="form-check-label pl-1" for="tmasuk">Tidak Masuk</label>
                            </div>
                        <?php else : ?>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input-n" type="radio" name="keterangan" id="masuk" value="Masuk">
                                <label class="form-check-label pl-1" for="masuk">Masuk</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input-n" type="radio" name="keterangan" id="tmasuk" value="Tidak Masuk" checked>
                                <label class="form-check-label pl-1" for="tmasuk">Tidak Masuk</label>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Perbaharui</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- End Model Edit Newspaper -->