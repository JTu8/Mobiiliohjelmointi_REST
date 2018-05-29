<?php

    
    $response = array();

    require_once("db.inc");
	
	$tila = "UUSI";

    $result = mysqli_query($conn, "SELECT * FROM works WHERE tila = '$tila'");

    if (mysqli_num_rows($result) > 0) {

        $response["works"] = array();
		
		

        while($row = mysqli_fetch_array($result)) {

            $work = array();
            $work["ID"] = $row["ID"];
            $work["tyo_ID"] = $row["tyo_ID"];
            $work["kuvaus"] = $row["kuvaus"];
            $work["pvm"] = $row["pvm"];
            $work["tila"] = $row["tila"];

            array_push($response["works"], $work);
			
			
        }

        $response["success"] = 1;

        echo json_encode($response);

        
        myLog("######### '". date('d-M-Y H:i:s'). "'Log start##########'");
        myLog("Kaikkia käyttäjiä haettu");
        myLog("#########End log##########\n");

        
    }
    else {

        $response["success"] = 0;
        $response["message"] = "Käyttäjiä ei löytynyt";

        echo json_encode($response);

        myLog("######### '". date('d-M-Y H:i:s'). "'Log start##########'");
        myLog("Haku epäonnistui");
        myLog("#########End log##########");

        
    }

    function myLog($msg) {

        $logfile = 'log/log_' . date('d-M-Y') . '.log';

        file_put_contents($logfile, $msg . "\n", FILE_APPEND);
    }

    
?>