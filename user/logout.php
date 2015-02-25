<?php
	// DESTROY SESSION
	session_start();
	session_destroy();

	// REDIRECT
	header("Location: ../");
?>