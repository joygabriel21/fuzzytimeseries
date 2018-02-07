      <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <center>
              <img src="<?= base_url('assets/web-img/logo.jpg') ?>">
            </center>
            <hr>
            <div class="row top_tiles">
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a href="<?= base_url('admin/daftar-pelamar') ?>">
                  <div class="tile-stats">
                    <div class="icon"><i class="fa fa-users"></i></div>
                    <div class="count"><?= count($pelamar) ?></div>
                    <h3>Daftar Pelamar</h3>
                  </div>
                </a>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a href="<?= base_url('admin/ranking-penilaian') ?>">
                  <div class="tile-stats">
                    <div class="icon"><i class="fa fa-line-chart"></i></div>
                    <div class="count"><?= count($hasil) ?></div>
                    <h3>Ranking Pelamar</h3>
                  </div>
                </a>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a href="<?= base_url('admin/kriteria') ?>">
                  <div class="tile-stats">
                    <div class="icon"><i class="fa fa-list"></i></div>
                    <div class="count"><?= count($kriteria) ?></div>
                    <h3>Data Kriteria</h3>
                  </div>
                </a>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a href="<?= base_url('admin/user') ?>">
                  <div class="tile-stats">
                    <div class="icon"><i class="fa fa-database"></i></div>
                    <div class="count"><?= count($pengguna) ?></div>
                    <h3>Data Pengguna</h3>
                  </div>
                </a>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a href="<?= base_url('admin/input-data-pelamar') ?>">
                  <div class="tile-stats">
                    <div class="icon"><i class="fa fa-user-plus"></i></div>
                    <div class="count">#</div>
                    <h3>Input Data Pelamar</h3>
                  </div>
                </a>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a href="<?= base_url('admin/input-data-kriteria') ?>">
                  <div class="tile-stats">
                    <div class="icon"><i class="fa fa-list-alt"></i></div>
                    <div class="count">#</div>
                    <h3>Input Data Kriteria</h3>
                  </div>
                </a>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a href="<?= base_url('admin/perhitungan') ?>">
                  <div class="tile-stats">
                    <div class="icon"><i class="fa fa-calculator"></i></div>
                    <div class="count">#</div>
                    <h3>FSAW</h3>
                  </div>
                </a>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->