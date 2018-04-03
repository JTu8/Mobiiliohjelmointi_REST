<?php

    $response = array();

    if (isset($_POST['kayttajatunnus']) && isset($_POST['nimi']) && isset($_POST['salasana']) && isset($_POST['lisatieto'])) {

        $kayttajatunnus = $_POST['kayttajatunnus'];
        $nimi = $_POST['nimi'];
        $salasana = $_POST['salasana'];
        $lisatieto = $_POST['lisatieto'];

        require_once("db.inc");

        //$db = new DB_CONNECT();

        $result = mysqli_query($conn, "INSERT INTO user(kayttajatunnus, nimi, salasana, lisatieto) VALUES('$kayttajatunnus', '$nimi', '$salasana', '$lisatieto')");

        if ($result) {

            $response["success"] = 1;
            $response["message"] = "Käyttäjä luotu";

            echo json_encode($response);

            myLog("######### '". date('d-M-Y H:i:s'). "'Log start##########'");
            myLog("Uusi käyttäjä luotu");
            myLog("#########End log##########\n");

        }
        else {

            $response["success"] = 0;
            $response["message"] = "Käyttäjän luonti epäonnistui";

            echo json_encode($response);

            myLog("######### '". date('d-M-Y H:i:s'). "'Log start##########'");
            myLog("Käyttäjän luonti epäonnistui");
            myLog("#########End log##########\n");

        }

    }
    else {

        $response["success"] = 0;
        $response["message"] = "Vaadittu kenttä puuttuu";
    }

    function myLog($msg) {

        $logfile = 'log/log_' . date('d-M-Y') . '.log';

        file_put_contents($logfile, $msg . "\n", FILE_APPEND);
    }
?>