<?php 
require('constants.php');

$answer = $_POST['answerfield'];
$author = $_POST['authorfield'];
$answer = strip_tags(ucfirst($answer));
if (!empty($answer)) {
	if (substr($answer, -1) != ('.' or '?' or '!')) $answer .= '.';
	mysql_query("INSERT INTO Answers (answer, author) VALUES ('$answer', '$author')") or die(mysql_error());
	mysql_query("ALTER TABLE Answers ORDER BY id");
}
?>