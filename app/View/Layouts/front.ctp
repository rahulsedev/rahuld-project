<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->

<!-- templatemo 417 grill -->
<!-- 
Grill Template 
http://www.templatemo.com/preview/templatemo_417_grill 
-->
    <head>
        <meta charset="utf-8">
        <title>Tridev Sales & Marketing Services</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
				
				<?php echo $this->Html->css(array(
																					'front/css/bootstrap',
																					'front/css/font-awesome',
																					'front/css/templatemo_style',
																					'front/css/templatemo_misc',
																					'front/css/flexslider',
																					'front/css/testimonails-slider',
																					)
																		);?>
				<?php echo $this->fetch('css');?>
				
				<?php echo $this->Html->script('front/vendor/modernizr-2.6.1-respond-1.1.0.min');?>						
		</head>
    <body class="bg_background">
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
        <![endif]-->
            <?php echo $this->element('front/header');?>
            <?php echo $this->fetch('content');?>
            <?php echo $this->element('front/footer');?>
				<?php echo $this->Html->script('front/vendor/jquery-1.11.0.min');?>
				<?php echo $this->Html->script('front/vendor/jquery.gmap3.min');?>
				<?php echo $this->Html->script('front/plugins');?>
				<?php echo $this->Html->script('front/main');?>
    </body>
</html>