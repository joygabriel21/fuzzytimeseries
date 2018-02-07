<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3 class="page-header">Input Data Pelamar</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <style type="text/css">.required{color: red;}</style>
                        <?= $this->session->flashdata('msg') ?>
                        <?= form_open('admin/input-data-pelamar') ?>
                            <div class="form-group">
                                <label for="Nama">Nama<span class="required">*</span></label>
                                <input type="text" class="form-control" name="nama" required>
                            </div>
                            <div class="form-group">
                              <label for="jk">Jenis Kelamin<span class="required">*</span></label>
                              <select class="form-control" name="jk" required>
                                <option>-- PILIH JENIS KELAMIN --</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                              </select>
                            </div>
                            <div class="form-group">
                                <label for="Tempat Lahir">Tempat Lahir<span class="required">*</span></label>
                                <input type="text" class="form-control" name="tempat_lahir" required>
                            </div>
                            <div class="form-group">
                                <label for="Tanggal Lahir">Tanggal Lahir<span class="required">*</span></label>
                                <input type="text" id="single_cal2" class="form-control" name="tgl_lahir" required>
                            </div>
                            <div class="form-group">
                                <label for="Nomor HP">Nomor HP<span class="required">*</span></label>
                                <input type="text" class="form-control" name="no_hp" required>
                            </div>
                            <div class="form-group">
                                <label for="Email">Email<span class="required">*</span></label>
                                <input type="text" class="form-control" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="Alamat">Alamat<span class="required">*</span></label>
                                <textarea class="form-control" rows="3" name="alamat" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="Upload Foto">Upload Foto<span class="required">*</span></label>
                                <input type="file" name="foto" required>
                            </div>
                            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
