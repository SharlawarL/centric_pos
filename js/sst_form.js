var counter = 0;

function counter_form(page)
{
    var page1 = document.getElementById("form_page1");
    var page2 = document.getElementById("form_page2");
    var page3 = document.getElementById("form_page3");
    var page4 = document.getElementById("form_page4");

    if (page != 0) {
        counter = counter + page;
    }

    switch(counter) {
        default:
        page1.hidden = false;
        page2.hidden = true;
        page3.hidden = true;
        page4.hidden = true;
        break;
    case 1:
        page1.hidden = true;
        page2.hidden = false;
        page3.hidden = true;
        page4.hidden = true;
        break;
    case 2:
        page1.hidden = true;
        page2.hidden = true;
        page3.hidden = false;
        page4.hidden = true;
        break;
    case 3:
        page1.hidden = true;
        page2.hidden = true;
        page3.hidden = true;
        page4.hidden = false;
        break;
    }
}

function next_page(page) {
    var next = page;
    counter_form(next);
}

function prev_page(page) {
    var prev = page;
    counter_form(prev);
}

$(document).ready(function(){
    
    $("#next_page1").click(function(event){
        var name_regex = /^[-a-zA-Z\s]+$/;
        var p_name_regex = /^[-a-zA-Z0-9\s]+$/;
        var sname_regex = /^[\w\-\s]+$/;
        var num_regex = /^\$?[0-9]+(\.[0-9][0-9])?$/;
        var alphanum_regex = /^[a-z0-9]+$/i;
        var snum_regex = /^[0-9]+$/;
        var return_type = $("input[type=radio][name='return_type']:checked").val()
        var no_sst = $('#no_sst').val();

        var registered_name = $('#registered_name').val();
        var tax_start = $('#tax_start').val();
        var tax_end = $('#tax_end').val();
        var return_date = $('#return_date').val();

        function validation_page1() {
                
                if(!return_type){
                    $("#err_return_type").text("Please Tick Type of Return.");
                    return false;
                }
                else{
                    $("#err_return_type").text("");
                }

            
                if(no_sst==null || no_sst==""){
                
                    $("#err_no_sst").text("Please SST Registration No.");
                    return false;
                }
                else{
                    $("#err_no_sst").text("");
                }
            
                if (!no_sst.match(alphanum_regex) ) {
                    $('#err_no_sst').text("Only Alphanumeric value is allowed.");  
                    return false;
                }
                else{
                    $("#err_no_sst").text("");
                }
            
                if(registered_name==null || registered_name==""){
                
                    $("#err_registered_name").text("Please Enter Registered Manufacturer's Name.");
                    return false;
                }
                else{
                    $("#err_registered_name").text("");
                }
            
                if (!registered_name.match(sname_regex) ) {
                    $('#err_registered_name').text("Only Alphanumeric value is allowed.");  
                    return false;
                }
                else{
                    $("#err_registered_name").text("");
                }
            
                if(tax_start==null || tax_start==""){
                
                    $("#err_tax_start").text("Please Enter Start Date.");
                    return false;
                }
                else{
                    $("#err_tax_start").text("");
                }
            
                if(tax_end==null || tax_end==""){
                
                    $("#err_tax_end").text("Please Enter End Date.");
                    return false;
                }
                else{
                    $("#err_tax_end").text("");
                }
            
                if(return_date==null || return_date==""){
                
                    $("#err_return_date").text("Please Enter Return Date.");
                    return false;
                }
                else{
                    $("#err_return_date").text("");
                }

                return true;

            }

        if (validation_page1() == true) {
            next_page(1);
        }
    
    }); 

    $("#next_page2").click(function(event){
        var name_regex = /^[-a-zA-Z\s]+$/;
        var p_name_regex = /^[-a-zA-Z0-9\s]+$/;
        var sname_regex = /^[\w\-\s]+$/;
        var num_regex = /^\$?[0-9]+(\.[0-9][0-9])?$/;
        var alphanum_regex = /^[a-z0-9]+$/i;
        var snum_regex = /^[0-9]+$/;
        var return_type = $("input[type=radio][name='return_type']:checked").val()
        var no_sst = $('#no_sst').val();

        var tax_goods1 = $("#tax_goods1").val();
        var tariff_code1 = $("#tariff_code1").val();
        var goods_sold1 = $("#goods_sold1").val();
        var own_used1 = $("#own_used1").val();
        var tax_service1 = $("#tax_service1").val();
        var total_sold = $("#total_sold").val();
        var total_own = $("#total_own").val();
        var total_service = $("#total_service").val();
        var net_total = $("#net_total").val();
        var payable_tax = $("#payable_tax").val();
        var credit_deduction = $("#credit_deduction").val();
        var sales_deduction = $("#sales_deduction").val();
        var service_deduction = $("#service_deduction").val();

        function validation_page2() {
                
                if(tax_goods1==null || tax_goods1==""){
                
                    $("#err_tax_goods1").text("Please at least insert one.");
                    return false;
                }
                else{
                    $("#err_tax_goods1").text("");
                }

                if (!tax_goods1.match(sname_regex) ) {
                    $('#err_tax_goods1').text("Only Alphanumeric value is allowed.");  
                    return false;
                }
                    else{
                    $("#err_tax_goods1").text("");
                }
                
                if(tariff_code1==null || tariff_code1==""){
                
                    $("#err_tariff_code1").text("Please at least insert one.");
                    return false;
                }
                else{
                    $("#err_tariff_code1").text("");
                }

                if (!tariff_code1.match(sname_regex) ) {
                    $('#err_tariff_code1').text("Only Alphanumeric value is allowed.");  
                    return false;
                }
                    else{
                    $("#err_tariff_code1").text("");
                }
                
                if(goods_sold1==null || goods_sold1==""){
                
                    $("#err_goods_sold1").text("Please at least insert one.");
                    return false;
                }
                else{
                    $("#err_goods_sold1").text("");
                }

                if (!goods_sold1.match(num_regex) ) {
                    $('#err_goods_sold1').text(" Please Enter Valid Cost. (Ex - 1000 or 100.10)");   
                    return false;
                }
                    else{
                    $("#err_goods_sold1").text("");
                }
                
                if(own_used1==null || own_used1==""){
                
                    $("#err_own_used1").text("Please at least insert one.");
                    return false;
                }
                else{
                    $("#err_own_used1").text("");
                }

                if (!own_used1.match(num_regex) ) {
                    $('#err_own_used1').text(" Please Enter Valid Cost. (Ex - 1000 or 100.10)");   
                    return false;
                }
                    else{
                    $("#err_own_used1").text("");
                }
                
                if(tax_service1==null || tax_service1==""){
                
                    $("#err_tax_service1").text("Please at least insert one.");
                    return false;
                }
                else{
                    $("#err_tax_service1").text("");
                }

                if (!tax_service1.match(num_regex) ) {
                    $('#err_tax_service1').text(" Please Enter Valid Cost. (Ex - 1000 or 100.10)");   
                    return false;
                }
                    else{
                    $("#err_tax_service1").text("");
                }
                
                if(total_sold==null || total_sold==""){
                
                    $("#err_total_sold").text("Please fill in the box.");
                    return false;
                }
                else{
                    $("#err_total_sold").text("");
                }

                if (!total_sold.match(num_regex) ) {
                    $('#err_total_sold').text(" Please Enter Valid Cost. (Ex - 1000 or 100.10)");   
                    return false;
                }
                    else{
                    $("#err_total_sold").text("");
                }
                
                if(total_own==null || total_own==""){
                
                    $("#err_total_own").text("Please fill in the box.");
                    return false;
                }
                else{
                    $("#err_total_own").text("");
                }

                if (!total_own.match(num_regex) ) {
                    $('#err_total_own').text(" Please Enter Valid Cost. (Ex - 1000 or 100.10)");   
                    return false;
                }
                    else{
                    $("#err_total_own").text("");
                }
                
                if(total_service==null || total_service==""){
                
                    $("#err_total_service").text("Please fill in the box.");
                    return false;
                }
                else{
                    $("#err_total_service").text("");
                }

                if (!total_service.match(num_regex) ) {
                    $('#err_total_service').text(" Please Enter Valid Cost. (Ex - 1000 or 100.10)");   
                    return false;
                }
                    else{
                    $("#err_total_service").text("");
                }
                
                if(net_total==null || net_total==""){
                
                    $("#err_net_total").text("Please fill in the box.");
                    return false;
                }
                else{
                    $("#err_net_total").text("");
                }

                if (!net_total.match(num_regex) ) {
                    $('#err_net_total').text(" Please Enter Valid Cost. (Ex - 1000 or 100.10)");   
                    return false;
                }
                    else{
                    $("#err_net_total").text("");
                }
                
                if(payable_tax==null || payable_tax==""){
                
                    $("#err_payable_tax").text("Please fill in the box.");
                    return false;
                }
                else{
                    $("#err_payable_tax").text("");
                }

                if (!payable_tax.match(num_regex) ) {
                    $('#err_payable_tax').text(" Please Enter Valid Cost. (Ex - 1000 or 100.10)");   
                    return false;
                }
                    else{
                    $("#err_payable_tax").text("");
                }
                
                if(credit_deduction==null || credit_deduction==""){
                
                    $("#err_credit_deduction").text("Please fill in the box.");
                    return false;
                }
                else{
                    $("#err_credit_deduction").text("");
                }

                if (!credit_deduction.match(num_regex) ) {
                    $('#err_credit_deduction').text(" Please Enter Valid Cost. (Ex - 1000 or 100.10)");   
                    return false;
                }
                    else{
                    $("#err_credit_deduction").text("");
                }
                
                if(sales_deduction==null || sales_deduction==""){
                
                    $("#err_sales_deduction").text("Please fill in the box.");
                    return false;
                }
                else{
                    $("#err_sales_deduction").text("");
                }

                if (!sales_deduction.match(num_regex) ) {
                    $('#err_sales_deduction').text(" Please Enter Valid Cost. (Ex - 1000 or 100.10)");   
                    return false;
                }
                    else{
                    $("#err_sales_deduction").text("");
                }
                
                if(service_deduction==null || service_deduction==""){
                
                    $("#err_service_deduction").text("Please fill in the box.");
                    return false;
                }
                else{
                    $("#err_service_deduction").text("");
                }

                if (!service_deduction.match(num_regex) ) {
                    $('#err_service_deduction').text(" Please Enter Valid Cost. (Ex - 1000 or 100.10)");   
                    return false;
                }
                    else{
                    $("#err_service_deduction").text("");
                }

                return true;
            }

        if (validation_page2() == true) {
            next_page(1);
        }
    
    }); 

    $("#next_page3").click(function(event){
        var name_regex = /^[-a-zA-Z\s]+$/;
        var p_name_regex = /^[-a-zA-Z0-9\s]+$/;
        var sname_regex = /^[\w\-\s]+$/;
        var num_regex = /^\$?[0-9]+(\.[0-9][0-9])?$/;
        var alphanum_regex = /^[a-z0-9]+$/i;
        var snum_regex = /^[0-9]+$/;
        var return_type = $("input[type=radio][name='return_type']:checked").val()
        var no_sst = $('#no_sst').val();

        var tax_before_penalty = $("#tax_before_penalty").val();
        var sold_per_litre = $("#sold_per_litre").val();
        var sold_per_kg = $("#sold_per_kg").val();
        var sold_per_advolerum = $("#sold_per_advolerum").val();
        var area = $("#area").val();
        var schedule_a = $("#schedule_a").val();
        var schedule_b = $("#schedule_b").val();
        var schedule_c = $("#schedule_c").val();
        var item_12 = $("#item_12").val();
        var item_34 = $("#item_34").val();
        var item_5 = $("#item_5").val();

        function validation_page3() {
                
                if(tax_before_penalty==null || tax_before_penalty==""){
                
                    $("#err_tax_before_penalty").text("Please fill in the box.");
                    return false;
                }
                else{
                    $("#err_tax_before_penalty").text("");
                }

                if (!tax_before_penalty.match(num_regex) ) {
                    $('#err_tax_before_penalty').text(" Please Enter Valid Cost. (Ex - 1000 or 100.10)");   
                    return false;
                }
                    else{
                    $("#err_tax_before_penalty").text("");
                }
                
                if(sold_per_litre==null || sold_per_litre==""){
                
                    $("#err_sold_per_litre").text("Please fill in the box.");
                    return false;
                }
                else{
                    $("#err_sold_per_litre").text("");
                }

                if (!sold_per_litre.match(num_regex) ) {
                    $('#err_sold_per_litre').text(" Please Enter Valid Cost. (Ex - 1000 or 100.10)");   
                    return false;
                }
                    else{
                    $("#err_sold_per_litre").text("");
                }
                
                if(sold_per_kg==null || sold_per_kg==""){
                
                    $("#err_sold_per_kg").text("Please fill in the box.");
                    return false;
                }
                else{
                    $("#err_sold_per_kg").text("");
                }

                if (!sold_per_kg.match(num_regex) ) {
                    $('#err_sold_per_kg').text(" Please Enter Valid Cost. (Ex - 1000 or 100.10)");   
                    return false;
                }
                    else{
                    $("#err_sold_per_kg").text("");
                }
                
                if(sold_per_advolerum==null || sold_per_advolerum==""){
                
                    $("#err_sold_per_advolerum").text("Please fill in the box.");
                    return false;
                }
                else{
                    $("#err_sold_per_advolerum").text("");
                }

                if (!sold_per_advolerum.match(num_regex) ) {
                    $('#err_sold_per_advolerum').text(" Please Enter Valid Cost. (Ex - 1000 or 100.10)");   
                    return false;
                }
                    else{
                    $("#err_sold_per_advolerum").text("");
                }
                
                if(area==null || area==""){
                
                    $("#err_area").text("Please fill in the box.");
                    return false;
                }
                else{
                    $("#err_area").text("");
                }

                if (!area.match(num_regex) ) {
                    $('#err_area').text(" Please Enter Valid Cost. (Ex - 1000 or 100.10)");   
                    return false;
                }
                    else{
                    $("#err_area").text("");
                }
                
                if(schedule_a==null || schedule_a==""){
                
                    $("#err_schedule_a").text("Please fill in the box.");
                    return false;
                }
                else{
                    $("#err_schedule_a").text("");
                }

                if (!schedule_a.match(num_regex) ) {
                    $('#err_schedule_a').text(" Please Enter Valid Cost. (Ex - 1000 or 100.10)");   
                    return false;
                }
                    else{
                    $("#err_schedule_a").text("");
                }
                
                if(schedule_b==null || schedule_b==""){
                
                    $("#err_schedule_b").text("Please fill in the box.");
                    return false;
                }
                else{
                    $("#err_schedule_b").text("");
                }

                if (!schedule_b.match(num_regex) ) {
                    $('#err_schedule_b').text(" Please Enter Valid Cost. (Ex - 1000 or 100.10)");   
                    return false;
                }
                    else{
                    $("#err_schedule_b").text("");
                }
                
                if(schedule_c==null || schedule_c==""){
                
                    $("#err_schedule_c").text("Please fill in the box.");
                    return false;
                }
                else{
                    $("#err_schedule_c").text("");
                }

                if (!schedule_c.match(num_regex) ) {
                    $('#err_schedule_c').text(" Please Enter Valid Cost. (Ex - 1000 or 100.10)");   
                    return false;
                }
                    else{
                    $("#err_schedule_c").text("");
                }
                
                if(item_12==null || item_12==""){
                
                    $("#err_item_12").text("Please fill in the box.");
                    return false;
                }
                else{
                    $("#err_item_12").text("");
                }

                if (!item_12.match(num_regex) ) {
                    $('#err_item_12').text(" Please Enter Valid Cost. (Ex - 1000 or 100.10)");   
                    return false;
                }
                    else{
                    $("#err_item_12").text("");
                }
                
                if(item_34==null || item_34==""){
                
                    $("#err_item_34").text("Please fill in the box.");
                    return false;
                }
                else{
                    $("#err_item_34").text("");
                }

                if (!item_34.match(num_regex) ) {
                    $('#err_item_34').text(" Please Enter Valid Cost. (Ex - 1000 or 100.10)");   
                    return false;
                }
                    else{
                    $("#err_item_34").text("");
                }
                
                if(item_5==null || item_5==""){
                
                    $("#err_item_5").text("Please fill in the box.");
                    return false;
                }
                else{
                    $("#err_item_5").text("");
                }

                if (!item_5.match(num_regex) ) {
                    $('#err_item_5').text(" Please Enter Valid Cost. (Ex - 1000 or 100.10)");   
                    return false;
                }
                    else{
                    $("#err_item_5").text("");
                }
                
                

                return true;
            }

        if (validation_page3() == true) {
            next_page(1);
        }
    
    }); 

    $("#submit_SST").click(function(event){
        var name_regex = /^[-a-zA-Z\s]+$/;
        var p_name_regex = /^[-a-zA-Z0-9\s]+$/;
        var sname_regex = /^[\w\-\s]+$/;
        var num_regex = /^\$?[0-9]+(\.[0-9][0-9])?$/;
        var alphanum_regex = /^[a-z0-9]+$/i;
        var snum_regex = /^[0-9]+$/;
        var return_type = $("input[type=radio][name='return_type']:checked").val()
        var no_sst = $('#no_sst').val();

        var item_12_exempted = $("#item_12_exempted").val();
        var item_34_exempted = $("#item_34_exempted").val();
        var item_5_exempted = $("#item_5_exempted").val();
        var declaration = $("input[type=checkbox][name='declaration']:checked").val();
        var date_declaration = $("#date_declaration").val();
        var name_declaration = $("#name_declaration").val();
        var id_declaration = $("#id_declaration").val();
        var designation_declaration = $("#designation_declaration").val();
        var phone_declaration = $("#phone_declaration").val();

        function validation_page4() {
            
            if(item_12_exempted==null || item_12_exempted==""){
            
                $("#err_item_12_exempted").text("Please fill in the box.");
                return false;
            }
            else{
                $("#err_item_12_exempted").text("");
            }

            if (!item_12_exempted.match(num_regex) ) {
                $('#err_item_12_exempted').text(" Please Enter Valid Cost. (Ex - 1000 or 100.10)");   
                return false;
            }
                else{
                $("#err_item_12_exempted").text("");
            }
            
            if(item_34_exempted==null || item_34_exempted==""){
            
                $("#err_item_34_exempted").text("Please fill in the box.");
                return false;
            }
            else{
                $("#err_item_34_exempted").text("");
            }

            if (!item_34_exempted.match(num_regex) ) {
                $('#err_item_34_exempted').text(" Please Enter Valid Cost. (Ex - 1000 or 100.10)");   
                return false;
            }
                else{
                $("#err_item_34_exempted").text("");
            }
            
            if(item_5_exempted==null || item_5_exempted==""){
            
                $("#err_item_5_exempted").text("Please fill in the box.");
                return false;
            }
            else{
                $("#err_item_5_exempted").text("");
            }

            if (!item_5_exempted.match(num_regex) ) {
                $('#err_item_5_exempted').text(" Please Enter Valid Cost. (Ex - 1000 or 100.10)");   
                return false;
            }
                else{
                $("#err_item_5_exempted").text("");
            }

            if(!declaration){
                $("#err_declaration").text("In order to proceed, you need to tick the checkbox.");
                return false;
            }
            else{
                $("#err_declaration").text("");
            }

            if(date_declaration==null || date_declaration==""){
            
                $("#err_date_declaration").text("Please fill in the box.");
                return false;
            }
            else{
                $("#err_date_declaration").text("");
            }

            if(name_declaration==null || name_declaration==""){
            
                $("#err_name_declaration").text("Please fill in the box.");
                return false;
            }
            else{
                $("#err_name_declaration").text("");
            }

            if (!name_declaration.match(sname_regex) ) {
                $('#err_name_declaration').text(" Please Enter Alphanumeric value.");   
                return false;
            }
                else{
                $("#err_name_declaration").text("");
            }

            if(id_declaration==null || id_declaration==""){
            
                $("#err_id_declaration").text("Please fill in the box.");
                return false;
            }
            else{
                $("#err_id_declaration").text("");
            }

            if (!id_declaration.match(sname_regex) ) {
                $('#err_id_declaration').text(" Please Enter Alphanumeric value.");   
                return false;
            }
                else{
                $("#err_id_declaration").text("");
            }

            if(designation_declaration==null || designation_declaration==""){
            
                $("#err_designation_declaration").text("Please fill in the box.");
                return false;
            }
            else{
                $("#err_designation_declaration").text("");
            }

            if (!designation_declaration.match(sname_regex) ) {
                $('#err_designation_declaration').text(" Please Enter Alphanumeric value.");   
                return false;
            }
                else{
                $("#err_designation_declaration").text("");
            }

            if(phone_declaration==null || phone_declaration==""){
            
                $("#err_phone_declaration").text("Please fill in the box.");
                return false;
            }
            else{
                $("#err_phone_declaration").text("");
            }
            
            return true;
        }

        if (!validation_page4()) {
            return false;
        }

    }); 
});