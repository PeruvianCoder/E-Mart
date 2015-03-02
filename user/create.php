<?php
	session_start();
	// VALIDATE'S FIELDS
	if(isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['password'])) {
		// SET DATA TO VARIABLES
		$first_name 	= $_POST['first_name'];
		$last_name 		= $_POST['last_name'];
		$email 			= $_POST['email'];
		$pass 			= $_POST['password'];
	} else {
		// IF VALIDATION FAILS REDIRECT USER
		header("Location: ../?fail");
		die();
	}

	// CONNECT TO DB
	include_once '../config/db-con.php';

	// CHECK IF USER EXISTS
	$check = "SELECT id FROM user WHERE email='" . $email . "';";
	if($result = mysqli_query($conn,$check)) {
		if(mysqli_num_rows($result)) {
			header("Location: ../?exists");
			die();
		}
	}

	// QUERY TO INSERT DATA
	$insert = "INSERT INTO user (first_name,last_name,email,password) values ('" . $first_name . "','" . $last_name . "','" . $email . "','"
	. hash('sha512',$pass) ."');";

	// RUN QUERY
	mysqli_query($conn,$insert);

	// START SESSION
	session_start();

	// RETRIEVE ID
	$getId = "SELECT id FROM user ORDER BY id DESC LIMIT 1;";
	if($result = mysqli_query($conn,$getId)) {
		while($row = mysqli_fetch_assoc($result)) {
			$_SESSION['USER_ID'] = $row['id'];
		}
	}

	// CLOSE CONNECTION
	mysqli_close($conn);

	// REDIRECT
	header("Location: ./");
?>