<style type="text/css">
th{width: 400px;}
h2{margin-bottom: 4%;}
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <div>
                    <h1>
                    Hasil Penilaian
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?= base_url('admin/daftar_anggota') ?>"><i class="fa fa-user"></i> Daftar Anggota</a></li>
                        <li class="active">Hasil Penilaian</li>
                    </ol>
                </div>
            </div>
            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <div>
                            <h2>Data Penilaian</h2>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="datatable" class="table table-striped table-bordered">
                            <?php foreach ($penilaian as $row): ?>
                            <tr>
                                <th>
                                    <?php
                                    $kriteria = $this->kriteria_m->get_row(['id_kriteria' => $row->id_kriteria]);
                                    echo $kriteria ? $kriteria->nama : 'Data kriteria tidak ditemukan';
                                    ?>
                                </th>
                                <td>
                                    <?php
                                    $bobot = $this->bobot_m->get_row(['id_bobot' => $row->id_bobot]);
                                    echo $bobot ? $bobot->fuzzy : 'Data bobot tidak ditemukan';
                                    ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <tr>
                                <th>Hasil</th>
                                <td>
                                    <?php
                                    $hasil_penilaian = $this->hasil_penilaian_m->get_row(['id_pelamar' => $id_pelamar]);
                                    echo $hasil_penilaian ? $hasil_penilaian->hasil : 'Data hasil tidak ditemukan';
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Keputusan</th>
                                <td>
                                    <?php
                                    if ($hasil_penilaian)
                                    {
                                    $keputusan = $this->keputusan_m->get_row(['id_keputusan' => $hasil_penilaian->id_keputusan]);
                                    echo $keputusan ? $keputusan->nama : 'Data keputusan tidak ditemukan';
                                    }
                                    else
                                    {
                                    echo 'Data keputusan tidak ditemukan';
                                    }
                                    ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <div>
                            <h2>Data Pribadi Pelamar</h2>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="datatable" class="table table-striped table-bordered">
                            <tr>
                                <th>Foto</th>
                                <td><img src="<?= base_url('assets/foto/' . $pelamar->id_pelamar . '.jpg') ?>" width="150" height="150"></td>
                            </tr>
                            <tr>
                                <th>Nama</th>
                                <td><?= $pelamar->nama ?></td>
                            </tr>
                            <tr>
                                <th>Tempat, Tanggal Lahir</th>
                                <td><?= $pelamar->tempat_lahir . ', ' . $pelamar->tgl_lahir ?></td>
                            </tr>
                            <tr>
                                <th>Nomor HP</th>
                                <td><?= $pelamar->no_hp ?></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td><?= $pelamar->email ?></td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td><?= $pelamar->alamat ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>