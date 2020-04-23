<?php

 // connect to the database
 require_once(__DIR__ .'/../../../core/frontinit.php');
 
	 // get id value
	 
// get the list of items id separated by cama (,)
$list_order = $_POST['list_order'];
// convert the string list to an array
$list = explode(',' , $list_order);
$i = 1 ;
foreach($list as $id) {
	try {

		//Update
		$Update = DB::getInstance()->update('category_type',[
		   'item_order' => $i
		],[
		    'id' => $id
		  ]);
	  
	} catch (PDOException $e) {
		echo 'PDOException : '.  $e->getMessage();
	}
	$i++ ;
}
 
	  
?>