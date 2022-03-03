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
        <li><a href="<?php echo base_url('reports/sst'); ?>">SST Reports</a></li>
        <li class="active">Edit SST Report</li>
      </ol>
    </h5> 
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
    <!-- right column -->
      <div class="col-md-12">
        <div class="box" style="padding: 15px;">
          <div class="box-header with-border">
            <div class="control-group">
              <div class="controls">

                <h4>EDIT REPORT</h4>
                
              </div>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body" style="padding: 15px;">
            <?php foreach($data as $row){?>
            <div class="row">
              <form target="" id="edit-profile" method="post" action="<?php echo base_url('reports/update_sst');?>">
              <div class= "card">
                <div class= "card-body">
                  <div class="col-md-12">
                    <div class="form-group">

                      <label for="report_name">Report Name</label>
                      <input type="text" class="form-control" id="sst_name" name="sst_name" value="<?php echo $row->sst_name; ?>" >
                      <input type="hidden" name="sst_id" value="<?php echo $row->sst_id;?>">
                      <span class="validation-color" id="err_sst_name"><?php echo form_error('err_sst_name'); ?></span>

                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">

                      <label for="start_date"><?php echo $this->lang->line('reports_start_date'); ?></label>
                      <input type="date" class="form-control" id="start_date" name="start_date" value="<?php echo $row->start_date; ?>">
                      <span class="validation-color" id="err_start_date"><?php echo form_error('start_date'); ?></span>

                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">

                      <label for="end_date"><?php echo $this->lang->line('reports_end_date'); ?></label>
                      <input type="date" class="form-control" id="end_date" name="end_date" value="<?php echo $row->end_date; ?>">
                      <span class="validation-color" id="err_end_date"><?php echo form_error('end_date'); ?></span>

                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="box-footer text-center">

                      <button type="submit" id="submit" class="btn btn-info">Update</button>
                      <span class="btn btn-default" id="cancel" style="margin-left: 2%" onclick="cancel('reports/sst')">Cancel</span>

                    </div>
                  </div>
                </div>
              </div>
              <?php } ?>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php
  $this->load->view('layout/footer');
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
      var sst_name = $('#sst_name').val();
      var start_date = $('#start_date').val();
      var end_date = $('#end_date').val();
      
        if(sst_name==null || sst_name==""){
        
          $("#err_sst_name").text("Please Enter Plan Name.");
          return false;
        }
        else{
          $("#err_sst_name").text("");
        }

        if (!sst_name.match(sname_regex) ) {
          $('#err_sst_name').text("Only Alphanumeric value is allowed.");  
          return false;
        }
        else{
          $("#err_sst_name").text("");
        }

        if(start_date==null || start_date==""){
        
          $("#err_start_date").text("Please Enter Start Date.");
          return false;
        }
        else{
          $("#err_start_date").text("");
        }

        if(end_date==null || end_date==""){
        
          $("#err_end_date").text("Please Enter End Date.");
          return false;
        }
        else{
          $("#err_end_date").text("");
        }
      
    }); 

    $("#sst_name").on("blur keyup",  function (event){
        
        var sname_regex = /^[\w\-\s]+$/;
        var sst_name = $('#sst_name').val();
        
        if(sst_name==null || sst_name==""){
          $("#err_sst_name").text("Please Enter Plan Name.");
          return false;
        }
        else{
          $("#err_sst_name").text("");
        }

        if (!sst_name.match(sname_regex) ) {
          $('#err_sst_name').text("Only Alphanumeric value is allowed.");   
          return false;
        }
        else{
          $("#err_sst_name").text("");
        }

    });

    $("#start_date").on("blur keyup",  function (event){

        var start_date = $('#start_date').val();
        
        if(start_date==null || start_date==""){
          $("#err_start_date").text("Please Enter Start Date.");
          return false;
        }
        else{
          $("#err_start_date").text("");
        }

    });

    $("#end_date").on("blur keyup",  function (event){

        var end_date = $('#end_date').val();
        
        if(end_date==null || end_date==""){
          $("#err_end_date").text("Please Enter End Date.");
          return false;
        }
        else{
          $("#err_end_date").text("");
        }

    });
    
  }); 
</script>













