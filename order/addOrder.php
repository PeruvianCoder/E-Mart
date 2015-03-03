<?php
	session_start();
	// VALIDATE'S FIELDS

	if(isset($_POST['order_id'])){
		// SET DATA TO VARIABLES
		$order_id 		= $_POST['order_id'];
		//$user_id 		= $_POST['description'];
	} else {
		// IF VALIDATION FAILS REDIRECT USER
		header("Location: ../?fail");
		die();
	}

	$user_id 	= $_SESSION['USER_ID'];

	include_once '../config/db-con.php';

	$insert = "INSERT INTO order (order_id, user_id) VALUES ('" . $order_id . "','" . $user_id . "');";

	mysqli_query($conn, $insert);

	$getOrder = "SELECT * FROM order WHERE user_id = '". $user_id . "';";
	if($result = mysqli_query($conn,$getOrder)) {
		while($row = mysqli_fetch_assoc($result)) {
			$_SESSION['ORDER_ID'] = $row['order_id'];
		}
	}

	mysqli_close($conn);

	header("Location: ../orderConfirmMail.php");

?>