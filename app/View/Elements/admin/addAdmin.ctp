<?php $this->Html->script('jquery.validate', array('inline' => false)); ?>
<div class="modal fade" id="AddAdminModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-focus-on="#UserFirstName">
    <div class="modal-dialog">
	  <div class="modal-content">
	    <?php echo $this->Form->create('users', array('type' => 'POST', 'action' => 'addadmin', 'name' => 'addNewAdmin', 'id' => 'addNewAdmin', 'class' => 'form-horizontal', 'role' => 'form')); ?>	
	    <div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		  <h4 class="modal-title" id="myModalLabel">Add New Administrator</h4>
	    </div>
	    
	    <div class="modal-body">
		  		   
		    <div class="form-group">
			<label for="UserFirstName" class="col-sm-2 control-label">First Name<span class="star">*</span></label>
			<div class="col-sm-10">
			    <?php echo $this->Form->input('User.first_name', array('type' => 'text', 'label' => false, 'div' => false, 'maxlength' => 50, 'required' => true, 'class' => 'form-control', 'placeholder' => 'First Name')); ?>
			</div>
		    </div>
		    
		    <div class="form-group">
			<label for="UserLastName" class="col-sm-2 control-label">Last Name<span class="star">*</span></label>
			<div class="col-sm-10">
			  <?php echo $this->Form->input('User.last_name', array('type' => 'text', 'label' => false, 'div' => false, 'maxlength' => 50, 'required' => true, 'class' => 'form-control', 'placeholder' => 'Last Name')); ?>
			</div>
		    </div>


		    <div class="form-group">
			<label for="UserUserName" class="col-sm-2 control-label">User Name<span class="star">*</span></label>
			<div class="col-sm-10">
			  <?php echo $this->Form->input('User.user_name', array('type' => 'text', 'label' => false, 'div' => false, 'maxlength' => 50, 'required' => true, 'class' => 'form-control', 'placeholder' => 'Please enter username','remote'=>$this->Html->url(array('controller'=>'Users','action'=>'ajax_check_username','admin'=>false)),'loginRegex'=>true,'minlength'=>'2','maxlength'=>'30')); ?>
			</div>
		    </div>

		    <div class="form-group">
			<label for="UserEmail" class="col-sm-2 control-label">Email<span class="star">*</span></label>
			<div class="col-sm-10">
			  <?php echo $this->Form->input('User.email', array('type' => 'email', 'label' => false, 'div' => false, 'maxlength' => 100, 'required' => true,'email'=>true, 'class' => 'form-control', 'placeholder' => 'Example : example@example.com','remote'=>$this->Html->url(array('controller'=>'Users','action'=>'ajax_check_email','admin'=>false)), 'value' => null)); ?> 
			</div>
		    </div>
		    <div class="form-group">
			<label for="AddUserPassword" class="col-sm-2 control-label">Password<span class="star">*</span></label>
			<div class="col-sm-10">
			  <?php echo $this->Form->input('User.password', array('type' => 'password','id'=>'AddUserPassword', 'label' => false, 'div' => false, 'required' => true, 'class' => 'form-control','minlength'=>'6','maxlength'=>50)); ?>
			</div>
		    </div>
		    <div class="form-group">
			<label for="AddUserCpassword" class="col-sm-2 control-label">Confirm Password<span class="star">*</span></label>
			<div class="col-sm-10">
			  <?php echo $this->Form->input('User.cpassword', array('type' => 'password','id'=>'AddUserCpassword', 'label' => false, 'div' => false, 'maxlength' => 50, 'required' => true, 'class' => 'form-control','equalTo'=>'#AddUserPassword')); ?>
			</div>
		    </div>
		    
		   <div class="form-group">
			  <label for="UserPhone" class="col-sm-2 control-label">Phone<span class="star">*</span></label>
			  <div class="col-sm-10">
			    <?php echo $this->Form->input('User.phone', array('type' => 'text', 'label' => false, 'div' => false, 'maxlength' => 20, 'required' => false, 'class' => 'form-control', 'placeholder' => 'Example : +1-646-222-9999','number'=>true)); ?>
			  </div>
		    </div>
		   
		    <div class="form-group">
			  <label for="UserAddressLine1" class="col-sm-2 control-label">Address1</label>
			  <div class="col-sm-10">
			    <?php echo $this->Form->input('User.address_line1', array('type' => 'text', 'label' => false, 'div' => false, 'maxlength' => 100, 'class' => 'form-control', 'placeholder' => 'Address Line 1')); ?>
			  </div>
		    </div>

		    <div class="form-group">
			  <label for="UserAddressLine2" class="col-sm-2 control-label">Address2</label>
			  <div class="col-sm-10">
			    <?php echo $this->Form->input('User.address_line2', array('type' => 'text', 'label' => false, 'div' => false, 'maxlength' => 100, 'class' => 'form-control', 'placeholder' => 'Address Line 2')); ?>
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
	$.validator.addMethod("loginRegex", function(value, element) {
	    return this.optional(element) || /^[a-z0-9\-\s]+$/i.test(value);
	}, "Username must contain only letters, numbers, or dashes.");
    
	$("#addNewAdmin").validate();
    });
</script>