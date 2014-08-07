<?php 
	require_once('../getCurrent.php');
	require_once('../stackID.php');
?>
<html>
<head>
	<meta charset="utf-8">
  	<meta name="author" content="Changling Huang">
  	<title>IRIS</title>
  	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="jquery.min.js"></script>
</head>
<body>
<!-- handles the current page the user is on-->
<div id = "current">
<!-- Displays the status of the page:
		What page you are currently on.
		Whether this page can be analysed by IRIS -->	
<div id = "status">
	<p align = "right"><strong><?php echo $username;?>  </strong><a href="http://iris.comminfo.rutgers.edu/firefox-extension/sidebar/logout.php">[Logout]</a></p>
<strong>Currently on: </strong> <?php echo $title;?><br>
</div>
<!--Buttons for single page operations-->
<button class="module" id = "clearCurr">-</button>
<button class="module" id ="extractm">Extract</button>
<button class="module" id = "filterm">Filter</button>
<button class="module" id = "filterextractm">Filter & Extract</button>
<button class="module" id = "summarisem">Summarise</button>
<button class="module" id = "searchclusterm">Cluster Search</button>
</div>


<!-- forms for each of the functions -->

<!--EXTRACTION -->
<form id = "extract" class = "requestForm">
<input name="requestType" value="extract" class = "hide">
<!--Number of Words:<br><input type="number" name="numWords" min="1"><br>-->
<input type="submit" name = "submit" value="Extract this page!" class = "curr_submit">
</form>
<!--END EXTRACTION-->
<!--FILTER-->
<form id = "filter" class = "requestForm">
<input name="requestType" value="filter" class = "hide">
List of words to be excluded:
<textarea name ="wordList">a able about above abst accordance according accordingly across act actually added adj affected affecting affects after afterwards again against ah all almost alone along already also although always am among amongst an and announce another any anybody anyhow anymore anyone anything anyway anyways anywhere apparently approximately are aren arent arise around as aside ask asking at auth available away awfully b back be became because become becomes becoming been before beforehand begin beginning beginnings begins behind being believe below beside besides between beyond biol both brief briefly but by c ca came can cannot can't cause causes certain certainly co com come comes contain containing contains could couldnt d date did didn't different do does doesn't doing done don't down downwards due during e each ed edu effect eg eight eighty either else elsewhere end ending enough especially et et-al etc even ever every everybody everyone everything everywhere ex except f far few ff fifth first five fix followed following follows for former formerly forth found four from further furthermore g gave get gets getting give given gives giving go goes gone got gotten h had happens hardly has hasn't have haven't having he hed hence her here hereafter hereby herein heres hereupon hers herself hes hi hid him himself his hither home how howbeit however hundred i id ie if i'll im immediate immediately importance important in inc indeed index information instead into invention inward is isn't it itd it'll its itself i've j just k keep	keeps kept kg km know known knows l largely last lately later latter latterly least less lest let lets like liked likely line little 'll look looking looks ltd m made mainly make makes many may maybe me mean means meantime meanwhile merely mg might million miss ml more moreover most mostly mr mrs much mug must my myself n na name namely nay nd near nearly necessarily necessary need needs neither never nevertheless new next nine ninety no nobody non none nonetheless noone nor normally nos not noted nothing now nowhere o obtain obtained obviously of off often oh ok okay old omitted on once one ones only onto or ord other others otherwise ought our ours ourselves out outside over overall owing own p page pages part particular particularly past per perhaps placed please plus poorly possible possibly potentially pp predominantly present previously primarily probably promptly proud provides put q que quickly quite qv r ran rather rd re readily really recent recently ref refs regarding regardless regards related relatively research respectively resulted resulting results right run s said same saw say saying says sec section see seeing seem seemed seeming seems seen self selves sent seven several shall she shed she'll shes should shouldn't show showed shown showns shows significant significantly similar similarly since six slightly so some somebody somehow someone somethan something sometime sometimes somewhat somewhere soon sorry specifically specified specify specifying still stop strongly sub substantially successfully such sufficiently suggest sup sure the to nbsp 10 160 that you which what your this stuff was two will with ways we than</textarea> 
<!--Number of Words:<br><input type="number" name="numWords" min="1"><br>-->
	<input type="submit" name = "submit" value="Filter this page!" class = "curr_submit">
