<?php
	
	require_once("db.inc");
	
	$response = array();
	
	if (isset($_POST['kayttajatunnus']) && isset($_POST['salasana'])) {
		
		$result = '';
		
		$kayttajatunnus = $_POST['kayttajatunnus'];
		$salasana = $_POST['salasana'];
		
		$sql = "SELECT * FROM user kayttajatunnus = :kayttajatunnus AND salasana = :salasana";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':kayttajatunnus', $kayttajatunnus, PDO::PARAM_STR);
		$stmt->bindParam(':salasana', $salasana, PDO::PARAM_STR);
		$stmt->execute();
		$stmt->store_result;
		
		if($stmt->rowCount()) {
			
			$result = "true";
			$stmt->bind_result($ID, $kayttajatunnus, $nimi, $lisatieto);
			$stmt->fetch();
			
			$user = array(
			'ID'=>$ID,
			'kayttajatunnus'=>$kayttajatunnus,
			'nimi'=>$nimi,
			'lisatieto'=>$lisatieto);
			
			$response['success'] = 1;
			$response['message'] = "Kirjautuminen onnistui";
		}
		elseif(!$stmt->rowCount()) {
			
			$result = "false";
			$response['success'] = 0;
			$response['message'] = "V��r� k�ytt�j�tunnus tai salasana";
		}
		
		echo $result;
	}
?>