<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- <meta name="robots" content="noindex"> -->
  <meta content="" name="description" />
  <meta content="" name="author" />
  <title>DIKA | DOKUMEN</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <base href="<?php echo base_url(); ?>" />
  <!-- Jquery.UI -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>public/bootstrap/css/jquery-ui.min.css">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>public/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/all.min.css"> -->
  <!-- Animate -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>public/plugins/animate/animate.min.css">
  <!-- default -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>public/default/css/style.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>public/default/css/style-responsive.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>public/default/css/theme/default.css" id="theme">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>public/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>public/plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <!-- ================== BEGIN BASE JS ================== -->
  <script src="<?php echo base_url(); ?>public/plugins/pace/pace.min.js"></script>
  <!-- ================== END BASE JS ================== -->

  <script type="text/javascript">
    window.onload = function() {
      document.getElementById("username").focus();
    }
  </script>

</head>

<body class="pace-top bg-white">

  <?php
  // just for info
  if (isset($login_info)) {
    echo '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-ban"></i> Alert!</h4>';
    echo $login_info;
    echo "</div>";
  }
  ?>

  <!-- begin #page-loader -->
  <!-- <div id="page-loader" class="fade show"><span class="spinner"></span></div> -->
  <!-- end #page-loader -->

  <!-- begin login-cover -->
  <div class="login-cover">
    <div class="login-cover-image" style="background-image: url(<?php echo base_url(); ?>public/images/dms.jpg)" data-id="login-cover-image"></div>
    <div class="login-cover-bg"></div>
  </div>
  <!-- end login-cover -->

  <!-- begin #page-container -->
  <div id="page-container" class="fade">
    <!-- begin login -->
    <div class="login login-v2" data-pageload-addclass="animated fadeIn">
      <!-- begin brand -->
      <div class="login-header">
        <div class="brand">
          <span class="logo"></span> <b>DIKA | DOKUMEN</b>
          
          <?php if ($this->session->flashdata('erorlogin')) { ?>
            <small style="color:#FA5858;"><?php echo $this->session->flashdata('erorlogin'); ?></small>
          <?php } ?>
        </div>
        <div class="icon">
          <i class="fa fa-lock"></i>
        </div><br>
        <?php
          // just for info
          if (isset($login_info)) {
            echo "<div class='alert alert-danger alert-dismissable'>";
            echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
            echo $login_info;
            echo "</div";
          }
          ?>
      </div> 
      <!-- end brand -->
      <!-- begin login-content -->
      <div class="login-content">
        <form action="<?php echo site_url('/home/login'); ?>" method="POST" class="margin-bottom-0" id="login">
          <div class="form-group m-b-20">
            <label>USER NAME :</label>
            <input type="text" id="username" name="username" class="form-control form-control-lg" placeholder="User" autocomplete="off" required />
          </div>
          <div class="form-group m-b-20">
            <label>PASSWORD :</label>
            <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Password" required />
          </div>
          <div class="login-buttons">
            <button type="submit" class="btn btn-success btn-block btn-lg">Login</button>
          </div>
        </form>
      </div>
      <!-- end login-content -->
    </div>
    <!-- end login -->
  </div>
  <!-- end #page-container -->

  <!-- <form action="<?php echo site_url('/home/gologin'); ?>" method="post" id="login">
      <div class="form-group has-feedback">
        <input type="text" name="username" id="username" class="form-control" placeholder="Username" autocomplete="off">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" id="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-4">
          <input type="submit" name="submit" id="button" value="Login" class="btn btn-primary btn-block btn-flat">
        </div>
      </div>
    </form> -->

  <!-- ================== BEGIN BASE JS ================== -->
  <script src="<?php echo base_url(); ?>public/plugins/jQuery/jquery-2.2.3.min.js"></script>
  <script src="<?php echo base_url(); ?>public/plugins/jQueryUI/jquery-ui.min.js"></script>
  <script src="<?php echo base_url(); ?>public/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo base_url(); ?>public/plugins/slimScroll/jquery.slimscroll.min.js"></script>
  <script src="<?php echo base_url(); ?>public/plugins/js-cookie/js.cookie.js"></script>
  <script src="<?php echo base_url(); ?>public/default/js/theme/default.min.js"></script>
  <script src="<?php echo base_url(); ?>public/default/js/apps.min.js"></script>
  <!-- ================== END BASE JS ================== -->
  <script>
    $(document).ready(function() {
      App.init();
    });
  </script>
</body>

</html>