<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('layout/header');
?>
<style type="text/css">
  @media print {
    #print_statement {
      transform: rotate(-90deg);
    }
  }
</style>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h5>
         <ol class="breadcrumb">
          <li><a href="<?php echo base_url('auth/dashboard'); ?>"><i class="fa fa-dashboard"></i> <!-- Dashboard --><?php echo $this->lang->line('header_dashboard'); ?></a></li>
          <li class="active">Ledger Report</li>
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
              <h3 class="box-title">Ledger Report</h3>
            </div>
            <!-- /.box-header -->
                      <button type="submit" class="btn btn-sm pull-right" onclick="printDiv('print_statement')" style="margin-right: 10px;">
                        <i class="fa fa-print"></i>
                      </button>
                    </div>
                  </form>
                </div>
                    <div class="col-md-6" style="border-bottom:1px solid #e3e3e3;">
                      <p class="pull-right">
                      <span style="font-size: 18px;font-weight: bold;" class="pull-right">Account Summary</span><br>
                      01/01/<?php if(isset($year)){ echo $year;} ?> To 31/12/<?php if(isset($year)){ echo $year;} ?></p>
                    </div>
                    <div class="col-md-6">
                     <p>
                       <span>Beginning Balance : </span><span class="pull-right"><?php if(isset($data->opening_balance)){ echo round($data->opening_balance);} ?></span><br>
                       <span>Invoice Amount : </span><span class="pull-right"><?php if(isset($data->invoice_amount)){ echo round($data->invoice_amount);} ?></span><br>
                       <span>Amount Paid : </span><span class="pull-right"><?php if(isset($data->paid_amount)){ echo round($data->paid_amount);} ?></span><br>
                       <span>Balance Due : </span><span class="pull-right"><?php if(isset($data->invoice_amount)){ echo round($data->invoice_amount-$data->paid_amount);} ?></span>
                     </p>
                    </div>
                    <div class="col-md-12">
                      <p><center>Showing all invoices and payments between 01/01/<?php if(isset($year)){ echo $year;} ?> and 31/12/<?php if(isset($year)){ echo $year;} ?></center></p>
                    </div>
                    <div class="col-md-12" style="overflow-y: hidden;" id="print_statement">
                      <table class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                          <th>Date</th>
                          <th width="50%">Details</th>
                          <th>Invoice No</th>
                          <th>Debit</th>
                          <th>Credit</th>
                          <th>Balance</th> 
                          </tr>
                        </thead>
                        <tbody>
                        <?php $balance_due = 0; $debit = 0; $credit = 0;?>
                          <?php foreach($data as $item) { 
                                                          $debit += $item->paid_amount;
                                                          $credit +=  $item->invoice_amount;
                                                          $balance_due += $credit - $debit ?>
                          <tr>
                            <td><?php if(isset($item->invoice_date)){ echo $item->invoice_date;} ?></td>
                            <td align="left"><?php if(isset($item->cname)){ echo $item->cname;} ?></td>
                            <td align="right"><a href="#"><?php if(isset($item->invoice_no)){ echo $item->invoice_no;} ?></a></td>
                            <td align="right"><?php if(isset($item->paid_amount)){ echo $item->paid_amount;} ?></td>
                            <td align="right"><?php if(isset($item->invoice_amount)){ echo $item->invoice_amount;} ?></td>
                            <td align="right"><?php if(isset($item->invoice_amount)){ echo round($item->invoice_amount - $item->paid_amount);} ?></td>
                          </tr>
                        <?php } ?>
                          </tr><tr>
                            <td colspan="3" align="right">Balance Due</td>
                            <td align="right"><b></b></td>
                            <td align="right"><b></b></td>
                            <td align="right"><b><?php if(isset($balance_due)){ echo round($balance_due);}else{ echo "0.00";}?></b></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
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
  function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
  }
</script>
