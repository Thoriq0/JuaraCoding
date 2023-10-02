
<!-- Content Header (Page header) -->

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<section class="content-header">
  <h1>
	Dokumen Internal
  </h1>
<ol class="breadcrumb">
	<li><a href="<?= site_url('home'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
	<li>Dokumen Internal</li>
</ol>
</section>
<!--
<section class="content-header">
     <h1>
        Tombol untuk menampilkan modal
        <a class="btn btn-primary" href="<?php echo site_url('pages/add'); ?>"><i class="fa fa-plus"></i> &nbsp; Tambah Data</a>
        <?php echo $this->session->flashdata('message'); ?>
    </h1>  

   
    <ol class="breadcrumb">
        <li><a href="<?= site_url('home'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Dokumen Internal</li>
    </ol>
</section><br/>
-->

<!-- Main content -->
<section class="content">
    <div class="row">


        <div class="col-xs-12">

            <div class="box">
                <div class="box-header">
					<!-- <h3 class="box-title">Data Arsip</h3> -->
					<nav class="navbar navbar-inverse navbar-submenu">
					<div class="container-fluid">
						<!-- Brand and toggle get grouped for better mobile display -->
						<div class="navbar-header">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#module-submenu" aria-expanded="false">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span> 
							<span class="icon-bar"></span>
							<span class="icon-bar"></span> 
							</button>
						</div>
						
						<form class="navbar-form navbar-left width-half-full" method="get" action="<?php echo site_url('/admin/list_internal_dokumen'); ?>">
						<table>
							<tr> 
								<td style="color:white;"><h4>Pencarian : &nbsp;</h></td><td></td>
							</tr>
							<tr>
								<td style="color:white;">Nomor Dokumen &nbsp;</td><td><input type="text" name="no"  placeholder="" /></td>
							</tr>
							<tr>
								<td style="color:white;">Nama Dokumen &nbsp;</td><td><input type="text" name="nama"  placeholder="" /></td>
							</tr>
                            <tr>
                                <td style="color:white;">Departemen &nbsp;</td>
                                <td>
                                    <select style="width: 100%; height: 25px;" id="dept_id" name="dept_id" >
                                        <option style="text-align: center;" value="">All</option>
                                        <?php
                                            if(isset($deptID)){
                                                foreach($deptID as $k) {
                                                    echo "<option value='".$k['id']."' >".$k['nama_departemen']."</option>";
                                                }
                                            }
                                        ?>
                                    </select>
                                </td>
                            </tr>
							<tr>
								<td style="color:white;"></td><td><button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-search"></i> Filter</button></td>
							</tr>
						</table>						
						</form>
					</div>
                
            </nav>
              
            <?php echo $this->session->flashdata('zz'); ?>
            
            <!-- <div class="panel panel-default panel-hidden collapse" id="advanced-search">
                <div class="panel-heading"><h3 class="panel-title">Filter Pencarian</h3></div>
                <div class="panel-body">

                <nav class="navbar">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#module-submenu" aria-expanded="false">
                        </button>
                        <a class="navbar-brand" >Departemen</a>
                    </div>

                    <form class="navbar-form navbar-left width-half-full" method="get" action="<?php echo site_url('/admin/list_internal_dokumen'); ?>">
                        <div class="input-group width-full">
                            <select id="dept_id" name="dept_id" class="form-control" >
                                <option value="">All</option>
                                <?php
                                    if(isset($deptID)){
                                        foreach($deptID as $k) {
                                            echo "<option value='".$k['id']."' >".$k['nama_departemen']."</option>";
                                        }
                                    }
                                ?>
                            </select>
                            <span class="input-group-btn">
                            <button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-filter"></i></button></span>
                        </div>
                    </form>
                </nav>

                </div>
                <!-- ./panel body --
            </div> -->
            <!-- div header -->

            <!-- <div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-check"></i> Success!</h4>
				</div> -->
            
            <?php
            echo $this->session->flashdata('message'); 
            ?>

            
            <div class="well well-sm">
              <div class="row">
                <div class="col-xs-9">Jumlah : <?php echo number_format($jml); ?> dokumen</div>
                <div class="col-xs-3 text-right"></div>
              </div>
            </div>

            </div><!-- /.box-header -->
                <div class="box-body">
				<span class="input-group-btn">
					<button type="button" class="btn btn-primary" onclick="window.location.href='admin/input_internal_doc';">Input Data</button></br>
				</span></br>
                <div class="row">
                                    
                   <div class="col-md-12" id="divtabeldoc">

                   <table id="table" class="table table-responsive table-bordered table-striped" name="vintdoc" id="vintdoc">
                        <thead>
                            <tr>	
									<th></th>
									<th>Nomor Dokumen</th>
									<th>Nama Dokumen</th>
                                    <th>Departemen</th>
                                    <th>Tgl. Dokumen</th>
									<th>Tgl. Input</th>
						            <th>Group Dokumen</th>
									<!--<th>Deskripsi</th>-->
									<!--<th>Owner Dokumen</th>-->
									<th>Status</th>
									<th>Share</th>
							
						            <th style="text-align:center">Action</th>

                            </tr>
                        </thead>

                        <tbody>
                        <?php
						$no=1;
                        // $start;
						foreach($data as $a) {
							echo "<tr>";
							echo "<td>".++$start."</td>";
							// echo "<td>".$no++."</td>";
							echo "<td>".$a['no_dokumen']."</td>";
							echo "<td>".$a['nama_dokumen']."</td>";
                            if(!empty($deptID)){
                                if ($a['id_departemen']==0) {
                                    echo "<td>-</td>";
                                }else{
                                    foreach ($deptID as $d) {
                                        if ($a['id_departemen']==$d['id']) {
                                            echo "<td>".$d['nama_departemen']."</td>";
                                        }
                                    }
                                }
                            }else{
                                echo "<td>-</td>";
                            }
							echo "<td>".$a['tgl_dokumen']."</td>";
							echo "<td>".$a['tgl_input']."</td>";
							echo "<td>".$a['group_dokumen']."</td>";
							//echo "<td>".$a['deskripsi']."</td>";
							//echo "<td>".$a['owner_dokumen']."</td>";
							
							if($a['is_status']=="1") {
								echo "<td>Aktif</td>";
							}else {
								echo "<td>Tidak Aktif</td>";
							}
							if($a['is_status']=="1") {
								echo "<td>Ya</td>";
							}else {
								echo "<td>Tidak</td>";
							}
							/*
							echo "<td>".$a['tanggal']."</td>";
							echo "<td>".$a['nama_kode']."</td>";
							echo "<td>".$a['uraian']."</td>";
							echo "<td>".$a['ket']."</td>";
							if($a['file']=="") {
								echo "<td></td>";
							}else {
								echo "<td><a href='".base_url('files/'.$a['file'])."' target='_blank'><span class='glyphicon glyphicon-save' aria-hidden='true'></span></a></td>";
							}
							echo "<td>".$a['jumlah']."</td>";
							echo "<td>".$a['nobox']."</td>";
							echo "<td ".($a['f']=='sudah'?"class='danger'":"").">".$a['b']."</td>";
							*/
							echo "<td><a href='".site_url('admin/view/'.$a['id'])."' ><span class='btn btn-xs btn-primary'><i class='fa fa-md fa-search' ></i> View</span></a>
								&nbsp
								<a href='".site_url('/admin/vedit/'.$a['id'])."'><span class='btn btn-xs btn-warning'><i class='fa fa-md fa-pencil' ></i> Edit</span></a>
								</td>";
							echo "</tr>";
							// $no++;
							
							//&nbsp	
							//<a onClick=\"setiduser(this.id)\" data-toggle=\"modal\" data-target=\"#deldata\" class='deldata' href='#' id='".$a['id']."'><span class='btn btn-xs btn-danger'><i class='fa fa-md fa-trash' ></i> Delete</span></a>
						}
					?>
                        </tbody>
                    </table>
         <!-- awal modal-->
        

         <?php
