<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="../../dist/css/adminlte.min.css">
<section class="content-header">
  <h1>
	Group Documents
  </h1>
<ol class="breadcrumb">
	<li><a href="<?= site_url('home'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
	<li>Group Documents</li>
</ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-xs-12">
	
      <div class="box">

        <div class="box-header">

          <nav class="navbar navbar-inverse navbar-submenu" >
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
              <form class="navbar-form navbar-left width-half-full" method="get" action="<?php echo site_url('/master/group_documents'); ?>">
              	  <div class="input-group width-full">
              	  <input type="text" name="katakunci" class="form-control" placeholder="" value="<?php echo $this->input->get('katakunci') ?>" /><span class="input-group-btn">
              	  	<button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-search"></i></button></span>
                  </div>
              </form>
            

            </div><!-- /.container-fluid -->
          </nav>

        </div><!-- .box-header -->

        <div class="box-body">
          <span class="input-group-btn">
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addkode">Input Data</button></br>
		</span></br>
          <div class="row">
              <div class="col-md-12" id="divtabelkode">
              <div class="table-responsive">
              <table class="table table-bordered table-striped table-hover" name="vkode" id="vkode">
              <thead>
                  <th>Kode</th>
                  <th>Nama</th>
                  <th>Retensi</th>
                  <th class="width-sm">Action</th>
                  
              </thead>
              <?php
                  if(isset($user)){
                      $no=1;
                      foreach($user as $u) {
                          echo "<tr>";
                          //echo "<td>".$no."</td>";
                          echo "<td>".$u['kode']."</td>";
                          echo "<td>".$u['nama']."</td>";
                          echo "<td>".$u['retensi']." Tahun</td>";
                          echo "<td><a onClick=\"setiduser(this.id)\" data-toggle=\"modal\" data-target=\"#editkode\" class='edkode' href='#' id='".$u['id']."'><span class='btn btn-xs btn-warning'><i class='fa fa-md fa-pencil' ></i> Edit</span></a>
						  </td>";

                          echo "</tr>";
                          $no++;
						  /* action delete
						  &nbsp
						  <a onClick=\"setiduser(this.id)\" data-toggle=\"modal\" data-target=\"#delkode\" class='delkode' href='#' id='".$u['id']."'><span class='btn btn-xs btn-danger'><i class='fa fa-md fa-times' ></i> Hapus</span></a></td>";
						  */
                      }
                  }
              ?>
              </table>
              </div><!-- .table-responsive -->
              </div>
          </div>



    <div class="modal fade" id="addkode">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">Tambah Group Documents</h4>
          </div>
    	  <div class="modal-body">
    		<form id="faddkode" class="form-horizontal" role="form" method="post" action="<?php echo site_url("/master/addkode"); ?>">
    			<div class="form-group">
    				<label class="col-sm-2 control-label" for="kode">Kode</label>
    				<div class="col-sm-10">
    					<input type="text" class="form-control" id="adkode" name="kode" />
    				</div>
    			</div>
                <div class="form-group">
    				<label class="col-sm-2 control-label" for="nama">Nama</label>
    				<div class="col-sm-10">
    					<input type="text" class="form-control" id="nama" name="nama" />
    				</div>
    			</div>
                <div class="form-group">
    				<label class="col-sm-2 control-label" for="retensi">Retensi</label>
    				<div class="col-sm-10">
                        <div class="input-group">
                            <input type="text" class="form-control" id="retensi" name="retensi" />
                            <span class = "input-group-addon">Tahun</span>
                        </div>
    				</div>
    			</div>
    		</form>
    	  </div>
		  
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<button onClick="faddkode()" type="button" class="btn btn-primary" id="addkode">Simpan</button>
          </div>
		  
		  
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

	
    <div class="modal fade" id="editkode">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">Edit Group Documents</h4>
          </div>
    	  <div class="modal-body">
    		<form id="fedkode" class="form-horizontal" role="form" method="post" action="<?php echo site_url("/master/edkode"); ?>">
                <input type="hidden" name="id" id="edidkode" value="">
    			<div class="form-group">
    				<label class="col-sm-2 control-label" for="kode">Kode</label>
    				<div class="col-sm-10">
    					<input type="text" class="form-control" id="ekode" name="kode" />
    				</div>
    			</div>
                <div class="form-group">
    				<label class="col-sm-2 control-label" for="nama">Nama</label>
    				<div class="col-sm-10">
    					<input type="text" class="form-control" id="enama" name="nama" />
    				</div>
    			</div>
                <div class="form-group">
    				<label class="col-sm-2 control-label" for="retensi">Retensi</label>
    				<div class="col-sm-10">
    					<div class="input-group">
                            <input type="text" class="form-control" id="eretensi" name="retensi" />
                            <span class = "input-group-addon">Tahun</span>
                        </div>
    				</div>
    			</div>
    		</form>
    	  </div>

		  
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<button onClick="fedkode()" type="button" class="btn btn-primary" id="edkode">Simpan</button>
          </div>
		  
		  
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade" id="delkode">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">Delete Group Documents</h4>
          </div>
    	  <div class="modal-body">
    		<form id="fdelkode" class="form-horizontal" role="form" method="post" action="<?php echo site_url("/master/delkode"); ?>">
    			<h4 class="modal-title">Yakin ingin Hapus data ini?</h4>
                <input type="hidden" name="id" id="delidkode" value="">
    		</form>
    	  </div>
		  
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<button onClick="fdelkode()" type="button" class="btn btn-primary" id="delkode">Hapus</button>
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
    $('#delidkode').val(iduser);

    //edit
    $('#edidkode').val(iduser);
  }
  
  $("#addkodego").on("click", function() {
    $("#fdelkode").submit();
    $("#fdelkode").ajaxForm({
      success: function(ahtml) {
        alert("Data telah sukses disimpan");
        $("#addkode").modal("hide");
        $("#faddkode")[0].reset();
        window.location.replace('<?php echo site_url("/master/group_documents"); ?>');
      }
    });
  });
    

function faddkode() {
    document.getElementById("faddkode").submit();
  }
  function fedkode() {
    document.getElementById("fedkode").submit();
  }
  function fdelkode() {
    document.getElementById("fdelkode").submit();
  }

  $("#divtabelkode").on("click", ".edkode", function() {
    var d = $(this).attr("id");
    $.ajax({
      type: "POST",
      url: "<?php echo site_url("/master/akode"); ?>",
      data: "id=" + d,
      cache: false,
      success: function(ahtml) {
        html = jQuery.parseJSON(ahtml);
		$("#fedkode")[0].reset();
        $("#ekode").val(html.kode);
        $("#enama").val(html.nama);
        $("#eretensi").val(html.retensi);
        $("#edidkode").val(html.id);
      }
    });
  });
</script>