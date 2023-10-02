<!-- Logo -->

<a href="<?php echo site_url(); ?>" class="logo">
  <!-- mini logo for sidebar mini 50x50 pixels -->
  <!-- <span class="logo-mini"><b>HRD</b></span> -->
  <!-- logo for regular state and mobile devices -->

  <!-- <span class="logo-lg"><b>DPBCA</b></span> -->
  <span class="logo-mini"><b>DMS</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>DMS</b></span>

</a>
<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top">
  <!-- Sidebar toggle button-->
  <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
    <span class="sr-only">Toggle navigation</span>
  </a>

  <div class="navbar-custom-menu">
    <ul class="nav navbar-nav">

      <!-- User Account: style can be found in dropdown.less -->
      <li class="dropdown user user-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <!-- <img src="<?php echo base_url()?>/public/dist/img/profile.png" class="user-image" alt="User Image"> -->
          <!-- <span class="hidden-xs"><?php echo $this->session->userdata('realname'); ?></span> -->
          <?php
            if (isset($_SESSION['username'])) {
                echo "<li><a href=\"#\"><span class=\"glyphicon glyphicon-user\"></span> " . $_SESSION['nama'] . "</a></li>";
                
            } else {
                echo "<li><a href=\"" . site_url('home/login') . "\"><span class=\"glyphicon glyphicon-log-in\"></span> Login</a></li>";
            }
          ?>
          <span class="hidden-xs"></span>
          <!--<span class="pull-right-container">
            <i class="fa fa-angle-down pull-right"></i>
          </span>-->
        </a>
        <!-- <ul class="dropdown-menu">
          <li class="user-body">
            <a href="<?php echo site_url('profile/update_profile/'.$this->session->userdata('user_id')); ?>"><i class="fa fa-user"></i>Profile</a>
          </li>
          <li class="user-body">
            <a href="<?php echo site_url('profile/change_password/'.$this->session->userdata('user_id')); ?>"><i class="fa fa-key"></i>Change Password</a>
          </li>
          <li class="user-body">
            <a href="<?php echo site_url('logout'); ?>"><i class="fa fa-sign-out"></i>Logout</a>
          </li>
        </ul> -->
      </li>
    </ul>
  </div>
</nav>