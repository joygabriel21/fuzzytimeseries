<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= 'Laporan' ?></title>

    <!-- Bootstrap -->
    <link href="<?= base_url('assets') ?>/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?= base_url('assets') ?>/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?= base_url('assets') ?>/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="<?= base_url('assets') ?>/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?= base_url('assets') ?>/build/css/custom.min.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="<?= base_url('assets') ?>/vendors/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.min.js"></script>
  </head>

  <body class="nav-md">
    <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <div>
                        <h2>Laporan Penilaian</h2>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                        <div>
                            <?= $this->session->flashdata('msg') ?>
                        </div>
                        <div id="chartContainer" style="height: 360px; width: 700px;"></div>
                        <!-- <div style="width: 100% !important; height: 600px !important;">
                            <canvas id="line-chart" width="1000" height="600"></canvas>
                        </div> -->
                        <br><br><br><br><br>
                        <script type="text/javascript">
                            var labels = [];
                            var data = [];
                            var canvasJsData = [];
                        </script>
                        <table class="table table-striped table-bordered">
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
                                    canvasJsData.push({
                                        label: '<?= $data->nama ?>',
                                        y: <?= $row->hasil ?>
                                    });
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

                    var chart = new CanvasJS.Chart("chartContainer",
                    {
                            title: {
                                text: "Grafik Penilaian"
                            },
                            data: [
                            {
                                type: "spline",
                                dataPoints: canvasJsData
                            }
                            ]
                    });
                    chart.render();

                    var canvas = $("#chartContainer .canvasjs-chart-canvas").get(0);
                    var dataURL = canvas.toDataURL();
                    //console.log(dataURL);

                    $("#exportButton").click(function(){
                        var pdf = new jsPDF();
                        pdf.addImage(dataURL, 'JPEG', 0, 0);
                        pdf.save("download.pdf");
                    });

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
                            },
                            animation: {
                                duration: 0
                            }
                          }
                    });
                });
            </script>
      </div>
    </div>

    <!-- DataTables -->
    <script src="<?= base_url('assets') ?>/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <!-- ChartJS -->
    <script src="<?= base_url('assets') ?>/vendors/Chart.js/dist/Chart.js"></script>
    <!-- Bootstrap -->
    <script src="<?= base_url('assets') ?>/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?= base_url('assets') ?>/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?= base_url('assets') ?>/vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="<?= base_url('assets') ?>/vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- jQuery Sparklines -->
    <script src="<?= base_url('assets') ?>/vendors/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
    <!-- Flot -->
    <script src="<?= base_url('assets') ?>/vendors/Flot/jquery.flot.js"></script>
    <script src="<?= base_url('assets') ?>/vendors/Flot/jquery.flot.pie.js"></script>
    <script src="<?= base_url('assets') ?>/vendors/Flot/jquery.flot.time.js"></script>
    <script src="<?= base_url('assets') ?>/vendors/Flot/jquery.flot.stack.js"></script>
    <script src="<?= base_url('assets') ?>/vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="<?= base_url('assets') ?>/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="<?= base_url('assets') ?>/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="<?= base_url('assets') ?>/vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="<?= base_url('assets') ?>/vendors/DateJS/build/date.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="<?= base_url('assets') ?>/vendors/moment/min/moment.min.js"></script>
    <script src="<?= base_url('assets') ?>/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    
    <!-- Custom Theme Scripts -->
    <script src="<?= base_url('assets') ?>/build/js/custom.min.js"></script>
  </body>
</html>