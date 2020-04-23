<?php

//Check if init.php exists
 require_once(__DIR__ .'/../../../core/frontinit.php');
 
 // check if the 'serial' variable is set in URL, and check that it is valid
 if (!empty($_POST['parent']))
 {
	 // get id value
	 $parent = $_POST['parent'];
	 
	$qs = DB::getInstance()->get("position", "*", ["organizationid" => $parent]);
	if ($qs->count()) {
	 foreach($qs->results() as $rs) {
	 	echo '<option value="'. $rs->positionid.'">'. $rs->name.'</option>';
	 }
	}
	
 }
 
?>