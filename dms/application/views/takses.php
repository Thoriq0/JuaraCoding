<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<section class="content-header">
  <h1>
	Data Tingkat Akses
  </h1>
<ol class="breadcrumb">
	<li><a href="<?= site_url('home'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
	<li>Data Tingkat Akses</li>
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
              <form class="navbar-form navbar-left width-half-full" method="get" action="<?php echo site_url('/master/tingkat_akses'); ?>">
                <div class="input-group width-full">
                  <input type="text" name="katakunci" class="form-control" placeholder="" value="<?php echo $this->input->get('katakunci') ?>" /><span class="input-group-btn">
                    <button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-search"></i></button></span>
                </div>
              </form>


            </div><!-- /.container-fluid -->
          </nav>
        </div><!-- .box-header -->

        <?= $this->session->flashdata('message') ?>

        <div class="box-body">
		<span class="input-group-btn">
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addpeng">Input Data</button></br>
		</span></br>
          <div class="row">
            <div class="col-md-12" id="divtabelpeng">
              <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered" name="vpeng" id="vpeng">
                  <thead>
                    <th class="width-sm">No</th>
                    <th>Departemen</th>
                    <th>Nama Akses</th>
                    <th>Action</th>

                  </thead>
                  <?php
                  if (isset($peng)) {
                    $no = 1;
                    foreach ($peng as $u) {
                      echo "<tr>";
                      echo "<td>" . $no . "</td>";
                      echo "<td>" . $u['departemen'] . "</td>";
                      echo "<td>" . $u['akses'] . "</td>";
                      echo "<td><a onClick=\"setiduser(this.id)\" data-toggle=\"modal\" data-target=\"#editpeng\" class='edpeng' href='#' id='".$u['id']."'><span class='btn btn-xs btn-warning'><i class='fa fa-md fa-pencil' ></i> Edit</span></a>
					  </td>";
                      echo "</tr>";
                      $no++;
					  
					  /* action delete
					  &nbsp
					  <a onClick=\"setiduser(this.id)\" data-toggle=\"modal\" data-target=\"#delpeng\" class='delpeng' href='#' id='".$u['id']."'><span class='btn btn-xs btn-danger'><i class='fa fa-md fa-times' ></i> Hapus</span></a></td>";
					  */
                    }
                  }
                  ?>
                </table>
              </div><!-- .table-responsive -->
            </div>
          </div>




          <div class="modal fade" id="addpeng">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <h4 class="modal-title">Tambah Tingkat Akses</h4>
                </div>
                <div class="modal-body">
                  <form id="faddpeng" class="form-horizontal" role="form" method="post" action="<?php echo site_url("/master/addtaskes"); ?>">
                    <div class="form-group row">
                      <label class="col-sm-2 control-label" for="departemen">Departemen</label>
                      <div class="col-sm-10">
                        <select id="departemen" name="departemen" class="form-control">
                          <option>--Pilih--</option>
                          <?php
                          if (isset($departemen)) {
                            foreach ($departemen as $k) {
                              echo "<option value='" . $k['nama_departemen'] . "' >" . $k['nama_departemen'] . "</option>";
                            }
                          }
                          ?>

                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="nama">Nama Akses</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama" name="nama" />
                      </div>
                    </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary" id="addpenggo">Simpan</button>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->


          <div class="modal fade" id="editpeng">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <h4 class="modal-title">Edit Tingkat Akses</h4>
                </div>
                <div class="modal-body">
                  <form id="fedtakses" class="form-horizontal" role="form" method="post" action="<?php echo site_url("/master/edittaskes"); ?>">
                    <input type="hidden" name="id" id="edidpeng" value="">
                    <div class="form-group row">
                      <label class="col-sm-2 control-label" for="departemen">Departemen</label>
                      <div class="col-sm-10">
                        <select id="edepartemen" name="departemen" class="form-control">
                          <option>--Pilih--</option>
                          <?php
                          if (isset($departemen)) {
                            foreach ($departemen as $k) {
                              echo "<option value='" . $k['nama_departemen'] . "' >" . $k['nama_departemen'] . "</option>";
                            }
                          }
                          ?>

                        </select>
                      </div>
                    </div>
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
                  <button onClick="fedtakses()" type="button" class="btn btn-primary" id="edtakses">Simpan</button>
                </div>

              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->

          <div class="modal fade" id="delpeng">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <h4 class="modal-title">Delete Pengolah Arsip</h4>
                </div>
                <div class="modal-body">
                  <form id="fdelpeng" class="form-horizontal" role="form" method="post" action="<?php echo site_url("/master/deltaskes"); ?>">
                    <h4 class="modal-title">Yakin ingin Hapus data ini?</h4>
                    <input type="hidden" name="id" id="delidpeng" value="">
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button onClick="fdelpeng()" type="submit" class="btn btn-primary" id="delpenggo">Hapus</button>
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
    $('#delidpeng').val(iduser);

    //edit
    $('#edidpeng').val(iduser);
  }


  function fedtakses() {
    document.getElementById("fedtakses").submit();
  }

  function fdelpeng() {
    document.getElementById("fdelpeng").submit();
  }

  $("#divtabelpeng").on("click", ".edpeng", function() {
    var d = $(this).attr("id");
    $.ajax({
      type: "POST",
      url: "<?php echo site_url("/master/takses"); ?>",
      data: "id=" + d,
      cache: false,
      success: function(ahtml) {
        html = jQuery.parseJSON(ahtml);
        $("#enama").val(html.akses);
        $("#edepartemen").val(html.departemen);
        $("#edidpeng").val(html.id);
      }
    });
  });
</script>