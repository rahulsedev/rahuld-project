<form id="paypalForm" name="_xclick" action="https://www.sandbox.paypal.com/webscr" method="post"> <?php //paypal sandbox post url?>
 
 <input type="hidden" name="cmd" value="_xclick">
 
 <input type="hidden" name="business" value="rahulsedev-facilitator@gmail.com"> <?php //Paypal sandbox seller account email id?>
 
 <input type="hidden" name="currency_code" value="USD"> <?php //enter your currency code?>
 
 <input type="hidden" name="item_name" value="test product"> <?php //enter the item name?>
 
 <input type="hidden" name="return" value="<?php echo Configure::read('FULL_BASE_URL.URL')?>/homes/thankyou"> <?php //url to return once payment is done.?>

 <input type="hidden" name="cancel_return" value="<?php echo Configure::read('FULL_BASE_URL.URL')?>/homes/cancel"> <?php //url to return once payment is done.?>

 <input type="hidden" name="notify_return" value="<?php echo Configure::read('FULL_BASE_URL.URL')?>/homes/notify"> <?php //url to return once payment is done.?>
 
 <input type="hidden" name="rm" value="2">
    
 <input type="hidden" name="amount" value="1"> <?php //amount of transaction needs to be credited to your paypal account?>
 
</form>

<script>
    jQuery(document).ready(function(){
	jQuery("#paypalForm").submit();
    });
</script>