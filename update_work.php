<?php

	$response = array();
	
	if (isset($_POST['ID']) && isset($_POST['tyo_ID']) && isset($_POST['kuvaus']) && isset($_POST['pvm']) && isset($_POST['tila'])) {
		
		$ID = $_POST['ID'];
		$tyo_ID = $_POST['tyo_ID'];
        $kuvaus = $_POST['kuvaus'];
        $pvm = $_POST['pvm'];
        $tila = $_POST['tila'];
		
		require_once("db.inc");
		
		$result = mysqli_query($conn, "UPDATE user SET tyo_ID = '$tyo_ID', kuvaus = '$kuvaus', pvm = '$pvm', tila = '$tila' WHERE ID = $ID");
		
		if ($result) {
			
			$response["success"] = 1;
            $response["message"] = "Työ päivitetty";
            
            myLog("######### '". date('d-M-Y H:i:s'). "'Log start##########'");
            myLog("Työ päivitetty");
            myLog("#########End log##########\n");
			
			echo json_encode($response);
		}
		else {
			
			myLog("######### '". date('d-M-Y H:i:s'). "'Log start##########'");
            myLog("Työn päivitys epäonnistui");
            myLog("#########End log##########\n");
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