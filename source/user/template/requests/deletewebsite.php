<?php

 // connect to the database
 require_once(__DIR__ .'/../../../core/frontinit.php');
 
 
 // check if the 'serial' variable is set in URL, and check that it is valid
 if (!empty($_POST['id']))
 {
	 // get id value
	 $id = $_POST['id'];
	 
	$qs = DB::getInstance()->get("website", "*", ["paymentid" => $id, "LIMIT" => 1]);
	if ($qs->count() === 1) {
	 foreach($qs->results() as $rs) {
	 }
	}	 
	
	unlink('source/user/'.$rs->imagelocation);
	 
	 // delete the entry
	$query = DB::getInstance()->delete('website', ["paymentid" => $id]);
	$query = DB::getInstance()->delete('payment', ["AND" => ["complete" => 0, "paymentid" => $id]]);
	 
	 
	 if ($query) {
		 echo 1;
	 } else {
		 echo 0;
	 }		 
	
 }
 
?>