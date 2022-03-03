<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('layout/header');

?>
<script type="text/javascript">
  function delete_id(id)
  {
     if(confirm('Sure to remove this record?'))
     {
        window.location.href='<?php  echo base_url('subscription/delete/'); ?>'+id;
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
        <li class="active">Subscription</li>
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

                <h3 class="box-title">List Subscription</h3>
                <?php
                if($this->session->userdata('type')=="admin"){
                ?>
                  <a class="btn btn-sm btn-info pull-right btn-flat" style="margin-right: 10px" href="<?php echo base_url('subscription/add');?>">Add New Plan</a>
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
                      <th style="font-size: 12px;">Plan Name</th>
                      <th style="font-size: 12px; width: 35%;">Description</th>
                      <th style="font-size: 12px; width: 15%;">Price (RM)</th>
                      <th style="font-size: 12px; width:10%;">Duration (months)</th>
                      <?php
                          if($this->session->userdata('type')=="admin"){
                      ?>    
                      <th style="font-size: 12px;">Action</th>
                      <?php 
                          }
                      ?>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                        $no = 0;
                        foreach ($data as $row) {
                          if ($row->plan_delete_status != 1) {
                          $id = $row->plan_id;
                    ?>
                      <tr>
                        <td><?php echo ++$no; ?></td>
                        <td><?php echo $row->name; ?></td>
                        <td><?php echo $row->description; ?></td>
                        <td align="right"><?php echo $row->price; ?></td>
                        <td align="right"><?php echo $row->duration; ?></td>
                        <?php
                            if($this->session->userdata('type')=="admin"){
                        ?>    
                        <td>
                            <a href="<?php echo base_url('subscription/edit/'); ?><?php echo $id; ?>" title="Edit" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-edit"></span></a>&nbsp;&nbsp;
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
                      <th style="font-size: 12px;">Plan Name</th>
                      <th style="font-size: 12px; width: 35%;">Description</th>
                      <th style="font-size: 12px; width: 15%;">Price (RM)</th>
                      <th style="font-size: 12px; width:10%;">Duration (months)</th>
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
