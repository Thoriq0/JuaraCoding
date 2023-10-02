
<!-- Content Header (Page header) -->

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<section class="content-header">
    <h1>
        
        <a class="btn btn-primary" href="<?php echo site_url('/admin/vedit/'.$id); ?>"><i class="fa fa-edit"></i> &nbsp; Edit Data</a>
        <?php echo $this->session->flashdata('message'); ?>
    </h1>

   
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
                                <label> Nomor Arsip</label>
                            </th>
                            <th>
							  <?php echo $noarsip; ?>
                            </th>
                        </tr>
                        <tr>
                            <td>
                                <label class="form-input">
								  Tanggal Penciptaan
                                </label>
                            </td>
                            <td>
									<?php echo  date_format(date_create($tanggal),'d-M-Y');
									if($f=='sudah') {
										echo "<br /><b>Retensi Sudah Lewat : ".date_format(date_create($b),'d-M-Y')."</b>";
									}else {
										echo "<br />Retensi tanggal : ".date_format(date_create($b),'d-M-Y');
									}
								?>
								
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="form-input">Pencipta Arsip</label>
                            </td>
                            <td>
								<?php echo $nama_pencipta; ?>
                            </td>
                        </tr>
						<tr>
                            <td>
                                <label class="form-input">Unit Pengolah</label>
                            </td>
                            <td>
								<?php echo $nama_pengolah; ?>
                            </td>
                        </tr>
						<tr>
                            <td>
                                <label class="form-input">Kode Klasifikasi</label>
                            </td>
                            <td>
								<?php echo $nama_kode." - ".$nama; ?>
                            </td>
                        </tr>
						<tr>
                            <td>
                                <label class="form-input">Uraian</label>
                            </td>
                            <td>
									<?php echo $uraian; ?>
                            </td>
                        </tr>
						<tr>
                            <td>
                                <label class="form-input">Lokasi Arsip</label>
                            </td>
                            <td>
									<?php echo $nama_lokasi; ?>
                            </td>
                        </tr>
						<tr>
                            <td>
                                <label class="form-input">Jenis Media</label>
                            </td>
                            <td>
									<?php echo $nama_media; ?>
                            </td>
                        </tr>
						<tr>
                            <td>
                                <label class="form-input">Keterangan Keaslian</label>
                            </td>
                            <td>
									<?php echo $ket; ?>
                            </td>
                        </tr>
						<tr>
                            <td>
                                <label class="form-input">Jumlah</label>
                            </td>
                            <td>
									<?php echo $jumlah; ?>
                            </td>
                        </tr>
						<tr>
                            <td>
                                <label class="form-input">Nomor Box</label>
                            </td>
                            <td>
									<?php echo $nobox; ?>
                            </td>
                        </tr>
						<tr>
                            <td>
                                <label class="form-input">File</label>
                            </td>
                            <td>
								<?php echo ($file==""?"":"<a href='".base_url('uploads/'.$file)."' target='_blank'>".$file."</a>"); ?>
                            </td>
                        </tr>
						<tr>
                            <td>
                                <label class="form-input">Status</label>
                            </td>
                            <td>
								<?php 
								if($status == 0){
									echo "Tidak Aktif";
								} else{
									echo "Aktif";
								}
								?>
                            </td>
                        </tr>
						<tr>
                            <td>
                                <label class="form-input">Nama penginput</label>
                            </td>
                            <td>
								
								<?php echo $username; ?>
                            </td>
                        </tr>
                        
                    </table>
                </form>
            </div>
        </div>
    </section>
</div>
</section>






