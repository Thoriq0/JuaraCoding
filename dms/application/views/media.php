<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<section class="content-header">
  <h1>
	Data Media Arsip
  </h1>
<ol class="breadcrumb">
	<li><a href="<?= site_url('home'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
	<li>Data Media Arsip</li>
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
              <form class="navbar-form navbar-left width-half-full" method="get" action="<?php echo site_url('/admin/media'); ?>">
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
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addmed">Input Data</button></br>
		</span></br>
          <div class="row">
              <div class="col-md-12" id="divtabelmed">
              <div class="table-responsive">
              <table class="table table-hover table-striped table-bordered" name="vmed" id="vmed">
              <thead>
                  <th class="width-sm">No</th>
                  <th>Nama Media</th>
                  <th class="width-sm">Action</th>
                  
              </thead>
              <?php
                  if(isset($med)){
                      $no=1;
                      foreach($med as $u) {
                          echo "<tr>";
                          echo "<td>".$no."</td>";
                          echo "<td>".$u['nama_media']."</td>";
                          echo "<td><a onClick=\"setiduser(this.id)\" data-toggle=\"modal\" data-target=\"#editmed\" class='edmed' href='#' id='".$u['id']."'><span class='btn btn-xs btn-warning'><i class='fa fa-md fa-pencil' ></i> Edit</span></a>
						  
						  </td>";
                          echo "</tr>";
                          $no++;
						  /*
						  &nbsp
						  <a onClick=\"setiduser(this.id)\" data-toggle=\"modal\" data-target=\"#delmed\" class='delmed' href='#' id='".$u['id']."'><span class='btn btn-xs btn-danger'><i class='fa fa-md fa-times' ></i> Hapus</span></a>
						 */
                      }
                  }
              ?>
              </table>
              </div><!-- .table-responsive -->
              </div>
          </div>





    <div class="modal fade" id="addmed">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">Tambah Media Arsip</h4>
          </div>
    	  <div class="modal-body">
    		<form id="faddmed" class="form-horizontal" role="form" method="post" action="<?php echo site_url("/admin/addmed"); ?>">
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
            <button type="button" class="btn btn-primary" id="addmedgo">Simpan</button>
    	  </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <div class="modal fade" id="editmed">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">Edit Media Arsip</h4>
          </div>
    	  <div class="modal-body">
    		<form id="fedmed" class="form-horizontal" role="form" method="post" action="<?php echo site_url("/admin/edmed"); ?>">
                <input type="hidden" name="id" id="edidmed" value="">
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
			<button onClick="fedmed()" type="button" class="btn btn-primary" id="edkode">Simpan</button>
          </div>
		  
		  
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade" id="delmed">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">Delete Media Arsip</h4>
          </div>
    	  <div class="modal-body">
    		<form id="fdelmed" class="form-horizontal" role="form" method="post" action="<?php echo site_url("/admin/delmed"); ?>">
    			<h4 class="modal-title">Yakin ingin Hapus data ini?</h4>
                <input type="hidden" name="id" id="delidmed" value="">
    		</form>
    	  </div>
    	  <div class="modal-footer">
    		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="delmedgo">Hapus</button>
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
    $('#delidmed').val(iduser);

    //edit
    $('#edidmed').val(iduser);
  }
    

  function fedmed() {
    document.getElementById("fedmed").submit();
  }
  function fdelmed() {
    document.getElementById("fdelmed").submit();
  }

  $("#divtabelmed").on("click", ".edmed", function() {
    var d = $(this).attr("id");
    $.ajax({
      type: "POST",
      url: "<?php echo site_url("/admin/amed"); ?>",
      data: "id=" + d,
      cache: false,
      success: function(ahtml) {
        html = jQuery.parseJSON(ahtml);
		$("#fedmed")[0].reset();
        $("#enama").val(html.nama_media);
        $("#edidmed").val(html.id);
      }
    });
  });
</script>