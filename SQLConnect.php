<?php
	//configuration for the database.
	//if you are hosting this yourself, please modify as needed.
	//log in files are removed for privacy reasons, but is where the session variable is retrieved from.
	session_start();
	if(isset($_SESSION["myusername"])){
		$username = $_SESSION["myusername"];
	}

	$host = "";
	$user = "";
	$pass = "";
	$db = "";
	$port = "";

	$cxn = mysqli_connect($host, $user, $pass, $db, $port) or die(err("Could not connect to database"));

	if(isset($_SESSION["myusername"])){
		$query = "SELECT userid FROM plugin_users WHERE username = '$username'";
		$qFetchCurrent = mysqli_query ($cxn, $query);
		$lFetchCurrent = mysqli_fetch_array($qFetchCurrent, MYSQL_ASSOC);
		$userid = $lFetchCurrent['userid'];
	}
?>