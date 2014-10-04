<?php echo $this->Html->script('jquery.validate', array('inline' => false)); ?>
<?php echo $this->Html->css('datepicker'); ?>
<?php echo $this->Html->script('bootstrap-datepicker'); ?>
<style>.datepicker{z-index:1151 !important;}</style>
<div class="modal fade" id="AddAdminModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-focus-on="#VendorMasterFirstName">
    <div class="modal-dialog">
	  <div class="modal-content">
	    <?php echo $this->Form->create('vendors', array('type' => 'POST', 'action' => 'addmaster', 'name' => 'addNewAdmin', 'id' => 'addNewAdmin', 'class' => 'form-horizontal', 'role' => 'form')); ?>
			
	    <div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		  <h4 class="modal-title" id="myModalLabel">Add New Account</h4>
	    </div>
	    
	    <div class="modal-body">
		  		   
		    <div class="form-group">
				<label for="VendorMasterExpenseType" class="col-sm-2 control-label">Expense Type<span class="star">*</span></label>
				<div class="col-sm-10">
						<?php echo $this->Form->input('VendorMaster.expense_type', array('type' => 'text', 'label' => false, 'div' => false, 'maxlength' => 100, 'required' => true, 'class' => 'form-control', 'placeholder' => 'Expense Type')); ?>
				</div>
		    </div>
		    
		    <div class="form-group">
			<label for="VendorMasterVendorName" class="col-sm-2 control-label">Vendor Name<span class="star">*</span></label>
			<div class="col-sm-10">
				<?php echo $this->Form->select('VendorMaster.vendor_id', $vendors, array('label' => false, 'div' => false, 'required' => true, 'class' => 'form-control', 'empty'=>'---Select Vendor---')); ?>				
			</div>
		    </div>

		    <div class="form-group">
			<label for="VendorMasterMaterial" class="col-sm-2 control-label">Material<span class="star">*</span></label>
			<div class="col-sm-10">
			  <?php echo $this->Form->input('VendorMaster.material', array('type' => 'text', 'label' => false, 'div' => false, 'maxlength' => 100, 'required' => true, 'class' => 'form-control', 'placeholder' => 'Material')); ?>
			</div>
		    </div>

		    <div class="form-group">
			<label for="VendorMasterQuantity" class="col-sm-2 control-label">Quantity<span class="star">*</span></label>
			<div class="col-sm-10">
			  <?php echo $this->Form->input('VendorMaster.quantity', array('type' => 'text', 'label' => false, 'div' => false, 'maxlength' => 10, 'required' => true, 'class' => 'form-control', 'placeholder' => 'Quantity', "number"=>true, 'onkeyup' => 'return priceGeneration(this.value)', 'onkeypress' => 'return isNumber(event)')); ?> 
			</div>
		    </div>
		    <div class="form-group">
			<label for="AddVendorMasterPassword" class="col-sm-2 control-label">Price<span class="star">*</span></label>
			<div class="col-sm-10">
			  <?php echo $this->Form->input('VendorMaster.price', array('type' => 'text', 'label' => false, 'div' => false, 'required' => true, 'class' => 'form-control','maxlength'=>10, 'placeholder' => 'Price', "number"=>true, 'onkeyup' => 'return priceGeneration(this.value)', 'onkeypress' => 'return isNumber(event)')); ?>
			</div>
		    </div>
		    <div class="form-group">
			<label for="AddVendorMasterCpassword" class="col-sm-2 control-label">Amount<span class="star">*</span></label>
			<div class="col-sm-10">
			  <?php echo $this->Form->input('VendorMaster.amount', array('type' => 'text', 'label' => false, 'div' => false, 'maxlength' => 10, 'required' => true, "number"=>true, 'class' => 'form-control', 'placeholder' => 'Amount', "readonly"=>true)); ?>
			</div>
		    </div>
				
		   <div class="form-group">
			  <label for="VendorMasterPhone" class="col-sm-2 control-label">Date<span class="star">*</span></label>
			  <div class="col-sm-10">
						<div data-date-format="dd-mm-yyyy" data-date="" id="dp3" class="input-append date">
								<?php echo $this->Form->input('VendorMaster.added_date', array('type' => 'text', 'label' => false, 'div' => false, 'maxlength' => 20, 'required' => false, 'class' => 'form-control datepicker', 'placeholder' => 'Example:- dd-mm-yyyy', 'required' => true, "readonly"=>true)); ?>
								<span class="add-on"><i class="icon-calendar"></i></span>
						</div>	
					</div>
		    </div>
		   
		    <div class="form-group">
			  <label for="VendorMasterAddressLine1" class="col-sm-2 control-label">Po No<span class="star">*</span></label>
			  <div class="col-sm-10">
			    <?php echo $this->Form->input('VendorMaster.po_no', array('type' => 'text', 'label' => false, 'div' => false, 'maxlength' => 100, 'class' => 'form-control', 'placeholder' => 'Po No', 'required' => true,)); ?>
			  </div>
		    </div>

	    </div>
	    
		<div class="modal-footer">
		    <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
		    <button type="submit" id="singlebutton" class="btn btn-primary">Save</button>
		</div>
		<?php echo $this->Form->end(); ?>
	  </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
				$("#addNewAdmin").validate();
    });
    $('.datepicker').datepicker({format: 'dd/mm/yyyy'});
				
		function priceGeneration(info){
				var amount = "";
				if ($("#VendorMasterQuantity").val()!="" && $("#VendorMasterPrice").val()!="") {
						amount = $("#VendorMasterQuantity").val() * $("#VendorMasterPrice").val();
				}
				$("#VendorMasterAmount").val(amount);
		}
		
		function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            if (charCode == 46) {
                return true;
            } else {
                return false;
            }
        }
        return true;
    }
</script>