<?php
	// AUTHENTICATE
	if(isset($_POST['email']) && isset($_POST['password'])) {
		$email 			= $_POST['email'];
		$pass 			= $_POST['password'];
	} else {
		// REDIRECT
		header("Location: ../?error");
		die();
	}

	// CONNECT TO DB
	include_once '../config/db-con.php';

	// CHECK IF USER EXISTS
	$check = "SELECT id FROM user WHERE email='" . $email . "' AND password='" . hash('sha512',$pass) . "';";
	if($result = mysqli_query($conn,$check)) {
		if(mysqli_num_rows($result) == 0) {
			header("Location: ../?combo");
			die();
		}

		// START SESSION
		session_start();

		while($row = mysqli_fetch_assoc($result)) {
			// LOG IN
			$_SESSION['USER_ID'] = $row['id'];
		}

		// REDIRECT
		header("Location: ./");
	} 
?>