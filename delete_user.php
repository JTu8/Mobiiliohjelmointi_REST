<?php

	$response = array();
	
	if (isset($_POST['ID'])) {
		
		$ID = $_POST['ID'];
		
		require_once("db.inc");
		
		$result = mysqli_query($conn, "DELETE FROM user WHERE ID = $ID");
		
		if (mysqli_affected_rows() > 0) {
			
			$response["success"] = 1;
			$response["message"] = "Käyttäjä poistettu";

			myLog("######### '". date('d-M-Y H:i:s'). "'Log start##########'");
            myLog("Käyttäjä poistettu");
            myLog("#########End log##########\n");
			
			echo json_encode($response);
		}
		else {
			
			$response["success"] = 0;
			$response["message"] = "Käyttäjää ei löytynyt";

			myLog("######### '". date('d-M-Y H:i:s'). "'Log start##########'");
            myLog("Poisto epäonnistui");
            myLog("#########End log##########\n");
		}
	}
	else {
		
		$response["success"] = 0;
		$response["message"] = "Vaadittu kenttä puuttuu";

		myLog("######### '". date('d-M-Y H:i:s'). "'Log start##########'");
        myLog("Poisto epäonnistui");
        myLog("#########End log##########\n");
		
		echo json_encode($response);
	}

	function myLog($msg) {

        $logfile = 'log/log_' . date('d-M-Y') . '.log';

        file_put_contents($logfile, $msg . "\n", FILE_APPEND);
    }
?>