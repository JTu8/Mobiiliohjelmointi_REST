<?php
	// tietokannan nimi
	define("DB_NAME", "finalproject");
	define("DB_USER", "root");
	define("DB_PASSWD", "");
	define("DB_HOST", "localhost");

	// tehd��n connect tietokantapalvelimelle
	$conn = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWD, DB_NAME); 
	
	if ( mysqli_connect_errno() )
	{
		// Lopettaa t�m�n skriptin suorituksen ja tulostaa parametrina tulleen tekstin
		die ("Tietokantapalvelinta ei l�ydy, syy: " . mysqli_connect_error());
	}

	// valitaan tietokanta -> Ei v�ltt�m�t�nt�, jos kanta annettu mysqli_connect:ssa
	//mysqli_select_db($conn, DB_NAME) or die ("Tietokantaan " . DB_NAME . " ei saada yhteytt�");
?>