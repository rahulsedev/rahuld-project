<?php $this->Html->script('jquery.validate', array('inline' => false)); ?>
<?php echo $this->Html->script('fckeditor'); ?>
<div id="breadcrumbs" class="breadcrumbs clearfix"> <!-- breadcrumbs start -->
    <ul class="breadcrumb col-xs-6">
        <li>
            <i class="glyphicon glyphicon-home home-icon"></i>
            <?php echo $this->Html->link('Home', array('controller' => 'users', 'action' => 'dashboard', 'admin' => true)); ?>
        </li>
        <li>
            <i class="glyphicon glyphicon-file icon-white"></i>
            <?php echo $this->Html->link('Static CMS Pages', array('controller' => 'pages', 'action' => 'listmspages', 'admin' => true)); ?>
        </li>
        <li class="active">Edit CMS Page</li>
    </ul>
</div> <!-- breadcrumbs end -->
<div class="clearfix"></div>

<div id="signup-form"> 
    <div class="header clearfix">     
        <h1>Edit CMS Page</h1>            
    </div>
    <p>Please complete the fields below,</p>
    <?php echo $this->Form->create('pages', array('type' => 'POST', 'action' => 'edit_cmspage', 'class' => 'form-horizontal', 'id' => 'editCmsPageForm')); ?>	
    <?php echo $this->Form->input('CmsPage.id', array('type' => 'hidden')); ?>
    <div class="form-group">
        <label for="text1" class="control-label col-sm-4">Page Title</label>
        <div class="col-sm-6">
            <?php echo $this->Form->input('CmsPage.title', array('type' => 'text', 'class' => 'form-control', 'label' => false, 'div' => false, 'maxlength' => 255, 'required' => false)); ?> 							
        </div>
    </div>
    <p>    			 
        <label  class="col-xs-2">Page Content</label>
        <?php
            echo $this->Form->input('CmsPage.content', array('type' => 'textarea', 'rows' => 10, 'cols' => 50, 'label' => false, 'div' => false, 'required' => false, 'class' => ''));
            echo $this->Fck->load('CmsPageContent');
        ?> 
    </p>
    <p>
        <button class="btn btn-info" type="submit">Update</button>
        <button class="btn btn-default cancel" data-href="<?php echo $this->Html->url(array('controller' => 'pages', 'action' => 'listcmspages', 'admin' => true)); ?>" type="button">Cancel</button>
    </p>
    <?php echo $this->Form->end(); ?>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$("#editCmsPageForm").validate();
		$(".cancel").click(function(event) {
			event.preventDefault();
			window.location.href = $(this).attr('data-href');
		});
	});
</script>