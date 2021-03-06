 <?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('layout/header');
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h5>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url('auth/dashboard'); ?>"><i class="fa fa-dashboard"></i> 
                <!-- Dashboard -->
                <?php echo $this->lang->line('header_dashboard'); ?></a></li>
          <li><a href="<?php echo base_url('ledger'); ?>">
              Ledger
              <?php echo $this->lang->line('customer_header'); ?></a>
          </li>
          <li class="active">Add Ledger
              <!-- <?php echo $this->lang->line('add_customer_label'); ?> -->
          </li>
        </ol>
      </h5>    
    </section>
      <section class="content">
      <div class="row">
      <!-- right column -->
      <?php $this->load->view('suggestion.php'); ?>
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">
                Add New Ledger/ Opening Balance
                <!-- <?php echo $this->lang->line('add_customer_header'); ?> -->
              </h3>
            </div>
            <!-- /.box-header -->
            <?php echo $this->session->flashdata('success');?>
            <!-- <?php echo validation_errors();?> -->
            <?php if(isset($error)) { echo $error; }?>
            <div class="box-body">
            <div class="col-sm-6">
              <div class="row">
                <form role="form" id="form" method="post" action="<?php echo base_url('ledger/add_ledger');?>">
                  <div class="panel-body">
                    
                    <!-- <div class="form-group">
                      <label  for="type">Type <span style="color:red;">*</span></label>
                      <select class="form-control select2" id="type" name="type">
                        <option value="0">Select</option>
                        <option value="Income">Income</option>
                        <option value="Expenditure">Expenditure</option>
                      </select>
                      <span class="validation-color" id="err_branch_name"><?php echo form_error('type'); ?></span>
                    </div> -->
                    <div class="form-group">
                      <label   for="title">Title <span style="color:red;">*</span></label>
                      <input type="text" class="form-control" placeholder="Title" id="title" name="title" value="<?php echo set_value('title'); ?>">
                      <span class="validation-color" id="err_branch_name"><?php echo form_error('title'); ?></span>
                    </div>
                    <div class="form-group">
                      <label  for="group">Group <span style="color:red;">*</span></label>
                      <select class="form-control select2" id="accountgroup" name="accountgroup">
                          <option value="0">Select</option>
                          <?php
                            foreach($accountgroup as $row)
                            {
                              echo "<option value='$row[id]' " . set_select('accountgroup', $row['id']) . " >". $row['group_title']."</option>";
                            }
                          ?>
                      </select>
                      <span class="validation-color" id="err_branch_name"><?php echo form_error('accountgroup'); ?></span>
                    </div>
                    
                    <div class="form-group">
                      <label   for="opening_balance">Opening Balance</label>
                      <input type="text" class="form-control" placeholder="Opening Balance" id="opening_balance" name="opening_balance" value="<?php echo set_value('opening_balance'); ?>">
                      <span class="validation-color" id="err_branch_name"><?php echo form_error('opening_balance'); ?></span>
                    </div>
                    <div class="form-group">
                      <label   for="opening_balance">Opening Date</label>
                      <input type="date" class="form-control" placeholder="Opening Date" id="opening_date" name="opening_date" value="<?php echo set_value('opening_date'); ?>">
                      <span class="validation-color" id="err_branch_name"><?php echo form_error('opening_date'); ?></span>
                    </div>
                    <div class="form-group">
                      <label   for="opening_balance">End Date</label>
                      <input type="date" class="form-control" placeholder="End Date" id="opening_date" name="end_date" value="<?php echo set_value('end_date'); ?>">
                      <span class="validation-color" id="err_branch_name"><?php echo form_error('end_date'); ?></span>
                    </div>

                    <div class="form-group">
                      <label  for="closing_balance">Closing Balance</label>
                      <input type="text" class="form-control" placeholder="Closing alance" id="closing_balance" name="closing_balance" value="<?php echo set_value('closing_balance'); ?>">
                      <span class="validation-color" id="err_branch_name"><?php echo form_error('closing_balance'); ?></span>
                    </div>
                    <div class="panel-body">
                      <p>
                        <button class="btn btn-info btn-flat" type="submit">Submit</button>
                        <a href="<?php echo base_url('ledger'); ?>" class="btn btn-default btn-flat" type="button">Cancel</a>
                      </p>
                    </div>
                  </div>
                </form>
                </div>
              </div>
        <!-- page end-->
            </div>
          </div>
        </div>
      </div>
        </section>
        <!--body wrapper end-->
  </div>
<?php
  $this->load->view('layout/footer');
?>