<?php
	session_start();
	
	// AUTHENTICATE
	if(!isset($_SESSION['USER_ID'])) {
		header("Location: ../?error");
		// die();
	}
?>