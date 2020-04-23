<?php

 // connect to the database
 require_once(__DIR__ .'/../../../core/frontinit.php');
 
 
 // check if the 'serial' variable is set in URL, and check that it is valid
 if (!empty($_POST['id']))
 {
	 // get id value
	 $id = $_POST['id'];
	 
	 // delete the entry
	$query = DB::getInstance()->delete('language', ["languageid" => $id]);
	 
	 
	 if ($query) {
		 echo 1;
	 } else {
		 echo 0;
	 }		 
	
 }
 
?>