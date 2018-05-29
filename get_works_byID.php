<?php

    $response = array();

    require_once("db.inc");

    //$db = new DB_CONNECT();

    if (isset($_GET['ID'])) {

        $ID = $_GET['ID'];

        $result = mysqli_query($conn, "SELECT * FROM works WHERE ID = $ID");

        if (!empty($result)) {

            if (mysqli_num_rows($result) > 0) {

                $result = mysqli_fetch_array($result);

                $work = array();
                $work["ID"] = $result["ID"];
                $work["tyo_ID"] = $result["tyo_ID"];
                $work["kuvaus"] = $result["kuvaus"];
                $work["pvm"] = $result["pvm"];
                $work["tila"] = $result["tila"];

                $response["success"] = 1;

                $response["work"] = array();

                array_push($response["work"], $work);

                echo json_encode($response);

                myLog("######### '". date('d-M-Y H:i:s'). "'Log start##########'");
                myLog("Töitä haettu ID:n perusteella");
                myLog("#########End log##########");

            }
            else {

                $response["success"] = 0;
                $response["message"] = "Työtä ei löytynyt";

                echo json_encode($response);

                myLog("######### '". date('d-M-Y H:i:s'). "'Log start##########'");
                myLog("Haku epäonnistui");
                myLog("#########End log##########");
            }
        }
        else {

            $response["success"] = 0;
            $response["message"] = "Työtä ei löytynyt";

            echo json_encode($response);

            myLog("######### '". date('d-M-Y H:i:s'). "'Log start##########'");
                myLog("Haku epäonnistui");
                myLog("#########End log##########");
        }

    }
    else {

        $response["success"] = 0;
        $response["message"] = "Vaadittu kenttä puuttuu";

        echo json_encode($response);
        
    }

    function myLog($msg) {

        $logfile = 'log/log_' . date('d-M-Y') . '.log';

        file_put_contents($logfile, $msg . "\n", FILE_APPEND);
    }
?>