</form>
<!--END FILTER-->
<!--FILTER+EXTRACT-->
<form id = "filterextract" class = "requestForm">
<input name="requestType" value="filterextract" class = "hide">
List of words to be excluded:
<textarea name ="wordList">a able about above abst accordance according accordingly across act actually added adj affected affecting affects after afterwards again against ah all almost alone along already also although always am among amongst an and announce another any anybody anyhow anymore anyone anything anyway anyways anywhere apparently approximately are aren arent arise around as aside ask asking at auth available away awfully b back be became because become becomes becoming been before beforehand begin beginning beginnings begins behind being believe below beside besides between beyond biol both brief briefly but by c ca came can cannot can't cause causes certain certainly co com come comes contain containing contains could couldnt d date did didn't different do does doesn't doing done don't down downwards due during e each ed edu effect eg eight eighty either else elsewhere end ending enough especially et et-al etc even ever every everybody everyone everything everywhere ex except f far few ff fifth first five fix followed following follows for former formerly forth found four from further furthermore g gave get gets getting give given gives giving go goes gone got gotten h had happens hardly has hasn't have haven't having he hed hence her here hereafter hereby herein heres hereupon hers herself hes hi hid him himself his hither home how howbeit however hundred i id ie if i'll im immediate immediately importance important in inc indeed index information instead into invention inward is isn't it itd it'll its itself i've j just k keep	keeps kept kg km know known knows l largely last lately later latter latterly least less lest let lets like liked likely line little 'll look looking looks ltd m made mainly make makes many may maybe me mean means meantime meanwhile merely mg might million miss ml more moreover most mostly mr mrs much mug must my myself n na name namely nay nd near nearly necessarily necessary need needs neither never nevertheless new next nine ninety no nobody non none nonetheless noone nor normally nos not noted nothing now nowhere o obtain obtained obviously of off often oh ok okay old omitted on once one ones only onto or ord other others otherwise ought our ours ourselves out outside over overall owing own p page pages part particular particularly past per perhaps placed please plus poorly possible possibly potentially pp predominantly present previously primarily probably promptly proud provides put q que quickly quite qv r ran rather rd re readily really recent recently ref refs regarding regardless regards related relatively research respectively resulted resulting results right run s said same saw say saying says sec section see seeing seem seemed seeming seems seen self selves sent seven several shall she shed she'll shes should shouldn't show showed shown showns shows significant significantly similar similarly since six slightly so some somebody somehow someone somethan something sometime sometimes somewhat somewhere soon sorry specifically specified specify specifying still stop strongly sub substantially successfully such sufficiently suggest sup sure the to nbsp 10 160 that you which what your this stuff was two will with ways we than</textarea> 
<!--Number of Words:<br><input type="number" name="numWords" min="1"><br>-->
<input type="submit" name = "submit" value="Filter and Extract!" class = "curr_submit">
</form>
<!--END FILTER-->
<!--SUMMARISE-->
<form id = "summarise" class = "requestForm">
<!--<p>Words to be excluded from summariseion:</p>-->
<input name="requestType" value="summarize_sentences" class = "hide">
<textarea name ="wordList" class = "hide"><?php echo $lastSearch?></textarea>
Number of sentences <input name= "numSentences">
<input type="submit" name = "submit" value="Summarise this page!" class = "curr_submit">
</form>
<!--Cluster Search-->
<form id = "searchcluster" class = "requestForm">
Number of clusters <input name= "numClusters">
<input name="requestType" value="searchcluster" class = "hide">
<input type="submit" name = "submit" value="Cluster This Search!" class = "curr_submit">
</form>
<!-- Area for displaying output of current page -->
<div id = "curr_output"><strong>Result:</strong> <textarea class="outputarea">
<?php

	echo html_entity_decode(file_get_contents("../responses/reply.txt"));
