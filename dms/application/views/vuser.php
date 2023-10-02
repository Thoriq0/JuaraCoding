<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<section class="content-header">
  <h1>
	Data User
  </h1>
<ol class="breadcrumb">
	<li><a href="<?= site_url('home'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
	<li>Data User</li>
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
					    <form class="navbar-form navbar-left width-half-full" method="get" action="<?php echo site_url('/master/vuser'); ?>">
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
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#adduser">Input Data</button></br>
				</span></br>
					<div class="row">
					    <div class="col-md-12" id="divtabeluser">
					    <div class="table-responsive">
					    <table class="table table-hover table-striped table-bordered" name="vuser" id="vuser">
					    <thead>
					        <th class="width-sm">No</th>
							<th class="width-sm">NIK</th>
							<th class="width-sm">Nama</th>
							<th>Username</th>
							<th class="width-sm">Departemen</th>
							<th class="width-sm">Tingkat Akses</th>
					        <th>Email</th>
							
							<!-- <th>Akses Modul</th> -->
					        <th class="width-sm">Action</th>
					        
					    </thead>
					    <?php
					        if(isset($user)){
					            $no=1;
					            foreach($user as $u) {
					                echo "<tr>";
					                echo "<td>".$no."</td>";
									echo "<td>".$u['nik']."</td>";
									echo "<td>".$u['nama']."</td>";
									echo "<td>".$u['username']."</td>";		
									echo "<td>".$u['nama_departemen']."</td>";
									echo "<td>".$u['akses']."</td>";		
									echo "<td>".$u['email']."</td>";
					                					
	
					                echo "<td><a onClick=\"setiduser(this.id)\" data-toggle=\"modal\" data-target=\"#edituser\" class='eduser' href='#' id='".$u['id']."'><span class='btn btn-xs btn-warning'><i class='fa fa-md fa-pencil' ></i> Edit</span></a>
									</td>";
					                echo "</tr>";
					                $no++;
									/* action delete
									&nbsp
									<a onClick=\"setiduser(this.id)\" data-toggle=\"modal\" data-target=\"#deluser\" class='deluser' href='#' id='".$u['id']."'><span class='btn btn-xs btn-danger'><i class='fa fa-md fa-times' ></i> Hapus</span></a>
									*/
					            }
					        }
					    ?>
					    </table>
					  	</div><!-- .table-responsive -->
					    </div>
					</div>

		<div class="modal fade" id="adduser">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		        <h4 class="modal-title">Tambah User</h4>
		      </div>
			  <div class="modal-body">
				<form id="fadduser" class="form-horizontal" role="form" method="post" action="<?php echo site_url("/master/adduser"); ?>">
				<div class="form-group">
					<label class="col-sm-2 control-label" for="nik">NIK</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="nik" name="nik" />
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label" for="nama">Nama</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="nama" name="nama" />
					</div>
				</div>
				
				
				<div class="form-group row">
					<label class="col-sm-2 control-label" for="departemen">Departemen</label>
				        <div class="col-sm-10">
							<select id="departemen" name="departemen" class="form-control">
                            <option>--Pilih--</option>
							<?php
                                if(isset($departemen)){
                                    foreach($departemen as $k) {
                                        echo "<option value='".$k['id']."-".$k['nama_departemen']."' >".$k['nama_departemen']."</option>";
                                    }
                                }
                            ?>
										
							</select>
						</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-2 control-label" for="tingkat">Tingkat Akses</label>
				        <div class="col-sm-10">
							<select id="tingkat" name="tingkat" class="form-control">
                            <option>--Pilih--</option>
							<!-- <?php
                                if(isset($tingkat)){
                                    foreach($tingkat as $t) {
                                        echo "<option value='".$t['akses']."' >".$t['akses']."</option>";
                                    }
                                }
                            ?> -->
										
							</select>
						</div>
				</div>
				
				<!-- <div class="form-group">
						<label class="col-sm-2 control-label" for="tipe">Tipe</label>
						<div class="col-sm-10">
									<select id="tipe" name="tipe" class="form-control">
						<option value="admin" >Admin</option>
						<option value="user" >User</option>
					</select>
						</div>
				</div> -->

				<div class="form-group">
					<label class="col-sm-2 control-label" for="email">Email</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="email" name="email" />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-2 control-label" for="username">Username</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="username" name="username" />
					</div>
				</div>
				
				<div class="form-group">
						<label class="col-sm-2 control-label" for="password">Password</label>
						<div class="col-sm-10">
							<input type="password" class="form-control" id="password" name="password" />
						</div>
					</div>
				<div class="form-group">
						<label class="col-sm-2 control-label" for="conf_password">Konfirmasi password</label>
						<div class="col-sm-10">
							<input type="password" class="form-control" id="conf_password" name="conf_password" />
						</div>
				</div>
				
				<div class="form-group row">
					<label class="col-sm-2 control-label" for="tingkat">Tipe Akses</label>
				        <div class="col-sm-10">
							<select id="tipe" name="tipe" class="form-control">
                            <option>--Pilih--</option>							                            
                                <option value='user' >User</option>
								 <option value='admin' >Admin</option>
							</select>
						</div>
				</div>
				
					
				</form>

			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="button" class="btn btn-primary" id="addusergo">Simpan</button>
			  </div>
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div>


		<div class="modal fade" id="edituser">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		        <h4 class="modal-title">Edit User</h4>
		      </div>
			  <div class="modal-body">
				<form id="feduser" class="form-horizontal" role="form" method="post" action="<?php echo site_url("/master/edituser"); ?>">
		            <input type="hidden" name="id" id="ediduser" value="">
					<div class="form-group">
						<label class="col-sm-2 control-label" for="nik">NIK</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="enik" name="nik" value=""/>	
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="nama">Nama</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="enama" name="nama" value=""/>
						</div>
					</div>
					<!-- <div class="form-group">
						<label class="col-sm-2 control-label" for="departemen">Departemen</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="departemen" name="departemen" value=""/>
						</div>
					</div> -->

					<div class="form-group row">
					<label class="col-sm-2 control-label" for="departemen">Departemen</label>
				        <div class="col-sm-10">
							<select id="edepartemen" name="departemen" class="form-control">
                            <!-- <option>--Pilih--</option> -->
							<?php
                                if(isset($departemen)){
                                    foreach($departemen as $k) {
                                        echo "<option value='".$k['id']."' >".$k['nama_departemen']."</option>";
                                    }
                                }
                            ?>
										
							</select>
						</div>
					</div>

					<div class="form-group row">
					<label class="col-sm-2 control-label" for="tingkat">Tingkat Akses</label>
				        <div class="col-sm-10">
							<select id="etingkat" name="tingkat" class="form-control">
                            
							<!-- <?php
                                if(isset($tingkat)){
                                    foreach($tingkat as $t) {
                                        echo "<option value='".$t['akses']."' >".$t['departemen']."-".$t['akses']."</option>";
                                    }
                                }
                            ?> -->
										
							</select>
						</div>
				</div>

					<div class="form-group">
						<label class="col-sm-2 control-label" for="username">Username</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="eusername" name="username" value=""/>
						</div>
					</div>
		            <div class="form-group">
						<label class="col-sm-2 control-label" for="password">Password</label>
						<div class="col-sm-10">
							<input type="password" class="form-control" id="epassword" name="password" />
						</div>
					</div>
					
	

					<div class="form-group">
						<label class="col-sm-2 control-label" for="email">email</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="eemail" name="email" value=""/>
						</div>
					</div>

				</form>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button onClick="feduser()" type="button" class="btn btn-primary" id="editusergo">Simpan</button>
			  </div>
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

		<div class="modal fade" id="deluser">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		        <h4 class="modal-title">Delete User</h4>
		      </div>
			  <div class="modal-body">
				<form id="fdeluser" class="form-horizontal" role="form" method="post" action="<?php echo site_url("/master/deluser"); ?>">
					<h4 class="modal-title">Yakin ingin Hapus data ini?</h4>
		            <input type="hidden" name="id" id="deliduser" value="">
				</form>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button onClick="fdeluser()" type="button" class="btn btn-primary" id="delusergo">Hapus</button>
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
		$('#deliduser').val(iduser);
	
		//edit
		$('#ediduser').val(iduser);
  }
  	


    //add user
  $("#addusergo").on("click", function() {
		var d = $("#username").val();
		
		$.ajax({
			type: "POST",
			url: "<?php echo site_url("/master/cekuser"); ?>",
			data: "username=" + d,
			cache: false,
			success: function(ahtml) {
				html = jQuery.parseJSON(ahtml);				
				if (html.msg == "ok") {
					$("#fadduser").submit();
				} else {
					alert("username sudah terpakai!");
				}
			}
		});

		$("#fadduser").ajaxForm({ 
			success: function (ahtml) {
				jsonData = jQuery.parseJSON(ahtml);		
				if (jsonData.status == "error" && jsonData.pesan == "PASSWORD_UNMATCH") {
					alert(
						"Password yang anda tuliskan tidak sama dengan konfirmasi password.\nHarap periksa penggunaan huruf besar kecil."
					);
					$("#password, #conf_password").addClass("input-error");
					return false;
				}
				alert("Data telah sukses disimpan");

				$("#adduser").modal("hide");
				$("#password, #conf_password").removeClass("input-error");
				$("#fadduser")[0].reset();

				window.location.replace('<?php echo site_url("/master/vuser");?>');
			} 
		});		

	});




