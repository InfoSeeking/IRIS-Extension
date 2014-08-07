<?php
	//handles the current page analysis functions.
	require_once('../getCurrent.php');
	$endpoint = "http://iris.comminfo.rutgers.edu/index.php";
	$ctrlr = $_POST['requestType'];
	$response ="";
	if (strcasecmp($ctrlr, "searchcluster") == 0){
		$numClusters = $_POST['numClusters'];
		if ($numClusters==""){
			$numClusters="3";
		}
		$queryString = urlencode($search); 
		$cmd = "curl -e http://iris.comminfo.rutgers.edu/ " . "'https://ajax.googleapis.com/ajax/services/feed/find?v=1.0&q=".$queryString."&num=10'";
		$data=shell_exec($cmd);
		/*
		$filename_content = "Google_SERP_user_stage_page.json";
		$fileHandle_content = fopen($filename_content, 'w') or die("file could not be accessed/created");
		fwrite($fileHandle_content, $data);	
		fclose($fileHandle_content);
		*/
		$decodedJson = json_decode($data); //$data or $fileHandle_content?, think of as object, not array
		//print_r($decodedJson);
		$searchResults = $decodedJson->{"responseData"}->{"entries"};  
		$id = 1;
		$request = "xmldata=<parameters><requestType>cluster</requestType><numClusters>".$numClusters."</numClusters><resourceList>";
		foreach ($searchResults as $GSearchResultClass) {	
			//$html = @file_get_contents($GSearchResultClass->link);
			//if(!$html){
			$request .= "<resource><id>" . $id . "</id><url>" . htmlentities($GSearchResultClass->link) . "</url></resource>";
			$id++; 
			//}	 
		}
		$request .= "</resourceList></parameters>";
		$cmd = 'curl --data "'.$request.'" '.$endpoint;
		$output = shell_exec($cmd);
		$xml = new SimpleXMLElement($output);
		if(property_exists($xml, "error")){
			$response = "This page cannot be analysed by IRIS";
		}else{
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
	}else{
		$wordList = $_POST['wordList'];
		if ($wordList){
			$wordList = "<wordList>".$wordList."</wordList>";
		}
		//$maxWords = (int) $numWords;
		$request = "";
		if (strcasecmp($ctrlr, "extract") == 0) {
	    	$request= "xmldata=<parameters><requestType>extract</requestType><clientID>1</clientID><resourceList><resource><id>1</id><url>".$url. "</url></resource></resourceList></parameters>";
		}else if (strcasecmp($ctrlr, "filter") == 0){
			$request= "xmldata=<parameters><requestType>filter</requestType>".urlencode($wordList)."<clientID>1</clientID><resourceList><resource><id>1</id><url>".$url. "</url></resource></resourceList></parameters>";
		}else if (strcasecmp($ctrlr, "filterextract")==0) {
			$request = "xmldata=<parameters><clientID>1</clientID><requestType>pipe</requestType><command><parameters><requestType>filter</requestType>".urlencode($wordList)."<resourceList><resource><id>1</id><url>".$url."</url></resource></resourceList></parameters></command><command><parameters><requestType>extract</requestType></parameters></command></parameters>";
		}else if (strcasecmp($ctrlr, "summarize_sentences")==0){
			$numSentences = $_POST['numSentences'];
			if ($numSentences==""){
				$numSentences="5";
			}
			$request= "xmldata=<parameters><requestType>summarize_sentences</requestType>".$wordList."<numSentences>".$numSentences."</numSentences><clientID>1</clientID><resourceList><resource><id>1</id><url>".$url."</url></resource></resourceList></parameters>";
		}
		$cmd = 'curl --data "'.$request.'" '.$endpoint;
		$output = shell_exec($cmd);
		//echo $output;
		
		$xml = new SimpleXMLElement($output);
		if(property_exists($xml, "error")){
			$response = "This page cannot be analysed by IRIS";
		}else if (strcasecmp($ctrlr, "extract") == 0 || strcasecmp($ctrlr, "filterextract") == 0) {  	
			$string = $xml->resourceList->resource->content;
			//$numwords parameter can later be changed to number that user specifies
			$numwords = 10;
			$i = 0;
			$words = preg_split('/[\s]+/', $string, -1, PREG_SPLIT_NO_EMPTY);
			while($i<$numwords){
				$response.= $words[$i]." ";
				$i++;
			}
		}else if (strcasecmp($ctrlr, "filter") == 0 || strcasecmp($ctrlr, "summarize_sentences")==0){
			$string = $xml->resourceList->resource->content;
			$response = $string;
		}
	}
	echo $response;
	$fileHandle_reply = fopen("reply.txt", 'w') or die("file could not be accessed/created");
	fwrite($fileHandle_reply, htmlspecialchars($response));
	fclose($fileHandle_reply);
?>