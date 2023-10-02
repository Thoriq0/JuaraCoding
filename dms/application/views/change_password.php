<?php if (! defined('BASEPATH')) exit('No direct script access allowed');?>

<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

<section class="content-header">
    <ol class="breadcrumb">
        <li><a href="<?= site_url('home'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Change Password</li>
    </ol>
</section><br/>

<section class="content">

    <!-- begin row -->
    <div class="row">
        <!-- begin col-12 -->
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <nav class="navbar navbar-inverse navbar-submenu" >
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#module-submenu" aria-expanded="false">
                                  <span class="sr-only">Toggle navigation</span>
                                  <span class="icon-bar"></span>
                                  <span class="icon-bar"></span>
                                  <span class="icon-bar"></span>
                                </button>
                                <a class="navbar-brand" href="<?php echo site_url('/user/change_password'); ?>">Change Password</a>
                            </div>
                        </div>
                    </nav>
                </div>
                <!-- end box-header -->

                <div class="box-body">
                    <!-- begin panel-body -->
                    <div class="panel-body">
                        <?php echo form_open('user/change_password'); ?>
                        <div class="form-group">
                            <label>Old Password : <span style="color:red;">*</span></label>
                            <input type="password" name="old_password" value="<?php echo set_value('old_password') ?>" class="form-control" required />
                            <?php echo form_error('old_password');?>
                        </div>
                        <div class="form-group">
                            <label>New Password : <span style="color:red;">*</span></label>
                            <input type="password" name="new_password" value="<?php echo set_value('new_password') ?>" class="form-control" required />
                            <?php echo form_error('new_password');?>
                        </div>
                        <div class="form-group">
                            <label>Password Confirmation : <span style="color:red;">*</span></label>
                            <input type="password" name="password_conf" value="<?php echo set_value('password_conf') ?>" class="form-control" required />
                            <?php echo form_error('password_conf');?>
                        </div>

                        <input type="submit" name="submit" value="Submit" class="btn btn-primary" />
                        
                        <?php echo form_close(); ?>
                    </div>
                    <!-- end panel-body -->
                </div>

            </div>
            <!-- end box -->
        </div>
        <!-- end col-12 -->
    </div>
    <!-- end row -->

</section>