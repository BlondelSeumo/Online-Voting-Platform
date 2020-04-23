<?php

 // connect to the database
 require_once(__DIR__ .'/../../../core/frontinit.php');
 
 //Start new User object
$user = new User();

 // check if the 'serial' variable is set in URL, and check that it is valid
 if (!empty($_POST['id']))
 {
	 // get id value
	 $id = $_POST['id'];
	 
	 
	 // delete the entry
	$query = DB::getInstance()->delete('vote', ["AND" => ["userid" => $user->data()->userid, "websiteid" => $id]]);
	 
	 
	 if ($query) {
		 echo 1;
	 } else {
		 echo 0;
	 }		 
	
 }
 
?>