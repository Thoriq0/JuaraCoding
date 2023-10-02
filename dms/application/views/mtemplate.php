<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<section class="content-header">
  <h1>
	Data Template Nomor Surat
  </h1>
<ol class="breadcrumb">
	<li><a href="<?= site_url('home'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
	<li>Data Template Nomor Surat</li>
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
              <form class="navbar-form navbar-left width-half-full" method="get" action="<?php echo site_url('/master/template'); ?>">
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
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addtemp">Input Data</button></br>
		</span></br>
          <div class="row">
            <div class="col-md-12" id="divtabeltemp">
              <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered" name="vuser" id="vuser">
                  <thead>
                    <th class="width-sm">No</th>
                    <th>Kategori Dokumen</th>
                    <th>Departemen</th>
                    <th>Nama Template</th>
                    <th>Format Nomor Template</th>

                    <th class="width-sm">Action</th>

                  </thead>
                  <?php
                  if (isset($peng)) {
                    $no = 1;
                    foreach ($peng as $u) {
                      echo "<tr>";
                      echo "<td>" . $no . "</td>";
                      echo "<td>" . $u['kategori'] . "</td>";
                      echo "<td>" . $u['departemen'] . "</td>";
                      echo "<td>" . $u['nama_template'] . "</td>";
                      echo "<td>" . $u['format_no_surat'] . "</td>";

                      echo "<td><a onClick=\"setiduser(this.id)\" data-toggle=\"modal\" data-target=\"#editemp\" class='edtemp' href='#' id='".$u['id']."'><span class='btn btn-xs btn-warning'><i class='fa fa-md fa-pencil' ></i> Edit</span></a>
					  </td>";
                      echo "</tr>";
                      $no++;
					  /* action delete
					  &nbsp
					  <a onClick=\"setiduser(this.id)\" data-toggle=\"modal\" data-target=\"#deltemp\" class='deltemp' href='#' id='".$u['id']."'><span class='btn btn-xs btn-danger'><i class='fa fa-md fa-times' ></i> Hapus</span></a>
					  */
                    }
                  }
                  ?>
                </table>
              </div><!-- .table-responsive -->
            </div>
          </div>






          <div class="modal fade" id="addtemp">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <h4 class="modal-title">Tambah Template</h4>
                </div>
                <div class="modal-body">
                  <form id="faddtemp" class="form-horizontal" role="form" method="post" action="<?php echo site_url("/master/addmtemplate"); ?>">
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="nama">Kategori</label>
                      <div class="col-sm-10">
                        <select class="form-control" id="kategori" name="kategori" style="width: 100%" required>
                          <option value='internal'>Internal</option>
                          <option value='eksternal'>Eksternal</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="nama">Departemen</label>
                      <div class="col-sm-10">
                        <select class="form-control" id="departemen" name="departemen" style="width: 100%" required>
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
                      <label class="col-sm-2 control-label" for="nama">Nama Template</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama" name="nama" />
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="nama">Format Nomor Surat</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="nomor" name="nomor" />
                      </div>
                    </div>


                  </form>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary" id="addtempgo">Simpan</button>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div>


          <div class="modal fade" id="editemp">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <h4 class="modal-title">Edit Master Template</h4>
                </div>
                <div class="modal-body">
                  <form id="fedtemp" class="form-horizontal" role="form" method="post" action="<?php echo site_url("/master/editmtemplate"); ?>">
                    <input type="hidden" name="id" id="edidtemp" value="">
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="nama">Kategori</label>
                      <div class="col-sm-10">
                        <select class="form-control" id="ekategori" name="kategori" style="width: 100%" required>
                          <option value='internal'>Internal</option>
                          <option value='eksternal'>Eksternal</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 control-label" for="departemen">Departemen</label>
                      <div class="col-sm-10">
                        <select id="edepartemen" name="departemen" class="form-control" required>
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

                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="nama">Nomor Surat</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="enomor" name="nomor" />
                      </div>
                    </div>

                  </form>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button onClick="fedtemp()" type="button" class="btn btn-primary" id="editusergo">Simpan</button>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->


          <div class="modal fade" id="deltemp">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <h4 class="modal-title">Delete Master Template</h4>
                </div>
                <div class="modal-body">
                  <form id="fdeltemp" class="form-horizontal" role="form" method="post" action="<?php echo site_url("/master/delmtemplate"); ?>">
                    <h4 class="modal-title">Yakin ingin Hapus data ini?</h4>
                    <input type="hidden" name="id" id="delidtemp" value="">
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button onClick="fdeltemp()" type="button" class="btn btn-primary" id="deltempgo">Hapus</button>
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
    $('#delidtemp').val(iduser);


    //edit
    $('#edidtemp').val(iduser);
  }

  $("#addtempgo").on("click", function() {
    $("#faddtemp").submit();
    $("#faddtemp").ajaxForm({
      success: function(ahtml) {
        alert("Data telah sukses disimpan");
        $("#addtemp").modal("hide");
        $("#faddtemp")[0].reset();
        window.location.replace('<?php echo site_url("/master/template"); ?>');
      }
    });
  });





  function fedtemp() {
    document.getElementById("fedtemp").submit();
  }

  function fdeltemp() {
    document.getElementById("fdeltemp").submit();
  }

  $("#divtabeltemp").on("click", ".edtemp", function() {
    var d = $(this).attr("id");
    $.ajax({
      type: "POST",
      url: "<?php echo site_url("/master/mtemplate"); ?>",
      data: "id=" + d,
      cache: false,
      success: function(ahtml) {
        html = jQuery.parseJSON(ahtml);
        $("#fedtemp")[0].reset();
        $("#enama").val(html.nama_template);
        $("#enomor").val(html.format_no_surat);
        $("#edepartemen").val(html.departemen);
        $("#ekategori").val(html.kategori);
        $("#edidtemp").val(html.id);


      }
    });
  });
</script>