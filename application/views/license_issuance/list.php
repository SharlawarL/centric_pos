<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('layout/header');

?>

<script type="text/javascript">
  function generate_key()
  {
     if(confirm('Do you confirm to generate a license key?'))
     {
        window.location.href='<?php  echo base_url('license_issuance/generate_key'); ?>';
     }
  }
  $(function() {
    // setTimeout() function will be fired after page is loaded
    // it will wait for 5 sec. and then will fire
    // $("#successMessage").hide() function
    setTimeout(function() {
        $(".message").hide('blind', {}, 500)
    }, 5000);
  });
</script>

<script type="text/javascript">
  function delete_id(id)
  {
     if(confirm('Sure to remove this record?'))
     {
        window.location.href='<?php  echo base_url('license_issuance/delete/'); ?>'+id;
     }
  }
  $(function() {
    // setTimeout() function will be fired after page is loaded
    // it will wait for 5 sec. and then will fire
    // $("#successMessage").hide() function
    setTimeout(function() {
        $(".message").hide('blind', {}, 500)
    }, 5000);
  });
</script>

<div class="content-wrapper">

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h5>
        <ol class="breadcrumb">
        <li><a href="<?php echo base_url('auth/dashboard'); ?>"><i class="fa fa-dashboard"></i> <?php echo $this->lang->line('header_dashboard'); ?></a></li>
        <li class="active">License Issuance</li>
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

          <?php 
            if ($this->session->flashdata('success') != ''){ 
          ?>
          <div class="alert alert-success message">    
            <p><?php echo $this->session->flashdata('success');?></p>
          </div>
          <?php
            }
          ?>

          <?php 
            if ($this->session->flashdata('fail') != ''){ 
          ?>
          <div class="alert alert-danger message">    
            <p><?php echo $this->session->flashdata('fail');?></p>
          </div>
          <?php
            }
          ?>
        
          <div class="box">

              <div class="box-header with-border">

                <h3 class="box-title">License Issuance</h3>
                <?php
                if($this->session->userdata('type')=="admin"){
                ?>
                  <a class="btn btn-sm btn-info pull-right btn-flat" style="margin-right: 10px" href="javascript:generate_key()">Generate License Key</a>
                <?php 
                }
                ?>

              </div>

              <!-- /.box-header -->
              <div class="box-body">

                <table id="index" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th style="font-size: 12px;">No</th>
                      <th style="font-size: 12px;">Email</th>
                      <th style="font-size: 12px; width: 5%;">Plan Name</th>
                      <th style="font-size: 12px; width: 5%;">Subscription Status</th>
                      <th style="font-size: 12px; width: 20%;">License Key</th>
                      <th style="font-size: 12px; width: 10%;">Start Date</th>
                      <th style="font-size: 12px; width: 10%;">End Date</th>
                      <?php
                          if($this->session->userdata('type')=="admin"){
                      ?>    
                      <th style="font-size: 12px; width: 50%;">Action</th>
                      <?php 
                          }
                      ?>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
                        $no = 0;
                        $issue_no = 0;
                        foreach ($data as $row) {
                          if ($row->license_delete_status != 1) {
                          $id = $row->license_id;
                          $sub_id = $row->subscription_id;
                    ?>
                      <tr>
                        <td><?php echo ++$no; ?></td>
                        <td><?php echo $row->email; ?></td>
                        <td><?php echo $row->name; ?></td>
                        <?php
                          if ($row->license_key_status) {
                        ?>
                            <td><?php echo "ACTIVE"; ?></td>
                        <?php
                          }
                          else {
                        ?>
                          <td><?php echo "INACTIVE"; ?></td>
                        <?php
                          }
                        ?>
                        <td><?php echo $row->license_key; ?></td>
                        <td><?php echo $row->start_date; ?></td>
                        <td><?php echo $row->end_date; ?></td>
                        <?php
                            if($this->session->userdata('type')=="admin"){
                        ?>    
                        <td>
                          <?php if($row->license_key_status != 1) { ?>
                            <button type="button" data-toggle="modal" onClick="$('#issueLicense<?php echo ++$issue_no; ?>').modal()" title="Issue" class="btn btn-xs btn-info"><span>ISSUE</span></button>&nbsp;&nbsp;
                            <?php } else { ?>
                              <button type="button" data-toggle="modal" title="Issue" class="btn btn-xs btn-info" disabled><span>ISSUED</span></button>&nbsp;&nbsp;
                              <a href="<?php echo base_url('license_issuance/edit/'); ?><?php echo $sub_id; ?>" title="Edit" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-edit"></span></a>&nbsp;&nbsp;
                            <?php } ?>
                            <!-- Modal for Issue License Key -->
                            <div class="modal fade" id="issueLicense<?php echo $issue_no; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">

                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>

                                  </div>
                                  
                                  <form role="form" method="post" action="<?php echo base_url('license_issuance/assign_license');?>" encType="multipart/form-data">
                                  
                                    <div class="modal-body text-center" style="overflow-y:auto;">

                                      <div class="form-inline">

                                        <label for="license_key">License Key<span class="validation-color"> *</span></label><br>
                                        <input type="text" class="form-control" id="license_key" name="license_key" style="margin:auto; width: 75%;" value="<?php echo set_value('license_key', $row->license_key);?>" readonly>
                                        <input type="hidden" name="license_id" value="<?php echo $row->license_id;?>">
                                        <br>
                                        <span class="validation-color" id="err_license_key"><?php echo form_error('license_key'); ?></span>

                                      </div>
                                      <br>
                                      <br>
                                      <div class="form-inline">

                                        <label for="plan_id">Plan<span class="validation-color"> *</span></label><br>
                                        <select class="form-select" name="plan_id" id="plan_id" style="margin:auto; width: 75%;">
                                          <option value="">Choose a Plan</option>

                                          <?php foreach($plan as $row) { ?>
                                            <option value="<?php echo $row->plan_id; ?>"><?php echo $row->name; ?></option>
                                          <?php } ?>
                                          
                                        </select>
                                        <br>
                                        <span class="validation-color" id="err_plan_id"><?php echo form_error('plan_id'); ?></span>

                                      </div>
                                      <br>
                                      <br>
                                      <div class="form-inline">

                                        <label for="email">Email Address<span class="validation-color"> *</span></label><br>
                                        <input type="text" class="form-control" id="email" name="email" style="margin:auto; width: 75%;">
                                        <br>
                                        <span class="validation-color" id="err_email"><?php echo form_error('email'); ?></span>

                                      </div>
                                    </div>

                                    <div class="modal-footer">

                                      <button type="submit" id="submit" class="btn btn-info">Submit</button>
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                    </div>

                                  </form>

                                </div>
                              </div>
                            </div>
                            <!-- End Modal -->
                            <a href="javascript:delete_id(<?php echo $id;?>)" title="Delete" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
                        </td>
                        <?php 
                            }
                          }
                        }
                      ?>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th style="font-size: 12px;">No</th>
                      <th style="font-size: 12px;">Email</th>
                      <th style="font-size: 12px; width: 5%;">Plan Name</th>
                      <th style="font-size: 12px; width: 5%;">Subscription Status</th>
                      <th style="font-size: 12px; width: 20%;">License Key</th>
                      <th style="font-size: 12px; width: 10%;">Start Date</th>
                      <th style="font-size: 12px; width: 10%;">End Date</th>
                      <?php
                          if($this->session->userdata('type')=="admin"){
                      ?>    
                      <th style="font-size: 12px;">Action</th>
                      <?php 
                          }
                      ?>
                    </tr>
                  </tfoot>
                </table>
                
              </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
      </div>
      
      <!--/.col (right) -->
    </div>
    <!-- /.row -->
  </section>
    <!-- /.content -->
  </div><?php
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
      var email_regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
      var license_key = $('#license_key').val();
      var license_id = $('#license_id').val();
      var plan_id = $('#plan_id').val();
      var email = $('#email').val();
      
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