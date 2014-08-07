<?php

	//saves each URL visited into the database
	
	$url = htmlentities($_GET['URL']);
	$title = $_GET['title'];
	$blank = "about:blank";
	$popout = "http://iris.comminfo.rutgers.edu/firefox-extension/responses/reply.txt";

	//check if pop-up page, if it is, do not record data.
	if (strcasecmp($blank, $url)!=0 && strcasecmp($popout, $url)!=0){
		require_once('SQLConnect.php');
		require_once('utilityFunctions.php');

		$search = extractQuery($url);

		$query = "SELECT url FROM history WHERE userid = '$userid' ORDER BY  id DESC LIMIT 1";
		$qFetchCurrent = mysqli_query ($cxn, $query);
		$lFetchCurrent = mysqli_fetch_array($qFetchCurrent, MYSQL_ASSOC);
		$lastURL = $lFetchCurrent['url'];
		// if it is a repeat, do not record the data
		if (strcasecmp($lastURL, $url)!=0){
			$localDate = $_GET['localDate'];
			$localTime = $_GET['localTime'];
			$visittime = $localDate.' '.$localTime;
			
			$query = "INSERT INTO history (title, url, visittime, userid, search) 
						VALUES('$title', '$url', '$visittime','$userid', '$search')";

			mysqli_query($cxn, $query);
		}

	}

	

?>