<nav class="navbar navbar-default" role="navigation">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".bs-navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <div class="container-fluid"> <!-- container-fluid start -->
        <div class="row"> <!-- row start -->
            <div class="col-sm-2"> <!-- col-xs-2 start -->
                <div class="navbar-header logo">
                    <?php echo $this->html->link($this->html->image('logo.png'), Router::url('/', true), array('escape' => false, 'title' => 'Tridev Sales & Marketing Solutions')); ?>
                </div> <!-- navbar-header end -->
				<h4 class="logo-slogan"><?php echo __('Tridev Solutions'); ?></h4>
            </div> <!-- col-xs-2 end -->
			<div class="admin-text"><h4  class="logo-slogan"><?php echo __('Administration Panel'); ?></h4></div>
            <div class="col-sm-10 clearfix">                       
                <?php if($this->Session->check('User')){ ?>
								<div class="text-center welcome-setting pull-right">
                    <?php echo __('Welcome '); ?><strong><?php echo $this->Session->read('User.UserType.name'); ?></strong><?php echo __(' ! You are logged into '); ?>
                    <span>Tridev Sales & Marketing Solutions</span>
                </div>
								<?php } ?>
            </div>
        </div>  <!-- row end -->          
    </div> <!-- container-fluid end -->
</nav>  