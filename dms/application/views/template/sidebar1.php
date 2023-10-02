<section class="sidebar">
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li>
            <a href="<?php echo site_url('homes'); ?>">
                <i class="fa fa-home"></i> <span>Home</span>
            </a>
        </li>
		<?php
        if ($_SESSION['tipe']=='admin') {
        echo    '<li class="treeview ">
                    <a href="#">
                        <i class="fa fa-clipboard"></i> <span>Data Master</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">';
    
                //if (isset($_SESSION['akses_modul']['klasifikasi']) && $_SESSION['akses_modul']['klasifikasi'] == 'on') {
				if ($_SESSION['tipe']=='admin') {
                    echo "<li><a href=\"" . site_url('master/group_documents') . "\"><i class=\"glyphicon glyphicon-tag\"></i> Group Documents</a></li>";
                }
                if ($_SESSION['tipe']=='admin') {
                    echo "<li><a href=\"" . site_url('master/departemen') . "\"><i class=\"glyphicon glyphicon-home\"></i> Departemen</a></li>";
                }
                if ($_SESSION['tipe']=='admin') {
                    echo "<li><a href=\"" . site_url('master/lokasi') . "\"><i class=\"glyphicon glyphicon-map-marker\"></i> Lokasi Penyimpanan</a></li>";
                }
                if ($_SESSION['tipe']=='admin') {
                    echo "<li><a href=\"" . site_url('master/media') . "\"><i class=\"glyphicon glyphicon-film\"></i> Media</a></li>";
                }
                if ($_SESSION['tipe']=='admin') {
                    echo "<li><a href=\"" . site_url('master/vuser') . "\"><i class=\"glyphicon glyphicon-user\"></i> User</a></li>";
                }
                if ($_SESSION['tipe']=='admin') {
                    echo "<li><a href=\"" . site_url('master/tingkat_akses') . "\"><i class=\"glyphicon glyphicon-folder-open\"></i> Tingkat Akses</a></li>";
                }
                if ($_SESSION['tipe']=='admin') {
                    echo "<li><a href=\"" . site_url('master/template') . "\"><i class=\"glyphicon glyphicon-asterisk\"></i> Template</a></li>";
                }
         
        echo    '</ul>
            </li>';
        }
        ?>
		
		<?php
        if (isset($_SESSION['menu_master'])) {        
        echo    '<li class="treeview ">
                    <a href="#">
                        <i class="fa fa-clipboard"></i> <span>Internal Dokumen</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">';
    
                if ($_SESSION['tipe']=='user' || $_SESSION['tipe']=='admin') {
                    echo "<li><a href=\"" . site_url('admin/input_internal_doc') . "\"><i class=\"glyphicon glyphicon-tag\"></i> Add New</a></li>";
                }
				if ($_SESSION['tipe']=='user' || $_SESSION['tipe']=='admin') {
                    echo "<li><a href=\"" . site_url('admin/list_internal_dokumen') . "\"><i class=\"glyphicon glyphicon-tag\"></i> List Dokumen</a></li>";
                }


         
        echo    '</ul>
            </li>';
        }
        ?>
		
		<?php
        if (isset($_SESSION['menu_master'])) {        
        echo    '<li class="treeview ">
                    <a href="#">
                        <i class="fa fa-clipboard"></i> <span>External Dokumen</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">';
    
                if ($_SESSION['tipe']=='user' || $_SESSION['tipe']=='admin') {
                    echo "<li><a href=\"" . site_url('admin/input_external_doc') . "\"><i class=\"glyphicon glyphicon-tag\"></i> Add New</a></li>";
                }
				if ($_SESSION['tipe']=='user' || $_SESSION['tipe']=='admin') {
                    echo "<li><a href=\"" . site_url('admin/list_external_dokumen') . "\"><i class=\"glyphicon glyphicon-tag\"></i> List Dokumen</a></li>";
                }


         
        echo    '</ul>
            </li>';
        }
        ?>
		
       <?php
      
		if (isset($_SESSION['akses_modul']['sirkulasi']) && $_SESSION['akses_modul']['sirkulasi'] == 'on') {
			echo '<li><a href="' . site_url('/sirkulasi') . '"> <i class="fa fa-spinner"></i> <span>Sirkulasi</span></a></li>';
		}
        ?>

        <!-- <li >
            <a href="">
                <i class="fa fa-edit"></i> <span>Entri Data Baru</span>
            </a>
        </li>

        <li >
            <a href="">
                <i class="fa fa-spinner"></i> <span>Sirkulasi</span>
            </a>
        </li> -->

    
        <!-- <li class="treeview ">
            <a href="#">
                <i class="fa fa-clipboard"></i> <span>Data Master</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu"> -->
                <!-- <li>
                    <a href="<?php //echo site_url('admin/klas'); ?>">
                        <i class="fa fa-circle-o"></i>
                        <i class="glyphicon glyphicon-tag"></i>Klasifikasi
                    </a>
                </li>
                <li >
                    <a href="<?php //echo site_url('admin/penc'); ?>">
                        <i class="fa fa-circle-o"></i>
                        <i class="glyphicon glyphicon-home"></i> Pencipta Arsip
                    </a>
                </li>
                <li >
                    <a href="<?php //echo site_url('admin/pengolah'); ?>">
                        <i class="fa fa-circle-o"></i>
                        <i class="glyphicon glyphicon-home"></i> Unit Pengolah
                    </a>
                </li>
                <li >
                    <a href="<?php //echo site_url('admin/lokasi'); ?>">
                        <i class="fa fa-circle-o"></i> 
                        <i class="glyphicon glyphicon-map-marker"></i> Lokasi
                    </a>
                </li>
                <li >
                    <a href="<?php //echo site_url('admin/media'); ?>">
                        <i class="fa fa-circle-o"></i>
                        <i class="glyphicon glyphicon-film"></i> Media
                    </a>
                </li>
                <li >
                    <a href="<?php //echo site_url('admin/vuser'); ?>">
                        <i class="fa fa-circle-o"></i>
                        <i class="glyphicon glyphicon-user"></i> User
                    </a>
                </li>
                <li >
                    <a href="<?php //echo site_url('admin/import'); ?>">
                        <i class="fa fa-circle-o"></i>  
                        <i class="glyphicon glyphicon-tasks"></i>Import Data
                    </a>
                </li> -->
       

       

        <?php
            if (isset($_SESSION['username'])) {
                
                echo "<li><a href=\"" . site_url('home/logout') . "\"><i class=\"fa fa-sign-out\"></i> <span>Logout</span></a></li>";
            // } else {
            //     echo "<li><a href=\"" . site_url('home/login') . "\"><span class=\"glyphicon glyphicon-log-in\"></span> Login</a></li>";
            }
          ?>
      

        <!-- <li>
            <a href="<?php echo site_url('logout'); ?>">
                <i class="fa fa-sign-out"></i> <span>Logout</span>
            </a>
        </li> -->
    </ul>
</section>
<!-- /.sidebar -->