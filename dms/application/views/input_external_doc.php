
<!-- Content Header (Page header) -->

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<section class="content-header" style="border-bottom: solid 3px #3c8dbc">
	<h1>
        Eksternal Dokumen
        
    </h1></br>
    <!-- <h1>
        Tombol untuk menampilkan modal
        <a class="btn btn-primary" href="<?php echo site_url('pages/add'); ?>"><i class="fa fa-plus"></i> &nbsp; Tambah Data</a>
        <?php echo $this->session->flashdata('message'); ?>
    </h1> -->

   
    <ol class="breadcrumb">
        <li><a href="<?= site_url('homes'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Input Eksternal Dokumen</li>
    </ol>
</section>


<!-- Main content -->
<section class="content" style="background-color: #fff" >

<div class="row">
        <div class="col-xs-12">

            <form class="form-horizontal" data-toggle="validator" action="<?php echo site_url('/admin/add_external_dokumen'); ?>" method="post" enctype="multipart/form-data">

            <!-- Form Name -->
            <div class="row">
            <div class="col-md-6"> <!-- 1st column -->

            <div class="form-group row">
             <label class="col-sm-4 "> Template Eksternal: </label>
                        <div class="col-sm-6">
                            <select onchange='formatDok()' name="template" id="template" class="form-control" required>
                            <option align="center" value="">-- Pilih Template --</option>
                            <?php
                                $romawi=array('I','II','III','IV','V','VI','VII','VIII','IX','X','XI','XII');
                                if(isset($template)){
                                    foreach($template as $k) {
                                        $format = $k['format_no_surat'];
                                        $format = str_replace('tahun',date('Y'),$format);
                                        $blnRoma=$romawi[intval(date('m'))-1];
                                        $format = str_replace('bulan',$blnRoma,$format);
                                        $next_no_urut=array_column($no_urut, 'no_urut','template')[$k['id']]+1;
                                        $format = str_replace('no_urut',$next_no_urut,$format);

                                        echo "<option data-format='".$format."' value='".$k['id']."' >".$k['nama_template']."</option>";
                                    }
                                }
                            ?>
                                        
                            </select>
                        </div>
             </div>
            
            <div class="form-group">
                <label class="col-md-4" for="nodok">Nomor Dokumen :</label>
                <div class="col-md-6">
                <input id="nodok" name="nodok" class="form-control input-md" type="text" required >
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4" for="nadoc">Nama Dokumen :</label>
                <div class="col-md-6">
                <input id="nadoc" name="nadoc" class="form-control input-md" type="text" required >
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-md-4" for="namaklien">Nama Klien :</label>
                <div class="col-md-6">
                <input id="namaklien" name="namaklien" class="form-control input-md" type="text" required >
                </div>
            </div>
			
            <div class="form-group">
                <label class="col-md-4 " for="tgl_terbit">Tanggal Mulai :</label>
                <div class="col-md-6">
                <div class="input-group">
                <input id="tgl_terbit" name="tgl_terbit" class="form-control input-md" type="text" required>
                <div class="input-group-addon">
                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                </div>
                </div>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-md-4 " for="masa">Tanggal Berakhir :</label>
                <div class="col-md-6">
                <div class="input-group">
                <input id="masa" name="masa" class="form-control input-md" type="text" required>
                <div class="input-group-addon">
                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                </div>
                </div>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-md-4" for="diterbitkan">Diterbitkan Oleh :</label>
                <div class="col-md-6">
                <input id="diterbitkan" name="diterbitkan" class="form-control input-md" type="text" required >
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-md-4 " for="deskripsi">Deskripsi :</label>
                <div class="col-md-6">
                    <textarea id="deskripsi" name="deskripsi" class="form-control" rows="3" required></textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4" for="owner">Pemilik Dokumen :</label>
                <div class="col-md-6">
                <input id="owner" name="owner" class="form-control input-md" type="text" required >
                </div>
            </div>

            </div><!-- /1st column -->


            

            <div class="col-md-6"><!-- 2nd column -->
           
            <div class="form-group">
                <label class="col-md-4" for="dibuat">Dibuat Oleh :</label>
                <div class="col-md-6">
                <input id="dibuat" name="dibuat" class="form-control input-md" type="text" required >
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 " for="tim">Tim Terkait :</label>
                <div class="col-md-6">
                <input id="tim" name="tim" class="form-control input-md" type="text" required>
                </div>
            </div>

            
            <div class="form-group">
                <label class="col-md-4 " for="tgl_reminder">Tanggal Reminder :</label>
                <div class="col-md-6">
                <div class="input-group">
                <input id="tgl_reminder" name="tgl_reminder" class="form-control input-md" type="text" required>
                <div class="input-group-addon">
                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                </div>
                </div>
                </div>
            </div>
            

             <div class="form-group row">
             <label class="col-sm-4 "> Jenis Media : </label>
                        <div class="col-sm-6">
                            <select name="media" id="media" class="form-control" required>
                            <option align="center" value="">-- Pilih Media --</option>
                            <?php
                                if(isset($media)){
                                    foreach($media as $k) {
                                        echo "<option value='".$k['id']."' >".$k['nama_media']."</option>";
                                    }
                                }
                            ?>
                                        
                            </select>
                        </div>
             </div>


            <div class="form-group">
                <label class="col-md-4 " for="jumlah">Jumlah :</label>
                <div class="col-md-6">
                <input id="jumlah" name="jumlah" class="form-control input-md" type="text" value="1" required>
                </div>
            </div>
            

            <div class="form-group">
                <label class="col-md-4 " for="file">File :</label>
                <div class="col-md-4">
                <input type="file" id="file" name="file" accept=".doc,.docx,.pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/pdf">
                <p class="help-block">Ukuran Maksimal <?php echo number_format(ceil(max_file_upload_in_bytes()/1000)); ?> MB</p>
                </div>
                <div class="col-md-4">
                <canvas id="pdfViewer" height="40" width="80"></canvas>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 " for="share">Share</label>
                <div class="col-md-6">
                <select class="form-control" name="share" id="share">
                <option value = 0 >Tidak</option>
                <option value = 1 >Ya</option>
                </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 " for="status">Status :</label>
                <div class="col-md-6">
                <select class="form-control" name="status" id="status">
                <option value = 1 >Aktif</option>
                <option value = 0 >Tidak Aktif</option>
                </select>
                </div>
            </div>

            </div><!-- /2nd column -->
            </div> <!-- /.row -->

            <div class="row" id="deptdata"> <!-- /2nd row -->
                <div class="col-md-12">
                    
                <div class="form-group row">
                    <label class="col-sm-2 "> Departemen Akses :</label>
                    <div class="col-sm-8">
                            <?php
                                $i=0;
                                $j=1;
                                if(isset($departemen)){
                                    foreach($departemen as $dp) {?>
                                        <?php echo ($j%3==1)?'<div class="row">':'';?>   
                                        <div class="col-sm-4">
                                        <section class="panel panel-default m-t-sm bg-dark">
                                        <header class="panel-heading">    
                                        <h5><input class='<?= $dp['id']/*$dp->Division*/?>' type='checkbox' onClick="checkAll(this)" name='departemen[]' value='<?= $dp['id']/*$dp->Division*/?>'> <?= $dp['nama_departemen']/*$dp->Division*/?> </h5>
                                        </header>
                                        <div class="panel-body">
                                        <?php foreach($user as $u){
                                            if($dp['id']/*$dp->Division*/==$u['departemen']){?>
                                                <input class="children<?=$dp['id']/*$dp->Division*/?>" type="checkbox" onClick="checkparent(this,'<?= $dp['id']/*$dp->Division*/?>')" name="du[]" value="<?=$u['departemen']."-"?><?=$u['nik']?>">  <?= $u['nama'] ?><br>
                                        <?php    }
                                        }?>
                                        </div>
                                        </section>
                                        <?php echo ($j%3==0)?"</div>":'';
                                        $i++; $j++;?>
                                        </div>
                            <?php   }
                                }
                            ?>
                    </div>
                 </div>
                
                </div>
            </div>

            </div>

            <div class="row"> <!-- /3rd row -->
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="col-md-5" for="singlebutton"></label>
                        <div class="col-md-6">
                            <button onclick="return isNoDokValid()" id="singlebutton" name="singlebutton" type="submit" class="btn btn-success pull-right">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>

            </form>
      

  </div>
 </div>


