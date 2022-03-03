<!-- right column -->
<form role="form" id="form" method="post" action="<?php echo base_url('reports/submit_sst');?>" encType="multipart/form-data">
<div class="col-md-12">
    <div class="box" style="padding: 15px;">
        <div class="mainframe">
            <div class="box-header with-border">
                <div class="control-group">
                    <div class="controls">

                        <center>
                        <img src="<?php echo base_url ('assets\images\kastam.jpg') ?>" width=10%>
                        <center>
                        <h4 style="text-align:center;font-weight: bold;">JABATAN KASTAM DIRAJA MALAYSIA</h4>
                        <h4 style="text-align:center; font-weight: bold;">ROYAL MALAYSIAN CUSTOMS DEPARTMENT </h4>
                        <br>
                        <h5 style="text-align:center;font-weight: bold;font-weight: bold;">PERNYATA CUKAI JUALAN / CUKAI PERKHIDMATAN</h5>
                        <h5 style="text-align:center;font-weight: bold;"> SALES TAX / SERVICE TAX RETURN </h5>

                    </div>
                </div>
            </div>

            <h5 style="font-weight: bold;margin:15px;font-weight: bold;">Nota Penting (Important Notes)</h5>

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
                <h6>6.) Sila hubungi Pusat Panggilan Kastam di talian 1-300-88-8500 / 03-78067200 atau emel <a style="color:blue;">ccc@customs.gov.my</a> untuk
                    pertanyaan lanjut.
                </h6>
                <h6>
                    <p>Please contact Customs Call Center at 1-300-88-8500 / 03-78067200 or email <a style="color:blue;">ccc@customs.gov.my</a> for further enquiry.</p>
                </h6>

            </div>
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
                        <span class="validation-color" id="err_return_type"><?php echo form_error('return_type'); ?></span>
                    
                    </td>
                    <td> 

                        <input type="hidden" name="sst_id" value="<?php echo $id;?>">
                        <input class="form-check-input" type="radio" id="return_type" name="return_type" id="return_type" value="Sales">
                        <label class="form-check-label" for="sales">
                            CUKAI JUALAN / SALES TAX
                        </label>

                    <td>

                        <input class="form-check-input" type="radio" id="return_type" name="return_type" id="return_type" value="Service">
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
                        <span class="validation-color" id="err_no_sst"><?php echo form_error('no_sst'); ?></span>

                    </td>
                    <td>

                        <input type="text" id="no_sst" name="no_sst" placeholder="No. Pendaftaran SST">

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
                        <span class="validation-color" id="err_registered_name"><?php echo form_error('registered_name'); ?></span>
                   
                    </td>
                    <td>

                        <input type="text" id="registered_name" name="registered_name" placeholder="Name of Registered Manufacturer">
                    
                    </td>
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
                        <input type="date" id="tax_start" name="tax_start">
                        <span class="validation-color" id="err_tax_start"><?php echo form_error('tax_start'); ?></span>
                    
                    </td>
                    <td>
                        
                        <label for="Dari">Hingga:</label>
                        <br>
                        <label for="From">Until:</label>
                        <input type="date" id="tax_end" name="tax_end">
                        <span class="validation-color" id="err_tax_end"><?php echo form_error('tax_end'); ?></span>
                    
                    </td>
                </tr>
                <tr>
                    <td>

                        <h6>4) Tarikh Akhir Serahan Penyata dan Bayaran*</h6>
                        <h6>
                            <p>Return and Payment Due Date*</p>
                        </h6>

                    </td>
                    <td>

                        <input type="date" id="return_date" name="return_date">
                        <span class="validation-color" id="err_return_date"><?php echo form_error('return_date'); ?></span>
                    
                    </td>
                </tr>
            </table>
        </div>
        <div class="button">

            <a class="btn btn-info" id="next_page1">Next</a>

        </div>
    </div>
</div>
