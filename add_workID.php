<?php

    $response = array();

    if(isset($_POST['tyo_ID']) && isset($_POST['suorite'])) {

        $tyo_ID = $_POST['tyo_ID'];
        $suorite = $_POST['suorite'];

        require_once("db.inc");

        $result = mysqli_query($conn, "UPDATE workstatus SET tyo_ID = '$tyo_ID' WHERE suorite = '$suorite'") or die(mysqli_error($result));

        if($result) {

            $response["success"] = 1;
            $response["message"] = "Työn ID lisätty";

            echo json_encode($response);
        }
        else {

            $response["success"] = 0;
            $response["message"] = "Työn ID:n lisäus epäonnistui";

            echo json_encode($response);
        }
    }
    else {

        $response["success"] = 0;
        $response["message"] = "Tarvittavat kentät puuttuvat";

        echo json_encode($response);
    }
?>