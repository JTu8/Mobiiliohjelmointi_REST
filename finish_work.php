<?php

    $response = array();

    if(isset($_POST['tyo_ID']) && isset($_POST['selitys']) && isset($_POST['tunnit'])) {

        $tyo_ID = $_POST['tyo_ID'];
        $selitys = $_POST['selitys'];
        $tunnit = $_POST['tunnit'];
        $tila = "VALMIS";

        require_once("db.inc");

        $result = mysqli_query($conn, "UPDATE works SET selitys = '$selitys', tunnit = '$tunnit',  tila = '$tila' WHERE tyo_ID = '$tyo_ID'") or die(mysqli_error($conn));

        if($result) {

            $response["success"] = 1;
            $response["message"] = "Työn päivittäminen onnistui";

            echo json_encode($response);
        }
        else {

            $response["success"] = 0;
            $response["message"] = "Työn päivitys epäonnistui";

            echo json_encode($response);
        }
    }
    else {

        $response["success"] = 0;
        $response["message"] = "Tarvittavat kentät puuttuvat";

        echo json_encode($response);
    }
?>