/*	function adduser(responseText, statusText, xhr, $form) {
		var jsonData = JSON.parse(responseText);
		if (jsonData.status == "error" && jsonData.pesan == "PASSWORD_UNMATCH") {
			alert(
				"Password yang anda tuliskan tidak sama dengan konfirmasi password.\nHarap periksa penggunaan huruf besar kecil."
			);
			$("#password, #conf_password").addClass("input-error");
			return false;
		}
		alert("Data telah sukses disimpan");
		reloaduser();

		$("#adduser").modal("hide");
		$("#password, #conf_password").removeClass("input-error");
		$("#fadduser")[0].reset();
		redirect('/master/vuser', 'refresh');
		window.location.replace('<?php echo site_url("/master/vuser");?>');
	}*/

  

  function feduser() {
    document.getElementById("feduser").submit();
  }
  function fdeluser() {
    document.getElementById("fdeluser").submit();
  }

  $("#divtabeluser").on("click", ".eduser", function() {
		var d = $(this).attr("id");
		$.ajax({
			type: "POST",
			url: "<?php echo site_url("/master/auser"); ?>",
			data: "id=" + d,
			cache: false,
			success: function(ahtml) {
				html = jQuery.parseJSON(ahtml);
				$("#feduser")[0].reset();
				$("#eusername").val(html.username);
				$("#etipe").val(html.tipe);
				$("#eakses_klas").val(html.akses_klas);
				$("#ediduser").val(html.id);
				$("#eemail").val(html.email);
				$("#enik").val(html.nik);
				$("#enama").val(html.nama);
				$("#edepartemen").val(html.departemen);
				var dept = $('select[id=edepartemen] option').filter(':selected').text();
				<?php
				    $dataAkses = json_encode($tingkat);
				    echo "var dataAkses = ". $dataAkses . ";\n";
				?>
				console.log(dataAkses);
				var dataFilter =[];
				dataFilter = filterByDepartemen(dataAkses, "departemen", dept);
				//generate option pada select tingkat
				var opsiAkses = '';
				for (var i = 0; i < dataFilter[0].length; i++) {
				   opsiAkses += '<option value="' + dataFilter[0][i]+ '">' + dataFilter[1][i] + '</option>';
				}
				$("#etingkat").html(opsiAkses);
				$("#etingkat").val(html.tingkat_akses);
				
				/*if (html.akses_modul != "") {
					var akses_modul = jQuery.parseJSON(html.akses_modul);
					if (typeof akses_modul == "object") {
						if (akses_modul.entridata == "on")
							$("#emodul1").prop("checked", true);
						if (akses_modul.sirkulasi == "on")
							$("#emodul2").prop("checked", true);
						if (akses_modul.klasifikasi == "on")
							$("#emodul3").prop("checked", true);
						if (akses_modul.pencipta == "on")
							$("#emodul4").prop("checked", true);
						if (akses_modul.pengolah == "on")
							$("#emodul5").prop("checked", true);
						if (akses_modul.lokasi == "on") $("#emodul6").prop("checked", true);
						if (akses_modul.media == "on") $("#emodul7").prop("checked", true);
						if (akses_modul.user == "on") $("#emodul8").prop("checked", true);
						if (akses_modul.import == "on") $("#emodul9").prop("checked", true);
					}
				}*/
			}
		});
	});

