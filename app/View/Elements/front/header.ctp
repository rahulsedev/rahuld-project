<?php
    if(!empty($this->params['action'])){
	$active1 = $active2 = $active3 = $active4 = $active5 = $active6 = $active7 = "";
	switch($this->params['action']){
	    case 'index':$active1="active";break;
	    case 'about':$active2="active";break;
		  case 'products':$active3="active";break;
	    case 'contact':$active4="active";break;
	    default : $active1="active";break;
	}
    }else{
	$active1="active";
    }
?>
<style>.active a{color: #F78E21 !important}</style>
<header>
		<div id="top-header">
				<div class="container">
						<div class="row">
								<div class="col-md-6">
										<div class="home-account">
												<?php echo $this->Html->link("Home", array("controller"=>"homes", "action"=>"index", "admin"=>false))?>
												<?php echo $this->Html->link("Member Area", array("controller"=>"users", "action"=>"index", "admin"=>true))?>
										</div>
								</div>
								<div class="col-md-6">
										<div class="cart-info">
												<i class="fa fa-shopping-cart"></i>
												(<a href="#">5 items</a>) in your cart (<a href="#">$45.80</a>)
										</div>
								</div>
						</div>
				</div>
		</div>
		<div id="main-header">
				<div class="container">
						<div class="row">
								<div class="col-md-3">
										<div class="logo">
												<a href="<?php echo $this->Html->url(array("controller"=>"homes", "action"=>"index", "admin"=>false))?>">
														<img src="<?php echo $this->webroot;?>img/logo.png" title="Grill Template by templatemo.com" alt="Grill Website Template by templatemo.com" >
												</a>
										</div>
								</div>
								<div class="col-md-6">
										<div class="main-menu">
												<ul>
														<li class="<?php echo $active1;?>"><?php echo $this->Html->link("Home", array("controller"=>"homes", "action"=>"index", "admin"=>false))?></li>
														<li class="<?php echo $active2;?>"><?php echo $this->Html->link("About", array("controller"=>"homes", "action"=>"about", "admin"=>false))?></li>
														<li class="<?php echo $active3;?>"><?php echo $this->Html->link("Products", array("controller"=>"homes", "action"=>"products", "admin"=>false))?></li>
														<li class="<?php echo $active4;?>"><?php echo $this->Html->link("Contact", array("controller"=>"homes", "action"=>"contact", "admin"=>false))?></li>
												</ul>
										</div>
								</div>
								<div class="col-md-3">
										<div class="search-box">  
												<form name="search_form" method="get" class="search_form">
														<input id="search" type="text" />
														<input type="submit" id="search-button" />
												</form>
										</div>
								</div>
						</div>
				</div>
		</div>
</header>