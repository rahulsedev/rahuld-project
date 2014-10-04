<?php echo $this->Html->script('jquery.validate', array('inline' => false)); ?>
<!-- start top_bg -->
<div class="top_bg bg_image">
<div class="wrap">
	<div class="top">
		<h2><?php echo __('Contact Us'); ?></h2>
 	</div>
</div>
</div>
<!-- start main -->
<div class="wrap">
	<div class="main">
	 	 <div class="contact">				
					<div class="contact_info">
						<h2 class="style"><?php echo __('Get In Touch'); ?></h2>
			    	 		<div class="map">
					   			<iframe width="100%" height="250" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.co.in/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Lighthouse+Point,+FL,+United+States&amp;aq=4&amp;oq=light&amp;sll=26.275636,-80.087265&amp;sspn=0.04941,0.104628&amp;ie=UTF8&amp;hq=&amp;hnear=Lighthouse+Point,+Broward,+Florida,+United+States&amp;t=m&amp;z=14&amp;ll=26.275636,-80.087265&amp;output=embed"></iframe><br><small><a href="https://maps.google.co.in/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=Lighthouse+Point,+FL,+United+States&amp;aq=4&amp;oq=light&amp;sll=26.275636,-80.087265&amp;sspn=0.04941,0.104628&amp;ie=UTF8&amp;hq=&amp;hnear=Lighthouse+Point,+Broward,+Florida,+United+States&amp;t=m&amp;z=14&amp;ll=26.275636,-80.087265" style="color:#777777;text-align:left;font-size:13px;">View Larger Map</a></small>
					   		</div>
      				</div>
				  <div class="contact-form">
			 	 <div class="content">
		 	 	<h2><?php echo __('Contact Us'); ?></h2>
		 	 </div>
							<?php echo $this->Session->flash('success'); ?>
							<?php echo $this->Session->flash('error'); ?>
							<?php echo $this->Form->create('Contact', array('type' => 'post', 'url' => array('controller' => 'homes', 'action' => 'contact_us'), 'name' => 'ContactUsForm', 'id' => 'ContactUsForm', 'class' => 'has-validation')); ?>
					    	<div>
						    	<span><label><?php echo __('Name'); ?></label></span>
						    	<span>
									<?php echo $this->Form->input('Contact.name', array('class' => 'textbox', 'label' => false, 'div' => false, 'required' => true)); ?>
								</span>
						    </div>
						    <div>
						    	<span><label><?php echo __('Email'); ?></label></span>
						    	<span>
									<?php echo $this->Form->input('Contact.email', array('type' => 'text', 'class' => 'textbox', 'label' => false, 'div' => false, 'required' => true)); ?>
								</span>
						    </div>
						    <div>
						     	<span><label><?php echo __('Mobile'); ?></label></span>
						    	<span>
									<?php echo $this->Form->input('Contact.number', array('class' => 'textbox', 'label' => false, 'div' => false, 'required' => true)); ?>
								</span>
						    </div>
						    <div>
						    	<span><label><?php echo __('Subject'); ?></label></span>
						    	<span>
									<?php echo $this->Form->input('Contact.subject', array('class' => 'textbox', 'label' => false, 'div' => false, 'required' => true)); ?>
								</span>
						    </div>
						    <div>
						    	<span><label><?php echo __('Message'); ?></label></span>
						    	<span>
									<?php echo $this->Form->textarea('Contact.message', array('class' => 'text-field', 'label' => false, 'div' => false, 'required' => true, 'escape' => false, 'rows' => '10')); ?>
								</span>
						    </div>
						   <div>
						   		<span><input type="submit" class="" value="Submit us"></span>
						  </div>
					    <?php echo $this->Form->end(); ?>
				    </div>
  				<div class="clear"> </div>		
			  </div>
		</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$("#ContactUsForm").validate({
		errorElement: 'div',
		errorClass: 'red'
	});
});
</script>