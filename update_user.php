<?php

	$response = array();
	
	if (isset($_POST['ID']) && isset($_POST['kayttajatunnus']) && isset($_POST['nimi']) && isset($_POST['salasana']) && isset($_POST['lisatieto'])) {
		
		$ID = $_POST['ID'];
		$kayttajatunnus = $_POST['kayttajatunnus'];
		$nimi = $_POST['nimi'];
		$salasana = $_POST['salasana'];
		$lisatieto = $_POST['lisatieto'];
		
		require_once("db.inc");
		
		$result = mysqli_query($conn, "UPDATE user SET kayttajatunnus = '$kayttajatunnus', nimi = '$nimi', salasana = '$salasana', lisatieto = '$lisatieto' WHERE ID = $ID");
		
		if ($result) {
			
			$response["success"] = 1;
			$response["message"] = "Käyttäjä päivitetty";

			myLog("######### '". date('d-M-Y H:i:s'). "'Log start##########'");
            myLog("Käyttäjä päivitetty");
            myLog("#########End log##########\n");
			
			echo json_encode($response);
		}
		else {

			$response["success"] = 0;
			$response["message"] = "Päivitys epäonnistui";
			
			myLog("######### '". date('d-M-Y H:i:s'). "'Log start##########'");
            myLog("Käyttäjän päivitys epäonnistui");
			myLog("#########End log##########\n");
			
			echo json_encode($response);
			
		}
	}
	else {
		
		$response["success"] = 0;
		$response["message"] = "Tarvittavat kentät puuttuvat";
		
		echo json_encode($response);
	}

	function myLog($msg) {

        $logfile = 'log/log_' . date('d-M-Y') . '.log';

        file_put_contents($logfile, $msg . "\n", FILE_APPEND);
    }
?>