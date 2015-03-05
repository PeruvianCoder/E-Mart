<?php
	require_once('../stripe-php-2.1.1/init.php');

	if(isset($_POST['order_id']) && isset($_SESSION['USER_ID'])){
		$order_id 	 = $_POST['order_id'];
		$user_id  	 = $_SESSION['USER_ID'];
		$card_number = $_POST['card_number'];
		$exp_month   = $_POST['exp_month'];
		$exp_year    = $_POST['exp_year'];
		$amount 	 = $_POST['amount'];
	}

	//Split amount taken from form and convert it to cents
	$split = explode(".", $amount);
	$dollarToCents = $split[0] * 100;
	$amount = $dollarToCents + $split[1];

	$card = array('number' => $card_number, 'exp_month' => $exp_month, 'exp_year' => $exp_year);

	try {
	  // TODO
	  \Stripe::setApiKey('sk_test_o7fozNe2H2phOAKt2AyPleoW');

	  \Stripe\Charge::create(array(
	  	'card'				=> $card,
	  	"amount" 			=> $amount,
	  	"currency"			=> "usd",
	  	"source"			=> "tok_15cgmEJYnaXnkuyOcXphZGn0",
	  	"receipt_email"		=> $email,
	  	"metadata"	=> array("order_id" => $order_id, "user_id" => $user_id, "email" => $email)
	  ));

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