?></textarea><p align="right" onClick = "openInPopUp()">[<em>View More</em>]</p> 
</div>
<!-- End of analysis on individual page-->

<hr>
<div id = "showdiv"> <button id = "show">+</button> <strong>View Saved Stack</strong> </div>
<!--handles the current stack the user has saved-->
<div id = "stack">
	<button id = "hide"> - </button><button id = "analyze">Analyze</button><button id = "clearStack" onclick="clearRes()">New Stack</button> 
	<br><br>
	<div id = "resource">
		<?php
			$query = "SELECT url FROM resource WHERE removed = 0 AND stackid=".strval($stackid);
			$qFetchCurrent = mysqli_query($cxn, $query);
			while($row = mysqli_fetch_assoc($qFetchCurrent))
			{
			  	echo $row['url'].'<br>';
				//echo "<form class = 'remove' onSubmit='return false';><input name = 'URL' value = '".$row['url']."' class = 'hide'><input type = 'submit' value = 'x'></form> ".$row['url']."<br>";
				//echo "<form class = 'remove'><input name = 'URL' value = '".$row['url']."' class = 'hide'><input type = 'submit' value = 'x' id = 'submit'></form>".$row['url']."<br>";
				//echo "<p class='stackitem'>".$row['url']."</p>";

			}
		?>
	</div>
	<div id = "analyse">
	<br>
	<button class="module" id = "clusterm">Cluster</button>
	<button class="module" id = "limitm">Limit</button>
	<button class="module" id = "rankm">Rank</button>
	<button class="module" id = "ranklimitm">Rank & Limit</button>
	<br>
	<!--CLUSTER-->
	<form id = "cluster" class = "requestForm">
	<input name="requestType" value="cluster" class = "hide"><br>
	Number of clusters <input name= "numClusters">
	<input type="submit" name = "submit" value="Cluster this stack!" class = "stack_submit">
	</form>
	<!--END LIMIT-->
	<!--LIMIT-->
	<form id = "limit" class = "requestForm">
	<input name="requestType" value="limit" class = "hide"><br>
	Limit number of resources to <input name= "amount">
	<input type="submit" name = "submit" value="Limit my resources!" class = "stack_submit">
	</form>
	<!--END LIMIT-->
	<!--RANK-->
	<form id = "rank" class = "requestForm">
	<input name="requestType" value="vector_rank" class = "hide"><br>
	Priority WordList:
	<textarea name ="wordList"></textarea>
	<!--Number of Words:<br><input type="number" name="numWords" min="1"><br>-->
	<input type="submit" name = "submit" value="Rank these pages!"class = "stack_submit">
	</form>
	<!--RankEnd-->
	<!--RankLimit-->
	<form id = "ranklimit" class = "requestForm">
	<input name="requestType" value="ranklimit" class = "hide"><br>
	Priority WordList:
	<textarea name ="wordList"></textarea>
	Limit number of resources to <input name= "amount">
	<!--Number of Words:<br><input type="number" name="numWords" min="1"><br>-->
	<input type="submit" name = "submit" value="Rank and Limit!" class = "stack_submit">
	</form>
	<!--RankLimitEnd-->
	<div id = "stack_output"><strong>Result:</strong><textarea class = "outputarea">
<?php
	//require_once('../responses/analyse.php');
	echo html_entity_decode(file_get_contents("../responses/reply.txt"));
?></textarea>
<p align="right" onClick = "openInPopUp()">[<em>View More</em>]</p> 
	</div>


	</div>
