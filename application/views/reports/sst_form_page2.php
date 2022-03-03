<!-- right column -->
<div class="col-md-12">
    <div class="box" style="padding: 15px;">
        <div class="mainframe">
            <div class="box-header with-border">
                <div class="control-group">
                    <div class="controls">
                    </div>
                </div>
            </div>
            <div class="frame2">

                <h4 style="text-align:center;font-weight: bold;font-weight: bold;">BAHAGIAN B1 : MAKLUMAT JUALAN / PERKHIDMATAN</h4>
                <h4 style="text-align:center;font-weight: bold;font-weight: bold;">PART B1 : SALES / SERVICE DETAILS</h4>

            </div>
            <table id="customers">
                <tr>
                    <td style="text-align:center;width:5%">

                        <h6>(5)<br> Bil.</h6>
                        <h6>
                            No.
                        </h6>

                    </td>
                    <td style="text-align:center;width:17%">

                        <h6>(6)<br>
                            Maklumat Barang Kena
                            Cukai
                            <br>Jenis Perkhidmatan
                            Bercukai Disediakan / Diimport.*
                        </h6>
                        <h6>
                            <p>
                                Description of Taxable
                                Goods
                                <br>Type of Taxable Service
                                Provided / Imported.*
                            </p>
                        </h6>

                    </td>
                    <td style="text-align:center;width:17%">

                        <h6>(7)<br>
                            Kod Tariff Kastam
                            / Kod Jenis
                            Perkhidmatan.*
                        </h6>
                        <h6>
                            <p>
                                Customs Tariff
                                Code / Service
                                Type Code.*
                            </p>
                        </h6>
                    </td>
                    <td style="text-align:center;width:17%">

                        <h6>(8)<br>
                            Nilai Barang-barang
                            Dijual (Termasuk Nilai
                            Nota Debit)
                            / Nilai Kerja Yang
                            Dilakukan.*
                        </h6>
                        <h6>
                            <p>
                                Value of Taxable Goods
                                Sold (Including Value of
                                Debit Note) /
                                Value of Work
                                Performed. *
                            </p>
                            <br><b>( RM )</b>
                        </h6>

                    </td>
                    <td style="text-align:center;width:17%">

                        <h6>(9)<br>
                            Nilai Barang-barang Yang
                            Dipakai Sendiri
                            / Dilupus<br>
                            Nilai Perkhidmatan Yang
                            Diberi Percuma*
                        </h6>
                        <h6>
                            <p>
                                Value of Goods For Own Used /
                                Disposed
                                <br>Values of Free Services *
                            </p>
                            <br><b>( RM )</b>
                        </h6>

                    </td>
                    <td style="text-align:center;width:17%">

                        <h6>(10)<br>
                            Nilai
                            Perkhidmatan
                            Bercukai<br>
                            (Termasuk Nilai
                            Nota Debit) *
                        </h6>
                        <h6>
                            <p>
                                Value of Taxable
                                Service
                                <br>(Including Valueof Debit Note)*
                            </p>
                            <br><b>( RM )</b>
                        </h6>

                    </td>
                </tr>
                <tr>
                    <td style="text-align:center;width:5%">

                    </td>
                    <td style="text-align:center;width:17%">

                        <input type="text" id="tax_goods1" name="tax_goods1" placeholder="">
                        <span class="validation-color" id="err_tax_goods1"><?php echo form_error('tax_goods1'); ?></span>

                    </td>
                    <td style="text-align:center;width:17%">

                        <input type="text" id="tariff_code1" name="tariff_code1" placeholder="">
                        <span class="validation-color" id="err_tariff_code1"><?php echo form_error('tariff_code1'); ?></span>

                    </td>
                    <td style="text-align:center;width:17%">

                        <input type="number" id="goods_sold1" name="goods_sold1" placeholder="0.00 ">
                        <span class="validation-color" id="err_goods_sold1"><?php echo form_error('goods_sold1'); ?></span>

                    </td>
                    <td style="text-align:center;width:17%">

                        <input type="number" id="own_used1" name="own_used1" placeholder="0.00 ">
                        <span class="validation-color" id="err_own_used1"><?php echo form_error('own_used1'); ?></span>

                    </td>
                    <td style="text-align:center;width:17%">

                        <input type="number" id="tax_service1" name="tax_service1" placeholder="0.00 ">
                        <span class="validation-color" id="err_tax_service1"><?php echo form_error('tax_service1'); ?></span>

                    </td>
                </tr>
                <tr>
                    <td style="text-align:center;width:5%">

                    </td>
                    <td style="text-align:center;width:17%">
                    
                        <input type="text" id="tax_goods2" name="tax_goods2" placeholder=" ">

                    </td>
                    <td style="text-align:center;width:17%">

                        <input type="text" id="tariff_code2" name="tariff_code2" placeholder=" ">
                        
                    </td>
                    <td style="text-align:center;width:17%">

                        <input type="number" id="goods_sold2" name="goods_sold2" placeholder="0.00 ">

                    </td>
                    <td style="text-align:center;width:17%">

                        <input type="number" id="own_used2" name="own_used2" placeholder="0.00 ">

                    </td>
                    <td style="text-align:center;width:17%">

                        <input type="number" id="tax_service2" name="tax_service2" placeholder="0.00 ">

                    </td>
                </tr>
                <tr>
                    <td style="text-align:center;width:5%">

                    </td>
                    <td style="text-align:center;width:17%">

                        <input type="text" id="tax_goods3" name="tax_goods3" placeholder=" ">

                    </td>
                    <td style="text-align:center;width:17%">

                        <input type="text" id="tariff_code3" name="tariff_code3" placeholder=" ">

                    </td>
                    <td style="text-align:center;width:17%">

                        <input type="number" id="goods_sold3" name="goods_sold3" placeholder="0.00 ">

                    </td>
                    <td style="text-align:center;width:17%">

                        <input type="number" id="own_used3" name="own_used3" placeholder="0.00 ">

                    </td>
                    <td style="text-align:center;width:17%">

                        <input type="number" id="tax_service3" name="tax_service3" placeholder="0.00 ">

                    </td>
                </tr>
                <tr>
                    <td style="text-align:center;width:5%">

                    </td>
                    <td style="text-align:center;width:17%">

                        <input type="text" id="tax_goods4" name="tax_goods4" placeholder=" ">

                    </td>
                    <td style="text-align:center;width:17%">

                        <input type="text" id="tariff_code4" name="tariff_code4" placeholder=" ">

                    </td>
                    <td style="text-align:center;width:17%">

                        <input type="number" id="goods_sold4" name="goods_sold4" placeholder="0.00 ">

                    </td>
                    <td style="text-align:center;width:17%">

                        <input type="number" id="own_used4" name="own_used4" placeholder="0.00 ">

                    </td>
                    <td style="text-align:center;width:17%">

                        <input type="number" id="tax_service4" name="tax_service4" placeholder="0.00 ">

                    </td>
                </tr>
                <tr>
                    <td style="text-align:center;width:5%">

                    </td>
                    <td style="text-align:center;width:17%">

                        <input type="text" id="tax_goods5" name="tax_goods5" placeholder=" ">

                    </td>
                    <td style="text-align:center;width:17%">

                        <input type="text" id="tariff_code5" name="tariff_code5" placeholder=" ">

                    </td>
                    <td style="text-align:center;width:17%">

                        <input type="number" id="goods_sold5" name="goods_sold5" placeholder="0.00 ">

                    </td>
                    <td style="text-align:center;width:17%">

                        <input type="number" id="own_used5" name="own_used5" placeholder="0.00 ">

                    </td>
                    <td style="text-align:center;width:17%">

                        <input type="number" id="tax_service5" name="tax_service5" placeholder="0.00 ">

                    </td>
                </tr>
                
                <tr>
                    <td style="text-align:center;width:5%">

                    </td>
                    <td style="text-align:center;width:17%">

                    </td>
                    <td style="text-align:right;width:17%">

                        <h5><b>JUMLAH.*</h5>
                        <h5><b>TOTAL.*</h5>

                    </td>
                    <td style="text-align:center;width:17%">

                        <input type="number" id="total_sold" name="total_sold" placeholder="0.00 ">
                        <span class="validation-color" id="err_total_sold"><?php echo form_error('total_sold'); ?></span>

                    </td>
                    <td style="text-align:center;width:17%">

                        <input type="number" id="total_own" name="total_own" placeholder="0.00 ">
                        <span class="validation-color" id="err_total_own"><?php echo form_error('total_own'); ?></span>

                    </td>
                    <td style="text-align:center;width:17%">

                        <input type="number" id="total_service" name="total_service" placeholder="0.00 ">
                        <span class="validation-color" id="err_total_service"><?php echo form_error('total_service'); ?></span>

                    </td>
                </tr>
                <tr>
                    <td style="text-align:center;width:5%">

                    </td>
                    <td style="text-align:center;width:17%">

                    </td>
                    <td style="text-align:right;width:17%">
                    
                        <h5><b>JUMLAH KESELURUHAN.*</h5>
                        <h5><b>NET TOTAL.*</h5>
                        <span class="validation-color" id="err_net_total"><?php echo form_error('net_total'); ?></span>

                    </td>
                    <td style="text-align:center;">

                        <input type="number" id="net_total" name="net_total" placeholder="0.00 ">

                    </td>
                </tr>
            </table>
            <div class="frame2">

                <h5 style="text-align:center;font-weight: bold;font-weight: bold;">BAHAGIAN B2 : NILAI CUKAI YANG KENA DIBAYAR ATAS BARANGAN (JUALAN / PELUPUSAN /
                    KEGUNAAN SENDIRI) / PERKHIDMATAN (PERKHIDMATAN DIBERIKAN / KEGUNAAN SENDIRI)
                </h5>
                <h5 style="text-align:center;font-weight: bold;font-weight: bold;">PART B2 : VALUE OF TAX PAYABLE FOR GOODS (SALES, DISPOSED, OWN USE) /
                    SERVICES (SERVICES PERFORMED / OWN USE)
                </h5>

            </div>

            <h6>11) Jumlah Nilai Jualan dan Cukai Yang Kena dibayar Mengikut Kadar Cukai.*</h6>
            <h6>
                <p>Total Value of Tax Payable as Per Tax Rate.*</p>
            </h6>

            <table>
                <tr>
                    <td>

                        <h6>a) Barang Bercukai Berkadar 5%.</h6>
                        <h6>
                            <p>Taxable Goods at 5% Rate.</p>
                        </h6>

                    </td>
                    <td style=" text-align:center; width:25%;">

                        <h6>Nilai Jualan / Perkhidmatan Bercukai (RM)</h6>
                        <h6>Value of Taxable Sales / Service Tax Rate (RM)</h6>
                        <input type="number" id="rate_5" name="rate_5" placeholder="RM">

                    </td>
                    <td style=" text-align:center;width:10%;">

                        <h6>Kadar Cukai</h6>
                        <h6>Tax Rate</h6>
                        <input style=" text-align:center;" type="text" id="tax_5" name="tax_5" value="5%" disabled>

                    </td>
                    <td style=" text-align:center;width:25%;">

                        <h6>Nilai Cukai Kena Bayar</h6>
                        <h6>Value of Tax Payable</h6>
                        <input type="number" id="payable_5" name="payable_5" placeholder="RM">

                    </td>
                </tr>
                <tr>
                    <td>

                        <h6>b) Barang Bercukai Berkadar 10%.</h6>
                        <h6>
                            <p>Taxable Goods at 10% Rate.</p>
                        </h6>

                    </td>
                    <td style=" text-align:center; width:25%;"> 

                        <input type="number" id="rate_10" name="rate_10" placeholder="RM">

                    </td>
                    <td style=" text-align:center;width:10%;"> 

                        <input style=" text-align:center;" type="text" id="tax_10" name="tax_10" default value="10%" disabled>
                        
                    </td>
                    <td style=" text-align:center;width:25%;"> 

                        <input type="number" id="payable_10" name="payable_10" placeholder="RM">

                    </td>
                </tr>
                <tr>
                    <td>

                        <h6>c) Perkhidmatan Bercukai selain dari Kumpulan H</h6>
                        <h6>
                            <p>Taxable Services other than from Group H</p>
                        </h6>

                    </td>
                    <td style=" text-align:center; width:25%;"> 

                        <input type="number" id="rate_6" name="rate_6" placeholder="RM">

                    </td>
                    <td style=" text-align:center;width:10%;"> 

                        <input style=" text-align:center;" type="text" id="tax_6" name="tax_6" default value="6%" disabled>

                    </td>
                    <td style=" text-align:center;width:25%;"> 

                        <input type="number" id="payable_6" name="payable_6" placeholder="RM">

                    </td>
                </tr>
                <tr>
                    <td>

                        <h6>c) Perkhidmatan Bercukai dari Kumpulan H</h6>
                        <h6>
                            <p>Taxable Services from Group H</p>
                        </h6>

                    </td>
                    <td style=" text-align:center; width:25%;"> 

                        <input type="number" id="rate_25" name="rate_25" value="" placeholder="UNIT">

                    </td>
                    <td style=" text-align:center;width:10%;"> 

                        <input style=" text-align:center;" type="text" id="tax_25" name="tax_25" default value="RM 25" disabled>

                    </td>
                    <td style=" text-align:center;width:25%;"> 

                        <input type="number" id="payable_25" name="payable_25" placeholder="RM">

                    </td>
                </tr>
                <tr>
                    <td>

                        <h6>12) Jumlah Nilai Cukai Yang Kena Dibayar.*</h6>
                        <h6>
                            <p>Total Value of Tax Payable.*</p>
                        </h6>
                        <h6>
                            <p>(12) = [11(a) + 11(b)] ATAU / OR [11(c) + 11(d)]</p>
                        </h6>
                        <span class="validation-color" id="err_payable_tax"><?php echo form_error('payable_tax'); ?></span>

                    </td>
                    <td style=" text-align:center; width:25%;"> 

                    </td>
                    <td style=" text-align:center;width:10%;"> 

                    </td>
                    <td style=" text-align:center;width:25%;"> 

                        <input type="number" id="payable_tax" name="payable_tax" placeholder="RM">

                    </td>
                </tr>
                <tr>
                    <td>

                        <h6>13) Amaun Potongan cukai </h6>
                        <h6>
                            <p>Amount of Tax Deduction</p>
                        </h6>

                    </td>
                    <td style=" text-align:center; width:25%;"> 

                    </td>
                    <td style=" text-align:center;width:10%;"> 

                    </td>
                    <td style=" text-align:center;width:25%;"> 

                    </td>
                </tr>
                <tr>
                    <td>

                        <h6>a) Potongan Cukai Melalui Nota Kredit* (RM) </h6>
                        <h6>
                            <p>Tax Deduction from Credit Note* (RM)</p>
                        </h6>
                        <span class="validation-color" id="err_credit_deduction"><?php echo form_error('credit_deduction'); ?></span>
                    
                    </td>
                    <td style=" text-align:center; width:25%;"> 

                    </td>
                    <td style=" text-align:center;width:10%;"> 

                    </td>
                    <td style=" text-align:center;width:25%;"> 

                        <input type="number" id="credit_deduction" name="credit_deduction" placeholder="RM">

                    </td>
                </tr>
                <tr>
                    <td>

                        <h6>b) Potongan Cukai Jualan* (RM)</h6>
                        <h6>
                            <p> Sales Tax Deduction.* (RM)</p>
                        </h6>
                        <span class="validation-color" id="err_sales_deduction"><?php echo form_error('sales_deduction'); ?></span>
                    
                    </td>
                    <td style=" text-align:center; width:25%;"> 

                    </td>
                    <td style=" text-align:center;width:10%;"> 

                    </td>
                    <td style=" text-align:center;width:25%;"> 

                        <input type="number" id="sales_deduction" name="sales_deduction" placeholder="RM">
                        
                    </td>
                </tr>
                <tr>
                    <td>

                        <h6>c) Potongan Cukai Perkhidmatan* (RM)</h6>
                        <h6>
                            <p> Service Tax Deduction* (RM)</p>
                        </h6>
                        <span class="validation-color" id="err_service_deduction"><?php echo form_error('service_deduction'); ?></span>
                   
                    </td>
                    <td style=" text-align:center; width:25%;"> 

                    </td>
                    <td style=" text-align:center;width:10%;"> 

                    </td>
                    <td style=" text-align:center;width:25%;"> 

                        <input type="number" id="service_deduction" name="service_deduction" placeholder="RM">

                    </td>
                </tr>
                <tr>
                    <td>

                        <h6>13A) Pelarasan di bawah Potongan Cukai Jualan (RM)</h6>
                        <h6>
                            <p>Adjustment under Sales Tax Deduction (RM)</p>
                        </h6>

                    </td>
                    <td style=" text-align:center; width:25%;"> 

                    </td>
                    <td style=" text-align:center;width:10%;"> 

                    </td>
                    <td style=" text-align:center;width:25%;"> 

                        <input type="number" id="adjustment_deduction" name="adjustment_deduction" placeholder="RM">

                    </td>
                </tr>
            </table>
        </div>
        <div class="button">

            <a class="btn btn-info" id="next_page2">Next</a>
            <a class="btn btn-default" style="margin-left: 1%;" onclick="prev_page(-1);">Back</a>
        
        </div>
    </div>
</div>