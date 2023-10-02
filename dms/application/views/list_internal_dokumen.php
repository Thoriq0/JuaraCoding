
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
        <a class="btn btn-primary" href="<?php //echo site_url('pages/add'); ?>"><i class="fa fa-plus"></i> &nbsp; Tambah Data</a>
        <?php //echo $this->session->flashdata('message'); ?>
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
						
                        <!-- <form class="navbar-form navbar-left width-half-full" method="get" action="<?php //echo site_url('/admin/list_internal_dokumen'); ?>"> -->
                        <div class="col-xs-3">
    						<table>
    							<tr> 
    								<td style="color:white;"><h4>Pencarian : &nbsp;</h></td><td></td>
    							</tr>
    							<tr>
    								<td style="color:white; width: 100%;">Nomor Dokumen &nbsp;</td><td><input type="text" id="nodokint" name="nodokint"  placeholder="" /></td>
    							</tr>
    							<tr>
    								<td style="color:white; width: 100%;">Nama Dokumen &nbsp;</td><td><input type="text" id="nama" name="nama"  placeholder="" /></td>
    							</tr>
                                <tr>
                                    <td style="color:white;">Departemen &nbsp;</td>
                                    <td>
                                        <select style="width: 100%; height: 25px;" id="dept_id" name="dept_id" >
                                            <option style="text-align: center;" value="">All</option>
                                            <?php 
                                                if(isset($deptID)){
                                                    foreach($deptID as $k) {
                                                        echo "<option value='".$k['id']/*$k->Division*/."' >".$k['nama_departemen']/*$k->Division*/."</option>";
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color:white;">Ketersedian File &nbsp;</td>
                                    <td>
                                        <select style="width: 100%; height: 25px;" id="file_exist" name="file_exist" >
                                            <option style="text-align: center;" value="">All</option>
                                            <option style="text-align: center;" value="2">Belum Ada</option>
                                            <option style="text-align: center;" value="1">Ada</option>
                                        </select>
                                    </td>
                                </tr>
    							<tr>
    								<td style="color:white;"></td><td><button id="btnFilter" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i> Filter</button></td>
    							</tr>
    						</table>						
                        </div>
						<!-- </form> -->
					</div>
                
            </nav>
              
            <?php echo $this->session->flashdata('zz'); ?>
            
            
            <?php
            echo $this->session->flashdata('message');
            ?>

            
            <div class="well well-sm">
              <div class="row">
                <div class="col-xs-9">Jumlah : <i id='jml'></i> dokumen</div>
                <div class="col-xs-3 text-right"></div>
              </div>
            </div>

            </div><!-- /.box-header -->
                <div class="box-body">
				<span class="input-group-btn">
					<button type="button" class="btn btn-primary" onclick="window.location.href='admin/input_internal_doc';">Input Data</button></br>
				</span></br>
                <div class="row">
                                    
                   <div class="col-md-12" id="divtabeldoc" class="table-responsive">

                   <table class="table table-bordered table-striped" name="vintdoc" id="vintdoc">
                        <thead>
                            <tr>	
									<th>No</th>
									<th>Nomor Dokumen</th>
									<th>Nama Dokumen</th>
                                    <th>Departemen</th>
                                    <th>Tgl. Dokumen</th>
									<th>Tgl. Input</th>
                                    <th>Ketersedian File</th>
						            <th>Group Dokumen</th>
									<!--<th>Deskripsi</th>-->
									<!--<th>Owner Dokumen</th>-->
									<th>Status</th>
									<th>Share</th>
                                    <th>Created By</th>
							
						            <th style="text-align:center">Action</th>

                            </tr>
                        </thead>

                        <tbody>
                            <td align="center" colspan="10">Loading data from server</td>

                        <!-- <?php
						$no=1;
                       
					?> -->
                        </tbody>
                    </table>
         <!-- awal modal-->
        

         <?php
// echo $pages;
?>
            <!-- <div class="well well-sm">
    		  <div class="row">
                <div class="col-xs-9">Jumlah : <?php //echo number_format($jml); ?> dokumen</div>
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

<script type="text/javascript">
    var table;
    $(document).ready(function() {
        table = $("#vintdoc").DataTable({
            searching: false,
            ordering: false,
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: {
                url: "<?php echo site_url('admin/get_list_internal_dokumen') ?>",
                type: 'POST',
                data: function(data) {
                    data.nodokint = $('#nodokint').val();
                    data.nama = $('#nama').val();
                    data.dept_id = $('#dept_id').val();
                    data.file_exist = $('#file_exist').val();
                },
                complete: function(jqXHR){
                    document.getElementById("jml").innerHTML = jqXHR.responseJSON.recordsFiltered;
                }
            },
            initComplete: function(data) {
                document.getElementById("jml").innerHTML = data.json.recordsFiltered;
                /*var input = $('#vintdoc_input').unbind(),
                    self = this.api(),
                    searchButton = $('<button id="btnSearch" class="btn btn-default active"><i class="fa fa-search"></i></button>')
                    .click(function() {
                        self.search(input.val()).draw();
                    });
                $(document).keypress(function(event) {
                    if (event.which == 13) {
                        searchButton.click();
                    }
                });
                $('#vintdoc_filter').append(searchButton);*/
            }

        });
        
    });

    $("#btnFilter").click(function() {
        table.draw();
    });
</script>




