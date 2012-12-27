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
?>