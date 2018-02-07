<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3 class="page-header">
                Kriteria
                </h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Data  Kriteria
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <?= $this->session->flashdata('msg') ?>
                        <style type="text/css">
                        tr th, tr td {text-align: center;}
                        </style>
                        
                        <!-- <button type="button" class="btn btn-default" data-toggle="modal" data-target="#add"><i class="glyphicon glyphicon-plus"></i> Tambah</button><hr> -->
                        
                        <table class="table table-bordered table-striped table-hover" id="table">
                            <thead>
                                <tr>
                                    <?php foreach ($columns as $column): ?>
                                    <th>
                                        <?php if ($column == 'id_kriteria'): ?>
                                        #
                                        <?php else: ?>
                                        <?= ucwords(str_replace("_", " ", $column)) ?>
                                        <?php endif ?>
                                    </th>
                                    <?php endforeach; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $row): ?>
                                <tr>
                                    <?php $i=0; foreach ($columns as $column): ?>
                                    <td>
                                        <?php $row = (array)$row; ?>
                                        <?= $row[$column] ?>
                                        
                                    </td>
                                    <?php endforeach; ?>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
    </div>
</div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#table').DataTable({
            responsive: true
        });
    });
</script>