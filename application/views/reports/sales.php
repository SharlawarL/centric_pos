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
          <li class="active"><?php echo $this->lang->line('reports_sales_reports'); ?></li>
        </ol>
      </h5> 
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <?php $this->load->view('suggestion.php'); ?>
      <!-- right column -->
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <div class="control-group">
              <div class="controls">
              </div>
            </div>
          </div>
          <div class="box-body">
            <div class="row hide1">
              <form target="" id="edit-profile" method="post" action="<?php echo base_url('reports/sales_report');?>">
                <div class="col-md-6">

            </div>
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $this->lang->line('reports_sales_reports'); ?></h3>
              <input type="submit" class="pull-right btn btn-info btn-flat" id="pdf" name="submit" value="<?php echo $this->lang->line('product_alert_pdf'); ?>">
              <input type="submit" class="pull-right btn btn-info btn-flat" id="csv" name="submit" value="CSV">
              <input type="submit" class="pull-right btn btn-info btn-flat" id="print" name="submit" value="Print">
            </div></form>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="index" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th><?php echo $this->lang->line('product_no'); ?></th>
                  <th><?php echo $this->lang->line('purchase_date'); ?></th>
                  <th><?php echo $this->lang->line('purchase_reference_no'); ?></th>
                  <th><?php echo $this->lang->line('reports_biller'); ?></th>
                  <th><?php echo $this->lang->line('reports_customer'); ?></th>
                  <th><?php echo $this->lang->line('reports_product_qty'); ?></th>
                  <th><?php echo $this->lang->line('purchase_total').'('.$this->session->userdata('symbol').')'; ?></th>
                </tr>
                </thead>
                <tbody>
                  <?php 
                      foreach ($sales as $row) {
                    ?>
                    <tr>
                      <td></td>
                      <td><?php echo $row->date; ?></td>
                      <td><a href="<?php echo base_url('sales/view/').$row->sales_id; ?>"><?php echo $row->reference_no; ?></a></td>
                      <td><a href="<?php echo base_url('sales/billerView/').$row->biller_id; ?>"><?php echo $row->biller_name ?></a></td>
                      <td><a href="<?php echo base_url('sales/customerView/').$row->customer_id; ?>"><?php echo $row->customer_name ?></a></td>
                      <td>
                        <?php
                          foreach ($sales_items as $value) {
                            foreach ($products as $key) {
                              if($row->sales_id == $value->sales_id){
                                if($value->product_id == $key->product_id){
                                  echo $key->name."(".$value->quantity.")<br>";
                                }
                                
                              }
                            }
                          }
                        ?>
                          
                      </td>
                      <td><?php echo $row->total; ?></td>
                    <?php
                      }
                    ?>
                <tfoot>
                <tr>
                  <th><?php echo $this->lang->line('product_no'); ?></th>
                  <th><?php echo $this->lang->line('purchase_date'); ?></th>
                  <th><?php echo $this->lang->line('purchase_reference_no'); ?></th>
                  <th><?php echo $this->lang->line('reports_biller'); ?></th>
                  <th><?php echo $this->lang->line('reports_customer'); ?></th>
                  <th><?php echo $this->lang->line('reports_product_qty'); ?></th>
                  <th><?php echo $this->lang->line('purchase_total').'('.$this->session->userdata('symbol').')'; ?></th>
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
  </div>
  <!-- /.content-wrapper -->
<?php
  $this->load->view('layout/footer');
?>
<script type="text/javascript">
  $(document).ready(function(){
    $('#pdf').click(function(){
      $('form').attr('target','_blank');
    });
    $('#csv').click(function(){
      $('form').attr('target','_blank');
    });
    $('#print').click(function(){
      $('form').attr('target','_blank');
    });
    $('#submit').click(function(){
      $('form').attr('target','');
    });
  });
  $("#hide1").click(function(){
    $(".hide1").toggle();
  });
</script>
<script type="text/javascript">
$(document).ready(function() {

    //datepicker
    $('.datepicker').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        todayHighlight: true,
        orientation: "auto",
        todayBtn: true,
        todayHighlight: true,  
    });

});
</script>
