<style type="text/css">
    div.error-message{font-size: 12px;color: #ff0000}
    .messageBox{height: 40px;}
    #flashMessage.error{border: 1px solid #0A0909;padding: 10px; background-color: #F7D4CD;}
    #flashMessage.success{border: 1px solid #0A0909;padding: 10px; background-color: #BFF2A2;}
</style>
<div class="wrap">
    <div class="main">
	     <div class="contact">
    <?php if ($this->Session->check('Message.flash')) { ?>
	<div class="messageBox">
		<?php echo $this->Session->flash();?>
	</div>
    <?php } ?>
	</div>
    </div>
</div>
	     