<?php
	session_start();

	$order_id = $_SESSION['order_id']; 

	include_once '../config/db-con.php';

	$delete = "DELETE * FROM order WHERE order_id = '" . $order_id . "';";

	mysqli_query($conn, $delete);

	//CHECK ORDER CANCELLATION
	$check = "SELECT * FROM order WHERE order_id = '" . $order_id . "';";
	if($result = mysqli_query($conn,$check)) {
		if(mysqli_num_rows($result)) {
			header("Location: ../?orderNotCancelled");
			die();
	}

	mysqli_close($conn);

	//ORDER CANCEL SUCCESSFUL
	header("Location: ./");
?>