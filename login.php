<?php
	
	require_once("db.inc");

	$response = array();

	if(isset($_POST['kayttajatunnus']) && isset($_POST['salasana'])) {
		
		$kayttajatunnus = $_POST["kayttajatunnus"];
		$salasana = $_POST["salasana"];
		
		$result = mysqli_query($conn, "SELECT * FROM user WHERE kayttajatunnus='$kayttajatunnus' AND salasana='$salasana'");

		if ($result) {

			$response["success"] = 1;
			$response["message"] = "Kirjautuminen onnistui";

			echo json_encode($response);
		}
		else {

			$response["success"] = 0;
			$response["message"] = "Kirjatuminen epäonnistui";
		}
	}
	else {

		$response["success"] = 0;
		$response["message"] = "Vaadittu kenttä puuttuu";
	}

	

	
	
	
?>