</div>
<!--begin javascript-->
<script>

	//for user-removal of resources
	$(".remove").submit(function(e) {
	    var url = "../delRes.php"; // the script where you handle the form input.
	    $.ajax({
	           type: "GET",
	           url: url,
	           data: $(this).serialize(), // serializes the form's elements.
	           success: function(data)
	           {
	               $('#resource').load("index.php #resource");
	           }
             });
        e.preventDefault();
	});
	/*
	$(".stackitem").click(function(){
		var url = "../delRes.php";
		var item = this.innerHTML;
	    $.ajax({
	           type: "GET",
	           url: url,
	           data: {
    					URL : item// will be accessible in $_POST['data1']
 					},
	           success: function(data)
	           {
	               $('#resource').load("index.php #resource");
	           }
	    });
	});
	*/
	
	
	//set hidden elements
	$('.requestForm').hide();
	document.getElementById("analyse").style.display="none";
	document.getElementById("stack").style.display="none";
	document.getElementById('curr_output').style.display="none";
	document.getElementById('stack_output').style.display="none";
	
	//opens up analysis for stacks
	$('#analyze').click(function(){
		$('#analyse').toggle();
	});

	//show and hide stacks
	$('#show').click(function(){
		$('#showdiv').fadeOut('slow');
		$('#stack').fadeIn();
	});
	$('#hide').click(function(){
		$('#stack').fadeOut('slow');
		$('#showdiv').fadeIn();
	});
	//Add your button for a new module here
	$('.module').click(function(){
		$('.requestForm').fadeOut();
		if(this.id=="extractm"){
			$('#extract').toggle();
		}else if (this.id=="filterm"){
			$('#filter').toggle();
		}else if (this.id=="filterextractm"){
			$('#filterextract').toggle();
		}else if (this.id=="summarisem"){
			$('#summarise').toggle();
		}else if (this.id=="searchclusterm"){
			$('#searchcluster').toggle();
		}else if (this.id=="clusterm"){
			$('#cluster').toggle();
		}else if (this.id=="limitm"){
			$('#limit').toggle();
		}else if (this.id=="rankm"){
			$('#rank').toggle();
		}else if (this.id=="ranklimitm"){
			$('#ranklimit').toggle();
		}
	});

	//clear results of current page
	$('#clearCurr').click(function(){
		$('.requestForm').fadeOut();
		$('#curr_output').fadeOut();
	});
	
	//when resources are cleared, resources are refreshed to reflect.
	function clearRes(){
        $.post("../clearRes.php", function(data){});
        $('#resource').load("index.php #resource"); 
	}
	function openInPopUp(){
 		window.open("../responses/reply.txt", "IRIS", "toolbar=no, scrollbars=yes, resizable=yes, top=500, left=500, width=400, height=400");
 	} 

 	//refreshing the display of current resource and current stack. This does not reflect a lag in backend.
	setInterval(function(){
       $('#resource').load("index.php #resource"); 
       $('#status').load("index.php #status");
	},3000);
	
	//Add your request form for functions to the list here,

	$(".requestForm").submit(function() {
		var button =  this.elements.namedItem("submit");
		var temp = 	button.value;
		button.value = "Loading...";
	   	$(button).attr('disabled', 'disabled');

		if (this.id=="extract"||this.id=="filter"||this.id=="filterextract"||this.id=="summarise"||this.id=="searchcluster"){
			var url = "../responses/curr_analyse.php"; // the script where you handle the form input.
			$.ajax({
	           type: "POST",
	           url: url,
	           data: $(this).serialize(), // serializes the form's elements.
	           success: function(data)
	           {	           	
	    			$(button).removeAttr("disabled");
	               $('#curr_output').load("index.php #curr_output");
	               $('#curr_output').fadeIn();
	               button.value = temp;
	           }
	    	});
	    	$('#curr_output').fadeOut();
	    	
		}else{
			var url = "../responses/analyse.php"; // the script where you handle the form input.	
			$.ajax({
	           type: "POST",
	           url: url,
	           data: $(this).serialize(), // serializes the form's elements.
	           success: function(data)
	           {
	           		$(button).removeAttr("disabled");
	               $('#stack_output').load("index.php #stack_output");
	               $('#stack_output').fadeIn();
	               button.value = temp;
	           }
	     	});
	     	$('#stack_output').fadeOut();
		}
	    return false; // avoid to execute the actual submit of the form.
	});
</script>
</body>
</html>