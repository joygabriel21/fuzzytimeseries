<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3 class="page-header">Input Penilaian</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <?= $this->session->flashdata('msg') ?>
                        <h3>Pelamar</h3>
                        <p>Nama: <?= $pelamar->nama ?></p>
                        <p>Email: <?= $pelamar->email ?></p>
                        <?= form_open('admin/input-penilaian/' . $id_pelamar) ?>
                            <?php foreach ($kriteria as $key): ?>
                                <div class="form-group">
                                    <label for="<?= str_replace(' ', '_', $key->nama) ?>"><?= $key->nama ?></label>
                                    <select name="<?= str_replace(' ', '_', $key->nama) ?>" id="" class="form-control form-md" required>
                                        <option></option>
                                        <?php foreach ($this->bobot_m->get(['id_kriteria' => $key->id_kriteria]) as $value): ?>
                                        <option value="<?= $value->id_bobot ?>"><?= $value->fuzzy ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            <?php endforeach ?>
                            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
