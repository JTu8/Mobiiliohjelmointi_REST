<?php

	$response = array();
	
	if (isset($_POST['ID'])) {
		
		$ID = $_POST['ID'];
		
		require_once("db.inc");
		
		$result = mysqli_query($conn, "DELETE FROM user WHERE ID = $ID");
		
		if (mysqli_affected_rows() > 0) {
			
			$response["success"] = 1;
			$response["message"] = "Käyttäjä poistettu";
			
			echo json_encode($response);
		}
		else {
			
			$response["success"] = 0;
			$response["message"] = "K�ytt�j�� ei l�ytynyt";
		}
	}
	else {
		
		$response["success"] = 0;
		$response["message"] = "Vaadittu kentt� puuttuu";
		
		echo json_encode($response);
	}
?>