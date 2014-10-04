<?php echo $this->Html->script('jquery.validate', array('inline' => false)); ?>
<?php echo $this->Html->css('datepicker'); ?>
<?php echo $this->Html->script('bootstrap-datepicker'); ?>
<?php echo $this->Html->script('jquery.maskedinput.min'); ?>
<style>.datepicker{z-index:1151 !important;}</style>
<style>
    .cstmWidth{width: 30% !important;}
    .cstmWidth_Mgr{width: 30% !important; margin-left: 1.3333% !important;}
</style>
 <div id="manageVendorModel" tabindex="-1" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <?php echo $this->Form->create('vendors', array('type' => 'POST', 'action' => 'editvendor', 'name' => 'manageVendor', 'id' => 'manageVendor', 'class' => 'form-horizontal styleThese', 'role' => 'form', 'type' => 'file')); ?>	
    <?php echo $this->Form->end(); ?>
</div>
<script type="text/html" id='editTemplate'>
    <div class="modal-dialog" style="width: 900px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><%= PopupTitle %></h4>
            </div>
						
            <div class="modal-body">
								
                <input type="hidden" id="vendorId" name="data[Vendor][id]" value="<%= vendor.id %>" /> 

                <div class="form-group">
                    <label for="VendorSN" class="col-sm-2 control-label">SN<span class="star">*</span></label>
                    <div class="col-sm-10 cstmWidth">
                        <input name="data[Vendor][sn]" required="required" class="form-control" placeholder="SN" minlength="2" maxlength="100" type="text" id="VendorSN" value="<%= vendor.sn %>" />
                    </div>
                    <label for="VendorName" class="col-sm-2 control-label">Vendor Name<span class="star">*</span></label>
                    <div class="col-sm-10 cstmWidth_Mgr">
                        <input name="data[Vendor][name]" required="required" class="form-control" placeholder="Vendor name" minlength="2" maxlength="100" type="text" id="VendorName" value="<%= vendor.name %>" />
                    </div>                
								</div>

                <div class="form-group">
                    <label for="VendorCode" class="col-sm-2 control-label">Vendor Code<span class="star">*</span></label>
                    <div class="col-sm-10 cstmWidth">
                        <input name="data[Vendor][code]" required="required" class="form-control" placeholder="Vendor Code" minlength="2" maxlength="100" type="text" id="VendorCode" value="<%= vendor.code %>" />
                    </div>
                    <label for="VendorAddress" class="col-sm-2 control-label">Address<span class="star">*</span></label>
                    <div class="col-sm-10 cstmWidth_Mgr">
                        <input name="data[Vendor][address]" required="required" class="form-control" placeholder="Address" minlength="2" maxlength="100" type="text" id="VendorAddress" value="<%= vendor.address %>" />
                    </div>                
								</div>

                <div class="form-group">
                    <label for="VendorStreet" class="col-sm-2 control-label">Street<span class="star">*</span></label>
                    <div class="col-sm-10 cstmWidth">
                        <input name="data[Vendor][street]" required="required" class="form-control" placeholder="Street" minlength="2" maxlength="100" type="text" id="VendorStreet" value="<%= vendor.street %>" />
                    </div>
                    <label for="VendorCity" class="col-sm-2 control-label">City<span class="star">*</span></label>
                    <div class="col-sm-10 cstmWidth_Mgr">
                        <input name="data[Vendor][city]" required="required" class="form-control" placeholder="City" minlength="2" maxlength="100" type="text" id="City" value="<%= vendor.city %>" />
                    </div>                
								</div>
                <div class="form-group">
                    <label for="VendorDistrict" class="col-sm-2 control-label">District<span class="star">*</span></label>
                    <div class="col-sm-10 cstmWidth">
                        <input name="data[Vendor][district]" required="required" class="form-control" placeholder="District" minlength="2" maxlength="100" type="text" id="VendorDistrict" value="<%= vendor.district %>" />
                    </div>
                    <label for="VendorState" class="col-sm-2 control-label">State<span class="star">*</span></label>
                    <div class="col-sm-10 cstmWidth_Mgr">
                        <input name="data[Vendor][state]" required="required" class="form-control" placeholder="State" minlength="2" maxlength="100" type="text" id="VendorState" value="<%= vendor.state %>" />
                    </div>                
								</div>
                <div class="form-group">
                    <label for="VendorPin" class="col-sm-2 control-label">Pin<span class="star">*</span></label>
                    <div class="col-sm-10 cstmWidth">
                        <input name="data[Vendor][pin]" required="required" class="form-control" placeholder="Pin code" minlength="2" number="true" maxlength="100" type="text" id="VendorPin" value="<%= vendor.pin %>" />
                    </div>
                    <label for="VendorPhone" class="col-sm-2 control-label">Phone<span class="star">*</span></label>
                    <div class="col-sm-10 cstmWidth_Mgr">
                        <input name="data[Vendor][phone]" required="required" class="form-control phone_mask" placeholder="Phone" maxlength="15" type="text" id="VendorPhone" value="<%= vendor.phone %>" />
                    </div>                
								</div>
                <div class="form-group">
                    <label for="VendorMobile" class="col-sm-2 control-label">Mobile<span class="star">*</span></label>
                    <div class="col-sm-10 cstmWidth">
                        <input name="data[Vendor][mobile]" required="required" class="form-control phone_mask" placeholder="Mobile" maxlength="15" type="text" id="VendorMobile" value="<%= vendor.mobile %>" />
                    </div>
                    <label for="VendorType" class="col-sm-2 control-label">Vendor Type<span class="star">*</span></label>
                    <div class="col-sm-10 cstmWidth_Mgr">
                        <input name="data[Vendor][vendor_type]" required="required" class="form-control" placeholder="Vendor Type" minlength="2" maxlength="100" type="text" id="VendorType" value="<%= vendor.vendor_type %>" />
                    </div>                
								</div>
                <div class="form-group">
                    <label for="VendorCSTNO" class="col-sm-2 control-label">CST NO<span class="star">*</span></label>
                    <div class="col-sm-10 cstmWidth">
                        <input name="data[Vendor][cst_no]" required="required" class="form-control" placeholder="CST NO" minlength="2" maxlength="100" type="text" id="VendorCSTNO" value="<%= vendor.cst_no %>" />
                    </div>
                    <label for="VendorAddDate" class="col-sm-2 control-label">Date<span class="star">*</span></label>
                    <div class="col-sm-10 cstmWidth_Mgr">
                        <div data-date-format="dd-mm-yyyy" data-date="" id="VendorAddDateDiv" class="input-append date">
														<input name="data[Vendor][add_date]" required="required" class="form-control date_mask" placeholder="Example:-(dd-mm-yyyy)"  type="text" id="VendorAddDate" value="<%= vendor.add_date %>" />
												</div>		
                    </div>                
								</div>
                <div class="form-group">
                    <label for="VendorEmail" class="col-sm-2 control-label">Email<span class="star">*</span></label>
                    <div class="col-sm-10 cstmWidth">
                        <input name="data[Vendor][email]" required="required" email="true" class="form-control" placeholder="Email" minlength="2" maxlength="100" type="text" id="VendorEmail" value="<%= vendor.email %>" />
                    </div>
                    <label for="VendorVATRegNo" class="col-sm-2 control-label">VAT Reg No<span class="star">*</span></label>
                    <div class="col-sm-10 cstmWidth_Mgr">
                        <input name="data[Vendor][vat_reg_no]" required="required" class="form-control" placeholder="VAT Reg No" minlength="2" maxlength="50" type="text" id="VendorVATRegNo" value="<%= vendor.vat_reg_no %>" />
                    </div>                
								</div>
                <div class="form-group">
                    <label for="VendorECCNo" class="col-sm-2 control-label">ECC No<span class="star">*</span></label>
                    <div class="col-sm-10 cstmWidth">
                        <input name="data[Vendor][ecc_no]" required="required" class="form-control" placeholder="ECC No" minlength="2" maxlength="50" type="text" id="VendorECCNo" value="<%= vendor.ecc_no %>" />
                    </div>
                    <label for="VendorExiceRegNo" class="col-sm-2 control-label">Exice Reg No<span class="star">*</span></label>
                    <div class="col-sm-10 cstmWidth_Mgr">
                        <input name="data[Vendor][exice_reg_no]" required="required" class="form-control" placeholder="ExiceRegNo" minlength="2" maxlength="50" type="text" id="VendorExiceRegNo" value="<%= vendor.exice_reg_no %>" />
                    </div>                
								</div>
                <div class="form-group">
                    <label for="VendorPANNo" class="col-sm-2 control-label">PAN No<span class="star">*</span></label>
                    <div class="col-sm-10 cstmWidth">
                        <input name="data[Vendor][pan_no]" required="required" class="form-control" placeholder="PAN No" minlength="2" maxlength="50" type="text" id="VendorPANNo" value="<%= vendor.pan_no %>" />
                    </div>
                    <label for="VendorServiceTaxNo" class="col-sm-2 control-label">Service Tax No<span class="star">*</span></label>
                    <div class="col-sm-10 cstmWidth_Mgr">
                        <input name="data[Vendor][service_tax_no]" required="required" class="form-control" placeholder="Service Tax No" minlength="2" maxlength="50" type="text" id="VendorServiceTaxNo" value="<%= vendor.service_tax_no %>" />
                    </div>                
								</div>								

                <div class="form-group">
                    <label for="VendorTANNo" class="col-sm-2 control-label">TAN No<span class="star">*</span></label>
                    <div class="col-sm-10 cstmWidth">
                        <input name="data[Vendor][tan_no]" required="required" class="form-control" placeholder="TAN No" minlength="2" maxlength="50" type="text" id="VendorTANNo" value="<%= vendor.tan_no %>" />
                    </div>
                    <label for="VendorSSINo" class="col-sm-2 control-label">SSI No<span class="star">*</span></label>
                    <div class="col-sm-10 cstmWidth_Mgr">
                        <input name="data[Vendor][ssi_no]" required="required" class="form-control" placeholder="SSI No" minlength="2" maxlength="50" type="text" id="VendorSSINo" value="<%= vendor.ssi_no %>" />
                    </div>                
								</div>								

								<div class="form-group">
                    <label for="VendorStatus" class="col-sm-2 control-label">Vendor Status<span class="star">*</span></label>
                    <div class="col-sm-10 cstmWidth">
												<select name="data[Vendor][status]" required="required" class="form-control" placeholder="Vendor Status" id="VendorStatus">
														<option value="1">Active</option>
														<option value="0">Inactive</option>
												</select>
										</div>               
								</div>								
																
            </div>

            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
                <button type="submit" id="singlebutton" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#manageVendor").validate();
        var editUrl = $('#manageVendor').attr('action');
        $(".editRow").click(function(event) {
            event.preventDefault();
            var url = $(this).attr('href');
            $('body').modalmanager('loading');
            $.getJSON(url, function(data) {
                $('#manageVendor').attr('action', editUrl + '/' + data.vendors.Vendor.id);
                var template = $("#editTemplate").html();
								$("#manageVendor").html(_.template(template, {vendor: data.vendors.Vendor, PopupTitle: data.PopupTitle}));
								$("#VendorStatus").val(data.vendors.Vendor.status);
                $('#manageVendorModel').modal('show');
								
								$(".date_mask").mask("99/99/9999");
								$(".phone_mask").mask("(999) 999-9999");
								$(".tin_mask").mask("99-9999999");
								$(".ssn_mask").mask("999-99-9999");
						});
        });
    });
</script>