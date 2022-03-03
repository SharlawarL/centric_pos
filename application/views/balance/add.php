<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('layout/header');
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h5>
         <ol class="breadcrumb">
          <li><a href="<?php echo base_url('auth/dashboard'); ?>"><i class="fa fa-dashboard"></i> <!-- Dashboard --><?php echo $this->lang->line('header_dashboard'); ?></a></li>
          <li class="active">Opening Balance</li>
        </ol>
      </h5> 
    </section>
    <!-- Main content -->
    <section class="content">

    <?php $this->load->view('suggestion.php'); ?>

      <div class="row">
      <!-- right column -->
      <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"><!--Balance -->
                   Opening Balance
              </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form method="post" action="<?php echo base_url('balance/balance') ?>">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="month">Select Opening Date</label>
                    <label for="opening_date"><!-- Opening Date --><?php echo $this->lang->line('opening_date'); ?> <span class="validation-color">*</span></label>
                    <input type="text" class="form-control datepicker" id="opening_date" name="opening_date" value="<?php echo date("Y-m-d");  ?>">
                  </div>
                  <div class="form-group">
                  <label for="month">Select Ending Date</label>
                  <label for="end_date"><!-- Ending Date --><?php echo $this->lang->line('end_date'); ?> <span class="validation-color">*</span></label>
                    <input type="text" class="form-control datepicker" id="end_date" name="end_date" value="<?php echo date("Y-m-d");  ?>">
                  </div>
                  <label for="month">RM</label>
                  <label for="rm"><!-- RM --><?php echo $this->lang->line('rm'); ?> <span class="validation-color">*</span></label>
                    <input type="text" class="form-control" id="rm" name="rm" value="<?php echo set_value('rm'); ?>">
                  </div>

                </div>
                <div class="col-md-12">
                  <br><br>
                  <div class="">
                    <input type="submit" name="submit" value="SAVE" id="balance" class="btn btn-success btn-flat">
                    <span class="btn btn-default btn-flat" id="cancel" style="margin-left: 2%" onclick="cancel('auth/dashboard')"><?php echo $this->lang->line('company_setting_cancel'); ?></span>
                  </div>
                </div>
              </form>
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
  </div>
  <!-- /.content-wrapper -->
<?php
  $this->load->view('layout/footer');
?>
