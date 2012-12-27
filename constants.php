<?php

define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASS", "password");
define("DB_NAME", "why_wont_my_moped_run");

$connection = mysql_connect(DB_SERVER, DB_USER, DB_PASS);
if(!$connection) {
	die("Database connection failed: " . mysql_error());}

function dbCall($query){
	global $connection;
	$result = mysql_query($query,$connection);
	if (!$result) {
		$message  = 'Invalid query: ' . mysql_error() . "\n";
		$message .= 'Whole query: ' . $query;
		die($message);
	}
	else return $result;
}

//SELECT A DATABASE TO USE

$db_select = mysql_select_db(DB_NAME, $connection);
if (!$db_select) {
	die("Database selection failed: " . mysql_error()); }

?>