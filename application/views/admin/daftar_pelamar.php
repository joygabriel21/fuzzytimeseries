    <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3 class="page-header">Daftar Pelamar <!-- <button class="btn btn-success" data-toggle="modal" data-target="#add"><i class="fa fa-plus"></i></button> -->
                </h3>
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
                        <h2>Daftar Pelamar</h2>
                    </div>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                        <div>
                            <?= $this->session->flashdata('msg') ?>
                        </div>

                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>No.HP</th>
                                        <th>Email</th>
                                        <th></th>
                                    </tr>
                            </thead>

                            <tbody>
                                <?php $i=1; foreach ($pelamar as $row): ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $row->nama ?></td>
                                    <td><?= $row->no_hp ?></td>
                                    <td><?= $row->email ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                            Aksi <span class="caret"></span></button>
                                            <ul class="dropdown-menu" role="menu">
                                              <li><a href="<?= base_url('admin/input-penilaian/' . $row->id_pelamar) ?>"><i class="fa fa-pencil"></i> Input Nilai</a></li>
                                              <li><a href="<?= base_url('admin/hasil-penilaian/' . $row->id_pelamar) ?>"><i class="fa fa-eye"></i> Hasil Penilaian</a></li>
                                              <li><a href="" onclick="delete_pelamar(<?= $row->id_pelamar ?>)"><i class="fa fa-trash"></i> Hapus </a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <?php $i++; endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



            <div class="modal fade" tabindex="-1" role="dialog" id="add">
              <div class="modal-dialog" role="document">
                <?= form_open_multipart('admin/daftar-pelamar') ?>
               <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Tambah Data Pelamar</h4>
                  </div>
                  <div class="modal-body">
                        <div class="form-group">
                            <label for="Nama">Nama *</label>
                            <input type="text" class="form-control" name="nama" required>
                        </div>
                        <div class="form-group">
                          <label for="jk">Jenis Kelamin</label>
                          <select class="form-control" name="jk" required>
                            <option>-- PILIH JENIS KELAMIN --</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                          </select>
                        </div>
                        <div class="form-group">
                            <label for="Upload Foto">Upload Foto</label>
                            <input type="file" name="foto">
                        </div>
                        <div class="form-group">
                            <label for="Tempat Lahir">Tempat Lahir *</label>
                            <input type="text" class="form-control" name="tempat_lahir" required>
                        </div>
                        <div class="form-group">
                            <label for="Tanggal Lahir">Tanggal Lahir *</label>
                            <input type="text" class="form-control" name="tgl_lahir" required>
                        </div>
                        <div class="form-group">
                            <label for="Nomor HP">Nomor HP *</label>
                            <input type="text" class="form-control" name="no_hp" required>
                        </div>
                        <div class="form-group">
                            <label for="Email">Email *</label>
                            <input type="text" class="form-control" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="Alamat">Alamat *</label>
                            <textarea class="form-control" rows="3" name="alamat" required></textarea>
                        </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
                  </div>
                  <?= form_close() ?>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->


            <div class="modal fade" tabindex="-1" role="dialog" id="input_nilai">
              <div class="modal-dialog modal-sm" role="document">
                <?= form_open('admin/daftar-pelamar') ?>
                <input type="hidden" id="id_pelamar" name="id_pelamar">
               <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Input Nilai</h4>
                  </div>
                  <div class="modal-body">
                    <?php foreach ($kriteria as $key): ?>
                        <div class="form-group">
                            <label for="<?= $key->nama ?>"><?= $key->nama ?></label>
                            <select name="<?= $key->nama ?>" id="" class="form-control form-md">
                                <option></option>
                                <?php foreach ($this->bobot_m->get(['id_kriteria' => $key->id_kriteria]) as $value): ?>
                                <option value="<?= $value->id_bobot ?>"><?= $value->fuzzy ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    <?php endforeach ?>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <input type="submit" name="input_nilai" value="Simpan" class="btn btn-primary">
                  </div>
                  <?= form_close() ?>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
          </div>

            <script>
                $(document).ready(function() {
                    $('#dataTables-example').DataTable({
                        responsive: true
                    });
                });

                function delete_pelamar(id_pelamar) {
                    $.ajax({
                        url: '<?= base_url('admin/daftar-pelamar') ?>',
                        type: 'POST',
                        data: {
                            id_pelamar: id_pelamar,
                            delete: true
                        },
                        success: function() {
                            window.location = '<?= base_url('admin/daftar-pelamar') ?>';
                        }
                    });
                }

                function set_id_pelamar(id_pelamar) {
                  $('#id_pelamar').val(id_pelamar);
                }
            </script>