<?php
	
	$response = array();
	
	require_once("db.inc");
	
	if (isset($_GET['workgroup_name'])) {
		
		$workgroup_name = $_GET['workgroup_name'];
		
		$result = mysqli_query($conn, "SELECT * FROM workstatus WHERE workgroup_name = '$workgroup_name'") or die(mysqli_error($conn));
		
		if(mysqli_num_rows($result) > 0) {
			
			$response["workstatus"] = array();
            

            while($row = mysqli_fetch_array($result)) {

                $workstatus = array();
                $workstatus["ID"] = $row["ID"];
                $workstatus["suorite"] = $row["suorite"];
                $workstatus["yksikko"] = $row["yksikko"];
                $workstatus["maara"] = $row["maara"];
                $workstatus["workgroup_name"] = $row["workgroup_name"];
                $workstatus["tyo_ID"] = $row["tyo_ID"];
                
                array_push($response["workstatus"], $workstatus);
                
                
            }
			
			$response["success"] = 1;

            echo json_encode($response);

		}
		else {

            $response["success"] = 0;
            $response["message"] = "Suoritteita ei löytynyt";

            echo json_encode($response);

            

            
        }
    }
    else {

        $response["success"] = 0;
        $response["message"] = "Vaadittavat kentät puuttuvat";

        echo json_encode($response);
    }
	
	
?>