</section>

<?php
function return_bytes($val) {
    $val = trim($val);
    $last = strtolower($val[strlen($val)-1]);
    $val = (int)trim($val);
    switch($last)
    {
        case 'g':
        $val *= 1024;
        case 'm':
        $val *= 1024;
        case 'k':
        $val *= 1024;
    }
    return $val;
}

function max_file_upload_in_bytes() {
    //select maximum upload size
    $max_upload = return_bytes(ini_get('upload_max_filesize'));
    //select post limit
    $max_post = return_bytes(ini_get('post_max_size'));
    //select memory limit
    $memory_limit = return_bytes(ini_get('memory_limit'));
    // return the smallest of them, this defines the real limit
    return min($max_upload, $max_post, $memory_limit);
}

?>

<!-- library pdfjs untuk preview pdf file  -->
<script src="<?php echo base_url('/public/pdfjs/build/pdf.js') ?>"></script>
<script src="<?php echo base_url('/public/pdfjs/build/pdf.worker.js') ?>"></script>

<script type="text/javascript">

    $(document).ready(function(){
        $('#deptdata').hide();
    });

    $("#share").change(function () {
        val = $( "#share" ).val();
        // alert(val);
        if(val == 1){
            $('#deptdata').show();
        } else {
            $('#deptdata').hide();

        }
    });

    function checkAll(myCheckbox) {


        var checkboxes = document.querySelectorAll(`input[class = 'children${myCheckbox.className}']`);


        if (myCheckbox.checked == true) {
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = true;
            });
        } else {
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = false;
            });            
        }
    }

