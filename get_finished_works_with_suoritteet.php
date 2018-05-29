<?php

    $response = array();

    require_once("db.inc");

    if(isset($_GET['kayttajatunnus'])) {

        $kayttajatunnus = $_GET['kayttajatunnus'];

        $result = mysqli_query($conn, "") or die(mysqli_error($result));

        if(mysqli_num_rows($result) > 0) {

            $response["works"] = array();

            while($row = mysqli_fetch_array($result)) {

                $work = array();
                $work = $row["ID"];
                $work["tyo_ID"] = $row["tyo_ID"];
                $work["kuvaus"] = $row["kuvaus"];
                $work["pvm"] = $row["pvm"];
                $work["tila"] = $row["tila"];
                $work["kayttajatunnus"] = $row["kayttajatunnus"];
				$work["selitys"] = $row["selitys"];
                $work["tunnit"] = $row["tunnit"];
                $work["suorite"] = $row["suorite"];
                $work["yksikko"] = $row["yksikko"];
                $work["maara"] = $row["maara"];

                array_push($response["works"], $work);


                
            }

            $response["success"] = 1;

            echo json_encode($response);

            myLog("######### '". date('d-M-Y H:i:s'). "'Log start##########'");
            myLog("Valmiita töitä haettu");
            myLog("#########End log##########\n");
        }
        else {

            $response["success"] = 0;
            $response["message"] = "Töitä ei löytynyt";

            myLog("######### '". date('d-M-Y H:i:s'). "'Log start##########'");
            myLog("Töiden haku epäonnistui");
            myLog("#########End log##########\n");
        }
            
        
    }

    function myLog($msg) {

        $logfile = 'log/log_' . date('d-M-Y') . '.log';

        file_put_contents($logfile, $msg . "\n", FILE_APPEND);
    }
?>