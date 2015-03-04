<?php
	require_once('../stripe-php-2.1.1/init.php');

	if(isset($_POST['order_id']) && isset($_POST['USER_ID'])){

	
	try {
	  // TODO
	  \Stripe::setApiKey('sk_test_o7fozNe2H2phOAKt2AyPleoW');
	} catch(\Stripe\Error\Card $e) {
	  // Since it's a decline, \Stripe\Error\Card will be caught
	  $body = $e->getJsonBody();
	  $err  = $body['error'];

	  print('Status is:' . $e->getHttpStatus() . "\n");
	  print('Type is:' . $err['type'] . "\n");
	  print('Code is:' . $err['code'] . "\n");
	  // param is '' in this case
	  print('Param is:' . $err['param'] . "\n");
	  print('Message is:' . $err['message'] . "\n");
	} catch (\Stripe\Error\InvalidRequest $e) {
	  // Invalid parameters were supplied to Stripe's API
	} catch (\Stripe\Error\Authentication $e) {
	  // Authentication with Stripe's API failed
	  // (maybe you changed API keys recently)
	} catch (\Stripe\Error\ApiConnection $e) {
	  // Network communication with Stripe failed
	} catch (\Stripe\Error\Base $e) {
	  // Display a very generic error to the user, and maybe send
	  // yourself an email
	} catch (Exception $e) {
	  // Something else happened, completely unrelated to Stripe
	}
?>
