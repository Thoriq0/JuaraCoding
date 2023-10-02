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
<form class="form-horizontal" data-toggle="validator" action="<?php echo site_url('/admin/edit'); ?>" method="post" enctype="multipart/form-data">
<fieldset>
<input type="hidden" name="id" value="<?php echo $id ?>">
<input type="hidden" name="previous" value="<?php echo $previous ?>">
<!-- Form Name -->
<legend>Edit Data</legend>
<div class="row">
<div class="col-md-6"> <!-- 1st column -->
<div class="form-group">
	<label class="col-md-4 control-label" for="noarsip">Nomor Dokumen :</label>
	<div class="col-md-8">
	<input id="noarsip" name="noarsip" class="form-control input-md" type="text" value="<?php echo $noarsip ?>">
	</div>
</div>



<div class="form-group">
	<label class="col-md-4 control-label" for="tgl_pinjam">Tanggal Penciptaan :</label>
		<div class="col-md-8">
			<div class="input-group">
				 <div class="input-group-addon">(yyyy-mm-dd)</div>
			       <input id="tanggal" name="tanggal" class="form-control input-md" type="text" value="<?php echo $tanggal ?>">
            </div>
		</div>
</div>




<div class="form-group row">
		<label class="col-sm-4 control-label"> Pencipta Arsip : </label>
				<div class="col-sm-8">
							<select name="pencipta" id="pencipta" class="form-control"disable required>
							<?php
								if(isset($pencipta2)){
								foreach($pencipta2 as $k) {
								echo "<option value='".$k['id']."'".($pencipta==$k['id']?"selected=selected":"")." >".$k['nama_pencipta']."</option>";
								}
								}
							?>		
										
							</select>
						</div>
 </div>


 <div class="form-group row">
		<label class="col-sm-4 control-label"> Unit Pengolah : </label>
				<div class="col-sm-8">
							<select name="unitpengolah" id="unitpengolah" class="form-control"disable required>
							<?php
								if(isset($unitpengolah2)){
									foreach($unitpengolah2 as $k) {
										echo "<option value='".$k['id']."'".($unit_pengolah==$k['id']?"selected=selected":"")." >".$k['nama_pengolah']."</option>";
									}
								}
							?>	
										
							</select>
						</div>
 </div>

 <div class="form-group row">
		<label class="col-sm-4 control-label"> Kode Klasifikasi : </label>
				<div class="col-sm-8">
							<select name="kode" id="kode" class="form-control"disable required>
							<?php
								if(isset($kode2)){
									foreach($kode2 as $k) {
										echo "<option value='".$k['id']."'".($kode==$k['id']?"selected=selected":"")." >".$k['nama']." - ".$k['kode']."</option>";
									}
								}
							?>
										
							</select>
					</div>
 </div>



<div class="form-group">
	<label class="col-md-4 control-label" for="uraian">Uraian :</label>
	<div class="col-md-8">
  <textarea id="uraian" name="uraian" class="form-control" rows="3"><?php echo $uraian ?></textarea>
	</div>
</div>
</div><!-- /1st column -->

<div class="col-md-6"><!-- 2nd column -->

<div class="form-group row">
		<label class="col-sm-4 control-label"> Lokasi Arsip : </label>
				<div class="col-sm-8">
							<select name="lokasi" id="lokasi" class="form-control"disable required>
							<?php
								if(isset($lokasi2)){
									foreach($lokasi2 as $k) {
										echo "<option value='".$k['id']."'".($lokasi==$k['id']?"selected=selected":"")." >".$k['nama_lokasi']."</option>";
									}
								}
							?>
										
							</select>
					</div>
 </div>


 <div class="form-group row">
		<label class="col-sm-4 control-label"> Jenis Media : </label>
				<div class="col-sm-8">
							<select name="media" id="media" class="form-control"disable required>
							<?php
								if(isset($media2)){
									foreach($media2 as $k) {
										echo "<option value='".$k['id']."'".($media==$k['id']?"selected=selected":"")." >".$k['nama_media']."</option>";
									}
								}
							?>
										
							</select>
					</div>
 </div>


<div class="form-group">
	<label class="col-md-4 control-label" for="ket">Keterangan Keaslian :</label>
	<div class="col-md-8">
	<select class="form-control" name="ket" id="ket">
      <option value="asli" <?php echo ($ket=='asli'?"selected=selected":"") ?> >Asli</option>
      <option value="copy" <?php echo ($ket=='copy'?"selected=selected":"") ?> >Copy</option>
    </select>
	</div>
</div>

<div class="form-group">
	<label class="col-md-4 control-label" for="jumlah">Jumlah :</label>
	<div class="col-md-8">
	<input id="jumlah" name="jumlah" class="form-control input-md" type="text" value="<?php echo $jumlah ?>">
	</div>
</div>

<div class="form-group">
	<label class="col-md-4 control-label" for="nobox">Nomor Box :</label>
	<div class="col-md-8">
	<input id="nobox" name="nobox" class="form-control input-md" type="text" value="<?php echo $nobox ?>">
	</div>
</div>

<div class="form-group">
	<label class="col-md-4 control-label" for="nobox">File</label>
	<div class="col-md-8">
	<?php
		if($file!="") {
			echo "<span style='text-overflow:ellipsis;overflow:hidden;' id='linkfile' class='form-control'><a href='".base_url('uploads/'.$file)."'>$file</a></span>";
			echo "<span class='pull-right'><a href='#' data-toggle=\"modal\" data-target=\"#delfile\"><span class='glyphicon glyphicon-remove' style='color:red' aria-hidden='true'></span></a></span>";
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
	<label class="col-md-4 control-label" for="status">Status</label>
	<div class="col-md-8">
	<select class="form-control" name="status" id="status">
      <option value="1" <?php echo ($status=='1'?"selected=selected":"") ?> >Aktif</option>
      <option value="0" <?php echo ($status=='0'?"selected=selected":"") ?> >Tidak Aktif</option>
    </select>
	</div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-8">
    <button id="singlebutton" name="singlebutton" class="btn btn-success">Simpan</button>
  </div>
</div>

</div><!-- /2nd column -->
</div><!-- /.row -->


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