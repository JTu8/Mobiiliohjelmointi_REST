<?php

    $response = array();

    require_once("db.inc");

    $result = mysqli_query($conn, "SELECT * FROM workgroup") or die(mysqli_error($result));

    if (mysqli_num_rows($result) > 0) {

        $response["workgroup"] = array();
        
        while($row = mysqli_fetch_array($result)) {

            $workgroup = array();
            $workgroup["ID"] = $row["ID"];
            $workgroup["workgroup_name"] = $row["workgroup_name"];

            array_push($response["workgroup"], $workgroup);


        }

        $response["success"] = 1;

        echo json_encode($response);
    }
    else {

        $response["success"] = 0;
        $response["message"] = "Suoriteryhmiä ei löytynyt";
    }

    
    
?>