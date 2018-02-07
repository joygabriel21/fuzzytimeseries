<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3 class="page-header">Input Data Kriteria</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <style type="text/css">.required{color: red;}</style>
                        <?= $this->session->flashdata('msg') ?>
                        <?= form_open('admin/input-data-kriteria') ?>
                            <div class="form-group">
                                <label for="nama">Nama<span class="required">*</span></label>
                                <input type="text" name="nama" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="benefit">Benefit<span class="required">*</span></label>
                                <input type="text" name="benefit" class="form-control" required="">
                            </div>
                            <div class="form-group">
                                <label for="bobot">Bobot<span class="required">*</span></label>
                                <input type="number" step="0.01" name="bobot" class="form-control" required>
                            </div>
                            <h5><strong>Bobot Nilai</strong><span class="required">*</span> <button class="btn btn-success" type="button" onclick="tambah_bobot();"><i class="fa fa-plus"></i></button></h5>
                            <div id="bobot-container">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="fuzzy">Fuzzy<span class="required">*</span></label>
                                        <input type="text" name="fuzzy[]" class="form-control" placeholder="ex: Memadai" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="nilai">Nilai<span class="required">*</span></label>
                                        <input type="number" step="any" name="nilai[]" class="form-control" required>
                                    </div>    
                                </div>
                            </div>
                            <br>
                            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function tambah_bobot() {
        $('#bobot-container').append('<div class="row">' +
            '<div class="col-md-6">' +
                '<label for="fuzzy">Fuzzy<span class="required">*</span></label>' +
                '<input type="text" name="fuzzy[]" class="form-control" placeholder="ex: Memadai" required>' +
            '</div>' +
            '<div class="col-md-6">' +
                '<label for="nilai">Nilai<span class="required">*</span></label>' +
                '<input type="number" step="any" name="nilai[]" class="form-control" required>' +
            '</div>' +    
        '</div>');
    }
</script>