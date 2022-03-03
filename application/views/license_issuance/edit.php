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
          <li><a href="<?php echo base_url('license_issuance'); ?>">License Issuance</a></li>
          <li class="active">Edit License Issuance</li>
        </ol>
      </h5>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        
        <div class="col-md-9">
          <div class="box">
            <div class="box-header with-border">

              <h3 class="box-title">Edit License Issuance</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <form role="form" id="form" method="post" action="<?php echo base_url('license_issuance/editLicenseIssuance');?>" encType="multipart/form-data">
                 <?php foreach($data as $row){?>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
  
                      <label for="plan_id">Plan<span class="validation-color"> *</span></label><br>
                      <select class="form-select" name="plan_id" id="plan_id" style="margin:auto; width: 100%;">
                        <option value="<?php echo $row->plan_id;?>"><?php echo $row->name;?></option>
  
                        <?php foreach($plan as $p) { ?>
                          <?php if ($p->plan_id != $row->plan_id) { ?>
                            <option value="<?php echo $p->plan_id; ?>"><?php echo $p->name; ?></option>
                          <?php } ?>
                        <?php } ?>
  
                        <span class="validation-color" id="err_plan_id"><?php echo form_error('plan_id'); ?></span>
                        
                      </select>
                      </div>
  
                      <div class="form-group">
  
                        <label for="email">Email<span class="validation-color"> *</span></label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo set_value('email',$row->email); ?>">
                        <input type="hidden" name="subscription_id" value="<?php echo $row->subscription_id;?>">
                        <span class="validation-color" id="err_email"><?php echo form_error('email'); ?></span>
  
                      </div>
                      <div class="form-group">

                        <label for="license_key">License Key<span class="validation-color"> *</span></label>
                        <input type="text" class="form-control" id="license_key" name="license_key" value="<?php echo set_value('license_key',$row->license_key); ?>" readonly>
                        <input type="hidden" name="license_id" value="<?php echo $row->license_id;?>">
                        <span class="validation-color" id="err_license_key"><?php echo form_error('license_key'); ?></span>
                      
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">

                        <label for="start_date">Start Date<span class="validation-color"> *</span></label>
                        <input type="date" class="form-control" id="start_date" name="start_date" value="<?php echo set_value('start_date',$row->start_date); ?>">
                        <span class="validation-color" id="err_start_date"><?php echo form_error('start_date'); ?></span>
                      
                      </div>
                      <div class="form-group">

                      <label for="duration">Duration (months)<span class="validation-color"> *</span></label>
                      <input type="text" class="form-control" id="duration" name="duration" value="<?php echo $row->duration;?>" readonly>
                      <span class="validation-color" id="err_duration"><?php echo form_error('duration'); ?></span>

                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">

                        <label for="end_date">End Date<span class="validation-color"> *</span></label>
                        <input type="date" class="form-control" id="end_date" name="end_date" value="<?php echo set_value('end_date',$row->end_date); ?>" readonly>
                        <span class="validation-color" id="err_end_date"><?php echo form_error('end_date'); ?></span>
                      
                      </div>
                      <div class="form-group">

                      <label for="price">Price<span class="validation-color"> *</span></label>
                      <input type="text" class="form-control" id="price" name="price" value="<?php echo $row->price;?>" readonly>
                      <span class="validation-color" id="err_price"><?php echo form_error('price'); ?></span>

                      </div>
                    </div>
                  </div>

                <div class="col-sm-12">
                  <div class="box-footer">

                    <button type="submit" id="submit" class="btn btn-info">Update</button>
                    <span class="btn btn-default" id="cancel" style="margin-left: 2%" onclick="cancel('license_issuance')">Cancel</span>

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

    $('#plan_id').change(function(){
      var id = $(this).val();

      $.ajax({
          url: "<?php echo base_url('license_issuance/getPlanData') ?>/"+id,
          type: "GET",
          dataType: "JSON",
          success: function(data){

            var startDate = $('#start_date')[0].value.toString();
            var newDate = moment(startDate, 'YYYY-MM-DD').add(parseInt(data[0].duration), 'months').format('YYYY-MM-DD');
            
            $('#end_date')[0].value = newDate;
            $('#price')[0].value = data[0].price.toString();
            $('#duration')[0].value = data[0].duration.toString();

          } 
        });

    });

    $('#start_date').change(function(){
      var startDate = $(this).val().toString();
      var planId = $('#plan_id')[0].value;

      $.ajax({
          url: "<?php echo base_url('license_issuance/getPlanData') ?>/"+planId,
          type: "GET",
          dataType: "JSON",
          success: function(data){

            var newDate = moment(startDate, 'YYYY-MM-DD').add(parseInt(data[0].duration), 'months').format('YYYY-MM-DD');
            $('#end_date')[0].value = newDate;

          } 
        });

    });

</script>

<script>
  $(document).ready(function(){
    var original_start_date = $('#start_date').val();
    
    $("#submit").click(function(event){
      var name_regex = /^[-a-zA-Z\s]+$/;
      var p_name_regex = /^[-a-zA-Z0-9\s]+$/;
      var sname_regex = /^[\w\-\s]+$/;
      var num_regex = /^\$?[0-9]+(\.[0-9][0-9])?$/;
      var alphanum_regex = /^[a-z0-9]+$/i;
      var snum_regex = /^[0-9]+$/;
      var email_regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
      var license_key = $('#license_key').val();
      var license_id = $('#license_id').val();
      var plan_id = $('#plan_id').val();
      var email = $('#email').val();
      var start_date = $('#start_date').val();

        if(new Date(start_date) < new Date()) {
          if (start_date != original_start_date) {
            $("#err_start_date").text("Date must be in the future or present.");
            return false;
          }
          else {
            $("#err_start_date").text("");
          }
        }
        else {
          $("#err_start_date").text("");
        }
      
        if(email==null || email==""){
        
          $("#err_email").text("Please enter an email address.");
          return false;
        }
        else{
          $("#err_email").text("");
        }

        if (!email.match(email_regex) ) {
          $('#err_email').text("You have entered an invalid email address.");  
          return false;
        }
        else{
          $("#err_email").text("");
        }

        if(plan_id==null || plan_id==""){
        
          $("#err_plan_id").text("Please choose a plan.");
          return false;
        }
        else{
          $("#err_plan_id").text("");
        }

    }); 

    $('#start_date').on("blur keyup", function (event) {
      var start_date = $('#start_date').val();

        if(new Date(start_date) < new Date()) {
          if (start_date != original_start_date) {
            $("#err_start_date").text("Date must be in the future or present.");
            return false;
          }
          else {
            $("#err_start_date").text("");
          }
        }
        else {
          $("#err_start_date").text("");
        }

    })

    $("#email").on("blur keyup",  function (event){
        
        var num_regex = /^[0-9]+$/;
        var email_regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        var email = $('#email').val();
        
        if(email==null || email==""){
          $("#err_emaile").text("Please enter an email address.");
          return false;
        }
        else{
          $("#err_email").text("");
        }

        if (!email.match(email_regex) ) {
          $('#err_email').text("You have entered an invalid email address.");   
          return false;
        }
        else{
          $("#err_email").text("");
        }

    });

    $("#plan_id").on("blur keyup",  function (event){
        
        var num_regex = /^[0-9]+$/;
        var plan_id = $('#plan_id').val();
        
        if(plan_id==null || plan_id==""){
          $("#err_plan_id").text("Please choose a plan.");
          return false;
        }
        else{
          $("#err_plan_id").text("");
        }

    });

  }); 
</script>