<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    $this->load->view('layout/header');
    ?>
<style>
    .mainframe {
    /* background-color: lightgrey; */
    /* width: 300px; */
    border: 1px solid grey;
    padding: 25px;
    margin: 15px;
    /* border-radius:15px; */
    }
    .frame {
    /* background-color: lightgrey; */
    /* width: 300px; */
    border: 1px solid grey;
    padding: 25px;
    margin: 15px;
    border-radius:15px;
    }
    .frame2 {
    background-color: #509ED8 ;
    /* width: 300px; */
    border: 1px solid black;
    /* padding: 25px; */
    margin: 15px;
    /* border-radius:15px; */
    }
    p {
    text-indent: 15px;
    }
    table {
    width: 100%;
    }
    td, th {
    text-align: left;
    padding: 8px;
    }
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
    }
    input[type=text], select {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    }
    input[type=number], select {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    -moz-appearance:textfield; /* Firefox */
    }
    input[type=date], select {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    }
    input[type=tel], select {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    }
    .button{
      text-align: right;
      padding: 15px;
    }
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h5>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url('auth/dashboard'); ?>"><i class="fa fa-dashboard"></i> <?php echo $this->lang->line('header_dashboard'); ?></a></li>
                <li class="active"><?php echo $this->lang->line('reports_sst_1_report'); ?></li>
            </ol>
        </h5>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div id="form_page1">

                <?php $this->load->view('reports/sst_form_page1'); ?>

            </div>
            <div id="form_page2" hidden>

                <?php $this->load->view('reports/sst_form_page2'); ?>

            </div>
            <div id="form_page3" hidden>

                <?php $this->load->view('reports/sst_form_page3'); ?>

            </div>
            <div id="form_page4" hidden>

                <?php $this->load->view('reports/sst_form_page4'); ?>

            </div>

        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php
    $this->load->view('layout/footer');
?>

<script type = 'text/javascript' src="<?php echo base_url(); ?>js/sst_form.js"></script> 
