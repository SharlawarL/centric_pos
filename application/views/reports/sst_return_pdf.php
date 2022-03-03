<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>

<style>
    .mainframe {
    border: 1px solid grey;
    padding: 25px;
    margin: 15px;
    }
    .frame {
    border: 1px solid grey;
    padding: 25px;
    border-radius:15px;
    line-height: 5px;
    }
    .frame2 {
    background-color: #509ED8;
    border: 1px solid black;
    margin: 15px;
    }
    .box {
        page-break-after: always;
    }
    body, h4, h5 {
        text-align: center;
    }
    table {
    width: 100%;
    }
    td, th {
        border: 1px solid black;
        vertical-align: middle;
        text-align: left;
        padding: 15px;
    }
    input {
    width: 25%;
    text-align:center;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 0;
    border-radius: 4px;
    box-sizing: border-box;
    }
    .button{
      text-align: right;
      padding: 15px;
    }
</style>
<body>
    <?php foreach ($data as $row) { ?>
    <div class="col-md-12">
        <div class="box" style="padding: 15px;">
            <div class="mainframe">
                <div class="box-header with-border">
                    <div class="control-group">
                        <div class="controls text-center">

                            <img src="<?php echo base_url ('assets\images\kastam.jpg') ?>" width=25%>
                            <h4 style="text-align:center;font-weight: bold;">JABATAN KASTAM DIRAJA MALAYSIA</h4>
                            <h4 style="text-align:center; font-weight: bold;">ROYAL MALAYSIAN CUSTOMS DEPARTMENT </h4>
                            <br>
                            <h5 style="text-align:center;font-weight: bold;font-weight: bold;">PERNYATA CUKAI JUALAN / CUKAI PERKHIDMATAN</h5>
                            <h5 style="text-align:center;font-weight: bold;"> SALES TAX / SERVICE TAX RETURN </h5>

                        </div>
                    </div>
                </div>

                <h5 style="font-weight: bold;margin:15px;">Nota Penting (Important Notes)</h5>

                <div class="frame">

                    <h6>1.) Sila isikan borang ini dengan menaip menggunakan <b>HURUF BESAR</b></h6>
                    <h6>
                        <p>Please type in using <b>BLOCK LETTERS</b></p>
                    </h6>
                    <h6>2.) Borang ini hendaklah diisi secara berasingan bagi Cukai Jualan dan Cukai Perkhidmatan</h6>
                    <h6>
                        <p>This form must be declared separately for Sales Tax and Service Tax</p>
                    </h6>
                    <h6>3.) Sila rujuk<b> Panduan Mengisi Penyata SST-02</b></h6>
                    <h6>
                        <p>Please refer to <b>SST-02 Returns Guidelines.</b></p>
                    </h6>
                    <h6>4.) Ruangan yang bertanda (*) adalah wajib diisi.</h6>
                    <h6>
                        <p>Column with (*) is a mandatory field.</p>
                    </h6>
                    <h6>5.) Sekiranya tiada nilai untuk diikrar, sila isi angka “0”.</h6>
                    <h6>
                        <p>If nothing to declare, please fill in “0”.</p>
                    </h6>
                    <h6>
                        <p>
                            6.) Sila hubungi Pusat Panggilan Kastam di talian 1-300-88-8500 / 03-78067200 atau emel 
                        </p>
                        <p>
                            <a style="color:blue;">ccc@customs.gov.my</a> untuk pertanyaan lanjut.
                        </p>
                    </h6>
                    <h6>
                        <p>
                            Please contact Customs Call Center at 1-300-88-8500 / 03-78067200 or email 
                        </p>
                        <p>
                            <a style="color:blue;">ccc@customs.gov.my</a> for further enquiry.
                        </p>
                    </h6>

                </div>
            </div>
        </div>
        <div class="box" style="padding: 15px;">
            <div class="mainframe">
                <div class="frame2">

                    <h4 style="text-align:center;font-weight: bold;font-weight: bold;">BAHAGIAN A : MAKLUMAT PENGILANG BERDAFTAR / ORANG BERDAFTAR</h4>
                    <h4 style="text-align:center;font-weight: bold;font-weight: bold;">PART A : REGISTERED MANUFACTURE / REGISTERED PERSON PARTICULARS</h4>
                
                </div>
                <table>
                    <tr>
                        <td>

                            <h6>1) Jenis Penyata (Tandakan x dalam kotak yang berkaitan)*</h6>
                            <h6>
                                <p>Type of Return (Tick x in the relevant box)*</p>
                            </h6>
                            
                        </td>
                        <td> 

                            <?php if ($row->return_type == 'Sales') { ?>
                                <input class="form-check-input" type="radio" id="return_type" name="return_type" id="return_type" checked="checked">
                            <?php } else { ?>
                                <input class="form-check-input" type="radio" id="return_type" name="return_type" id="return_type" value="Sales">
                            <?php } ?>
                                <label class="form-check-label" for="sales">
                                    CUKAI JUALAN / SALES TAX
                                </label>

                        <td>
                            
                            <?php if ($row->return_type == 'Service') { ?>
                                <input class="form-check-input" type="radio" id="return_type" name="return_type" id="return_type" checked="checked">
                            <?php } else { ?>
                                <input class="form-check-input" type="radio" id="return_type" name="return_type" id="return_type" value="Service">
                            <?php } ?>        
                            <label class="form-check-label" for="service">
                                CUKAI PERKHIDMATAN / SERVICE TAX
                            </label>

                        </td>
                        </td>
                    </tr>
                    <tr>
                        <td>

                            <h6>
                                <p>No. Pendaftaran SST.*</p>
                            </h6>
                            <h6>
                                <p>SST Registration No.*</p>
                            </h6>
                            
                        </td>
                        <td colspan="2">

                            <p><?php echo $row->no_sst; ?></p>

                        </td>
                    </tr>
                    <tr>
                    <td>

                            <h6>2) Nama Pengilang Berdaftar / Orang Berdaftar*.</h6>
                            <h6>
                                <p>Name of Registered Manufacturer / Registered
                                    Person.*
                                </p>
                            </h6>
                            
                        </td>
                        <td  colspan="2">

                            <p style="border: 1px solid black;"><?php echo $row->registered_name; ?></p>
                        
                        </td>
                    </tr>
                    <tr>
                        <td>

                            <h6>3) Tempoh Bercukai.*</h6>
                            <h6>
                                <p>Taxable Period.*</p>
                            </h6>

                        </td>
                        <td> 

                            <label for="Dari">Dari:</label>
                            <br>
                            <label for="From">From:</label>
                            <p><?php echo $row->tax_start; ?></p>
                            
                        </td>
                        <td>
                            
                            <label for="Dari">Hingga:</label>
                            <br>
                            <label for="From">Until:</label>
                            <p><?php echo $row->tax_end; ?></p>
                            
                        </td>
                    </tr>
                    <tr>
                        <td>

                            <h6>4) Tarikh Akhir Serahan Penyata dan Bayaran*</h6>
                            <h6>
                                <p>Return and Payment Due Date*</p>
                            </h6>

                        </td>
                        <td colspan="2">

                            <p><?php echo $row->return_date; ?></p>
                            
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

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
                            
                            1
                            
                        </td>
                        <td style="vertical-align: middle; text-align:center;width:17%">

                            <p><?php echo $row->tax_goods1; ?></p>

                        </td>
                        <td style="text-align:center;width:17%">

                            <p><?php echo $row->tariff_code1; ?></p>

                        </td>
                        <td style="text-align:center;width:17%">

                            <p>RM <?php echo $row->goods_sold1; ?></p>

                        </td>
                        <td style="text-align:center;width:17%">

                            <p>RM <?php echo $row->own_used1; ?></p>

                        </td>
                        <td style="text-align:center;width:17%">

                            <p>RM <?php echo $row->tax_service1; ?></p>

                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:center;width:5%">

                            2

                        </td>
                        <td style="text-align:center;width:17%">
                        
                            <p><?php echo $row->tax_goods2; ?></p>

                        </td>
                        <td style="text-align:center;width:17%">

                            <p><?php echo $row->tariff_code2; ?></p>
                            
                        </td>
                        <td style="text-align:center;width:17%">

                            <p>RM <?php echo $row->goods_sold2; ?></p>

                        </td>
                        <td style="text-align:center;width:17%">

                            <p>RM <?php echo $row->own_used2; ?></p>

                        </td>
                        <td style="text-align:center;width:17%">

                            <p>RM <?php echo $row->tax_service2; ?></p>

                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:center;width:5%">

                            3
                        
                        </td>
                        <td style="text-align:center;width:17%">

                            <p><?php echo $row->tax_goods3; ?></p>

                        </td>
                        <td style="text-align:center;width:17%">

                            <p><?php echo $row->tariff_code3; ?></p>

                        </td>
                        <td style="text-align:center;width:17%">

                            <p>RM <?php echo $row->goods_sold3; ?></p>

                        </td>
                        <td style="text-align:center;width:17%">

                            <p>RM <?php echo $row->own_used3; ?></p>

                        </td>
                        <td style="text-align:center;width:17%">

                            <p>RM <?php echo $row->tax_service3; ?></p>

                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:center;width:5%">

                            4

                        </td>
                        <td style="text-align:center;width:17%">

                            <p><?php echo $row->tax_goods4; ?></p>

                        </td>
                        <td style="text-align:center;width:17%">

                            <p><?php echo $row->tariff_code4; ?></p>

                        </td>
                        <td style="text-align:center;width:17%">

                            <p>RM <?php echo $row->goods_sold4; ?></p>

                        </td>
                        <td style="text-align:center;width:17%">

                            <p>RM <?php echo $row->own_used4; ?></p>

                        </td>
                        <td style="text-align:center;width:17%">

                            <p>RM <?php echo $row->tax_service4; ?></p>

                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:center;width:5%">

                                5
                                
                        </td>
                        <td style="text-align:center;width:17%">

                            <p><?php echo $row->tax_goods5; ?></p>

                        </td>
                        <td style="text-align:center;width:17%">

                            <p><?php echo $row->tariff_code5; ?></p>

                        </td>
                        <td style="text-align:center;width:17%">

                            <p>RM <?php echo $row->goods_sold5; ?></p>

                        </td>
                        <td style="text-align:center;width:17%">

                            <p>RM <?php echo $row->own_used5; ?></p>

                        </td>
                        <td style="text-align:center;width:17%">

                            <p>RM <?php echo $row->tax_service5; ?></p>

                        </td>
                    </tr>
                    
                    <tr>
                        <td style="text-align:right;width:17%" colspan="3">

                            <h5><b>JUMLAH.*</h5>
                            <h5><b>TOTAL.*</h5>

                        </td>
                        <td style="text-align:center;width:17%">

                            <p>RM <?php echo $row->total_sold; ?></p>
                            
                        </td>
                        <td style="text-align:center;width:17%">

                            <p>RM <?php echo $row->total_own; ?></p>
                            
                        </td>
                        <td style="text-align:center;width:17%">

                            <p>RM <?php echo $row->total_service; ?></p>
                            
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:right;width:17%" colspan="3">
                        
                            <h5><b>JUMLAH KESELURUHAN.*</h5>
                            <h5><b>NET TOTAL.*</h5>
                            
                        </td>
                        <td style="text-align:center;" colspan="3">

                            <p>RM <?php echo $row->net_total; ?></p>

                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="box" style="padding: 15px;">
            <div class="mainframe">
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

                        </td>
                        <td style=" text-align:center; width:25%;">

                            <h6>Nilai Jualan / Perkhidmatan Bercukai (RM)</h6>
                            <h6>Value of Taxable Sales / Service Tax Rate (RM)</h6>
                            
                        </td>
                        <td style=" text-align:center;width:10%;">

                            <h6>Kadar Cukai</h6>
                            <h6>Tax Rate</h6>
                            
                        </td>
                        <td style=" text-align:center;width:25%;">

                            <h6>Nilai Cukai Kena Bayar</h6>
                            <h6>Value of Tax Payable</h6>
                            
                        </td>
                    </tr>
                    <tr>
                        <td>

                            <h6>a) Barang Bercukai Berkadar 5%.</h6>
                            <h6>
                                <p>Taxable Goods at 5% Rate.</p>
                            </h6>

                        </td>
                        <td style=" text-align:center; width:25%;">

                            <p>RM <?php echo $row->rate_5; ?></p>

                        </td>
                        <td style=" text-align:center;width:10%;">

                            <p>
                                5%
                            </p>

                        </td>
                        <td style=" text-align:center;width:25%;">

                            <p>RM <?php echo $row->payable_5; ?></p>

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

                            <p>RM <?php echo $row->rate_10; ?></p>

                        </td>
                        <td style=" text-align:center;width:10%;"> 

                            <p>
                                10%
                            </p>

                        </td>
                        <td style=" text-align:center;width:25%;"> 

                            <p>RM <?php echo $row->payable_10; ?></p>

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

                            <p>RM <?php echo $row->rate_6; ?></p>

                        </td>
                        <td style=" text-align:center;width:10%;"> 

                            <p>
                                6%
                            </p>

                        </td>
                        <td style=" text-align:center;width:25%;"> 

                            <p>RM <?php echo $row->payable_6; ?></p>

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

                            <p><?php echo $row->rate_25; ?> UNIT</p>

                        </td>
                        <td style=" text-align:center;width:10%;"> 

                            <p>
                                RM 25
                            </p>

                        </td>
                        <td style=" text-align:center;width:25%;"> 

                            <p>RM <?php echo $row->payable_25; ?></p>

                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="box" style="padding: 15px;">
            <div class="mainframe">
                <table>
                <tr>
                        <td colspan="3">

                            <h6>12) Jumlah Nilai Cukai Yang Kena Dibayar.*</h6>
                            <h6>
                                <p>Total Value of Tax Payable.*</p>
                            </h6>
                            <h6>
                                <p>(12) = [11(a) + 11(b)] ATAU / OR [11(c) + 11(d)]</p>
                            </h6>
                            
                        </td>
                        <td style=" text-align:center;width:10%;"> 

                        </td>
                        <td style=" text-align:center;width:25%;"> 

                            <p>RM <?php echo $row->payable_tax; ?></p>

                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">

                            <h6>13) Amaun Potongan cukai </h6>
                            <h6>
                                <p>Amount of Tax Deduction</p>
                            </h6>

                        </td>
                        <td style=" text-align:center;width:10%;"> 

                        </td>
                        <td style=" text-align:center;width:25%;"> 

                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">

                            <h6>a) Potongan Cukai Melalui Nota Kredit* (RM) </h6>
                            <h6>
                                <p>Tax Deduction from Credit Note* (RM)</p>
                            </h6>
                            
                        </td>
                        <td style=" text-align:center;width:10%;"> 

                        </td>
                        <td style=" text-align:center;width:25%;"> 

                            <p>RM <?php echo $row->credit_deduction; ?></p>

                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">

                            <h6>b) Potongan Cukai Jualan* (RM)</h6>
                            <h6>
                                <p> Sales Tax Deduction.* (RM)</p>
                            </h6>
                            
                        </td>
                        <td style=" text-align:center;width:10%;"> 

                        </td>
                        <td style=" text-align:center;width:25%;"> 

                            <p>RM <?php echo $row->sales_deduction; ?></p>
                            
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">

                            <h6>c) Potongan Cukai Perkhidmatan* (RM)</h6>
                            <h6>
                                <p> Service Tax Deduction* (RM)</p>
                            </h6>
                            
                        </td>
                        <td style=" text-align:center;width:10%;"> 

                        </td>
                        <td style=" text-align:center;width:25%;"> 

                            <p>RM <?php echo $row->service_deduction; ?></p>

                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">

                            <h6>13A) Pelarasan di bawah Potongan Cukai Jualan (RM)</h6>
                            <h6>
                                <p>Adjustment under Sales Tax Deduction (RM)</p>
                            </h6>

                        </td>
                        <td style=" text-align:center;width:10%;"> 

                        </td>
                        <td style=" text-align:center;width:25%;"> 

                            <p>RM <?php echo $row->adjustment_deduction; ?></p>

                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">

                            <h6>14) Jumlah Cukai Yang Kena Dibayar Sebelum Penalti Dikenakan* (RM)</h6>
                            <h6>
                                <p> Total Tax Payable Before Penalty Imposed* (RM)</p>
                            </h6>
                            <h6>
                                <p> (14) = (12) - (13)</p>
                            </h6>
                            
                        </td>
                        <td style=" text-align:center;width:10%;">
                            
                        </td>
                        <td style=" text-align:center;width:25%;"> 

                            <p>RM <?php echo $row->tax_before_penalty; ?></p>

                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">

                            <h6>15) Kadar Penalti / Amaun Penalti (RM)</h6>
                            <h6>
                                <p>Penalty Rate / Penalty Amount (RM)</p>
                            </h6>

                        </td>
                        <td style=" text-align:center;width:10%;"> 

                            <p style="text-align:center; border:1px solid black !important;">
                                %
                            </p>

                        </td>
                        <td style=" text-align:center;width:25%;"> 
                            <p>RM <?php echo $row->penalty_rate; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <h6>16) Jumlah Cukai Kena Dibayar Termasuk Penalti</h6>
                            <h6>
                                <p>Total of Tax Payable Inclusive Penalty</p>
                            </h6>
                            <h6>
                                <p>(16) = (14) + (15)</p>
                            </h6>
                        </td>
                        <td style=" text-align:center;width:10%;">
                        
                        </td>
                        <td style=" text-align:center;width:25%;"> 

                            <p>RM <?php echo $row->tax_include_penalty; ?></p>

                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>


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

                            <p>RM <?php echo $row->sold_per_litre; ?></p>
                            
                        </td>
                        <td style="text-align:center;">

                            <h6>Per Liter.*</h6>
                            <h6>Per Litre.*</h6>

                        </td>
                        <td> 

                            <p><?php echo $row->value_sales_litre; ?></p>

                        </td>
                        <td> 

                            <p>RM <?php echo $row->value_tax_litre; ?></p>
                            
                        </td>
                        <td> 

                            <p>RM <?php echo $row->value_pay_litre; ?></p>

                        </td>
                    </tr>
                    <tr>
                        <td>

                            <h6>Berkadar</h6>
                            <h6>At Rate </h6>

                        </td>
                        <td >

                            <p>RM <?php echo $row->sold_per_kg; ?></p>
                            
                        </td>
                        <td style="text-align:center;">

                            <h6>Per Kilogram.*</h6>
                            <h6>Per Kilogram.*</h6>

                        </td>
                        <td> 

                            <p><?php echo $row->value_sales_kg; ?></p>

                        </td>
                        <td> 

                            <p>RM <?php echo $row->value_tax_kg; ?></p>
                            
                        </td>
                        <td> 

                            <p>RM <?php echo $row->value_pay_kg; ?></p>

                        </td>
                    </tr>
                    <tr>
                        <td>

                            <h6>Berkadar</h6>
                            <h6>At Rate </h6>

                        </td>
                        <td>

                            <p><?php echo $row->sold_per_advolerum; ?> %</p>
                            
                        </td>
                        <td style="text-align:center;">

                            <h6>ad-volerum.*</h6>
                            <h6>ad-volerum.* </h6>

                        </td>
                        <td> 
                        </td>
                        <td> 

                            <p>RM <?php echo $row->value_tax_advolerum; ?></p>
                            
                        </td>
                        <td> 

                            <p>RM <?php echo $row->value_pay_advolerum; ?></p>

                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="box" style="padding: 15px;">
            <div class="mainframe">
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
                            
                        </td>
                        <td style="width: 25%;">

                            <p>RM <?php echo $row->area; ?></p>

                        </td>
                    </tr>
                    <tr>
                        <td>

                            <h6> b) Jualan Tempatan Kepada Orang di bawah Perintah Cukai Jualan (Orang Yang Dikecualikan Daripada Pembayaran Cukai Jualan) 2018: </h6>
                            <h6>
                                <p>Local sales exempted to person under the Sales Tax (Person Exempted From Payment of Sales Tax) Order 2018:-</p>
                            </h6>

                        </td>
                        <td>

                        </td>
                    </tr>
                    <tr>
                        <td>

                            <h6><p>1) Jadual A (Kumpulan Orang).* (RM)</p></h6>
                            <h6>
                                <div class="p2">Schedule A (Class of Person).* (RM)</div>
                            </h6>
                            
                        </td>
                        <td style="width: 25%;">

                            <p>RM <?php echo $row->schedule_a; ?></p>

                        </td>
                    </tr>
                    <tr>
                        <td>

                            <h6><p>2) Jadual B (Pengilang Spesifik Barang Tidak Bercukai).* (RM)</p></h6>
                            <h6>
                                <div class="p2">Schedule A (Class of PersonSchedule B (Manufacturer of specific non taxable goods).* (RM)</div>
                            </h6>
                            
                        </td>
                        <td style="width: 25%;">

                            <p>RM <?php echo $row->schedule_b; ?></p>

                        </td>
                    </tr>
                    <tr>
                        <td>

                            <h6><p> 3) Jadual C (Pengilang Berdaftar).* (RM)</p></h6>
                            <h6>
                            <div class="p2"> Schedule C (Registered Manufacturer).* (RM)</div>
                            </h6>
                            
                        </td>
                        <td style="width: 25%;">

                            <p>RM <?php echo $row->schedule_c; ?></p>

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
                            
                        </td>
                        <td style="width: 25%;">

                            <p>RM <?php echo $row->item_12; ?></p>

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
                            
                        </td>
                        <td style="width: 25%;">

                            <p>RM <?php echo $row->item_34; ?></p>

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
                            
                        </td>
                        <td style="width: 25%;">

                            <p>RM <?php echo $row->item_5; ?></p>

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

                            <p>RM <?php echo $row->exempted_tax; ?></p>

                        </td>
                    </tr> 
                </table>
            </div>
        </div>
    </div>

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

                    <h5 style="text-align:center;font-weight: bold;font-weight: bold;">BAHAGIAN E: BELIAN DI BAWAH JADUAL C, PERINTAH CUKAI JUALAN (ORANG YANG DIKECUALIKAN DARIPADA PEMBAYARAN CUKAI JUALAN) 2018
                    </h5>
                    <h5 style="text-align:center;font-weight: bold;font-weight: bold;">PART E : PURCHASE UNDER THE SCHEDULE C, SALES TAX (PERSON EXEMPTED FROM PAYMENT OF SALES TAX) ORDER 2018
                    </h5>

                </div>
                <table>
                    <tr>
                        <td>

                            <h6>19) Butiran 1 dan 2 (Pembelian / Pengimportan Bahan Mentah / Komponen / Bahan Pembungkusan Yang Dikecualikan Cukai Jualan).*</h6>
                            <h6>
                                <p>Item 1 and 2 (Purchase / Importation of Raw Materials / Components / Packaging Materials Exempted From Sales Tax).*</p>
                            </h6>
                            
                        </td>
                        <td style="width: 25%;">

                            <p>RM <?php echo $row->item_12_exempted; ?></p>

                        </td>
                    </tr>
                    <tr>
                        <td>

                            <h6>20) Butiran 3 dan 4 (Pembelian / Pengimportan Bahan Mentah / Komponen / Bahan Pembungkusan Bagi Pihak Pengilang Berdaftar Yang Dikecualikan Cukai Jualan).*</h6>
                            <h6>
                                <p>Item 3 and 4 (Purchase / Importation of Raw Materials / Components / Packaging Materials on behalf Registered Manufacturer Exempted From Sales Tax).*</p>
                            </h6>
                            
                        </td>
                        <td style="width: 25%;">

                            <p>RM <?php echo $row->item_34_exempted; ?></p>

                        </td>
                    </tr>
                    <tr>
                        <td>

                            <h6>21) Butiran 5 (Nilai Kerja Dilakukan Yang Dikecualikan Cukai Jualan).*</h6>
                            <h6>
                                <p>Item 5 (Value of Work Performed Exempted from Sales Tax).*</p>
                            </h6>
                            
                        </td>
                        <td style="width: 25%;">

                            <p>RM <?php echo $row->item_5_exempted; ?></p>

                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div style="padding: 15px;">
            <div class="mainframe">
                <div class="frame2">

                    <h5 style="text-align:center;font-weight: bold;font-weight: bold;">BAHAGIAN F : AKUAN
                    </h5>
                    <h5 style="text-align:center;font-weight: bold;font-weight: bold;">PART F : DECLARATIONS
                    </h5>
                    
                </div>
            
                <h6>  
                    <input type="checkbox" id="declaration" name="declaration" checked="checked"> 
                    22) Dengan ini saya sebagai pegawai yang diberi kuasa mengesahkan dan memperakui bahawa butir-butir yang dinyatakan dalam penyata ini adalah benar dan lengkap.*
                </h6>
                <h6>
                    <p>I as an authorized officer hereby certify that the particulars stated in this return are true and complete.*</p>
                </h6>
                
                <table>
                <tr>
                    <td> 

                        <label for="date_declaration">Tarikh / Date *</label>
                        
                    </td>
                    <td>
                        
                        <p><?php echo $row->date_declaration; ?></p>

                    </td>
                </tr>
                <tr>
                    <td>

                        <h6>23) Nama Pengkirar.*</h6>
                        <h6>
                            <p>Name of Declarant.*</p>
                        </h6>
                        
                    </td>
                    <td style="width: 50%;">

                        <p><?php echo $row->name_declaration; ?></p>

                    </td>
                </tr>
                <tr>
                    <td>

                        <h6>24) No. Kad Pengenalan / Passport.*</h6>
                        <h6>
                            <p>Identity Card / Passport No.*</p>
                        </h6>
                        
                    </td>
                    <td style="width: 50%;">

                        <p><?php echo $row->id_declaration; ?></p>

                    </td>
                </tr>
                <tr>
                    <td>

                        <h6>25) Jawatan Pengikrar.*</h6>
                        <h6>
                            <p>Designation of Declarant.*</p>
                        </h6>
                        
                    </td>
                    <td style="width: 50%;">

                        <p><?php echo $row->designation_declaration; ?></p>

                    </td>
                </tr>
                <tr>
                    <td>

                        <h6>25) No. Telefon.*</h6>
                        <h6>
                            <p>Telephone No.*</p>
                        </h6>
                        
                    </td>
                    <td style="width: 50%;">

                        <p><?php echo $row->phone_declaration; ?></p>

                    </td>
                </tr>
            </table>

            </div>
        </div>
    </div>
    <?php } ?>
</body>