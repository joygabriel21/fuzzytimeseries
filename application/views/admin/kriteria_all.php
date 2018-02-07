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
                            Data  Kriteria                        </div>
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
                                        <th>Action</th>
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
                                        <td align="center">
                                            <!-- <button class="btn btn-info" data-toggle="modal" data-target="#edit" onclick="get_kriteria(<?= $row['id_kriteria'] ?>)"><i class="fa fa-edit"></i></button> -->
                                            <button class="btn btn-danger" onclick="delete_kriteria(<?= $row['id_kriteria'] ?>)"><i class="glyphicon glyphicon-trash"></i></button>
                                        
                                        </td>
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

 <!-- Add -->
        <div class="modal fade" tabindex="-1" role="dialog" id="add">
          <div class="modal-dialog" role="document">
            <?= form_open("admin/kriteria") ?>
           <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Data kriteria</h4>
              </div>
              <div class="modal-body">
                    <?php foreach ($columns as $column): ?>
                        <?php if ($column == 'id_kriteria'): ?>
                            <?php continue; ?>
                        <?php elseif($column == 'bobot'): ?>
                            <div class="form-group">
                                <label class="form-label"><?= ucwords(str_replace('_', ' ', $column)) ?></label>
                                <input type="number" step="0.01" id="<?= $column ?>" name="<?= $column ?>" class="form-control">
                            </div>
                        <?php else: ?>
                            <div class="form-group">
                                <label class="form-label"><?= ucwords(str_replace('_', ' ', $column)) ?></label>
                                <input type="text" id="<?= $column ?>" name="<?= $column ?>" class="form-control">
                            </div>
                        <?php endif ?>
                    <?php endforeach; ?>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <input type="submit" name="insert" value="Simpan" class="btn btn-primary">
              </div>
              <?= form_close() ?>            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!--/End Add -->

        
                <!-- Edit -->
        <div class="modal fade" tabindex="-1" role="dialog" id="edit">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
            <?= form_open("admin/kriteria") ?>
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Data kriteria</h4>
              </div>
              <div class="modal-body">
                    <input type="hidden" name="edit_id_kriteria" id="edit_id_kriteria">
                    <?php foreach ($columns as $column): ?>
                        <?php if ($column == 'id_kriteria'): ?>
                            <?php continue; ?>
                        <?php elseif($column == 'bobot'): ?>
                            <div class="form-group">
                                <label class="form-label"><?= ucwords(str_replace('_', ' ', $column)) ?></label>
                                <input type="number" step="0.01" id="edit_<?= $column ?>" name="<?= $column ?>" class="form-control">
                            </div>
                        <?php else: ?>
                            <div class="form-group">
                                <label class="form-label"><?= ucwords(str_replace('_', ' ', $column)) ?></label>
                                <input type="text" id="edit_<?= $column ?>" name="<?= $column ?>" class="form-control">
                            </div>
                        <?php endif ?>
                    <?php endforeach; ?>
                    
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <input type="submit" name="edit" value="Edit" class="btn btn-primary">
              </div>
              <?= form_close() ?>            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->  
        <!--/End Edit -->

<script type="text/javascript">
        $(document).ready(function() {
            $('#table').DataTable({
                responsive: true
            });
        });
        
        function get_kriteria(id_kriteria) {
            $.ajax({
                url: "<?= base_url('admin/kriteria') ?>",
                type: 'POST',
                data: {
                    id_kriteria: id_kriteria,
                    get: true
                },
                success: function(response) {
                    response = JSON.parse(response);
                    <?php foreach ($columns as $column): ?>
                    $('#edit_<?= $column ?>').val(response.<?= $column ?>);
                    <?php endforeach; ?>
                    <?php if (in_array("id_kriteria", $columns)): ?>                    
                    $('input[class="form-control"][name="id_kriteria"]').val(response.id_kriteria);
                    <?php endif; ?>                }
            });
        }
        
        
        function delete_kriteria(id_kriteria) {
            $.ajax({
                url: "<?= base_url('admin/kriteria') ?>",
                type: 'POST',
                data: {
                    id_kriteria: id_kriteria,
                    delete: true
                },
                success: function() {
                    window.location = "<?= base_url('admin/kriteria') ?>";
                }
            });   
        }
        </script>