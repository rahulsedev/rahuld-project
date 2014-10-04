<div id="loading"
  style="
	  display: block;
	  position: fixed;
         top: 0px;
         left: 0;
         z-index: 1999;
         width: 100%;
         height: 100%;
		 opacity: 0.8;
         background-color: #000;
         text-align: center;">
<div style="position: relative;
            top: 130px;">
<img src="http://whsadvance.info/wp-content/themes/strata/images/payment-loader.gif" alt="Payment processing..." />
<br>
<h1 style="color: #fff;">Please wait while processing?</h1>
</div>
<p style="position: relative;top: 150px;color: #fff;">Do Not Close This Window (Or Click The Back Button)</p>
</div>

<form id="paypalForm" name="_xclick" action="https://www.sandbox.paypal.com/webscr" method="post"> <?php //paypal sandbox post url?>
 
 <input type="hidden" name="cmd" value="_xclick">
 
 <input type="hidden" name="business" value="rahulsedev-facilitator@gmail.com"> <?php //Paypal sandbox seller account email id?>
 
 <input type="hidden" name="currency_code" value="USD"> <?php //enter your currency code?>
 
 <input type="hidden" name="item_name" value="<?php echo $item_name;?>"> <?php //enter the item name?>
 
 <input type="hidden" name="custom" value="<?php echo $tempCustomerId.'^|'.$uniqueKey;?>"> <?php //custom field?> 
 
 <input type="hidden" name="return" value="<?php echo Configure::read('FULL_BASE_URL.URL')?>/homes/thankyou"> <?php //url to return once payment is done.?>

 <input type="hidden" name="cancel_return" value="<?php echo Configure::read('FULL_BASE_URL.URL')?>/homes/cancel"> <?php //url to return once payment is done.?>

 <input type="hidden" name="notify_url" value="<?php echo Configure::read('FULL_BASE_URL.URL')?>/homes/notify"> <?php //url to return once payment is done.?>
 
 <input type="hidden" name="rm" value="2">
    
 <input type="hidden" name="amount" value="<?php echo $price;?>"> <?php //amount of transaction needs to be credited to your paypal account?>
 
</form>

<script>
    jQuery(document).ready(function(){
	jQuery("#paypalForm").submit();
    });
</script>
