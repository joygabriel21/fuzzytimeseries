<!-- page content -->
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3 class="page-header">Daftar User <button class="btn btn-success" data-toggle="modal" data-target="#add"><i class="fa fa-plus"></i></button>
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
							<h2>Daftar User</h2>
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
							<th>Username</th>
							<th>Hak Akses</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1; foreach ($user as $row): ?>
						<tr>
							<td><?= $i ?></td>
							<td><?= $row->username ?></td>
							<td>Admin</td>
							<td>
								<div class="btn-group">
									<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
									Aksi <span class="caret"></span></button>
									<ul class="dropdown-menu" role="menu">
										<li><a href="#" data-toggle="modal" data-target="#edit" onclick="get_data('<?= $row->id_user ?>')"><i class="fa fa-pencil"></i> Edit</li>
										<li><a href="" onclick="delete_data(<?= $row->id_user ?>, 'Admin')"><i class="fa fa-trash"></i> Hapus </a></li>
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
	<?= form_open_multipart('admin/user') ?>
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title">Tambah User</h4>
		</div>
		<div class="modal-body">
			<div class="form-group">
				<label for="Username">Username *</label>
				<input type="text" class="form-control" name="username" required>
			</div>
			<div class="form-group">
				<label for="Role">Role</label>
				<select name="role" class="form-control" required>
					<option>Select role</option>
					<option value="Admin">Admin</option>
					<option value="Supervisor">Supervisor</option>
				</select>
			</div>
			<div class="form-group">
				<label for="Password">Password *</label>
				<input type="password" class="form-control" name="password1" required>
			</div>
			<div class="form-group">
				<label for="Konfirmasi Password">Konfirmasi Password *</label>
				<input type="password" class="form-control" name="password2" required>
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
		<div class="modal fade" tabindex="-1" role="dialog" id="edit">
			<div class="modal-dialog modal-sm" role="document">
				<?= form_open('admin/user') ?>
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Edit User</h4>
					</div>
					<input type="hidden" name="id_user" id="edit_id_user">
					<div class="modal-body">
						<div class="form-group">
							<label for="Username">Username *</label>
							<input type="text" class="form-control" name="edit_username" id="edit_username" required>
						</div>
						<div class="form-group">
							<label for="Password">Password *</label>
							<input type="password" class="form-control" name="password1" required>
						</div>
						<div class="form-group">
							<label for="Konfirmasi Password">Konfirmasi Password *</label>
							<input type="password" class="form-control" name="password2" required>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
						<input type="submit" name="edit" value="Edit" class="btn btn-primary">
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

                function get_data(id_user) {
                  $.ajax({
                      url: '<?= base_url('admin/user') ?>',
                      type: 'POST',
                      data: {
                          id_user: id_user,
                          get: true
                      },
                      success: function(response) {
                          response = JSON.parse(response);
                          $('#edit_username').val(response.username);
                          $('#edit_id_user').val(id_user);
                      },
                      error: function(e) {console.log(e.responseText);}
                  });
                }

                function delete_data(id_user) {
                    $.ajax({
                        url: '<?= base_url('admin/user') ?>',
                        type: 'POST',
                        data: {
                            id_user: id_user,
                            delete: true
                        },
                        success: function() {
                            window.location = '<?= base_url('admin/user') ?>';
                        }
                    });
                }
            </script>