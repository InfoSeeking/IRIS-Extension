<?php
	require_once('SQLConnect.php');
	require_once('stackID.php');

	if ($userid==0){
		echo "Please log in before adding resources";
	}else{
		$url = htmlentities($_GET['URL']);
		$html = @file_get_contents($url);
		//check if html recieved
		if(!$html){
			echo "This page cannot be analysed by IRIS.";
		}else{
			$title = $_GET['title'];
			$time_added = date('Y-m-d h:i:s');
			$query = "INSERT INTO resource (title, url, stackid, userid, removed, time_added) 
						VALUES('$title','$url', '$stackid', $userid , 0, '$time_added')";
			mysqli_query($cxn, $query);
			echo "Resource added";
		}


		
	}
	

