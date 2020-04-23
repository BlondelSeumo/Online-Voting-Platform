<?php

 // connect to the database
 require_once(__DIR__ .'/../../../core/frontinit.php');
 
 //Start new Admin Object
$user = new User();

//Check if User is logged in
if (!$user->isLoggedIn()) {
			 	echo '
		       <div class="alert alert-danger fade in">
		        <a href="#" class="close" data-dismiss="alert">&times;</a>
		        <strong>'. $lang->error .'!</strong> '. $lang->please .' '. $lang->login .' '. $lang->to_to .' '. $lang->vote .'.
			   </div>	
			 	 ';		
}
 
 
 // check if the 'serial' variable is set in URL, and check that it is valid
elseif (!empty($_POST['nomineeid']) && !empty($_POST['organizationid']) && !empty($_POST['positionid']))
 {
	 // get id value
	 $voterid = $user->data()->userid;
	 $nomineeid = $_POST['nomineeid'];
	 $organizationid = $_POST['organizationid'];
	 $positionid = $_POST['positionid'];
	 
     $q1 = DB::getInstance()->get("votes", "*", ["AND" => ["voterid" => $voterid, "organizationid" => $organizationid, "positionid" => $positionid]]);
     if($q1->count() === 1) {	 
	 
		$Update = DB::getInstance()->update('votes',[
		   'nomineeid' => $nomineeid
	    ],[
	    "AND" => ["voterid" => $voterid, "organizationid" => $organizationid, "positionid" => $positionid]
	    ]);	 
		
	   if (count($Update) > 0) {

			 	echo '
				   <div class="alert alert-danger fade in">
				   <a href="#" class="close" data-dismiss="alert">&times;</a>
				   <strong>'. $lang->success .'!</strong> '. $lang->you .' '. $lang->have .' '. $lang->changed .' '. $lang->your .' '. $lang->vote .'!</strong>
				   </div> 	
			 	 ';	

		} else {
			 	echo '
	       <div class="alert alert-danger fade in">
	        <a href="#" class="close" data-dismiss="alert">&times;</a>
	        <strong>'. $lang->error .'!</strong> '. $lang->something .' '. $lang->went .' '. $lang->wrong .'.
		   </div>	
			 	 ';	
		}		
		
	 }else {
		 
		   $Insert = DB::getInstance()->insert('votes', array(
		   'voterid' => $voterid,
		   'nomineeid' => $nomineeid,
		   'organizationid' => $organizationid,
		   'positionid' => $positionid
		    ));	
				
		  if (count($Insert) > 0) {
			 	echo '
				   <div class="alert alert-danger fade in">
				   <a href="#" class="close" data-dismiss="alert">&times;</a>
				   <strong>'. $lang->success .'!</strong> '. $lang->you .' '. $lang->have .' '. $lang->voted .' '. $lang->successfully .'!</strong>
				   </div> 	
			 	 ';	
		  } else {
			 	echo '
			       <div class="alert alert-danger fade in">
			        <a href="#" class="close" data-dismiss="alert">&times;</a>
	                <strong>'. $lang->error .'!</strong> '. $lang->something .' '. $lang->went .' '. $lang->wrong .'.
				   </div>	
			 	 ';	
		  }		 
	 }	
	 
 }
 
?>