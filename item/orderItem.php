<?php
	session_start();
	// VALIDATE'S FIELDS

	if(isset($_POST['item_id']) && isset($_POST['quantity'])){
		// SET DATA TO VARIABLES
		//$order_id 		= $_POST['order_id'];
		$item_id 		= $_POST['item_id'];
		$quantity 		= $_POST['quantity'];
	} else {
		// IF VALIDATION FAILS REDIRECT USER
		header("Location: ../?fail");
		die();
	}

	$order_id  = uniqid(mt_rand(), true);
	$items 	   = $_POST['items'];

	include_once '../config/db-con.php';

	$items['order_id'] = $order_id;

	$columns = implode(", ",array_keys($items));
	$escaped_values = array_map('mysql_real_escape_string', array_values($items));
	$values  = implode(", ", $escaped_values);
	$sql = "INSERT INTO `order_item`($columns) VALUES ($values)";

	$insert = "INSERT INTO order_item (order_id, item_id, quantity) VALUES ('". $order_id . "','" . $item_id . "', 
		'" . $quantity . "');";

	mysqli_query($conn, $insert);

	$getOrder = "SELECT * FROM order_item WHERE order_id = '". $order_id . "';";
	if($result = mysqli_query($conn,$getOrder)) {
		while($row = mysqli_fetch_assoc($result)) {
			$item_id = $row['item_id'];
			$getPrice = "SELECT price FROM item WHERE item_id = '" . $item_id . "';";
			$_SESSION['PRICE']			= $row['price'];
			$_SESSION['ORDER_ID']		= $row['order_id'];
			$_SESSION['ITEM_ID']		= $row['item_id'];
			$_SESSION['QUANTITY']		= $row['quantity'];
			$_SESSION['PRICE']			= $getPrice;
		}
	}

	mysqli_close($conn);

	header("Location: ./");

?>