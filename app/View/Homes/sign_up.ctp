<style type="text/css">
.required{color: #ff0000;}

.passwordStl, .selectStl{
    font-family: 'Open Sans',sans-serif !important;
    background: none repeat scroll 0% 0% #FFF !important;
    border: 1px solid #E7E7E7 !important;
    color: rgba(85, 81, 81, 0.84) !important;
    padding: 8px !important;
    display: block !important;
    width: 98% !important;
    outline: medium none !important;
    text-transform: capitalize !important;
}

div.error-message{font-size: 12px;color: #ff0000}
.messageBox{height: 40px;}
#flashMessage.error{border: 1px solid #0A0909;padding: 10px; background-color: #F7D4CD;}
#flashMessage.success{border: 1px solid #0A0909;padding: 10px; background-color: #BFF2A2;}
</style>
<!-- start top_bg -->
<div class="top_bg bg_image">
    <div class="wrap">
	    <div class="top">
		    <h2><?php echo $title_for_layout;?></h2>
	    </div>
    </div>
</div>
<!-- start main -->
<div class="wrap">
    <div class="main">	
	     <div class="contact">
    <?php if ($this->Session->check('Message.flash')) { ?>
				<div class="messageBox">
					<?php echo $this->Session->flash();?>
				</div>
    <?php } ?>			
		    <div class="contact-form">
			    
			    <div class="content">
				    <h2>Login Information</h2>
			     </div>
			    <?php echo $this->Form->create('homes', array('type' => 'POST', 'action' => 'sign_up', 'name' => 'sign_up', 'id' => 'sign_up', 'class' => 'form-horizontal', 'role' => 'form', 'novalidate' => true, )); ?>
				
				<div>
				    <span><label>Choose a Service <span class="required">*</span></label></span>
				    <span>
					<input name="data[Customer][service_type]" id="CustomerServiceType0" class="form-control" value="d" type="radio" checked="checked">
					<label style="display:inline">Day Trading <span style="color:#253825"> ( $149.00 )</span></label>
					<input name="data[Customer][service_type]" id="CustomerServiceType1" class="form-control" value="s" type="radio">
					<label style="display:inline">Short-Term Trading  <span style="color:#103510"> ( $49.00 )</span></label>
					<?php echo $this->Form->error('Customer.service_type'); ?>
				    </span>
				</div>
				
				<div>
				    <span><label>Username <span class="required">*</span></label></span>
				    <span>
					<?php echo $this->Form->input('Customer.username', array('label' => false, 'div' => false, 'class' => 'textbox', 'required' => true, 'placeholder' => 'Choose a Username', 'minlength' => 6, 'maxlength' => 50)); ?>
				    </span>
				</div>

				<div>
				    <span><label>Password <span class="required">*</span></label></span>
				    <span>
					<?php echo $this->Form->input('Customer.password', array('label' => false, 'div' => false, 'class' => 'textbox passwordStl', 'required' => true, 'placeholder' => 'Choose a password', 'minlength' => 6, 'maxlength' => 50)); ?>
				    </span>
				</div>

				<div>
				    <span><label>Re-Enter Password <span class="required">*</span></label></span>
				    <span>
					<?php echo $this->Form->input('Customer.cpassword', array('type'=>'password', 'label' => false, 'div' => false, 'class' => 'textbox passwordStl', 'required' => true, 'placeholder' => 'Re-Enter Password', 'minlength' => 6, 'maxlength' => 50)); ?>
				    </span>
				</div>

				<div>
				    <span><label>Security Question</label></span>
				    <span>
					<?php echo $this->Form->input('Customer.security_question', array('label' => false, 'div' => false, 'class' => 'textbox', 'required' => true, 'placeholder' => 'Security Question', 'minlength' => 6, 'maxlength' => 250)); ?>
				    </span>
				</div>

				<div>
				    <span><label>Security Answer</label></span>
				    <span>
					<?php echo $this->Form->input('Customer.security_answer', array('label' => false, 'div' => false, 'class' => 'textbox', 'required' => true, 'placeholder' => 'Security Answer', 'minlength' => 6, 'maxlength' => 250)); ?>
				    </span>
				</div>

			    <div class="content">
				    <h2>Contact Information</h2>
			    </div>
				
				<div>
				    <span><label>First Name <span class="required">*</span></label></span>
				    <span>
					<?php echo $this->Form->input('Customer.first_name', array('label' => false, 'div' => false, 'class' => 'textbox', 'required' => true, 'placeholder' => 'Your First Name', 'minlength' => 2, 'maxlength' => 50)); ?>
				    </span>
				</div>

				<div>
				    <span><label>Last Name <span class="required">*</span></label></span>
				    <span>
					<?php echo $this->Form->input('Customer.last_name', array('label' => false, 'div' => false, 'class' => 'textbox', 'required' => true, 'placeholder' => 'Your Last Name', 'minlength' => 2, 'maxlength' => 50)); ?>
				    </span>
				</div>

				<div>
				    <span><label>Email <span class="required">*</span></label></span>
				    <span>
					<?php echo $this->Form->input('Customer.email', array('type'=>'text', 'label' => false, 'div' => false, 'class' => 'textbox', 'required' => true, 'placeholder' => 'Your Email Address', 'minlength' => 6, 'maxlength' => 50)); ?>
				    </span>
				</div>

				<div>
				    <span><label>Address #1 <span class="required">*</span></label></span>
				    <span>
					<?php echo $this->Form->input('Customer.address1', array('type'=>'text', 'label' => false, 'div' => false, 'class' => 'textbox', 'required' => true, 'placeholder' => 'Address Line #1', 'minlength' => 6, 'maxlength' => 250)); ?>
				    </span>
				</div>

				<div>
				    <span><label>Address #2</label></span>
				    <span>
					<?php echo $this->Form->input('Customer.address2', array('type'=>'text', 'label' => false, 'div' => false, 'class' => 'textbox', 'required' => true, 'placeholder' => 'Address Line #2', 'minlength' => 6, 'maxlength' => 250)); ?>
				    </span>
				</div>

				<div>
				    <span><label>City <span class="required">*</span></label></span>
				    <span>
					<?php echo $this->Form->input('Customer.city', array('type'=>'text', 'label' => false, 'div' => false, 'class' => 'textbox', 'required' => true, 'placeholder' => 'City', 'minlength' => 6, 'maxlength' => 250)); ?>
				    </span>
				</div>				

				<div>
				    <span><label>Country <span class="required">*</span></label></span>
				    <span>
					<?php echo $this->Form->select('Customer.country', $listCountries, array('empty' => '---Select Country---', 'label' => false, 'div' => false, 'class' => 'selectStl', 'required' => true, 'onChange'=>'fetchStates(this.value, "")')); ?>
				    </span>
				</div>
				
				<div>
				    <span><label>State <span class="required">*</span></label></span>
				    <span>
					<?php echo $this->Form->select('Customer.state', array(), array('empty' => '---Select State---', 'label' => false, 'div' => false, 'class' => 'selectStl', 'required' => true)); ?>
				    </span>
				</div>								

				<div>
				    <span><label>Postal Code/Zip <span class="required">*</span></label></span>
				    <span>
					<?php echo $this->Form->input('Customer.zip', array('type'=>'text', 'label' => false, 'div' => false, 'class' => 'textbox', 'required' => true, 'placeholder' => 'Postal Code/Zip', 'minlength' => 4, 'maxlength' => 8)); ?>
				    </span>
				</div>								

				<div>
				    <span><label>Phone <span class="required">*</span></label></span>
				    <span>
					<?php echo $this->Form->input('Customer.phone', array('type'=>'text', 'label' => false, 'div' => false, 'class' => 'textbox', 'required' => true, 'placeholder' => 'Phone #', 'minlength' => 10, 'maxlength' => 14)); ?>
				    </span>
				</div>												
				
				<div>
				     <span><?php echo $this->Form->submit('SignUp', array('div'=>false, 'label'=>false)); ?></span>
			       </div>
			    <?php echo $this->Form->end(); ?>
		    </div>
		    <div class="clear"> </div>
		    <div style="text-align: center;">
			    <?php echo $this->Html->image('front/payments.png', array('alt'=>'Payment types'));?>
		    </div>
	    </div>
	</div>
</div>
<!-- start footer -->
<script type="text/javascript">
jQuery(document).ready(function (){
    fetchStates('<?php echo @$this->request->data['Customer']['country']?>', '<?php echo @$this->request->data['Customer']['state']?>');
});

function fetchStates(country, state){
    var selState = '';
    if (state!='') {
	selState = state;
    }
    if (country!=""&& typeof country !="undefined") {
	jQuery.ajax({
	    type:'GET',
	    url:'<?php echo $this->Html->url(array('controller'=>'homes', 'action'=>'getStates'))?>/'+country+'/'+selState,
	    success:function(response){
		jQuery('#CustomerState').html(response);
	    }
	});
    }
}

</script>