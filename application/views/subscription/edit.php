<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('layout/header');
?>
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h5>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url('auth/dashboard'); ?>"><i class="fa fa-dashboard"></i> <?php echo $this->lang->line('header_dashboard'); ?></a></li>
          <li><a href="<?php echo base_url('subscription'); ?>">Subscription</a></li>
          <li class="active">Edit Plan</li>
        </ol>
      </h5>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <?php
          $this->load->view('layout/subscription_sidebar');
        ?>
        
        <div class="col-md-9">
          <div class="box">
            <div class="box-header with-border">

              <h3 class="box-title">Edit Plan</h3>

            </div>

            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">

                <form role="form" id="form" method="post" action="<?php echo base_url('subscription/editPlan');?>" encType="multipart/form-data">
                 <?php foreach($data as $row){?>

                  <div class="col-md-12">
                    <div class="form-group">

                      <label for="plan_name">Plan Name<span class="validation-color"> *</span></label>
                      <input type="text" class="form-control" id="plan_name" name="plan_name" value="<?php echo $row->name;?>">
                      <input type="hidden" name="id" value="<?php echo $row->plan_id;?>">
                      <span class="validation-color" id="err_plan_name"><?php echo form_error('plan_name'); ?></span>
                    
                    </div>

                    <div class="form-group">

                      <label for="plan_desc">Description<span class="validation-color"> *</span></label>
                      <textarea type="text" form="form" wrap="soft" class="form-control" id="plan_desc" name="plan_desc" style="height: 100px; resize:none;"><?php echo $row->description; ?></textarea>
                      <span class="validation-color" id="err_plan_desc"><?php echo form_error('plan_desc'); ?></span>
                    
                    </div>
                  </div>
                  
                  <div class="col-md-6">
                    <div class="form-group">

                      <label for="plan_price">Price (RM)<span class="validation-color"> *</span></label>
                      <input type="text" class="form-control" id="plan_price" name="plan_price" value="<?php echo set_value('plan_price',$row->price); ?>">
                      <span class="validation-color" id="err_plan_price"><?php echo form_error('plan_price'); ?></span>
                    
                    </div>
                  </div>
                  <div class="col-md-6">

                    <div class="form-group">

                      <label for="plan_duration">Duration<span class="validation-color"> *</span></label>
                      <input type="text" class="form-control" id="plan_duration" name="plan_duration" value="<?php echo set_value('plan_duration',$row->duration); ?>">
                      <span class="validation-color" id="err_plan_duration"><?php echo form_error('plan_duration'); ?></span>
                    
                    </div>
                  </div>
                <div class="col-sm-12">
                  <div class="box-footer">

                    <button type="submit" id="submit" class="btn btn-info">Update</button>
                    <span class="btn btn-default" id="cancel" style="margin-left: 2%" onclick="cancel('subscription')">Cancel</span>
                  
                  </div>
                </div>

                <?php }?>
                </form>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
      <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php
    $this->load->view('layout/product_footer');
  ?>

<script>
  $(document).ready(function(){
    
    $("#submit").click(function(event){
      var name_regex = /^[-a-zA-Z\s]+$/;
      var p_name_regex = /^[-a-zA-Z0-9\s]+$/;
      var sname_regex = /^[\w\-\s]+$/;
      var num_regex = /^\$?[0-9]+(\.[0-9][0-9])?$/;
      var alphanum_regex = /^[a-z0-9]+$/i;
      var snum_regex = /^[0-9]+$/;
      var plan_name = $('#plan_name').val();
      var plan_desc = $('#plan_desc').val();
      var plan_price = $('#plan_price').val();
      var plan_duration = $('#plan_duration').val();
      
        if(plan_name==null || plan_name==""){
        
          $("#err_plan_name").text("Please Enter Plan Name.");
          return false;
        }
        else{
          $("#err_plan_name").text("");
        }

        if (!plan_name.match(sname_regex) ) {
          $('#err_plan_name').text("Only Alphanumeric value is allowed.");  
          return false;
        }
        else{
          $("#err_plan_name").text("");
        }

        if(plan_desc==null || plan_desc==""){
        
          $("#err_plan_desc").text("Please Enter Plan Description.");
          return false;
        }
        else{
          $("#err_plan_desc").text("");
        }
      
        if(plan_price==null || plan_price==""){
          $("#err_plan_price").text("Please Enter Product Cost");
          return false;
        }
        else{
          $("#err_plan_price").text("");
        }
        if (!plan_price.match(num_regex) ) {
          $('#err_plan_price').text(" Please Enter Valid Product Cost. (Ex - 1000 or 100.10)");   
          return false;
        }
        else{
          $("#err_plan_price").text("");
        }
        
        if(plan_duration==null || plan_duration==""){
          $("#err_plan_duration").text("Please Enter Product Price");
          return false;
        }
        else{
          $("#err_plan_duration").text("");
        }
        if (!plan_duration.match(num_regex) ) {
          $('#err_plan_duration').text(" Please Enter Valid Product Price. (Ex - 1000 or 100.10)");   
          return false;
        }
        else{
          $("#err_plan_duration").text("");
        }

    }); 

    $("#plan_name").on("blur keyup",  function (event){
        
        var num_regex = /^[0-9]+$/;
        var plan_name = $('#plan_name').val();
        
        if(plan_name==null || plan_name==""){
          $("#err_plan_name").text("Please Enter Plan Name.");
          return false;
        }
        else{
          $("#err_plan_name").text("");
        }

        if (!plan_name.match(sname_regex) ) {
          $('#err_plan_name').text("Only Alphanumeric value is allowed.");   
          return false;
        }
        else{
          $("#err_plan_name").text("");
        }

        

    });

    $("#plan_desc").on("blur keyup",  function (event){
        
        var num_regex = /^[0-9]+$/;
        var plan_desc = $('#plan_desc').val();
        
        if(plan_desc==null || plan_desc==""){
          $("#err_plan_desc").text("Please Enter Product Plan Description.");
          return false;
        }
        else{
          $("#err_plan_desc").text("");
        }

    });

    $("#plan_price").on("blur keyup",  function (event){

        var plan_price = $('#plan_price').val();
        if(plan_price==null || plan_price==""){
          $("#err_plan_price").text("Please Enter Product Cost");
          return false;
        }
        else{
          $("#err_plan_price").text("");
        }
        if (!plan_price.match(num_regex) ) {
          $('#err_plan_price').text(" Please Enter Valid Product Cost. (Ex - 1000 or 100.10)");   
          return false;
        }
        else{
          $("#err_plan_price").text("");
        }
        
    });

    $("#plan_duration").on("blur keyup",  function (event){

        var plan_duration = $('#plan_duration').val();
        if(plan_duration==null || plan_duration==""){
          $("#err_plan_duration").text("Please Enter Product Price");
          return false;
        }
        else{
          $("#err_plan_duration").text("");
        }
        if (!plan_duration.match(num_regex) ) {
          $('#err_plan_duration').text(" Please Enter Valid Product Price. (Ex - 1000 or 100.10)");   
          return false;
        }
        else{
          $("#err_plan_duration").text("");
        }

    });

  }); 
</script>
