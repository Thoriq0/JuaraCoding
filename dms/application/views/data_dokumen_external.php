
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

                <form class="navbar-form navbar-left width-half-full" method="get" action="<?php echo site_url('/admin/list_external_dokumen'); ?>">
                    <div class="input-group width-full">
                    <input type="text" name="katakunci" class="form-control" placeholder="nomor dokumen/kata kunci uraian" /><span class="input-group-btn">
                        <button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-search"></i></button></span>
                    </div>
                </form>
		  
        <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="module-submenu">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#advanced-search" role="button" data-toggle="collapse" data-target="" 
                    aria-expanded="false" aria-controls="advanced-search" 
                    class="open-advanced-search"><i class="glyphicon glyphicon-search"></i> Pencarian Lanjut</a></li>
                    <li><a href="<?php echo site_url('/home/dl').($_SERVER['QUERY_STRING']? '?'.$_SERVER['QUERY_STRING'] : '') ?>"><i class="glyphicon glyphicon-download"></i> Download Data</a></li>
                    <li><button class="btn" type="button" style="margin-top:8px" onClick="sendemail()">Send Selected Email</button></li>
                </ul>
                </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
              
            <?php echo $this->session->flashdata('zz'); ?>
                <div class="panel panel-default panel-hidden collapse" id="advanced-search">
                    <div class="panel-heading"><h3 class="panel-title">Pencarian Lanjut</h3></div>
                    <div class="panel-body">
                    <form action="<?php echo site_url('/admin/list_external_dokumen'); ?>" method="get" id="srcmain">
   
                        <br/>
                        <div class = "input-group col-md-2">
                            <span class = "input-group-addon">Bulan</span>
                            <!-- <input id="tanggal" name="tanggal" class="form-control input-md" type="text" value="<?php echo $src['tanggal'] ?>"> -->
                            <select class="form-control " name="bulan" id="bulan">
                            <option>-- Pilih Bulan --</option>
                            <option value = 30 >1 Bulan</option>
                            <option value = 60 >2 Bulan</option>
                            <option value = 90 >3 Bulan</option>
                            </select>
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="submit" id="go"> Cari</button>
                            </span>
                        </div>
                    </form>
                    </div>
                    <!-- ./panel body -->
                </div>
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
                <div class="col-xs-9">Ditemukan data sebanyak : <em class='small'>(<?php echo number_format($jml); ?>)</em> arsip</div>
    		    <div class="col-xs-3 text-right"></div>
    		  </div>
            </div>

        </div><!-- /.box-header -->
        
                <div class="box-body table-responsive " id="divtabeldoc">
                <form method="post" action="#" id="form">
                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                            <tr>	
                                    <th>
                                    <input type="checkbox" onclick="selectAll(this)" />
                                    </th>
									<th>No</th>
                                    <!-- <th>Tanggal Dokumen</th> -->
									<th>Nomor Dokumen</th>
                                    <th>Nomor Perijinan</th>
                                    <th>Nama Perijinan</th>
                                    <th>Tanggal Terbit</th>
						            <th>Diterbitkan Oleh</th>
									<th>Deskripsi</th>
									<th>Pemilik Dokumen</th>
									<th>Dibuat Oleh</th>
									<th>Tim Terkait</th>
									<th>Masa Berlaku</th>
									<!-- <th>Reminder Sebelum (hari)</th> -->
                                    <th>Tanggal Reminder</th>
                                    <th>Jenis Media</th>
                                    <th>Jumlah</th>
                                    <th>File</th>
                                    <th>Status</th>
							
						            <th class="width-sm"></th>
						            <th class="width-sm"></th>
						            <th class="width-sm"></th>
                            </tr>
                        </thead>

                        <tbody>
                        <?php
						$no=1;
						foreach($data as $a) {
							echo "<tr>";
							echo "<td><input type='checkbox' class='getId[]' id='idcheck' name='getId[]' value='".$a['id']."'/></td>";
							echo "<td>".$no."</td>";
							// echo "<td>".$a['tgl_dokumen']."</td>";
							echo "<td>".$a['no_dokumen']."</td>";
							echo "<td>".$a['no_perijinan']."</td>";
                            echo "<td>".$a['nama_perijinan']."</td>";
							echo "<td>".date('d/m/Y',strtotime($a['tgl_terbit']))."</td>";
							echo "<td>".$a['publish_by']."</td>";
							echo "<td>".$a['deskripsi']."</td>";
							echo "<td>".$a['owner_name']."</td>";
                            echo "<td>".$a['create_name']."</td>";
                            echo "<td>".$a['tim_terkait']."</td>";
                            echo "<td>".date('d/m/Y',strtotime($a['tgl_berlaku']))."</td>";
                            echo "<td>".date('d/m/Y',strtotime($a['tgl_reminder']))."</td>";
                            foreach($nama_media as $nm){
                                if($nm['id']==$a['media']){
                                    echo "<td>".$nm['nama_media']."</td>";
                                }
                            }
                            echo "<td>".$a['jumlah']."</td>";
                            echo "<td>".$a['file']."</td>";
							
							if($a['is_status']=="1") {
								echo "<td>Aktif</td>";
							}else {
								echo "<td>Tidak Aktif</td>";
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
							echo "<td><a href='".site_url('admin/viewExternal/'.$a['id'])."' ><i class=\"glyphicon glyphicon-search\"></i></a></td>";
							echo "<td>";
							if(isset($_SESSION['akses_modul']['entridata']) && $_SESSION['akses_modul']['entridata']=='on') {
								echo "<a href='".site_url('/admin/veditExternal/'.$a['id'])."'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a>";
							}
							echo "</td>";
							echo "<td>";
							if(isset($_SESSION['akses_modul']['entridata']) && $_SESSION['akses_modul']['entridata']=='on') {
								echo "<a class='deldata' onClick=\"setiduser(this.id)\" id='".$a['id']."' href='#' data-toggle=\"modal\" data-target=\"#deldata\"><i class=\"glyphicon glyphicon-trash\"></i></a>";
							}
							echo "</td>";
							echo "</tr>";
							$no++;
						}
					?>
                        </tbody>
                    </table>
         <!-- awal modal-->
        </form>

        

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
		<form id="fdeldata" class="form-horizontal" role="form" method="post" action="<?php echo site_url("/admin/delpeng"); ?>">
			<h4 class="modal-title">Yakin ingin Hapus Data ini?</h4>
            <input type="hidden" name="id" id="deliddata" value="">
		</form>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="deldatago">Hapus</button>
	  </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
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

  $("#divtabeldoc").on("click", ".deldata", function() {
		var d = $(this).attr("id");
		$("#deliddata").val(d);
	});

	$("#deldatago").on("click", function() {
		// alert('BOSSS')
		$("#fdeldata").submit();
	});

	// $("#fdeldata").ajaxForm({ success: deldata });
	function deldata() {
		alert("Data telah sukses dihapus");
		$("#deldata").modal("hide");
		// reloadpeng();
	}
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

  $("#divtabeldoc").on("click", ".check", function() {
    $("#form input[type='checkbox']").prop('checked',this.checked);

  });
//   $("#form $select-all").click(function(){
//   })
  
//   var checked = false;
  function selectAll(source) {
    checkboxes = document.getElementsByClassName('getId[]');
        for (var i in checkboxes)
            checkboxes[i].checked = source.checked;
    }

    function sendemail(){
        // var checked = false;
        // var elements = document.getElementsByName("getId[]");
        // for (var i = 0; i < elements.length; i++) {
        //     if (elements[i].checked) {
        //         checked = true;
        //     }
        // }
        if(document.getElementById('idcheck').checked) {
            // var val = [];
            // $(':checkbox:checked').each(function(i){
            //     val[i] = $(this).val();
            //     // console.log(val[i] );
            // });
            // console.log(val);
            $.ajax({
                    url: "<?php echo base_url('admin/send_email') ?>",
                    type: "POST",
                    // data: {
                    //     "getId":val
                    // },
                    data: $('#form').serialize(),
                    // dataType: "json",
                    success: function(data) {
                        // reload_page();
                        // html = jQuery.parseJSON(data);

                        // console.log(html);
                        // console.log('testt');
                        console.log(data);
                    },
                    // error: function(request, error) {
                    //     print(error);
                    //     // alert("ERROR: " + error);
                    // }
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                        // alert("ERROR: " + error);
                    }
                });
        } else {
            alert('Silahkan ceklis data !');

        }
     
    }
  
</script>





