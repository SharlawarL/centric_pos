<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$p = array('admin','manager');
if(!(in_array($this->session->userdata('type'),$p))){
  redirect('auth');
}
$this->load->view('layout/header');
?>
<script type="text/javascript">
  function delete_id(id)
  {
     if(confirm('Sure To Remove This Record ?'))
     {
        window.location.href='<?php  echo base_url('assign_warehouse/delete/'); ?>'+id;
     }
  }
</script>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h5>
         <ol class="breadcrumb">
          <li><a href="<?php echo base_url('auth/dashboard'); ?>"><i class="fa fa-dashboard"></i><?php echo $this->lang->line('header_dashboard'); ?></a></li>
          <li class="active"><?php echo $this->lang->line('assign_warehouse'); ?></li>
        </ol>
      </h5>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
      <!-- right column -->
      <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $this->lang->line('assign_warehouse_list_assign_warehouse'); ?></h3>
              <a class="btn btn-sm btn-info pull-right" href="<?php echo base_url('assign_warehouse/add');?>" title="Add New Category" onclick=""><?php echo $this->lang->line('assign_warehouse'); ?></a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="index" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th><?php echo $this->lang->line('assign_warehouse_no'); ?></th>
                  <th><?php echo $this->lang->line('assign_warehouse_warehouse_name'); ?></th>
                  <th><?php echo $this->lang->line('assign_warehouse_user_name'); ?></th>
                  <th><?php echo $this->lang->line('assign_warehouse_actions'); ?></th>
                </tr>
                </thead>
                <tbody>
                    <?php 
                      foreach ($data as $row) {
                        $id= $row->id;
                    ?>
                    <tr>
                      <td></td>
                      <td><?php echo $row->warehouse_name; ?></td>
                      <td><?php echo $row->first_name.' '.$row->last_name; ?></td>
                      <td>
                          <!-- <a href="" title="View Details" class="btn btn-xs btn-warning"><span class="fa fa-eye"></span></a>&nbsp;&nbsp; -->
                          <a href="javascript:delete_id(<?php echo $id;?>)" title="Delete" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
                      </td>
                    </tr>  
                    <?php
                      }
                    ?>
                <tfoot>
                <tr>
                  <th><?php echo $this->lang->line('assign_warehouse_no'); ?></th>
                  <th><?php echo $this->lang->line('assign_warehouse_warehouse_name'); ?></th>
                  <th><?php echo $this->lang->line('assign_warehouse_user_name'); ?></th>
                  <th><?php echo $this->lang->line('assign_warehouse_actions'); ?></th>
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
