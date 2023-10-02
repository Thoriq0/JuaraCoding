<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

  
<section class="content-header">
    <ol class="breadcrumb">
        <li><a href="<?= site_url('home'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Entry Data Peminjam</li>
    </ol>
</section><br/>


<section class="content">
	<div class="row">

		<div class="col-xs-12">

			<div class="box">

				<div class="box-body">

					
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
					      <a class="navbar-brand" href="#">Peminjaman Arsip</a>
					    </div>  
					  	  
					    <!-- Collect the nav links, forms, and other content for toggling -->
					    <div class="collapse navbar-collapse" id="module-submenu">
					      <ul class="nav navbar-nav navbar-right">
							  <li><a href="#" class="trigger-submit"><i class="glyphicon glyphicon-save"></i> Simpan</a></li>
							  <li><a href="<?php echo site_url('/sirkulasi/'); ?>"><i class="glyphicon glyphicon-search"></i> Data Peminjaman</a></li>
					      </ul>
					    </div><!-- /.navbar-collapse -->
					  </div><!-- /.container-fluid -->
					</nav>

					<form class="form-horizontal" data-toggle="validator" action="<?php echo site_url('/sirkulasi/gentr'); ?>" method="post" enctype="multipart/form-data">

					<!-- Form Name -->
					<div class="container">
					<div class="col-md-12"> <!-- 1st column -->

					<div class="form-group">
						<label class="col-md-2 control-label" for="noarsip">Nomor Arsip</label>
						<div class="col-md-8">
						<input type="for" id="snoarsip" name="noarsip" class="form-control xhr"
						  placeholder="Ketikan 3 huruf/angka pertama kode arsip atau klasifikasi arsip" 
						  data-xhr="<?php echo site_url('/sirkulasi/xhr_arsip'); ?>" autoComplete="off" required />
						</div>
					</div>

					
                     
					

					<div class="form-group">
						<label class="col-md-2 control-label" for="username_peminjam">Username Peminjam</label>
						<div class="col-md-8">
						<input type="text" id="username_peminjam" name="username_peminjam" class="form-control xhrr" 
						  placeholder="Ketikan 3 huruf pertama username yang akan meminjam"
						  data-xhr="<?php echo site_url('/sirkulasi/xhr_user'); ?>" autoComplete="off" required />
						</div>
					</div>

					

					<div class="form-group">
						<label class="col-md-2 control-label" for="keperluan">Alasan keperluan peminjaman</label>
						<div class="col-md-8">
						<textarea id="keperluan" name="keperluan" class="form-control" row="3" required></textarea>
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-2 control-label" for="tgl_pinjam">Tanggal Peminjaman</label>
						<div class="col-md-8">
					  <div class="input-group">
					    <div class="input-group-addon">(yyyy-mm-dd)</div>
					    <input id="tgl_pinjam" name="tgl_pinjam" class="form-control input-md" type="text" data-date-format="yyyy-mm-dd" value="<?php print $now ?>" required>
						</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-2 control-label" for="tgl_haruskembali">Tanggal Harus Kembali</label>
						<div class="col-md-8">
					  <div class="input-group">
					    <div class="input-group-addon">(yyyy-mm-dd)</div>
					    <input id="tgl_haruskembali" name="tgl_haruskembali" class="form-control input-md" type="text" data-date-format="yyyy-mm-dd" required>
						</div>
						</div>
					</div>

					<div class="text-right">
						<div class="col-md-10">
						  <button id="singlebutton" name="singlebutton" type="submit" class="btn btn-success"><i class="glyphicon glyphicon-save"></i> Simpan</button>
						</div>
					</div>

					</div><!-- /1st column -->
					</div><!-- /.row -->

					</form>
					

				</div><!-- .box-body -->		

			</div><!-- .box -->		

		</div><!-- .col-xs-12 -->

	</div><!-- .row -->
</section>

<!-- <script src="jquery-3.1.1.min.js"></script> -->



<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>


<script > 


$( "input.xhr" ).autocomplete({ 
	minLength: 3, 

	source: function(request, response){
            $.get("<?php echo base_url() ?>/sirkulasi/search_arsip", {
                term:request.term
                }, function(data){
                response($.map(data, function(item) {
                    return {
                        label: item.noarsip,
                        value: item.noarsip
                    }
                }))
            }, "json");
        },

});

$( "input.xhrr" ).autocomplete({ 
	minLength: 3, 

	source: function(request, response){
            $.get("<?php echo base_url() ?>/sirkulasi/search_user", {
                term:request.term
                }, function(data){
                response($.map(data, function(item) {
                    return {
                        label: item.username,
                        value: item.username
                    }
                }))
            }, "json");
        },

});


	

</script>