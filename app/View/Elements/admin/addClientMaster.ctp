<?php echo $this->Html->script('jquery.validate', array('inline' => false)); ?>
<?php echo $this->Html->css('datepicker'); ?>
<?php echo $this->Html->script('bootstrap-datepicker'); ?>
<style>.datepicker{z-index:1151 !important;}</style>
<div class="modal fade" id="AddAdminModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-focus-on="#ClientMasterFirstName">
    <div class="modal-dialog">
	  <div class="modal-content">
	    <?php echo $this->Form->create('clients', array('type' => 'POST', 'action' => 'addcmaster', 'name' => 'addNewAdmin', 'id' => 'addNewAdmin', 'class' => 'form-horizontal', 'role' => 'form')); ?>
			
	    <div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		  <h4 class="modal-title" id="myModalLabel">Add New Logistics</h4>
	    </div>
	    
	    <div class="modal-body">
		  		   		    
		    <div class="form-group">
			<label for="ClientMasterClientName" class="col-sm-2 control-label">Client Name<span class="star">*</span></label>
			<div class="col-sm-10">
			  <?php echo $this->Form->input('ClientMaster.client_name', array('type' => 'text', 'label' => false, 'div' => false, 'maxlength' => 100, 'required' => true, 'class' => 'form-control', 'placeholder' => 'Client Name')); ?>
			</div>
		    </div>

		    <div class="form-group">
			<label for="ClientMasterMaterial" class="col-sm-2 control-label">Material<span class="star">*</span></label>
			<div class="col-sm-10">
			  <?php echo $this->Form->input('ClientMaster.material', array('type' => 'text', 'label' => false, 'div' => false, 'maxlength' => 100, 'required' => true, 'class' => 'form-control', 'placeholder' => 'Material')); ?>
			</div>
		    </div>

		    <div class="form-group">
			<label for="ClientMasterQuantity" class="col-sm-2 control-label">Quantity<span class="star">*</span></label>
			<div class="col-sm-10">
			  <?php echo $this->Form->input('ClientMaster.quantity', array('type' => 'text', 'label' => false, 'div' => false, 'maxlength' => 100, 'required' => true, "number"=>true, 'class' => 'form-control', 'placeholder' => 'Quantity')); ?> 
			</div>
		    </div>

		    <div class="form-group">
			<label for="AddClientMasterCpassword" class="col-sm-2 control-label">Amount<span class="star">*</span></label>
			<div class="col-sm-10">
			  <?php echo $this->Form->input('ClientMaster.amount', array('type' => 'text', 'label' => false, 'div' => false, 'maxlength' => 10, 'required' => true, "number"=>true, 'class' => 'form-control', 'placeholder' => 'Amount')); ?>
			</div>
		    </div>
				
		   <div class="form-group">
			  <label for="ClientMasterPhone" class="col-sm-2 control-label">Date<span class="star">*</span></label>
			  <div class="col-sm-10">
						<div data-date-format="dd-mm-yyyy" data-date="" id="dp3" class="input-append date">
								<?php echo $this->Form->input('ClientMaster.added_date', array('type' => 'text', 'label' => false, 'div' => false, 'maxlength' => 20, 'required' => false, 'class' => 'form-control datepicker', 'placeholder' => 'Example:- dd-mm-yyyy', 'required' => true, "readonly"=>true)); ?>
								<span class="add-on"><i class="icon-calendar"></i></span>
						</div>	
					</div>
		    </div>
		   
		    <div class="form-group">
			  <label for="ClientMasterAddressLine1" class="col-sm-2 control-label">Invoice #<span class="star">*</span></label>
			  <div class="col-sm-10">
			    <?php echo $this->Form->input('ClientMaster.invoice_no', array('type' => 'text', 'label' => false, 'div' => false, 'maxlength' => 100, 'class' => 'form-control', 'placeholder' => 'Invoice #', 'required' => true,)); ?>
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
</script>