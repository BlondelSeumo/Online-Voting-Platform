<?php

 // connect to the database
 require_once(__DIR__ .'/../../../core/frontinit.php');
 
 
 
 // check if the 'serial' variable is set in URL, and check that it is valid
 if (!empty($_POST['id']) && !empty($_POST['websiteid']) && !empty($_POST['limit']))
 {
	 // get id value
	 $id = $_POST['id'];
	 $websiteid = $_POST['websiteid'];
	 $limit = $_POST['limit'];
	 
	 $proposals = getAllVoters($id, $websiteid, $limit);
	 echo $proposals;
	
 }
 
?>