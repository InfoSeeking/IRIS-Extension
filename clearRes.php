<?php
/* For clearRes, the idea is that when the user clicks on it, a new stack is made and now 
"addRes automatically adds to that stack instead of original."
*/

	require_once('SQLConnect.php');
	$query = "INSERT INTO stack (userid) VALUES($userid)";
	mysqli_query($cxn, $query);
