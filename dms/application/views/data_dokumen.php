
<!-- Content Header (Page header) -->

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<section class="content-header">
    <!-- <h1>
        Tombol untuk menampilkan modal
        <a class="btn btn-primary" href="<?php echo site_url('pages/add'); ?>"><i class="fa fa-plus"></i> &nbsp; Tambah Data</a>
        <?php echo $this->session->flashdata('message'); ?>
    </h1>  -->

   
    <ol class="breadcrumb">
        <li><a href="<?= site_url('home'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Data Dokumen</li>
    </ol>
</section><br/>


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
              <a class="navbar-brand" href="#">Data Dokumen</a>
              </div>

                <form class="navbar-form navbar-left width-half-full" method="get" action="<?php echo site_url('/home/search'); ?>">
                    <div class="input-group width-full">
                    <input type="text" name="katakunci" class="form-control" placeholder="nomor dokumen/kata kunci uraian" /><span class="input-group-btn">
                        <button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-search"></i></button></span>
                    </div>
                </form>
		  
        <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="module-submenu">
                <ul class="nav navbar-nav navbar-right">
                    <!-- <li><a href="#advanced-search" role="button" data-toggle="collapse" data-target="" 
                    aria-expanded="false" aria-controls="advanced-search" 
                    class="open-advanced-search"><i class="glyphicon glyphicon-search"></i> Pencarian Lanjut</a></li> -->
                    <li><a href="<?php echo site_url('/home/dl').($_SERVER['QUERY_STRING']? '?'.$_SERVER['QUERY_STRING'] : '') ?>"><i class="glyphicon glyphicon-download"></i> Download Data</a></li>
                </ul>
                </div>
                </div><!-- /.container-fluid -->
            </nav>
              
            <?php echo $this->session->flashdata('zz'); ?>
             
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
                <div class="col-xs-9">Ditemukan data sebanyak : <?=$this->uri->segment(2)?><em class='small'>(<?php echo number_format($jml); ?>)</em> arsip</div>
    		    <div class="col-xs-3 text-right"></div>
    		  </div>
            </div>

            </div><!-- /.box-header -->
                <div class="box-body">

                <div class="row">
                                    
                   <div class="col-md-12" id="divtabeldoc">

                   <table id="table" class="table table-responsive table-bordered table-striped" name="vintdoc" id="vintdoc">
                        <thead>
                            <tr>	
									<th>No</th>
                                    <th>Tanggal Dokumen</th>
									<th>Tanggal Input</th>
						            
									<th>Nomor Dokumen</th>
									<th>Nama Dokumen</th>
									<th>Deskripsi</th>
									<th>Owner Dokumen</th>
									<th>Status</th>
									
							
						            <th class="width-sm">Aksi</th>
						            
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
							echo "<td>".$a['tgl_dokumen']."</td>";
							echo "<td>".$a['tgl_input']."</td>";
							
							echo "<td>".$a['no_dokumen']."</td>";
							echo "<td>".$a['nama_dokumen']."</td>";
							echo "<td>".$a['deskripsi']."</td>";
							echo "<td>".$a['owner_dokumen']."</td>";
							
							
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
							echo "<td><a href='".site_url('admin/view/'.$a['id'])."' ><i class=\"glyphicon glyphicon-search\"></i></a>";
					
		
							echo "&nbsp &nbsp &nbsp <a href='".site_url('/admin/vedit/'.$a['id'])."'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a></td>";
						
						
							
						}
						
							echo "</tr>";
							// $no++;
						
					?>
                        </tbody>
                    </table>
         <!-- awal modal-->
        

         <?php
echo $pages;
?>


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
		<form id="fdeldatadoc" class="form-horizontal" role="form" method="post" action="<?php echo site_url("/admin/delete_data"); ?>">
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
    

  function fdeldatadoc() {
    document.getElementById("fdeldatadoc").submit();
  }

 

//   $("#deldataint").on("click", function() {
// 		alert('BOSSS');
// 		// $("#fdeldata").submit();
// 	});


//   function fdelpenc() {
//     document.getElementById("fdelpenc").submit();
//   }

  $("#divtabeldoc").on("click", ".edpenc", function() {
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
  });
</script>





