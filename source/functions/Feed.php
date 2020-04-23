<?php
 
function getActions($userid, $state = null){
	
 // connect to the database
 require_once(__DIR__ .'/../core/frontinit.php');
 
 //Get Site Settings Data
$query = DB::getInstance()->get("settings", "*", ["id" => 1]);
if ($query->count()) {
 foreach($query->results() as $web) {
 }			
}	

//Get Payments Settings Data
$qlang = DB::getInstance()->get("languages", "*", ["languageid" => $web->languageid]);
if ($qlang->count()) {
 foreach($qlang->results() as $lang) {
 }			
} 
	
	if ($state == 1) { 
		
		$Update = DB::getInstance()->update('user',[
		   'active' => 1,
		],[
		    'userid' => $userid
		  ]);
	 
	 
	} elseif($state == 2) {
		
		$Update = DB::getInstance()->update('user',[
		   'active' => 0,
		],[
		    'userid' => $userid
		  ]);
		  	 
	} else {
	  $state = null;	
	}

	
	// Verify the Follow state
    $q2 = DB::getInstance()->get("user", "*", ["AND"=> ["active" => 1, "userid" => $userid]]);
	
	if($q2->count() === 1) {
		$state = 2;
		$y = $lang->deactivate;
		$i = "fa fa-close";
	} else {
		$state = 1;
		$y = $lang->deactivate;
		$i = "fa fa-check-square";
	}	

	// Output variable
	$actions = '
     <a class="btn btn-info btn-xs" onclick="doActive('.$userid.', '.$state.')" id="doActive'.$userid.'" data-toggle="tooltip" title="' . $y . '">
     <span class="fa '.$i.'"></span></a>';	
	
    return $actions;
}

function getDelete($userid){
	
 // connect to the database
 require_once(__DIR__ .'/../core/frontinit.php');
 
 //Get Site Settings Data
$query = DB::getInstance()->get("settings", "*", ["id" => 1]);
if ($query->count()) {
 foreach($query->results() as $web) {
 }			
}	

//Get Payments Settings Data
$qlang = DB::getInstance()->get("languages", "*", ["languageid" => $web->languageid]);
if ($qlang->count()) {
 foreach($qlang->results() as $lang) {
 }			
} 	
		

	// Output variable
	$actions = '
	 <a onclick="delete_the('.$userid.')" class="btn btn-danger btn-xs" data-toggle="tooltip" title="'.$lang->delete_delete .'">
	 <span class="fa fa-trash"></span></a>';	
	
    return $actions;
}

 
function getActionsNominee($userid, $state = null){
	
 // connect to the database
 require_once(__DIR__ .'/../core/frontinit.php');
 
 //Get Site Settings Data
$query = DB::getInstance()->get("settings", "*", ["id" => 1]);
if ($query->count()) {
 foreach($query->results() as $web) {
 }			
}	

//Get Payments Settings Data
$qlang = DB::getInstance()->get("languages", "*", ["languageid" => $web->languageid]);
if ($qlang->count()) {
 foreach($qlang->results() as $lang) {
 }			
} 	
	
	if ($state == 1) { 
		
		$Update = DB::getInstance()->update('user',[
		   'active' => 1,
		],[
		    'userid' => $userid
		  ]);
	 
	 
	} elseif($state == 2) {
		
		$Update = DB::getInstance()->update('user',[
		   'active' => 0,
		],[
		    'userid' => $userid
		  ]);
		  	 
	} else {
	  $state = null;	
	}

	
	// Verify the Follow state
    $q2 = DB::getInstance()->get("user", "*", ["AND"=> ["active" => 1, "userid" => $userid]]);
	
	if($q2->count() === 1) {
		$state = 2;
		$y = $lang->deactivate;
		$i = "fa fa-close";
	} else {
		$state = 1;
		$y = $lang->activate;
		$i = "fa fa-check-square";
	}	

	// Output variable
	$actions = '
     <a class="btn btn-info btn-xs" onclick="doActiveNominee('.$userid.', '.$state.')" id="doActive'.$userid.'" data-toggle="tooltip" title="' . $y . '">
     <span class="fa '.$i.'"></span></a>';	
	
    return $actions;
}

function getDeleteNominee($userid){
	
 // connect to the database
 require_once(__DIR__ .'/../core/frontinit.php');
 
 //Get Site Settings Data
$query = DB::getInstance()->get("settings", "*", ["id" => 1]);
if ($query->count()) {
 foreach($query->results() as $web) {
 }			
}	

//Get Payments Settings Data
$qlang = DB::getInstance()->get("languages", "*", ["languageid" => $web->languageid]);
if ($qlang->count()) {
 foreach($qlang->results() as $lang) {
 }			
}		

	// Output variable
	$actions = '
	 <a onclick="delete_the('.$userid.')" class="btn btn-danger btn-xs" data-toggle="tooltip" title="'.$lang->delete_delete .'">
	 <span class="fa fa-trash"></span></a>';	
	
    return $actions;
}

function getDeleteOrganization($organizationid){
	
 // connect to the database
 require_once(__DIR__ .'/../core/frontinit.php');
 
 //Get Site Settings Data
$query = DB::getInstance()->get("settings", "*", ["id" => 1]);
if ($query->count()) {
 foreach($query->results() as $web) {
 }			
}	

//Get Payments Settings Data
$qlang = DB::getInstance()->get("languages", "*", ["languageid" => $web->languageid]);
if ($qlang->count()) {
 foreach($qlang->results() as $lang) {
 }			
}		

	// Output variable
	$actions = '
	 <a onclick="delete_the_organization('.$organizationid.')" class="btn btn-danger btn-xs" data-toggle="tooltip" title="'.$lang->delete_delete .'">
	 <span class="fa fa-trash"></span></a>';	
	
    return $actions;
}

function getDeletePosition($positionid){
	
 // connect to the database
 require_once(__DIR__ .'/../core/frontinit.php');
 
 //Get Site Settings Data
$query = DB::getInstance()->get("settings", "*", ["id" => 1]);
if ($query->count()) {
 foreach($query->results() as $web) {
 }			
}	

//Get Payments Settings Data
$qlang = DB::getInstance()->get("languages", "*", ["languageid" => $web->languageid]);
if ($qlang->count()) {
 foreach($qlang->results() as $lang) {
 }			
}		

	// Output variable
	$actions = '
	 <a onclick="delete_the_position('.$positionid.')" class="btn btn-danger btn-xs" data-toggle="tooltip" title="'.$lang->delete_delete .'">
	 <span class="fa fa-trash"></span></a>';	
	
    return $actions;
}

function getDeleteLanguage($languageid){
	
 // connect to the database
 require_once(__DIR__ .'/../core/frontinit.php');
 
 //Get Site Settings Data
$query = DB::getInstance()->get("settings", "*", ["id" => 1]);
if ($query->count()) {
 foreach($query->results() as $web) {
 }			
}	

//Get Payments Settings Data
$qlang = DB::getInstance()->get("languages", "*", ["languageid" => $web->languageid]);
if ($qlang->count()) {
 foreach($qlang->results() as $lang) {
 }			
}		

	// Output variable
	$actions = '
	 <a onclick="delete_the_language('.$languageid.')" class="btn btn-danger btn-xs" data-toggle="tooltip" title="'.$lang->delete_delete .'">
	 <span class="fa fa-trash"></span></a>';	
	
    return $actions;
}




?>
     