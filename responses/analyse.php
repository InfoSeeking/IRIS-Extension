<?php
	//handles analysis for stacks
	//sets endpoint for API call.
	$endpoint = "http://iris.comminfo.rutgers.edu/index.php";
	$res="";
	//get resource list in XML format
	//counter for id to distribute unique id.
	$idnum=1;
	require_once('../SQLConnect.php');
	require_once('../stackID.php');
	$query = "SELECT url FROM resource WHERE removed = 0 AND stackid=".strval($stackid);
	$qFetchCurrent = mysqli_query($cxn, $query);
	while($row = mysqli_fetch_assoc($qFetchCurrent))
	{
		$res.= "<resource><id>".$idnum."</id><url>";
		$idnum+=1;
		$res.=urlencode($row['url']);
	 	$res.="</url></resource>";
	}
	$ctrlr = $_POST['requestType'];
	//echo htmlentities($wordList);
	$request = "";
 	if (strcasecmp($ctrlr, "cluster")==0){
		$numClusters = $_POST['numClusters'];
		if ($numClusters==""){
			$numClusters="3";
		}
		$request= "xmldata=<parameters><requestType>cluster</requestType><numClusters>".$numClusters."</numClusters><clientID>1</clientID><resourceList>".$res."</resourceList></parameters>";
	}else if (strcasecmp($ctrlr, "limit")==0){
		$amount = $_POST['amount'];
		$request= "xmldata=<parameters><requestType>limit</requestType><amount>".$amount."</amount><clientID>1</clientID><resourceList>".$res."</resourceList></parameters>";
	}else if (strcasecmp($ctrlr, "vector_rank")==0){
		$wordList = $_POST['wordList'];
		if(!strcasecmp($wordList, "")==0){
			$wordList = "<wordList>".urlencode($wordList)."</wordList>";
		}
		$request= "xmldata=<parameters><requestType>vector_rank</requestType>".$wordList."<clientID>1</clientID><resourceList>".$res."</resourceList></parameters>";
	}else if (strcasecmp($ctrlr, "ranklimit")==0){
		$wordList = $_POST['wordList'];
		$amount = $_POST['amount'];
		if(!strcasecmp($wordList, "")==0){
			$wordList = "<wordList>".urlencode($wordList)."</wordList>";
		}
		$request= "xmldata=<parameters><clientID>1</clientID><requestType>pipe</requestType><command><parameters><requestType>vector_rank</requestType>".$wordList."<resourceList>".$res."</resourceList></parameters></command><command><parameters><requestType>limit</requestType><amount>".$amount."</amount></parameters></command></parameters>";
	}
	$cmd = 'curl --data "'.$request.'" '.$endpoint;
	//echo htmlentities($cmd);
	$output = shell_exec($cmd);
	//echo $output;
	//echo htmlspecialchars($output);
	$response="";
	$xml = new SimpleXMLElement($output);
	if(property_exists($xml, "error")){
		$response = $xml->error->message;
	}else if (strcasecmp($ctrlr, "vector_rank")==0 || strcasecmp($ctrlr, "ranklimit")==0 ){
		foreach($xml->resourceList->resource as $resource){
			foreach($resource->id as $id){
				$response .= $id.PHP_EOL;	
			}
		}
	}else if (strcasecmp($ctrlr, "limit")==0){
		foreach($xml->resourceList->resource as $resource){
			foreach($resource->url as $url){
				$response .= $url.PHP_EOL;	
			}
		}
	}else if (strcasecmp($ctrlr, "cluster")==0){
		foreach($xml->clusterList->cluster as $cluster){
			$response.= "Cluster ".$cluster->clusterID.":".PHP_EOL;
			foreach($cluster->resourceList as $resourceList){
				foreach($resourceList->resource as $resource){
					$response .=$resource->id." ".$resource->url.PHP_EOL;
				}
			}
			$response.= PHP_EOL;
		}
	}
	echo $response;
	$fileHandle_reply = fopen("reply.txt", 'w') or die("file could not be accessed/created");
	fwrite($fileHandle_reply, htmlspecialchars($response));
	fclose($fileHandle_reply);
?>