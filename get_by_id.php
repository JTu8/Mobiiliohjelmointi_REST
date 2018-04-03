<?php

    $response = array();

    require_once("db.inc");

    //$db = new DB_CONNECT();

    if (isset($_GET['ID'])) {

        $ID = $_GET['ID'];

        $result = mysqli_query($conn, "SELECT * FROM user WHERE ID = $ID");

        if (!empty($result)) {

            if (mysqli_num_rows($result) > 0) {

                $result = mysqli_fetch_array($result);

                $user = array();
                $user["ID"] = $result["ID"];
                $user["kayttajatunnus"] = $result["kayttajatunnus"];
                $user["nimi"] = $result["nimi"];
                $user["salasana"] = $result["salasana"];
                $user["lisatieto"] = $result["lisatieto"];

                $response["success"] = 1;

                $response["user"] = array();

                array_push($response["user"], $user);

                echo json_encode($response);

                myLog("######### '". date('d-M-Y H:i:s'). "'Log start##########'");
                myLog("Käyttäjää haettu ID:n perusteella");
                myLog("#########End log##########");

            }
            else {

                $response["success"] = 0;
                $response["message"] = "Käyttäjää ei löytynyt";

                echo json_encode($response);

                myLog("######### '". date('d-M-Y H:i:s'). "'Log start##########'");
                myLog("Haku epäonnistui");
                myLog("#########End log##########");
            }
        }
        else {

            $response["success"] = 0;
            $response["message"] = "Käyttäjää ei löytynyt";

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