function checkparent(add, name){

    var checkboxes = document.getElementsByClassName(name);

    if (add.checked == true) {
            Array.from(checkboxes).forEach(function(checkbox) {
                checkbox.checked = true;
            });
        
        } 
}

function formatDok(){
    var select = document.getElementById('template');
    var value = select.options[select.selectedIndex].getAttribute('data-format');
    document.getElementById('nodok').value = value;
}

function cekNoDok(masuk, no_dokumen){
    var length = no_dokumen.length;
    for(var i = 0; i < length; i++) {
        if(no_dokumen[i].replace(/ /g,'') == masuk) return true;
    }
    return false;
}

<?php
    $nd = array_column($no_dokumen, 'no_dokumen');
    $dataNoDok = json_encode($nd);
    echo "var dataNoDok = ". $dataNoDok . ";\n";
?>
    
$('#nodok').on('cut paste keyup', function(){
    if(cekNoDok($('#nodok').val().replace(/ /g,''),dataNoDok)){
        alert('Nomor Dokumen Sudah Ada.\nGunakan Nomor Yang Lain.');   
    }
});

function isNoDokValid(){
    if(cekNoDok($('#nodok').val().replace(/ /g,''),dataNoDok)){
        alert('Nomor Dokumen Sudah Ada.\nGunakan Nomor Yang Lain.');
        return false;   
    } 
}

// preview file 

$("#file").on("change", function(e){
    var file = e.target.files[0]
    if(file.type == "application/pdf"){
        var fileReader = new FileReader();  
        fileReader.onload = function() {
            var pdfData = new Uint8Array(this.result);
            // Using DocumentInitParameters object to load binary data.
            var loadingTask = pdfjsLib.getDocument({data: pdfData});
            loadingTask.promise.then(function(pdf) {
              console.log('PDF loaded');
              
              // Fetch the first page
              var pageNumber = 1;
              pdf.getPage(pageNumber).then(function(page) {
                console.log('Page loaded');
                
                var scale = 0.08;
                var viewport = page.getViewport({scale: scale});

                // Prepare canvas using PDF page dimensions
                var canvas = $("#pdfViewer")[0];
                var context = canvas.getContext('2d');
                canvas.height = 40;
                canvas.width = 80;

                // Render PDF page into canvas context
                var renderContext = {
                  canvasContext: context,
                  viewport: viewport
                };
                var renderTask = page.render(renderContext);
                renderTask.promise.then(function () {
                  console.log('Page rendered');
                });
              });
            }, function (reason) {
              // PDF loading error
              console.error(reason);
            });
        };
        fileReader.readAsArrayBuffer(file);
    }
});
</script>





