<div aria-hidden="true" role="dialog" tabindex="-1" class="modal show" id="loginModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="login-goo"></div>
            <!--modal-header Start-->
            <div class="modal-header">	
                <h1 class="text-center"><?php echo $this->Html->image('logo.png'); ?></h1>
				<h3 class="text-center"><?php echo __('Forgot Password ?'); ?></h3>
                <h5 class="text-center"><?php echo __('Fill out the form below. Keep an eye on your inbox for your new password.'); ?></h5>
            </div>
            <!--modal-header Closed-->
            <!--modal-body Start-->
            <div class="modal-body ">
                <div class="login-error"><?php echo $this->Session->flash(); ?></div>
                <div class="clearfix"></div>
                <?php echo $this->Form->create('users', array('type' => 'POST', 'action' => 'login', 'name' => 'loginform', 'id' => 'loginform', 'class' => 'form col-sm-10 center-block')); ?>	
                <div class="form-group">
                    <?php echo $this->Form->input('User.user_name', array('type' => 'text', 'label' => false, 'div' => false, 'placeholder' => "Username", 'class' => "form-control input-lg userame")); ?>
                </div>
                <div class="form-group">
                    <?php echo $this->Form->input('User.email', array('type' => 'email', 'label' => false, 'div' => false, 'placeholder' => "Email", 'class' => "form-control input-lg email")); ?>
                </div>
                <div class="form-group"> <button class="btn btn-info btn-block" data-dismiss="modal" aria-hidden="true"><?php echo __('Recover Password'); ?></button></div>
                <?php echo $this->Form->end(); ?>
                <div class="clearfix"></div>
            </div>
            <!--modal-body Closed-->
            <!--modal-footer Start-->
            <div class="modal-footer" >
                <div class="col-sm-10 center-block"> <div class="col-sm-5">&nbsp;</div> &nbsp; 
                    <?php echo $this->Html->link(__('Back to Login'), Configure::read('FULL_BASE_URL.URL'), array('class' => 'forgot', 'escape' => false)); ?>
                </div>	
            </div>
            <!--modal-footer Closed-->
        </div>
    </div>
    <div class="copyright"><?php echo Configure::read('SITE_SETTINGS.Copyright'); ?></div>
</div>