function filterByDepartemen(array, prop, value){
    var filtered = [];
    var filtered2 = [];
    for(var i = 0; i < array.length; i++){

        var obj = array[i];
        
        if(typeof(obj['departemen'] == "object")){
            var item = obj[prop];
            if(item == value){
                filtered.push(obj['id']);
                filtered2.push(obj['akses']);
            }
        }
        
    }    
    return [filtered,filtered2];
}
// modal tambah user
$("#departemen").on("change", function () {
	//filter data akses sesuai pilihan departemen
	var dept = $('select[id=departemen] option').filter(':selected').text();
	<?php
	    $dataAkses = json_encode($tingkat);
	    echo "var dataAkses = ". $dataAkses . ";\n";
	?>
	var dataFilter =[];
	dataFilter = filterByDepartemen(dataAkses, "departemen", dept);
	//generate option pada select tingkat
	var opsiAkses = '<option>--Pilih--</option>';
	for (var i = 0; i < dataFilter[0].length; i++) {
	   opsiAkses += '<option value="' + dataFilter[0][i]+'-'+ dataFilter[1][i] +'">' + dataFilter[1][i] + '</option>';
	}
	$("#tingkat").html(opsiAkses);

});

// modal edit user
$("#edepartemen").on("change", function () {
	//filter data akses sesuai pilihan departemen
	var dept = $('select[id=edepartemen] option').filter(':selected').text();
	<?php
	    $dataAkses = json_encode($tingkat);
	    echo "var dataAkses = ". $dataAkses . ";\n";
	?>
	var dataFilter =[];
	dataFilter = filterByDepartemen(dataAkses, "departemen", dept);
	//generate option pada select tingkat
	var opsiAkses = '<option>--Pilih--</option>';
	for (var i = 0; i < dataFilter[0].length; i++) {
	   opsiAkses += '<option value="' + dataFilter[0][i]+ '">' + dataFilter[1][i] + '</option>';
	}
	$("#etingkat").html(opsiAkses);

});

</script>