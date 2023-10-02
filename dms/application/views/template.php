<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="robots" content="noindex">
    <title><?php echo $title; ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <base href="<?php echo base_url(); ?>" />
    <link href="<?php echo base_url('/public/logo.png') ?>" rel="icon" />

    <link rel="stylesheet" href="<?php echo base_url() ?>/public/dist/css/jquery-ui.css">

    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/public/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/public/plugins/datatables/dataTables.bootstrap.css">
    <!-- DataTables Responsive -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/public/plugins/datatables/extensions/Responsive/css/dataTables.responsive.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/public/dist/css/AdminLTE.min.css">
    <!-- <link rel="stylesheet" href="<?php echo base_url() ?>/public/dist/css/custom.css"> -->
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/public/dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/public/plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/public/plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/public/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/public/plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/public/plugins/daterangepicker/daterangepicker.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/public/plugins/select2/select2.min.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/public/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <!-- jQuery - UI -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/public/bootstrap/css/jquery-ui.min.css">
    <!-- toaster -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/public/plugins/toastr/toastr.min.css">
    <!-- switchery -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/public/plugins/switchery/switchery.min.css">
	<!-- Tempusdominus Bootstrap 4 -->
	<link rel="stylesheet" href="<?php echo base_url() ?>/public/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
	<!-- iCheck -->
	<link rel="stylesheet" href="<?php echo base_url() ?>/public/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- JQVMap -->
	<link rel="stylesheet" href="<?php echo base_url() ?>/public/plugins/jqvmap/jqvmap.min.css">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="<?php echo base_url() ?>/public/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
	<!-- summernote -->
	<link rel="stylesheet" href="<?php echo base_url() ?>/public/plugins/summernote/summernote-bs4.min.css">


	
	
    <!-- jQuery 2.2.3 -->
    <script src="<?php echo base_url() ?>/public/plugins/jQuery/jquery-2.2.3.min.js"></script>
    <script src="<?php echo base_url() ?>/public/plugins/ckeditor4/ckeditor.js"></script>
    <script src="<?php echo base_url() ?>/public/dist/js/jquery-ui.js"></script>

    <!-- Switchery -->
    <!-- <script src="<?php echo base_url() ?>/public/plugins/switchery/switchery.js"></script> -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

    <script src="<?php echo base_url() ?>/public/plugins/masked-input/jquery.number.js"></script>
    <style>
        .font-error {
            color: red;
        }
    </style>
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <header class="main-header">

            <!-- View Header -->
            <?php $this->load->view('template/header'); ?>

        </header>

        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">

            <!-- View Sidebar -->
            <?php $this->load->view('template/sidebar'); ?>

        </aside>


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Load Content -->
            <?php echo $contents; ?>

        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">

            <!-- View Sidebar -->
            <?php $this->load->view('template/footer'); ?>

        </footer>
        <!-- Bootstrap 3.3.6 -->
        <script src="<?php echo base_url() ?>/public/bootstrap/js/bootstrap.min.js"></script>
        <!-- jQuery Form -->
        <script src="<?php echo base_url() ?>/public/bootstrap/js/jquery.form.min.js"></script>

        <!-- jQuery UI 1.11.4 -->
        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button);
        </script>

        <script src="<?php echo base_url() ?>/public/bootstrap/js/chosen.jquery.min.js"></script>
        <script src="<?php echo base_url() ?>/public/bootstrap/js/jquery.auto-complete.min.js"></script>

        <!-- Select2 -->
        <script src="<?php echo base_url() ?>/public/plugins/select2/select2.full.min.js"></script>
        <!-- Switchery -->
        <!-- <script src="<?php echo base_url() ?>/public/plugins/switchery/switchery.js"></script> -->
        <!-- DataTable -->
        <script src="<?php echo base_url() ?>/public/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url() ?>/public/plugins/datatables/dataTables.bootstrap.min.js"></script>
        <script src="<?php echo base_url() ?>/public/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
        <!-- Morris.js charts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="<?php echo base_url() ?>/public/plugins/morris/morris.min.js"></script>
        <!-- HighCharts JavaScript -->
        <script src="<?php echo base_url() ?>/public/highcharts/js/highcharts.js"></script>
        <script src="<?php echo base_url() ?>/public/highcharts/js/highcharts-3d.js"></script>
        <script src="<?php echo base_url() ?>/public/highcharts/js/modules/exporting.js"></script>
        <!-- Sparkline -->
        <script src="<?php echo base_url() ?>/public/plugins/sparkline/jquery.sparkline.min.js"></script>
        <!-- jvectormap -->
        <script src="<?php echo base_url() ?>/public/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="<?php echo base_url() ?>/public/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
        <!-- jQuery Knob Chart -->
        <script src="<?php echo base_url() ?>/public/plugins/knob/jquery.knob.js"></script>
        <!-- daterangepicker -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
        <script src="<?php echo base_url() ?>/public/plugins/daterangepicker/daterangepicker.js"></script>
        <!-- datepicker -->
        <script src="<?php echo base_url() ?>/public/plugins/datepicker/bootstrap-datepicker.js"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="<?php echo base_url() ?>/public/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
        <!-- Slimscroll -->
        <script src="<?php echo base_url() ?>/public/plugins/slimScroll/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="<?php echo base_url() ?>/public/plugins/fastclick/fastclick.js"></script>
        <!-- toaster -->
        <script src="<?php echo base_url() ?>/public/plugins/toastr/toastr.min.js"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo base_url() ?>/public/dist/js/app.min.js"></script>
        <!-- CK Editor -->
        <script src="<?php echo base_url() ?>/public/plugins/ckeditor2/ckeditor.js"></script>
        <!-- <script src="<?php echo base_url() ?>/public/plugins/ckeditor2/adapters/jquery.js"></script> -->
        <!-- AdminLTE for demo purposes -->
        <script src="<?php echo base_url() ?>/public/dist/js/demo.js"></script>

        <script src="<?php echo base_url() ?>/public/bootstrap/js/custom.js"></script>


        <!-- <script src="<?php echo base_url() ?>/public/bootstrap/js/jquery-ui.min.js"></script>
    <script src="<?php echo base_url() ?>/public/bootstrap/js/jquery.auto-complete.min.js"></script> -->
        <!-- <script src="<?php echo base_url() ?>/public/bootstrap/js/jquery.form.min.js"></script>  -->
        <!-- <script src="<?php echo base_url() ?>/public/bootstrap/js/jquery-2.2.2.min.js"></script>-->



        <script type="text/javascript">
            $(document).ready(function() {

                $("#tgl_pinjam").datepicker({
                    max: true,
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: "yyyy-mm-dd",
                    format: "yyyy-mm-dd",
                    autoclose: true,
                });

                $("#tgl_haruskembali").datepicker({
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: 'yyyy-mm-dd',
                    format: "yyyy-mm-dd",
                    autoclose: true,
                });

                $("#tgl_terbit").datepicker({
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: 'yyyy-mm-dd',
                    format: 'yyyy-mm-dd',
                    autoclose: true,
                });

                $("#masa").datepicker({
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: 'yyyy-mm-dd',
                    format: "yyyy-mm-dd",
                    autoclose: true,
                });

                $("#tgl_reminder").datepicker({
                    max: true,
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: "yyyy-mm-dd",
                    format: "yyyy-mm-dd",
                    autoclose: true,
                });

                $("#tgl_dok").datepicker({
                    max: true,
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: "yyyy-mm-dd",
                    format: "yyyy-mm-dd",
                    autoclose: true,
                });

                /** Init plugins dropdown chosen */
                $(".chosen").chosen();

                function formatnumber(x) {
                    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                }

                $(".trigger-submit").on("click", function(e) {
                    $("#singlebutton").trigger("click");
                });


                // var xhr;
                // $("input.xhr").each(function() {
                //     var obj = $(this);
                //     obj.autoComplete({
                //         minChars: 3,
                //         source: function(term, response) {
                //             // try { xhr.abort(); } catch(e){}
                //             xhr = $.getJSON(
                //                 obj.attr("data-xhr") + "/" + term,
                //                 { q: term },
                //                 function(data) {
                //                     response(data);
                //                 }
                //             );
                //         },
                //         renderItem: function(item, search) {
                //             // convert ke array
                //             var arr = Object.keys(item).map(function(k) {
                //                 return item[k];
                //             });
                //             return (
                //                 '<div class="autocomplete-suggestion" data-val="' +
                //                 arr[0] +
                //                 '">' +
                //                 arr[0] +
                //                 "</div>"
                //             );
                //         }
                //     });
                // });

            });

            // let log_off = new Date();
            // log_off.setSeconds(log_off.getSeconds + 5)
            // log_off = new Date(log_off)

            // let int_logoff = setInterval(function() {
            //     let now = new Date();
            //     if (now > log_off) {
            //         window.location.assign("<?php echo base_url() ?>/home/login");
            //         clearInterval(int_logoff);
            //     }
            // }, 5000);

            // $('body').on('click', function() {
            //     log_off = new Date();
            //     log_off.setSeconds(log_off.getSeconds() + 5)
            //     log_off = new Date(log_off)
            // })
        </script>
        <script>
            $(function() {

                /*CKEDITOR.replace('editor', {
                    contentsCss: 'body{background-color:#ecf0f5;}',
                });*/
                // CKEDITOR.replace('editoradd', {
                //     skin: 'moonocolor',
                //     contentsCss: 'body{background-color:#ecf0f5;}',
                // });
                // CKEDITOR.replace('editor1', {
                //     skin: 'moonocolor',
                //     contentsCss: 'body{background-color:#ecf0f5;}',
                // });

                $("section.layout").on("click", "a.delete", function() {

                    var url = $(this).attr("data-url");
                    $('#modal_delete_confirm').find("#btn_delete").attr("href", url);
                    $('#modal_delete_confirm').modal('show');

                });

                <?php if ($this->session->flashdata('notif')) { ?>

                    toastr.success('<?php echo $this->session->flashdata("notif"); ?>', 'Success!');

                <?php } ?>

                <?php if ($this->session->flashdata('err')) { ?>

                    toastr.error('<?php echo $this->session->flashdata("err"); ?>', 'Error');

                <?php } ?>

            });
        </script>

        <script type="text/javascript">
            // Disabled switch
            /*var Switchery = require('switchery');
            var disabled = document.querySelector('.js-switch-disabled');
            var init = new Switchery(disabled, {
                disabled: true,
            });

            // Colored switches
            var green = document.querySelector('.js-switch');
            var init = new Switchery(green);

            var blue = document.querySelector('.js-switch-blue');
            var init = new Switchery(blue, {
                color: '#41b7f1'
            });

            var pink = document.querySelector('.js-switch-pink');
            var init = new Switchery(pink, {
                color: '#ff7791'
            });

            var teal = document.querySelector('.js-switch-teal');
            var init = new Switchery(teal, {
                color: '#3cc8ad'
            });

            var red = document.querySelector('.js-switch-red');
            var init = new Switchery(red, {
                color: '#db5554'
            });

            var secondary = document.querySelector('.js-switch-secondary');
            var init = new Switchery(secondary, {
                color: '#fec200',
                secondaryColor: '#ff8787'
            });*/
        </script>

</body>

</html>