<?php echo $this->Html->script('jquery.validate', array('inline' => false)); ?>
<?php echo $this->Html->css('datepicker'); ?>
<?php echo $this->Html->script('bootstrap-datepicker'); ?>
<?php echo $this->Html->script('jquery.maskedinput.min'); ?>
<style>.datepicker{z-index:1151 !important;}</style>
<style>
    .cstmWidth{width: 30% !important;}
    .cstmWidth_Mgr{width: 30% !important; margin-left: 1.3333% !important;}
</style>
 <div id="manageClientModel" tabindex="-1" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <?php echo $this->Form->create('clients', array('type' => 'POST', 'action' => 'editclient', 'name' => 'manageClient', 'id' => 'manageClient', 'class' => 'form-horizontal styleThese', 'role' => 'form', 'type' => 'file')); ?>	
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
								
                <input type="hidden" id="clientId" name="data[Client][id]" value="<%= client.id %>" /> 

                <div class="form-group">
                    <label for="ClientSN" class="col-sm-2 control-label">SN<span class="star">*</span></label>
                    <div class="col-sm-10 cstmWidth">
                        <input name="data[Client][sn]" required="required" class="form-control" placeholder="SN" minlength="2" maxlength="100" type="text" id="ClientSN" value="<%= client.sn %>" />
                    </div>
                    <label for="ClientName" class="col-sm-2 control-label">Client Name<span class="star">*</span></label>
                    <div class="col-sm-10 cstmWidth_Mgr">
                        <input name="data[Client][name]" required="required" class="form-control" placeholder="Client name" minlength="2" maxlength="100" type="text" id="ClientName" value="<%= client.name %>" />
                    </div>                
								</div>

                <div class="form-group">
                    <label for="ClientCode" class="col-sm-2 control-label">Client Code<span class="star">*</span></label>
                    <div class="col-sm-10 cstmWidth">
                        <input name="data[Client][code]" required="required" class="form-control" placeholder="Client Code" minlength="2" maxlength="100" type="text" id="ClientCode" value="<%= client.code %>" />
                    </div>
                    <label for="ClientAddress" class="col-sm-2 control-label">Address<span class="star">*</span></label>
                    <div class="col-sm-10 cstmWidth_Mgr">
                        <input name="data[Client][address]" required="required" class="form-control" placeholder="Address" minlength="2" maxlength="100" type="text" id="ClientAddress" value="<%= client.address %>" />
                    </div>                
								</div>

                <div class="form-group">
                    <label for="ClientStreet" class="col-sm-2 control-label">Street<span class="star">*</span></label>
                    <div class="col-sm-10 cstmWidth">
                        <input name="data[Client][street]" required="required" class="form-control" placeholder="Street" minlength="2" maxlength="100" type="text" id="ClientStreet" value="<%= client.street %>" />
                    </div>
                    <label for="ClientCity" class="col-sm-2 control-label">City<span class="star">*</span></label>
                    <div class="col-sm-10 cstmWidth_Mgr">
                        <input name="data[Client][city]" required="required" class="form-control" placeholder="City" minlength="2" maxlength="100" type="text" id="City" value="<%= client.city %>" />
                    </div>                
								</div>
                <div class="form-group">
                    <label for="ClientDistrict" class="col-sm-2 control-label">District<span class="star">*</span></label>
                    <div class="col-sm-10 cstmWidth">
                        <input name="data[Client][district]" required="required" class="form-control" placeholder="District" minlength="2" maxlength="100" type="text" id="ClientDistrict" value="<%= client.district %>" />
                    </div>
                    <label for="ClientState" class="col-sm-2 control-label">State<span class="star">*</span></label>
                    <div class="col-sm-10 cstmWidth_Mgr">
                        <input name="data[Client][state]" required="required" class="form-control" placeholder="State" minlength="2" maxlength="100" type="text" id="ClientState" value="<%= client.state %>" />
                    </div>                
								</div>
                <div class="form-group">
                    <label for="ClientPin" class="col-sm-2 control-label">Pin<span class="star">*</span></label>
                    <div class="col-sm-10 cstmWidth">
                        <input name="data[Client][pin]" required="required" class="form-control" placeholder="Pin code" minlength="2" number="true" maxlength="100" type="text" id="ClientPin" value="<%= client.pin %>" />
                    </div>
                    <label for="ClientPhone" class="col-sm-2 control-label">Phone<span class="star">*</span></label>
                    <div class="col-sm-10 cstmWidth_Mgr">
                        <input name="data[Client][phone]" required="required" class="form-control phone_mask" placeholder="Phone" maxlength="15" type="text" id="ClientPhone" value="<%= client.phone %>" />
                    </div>                
								</div>
                <div class="form-group">
                    <label for="ClientMobile" class="col-sm-2 control-label">Mobile<span class="star">*</span></label>
                    <div class="col-sm-10 cstmWidth">
                        <input name="data[Client][mobile]" required="required" class="form-control phone_mask" placeholder="Mobile" maxlength="15" type="text" id="ClientMobile" value="<%= client.mobile %>" />
                    </div>
                    <label for="ClientType" class="col-sm-2 control-label">Client Type<span class="star">*</span></label>
                    <div class="col-sm-10 cstmWidth_Mgr">
                        <input name="data[Client][client_type]" required="required" class="form-control" placeholder="Client Type" minlength="2" maxlength="100" type="text" id="ClientType" value="<%= client.client_type %>" />
                    </div>                
								</div>
                <div class="form-group">
                    <label for="ClientCSTNO" class="col-sm-2 control-label">CST NO<span class="star">*</span></label>
                    <div class="col-sm-10 cstmWidth">
                        <input name="data[Client][cst_no]" required="required" class="form-control" placeholder="CST NO" minlength="2" maxlength="100" type="text" id="ClientCSTNO" value="<%= client.cst_no %>" />
                    </div>
                    <label for="ClientAddDate" class="col-sm-2 control-label">Date<span class="star">*</span></label>
                    <div class="col-sm-10 cstmWidth_Mgr">
                        <div data-date-format="dd-mm-yyyy" data-date="" id="ClientAddDateDiv" class="input-append date">
														<input name="data[Client][add_date]" required="required" class="form-control date_mask" placeholder="Example:-(dd-mm-yyyy)"  type="text" id="ClientAddDate" value="<%= client.add_date %>" />
												</div>		
                    </div>                
								</div>
                <div class="form-group">
                    <label for="ClientEmail" class="col-sm-2 control-label">Email<span class="star">*</span></label>
                    <div class="col-sm-10 cstmWidth">
                        <input name="data[Client][email]" required="required" email="true" class="form-control" placeholder="Email" minlength="2" maxlength="100" type="text" id="ClientEmail" value="<%= client.email %>" />
                    </div>
                    <label for="ClientVATRegNo" class="col-sm-2 control-label">VAT Reg No<span class="star">*</span></label>
                    <div class="col-sm-10 cstmWidth_Mgr">
                        <input name="data[Client][vat_reg_no]" required="required" class="form-control" placeholder="VAT Reg No" minlength="2" maxlength="50" type="text" id="ClientVATRegNo" value="<%= client.vat_reg_no %>" />
                    </div>                
								</div>
                <div class="form-group">
                    <label for="ClientECCNo" class="col-sm-2 control-label">ECC No<span class="star">*</span></label>
                    <div class="col-sm-10 cstmWidth">
                        <input name="data[Client][ecc_no]" required="required" class="form-control" placeholder="ECC No" minlength="2" maxlength="50" type="text" id="ClientECCNo" value="<%= client.ecc_no %>" />
                    </div>
                    <label for="ClientExiceRegNo" class="col-sm-2 control-label">Exice Reg No<span class="star">*</span></label>
                    <div class="col-sm-10 cstmWidth_Mgr">
                        <input name="data[Client][exice_reg_no]" required="required" class="form-control" placeholder="ExiceRegNo" minlength="2" maxlength="50" type="text" id="ClientExiceRegNo" value="<%= client.exice_reg_no %>" />
                    </div>                
								</div>
                <div class="form-group">
                    <label for="ClientPANNo" class="col-sm-2 control-label">PAN No<span class="star">*</span></label>
                    <div class="col-sm-10 cstmWidth">
                        <input name="data[Client][pan_no]" required="required" class="form-control" placeholder="PAN No" minlength="2" maxlength="50" type="text" id="ClientPANNo" value="<%= client.pan_no %>" />
                    </div>
                    <label for="ClientServiceTaxNo" class="col-sm-2 control-label">Service Tax No<span class="star">*</span></label>
                    <div class="col-sm-10 cstmWidth_Mgr">
                        <input name="data[Client][service_tax_no]" required="required" class="form-control" placeholder="Service Tax No" minlength="2" maxlength="50" type="text" id="ClientServiceTaxNo" value="<%= client.service_tax_no %>" />
                    </div>                
								</div>								

                <div class="form-group">
                    <label for="ClientTANNo" class="col-sm-2 control-label">TAN No<span class="star">*</span></label>
                    <div class="col-sm-10 cstmWidth">
                        <input name="data[Client][tan_no]" required="required" class="form-control" placeholder="TAN No" minlength="2" maxlength="50" type="text" id="ClientTANNo" value="<%= client.tan_no %>" />
                    </div>
                    <label for="ClientSSINo" class="col-sm-2 control-label">SSI No<span class="star">*</span></label>
                    <div class="col-sm-10 cstmWidth_Mgr">
                        <input name="data[Client][ssi_no]" required="required" class="form-control" placeholder="SSI No" minlength="2" maxlength="50" type="text" id="ClientSSINo" value="<%= client.ssi_no %>" />
                    </div>                
								</div>								

								<div class="form-group">
                    <label for="ClientStatus" class="col-sm-2 control-label">Client Status<span class="star">*</span></label>
                    <div class="col-sm-10 cstmWidth">
												<select name="data[Client][status]" required="required" class="form-control" placeholder="Client Status" id="ClientStatus">
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
        $("#manageClient").validate();
        var editUrl = $('#manageClient').attr('action');
        $(".editRow").click(function(event) {
            event.preventDefault();
            var url = $(this).attr('href');
            $('body').modalmanager('loading');
            $.getJSON(url, function(data) {
                $('#manageClient').attr('action', editUrl + '/' + data.clients.Client.id);
                var template = $("#editTemplate").html();
								$("#manageClient").html(_.template(template, {client: data.clients.Client, PopupTitle: data.PopupTitle}));
								$("#ClientStatus").val(data.clients.Client.status);
                $('#manageClientModel').modal('show');
								
								$(".date_mask").mask("99/99/9999");
								$(".phone_mask").mask("(999) 999-9999");
								$(".tin_mask").mask("99-9999999");
								$(".ssn_mask").mask("999-99-9999");
						});
        });
    });
</script>