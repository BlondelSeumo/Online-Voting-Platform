<?php

//Check if init.php exists
 require_once(__DIR__ .'/../../../core/frontinit.php');
 
 // check if the 'serial' variable is set in URL, and check that it is valid
 if (!empty($_POST['id']) && !empty($_POST['state']))
 {
	 // get id value
	 $id = $_POST['id'];
	 $state = $_POST['state'];
	 
	 $actions = getActions($id, $state);
	 echo $actions;
	
 }
 
?>