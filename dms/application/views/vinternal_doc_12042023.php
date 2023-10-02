
<!-- Content Header (Page header) -->

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<section class="content-header">
   

   
    <ol class="breadcrumb">
        <li><a href="<?= site_url('home'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Data Arsip</li>
    </ol>
</section><br/>








<!-- Main content -->
<!-- <section class="content">
<div class="row">
<div class="col-md-6"> 

<div class="view-group row">
	<label class="col-md-6 control-label" for="noarsip">Nomor Arsip</label>
	<label class="col-md-6 isi"><?php echo $noarsip; ?></label>
</div>

<div class="view-group row">
	<label class="col-md-6 control-label" for="tanggal">Tanggal Penciptaan</label>
	<label class="col-md-6 isi"><?php echo  date_format(date_create($tanggal),'d-M-Y');
		if($f=='sudah') {
			echo "<br /><b>Retensi Sudah Lewat : ".date_format(date_create($b),'d-M-Y')."</b>";
		}else {
			echo "<br />Retensi tanggal : ".date_format(date_create($b),'d-M-Y');
		}
	?>
	</label>
</div>

<div class="view-group row">
	<label class="col-md-6 control-label" for="pencipta">Pencipta Arsip</label>
	<label class="col-md-6 isi"><?php echo $nama_pencipta; ?></label>
</div>

<div class="view-group row">
	<label class="col-md-6 control-label" for="unitpengolah">Unit Pengolah</label>
	<label class="col-md-6 isi"><?php echo $nama_pengolah; ?></label>
</div>

<div class="view-group row">
	<label class="col-md-6 control-label" for="kode">Kode Klasifikasi</label>
	<label class="col-md-6 isi"><?php echo $nama_kode." - ".$nama; ?></label>
</div>

<div class="view-group row">
	<label class="col-md-6 control-label" for="uraian">Uraian</label>
	<label class="col-md-6 isi"><?php echo $uraian; ?></label>
</div>

</div>

<div class="col-md-6">
<div class="view-group row">
	<label class="col-md-6 control-label" for="lokasi">Lokasi Arsip</label>
	<label class="col-md-6 isi"><?php echo $nama_lokasi; ?></label>
</div>

<div class="view-group row">
	<label class="col-md-6 control-label" for="media">Jenis Media</label>
	<label class="col-md-6 isi"><?php echo $nama_media; ?></label>
</div>

<div class="view-group row">
	<label class="col-md-6 control-label" for="ket">Keterangan Keaslian</label>
	<label class="col-md-6 isi"><?php echo $ket; ?></label>
</div>

<div class="view-group row">
	<label class="col-md-6 control-label" for="jumlah">Jumlah</label>
	<label class="col-md-6 isi"><?php echo $jumlah; ?></label>
</div>

<div class="view-group row">
	<label class="col-md-6 control-label" for="nobox">Nomor Box</label>
	<label class="col-md-6 isi"><?php echo $nobox; ?></label>
</div>

<div class="view-group row">
	<label class="col-md-6 control-label" for="nobox">File</label>
	<label class="col-md-6 isi"><?php echo ($file==""?"":"<a href='".base_url('files/'.$file)."' target='_blank'>".$file."</a>"); ?></label>
</div>

<div class="view-group row">
	<label class="col-md-6 control-label" for="nobox">Nama penginput</label>
	<label class="col-md-6 isi"><?php echo $username; ?></label>
</div>

</div><
</div><
</section> -->




<!-- Main content -->
<section class="content">
  <!-- Main row -->
  <div class="row">
    <!-- Left col -->
    <section class="content">
	    <!-- general form elements -->
		<div class="box box-primary">
			<div class="box-header with-border">
			  <h3 class="box-title">View Data</h3>
            <?= $this->session->flashdata('message'); ?>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
                <form method="post" action="">
                    <table border="0"> 
                        <tr>
                            <th width="150px"> 
                                <label> Nomor Dokumen</label>
                            </th>
                            <th>
							  <!-- <?php echo $doc->$no_dokumen; ?> -->
							  <?php echo $doc['no_dokumen']; ?>
                            </th>
                        </tr>
                        <tr>
                            <td>
                                <label class="form-input">
								  Tanggal Input
                                </label>
                            </td>
                            <td>
									<!-- <?php echo  date_format(date_create($tgl_input),'d-M-Y');?> -->
									<?php echo  date_format(date_create($doc['tgl_input']),'d-M-Y');?>

								
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="form-input">Nama Dokumen</label>
                            </td>
                            <td>
								
								<?php echo $doc['nama_dokumen']; ?>
                            </td>
                        </tr>
						<tr>
                            <td>
                                <label class="form-input">Owner Dokumen</label>
                            </td>
                            <td>
								<?php echo $doc['owner_dokumen']; ?>
                            </td>
                        </tr>
						<tr>
                            <td>
                                <label class="form-input">Group Dokumen</label>
                            </td>
                            <td>
								<?php echo $doc['group_dokumen']; ?>
                            </td>
                        </tr>
						<tr>
                            <td>
                                <label class="form-input">Deskripsi</label>
                            </td>
                            <td>
									<?php echo $doc['deskripsi']; ?>
                            </td>
                        </tr>
                        <!-- <tr>
                            <td>
                                <label class="form-input">Nama Departemen</label>
                            </td>
                            <td>    
                            <?php foreach($data_departemen as $dp) {?>
                                <input type="checkbox" id="fname" name="fname"><?php echo $dp['departemen'] ?><br>
                                    <?php foreach($data_akses as $da){ ?>
                                        <input type="checkbox" id="fname" name="fname"><?php echo $dp['tingkat_akses'] ?><br>
                                    <?php } ?>
                            <?php } ?>
                            </td>
                        </tr> -->
   
						<tr>
                            <td>
                                <label class="form-input">Lokasi Arsip</label>
                            </td>
                            <td>
									<?php echo $lokasi_nama; ?>
                            </td>
                        </tr>
						<tr>
                            <td>
                                <label class="form-input">Jenis Media</label>
                            </td>
                            <td>
									<?php echo $media_nama; ?>
                            </td>
                        </tr>
						<tr>
                            <td>
                                <label class="form-input">Jumlah</label>
                            </td>
                            <td>
									<?php echo $doc['jumlah']; ?>
                            </td>
                        </tr>
						<tr>
                            <td>
                                <label class="form-input">File</label>
                            </td>
                            <td>
								<?php echo ($doc['file']==""?"":"<a href='".base_url('uploads/'.$doc['file'])."' target='_blank'>".$doc['file']."</a>"); ?>
                            </td>
                        </tr>
						<tr>
                            <td>
                                <label class="form-input">Status</label>
                            </td>
                            <td>
								<?php 
								if($doc['is_status'] == 0){
									echo "Tidak Aktif";
								} else{
									echo "Aktif";
								}
								?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="form-input">Status</label>
                            </td>
                            <td>
								<?php 
								if($doc['is_status'] == 0){
									echo "Tidak";
								} else{
									echo "Ya";
								}
								?>
                            </td>
                        </tr>
						<tr>
                            <td>
                                <label class="form-input">Nama penginput</label>
                            </td>
                            <td>
                                <?php echo ($this->Admin_model->dataById('master_user','nik',$doc['username']))?$this->Admin_model->dataById('master_user','nik',$doc['username'])[0]['nama']:''; ?>
                            </td>
                        </tr>
                        
                    </table>
                </form>
            </div>
        </div>
    </section>
</div>
</section>






