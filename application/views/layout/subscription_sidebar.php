<div class="col-md-3">
  <div class="box box-solid">
    <div class="box-header with-border">
      <h3 class="box-title">Folders</h3>
      
    </div>
    <div class="box-body no-padding">
        <ul class="nav nav-pills nav-stacked">
          <?php if($this->user_model->has_module_permission("plan")){ ?>
          <li <?php if($this->uri->segment(1)=='subscription') echo "class='active'"; ?>><a href="<?=base_url('subscription')?>"><i class="fa fa-bookmark"></i> Subscription</a></li>          
          <?php } ?>
          <?php if($this->user_model->has_module_permission("license")){ ?>
          <li <?php if($this->uri->segment(1)=='license_issuance') echo "class='active'"; ?>><a href="<?=base_url('license_issuance')?>"><i class="fa fa-key"></i> License Issuance</a></li>
          <?php } ?>
        </ul>
    </div>
  </div>
</div>