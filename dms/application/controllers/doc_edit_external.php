<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<section class="content-header">
    

   
    <ol class="breadcrumb">
        <li><a href="<?= site_url('home'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Edit Data Arsip</li>
    </ol>
</section><br/>


<section class="content">
<div class="row">
<div class="col-xs-12">
<form class="form-horizontal" data-toggle="validator" action="<?php echo site_url('/admin/editExternal/'.$id); ?>" method="post" enctype="multipart/form-data">
<fieldset>
<input type="hidden" name="id" value="<?php echo $id ?>">
<input type="hidden" name="previous" value="<?php echo $previous ?>">
<!-- Form Name -->
<legend>Edit Data</legend>
<div class="row">
<div class="col-md-6"> <!-- 1st column -->

    <div class="form-group row">
     	<label class="col-sm-4 "> Template Eksternal: </label>
                <div class="col-sm-6">
                    <select onchange='formatDok()' name="template" id="template" class="form-control" required>
                    <option align="center">-- Pilih Template --</option>
                    <?php
                        if(isset($tplt)){
                            foreach($tplt as $k) {
                                echo "<option data-format='".$k['format_no_surat']."' value='".$k['id']."'".($template==$k['id']?"selected=selected":"")." >".$k['nama_template']."</option>";
                            }
                        }
                    ?>
                                
                    </select>
                </div>
    </div> 

	<div class="form-group">
		<label class="col-md-4" for="nodok">Nomor Dokumen :</label>
		<div class="col-md-6">
	   		<input id="nodok" name="nodok" class="form-control input-md" type="text" value="<?php echo $no_dokumen ?>">
		</div>
	</div>

	<div class="form-group">
		<label class="col-md-4" for="noijin">Nomor Perijinan :</label>
		<div class="col-md-6">
		   <input id="noijin" name="noijin" class="form-control input-md" type="text" value="<?php echo $no_perijinan ?>">
		</div>
	</div>

	<div class="form-group ">
		<label class="col-md-4 " for="namaijin"> Nama Perijinan : </label>
		<div class="col-md-6">
	       <input id="namaijin" name="namaijin" class="form-control input-md" type="text" value="<?php echo $nama_perijinan; ?>">
		</div>
	 </div>

	<div class="form-group">
		<label class="col-md-4 " for="tgl_terbit">Tanggal Terbit :</label>
		<div class="col-md-6">
			<div class="input-group">
				<input id="tgl_terbit" name="tgl_terbit" class="form-control input-md" type="text" value="<?php echo date('Y-m-d',strtotime($tgl_terbit)); ?>">
				<div class="input-group-addon">
	                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
	            </div>
			</div>
	    </div>
	</div>

	<div class="form-group ">
		<label class="col-md-4 " for="diterbitkan"> Diterbitkan Oleh : </label>
		<div class="col-md-6">
	       <input id="diterbitkan" name="diterbitkan" class="form-control input-md" type="text" value="<?php echo $publish_by; ?>">
		</div>
	</div>

	 <div class="form-group">
		<label class="col-md-4 " for="deskripsi">Deskripsi :</label>
		<div class="col-md-6">
	  <textarea id="deskripsi" name="deskripsi" class="form-control" rows="3"><?php echo $deskripsi ?></textarea>
		</div>
	</div>

	<div class="form-group ">
		<label class="col-md-4" for="owner">Pemilik Dokumen : </label>
		<div class="col-md-6">
	       <input id="owner" name="owner" class="form-control input-md" type="text" value="<?php echo $owner_name; ?>">
		</div>
	</div>

	<div class="form-group ">
		<label class="col-md-4" for="dibuat">Dibuat Oleh : </label>
		<div class="col-md-6">
	       <input id="dibuat" name="dibuat" class="form-control input-md" type="text" value="<?php echo $create_name; ?>">
		</div>
	</div>


</div><!-- /1st column -->

