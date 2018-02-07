    <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.min.js"></script>
    <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3 class="page-header">
                    Ranking Pelamar
                </h3>
                <a class="btn btn-primary" href="<?= base_url('supervisor/laporan') ?>"><i class="fa fa-download"></i> Download Laporan Penilaian</a>
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
                        <h2>Ranking Pelamar</h2>
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
                        <canvas id="line-chart" width="600" height="300"></canvas>
                        <script type="text/javascript">
                            var labels = [];
                            var data = [];
                        </script>
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>No.HP</th>
                                    <th>Email</th>
                                    <?php foreach($kriteria as $row): ?>
                                    <th><?= $row->nama ?></th>
                                    <?php endforeach; ?>
                                    <th>Hasil</th>
                                    <th>Keputusan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; foreach ($hasil as $row): ?>
                                <?php  
                                    $data = $this->pelamar_m->get_row(['id_pelamar' => $row->id_pelamar]);
                                    if (!$data) continue;

                                    $keputusan = $this->keputusan_m->get_row(['id_keputusan' => $row->id_keputusan]);
                                    if (!$keputusan) continue;
                                ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $data->nama ?></td>
                                    <td><?= $data->no_hp ?></td>
                                    <td><?= $data->email ?></td>
                                    <?php foreach($kriteria as $krow): ?>
                                        <?php  
                                            $check_penilaian = $this->penilaian_m->get_row(['id_pelamar' => $data->id_pelamar, 'id_kriteria' => $krow->id_kriteria]);
                                            if (isset($check_penilaian))
                                            {
                                                $bobot = $this->bobot_m->get_row(['id_bobot' => $check_penilaian->id_bobot]);
                                                if (isset($bobot))
                                                {
                                                    echo '<td>' . $bobot->fuzzy . '</td>';
                                                }
                                                else
                                                {
                                                    echo '<td>-</td>';
                                                }
                                            }
                                            else
                                            {
                                                echo '<td>-</td>';
                                            }
                                        ?>
                                    <?php endforeach; ?>
                                    <td><?= $row->hasil ?></td>
                                    <td><?= $keputusan->nama ?></td>
                                </tr>
                                <script type="text/javascript">
                                    labels.push('<?= $data->nama ?>');
                                    data.push(<?= $row->hasil ?>);
                                </script>
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
                    // $('#dataTables').DataTable({
                    //     responsive: true
                    // });

                    var ctx = document.getElementById('line-chart');

                    var myLineChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: labels,
                            datasets: [{ 
                                data: data,
                                label: "Hasil",
                                borderColor: "#3e95cd",
                                fill: false
                              }
                            ]
                          },
                          options: {
                            title: {
                              display: true,
                              text: 'Grafik Hasil Perhitungan Fuzzy SAW'
                            },
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero:true,
                                        max: 1
                                    },
                                    scaleLabel: {
                                        display: true,
                                        labelString: 'Hasil'
                                    }
                                }],
                                xAxes: [{
                                    scaleLabel: {
                                        display: true,
                                        labelString: 'Nama Pelamar'
                                    },
                                    ticks: {
                                        autoSkip: false,
                                        maxRotation: 90,
                                        minRotation: 80
                                    }
                                }]
                            }
                          }
                    });
                });
            </script>