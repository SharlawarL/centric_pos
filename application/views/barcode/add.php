<?php 
  $this->load->view('layout/header');


?>

<div class="content-wrapper">  
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-default">
          <div class="box-body">
            <form action="<?php echo base_url();?>barcode/print_barcode" method="POST" name="sales" id="sales_form">  
              <div class="col-md-12">
                <div class="well">
                  <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">
                              Search Product
                              <!-- <?php echo $this->lang->line('lbl_add_quotation_additems');?> -->
                            </label>
                          
                            <input id="product_name" class="form-control test" type="text" name="product_name" placeholder="Enter Product Name">
                        </div>
                      </div>

                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="" id="quantityMessage" style="font-weight:bold;margin:10px;" >
                      <input type="checkbox" name="product" id="product" class="case" value="yes">&nbsp;&nbsp;&nbsp;
                        <label for="product">Print With Product Name</label>
                  </div>
                </div>
              </div>
              <div class="row">
                  <div class="col-md-12">
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                      <div class="table-responsive">
                      <table class="table table-bordered sales_table" id="sales_table">
                        <thead>
                          <tr class="tbl_header_color dynamicRows">
                              <th width="30%" class="text-center">
                                Description
                                <!-- <?php echo $this->lang->line('lbl_add_quotation_desc');?> -->
                              </th>
                              <th width="20%" class="text-center">
                                HSN/SAC Code
                                  <!-- <?php echo $this->lang->line('lbl_hsn_code');?> -->
                              </th>
                              <th width="20%" class="text-center">
                                Quantity
                                <!-- <?php echo $this->lang->line('lbl_add_quotation_quantity');?> -->
                              </th>
                              <th width="20%" class="text-center">
                                Action
                                <!-- <?php echo $this->lang->line('lbl_quotation_action');?> -->
                              </th>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table>
                     
                      </div>
                      <br>
                     <br>    
                   </div>
                  </div>
                  
                  <div class="col-md-12">
                    <div class="form-group">
                        <input type="hidden" name="largeArea" id="largeArea">
                        <input type="hidden" name="temptext" id="temptext">
                    </div>
                    <center>
                        <input type="submit" name="salesSubmit" class="btn btn-info btn-flat salesSubmit" value=" <?php echo $this->lang->line('btn_submit');?>">
                        <a href="<?php echo base_url();?>" class="btn btn-default btn-flat"> <?php echo $this->lang->line('btn_cancel');?></a>
                    
                    </center>
                  </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
        <button id="printBtn" class="btn bg-purple btn-flat">Print</button>
      </div>
      </div>
    </div>

    <?php if(!empty($print)){?>
    <div class="row">
      <div class="col-md-12">
        <div class="box box-default">
          <div class="box-body">
              <div class="row barcode" >
                <div class="col-md-12">
                  <div style="width: 100%; overflow: hidden; margin: 0">
                    <?php 
                      foreach ($print as $key => $value) {
                        for($i=1;$i<=$value->qty;$i++){
                    ?>
                    <div style="vertical-align: middle; width: 240px; height: 133px; padding-top: 20px; float: left;" align="center">  
                      <table cellspacing="10" cellpadding="5" style="font-weight: bold">
                        <tr>
                          <td><?=$value->price?></td>
                          <td align="right">GST

                            <?php
                              // echo $value->sgst;
                              $gst = (($value->price * $value->sgst)/100) + (($value->price * $value->sgst)/100);
                              $gstprice = $value->price + $gst;

                              echo $gstprice;
                            ?>

                          </td>
                        </tr>
                        <tr>
                          <td colspan="2">
                            <img src="<?php echo $value->barcode;?>" width="100%" height="70">      
                          </td>
                        </tr>
                        <tr>
                          <td colspan="2" align="center">
                            <?php echo $value->item_name?>
                          </td>
                        </tr>
                        
                      </table>

                    </div>
                    <?php
                        }
                      }
                    ?>
                  </div>
                  <?php 
                    // foreach ($print as $key => $value) {
                    //   for($i=1;$i<=$value->qty;$i++){
                  ?>
                    <!-- <div class="col-md-4">
                      <?php 
                        // if(isset($name)){
                      ?>
                      <p style="margin-top: -5px;" align="center"><?php echo $value->item_name?></p>
                      <?php 
                        // }
                      ?>
                      <img src="<?php echo base_url();?>assets/barcode/<?php echo $value->barcode;?>" width="180" height="70">
                    </div> -->
                  <?php 
                    //   }
                    // } 
                  ?>  
                </div>
                
              </div>
          </div>
        </div>
      </div>
    </div>
    <?php } ?>
  </section>
</div>

<?php 
  $this->load->view('layout/footer');
  $this->load->view('layout/validation');
?>


