<?php 
	require('url_processing.php');
	require('answer_processing.php');
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
