<?php

//Check if init.php exists
 require_once(__DIR__ .'/../../../core/frontinit.php');

   $cookieName = Config::get('language/cookie_name');	
	 
	 Cookie::delete('lang');
 
 // check if the 'serial' variable is set in URL, and check that it is valid
 if (!empty($_POST['languageid']))
 {
	 // get id value
	 $languageid = $_POST['languageid'];
   
     Cookie::put($cookieName, $languageid, Config::get('language/cookie_expiry'));	
   	
		//Get Site Settings Data
		$qset = DB::getInstance()->get("languages", "*", ["languageid" => $languageid]);
		if ($qset->count()) {
		 foreach($qset->results() as $rset) {
		 }			
		}   
		
			
		$siteUpdate = DB::getInstance()->update('settings',[
		    'languageid' => $rset->languageid
	    ],[
	    'id' => $web->id
	    ]);
		
			
 
	
 }
 
?>