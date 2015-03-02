<?php
	session_start();
	// VALIDATE'S FIELDS

	// if(isset($_POST['order_id']) && isset($_POST['user_id'])){
	// 	// SET DATA TO VARIABLES
	// 	$item_id 		= $_POST['item_id'];
	// 	$description 	= $_POST['description'];
	// 	$name 			= $_POST['name'];
	// 	$price 			= $_POST['price'];
	// 	$quantity 		= $_POST['quantity'];
	// 	$user_id 		= $_POST['user_'];
	// } else {
	// 	// IF VALIDATION FAILS REDIRECT USER
	// 	header("Location: ../?fail");
	// 	die();
	// }

	$user_id = $_SESSION['USER_ID'];

	include_once '../config/db-con.php';

	$insert = "INSERT INTO order (user_id) VALUES ('" . $user_id . "');";

	mysqli_query($conn, $insert);

	session_start();

	$getItem = "SELECT * FROM order WHERE user_id = '". $user_id . "';";
	if($result = mysqli_query($conn,$getItem)) {
		while($row = mysqli_fetch_assoc($result)) {
			$_SESSION['ITEM_ID'] 	 	= $row['item_id'];
			$_SESSION['NAME'] 			= $row['name'];
			$_SESSION['PRICE']			= $row['price'];
			$_SESSION['QUANTITY']		= $row['quantity'];
			$_SESSION['IMAGE'] 			= $row['image'];
		}
	}
	
	mysqli_close($conn);
	
	header("Location: ./");

?>