<div class="col-md-6"><!-- 2nd column -->

	<div class="form-group ">
		<label class="col-md-4" for="tim">Tim Terkait : </label>
		<div class="col-md-6">
	       <input id="tim" name="tim" class="form-control input-md" type="text" value="<?php echo $tim_terkait; ?>">
		</div>
	</div>

	<div class="form-group">
		<label class="col-md-4 " for="masa">Masa Berlaku :</label>
		<div class="col-md-6">
			<div class="input-group">
				<input id="masa" name="masa" class="form-control input-md" type="text" value="<?php echo date('Y-m-d',strtotime($tgl_berlaku)); ?>">
				<div class="input-group-addon">
	                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
	            </div>
			</div>
	    </div>
	</div>

	<!-- <div class="form-group ">
		<label class="col-md-4" for="reminder">Reminder Sebelum (hari) : </label>
		<div class="col-md-6">
	       <input id="reminder" name="reminder" class="form-control input-md" type="text" value="<?php echo $tim_terkait; ?>">
		</div>
	</div> -->

	<div class="form-group">
		<label class="col-md-4 " for="tgl_reminder">Tanggal Reminder :</label>
		<div class="col-md-6">
			<div class="input-group">
				<input id="tgl_reminder" name="tgl_reminder" class="form-control input-md" type="text" value="<?php echo date('Y-m-d',strtotime($tgl_reminder)); ?>">
				<div class="input-group-addon">
	                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
	            </div>
			</div>
	    </div>
	</div>


 <div class="form-group row">
		<label class="col-sm-4"> Jenis Media : </label>
				<div class="col-sm-6">
							<select name="media" id="media" class="form-control"disable required>
							<?php
								if(isset($nama_media)){
									foreach($nama_media as $k) {
										echo "<option value='".$k['id']."'".($media==$k['id']?"selected=selected":"")." >".$k['nama_media']."</option>";
									}
								}
							?>
										
							</select>
					</div>
 </div>


 	<div class="form-group ">
		<label class="col-sm-4" for="jumlah">Jumlah : </label>
		<div class="col-sm-6">
	       <input id="jumlah" name="jumlah" class="form-control input-md" type="text" value="<?php echo $jumlah; ?>">
		</div>
 	</div>


<div class="form-group">
	<label class="col-md-4" for="nobox">File</label>
	<div class="col-md-6">
	<?php
		if($file!="") {
			echo "<div class='form-control'><div style='text-overflow:ellipsis;overflow:hidden;' id='linkfile' class='col-md-11'><a href='".base_url('uploads/'.$file)."'>$file</a></div><span class='pull-right'><a href='#' data-toggle=\"modal\" data-target=\"#delfile\"><span class='glyphicon glyphicon-remove' style='color:red' aria-hidden='true'></span></a></span></div>";
			echo "<div id='uplodfile' style='display:none;'>";
		}else {
			echo "<div id='uplodfile'>";
		}
		echo "<input type='file' id='file' name='file' accept='.doc,.docx,.pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/pdf'>
		<p class='help-block'>Ukuran Maksimal ".number_format(ceil(max_file_upload_in_bytes()/1000))."MB</p>";
		echo "</div>";
	?>
	</div>
</div>

	<div class="form-group">
		<label class="col-md-4" for="status">Status</label>
		<div class="col-md-6">
		<select class="form-control" name="status" id="status">
	      <option value="1" <?php echo ($is_status=='1'?"selected=selected":"") ?> >Aktif</option>
	      <option value="0" <?php echo ($is_status=='0'?"selected=selected":"") ?> >Tidak Aktif</option>
	    </select>
		</div>
	</div>

</div><!-- /2nd column -->
</div><!-- /.row -->

<div class="row"> <!-- /2nd row -->
    <div class="col-md-12">
        
    <div class="form-group row">
        <label class="col-sm-2 "> Departemen :</label>
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
                            <h5><input class='<?= $dp['id']?>' type='checkbox' onClick="checkAll(this)" name='departemen[]' value='<?= $dp['nama_departemen']?>'<?php foreach($akses_eksternal as $ae){echo ($ae['departemen']==$dp['nama_departemen'])?" checked ":"";}
                        	?> > <?= $dp['nama_departemen'] ?> </h5>
                            </header>
                            <div class="panel-body">
                            <?php foreach($user as $u){
                                if($dp['nama_departemen']==$u['departemen']){?>
                                    <input class="children<?=$dp['id']?>" type="checkbox" onClick="checkparent(this,'<?= $dp['id']?>')" name="du[]" value="<?=$u['departemen']."-"?><?=$u['nama']?>" <?php foreach($akses_eksternal as $ae){echo ($ae['departemen'].'-'.$ae['user']==$dp['nama_departemen'].'-'.$u['nama'])?" checked ":"";}
                        	?>>  <?= $u['nama'] ?><br>
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


</fieldset>
</form>

<div class="modal fade" id="delfile">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Delete File</h4>
      </div>
	  <div class="modal-body">
		<form id="fdelfile" class="form-horizontal" role="form" method="post" action="<?php echo site_url("/admin/delfile"); ?>">
			<h4 class="modal-title">Yakin ingin Hapus File ini?</h4>
            <input type="hidden" name="id" id="delidfile" value="<?php echo $id ?>">
		</form>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="delfilego">Hapus</button>
	  </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
</div>
</div>

<!-- /.modal -->
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

<script type="text/javascript">

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
    $nd = array_column($x_no_dokumen, 'no_dokumen');
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

</script>