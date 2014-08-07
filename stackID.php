<?php
	// fetches newest stack created -> one with highest ID
	require_once('SQLConnect.php');
	$qFetchID = mysqli_query($cxn,"SELECT id FROM stack WHERE userid = $userid ORDER BY id DESC LIMIT 1");
	$lFetchID = mysqli_fetch_array($qFetchID, MYSQL_ASSOC);
	$stackid = $lFetchID['id'];
?>	