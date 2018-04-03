<?php

	$response = array();
	
	if (isset($_POST['ID']) && isset($_POST['kayttajatunnus']) && isset($_POST['nimi']) && isset($_POST['salasana']) && isset($_POST['lisatieto'])) {
		
		$ID = $_POST['ID'];
		$kayttajatunnus = $_POST['kayttajatunnus'];
		$nimi = $_POST['nimi'];
		$salasana = $_POST['salasana'];
		$lisatieto = $_POST['lisatieto'];
		
		require_once("db.inc");
		
		$result = mysqli_query($conn, "UPDATE products SET kayttajatunnus = '$kayttajatunnus', nimi = '$nimi', salasana = '$salasana', lisatieto = '$lisatieto' WHERE ID = $ID");
		
		if ($result) {
			
			$response["success"] = 1;
			$response["message"] = "Käyttäjä päivitetty";
			
			echo json_encode($response);
		}
		else {
			
			
		}
	}
	else {
		
		$response["success"] = 0;
		$respnse["message"] = "Tarvittavat kentät puuttuvat";
		
		echo json_encode($response);
	}
?>