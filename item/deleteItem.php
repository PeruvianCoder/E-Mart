<?php
	if(isset($_POST['item_id'])){
		$item_id = $_POST['item_id'];
	}

	include_once '../config/db-con.php';


	$check = "SELECT * FROM item WHERE item_id ='" . $item_id . "';";
	if($result = mysqli_query($conn,$check)) {
		if(mysqli_num_rows($result) <= 0) {
			header("Location: ../?itemDeleted");
			die();
		}
	}

	$delete = "DELETE * FROM item WHERE item_id = '" . $item_id . "';";

	mysqli_query($conn, $delete);

	mysqli_close($conn);

	header("Location: ../?");
?>