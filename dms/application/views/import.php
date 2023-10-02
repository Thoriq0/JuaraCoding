<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php
if ($this->session->flashdata('zz')) {
    echo '<div class="alert alert-danger" role="alert">' . $this->session->flashdata('zz') . '</div>';
}
?>

<section class="content-header">
    <ol class="breadcrumb">
        <li><a href="<?= site_url('home'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Import Data</li>
    </ol>
</section><br/>

<section class="content">
	<div class="row">

		<div class="col-xs-12">

			<div class="box">

				<div class="box-body">
					<h2>Import Data</h2>
					<hr>

						<div class="panel panel-default">
							<div class="panel-heading">Export data</div>
					  		<div class="panel-body"><a href="<?php echo site_url('/home/dl') ?>" class="btn btn-success" id="export">Export</a></div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">Import data <a href="<?php echo base_url('/public/template import arteri.xlsx') ?>" class="btn btn-success btn-sm" id="export">File template</a></div>
							<div class="panel-body">
								<form id="import_data" action="<?php echo site_url('/admin/importdata') ?>" enctype="multipart/form-data" class="form-horizontal" method="post" role="form">
									<label class="control-label" for="up_file">Upload</label>
									<input type="file" name="up_file" id="up_file" required/>
									<input type="submit" value="Upload" class="submit" />
								</form>
							</div>
						</div>

				</div><!-- .box-body -->		

			</div><!-- .box -->		

		</div><!-- .col-xs-12 -->

	</div><!-- .row -->
</section>