<?php
	session_start();
	// VALIDATE'S FIELDS

	if(isset($_POST['order_id'])){
		// SET DATA TO VARIABLES
		$order_id 		= $_POST['order_id'];
	} else {
		// IF VALIDATION FAILS REDIRECT USER
		header("Location: ../?fail");
		die();
	}

	$user_id 	= $_SESSION['USER_ID'];
	$order_id 	= $_SESSION['ORDER_ID'];
	$quantity 	= $_SESSION['QUANTITY'];

	include_once '../config/db-con.php';

	$insert = "INSERT INTO order (order_id, user_id) VALUES ('" . $order_id . "','" . $user_id . "');";

	mysqli_query($conn, $insert);

	//Update item table after order is processed
	$getOrder = "SELECT item_id, quantity FROM order_item WHERE order_id = '". $order_id . "';";
	if($result = mysqli_query($conn,$getOrder)) {
		while($row = mysqli_fetch_assoc($result)) {
			$item_id 	= $row['item_id'];
			$quantity 	= $row['quantity'];
 			$updateItem = "UPDATE item SET quantity = quantity - $quantity WHERE item_id = '" . $item_id . "';";
 			mysqli_query($conn, $updateItem);
		}
	}
	
	mysqli_close($conn);
	
	header("Location: ../orderConfirmMail.php");
	
?>