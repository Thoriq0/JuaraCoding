<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<section class="content-header">
  <h1>
	Data Lokasi Arsip
  </h1>
<ol class="breadcrumb">
	<li><a href="<?= site_url('home'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
	<li>Data Lokasi Arsip</li>
</ol>
</section>

<section class="content">
  <div class="row">

    <div class="col-xs-12">

      <div class="box">

        <div class="box-header">

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
				<a class="navbar-brand" >Pencarian</a>
              </div>
              <form class="navbar-form navbar-left width-half-full" method="get" action="<?php echo site_url('/master/lokasi'); ?>">
              	  <div class="input-group width-full">
              	  <input type="text" name="katakunci" class="form-control" placeholder="" value="<?php echo $this->input->get('katakunci') ?>"/><span class="input-group-btn">
              	  	<button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-search"></i></button></span>
                  </div>
              </form>
            

            </div><!-- /.container-fluid -->
          </nav>

        </div><!-- .box-header -->

        <div class="box-body">
          <span class="input-group-btn">
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addlok">Input Data</button></br>
		</span></br>
          <div class="row">
              <div class="col-md-12" id="divtabellok">
              <div class="table-responsive">
              <table class="table table-hover table-striped table-bordered" name="vlok" id="vlok">
              <thead>
                  <th class="width-sm">No</th>
                  <th>Nama Lokasi</th>
                  <th class="width-sm">Action</th>
                  
              </thead>
              <?php
                  if(isset($lok)){
                      $no=1;
                      foreach($lok as $u) {
                          echo "<tr>";
                          echo "<td>".$no."</td>";
                          echo "<td>".$u['nama_lokasi']."</td>";
                          echo "<td><a onClick=\"setiduser(this.id)\" data-toggle=\"modal\" data-target=\"#editlok\" class='edlok' href='#' id='".$u['id']."'><span class='btn btn-xs btn-warning'><i class='fa fa-md fa-pencil' ></i> Edit</span></a>		
						  </td>";
                          echo "</tr>";
                          $no++;
						  /* action delete
						  &nbsp
						  <a onClick=\"setiduser(this.id)\" data-toggle=\"modal\" data-target=\"#dellok\" class='dellok' href='#' id='".$u['id']."'><span class='btn btn-xs btn-danger'><i class='fa fa-md fa-times' ></i> Hapus</span></a>
						  */
                      }
                  }
              ?>
              </table>
              </div><!-- .table-responsive -->
              </div>
          </div>



    <div class="modal fade" id="addlok">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">Tambah Lokasi Arsip</h4>
          </div>
    	  <div class="modal-body">
    		<form id="faddlok" class="form-horizontal" role="form" method="post" action="<?php echo site_url("/master/addlok"); ?>">
                <div class="form-group">
    				<label class="col-sm-2 control-label" for="nama">Nama</label>
    				<div class="col-sm-10">
    					<input type="text" class="form-control" id="nama" name="nama" />
    				</div>
    			</div>
    		</form>
    	  </div>
    	  <div class="modal-footer">
    		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="addlokgo">Simpan</button>
    	  </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <div class="modal fade" id="editlok">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">Edit Lokasi Arsip</h4>
          </div>
    	  <div class="modal-body">
    		<form id="fedlok" class="form-horizontal" role="form" method="post" action="<?php echo site_url("/master/edlok"); ?>">
                <input type="hidden" name="id" id="edidlok" value="">
                <div class="form-group">
    				<label class="col-sm-2 control-label" for="nama">Nama</label>
    				<div class="col-sm-10">
    					<input type="text" class="form-control" id="enama" name="nama" />
    				</div>
    			</div>
    		</form>
    	  </div>

		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<button onClick="fedlok()" type="button" class="btn btn-primary" id="edkode">Simpan</button>
          </div>
		  
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade" id="dellok">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">Delete Lokasi Arsip</h4>
          </div>
    	  <div class="modal-body">
    		<form id="fdellok" class="form-horizontal" role="form" method="post" action="<?php echo site_url("/master/dellok"); ?>">
    			<h4 class="modal-title">Yakin ingin Hapus data ini?</h4>
                <input type="hidden" name="id" id="delidlok" value="">
    		</form>
    	  </div>
    	  <div class="modal-footer">
    		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<button onClick="fdellok()" type="button" class="btn btn-primary" id="dellokgo">Hapus</button>
    	  </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

        </div><!-- /.box-body -->

      </div><!-- /.box -->

    </div><!-- .col-xs-12 -->

  </div><!-- /.row -->
</section>
<script type="text/javascript">
  function setiduser(iduser) {
    //delete
    $('#delidlok').val(iduser);

    //edit
    $('#edidlok').val(iduser);
  }
    

  function fedlok() {
    document.getElementById("fedlok").submit();
  }
  function fdellok() {
    document.getElementById("fdellok").submit();
  }

  $("#divtabellok").on("click", ".edlok", function() {
    var d = $(this).attr("id");
    $.ajax({
      type: "POST",
      url: "<?php echo site_url("/master/alok"); ?>",
      data: "id=" + d,
      cache: false,
      success: function(ahtml) {
        html = jQuery.parseJSON(ahtml);
		    
        $("#fedlok")[0].reset();

        $("#enama").val(html.nama_lokasi);
        $("#edidlok").val(html.id);
      }
    });
  });
</script>