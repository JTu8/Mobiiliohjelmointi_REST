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

			myLog("######### '". date('d-M-Y H:i:s'). "'Log start##########'");
            myLog("Kirjautuminen onnistui");
            myLog("#########End log##########\n");
		}
		else {

			$response["success"] = 0;
			$response["message"] = "Kirjatuminen epäonnistui";

			myLog("######### '". date('d-M-Y H:i:s'). "'Log start##########'");
            myLog("Kirjautuminen epäonnistui");
            myLog("#########End log##########\n");
		}
	}
	else {

		$response["success"] = 0;
		$response["message"] = "Vaadittu kenttä puuttuu";

		myLog("######### '". date('d-M-Y H:i:s'). "'Log start##########'");
        myLog("Uusi käyttäjä luotu");
        myLog("#########End log##########\n");
	}

	
	function myLog($msg) {

        $logfile = 'log/log_' . date('d-M-Y') . '.log';

        file_put_contents($logfile, $msg . "\n", FILE_APPEND);
    }
	
	
	
?>