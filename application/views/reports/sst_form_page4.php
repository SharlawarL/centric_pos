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
                        <span class="validation-color" id="err_item_12_exempted"><?php echo form_error('item_12_exempted'); ?></span>

                    </td>
                    <td style="width: 25%;">

                        <input type="number" id="item_12_exempted" name="item_12_exempted" placeholder="RM">

                    </td>
                </tr>
                <tr>
                    <td>

                        <h6>20) Butiran 3 dan 4 (Pembelian / Pengimportan Bahan Mentah / Komponen / Bahan Pembungkusan Bagi Pihak Pengilang Berdaftar Yang Dikecualikan Cukai Jualan).*</h6>
                        <h6>
                            <p>Item 3 and 4 (Purchase / Importation of Raw Materials / Components / Packaging Materials on behalf Registered Manufacturer Exempted From Sales Tax).*</p>
                        </h6>
                        <span class="validation-color" id="err_item_34_exempted"><?php echo form_error('item_34_exempted'); ?></span>

                    </td>
                    <td style="width: 25%;">

                        <input type="number" id="item_34_exempted" name="item_34_exempted" placeholder="RM">

                    </td>
                </tr>
                <tr>
                    <td>

                        <h6>21) Butiran 5 (Nilai Kerja Dilakukan Yang Dikecualikan Cukai Jualan).*</h6>
                        <h6>
                            <p>Item 5 (Value of Work Performed Exempted from Sales Tax).*</p>
                        </h6>
                        <span class="validation-color" id="err_item_5_exempted"><?php echo form_error('item_5_exempted'); ?></span>

                    </td>
                    <td style="width: 25%;">

                        <input type="number" id="item_5_exempted" name="item_5_exempted" placeholder="RM">

                    </td>
                </tr>
            </table>
            <div class="frame2">

                <h5 style="text-align:center;font-weight: bold;font-weight: bold;">BAHAGIAN F : AKUAN
                </h5>
                <h5 style="text-align:center;font-weight: bold;font-weight: bold;">PART F : DECLARATIONS
                </h5>
                
            </div>
        
            <h6>  
                <input type="checkbox" id="declaration" name="declaration"> 
                22) Dengan ini saya sebagai pegawai yang diberi kuasa mengesahkan dan memperakui bahawa butir-butir yang dinyatakan dalam penyata ini adalah benar dan lengkap.*
            </h6>
            <h6>
                <p>I as an authorized officer hereby certify that the particulars stated in this return are true and complete.*</p>
            </h6>
            <span class="validation-color" id="err_declaration"><?php echo form_error('declaration'); ?></span>

            <table>
                <tr>
                    <td> 

                        <label for="date_declaration">Tarikh / Date *</label>
                        <input type="date" id="date_declaration" name="date_declaration">
                        <span class="validation-color" id="err_date_declaration"><?php echo form_error('date_declaration'); ?></span>

                    </td>
                    <td>
                        
                    </td>
                </tr>
                <tr>
                    <td>

                        <h6>23) Nama Pengkirar.*</h6>
                        <h6>
                            <p>Name of Declarant.*</p>
                        </h6>
                        <span class="validation-color" id="err_name_declaration"><?php echo form_error('name_declaration'); ?></span>

                    </td>
                    <td style="width: 50%;">

                        <input type="text" id="name_declaration" name="name_declaration" placeholder="">

                    </td>
                </tr>
                <tr>
                    <td>

                        <h6>24) No. Kad Pengenalan / Passport.*</h6>
                        <h6>
                            <p>Identity Card / Passport No.*</p>
                        </h6>
                        <span class="validation-color" id="err_id_declaration"><?php echo form_error('id_declaration'); ?></span>

                    </td>
                    <td style="width: 50%;">

                        <input type="text" id="id_declaration" name="id_declaration" placeholder="">

                    </td>
                </tr>
                <tr>
                    <td>

                        <h6>25) Jawatan Pengikrar.*</h6>
                        <h6>
                            <p>Designation of Declarant.*</p>
                        </h6>
                        <span class="validation-color" id="err_designation_declaration"><?php echo form_error('designation_declaration'); ?></span>

                    </td>
                    <td style="width: 50%;">

                        <input type="text" id="designation_declaration" name="designation_declaration" placeholder="">

                    </td>
                </tr>
                <tr>
                    <td>

                        <h6>25) No. Telefon.* <i>(Format: 012-3456789)</i></h6>
                        <h6>
                            <p>Telephone No.* <i>(Format: 012-3456789)</i></p>
                        </h6>
                        <span class="validation-color" id="err_phone_declaration"><?php echo form_error('phone_declaration'); ?></span>

                    </td>
                    <td style="width: 50%;">

                        <input type="tel" id="phone_declaration" name="phone_declaration" pattern="([0-9]{3}-[0-9]{7})|([0-9]{3}-[0-9]{8})" placeholder="012-3456789">

                    </td>
                </tr>
            </table>
        </div>
        <div class="button">

            <button type="submit" id="submit_SST" name="submit_SST" class="btn btn-info p-5">Submit</button>
            <a class="btn btn-default" style="margin-left: 1%;" onclick="prev_page(-1);">Back</a>

        </div>
    </div>
</div>
</form>