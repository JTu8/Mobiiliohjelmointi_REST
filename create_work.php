<html>
	<head>
		<title>Uuden työn luonti</title>
		<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
	</head>
	<body>
		<div class="w3-container w3-teal">
			<h1>Uuden työn lisäys</h1>
		</div>
		
		<div class="w3-container">
			<form class="w3-container w3-card-4" action="create_work.php" method="post">
				<p>
				<label class="w3-text-blue"><b>Käyttäjätunnus</b></label>
				<input class="w3-input w3-border" name="kayttajatunnus" type="text"></input></p>
				<p>
				<label class="w3-text-blue"><b>Työn ID</b></label>
				<input class="w3-input w3-border" name="tyo_ID" type="text"></input></p>
				<p>
				<label class="w3-text-blue"><b>Kuvaus</b></label>
				<input class="w3-input w3-border" name="kuvaus" type="text"></input></p>
				<p>
				<label class="w3-text-blue"><b>Valmistumispäivämäärä</b></label>
				<input class="w3-input w3-border" name="pvm" type="text"></input></p>
		
				<button class="w3-btn w3-blue" name="lisaa" type="submit">Lisää</button></p>
			</form>
		</div>
	</body>
</html>
<?php

	

    $response = array();
	
	print_r($_POST);
	
	if (isset($_POST['lisaa'])) {

			error_reporting(-1);
			ini_set('display_errors', 'On');
		
			require_once("firebase.php");
			require_once("push.php");
		
			$firebase = new Firebase();
			$push = new Push();
		
			$title = isset($_GET['title']) ? $_GET['title'] : '';
			$message = isset($_GET['message']) ? $_GET['message'] : '';
			$push_type = isset($_GET['push_type']) ? $_GET['push_type'] : '';
			$include_image = isset($_GET['include_image']) ? TRUE : FALSE;
		
			$push->setTitle($title);
			$push->setMessage($message);
		
			if($include_image) {
		
				$push->setImage('');
			}
		
			$push->setIsBackround(FALSE);
			//$push->setPayload($payload);
		
			$json = '';
			$lahetys = '';
		
			if($push_type == 'topic') {
		
				$json = $push->getPush();
				$lahetys = $firebase->sendToTopic('global', $json);
			}
			else if($push_type == 'individual') {
		
				$json = $push->getPush();
				$regID = isset($_GET['regID']) ? $_GET['regID'] : '';
				$lahetys = $firebase->send($regID, $json);
			}
		
			if (isset($_POST['tyo_ID']) && isset($_POST['kuvaus']) && isset($_POST['pvm']) && isset($_POST['kayttajatunnus'])) {

			$tyo_ID = $_POST['tyo_ID'];
			$kuvaus = $_POST['kuvaus'];
			$pvm = $_POST['pvm'];
			$tila = "UUSI";
			$kayttajatunnus = $_POST['kayttajatunnus'];
			
			
			$date = strtotime($pvm);
			$pvm = date('Y-m-d', $date);

			require_once("db.inc");

			//$db = new DB_CONNECT();

			$result = mysqli_query($conn, "INSERT INTO works(tyo_ID, kuvaus, pvm, tila, kayttajatunnus) VALUES('$tyo_ID', '$kuvaus', '$pvm', '$tila', '$kayttajatunnus')") or die(mysqli_error($result)); 

			if ($result) {

				$response["success"] = 1;
				$response["message"] = "Uusi työ lisätty";

				echo json_encode($response);

				myLog("######### '". date('d-M-Y H:i:s'). "'Log start##########'");
				myLog("Uusi työ lisätty");
				myLog("#########End log##########\n");

			}
			else {

				$response["success"] = 0;
				$response["message"] = "Työn lisäys epäonnistui";

				echo json_encode($response);

				myLog("######### '". date('d-M-Y H:i:s'). "'Log start##########'");
				myLog("Työn lisäys epäonnistui");
				myLog("#########End log##########\n");

			}

		}
		else {

			$response["success"] = 0;
			$response["message"] = "Vaadittu kenttä puuttuu";
		}
			
	}
    

    function myLog($msg) {

        $logfile = 'log/log_' . date('d-M-Y') . '.log';

        file_put_contents($logfile, $msg . "\n", FILE_APPEND);
    }
?>