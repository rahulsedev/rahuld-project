<div class="modal-dialog">
		<div class="modal-content login-page">
				<div class="login-goo"></div>
				<!--modal-header Start-->
				<div class="modal-header">	
						<!--h1 class="text-center"><?php // echo $this->Html->image('logo.png'); ?></h1-->
		<h3 class="text-center"><?php echo __('Administration Panel'); ?></h3>
				</div>
				<!--modal-header Closed-->
				<!--modal-body Start-->
				<div class="modal-body ">
						<div class="login-error"><?php echo $this->Session->flash(); ?></div>
						<div class="clearfix"></div>
						<?php echo $this->Form->create('users', array('type' => 'POST', 'action' => 'login', 'name' => 'loginform', 'id' => 'loginform', 'class' => 'form col-sm-10 center-block', 'novalidate')); ?>	
						<div class="form-group">
								<?php echo $this->Form->input('User.user_name', array('type' => 'text', 'label' => false, 'div' => false, 'placeholder' => "Username", 'class' => "form-control input-lg userame")); ?>
						</div>
						<div class="form-group">
								<?php echo $this->Form->input('User.password', array('type' => 'password', 'label' => false, 'div' => false, 'placeholder' => "Password", 'class' => "form-control input-lg password")); ?>
						</div>
						<div class="form-group"> <button class="btn btn-info btn-block" data-dismiss="modal" aria-hidden="true"><?php echo __('Login'); ?></button></div>
						<?php echo $this->Form->end(); ?>
						<div class="clearfix"></div>
				</div>
				<!--modal-body Closed-->
				<!--modal-footer Start-->
				<div class="modal-footer" >
						<div class="col-sm-10 center-block"> <div class="col-sm-5"><label><input type="checkbox"><?php echo __(' Remember me?'); ?></label></div> &nbsp; 
								<?php echo $this->Html->link(__('Forgot Password ?'), array('controller' => 'users', 'action' => 'forgotpassword'), array('class' => 'forgot', 'escape' => false)); ?>
						</div>	
				</div>
				<!--modal-footer Closed-->
		</div>
</div>