echo $pages;
?>
            <!-- <div class="well well-sm">
    		  <div class="row">
                <div class="col-xs-9">Jumlah : <?php echo number_format($jml); ?> dokumen</div>
    		    <div class="col-xs-3 text-right"></div>
    		  </div>
            </div> -->

<div class="modal fade" id="deldata">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Delete Data</h4>
      </div>
	  <div class="modal-body">
		<form id="fdeldatadoc" class="form-horizontal" role="form" method="post" action="<?php echo site_url("/admin/delete_internal_dokumen"); ?>">
			<h4 class="modal-title">Yakin ingin Hapus Data ini?</h4>
            <input type="hidden" name="id" id="deliddata" value="">
		</form>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="deldataint">Hapus</button>
	  </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>

                   </div> 
                
                </div>

        <!-- batas modal-->

        
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<script type="text/javascript">
    function setiduser(iduser) {
        // alert(iduser);
        //delete
        $('#deliddata').val(iduser);

        //edit
        // $('#edidpenc').val(iduser);
    }
    

    function fdeldata() {
        document.getElementById("fdeldata").submit();
    }

    /*$("#divtabeldoc").on("click", ".deldata", function() {
        var d = $(this).attr("id");
        $("#deliddata").val(d);
    });

    $("#deldatago").on("click", function() {
        // alert('BOSSS')
        $("#fdeldata").submit();
    });

    $("#fdeldata").ajaxForm({ success: deldata });
    function deldata() {
        alert("Data telah sukses dihapus");
        $("#deldata").modal("hide");
        // reloadpeng();
        location.reload();
    }*/

/*  $("#divtabeldoc").on("click", ".edpenc", function() {
    var d = $(this).attr("id");
    $.ajax({
      type: "POST",
      url: "<?php echo site_url("/admin/apenc"); ?>",
      data: "id=" + d,
      cache: false,
      success: function(ahtml) {
        html = jQuery.parseJSON(ahtml);
        $("#enama").val(html.nama_pencipta);
        $("#edidpenc").val(html.id);
      }
    });
  });*/
</script>





