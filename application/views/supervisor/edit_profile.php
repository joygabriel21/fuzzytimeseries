<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3 class="page-header">Edit Profile</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <?= $this->session->flashdata('msg') ?>
                        <?= form_open('supervisor/edit-profile') ?>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control" value="<?= $username ?>">
                            </div>
                            <div class="form-group">
                                <label for="old_password">Old Password</label>
                                <input type="password" name="old_password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="new_password">New Password</label>
                                <input type="password" name="new_password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="confirm_new_password">Confirm New Password</label>
                                <input type="password" name="confirm_new_password" class="form-control">
                            </div>
                            <input type="submit" name="submit" value="Edit" class="btn btn-primary">
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
