<?php

    $response = array();

    if (isset($_POST['suoriteryhma']) && isset($_POST['maara'])) {

        $suoriteryhma = $_POST['suoriteryhma'];
        $maara = $_POST['maara'];

        require_once("db.inc");

        $result = mysqli_query($conn, "UPDATE workstatus SET maara = '$maara' WHERE suoriteryhma = '$suoriteryhma'");

        if ($result) {

            $response["success"] = 1;
            $response["message"] = "Määrä päivitetty";

            echo json_encode($response);
        }
        else {

            $response["success"] = 0;
            $response["message"] = "Määrän päivitys epäonnistui";

            echo json_encode($response);
        }


    }
    else {

        $response["success"] = 0;
        $response["message"] = "Vaadittavat kentät puuttuvat";

        echo json_encode($response);

    }
?>