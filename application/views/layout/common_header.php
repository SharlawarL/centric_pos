<?php
  
  if(is_null($this->db->get('company_settings')->row())){
    $favico = "";  
  }else{
    $favico = $this->db->get('company_settings')->row()->favico;  
  }
  
  if(is_null($this->db->get('company_settings')->row())){
    $theme = "skin-blue";  
  }else{
    $theme = $this->db->get('company_settings')->row()->theme;  
  }
  
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>abcd | Dashboard</title>
  <link rel="shortcut icon" type="image/png" href="<?php echo base_url().$favico; ?>" />

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- fullCalendar 2.2.5-->
  <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/fullcalendar/fullcalendar.min.css">
  <!-- Graph -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <!-- Close Graph -->
  <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/fullcalendar/fullcalendar.print.css" media="print">
  <!-- daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/datepicker/datepicker3.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/iCheck/all.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/colorpicker/bootstrap-colorpicker.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/select2/select2.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>dist/css/AdminLTE.min.css">
  <!-- jquery ui css -->
  <link rel="stylesheet" href="<?php echo base_url('assets/admin/css'); ?>/jquery-ui.css">
  
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>dist/css/skins/_all-skins.min.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url('assets/');?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/');?>documentation/style.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/autocomplite/') ?>jquery.auto-complete.css">
  
  <!-- jQuery UI 1.11.4 -->
  <script src="<?php echo base_url();?>assets/plugins/jQuery/jquery-3.1.1.js"></script> 

  <!-- AdminLTE for demo purposes -->
  <!-- <script src="<?php echo base_url();?>assets/dist/js/adminltedemo.js"></script> -->

  <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
  <script src="<?php echo base_url();?>assets/plugins/sha/sha256.min.js"></script>
  <script src="<?php echo base_url();?>assets/plugins/axios/axios.min.js"></script>
  <script src="<?php echo base_url();?>assets/plugins/dialog/sweetalert.min.js"></script>
        
  <!-- Bootstrap 3.3.6 -->
  <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
  <!-- Bootstrap 3.3.6 -->

  <script src="<?php echo base_url();?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
  <script src="<?php echo base_url();?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="<?php echo base_url();?>assets/plugins/knob/jquery.knob.js"></script>
  <!-- daterangepicker -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
  <script src="<?php echo base_url();?>assets/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- datepicker -->
  <script src="<?php echo base_url();?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
  <!-- Bootstrap WYSIHTML5 -->
  <script src="<?php echo base_url();?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
  <!-- Slimscroll -->
  <script src="<?php echo base_url();?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="<?php echo base_url();?>assets/plugins/fastclick/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url();?>assets/dist/js/app.min.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="<?php echo base_url();?>assets/dist/js/pages/dashboard.js"></script>
  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
  <!-- AdminLTE for demo purposes -->
  <!-- <script src="<?php echo base_url();?>assets/dist/js/demo.js"></script>
   -->
<script type="text/javascript">
  $(function() {
    // setTimeout() function will be fired after page is loaded
    // it will wait for 5 sec. and then will fire
    // $("#successMessage").hide() function
    setTimeout(function() {
        $(".message").hide('blind', {}, 500)
    }, 5000);
  });
</script>
</head>
<body class="hold-transition <?php echo $theme; ?> sidebar-mini">










































