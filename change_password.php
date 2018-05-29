<?php

    $response = array();

    if(isset($_POST['kayttajatunnus']) && isset($_POST['salasana'])) {

        $kayttajatunnus = $_POST['kayttajatunnus'];
        $salasana = $_POST['salasana'];

        require_once("db.inc");

        $result = mysqli_query($conn, "UPDATE user SET salasana = '$salasana' WHERE kayttajatunnus = '$kayttajatunnus'");

        if ($result) {

            $response["success"] = 1;
            $response["message"] = "Salasana vaihdettu";

            myLog("######### '". date('d-M-Y H:i:s'). "'Log start##########'");
            myLog("Salasana vaihdettu");
            myLog("#########End log##########\n");

            echo json_encode($response);
        }
        else {

            $response["success"] = 0;
            $response["message"] = "Salasanan vaihto epäonnistui";

            echo json_encode($response);

            myLog("######### '". date('d-M-Y H:i:s'). "'Log start##########'");
            myLog("Salasanan vaihto epäonnistui");
            myLog("#########End log##########\n");
        }
    }
    else {

        $response["success"] = 0;
        $response["message"] = "Tarvittavat kentät puuttuvat";

        echo json_encode($response);

            myLog("######### '". date('d-M-Y H:i:s'). "'Log start##########'");
            myLog("Salasanan vaihto epäonnistui");
            myLog("#########End log##########\n");
    }

    function myLog($msg) {

        $logfile = 'log/log_' . date('d-M-Y') . '.log';

        file_put_contents($logfile, $msg . "\n", FILE_APPEND);
    }
?>