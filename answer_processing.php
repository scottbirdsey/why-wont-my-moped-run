<?php
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
	$answer = $library[0];
}

//If theres an id given in the URL, check if its legit
else if (!empty($library[$url_array[0]]))
	$answer = $library[$url_array[0]];

//If its not legit, just redirect to default
else header( 'Location: http://whywontmymopedrun.com' ) ;
?>