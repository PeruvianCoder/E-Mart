<?php
	// VALIDATE'S FIELDS
	if(isset($_POST['item_id']) && isset($_POST['description']) && isset($_POST['name']) && isset($_POST['price']) && isset($_POST['quantity']) &&isset($_POST['image'])){
		// SET DATA TO VARIABLES
		$item_id 		= $_POST['item_id'];
		$description 	= $_POST['description'];
		$name 			= $_POST['name'];
		$price 			= $_POST['price'];
		$quantity 		= $_POST['quantity'];
	} else {
		// IF VALIDATION FAILS REDIRECT USER
		header("Location: ../?fail");
		die();
	}

	include_once '../config/db-con.php';

	$check = "SELECT * FROM item WHERE item_id ='" . $item_id . "';";
	if($result = mysqli_query($conn,$check)) {
		if(mysqli_num_rows($result)) {
			header("Location: ../?itemExists");
			die();
		}
	}

	$insert = "INSERT INTO item (item_id, description, name, price, quantity, image) VALUES ('" . $item_id . "', '" . $description . "', '" . $name . "', '" . $price . "', '" . $quantity . "', '../images/pic01.jpg'); ";

	mysqli_query($conn, $insert);

	$getItem = "SELECT * FROM item ORDER BY item_id DESC LIMIT 1;";
	if($result = mysqli_query($conn,$getItem)) {
		while($row = mysqli_fetch_assoc($result)) {
			$_SESSION['ITEM_ID'] 	 	= $row['item_id'];
			$_SESSION['DESCRIPTION'] 	= $row['description'];
			$_SESSION['NAME'] 			= $row['name'];
			$_SESSION['PRICE']			= $row['price'];
			$_SESSION['QUANTITY']		= $row['quantity'];
		}
	}

	mysqli_close($conn);

	header("Location: ./");
?>