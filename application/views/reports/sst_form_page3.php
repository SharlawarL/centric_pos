
<div class="col-md-12">
    <div class="box" style="padding: 15px;">
        <div class="mainframe">
            <div class="box-header with-border">
                <div class="control-group">
                    <div class="controls">

                    </div>
                </div>
            </div>
            <table>
                <tr>
                    <td>

                        <h6>14) Jumlah Cukai Yang Kena Dibayar Sebelum Penalti Dikenakan* (RM)</h6>
                        <h6>
                            <p> Total Tax Payable Before Penalty Imposed* (RM)</p>
                        </h6>
                        <h6>
                            <p> (14) = (12) - (13)</p>
                        </h6>
                        <span class="validation-color" id="err_tax_before_penalty"><?php echo form_error('tax_before_penalty'); ?></span>

                    </td>

                    <td style=" text-align:center; width:25%;">
                    
                    </td>
                    <td style=" text-align:center;width:10%;">
                        
                    </td>
                    <td style=" text-align:center;width:25%;"> 

                        <input type="number" id="tax_before_penalty" name="tax_before_penalty" placeholder="RM">

                    </td>
                </tr>
                <tr>
                    <td>

                        <h6>15) Kadar Penalti / Amaun Penalti</h6>
                        <h6>
                            <p>Penalty Rate / Penalty Amount</p>
                        </h6>

                    </td>
                    <td style=" text-align:center; width:25%;">
                    
                    </td>
                    <td style=" text-align:center;width:10%;"> 

                        <input style=" text-align:center;" type="text" id="percent_penalty_rate" name="percent_penalty_rate" placeholder="%" disabled>

                    </td>
                    <td style=" text-align:center;width:25%;"> 
                        <input type="number" id="penalty_rate" name="penalty_rate" placeholder="RM">
                    </td>
                </tr>
                <tr>
                    <td>
                        <h6>16) Jumlah Cukai Kena Dibayar Termasuk Penalti (RM)</h6>
                        <h6>
                            <p>Total of Tax Payable Inclusive Penalty (RM)</p>
                        </h6>
                        <h6>
                            <p>(16) = (14) + (15)</p>
                        </h6>
                    </td>
                    <td style=" text-align:center; width:25%;">
                    
                    </td>
                    <td style=" text-align:center;width:10%;">
                    
                    </td>
                    <td style=" text-align:center;width:25%;"> 

                        <input type="number" id="tax_include_penalty" name="tax_include_penalty" placeholder="RM">

                    </td>
                </tr>
            </table>
            <div class="frame2">

                <h5 style="text-align:center;font-weight: bold;font-weight: bold;">BAHAGIAN C : BARANG-BARANG DI BAWAH JADUAL KEDUA, PERINTAH CUKAI JUALAN (KADAR CUKAI) 2018
                </h5>
                <h5 style="text-align:center;font-weight: bold;font-weight: bold;">PART C : GOODS UNDER SCHEDULE 2, SALES TAX ORDER (TAX RATE) 2018
                </h5>

            </div>

            <h6>17) Jumlah Nilai Jualan dan Cukai Yang Kena dibayar mengikut kadar cukai.</h6>
            <h6>
                <p>Total Value of Tax Payable as per rate of tax.</p>
            </h6>

            <table>
                <tr>
                    <td>   

                    </td>
                    <td>  

                    </td>
                    <td style="text-align:center;" >

                        <h6 >Sold Quantity</h6>

                    </td>
                    <td style="text-align:center;">

                        <h6>Kuantiti Jualan</h6>
                        <h6>
                            Value of Taxable Sales
                        </h6>

                    </td>
                    <td style="text-align:center;">

                        <h6>Nilai Jualan Bercukai (RM)</h6>
                        <h6>
                            Value of Tax Payable (RM)
                        </h6>

                    </td>
                    <td style="text-align:center;">

                        <h6>Nilai Cukai Kena Bayar (RM)</h6>

                    </td>
                </tr>
                <tr>
                    <td>

                        <h6>Berkadar</h6>
                        <h6>At Rate </h6>

                    </td>
                    <td>

                        <input type="number" id="sold_per_litre" name="sold_per_litre" placeholder="RM">
                        <span class="validation-color" id="err_sold_per_litre"><?php echo form_error('sold_per_litre'); ?></span>

                    </td>
                    <td style="text-align:center;">

                        <h6>Per Liter.*</h6>
                        <h6>Per Litre.*</h6>

                    </td>
                    <td> 

                        <input type="number" id="value_sales_litre" name="value_sales_litre" placeholder="">

                    </td>
                    <td> 

                        <input type="number" id="value_tax_litre" name="value_tax_litre" placeholder="RM">
                        
                    </td>
                    <td> 

                        <input type="number" id="value_pay_litre" name="value_pay_litre" placeholder="RM">

                    </td>
                </tr>
                <tr>
                    <td>

                        <h6>Berkadar</h6>
                        <h6>At Rate </h6>

                    </td>
                    <td >

                        <input type="number" id="sold_per_kg" name="sold_per_kg" placeholder="RM">
                        <span class="validation-color" id="err_sold_per_kg"><?php echo form_error('sold_per_kg'); ?></span>

                    </td>
                    <td style="text-align:center;">

                        <h6>Per Kilogram.*</h6>
                        <h6>Per Kilogram.*</h6>

                    </td>
                    <td> 

                        <input type="number" id="value_sales_kg" name="value_sales_kg" placeholder="">

                    </td>
                    <td> 

                        <input type="number" id="value_tax_kg" name="value_tax_kg" placeholder="RM">
                        
                    </td>
                    <td> 

                        <input type="number" id="value_pay_kg" name="value_pay_kg" placeholder="RM">

                    </td>
                </tr>
                <tr>
                    <td>

                        <h6>Berkadar</h6>
                        <h6>At Rate </h6>

                    </td>
                    <td>

                        <input type="number" id="sold_per_advolerum" name="sold_per_advolerum" placeholder="%">
                        <span class="validation-color" id="err_sold_per_advolerum"><?php echo form_error('sold_per_advolerum'); ?></span>

                    </td>
                    <td style="text-align:center;">

                        <h6>ad-volerum.*</h6>
                        <h6>ad-volerum.* </h6>

                    </td>
                    <td> 
                    </td>
                    <td> 

                        <input type="number" id="value_tax_advolerum" name="value_tax_advolerum" placeholder="RM">
                        
                    </td>
                    <td> 

                        <input type="number" id="value_pay_advolerum" name="value_pay_advolerum" placeholder="RM">

                    </td>
                </tr>
            </table>
            <div class="frame2">

                <h5 style="text-align:center;font-weight: bold;font-weight: bold;">BAHAGIAN D : JUALAN / PERKHIDMATAN YANG DIKECUALIKAN CUKAI
                </h5>
                <h5 style="text-align:center;font-weight: bold;font-weight: bold;">PART D : SALES / SERVICES EXEMPTED FROM TAX
                </h5>

            </div>

            <h6> 18) Jualan Barang-Barang Bercukai / Perkhidmatan Bercukai.*</h6>
            <h6>
                <p>Sales of Taxable Goods/ Taxable Services.*</p>
            </h6>
            

            <table>
                <tr>
                    <td>

                        <h6>a) Eksport / Kawasan Khas / Kawasan Ditetapkan.*</h6>
                        <h6>
                            <p>Export / Special Area / Designated Area.*</p>
                        </h6>
                        <span class="validation-color" id="err_area"><?php echo form_error('area'); ?></span>

                    </td>
                    <td style="width: 25%;">

                        <input type="number" id="area" name="area" value="" placeholder="RM">

                    </td>
                </tr>
                <tr>
                    <td>

                        <h6> b) Jualan Tempatan Kepada Orang di bawah Perintah Cukai Jualan (Orang Yang Dikecualikan Daripada Pembayaran Cukai Jualan) 2018: </h6>
                        <h6>
                            <p>Local sales exempted to person under the Sales Tax (Person Exempted From Payment of Sales Tax) Order 2018:-</p>
                        </h6>

                    </td>
                </tr>
                <tr>
                    <td>

                        <h6><p>1) Jadual A (Kumpulan Orang).* (RM)</p></h6>
                        <h6>
                            <div class="p2">Schedule A (Class of Person).* (RM)</div>
                        </h6>
                        <span class="validation-color" id="err_schedule_a"><?php echo form_error('schedule_a'); ?></span>

                    </td>
                    <td style="width: 25%;">

                        <input type="number" id="schedule_a" name="schedule_a" value="" placeholder="RM">

                    </td>
                </tr>
                <tr>
                    <td>

                        <h6><p>2) Jadual B (Pengilang Spesifik Barang Tidak Bercukai).* (RM)</p></h6>
                        <h6>
                            <div class="p2">Schedule A (Class of PersonSchedule B (Manufacturer of specific non taxable goods).* (RM)</div>
                        </h6>
                        <span class="validation-color" id="err_schedule_b"><?php echo form_error('schedule_b'); ?></span>

                    </td>
                    <td style="width: 25%;">

                        <input type="number" id="schedule_b" name="schedule_b" value="" placeholder="RM">

                    </td>
                </tr>
                <tr>
                    <td>

                        <h6><p> 3) Jadual C (Pengilang Berdaftar).* (RM)</p></h6>
                        <h6>
                        <div class="p2"> Schedule C (Registered Manufacturer).* (RM)</div>
                        </h6>
                        <span class="validation-color" id="err_schedule_c"><?php echo form_error('schedule_c'); ?></span>

                    </td>
                    <td style="width: 25%;">

                        <input type="number" id="schedule_c" name="schedule_c" value="" placeholder="RM">

                    </td>
                </tr>
                <tr>
                    <td>

                        <h6>
                            <div class="p3">i) Butiran 1 dan 2 (Pembelian / Pengimportan Bahan Mentah / Komponen / Bahan Pembungkusan Yang Dikecualikan Cukai Jualan).*</div>
                        </h6>
                        <h6>
                            <div class="p3">Item 1 and 2 (Purchase / Importation of Raw Materials / Components / Packaging Materials Exempted From Sales Tax).*</div>
                        </h6>
                        <span class="validation-color" id="err_item_12"><?php echo form_error('item_12'); ?></span>

                    </td>
                    <td style="width: 25%;">

                        <input type="number" id="item_12" name="item_12" value="" placeholder="RM">

                    </td>
                </tr>
                <tr>
                    <td>

                        <h6>
                            <div class="p3">ii) Butiran 3 dan 4 (Pembelian / Pengimportan Bahan Mentah / Komponen / Bahan Pembungkusan Bagi Pihak Pengilang Berdaftar Yang Dikecualikan Cukai Jualan).*</div>
                        </h6>
                        <h6>
                            <div class="p3">Item 3 and 4 (Purchase / Importation of Raw Materials / Components / Packaging Materials on behalf of Registered Manufacturer Exempted From Sales Tax).*</div>
                        </h6>
                        <span class="validation-color" id="err_item_34"><?php echo form_error('item_34'); ?></span>

                    </td>
                    <td style="width: 25%;">

                        <input type="number" id="item_34" name="item_34" value="" placeholder="RM">

                    </td>
                </tr>
                <tr>
                    <td>

                        <h6>
                            <div class="p3">iii) Butiran 5 (Nilai Kerja Dilakukan Yang Dikecualikan Cukai Jualan).*</div>
                        </h6>
                        <h6>
                            <div class="p3">Item 5 (Value of Work Performed Exempted from Sales Tax).*</div>
                        </h6>
                        <span class="validation-color" id="err_item_5"><?php echo form_error('item_5'); ?></span>

                    </td>
                    <td style="width: 25%;">

                        <input type="number" id="item_5" name="item_5" value="" placeholder="RM">

                    </td>
                </tr>
                <tr>
                    <td>

                        <h6>c) Jumlah Nilai Perkhidmatan Bercukai Yang Dikecualikan</h6>
                        <h6>
                            <p>Total Value of Exempted Taxable Services</p>
                        </h6>

                    </td>
                    <td style="width: 25%;">

                        <input type="number" id="exempted_tax" name="exempted_tax" value="" placeholder="RM">

                    </td>
                </tr> 
            </table>
        </div>
        <div class="button">

            <a class="btn btn-info" id="next_page3">Next</a>
            <a class="btn btn-default" style="margin-left: 1%;" onclick="prev_page(-1);">Back</a>

        </div>
    </div>
</div>