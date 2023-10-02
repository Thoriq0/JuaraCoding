
<!-- Content Header (Page header) -->

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<section class="content-header">
  <h1>
	Dokumen Eksternal
  </h1>
<ol class="breadcrumb">
	<li><a href="<?= site_url('home'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
	<li>Dokumen Eksternal</li>
</ol>
</section>

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
				  </div>

				<!-- <form class="navbar-form navbar-left width-half-full" method="get" action="<?php echo site_url('/admin/list_eksternal_dokumen'); ?>"> -->
                    <div class="col-xs-3">

						<table>
                            <tr> 
                                <td style="color:white;"><h4>Pencarian : &nbsp;</h></td><td></td>
                            </tr>
                            <tr>
                                <td style="color:white; width: 100%;">Nomor Dokumen &nbsp;</td><td><input type="text" id="nodokext" name="nodokext"  placeholder="" /></td>
                            </tr>
                            <tr>
                                <td style="color:white; width: 100%;">Nama Dokumen &nbsp;</td><td><input type="text" id="nama" name="nama"  placeholder="" /></td>
                            </tr>
                            <!-- <tr>
                                <td style="color:white;">Bulan &nbsp;</td>
                                <td>
                                    <select style="width:100%; height: 25px;" name="bulan" id="bulan">
                                        <option style="text-align: center;">-- Pilih Bulan --</option>
                                        <option value = 30 >1 Bulan</option>
                                        <option value = 60 >2 Bulan</option>
                                        <option value = 90 >3 Bulan</option>
                                    </select>
                                </td>
                            </tr> -->
                            <tr>
                                <td style="color:white;">Departemen &nbsp;</td>
                                <td>
                                    <select style="width: 100%; height: 25px;" id="dept_id" name="dept_id" >
                                        <option style="text-align: center;" value="">All</option>
                                        <?php
                                            if(isset($deptID)){
                                                foreach($deptID as $k) {
                                                    echo "<option value='".$k['id']/*$k->Division*/."' >".$k['nama_departemen']/*$k->Division*/."</option>";
                                                }
                                            }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td style="color:white;">Ketersedian File &nbsp;</td>
                                <td>
                                    <select style="width: 100%; height: 25px;" id="file_exist" name="file_exist" >
                                        <option style="text-align: center;" value="">All</option>
                                        <option style="text-align: center;" value="2">Belum Ada</option>
                                        <option style="text-align: center;" value="1">Ada</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td style="color:white;"></td><td><button id="btnFilter" class="btn btn-primary" ><i class="glyphicon glyphicon-search"></i> Filter</button></td>
                            </tr>
                        </table>

                    </div>						
					<!-- </form> -->
          
        <!-- Collect the nav links, forms, and other content for toggling -->
                <!-- <div class="collapse navbar-collapse" id="module-submenu">
                <ul class="nav navbar-nav navbar-right">
				
                    <li><a href="#advanced-search" role="button" data-toggle="collapse" data-target="" 
                    aria-expanded="false" aria-controls="advanced-search" 
                    class="open-advanced-search"><i class="glyphicon glyphicon-filter"></i> Filter Pencarian</a></li>
                    
                    
                </ul>
                </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
              
            <?php echo $this->session->flashdata('zz'); ?>
                <!-- <div class="panel panel-default panel-hidden collapse" id="advanced-search">
                    <div class="panel-heading"><h3 class="panel-title">Filter Pencarian</h3></div>
                    <div class="panel-body">
                    <form action="<?php echo site_url('/admin/list_external_dokumen'); ?>" method="get" id="srcmain">
                        <nav class = "navbar row">
                            <div class="navbar-header col-xs-2">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#module-submenu" aria-expanded="false">
                                </button>
                                <a class="navbar-brand" >Bulan</a>
                            </div>
                            
                            <div class="navbar-form navbar-left width-half-full">
                                <div class="input-group width-full">
                                    <select class="form-control " name="bulan" id="bulan">
                                    <option>-- Pilih Bulan --</option>
                                    <option value = 30 >1 Bulan</option>
                                    <option value = 60 >2 Bulan</option>
                                    <option value = 90 >3 Bulan</option>
                                    </select>
                                </div>
                            </div>
                        </nav>
                        <nav class="navbar row">
                            <div class="navbar-header col-xs-2">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#module-submenu" aria-expanded="false">
                                </button>
                                <a class="navbar-brand" >Departemen</a>
                            </div>
                            <div class="navbar-form navbar-left width-half-full">
                                <div class="input-group width-full">
                                    <select id="dept_id" name="dept_id" class="form-control" >
                                        <option value="">All</option>
                                        <?php
                                            if(isset($deptID)){
                                                foreach($deptID as $k) {
                                                    echo "<option value='".$k['id']."' >".$k['nama_departemen']."</option>";
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </nav>
                        <div class="col-xs-4">
                            <span class="pull-right">
                                <button class="btn btn-primary" type="submit" id="go"><i class="glyphicon glyphicon-filter"></i> Filter</button>
                            </span>
                        </div>
                    </form>
                    </div>
                    <!-- ./panel body --
                </div> -->
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
                <div class="col-xs-9">Jumlah : <i id='jml'></i> dokumen</div>
                <div class="col-xs-3 text-right"></div>
              </div>
            </div>
            

        </div><!-- /.box-header -->
        
            
        <div class="box-body" id="divtabeldoc">
			<button type="button" class="btn btn-primary" onclick="window.location.href='admin/input_external_doc';">Input Data</button> &nbsp;&nbsp;
			<button class="btn btn-primary" type="button" onClick="sendemail()">Send Selected Email</button>
			</br></br>

            <form method="post" action="#" id="form">
                <table width="100%" id="vextdoc" class="table table-bordered table-striped">
                    <thead>
                        <tr>    
                                <th>
                                <input type="checkbox" onclick="selectAll(this)" />
                                </th>
                                <th>No</th>
                                <!-- <th>Tanggal Dokumen</th> -->
                                <th>No. Dokumen</th>
                                <!--<th>Nomor Perijinan</th>-->
                                <th>Nama Dokumen</th>
                                <th>Nama Klien</th>
                                <th>Departemen</th>
                                <!--<th>Tanggal Terbit</th>-->
                                <th>Diterbitkan Oleh</th>
                                <!--<th>Deskripsi</th>-->
                                <th>Pemilik Dokumen</th>
                                <th>Ketersedian File</th>
                                <!--<th>Dibuat Oleh</th>-->
                                <th>Tim Terkait</th>
                                <th>Masa Berlaku</th>
                                <!-- <th>Reminder Sebelum (hari)</th> -->
                                <th>Tanggal Reminder</th>
                                <!--<th>Jenis Media</th>-->
                                <!--<th>Jumlah</th>-->
                                <!--<th>File</th>-->
                                <th>Status</th>
                                <th>Share</th>
                                <th>Created By</th>
                        
                                <th style="text-align:center">Action</th>
                                
                        </tr>
                    </thead>

                    <tbody>
                    <?php
                    /*$no=1;
                    foreach($data as $a) {
                        echo "<tr>";
                        echo "<td><input type='checkbox' class='getId[]' id='idcheck' name='getId[]' value='".$a['id']."'/></td>";
                        echo "<td>".$no."</td>";
                        // echo "<td>".$a['tgl_dokumen']."</td>";
                        echo "<td>".$a['no_dokumen']."</td>";
                        //echo "<td>".$a['no_perijinan']."</td>";
                        echo "<td>".$a['nama_perijinan']."</td>";
                        echo "<td>".$a['nama_klien']."</td>";
                        if(!empty($deptID)){
                            if ($a['id_departemen']==0) {
                                echo "<td>-</td>";
                            }else{
                                foreach ($deptID as $d) {
                                    if ($a['id_departemen']==$d['id']) {
                                        echo "<td>".$d['nama_departemen']."</td>";
                                    }
                                }
                            }
                        }else{
                            echo "<td>-</td>";
                        }
                        //echo "<td>".date('d/m/Y',strtotime($a['tgl_terbit']))."</td>";
                        echo "<td>".$a['publish_by']."</td>";
                        //echo "<td>".$a['deskripsi']."</td>";
                        echo "<td>".$a['owner_name']."</td>";
                        //echo "<td>".$a['create_name']."</td>";
                        echo "<td>".$a['tim_terkait']."</td>";
                        echo "<td>".date('d/m/Y',strtotime($a['tgl_berlaku']))."</td>";
                        echo "<td>".date('d/m/Y',strtotime($a['tgl_reminder']))."</td>";
                        /*foreach($nama_media as $nm){
                            if($nm['id']==$a['media']){
                                echo "<td>".$nm['nama_media']."</td>";
                            }
                        }*
                        //echo "<td>".$a['jumlah']."</td>";
                        //echo "<td>".$a['file']."</td>";
                        
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
                        *
                       
						echo "<td><a href='".site_url('admin/viewExternal/'.$a['id'])."' ><span class='btn btn-xs btn-primary'><i class='fa fa-md fa-search' ></i> View</span></a>
							&nbsp
							<a href='".site_url('/admin/veditExternal/'.$a['id'])."'><span class='btn btn-xs btn-warning'><i class='fa fa-md fa-pencil' ></i> Edit</span></a>
							</td>";
						echo "</tr>";
                        $no++;
                    }*/
                ?>
                    </tbody>
                </table>
             <!-- awal modal-->
            </form>
                

        <!--    <?php
        // echo $pages;
        ?> -->
        </div>

            <!-- <div class="well well-sm">
              <div class="row">
                <div class="col-xs-9">Jumlah : <?php echo number_format($jml); ?> dokumen</div>
                <div class="col-xs-3 text-right"></div>
              </div>
            </div> -->

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
        <form id="fdeldata" class="form-horizontal" role="form" method="post" action="<?php echo site_url("/admin/delete_external_dokumen"); ?>">
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

  /*$("#divtabeldoc").on("click", ".edpenc", function() {
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
  });*/

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


        // if(document.getElementById('idcheck').checked) {
        if($("input[name='getId[]']:checked")) {
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
                        alert('Berhasil mengirim email');
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

<script type="text/javascript">
    var table;
    $(document).ready(function() {
        table = $("#vextdoc").DataTable({
            searching: false,
            ordering: false,
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: {
                url: "<?php echo site_url('admin/get_list_eksternal_dokumen') ?>",
                type: 'POST',
                data: function(data) {
                    data.nodokext = $('#nodokext').val();
                    data.nama = $('#nama').val();
                    data.dept_id = $('#dept_id').val();
                    data.file_exist = $('#file_exist').val();
                },
                complete: function(jqXHR){
                    document.getElementById("jml").innerHTML = jqXHR.responseJSON.recordsFiltered;
                }

            },
            initComplete: function(data) {
                document.getElementById("jml").innerHTML = data.json.recordsFiltered;
            /*    var input = $('#vextdoc_input').unbind(),
                    self = this.api(),
                    searchButton = $('<button id="btnSearch" class="btn btn-default active"><i class="fa fa-search"></i></button>')
                    .click(function() {
                        self.search(input.val()).draw();
                    });
                $(document).keypress(function(event) {
                    if (event.which == 13) {
                        searchButton.click();
                    }
                });
                $('#vextdoc_filter').append(searchButton);*/
            },
            

        });
        
    });

    $("#btnFilter").click(function() {
        table.draw();
    });
</script>