<script type="text/javascript">
  $(document).ready(function()
  {
    $('#product_name').focus().select();

    $("#printBtn").click(function(){
      // alert();
        var mode = 'iframe'; //popup
        var close = mode == "popup";
        var options = { mode : mode, popClose : close};
        $("div.barcode").printArea( options );
    });

    $('#sales_form').on('keyup keypress keydown', function(e) {
      var keyCode = e.keyCode || e.which;
      //alert(keyCode);
      if (keyCode === 13) { 
        e.preventDefault();
        return false;
      }
    });

    var mapping = { };
    $(function(){
            $('#product_name').autoComplete({
                minChars: 1,
                source: function(term, suggest){
                    term = term.toLowerCase();
                    $.ajax({
                      url: "<?php echo base_url('barcode/getNameProducts') ?>/"+term,
                      type: "GET",
                      dataType: "json",
                      success: function(data){

                        var suggestions = [];
                        for(var i = 0; i < data.length; ++i) {
                            suggestions.push(data[i].barcode_id+" - "+data[i].name);
                            mapping[data[i].barcode_id+" - "+data[i].name] = data[i].product_id;
                        }
                        suggest(suggestions);
                        }
                    });
                },
                onSelect: function(event, ui) {
                  // alert(mapping[ui]);
                  $.ajax({
                    url:"<?php echo base_url('barcode/getProductUseName') ?>/"+mapping[ui],
                    type:"GET",
                    dataType:"JSON",
                    success: function(data1){
                      
                      filterData(data1);
                      $('#product_name').val('');
                    }
                  });
                } 
            });
            
      });


    $('#sales_table').on('click', '.delete', function () {

      var row_id = $(this).attr("id");
      $(this).closest('tr').remove();

      var currentRow=$(this).closest("tr");
      var ii=+currentRow.find('input[name^="id"]').val();
      itemArray[ii]=null;
      $('#largeArea').val(JSON.stringify(itemArray));
    });


    $("input[name='salesSubmit']").click(function(e){
          var flag = 0;
          $('.sales_data').each(function(){
            var currentRow=$(this).closest("tr");
            
            var qty1=+currentRow.find('input[name^="qty1"]').val();
            if(qty1 <= 0)
            {
              flag = 1;
            }
          });

          if(flag == 0){
            sales.submit();
            return true;
          }
          else{
            alert("some where Qty is missing")
            return false;
          }
    });


    $(document).on("click",".salesSubmit",function(){
      var ii=0;
      itemArray = new Array();
      var data="";
      $('.sales_data').each(function(){
          var currentRow=$(this).closest("tr");
          var qty1=+currentRow.find('input[name^="qty1"]').val();
          var item_id=+currentRow.find('input[name^="item_id"]').val();
          var item_name=currentRow.find('input[name^="product_name"]').val();
          var barcode=currentRow.find('input[name^="barcode_img"]').val();
          var cgst=currentRow.find('input[name^="cgst"]').val();
          var sgst=currentRow.find('input[name^="sgst"]').val();
          var price=currentRow.find('input[name^="price"]').val();

      
          var items={"item_id":item_id,"qty":qty1,"item_name":item_name,"barcode":barcode,"cgst":cgst,"sgst":sgst,"price":price}
          itemArray[ii]=items;

          $('#largeArea').val(JSON.stringify(itemArray));
          ii++;

      });
      $("input[name='temptext']").val(JSON.stringify(itemArray));

      
    });

  });
  
  function filterData(data1)
  {
     var flag=0;
      $("table.sales_table").find('input[name^="item_id"]').each(function () {
            if(data1['items'].product_id  == +$(this).val())
            {
              flag=1;
              alert("Oops Product Already In Sales !!");
            }   
      });
      if(flag == 0){
          addRow(data1);        
      }
  }  

  function addRow(data1,ii)
  {
      var table='<tr>'+                
                '<td class="sales_data">'+
                  '<input type="hidden" name="item_id" value="'+data1['items'].product_id+'" id="'+data1['items'].product_id+'">'+
                  '<input type="hidden" name="product_name" value="'+data1['items'].name+'" id="'+data1['items'].name+'">'+
                  '<input type="hidden" name="barcode_img" value="'+data1['items'].barcode+'" id="'+data1['items'].barcode+'">'+
                  '<input type="hidden" name="price" value="'+data1['items'].price+'" id="'+data1['items'].price+'">'+
                  '<input type="hidden" name="cgst" value="'+data1['items'].cgst+'" id="'+data1['items'].cgst+'">'+
                  '<input type="hidden" name="sgst" value="'+data1['items'].sgst+'" id="'+data1['items'].sgst+'">'+
                  data1['items'].name+
                '</td>'+

                '<td>'+
                  data1['items'].code+
                '</td>'+

                '<td>'+
                  '<input type="number" name="qty1" id="qty1" value="1" class="form-control get-data qty1" autocomplete="off" min="0">'+
                  '<p class="qty_error" style="color:#990000;"></p>'+
                '</td>'+
                
                '<td>'+
                      '<button type="button" name="remove" class="btn btn-danger btn-xs remove_abcdry delete" onclick="hello(this.value);" value="" id=""><span class="fa fa-remove"></span></button>'+ 
                '</td>'+

              '<tr>';
              
              $('#sales_table').append(table);
      }
</script>
<script src="<?php echo base_url('assets/plugins/autocomplite/');?>jquery.auto-complete.js"></script>