<?php $this->Html->script('jquery.validate', array('inline' => false)); ?>
<?php echo $this->Html->script('fckeditor'); ?>
<div id="breadcrumbs" class="breadcrumbs clearfix"> <!-- breadcrumbs start -->
    <ul class="breadcrumb col-xs-6">
        <li>
            <i class="glyphicon glyphicon-home home-icon"></i>
            <?php echo $this->Html->link('Home', array('controller' => 'users', 'action' => 'dashboard', 'admin' => true)); ?>
        </li>
        <li>
            <i class="glyphicon glyphicon-envelope icon-white"></i>
            <?php echo $this->Html->link('Email Templates', array('controller' => 'templates', 'action' => 'listtemplates', 'admin' => true)); ?>
        </li>
        <li class="active">Edit Templates</li>
    </ul>
</div> <!-- breadcrumbs end -->
<div class="clearfix"></div>

<div id="signup-form"> 
    <div class="header clearfix">     
        <h1>Edit Templates</h1>            
    </div>
    <p>Please complete the fields below,</p>
    <?php echo $this->Form->create('templates', array('type' => 'POST', 'action' => 'edit_template', 'class' => 'form-horizontal', 'id' => 'editTemplateForm')); ?>	
    <?php echo $this->Form->input('EmailTemplate.id', array('type' => 'hidden')); ?>
    <div class="form-group">
        <label for="text1" class="control-label col-sm-4">Template Used For</label>
        <div class="col-sm-6">
            <?php echo $this->Form->input('EmailTemplate.template_for', array('type' => 'text', 'class' => 'form-control', 'label' => false, 'div' => false, 'maxlength' => 100, 'required' => false)); ?> 							
        </div>
    </div>
    <div class="form-group">
        <label for="text1" class="control-label col-sm-4">Subject Line</label>
        <div class="col-sm-6">
            <?php echo $this->Form->input('EmailTemplate.mail_subject', array('type' => 'text', 'label' => false, 'div' => false, 'maxlength' => 100, 'required' => false, 'class' => 'form-control')); ?> 
        </div>
    </div>	 
    <p>    			 
        <label  class="col-xs-2">Mail Body</label>
        <?php
            echo $this->Form->input('EmailTemplate.mail_body', array('type' => 'textarea', 'rows' => 10, 'cols' => 50, 'label' => false, 'div' => false, 'required' => false, 'class' => ''));
            echo $this->Fck->load('EmailTemplateMailBody');
        ?> 
    </p>
    <p>
        <button class="btn btn-info" type="submit">Update</button>
        <button class="btn btn-default cancel" data-href="<?php echo $this->Html->url(array('controller' => 'templates', 'action' => 'listtemplates', 'admin' => true)); ?>" type="button">Cancel</button>
    </p>
    <?php echo $this->Form->end(); ?>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$("#editTemplateForm").validate();
		$(".cancel").click(function(event) {
			event.preventDefault();
			window.location.href = $(this).attr('data-href');
		});
	});
</script>