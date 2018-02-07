    <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3 class="page-header">Daftar Pelamar</h3>
                <a href="<?= base_url('manager/laporan_hasil_penilaian') ?>" class="btn btn-success btn-lg"><i class="fa fa-download"></i> Cetak</a>
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

            <div class="row" style="margin-top: 2%;">
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
                                        <th>Aksi</th>
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
                                        <a href="<?= base_url('admin/hasil_penilaian') ?>" class="btn btn-info"><i class="fa fa-eye"></i> Detail Penilaian</a>
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

</div>

            <script>
                $(document).ready(function() {
                    $('#dataTables-example').DataTable({
                        responsive: true
                    });
                });

                function delete_pelamar(id_pelamar) {
                    $.ajax({
                        url: '<?= base_url('kasir/pelamar') ?>',
                        type: 'POST',
                        data: {
                            id_pelamar: id_pelamar,
                            delete: true
                        },
                        success: function() {
                            window.location = '<?= base_url('kasir/pelamar') ?>';
                        }
                    });
                }
            </script>