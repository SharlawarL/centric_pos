 <?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('layout/common_header');
?>

<div class="row">
  <div class="col-md-2 hidden-sm hidden-xs" style="padding: 0%;">
    <div class="container-fluid text-center" style="height: 100vh;padding: 0%;">
    <div style="margin-top: 500px;">
    <img src="<?php  echo base_url(); ?>assets/images/kedaiOnline.png"/><br>
      <span>Kedai Online Accounting ( M )</span>
      <br>
      <span>Accounting Software</span>
    </div>
    </div>
  </div>
  <div class="col-md-10">
  <div class="container text-capitalize" style="margin-top: 25px;padding: 10px;">
  <form action="<?php echo base_url();?>auth/signup?salesperson_code=<?php echo $salesperson_code ?>&salesperson_agency_code=<?php echo $salesperson_agency_code ?>" method="post" class="form-horizontal" enctype="multipart/form-data">
<div style="margin-bottom: 20px;margin-left: 10px;">
<span>Kedai Online Accounting ( M )</span>
      <br> 
      <span>Accounting Software</span>
</div>
  <div class="input-group-lg">
    <label>
      <span>first name</span>
    </label>
     <input type="text" class="form-control text-capitalize" placeholder="first name" id="first_name" name="first_name">
      <span class="validation-color" id="first_name_error"><?php echo form_error('first_name'); ?></span>

  </div>
  <div class="input-group-lg">
  <label>
      <span>last name</span>
    </label>
     <input type="text" class="form-control text-capitalize" placeholder="last name" id="last_name" name="last_name">
      <span class="validation-color" id="last_name_error"><?php echo form_error('last_name'); ?></span>

  </div>
  <div class="input-group-lg">
  <label>
      <span>email</span>
    </label>
     <input type="text" class="form-control text-capitalize" placeholder="email" id="email" name="email">
      <span class="validation-color" id="email_error"><?php echo form_error('email'); ?></span>

  </div>
  <div class="input-group-lg">
  <label>
      <span>password</span>
    </label>
     <input type="text" class="form-control text-capitalize" placeholder="password" id="password" name="password">
      <span class="validation-color" id="password_error"><?php echo form_error('password'); ?></span>

  </div>
  <div class="input-group-lg">
  <label>
      <span>password confirmation</span>
    </label>
     <input type="text" class="form-control text-capitalize" placeholder="password confirmation" id="password_confirmation" name="password_confirmation">
      <span class="validation-color" id="password_confirmation_error"><?php echo form_error('password_confirmation'); ?></span>

  </div>
  <div class="input-group-lg">
  <label>
      <span>mobile</span>
    </label>
     <input type="text" class="form-control text-capitalize" placeholder="mobile eg. +60" id="mobile" name="mobile">
      <span class="validation-color" id="mobile_error"><?php echo form_error('mobile'); ?></span>

  </div>
  <div class="input-group-lg">
  <label>
      <span>bank account number</span>
    </label>
     <input type="text" class="form-control text-capitalize" placeholder="bank account number" id="bank_account_number" name="bank_account_number">
      <span class="validation-color" id="bank_account_number_error"><?php echo form_error('bank_account_number'); ?></span>

  </div>
  <div class="input-group-lg">
  <label>
      <span>bank account name</span>
    </label>
     <input type="text" class="form-control text-capitalize" placeholder="bank account name" id="bank_account_name" name="bank_account_name">
      <span class="validation-color" id="bank_account_name_error"><?php echo form_error('bank_account_name'); ?></span>

  </div>
  <div class="input-group-lg">
  <label>
      <span>reference no</span>
    </label>
     <input type="text" class="form-control text-capitalize" readonly placeholder="salesperson no (loading...)" id="salesperson_code" name="salesperson_code" value="<?php echo $salesperson_code ?>">
      <span class="validation-color" id="salesperson_code_error"><?php echo form_error('salesperson_code'); ?></span>

  </div>
  <div class="input-group-lg">
  <label>
      <span>salesperson agency code</span>
    </label>
     <input type="text" class="form-control text-capitalize" readonly placeholder="salesperson code (loading...)" id="salesperson_agency_code" name="salesperson_agency_code" value="<?php echo $salesperson_agency_code ?>">
      <span class="validation-color" id="salesperson_agency_code_error"><?php echo form_error('salesperson_agency_code'); ?></span>

  </div>
  <div class="input-group-lg">
  <label>
      <span>salesperson agency name</span>
    </label>
     <input type="text" class="form-control text-capitalize" readonly placeholder="salesperson name (loading...)" id="salesperson_agency_name" name="salesperson_agency_name">
      <span class="validation-color" id="salesperson_agency_name_error"><?php echo form_error('salesperson_agency_name'); ?></span>

  </div>
  <div class="input-group-lg">
  <label>
      <span>salesperson name</span>
    </label>
     <input type="text" class="form-control text-capitalize" readonly placeholder="salesperson name (loading...)" id="salesperson_name" name="salesperson_name">
      <span class="validation-color" id="salesperson_name_error"><?php echo form_error('salesperson_name'); ?></span>

  </div>
  <div class="input-group-lg">
  <label>
      <span>ssm</span>
    </label>
     <input type="file" class="form-control text-capitalize" placeholder="ssm" id="ssm" name="ssm">
      <span class="validation-color" id="ssm_error"><?php echo form_error('ssm'); ?></span>

  </div>
  <div class="input-group-lg">
  <label>
      <span>bank statement</span>
    </label>
     <input type="file" class="form-control text-capitalize" placeholder="bank statement" id="bank_statement" name="bank_statement">
      <span class="validation-color" id="bank_statement_error"><?php echo form_error('bank_statement'); ?></span>

  </div>
  <div class="input-group-lg">
  <label>
      <span>identity card</span>
    </label>
     <input type="file" class="form-control text-capitalize" placeholder="ic" id="ic" name="ic">
      <span class="validation-color" id="ic_error"><?php echo form_error('ic'); ?></span>

  </div>
  <button class="btn btn-primary" name="submit" type="submit" value="submit" style="margin-top: 20px;margin-bottom: 20px;" id="submit" disabled>
     <span>submit</span>
  </button>
  </form>
  <input type="hidden" name="return_status" id="return_status" value="<?php if(isset($return_status)){echo $return_status;} ?>">
</div>
  </div>
</div>
</div>

<script>
  $(document).ready(function(){
    function callInvalidDialog(){
      swal({
        title: 'Invalid Affiliate Link given',
        icon: 'error',
        text: 'Agent record not found.',
        closeOnClickOutside: false,
        buttons: false
      })
    }

    function callSuccessDialog(){
      swal({
        title: 'Success',
        icon: 'success',
        text: 'Successfully registered user account',
        closeOnClickOutside: false,
      })
    }

    if ($('#return_status').val() == true) {
      callSuccessDialog()
    }

    const url = new URLSearchParams(window.location.search);
    const agent_param = $('#salesperson_code').val();
    const agency_param = $('#salesperson_agency_code').val();
    const current_timestamp = moment().format("Y-m-d H:m:s")
      axios.post('https://galaxymerchant2u.com/geranpks/api/getAgenInfo',{
        kod_agen: agent_param,
        kod_agensi: agency_param,
        timestamp: current_timestamp
      }).then((response) => {
        if (response.data.error_code == '00') {
          $('#salesperson_name').val(response.data.nama_agen)
          $('#salesperson_agency_name').val(response.data.nama_agensi)
          $('#submit').removeAttr('disabled')
        } else {
          callInvalidDialog()
        }
      })
  })
</script>