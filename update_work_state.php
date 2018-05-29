<?php
	
	$response = array();

	if (isset($_POST['tyo_ID'])) {

		$tyo_ID = $_POST['tyo_ID'];
		$tila = "ALOITETTU";

		require_once("db.inc");

		$result = mysqli_query($conn, "UPDATE works set tila = '$tila' WHERE tyo_ID = '$tyo_ID'");

		if ($result) {

			$response["success"] = 1;
			$response["message"] = "Tila vaihdettu";

			echo json_encode($response);
		}
		else {

			$response["success"] = 0;
			$response["message"] = "Failure";

			echo json_encode($response);
		}
	}
	else {

		$response["success"] = 0;
		$response["message"] = "Required fields missing";

		echo json_encode($response);
	}
	
	function myLog($msg) {

        $logfile = 'log/log_' . date('d-M-Y') . '.log';

        file_put_contents($logfile, $msg . "\n", FILE_APPEND);
    }
?>