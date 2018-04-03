<?php

    
    $response = array();

    require_once("db.inc");

    $result = mysqli_query($conn, "SELECT * FROM user");

    if (mysqli_num_rows($result) > 0) {

        $response["user"] = array();

        while($row = mysqli_fetch_array($result)) {

            $user = array();
            $user["ID"] = $row["ID"];
            $user["kayttajatunnus"] = $row["kayttajatunnus"];
            $user["nimi"] = $row["nimi"];
            $user["salasana"] = $row["salasana"];
            $user["lisatieto"] = $row["lisatieto"];

            array_push($response["user"], $user);
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