<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<section class="content-header">
  <h1>
	Data Departemen
  </h1>
<ol class="breadcrumb">
	<li><a href="<?= site_url('home'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
	<li>Data Departemen</li>
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
              <form class="navbar-form navbar-left width-half-full" method="get" action="<?php echo site_url('/master/departemen'); ?>">
              	  <div class="input-group width-full">
              	  <input type="text" name="katakunci" class="form-control" placeholder="" value="<?php echo $this->input->get('katakunci') ?>"/>
				  <span class="input-group-btn">
              	  	<button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-search"></i></button>
				  </span>
                  </div>
              </form>
            

            </div><!-- /.container-fluid -->
          </nav>

        </div><!-- .box-header -->

        <div class="box-body">
		<span class="input-group-btn">
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addpenc">Input Data</button></br>
		</span></br>
          <div class="row">
              <div class="col-md-12" id="divtabelpenc">
              <div class="table-responsive">
              <table class="table table-hover table-striped table-bordered" name="vpenc" id="vpenc">
              <thead>
                  <th>No</th>
                  <th>Nama Departemen</th>
                  <th class="width-sm">Action</th>
                  
              </thead>
              <?php
                  if(isset($penc)){
                      $no=1;
                      foreach($penc as $u) {
                          echo "<tr>";
                          echo "<td>".$no."</td>";
                          echo "<td>".$u['nama_departemen']."</td>";
                          echo "<td><a onClick=\"setiduser(this.id)\" data-toggle=\"modal\" data-target=\"#editdept\" class='editdept' href='#' id='".$u['id']."'><span class='btn btn-xs btn-warning'><i class='fa fa-md fa-pencil'></i> Edit</span></a>
						  </td>
						  </td>";
                          echo "</tr>";
                          $no++;
						  /* action delete
						  &nbsp
						  <a onClick=\"setiduser(this.id)\" data-toggle=\"modal\" data-target=\"#delete_departemen\" class='delete_departemen' href='#' id='".$u['id']."'><span class='btn btn-xs btn-danger'><i class='fa fa-md fa-times' ></i> Hapus</span></a></td>
						  */
                      }
                  }
              ?>
              </table>
              </div><!-- .table-responsive -->
              </div>
          </div>



    <div class="modal fade" id="addpenc">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">Tambah Departemen</h4>
          </div>
    	  <div class="modal-body">
    		<form id="fadddept" class="form-horizontal" role="form" method="post" action="<?php echo site_url("/master/add_departemen"); ?>">
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
			<button onClick="fadddept()" type="button" class="btn btn-primary" id="adddept">Simpan</button>
          </div>
		  
		  
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <div class="modal fade" id="editdept">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">Edit Departemen</h4>
          </div>
    	  <div class="modal-body">
    		<form id="feddept" class="form-horizontal" role="form" method="post" action="<?php echo site_url("/master/edit_departemen"); ?>">
                <input type="hidden" name="id" id="ediddept" value="">
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
			<button onClick="feddept()" type="button" class="btn btn-primary" id="eddept">Simpan</button>
          </div>
		  
		  
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade" id="delete_departemen">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">Delete Departemen</h4>
          </div>
    	  <div class="modal-body">
    		<form id="fdeldept" class="form-horizontal" role="form" method="post" action="<?php echo site_url("/master/delete_departemen"); ?>">
    			<h4 class="modal-title">Yakin ingin Hapus data ini?</h4>
                <input type="hidden" name="id" id="delidpenc" value="">
    		</form>
    	  </div>
    	  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<button onClick="fdeldept()" type="button" class="btn btn-primary" id="delete_departemen">Simpan</button>
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
    $('#delidpenc').val(iduser);

    //edit
    $('#ediddept').val(iduser);
  }
    
  
  function fadddept() {
    document.getElementById("fadddept").submit();
  }
  function feddept() {
    document.getElementById("feddept").submit();
  }
  function fdeldept() {
    document.getElementById("fdeldept").submit();
  }

  $("#divtabelpenc").on("click", ".editdept", function() {
    var d = $(this).attr("id");
    $.ajax({
      type: "POST",
      url: "<?php echo site_url("/master/adept"); ?>",
      data: "id=" + d,
      cache: false,
      success: function(ahtml) {
        html = jQuery.parseJSON(ahtml);
		$("#feddept")[0].reset();
        $("#enama").val(html.nama_departemen);
        $("#ediddept").val(html.id);
        
      }
    });
  });
</script>