<?php

 // connect to the database
 require_once(__DIR__ .'/../../../core/frontinit.php');
 
 
 // check if the 'serial' variable is set in URL, and check that it is valid
 if (!empty($_POST['id']))
 {
	 // get id value
	 $id = $_POST['id'];
	 
	$qs = DB::getInstance()->get("user", "*", ["userid" => $id, "LIMIT" => 1]);
	if ($qs->count() === 1) {
	 foreach($qs->results() as $rs) {
	 }
	}	 
	
	unlink('source/user/'.$rs->imagelocation);
	 
	 // delete the entry
	$query = DB::getInstance()->delete('user', ["userid" => $id]);
	 
	 if ($Update) {
		 echo 1;
	 } else {
		 echo 0;
	 }		 
	
 }
 
?>