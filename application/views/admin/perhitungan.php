<script type="text/javascript" src="<?= base_url('assets/MathJax/MathJax.js?config=TeX-MML-AM_CHTML') ?>"></script>
<script type="text/x-mathjax-config">
  MathJax.Hub.Config({
    tex2jax: {
      inlineMath: [ ['$','$'], ["\\(","\\)"] ],
      processEscapes: true
    }
  });
</script>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3 class="page-header">Perhitungan <i>Fuzzy Simple Additive Weighting</i></h3>
                <?= form_open('admin/perhitungan') ?>
                    <input type="submit" value="Hitung Hasil" class="btn btn-danger btn-xs" name="hitung_hasil">
                <?= form_close() ?>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <?php if (count($penilaian) >= count($kriteria)): ?>
                    <div class="x_content">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pelamar</th>
                                    <?php foreach ($kriteria as $row): ?>
                                        <th><?= $row->nama ?></th>
                                    <?php endforeach; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; foreach ($pelamar as $row): ?>
                                    <?php  
                                        $penilaian = $this->penilaian_m->get(['id_pelamar' => $row->id_pelamar]);
                                        if (count($penilaian) <= 0) continue;
                                    ?>
                                    <tr>
                                        <td><?= ++$i ?></td>
                                        <td><?= $row->nama ?></td>
                                        <?php foreach ($kriteria as $nilai): ?>
                                            <?php  
                                                $nilai_pelamar = $this->penilaian_m->get_row(['id_kriteria' => $nilai->id_kriteria, 'id_pelamar' => $row->id_pelamar]);
                                                if (!isset($nilai_pelamar))
                                                {
                                                    echo '<td>-</td>';
                                                }
                                                else
                                                {
                                                    $bobot = $this->bobot_m->get_row(['id_bobot' => $nilai_pelamar->id_bobot]);
                                                    echo !isset($bobot) ? '<td>-</td>' : '<td>' . $bobot->fuzzy . '</td>';
                                                }
                                            ?>
                                        <?php endforeach; ?>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <hr>
                        <p>1. Memberikan nilai alternatif pada setiap kriteria yang sudah ditentukan</p>
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pelamar</th>
                                    <th>Label</th>
                                    <?php foreach ($kriteria as $row): ?>
                                        <th><?= $row->nama ?></th>
                                    <?php endforeach; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; foreach ($pelamar as $row): ?>
                                    <?php  
                                        $penilaian = $this->penilaian_m->get(['id_pelamar' => $row->id_pelamar]);
                                        if (count($penilaian) <= 0) continue;
                                    ?>
                                    <tr>
                                        <td><?= ++$i ?></td>
                                        <td><?= $row->nama ?></td>
                                        <td><?= 'A' . $i ?></td>
                                        <?php foreach ($kriteria as $nilai): ?>
                                            <?php  
                                                $nilai_pelamar = $this->penilaian_m->get_row(['id_kriteria' => $nilai->id_kriteria, 'id_pelamar' => $row->id_pelamar]);
                                                if (!isset($nilai_pelamar))
                                                {
                                                    echo '<td>-</td>';
                                                }
                                                else
                                                {
                                                    $bobot = $this->bobot_m->get_row(['id_bobot' => $nilai_pelamar->id_bobot]);
                                                    echo !isset($bobot) ? '<td>-</td>' : '<td>' . $bobot->nilai . '</td>';
                                                }
                                            ?>
                                        <?php endforeach; ?>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <center><b>Tabel rating kecocokan dari setiap alternatif pada setiap kriteria</b></center>
                        <p>Matriks keputusan yang terbentuk</p>
                        $${X = 
                            \begin{pmatrix}
                                <?php for ($i = 0; $i < count($pelamar); $i++): ?>
                                    <?php  
                                        $penilaian = $this->penilaian_m->get(['id_pelamar' => $pelamar[$i]->id_pelamar]);
                                        if (count($penilaian) <= 0) continue;
                                    ?>
                                    <?php for ($j = 0; $j < count($kriteria); $j++): ?>
                                        <?php  
                                            $nilai_pelamar = $this->penilaian_m->get_row(['id_kriteria' => $kriteria[$j]->id_kriteria, 'id_pelamar' => $pelamar[$i]->id_pelamar]);
                                            if (!isset($nilai_pelamar))
                                            {
                                                echo '0';
                                            }
                                            else
                                            {
                                                $bobot = $this->bobot_m->get_row(['id_bobot' => $nilai_pelamar->id_bobot]);
                                                echo !isset($bobot) ? '0' : $bobot->nilai;
                                            }
                                        ?>
                                        <?php if ($j < count($kriteria) - 1): ?>
                                            &
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                    <?php if ($i < count($pelamar) - 1): ?>
                                        \\
                                    <?php endif; ?>
                                <?php endfor; ?>
                            \end{pmatrix}
                        }$$
                        <hr>
                        <p>2. Menormalisasi matriks X menjadi matriks R</p>
                        $$\LARGE{r_{ij} = 
                        \begin{cases}
                        \frac{x_{ij}}{max_i(x_{ij})}\\
                        \frac{min_i(x_{ij})}{x_{ij}}
                        \end{cases}}$$
                        <br><strong>Keterangan :</strong> <br>
                        ${r_{ij}}$     = Nilai rating kinerja ternormalisasi <br>
                        ${x_{ij}}$     = Nilai atribut yang dimiliki dari setiap kriteria <br>
                        ${max(x_{ij})}$ = Nilai terbesar dari setiap kriteria <br>
                        ${min(x_{ij})}$ = Nilai terkecil dari setiap kriteria <br>
                        Benefit     = Jika nilai terbesar adalah terbaik <br>
                        Cost        = Jika nilai terkecil adalah terbaik <br>

                        <hr>

                        <ol style="list-style-type: lower-alpha;">
                            <?php $matriks_nilai = []; for ($i = 0; $i < count($kriteria); $i++): ?>
                                <?php  
                                    $penilaian = $this->penilaian_m->get(['id_kriteria' => $kriteria[$i]->id_kriteria]);
                                    if (count($penilaian) <= 0) continue;

                                    $all_nilai = [];
                                    foreach ($penilaian as $nilai)
                                    {
                                        $bobot = $this->bobot_m->get_row(['id_bobot' => $nilai->id_bobot]);
                                        if (!isset($bobot))
                                        {
                                            $all_nilai []= 0;
                                        }
                                        else
                                        {
                                            $all_nilai []= $bobot->nilai;
                                        }
                                    }
                                ?>
                                <li>Untuk <?= $kriteria[$i]->nama ?> termasuk kedalam atribut <?= $kriteria[$i]->benefit ?></li>
                                <div>
                                    <?php for ($j = 0; $j < count($penilaian); $j++): ?>
                                        <?php  
                                            $bobot = $this->bobot_m->get_row(['id_bobot' => $penilaian[$j]->id_bobot]);
                                        ?>
                                        $${r_{<?= $j + 1 ?><?= $i + 1 ?>}=\frac{<?= isset($bobot) ? $bobot->nilai : 0 ?>}{max\{<?= implode(',', $all_nilai) ?>\}}=\frac{<?= isset($bobot) ? $bobot->nilai : 0 ?>}{<?= max($all_nilai) ?>}=<?= number_format(((float)isset($bobot) ? $bobot->nilai : 0)/(float)max($all_nilai), 2) ?>}$$
                                        <?php $matriks_nilai[$j] []= number_format(((float)isset($bobot) ? $bobot->nilai : 0)/(float)max($all_nilai), 2); ?>
                                    <?php endfor; ?>
                                </div>
                            <?php endfor; ?>
                        </ol>
                        <hr>
                        <p>Matriks R:</p>
                        <div>
                            $${R = 
                            \begin{pmatrix}
                                <?php for ($i = 0; $i < count($pelamar); $i++): ?>
                                    <?php  
                                        $penilaian = $this->penilaian_m->get(['id_pelamar' => $pelamar[$i]->id_pelamar]);
                                        if (count($penilaian) <= 0) continue;
                                    ?>
                                    <?php for ($j = 0; $j < count($kriteria); $j++): ?>
                                        <?php  
                                            $nilai_pelamar = $this->penilaian_m->get_row(['id_kriteria' => $kriteria[$j]->id_kriteria, 'id_pelamar' => $pelamar[$i]->id_pelamar]);
                                            if (!isset($nilai_pelamar))
                                            {
                                                echo '0';
                                            }
                                            else
                                            {
                                                $bobot = $this->bobot_m->get_row(['id_bobot' => $nilai_pelamar->id_bobot]);
                                                echo !isset($bobot) ? '0' : $bobot->nilai;
                                            }
                                        ?>
                                        <?php if ($j < count($kriteria) - 1): ?>
                                            &
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                    <?php if ($i < count($pelamar) - 1): ?>
                                        \\
                                    <?php endif; ?>
                                <?php endfor; ?>
                            \end{pmatrix}
                        }$$
                        </div>
                        <hr>
                        <p>Vektor bobot(W):</p>
                        <div>
                            Dari Tabel 3.14 diperoleh vektor bobot (W) dengan data <br>
                            $${W = 
                                \begin{pmatrix}
                                <?php for ($j = 0; $j < count($kriteria); $j++): ?>
                                    <?= $kriteria[$j]->bobot ?>
                                    <?php if ($j < count($kriteria) - 1): ?>
                                        &
                                    <?php endif; ?>    
                                <?php endfor; ?>
                                \end{pmatrix}}
                            $$
                        </div>
                        <hr>
                        <p>4. Hasil akhir dari proses perangkingan yaitu penjumlahan dari perkalian matriks ternormalisasi R dengan vektor bobot segingga diperoleh nilai terbesar yang dipilih sebagai alternatif terbaik (${A_i}$) sebagai solusi.</p>
                        <p>Melakukan proses perangkingan dengan menggunakan persamaan sebagai berikut:</p>
                        <div>
                            $${V_i = \sum_{j=i}^n W_j r_{ij}}$$
                            <strong>Keterangan :</strong><br>
                            ${V_i}$  = rangking untuk setiap alternatif <br>
                            ${W_j}$  = nilai bobot dari setiap kriteria <br>
                            ${r_{ij}}$ = nilai rating kinerja ternormalisasi <br>
                            nilai ${V_i}$ yang lebih besar mengindikasikan bahwa alternatif ${A_i}$ lebih terpilih, maka : <br> <br>
                            <?php $rank = []; ?>
                            <?php for ($i = 0; $i < count($matriks_nilai); $i++): ?>
                            <?php $multiply = []; ?>
                            ${V_<?= $i + 1 ?> = 
                                <?php for ($j = 0; $j < count($matriks_nilai[$i]); $j++): ?>
                                    (<?= $kriteria[$j]->bobot ?>)(<?= $matriks_nilai[$i][$j] ?>)
                                    <?php $multiply []= $kriteria[$j]->bobot * $matriks_nilai[$i][$j]; ?>
                                    <?php if ($j < count($matriks_nilai[$i]) - 1): ?>
                                        +
                                    <?php endif; ?>
                                <?php endfor; ?>
                            }$<br>
                            ${ =
                                <?php for ($j = 0; $j < count($multiply); $j++): ?>
                                    <?= $multiply[$j] ?>
                                    <?php if ($j < count($multiply) - 1): ?>
                                        +
                                    <?php endif; ?>
                                <?php endfor; ?>
                                = <?= array_sum($multiply) ?>
                                <?php $rank['${V_'.($i + 1).'}$'] = array_sum($multiply) ?>
                            }$<br><br>
                            <?php endfor; ?>
                            Hasil perangkingan yang diperoleh 
                            <?php foreach ($rank as $key => $value): ?>
                                <?= $key . ' = ' . $value . ', ' ?>
                            <?php endforeach; ?>
                            <?php  
                                $keys = array_keys($rank);
                                $values = array_values($rank);
                            ?>
                            Nilai terbesar ada pada <?= $keys[array_search(max($values), $values)] ?>. Dengan demikian alternatif ${A_<?= (array_search(max($values), $values) + 1) ?>}$ adalah alternatif yang terpilih sebagai alternatif terbaik. <br>
                        </div>
                        <hr>
                    </div>
                    <?php else: ?>
                    <div class="x_content">
                        Belum ada laporan penilaian. Silahkan beri nilai pelamar terlebih dahulu, kemudian hitung hasil penilaian dengan klik tombol merah yang ada di atas
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
