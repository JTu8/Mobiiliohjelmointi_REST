<?php
    
    $response = array();

    if(isset($_POST['tyo_ID'])) {

        $tyo_ID = $_POST['tyo_ID'];

        require_once("db.inc");

            $image = $_POST['image_path'];

            $result = mysqli_query($conn, "SELECT ID FROM images ORDER BY ID ASC") or die(mysqli_error($result));

            $ID = 0;

            while($row = mysqli_fetch_array($result)) {

                $ID = $row['ID'];
            }

            $path = "upload/$ID.png";

            $mainpath = "http://192.168.183.2/jerephp/Mobiiliohjelmointi/$path";

            $sql = mysqli_query($conn, "INSERT INTO images(image_path, tyo_ID) VALUES('$mainpath', '$tyo_ID')") or die(mysqli_error($sql));

            if($sql) {

                file_put_contents($path, base64_decode($image));

                $response["success"] = 1;
                $response["message"] = "Kuva ladattu tietokantaan";
            }
            else {

                $response["success"] = 0;
                $response["message"] = "Virhe kuvaa ladattaessa";
            }
        
    }
    else {

        $response["success"] = 0;
        $response["message"] = "Tarvittavat kentät puuttuvat";
    }
    
    
?>