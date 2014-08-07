<?php
	// this file currently does not work, goes with an commented out section in sidebar/index.php.
	require_once('SQLConnect.php');
	require_once('stackID.php');
	$url = $_GET['URL'];
	//$query = "DELETE FROM resource WHERE url='$url'";
	//UPDATE resource SET removed = 1 WHERE url = "http://en.wikipedia.org/wiki/Xu_Caihou"
	$query = "UPDATE resource SET removed = 1 WHERE url ='$url' AND stackid = '$stackid' AND userid = '$userid'";
	mysqli_query($cxn, $query);
	//This file definitely deletes
