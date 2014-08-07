<?php
	// get url, title and query of current page.
	require_once ('SQLConnect.php');
	$query = "SELECT * FROM history WHERE userid = '$userid' ORDER BY id DESC LIMIT 1";
	$qFetchCurrent = mysqli_query ($cxn, $query);
	$lFetchCurrent = mysqli_fetch_array($qFetchCurrent, MYSQL_ASSOC);
	$title = $lFetchCurrent['title'];
	$url = $lFetchCurrent['url'];
	$search = $lFetchCurrent['search'];
?>