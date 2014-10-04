<!-- start top_bg -->
<div class="top_bg" style="background-image: url('<?php echo $this->webroot . 'img/banner/' . $data['Banner']['image'] ?>');">
	<div class="wrap">
		<div class="top">
			<h2><?php echo __($data['CmsPage']['title']); ?></h2>
		</div>
	</div>
</div>
<!-- start main -->
<div class="wrap">
<div class="main">
		<div class="about">
	    	<div class="about-p">
				<?php echo __($data['CmsPage']['content']); ?>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>