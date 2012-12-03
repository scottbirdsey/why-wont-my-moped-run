<?php
// Gather server variables
$REQUEST_URI = $_SERVER['REQUEST_URI'];
$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];
$SCRIPT_FILENAME = $_SERVER['SCRIPT_FILENAME'];

// Check for real addresses - open those if the case
if(file_exists($DOCUMENT_ROOT.$REQUEST_URI)
and ($SCRIPT_FILENAME!=$DOCUMENT_ROOT.$REQUEST_URI)
and ($REQUEST_URI!="/")){
$url=$REQUEST_URI;
include($DOCUMENT_ROOT . $url);
exit();
}

// Deconstruct URL for assignment processing
$url=strip_tags($REQUEST_URI);
$url_array=explode("/",$url);
if (($url_array[0]=="") && ($url_array[1]=="")) { 
	array_shift($url_array);array_shift($url_array);array_shift($url_array);
    }
else array_shift($url_array); 

//Get the DB ready
require('constants.php');
$library = array(); 
$count = 0;
$query = dbCall("SELECT * FROM Answers");

//Set up the Answer class and method
class Answer
{
	public function setProperty($id, $answer, $author, $timestamp)  
    {  
        $this->answer = $answer;
		if (empty($author)) $this->author = 'Anonymous';
		else $this->author = $author;
		$subdate = explode("-", substr($timestamp,0,10)); 
		$timestamp = $subdate[1] . '.' . $subdate[2] . '.' . $subdate[0];
		//$timestamp = str_replace('-', '.', strrev(substr($timestamp, 0, 9))); // returns "d"
        $this->timestamp = $timestamp;  
		$this->url = $id;
    }  
}


//Create the Objects
$count = 1;
while ($row = mysql_fetch_assoc($query)){
	while($count < $row['id']){ $count++; }
	$library[$count] = new Answer;
	$library[$count]->setProperty($row['id'], $row['answer'], $row['author'], $row['date']);
	$count++;
}

//Remember the biggest id for linking submissions upon submittal
$latesturl = $library[$count-1]->url;
$newurl = $latesturl + 1;

//Shuffle the data by default
if (empty($url_array[0])){
	//Shuffle the objects and assign the final Object
	shuffle($library); 
	$answer = $library[0];//word_wrapper($library[0]);
}

//If theres an id given in the URL, check if its legit
else if (!empty($library[$url_array[0]]))
	$answer = $library[$url_array[0]];

//If its not legit, just redirect to default
else header( 'Location: http://whywontmymopedrun.com' ) ;
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Why won't my moped run?</title>
        <meta name="description" content="">
		  <meta name="viewport" content="width=device-width, user-scalable=no">
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <script src="js/vendor/modernizr-2.6.2.min.js"></script>
		<script type="text/javascript" src="//use.typekit.net/atc1gce.js"></script>
		<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
    </head>
    <body>
		<header>
			<hgroup>
				<h1><a href="/"><?php print $answer->answer;?></a></h1>
				<h2>submitted by <strong><?php print $answer->author; ?></strong> on <strong><?php print $answer->timestamp; ?></strong>&nbsp;<a href="/<?php echo $answer->url;?>"><img src="/img/link.png" title="get link for this entry" alt="get link for this entry"></a></h2>
			</hgroup>
		</header>
		
		<aside>
			<h2>Contribute a moped fix.</h2>
			
			<form name='answers' action="submit.php" method="post" onsubmit="xmlhttpPost('submit.php', 'answers', 'success', <?php echo $newurl;?> ); return false;">
				<input type='text' name='answerfield' value required='required' placeholder='The plug has fouled' maxlength='70'/>
				, submitted by  
				<input type='text' id="author" name='authorfield' value required='required' placeholder='Gordon Jennings' maxlength='30'/> .
				<input type="submit" id="submit" name="fixthatmoped" value="There's your problem." />
			</form>
			
			<div id="success"></div>
			
		</aside>
		
		<footer>		  
			<div id="like" class="badge">
				<iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwhywontmymopedrun.com%2F&amp;layout=button_count&amp;show_faces=true&amp;width=450&amp;action=like&amp;font=verdana&amp;colorscheme=light" scrolling="no" frameborder="0" allowTransparency="true">
				</iframe>
			</div>
			
			<div>
				<a href="http://mohawkmammoths.com" title="Mohawk Mammoths are a moped gang from Albany, NY" alt="Mohawk Mammoths are a moped gang from Albany, NY">
					<img src="/img/mammoths.png">
				</a>
			</div>
			<p>Created by <a href="http://twitter.com/scottbirdsey">Scott Birdsey</a></p>
		</footer>
		

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.8.2.min.js"><\/script>')</script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>

    <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
    <script>
        var _gaq=[['_setAccount','UA-35967668-1'],['_trackPageview']];
        (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
        g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
        s.parentNode.insertBefore(g,s)}(document,'script'));
    </script>
	</body>
</html>
