<?php

include_once 'TruncateHTML.php';

//Ratings
function ratings($star){
	
	
  if($star === '1'):
	 $name .='
			<i class="fa fa-star fa-3x star-null star-checked" id="star-1"></i>
			<i class="fa fa-star fa-3x star-null" id="star-2"></i>
			<i class="fa fa-star fa-3x star-null" id="star-3"></i>
			<i class="fa fa-star fa-3x star-null" id="star-4"></i>
			<i class="fa fa-star fa-3x star-null" id="star-5"></i>
            ';   
  elseif($star === '2'):
	 $name .='
			<i class="fa fa-star fa-3x star-null star-checked" id="star-1"></i>
			<i class="fa fa-star fa-3x star-null star-checked" id="star-2"></i>
			<i class="fa fa-star fa-3x star-null" id="star-3"></i>
			<i class="fa fa-star fa-3x star-null" id="star-4"></i>
			<i class="fa fa-star fa-3x star-null" id="star-5"></i>'; 
  elseif($star === '3'):
	 $name .='
			<i class="fa fa-star fa-3x star-null star-checked" id="star-1"></i>
			<i class="fa fa-star fa-3x star-null star-checked" id="star-2"></i>
			<i class="fa fa-star fa-3x star-null star-checked" id="star-3"></i>
			<i class="fa fa-star fa-3x star-null" id="star-4"></i>
			<i class="fa fa-star fa-3x star-null" id="star-5"></i>'; 
  elseif($star === '4'):
	 $name .='
			<i class="fa fa-star fa-3x star-null star-checked" id="star-1"></i>
			<i class="fa fa-star fa-3x star-null star-checked" id="star-2"></i>
			<i class="fa fa-star fa-3x star-null star-checked" id="star-3"></i>
			<i class="fa fa-star fa-3x star-null star-checked" id="star-4"></i>
			<i class="fa fa-star fa-3x star-null" id="star-5"></i>'; 
  elseif($star === '5'):
	 $name .='
			<i class="fa fa-star fa-3x star-null star-checked" id="star-1"></i>
			<i class="fa fa-star fa-3x star-null star-checked" id="star-2"></i>
			<i class="fa fa-star fa-3x star-null star-checked" id="star-3"></i>
			<i class="fa fa-star fa-3x star-null star-checked" id="star-4"></i>
			<i class="fa fa-star fa-3x star-null star-checked" id="star-5"></i>'; 
  endif;	  
  
  							

  
  $full = $name;	  	
  
  return $full;
	
}

//Clean URL
function seoUrl($string) {
    //Lower case everything
    $string = strtolower($string);
    //Make alphanumeric (removes all other characters)
    $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
    //Clean up multiple dashes or whitespaces
    $string = preg_replace("/[\s-]+/", " ", $string);
    //Convert whitespaces and underscore to dash
    $string = preg_replace("/[\s_]/", "-", $string);
    return $string;
}

//Year
function year_now($year = 'auto', $name){
	if(intval($year) == 'auto'){
	 $year = date('Y').$name;
	}
	if(intval($year) == date('Y')){
	 echo intval($year).$name;
	}
	if(intval($year) < date('Y')){
	 echo intval($year) . ' - ' . date('Y').$name;
	}
	if(intval($year) > date('Y')){
	 echo date('Y').$name;
	}
}

//Date Difference
function datediff($timestart, $timeend) {
	
    // If not numeric then convert texts to unix timestamps
    if (!is_int($timestart)) {
      $time1 = strtotime($timestart, 0);
    }
    if (!is_int($timeend)) {
      $time2 = strtotime($timeend, 0);
    }	
	
	// Difference in seconds
    $difference = $time2 - $time1; 
	
	$numberDays = $difference/86400;  // 86400 seconds in one day
	
	// and you might want to convert to integer
	$numberDays = intval($numberDays);	
	
	// Difference in seconds
    //$ti = gmdate("H:i", $difference); 	
	
    return $numberDays;	
}

//Money As Cents
function getMoneyAsCents($value)
{
    // strip out commas
    $value = preg_replace("/\,/i","",$value);
    // strip out all but numbers, dash, and dot
    $value = preg_replace("/([^0-9\.\-])/i","",$value);
    // make sure we are dealing with a proper number now, no +.4393 or 3...304 or 76.5895,94
    if (!is_numeric($value))
    {
        return 0.00;
    }
    // convert to a float explicitly
    $value = (float)$value;
    return round($value,2)*100;
}

//Change Freelancer Membership
function membership($freelancerid) {
	
     $q1 = DB::getInstance()->get("freelancer", "*", ["freelancerid" => $freelancerid, "LIMIT" => 1]);
     if($q1->count()) {
		foreach($q1->results() as $r1) {
           $membership_date = $r1->membership_date;
		}
	 }	
	 
     $q2 = DB::getInstance()->get("payments_settings", "*", ["id" => 1, "LIMIT" => 1]);
     if($q2->count()) {
		foreach($q2->results() as $r2) {
           $membershipid = $r2->membershipid;
		}
	 }	 
	 
	$query = DB::getInstance()->get("membership_freelancer", "*", ["membershipid" => $membershipid]);
	if ($query->count() === 1) {
	  $q3 = DB::getInstance()->get("membership_freelancer", "*", ["membershipid" => $membershipid]);
	} else {
	  $q3 = DB::getInstance()->get("membership_agency", "*", ["membershipid" => $membershipid]);
	}
	if ($q3->count() === 1) {
	 foreach($q3->results() as $r3) {
	  $bids = $r3->bids;
	 }
	} 	 
	
    // Check Number of days
	$timenow = date("F j, Y, g:i a");
	$timeend =  $membership_date. ' + 30 days';
	$datediff = datediff($timenow, $timeend);     
	
	if ($datediff <= 0) {
		
		//Update Membership
		$Update = DB::getInstance()->update('freelancer',[
		   'membershipid' => $membershipid,
		   'membership_bids' => $bids,
		   'membership_date' => date('Y-m-d H:i:s')
		],[
		    'freelancerid' => $freelancerid
		  ]);		
		
	}
	
}

//Change Featured Job
function featured($jobid) {
	
     $q1 = DB::getInstance()->get("job", "*", ["jobid" => $jobid, "LIMIT" => 1]);
     if($q1->count()) {
		foreach($q1->results() as $r1) {
           $featured_date = $r1->featured_date;
		}
	 }	
	 
     $q2 = DB::getInstance()->get("payments_settings", "*", ["id" => 1, "LIMIT" => 1]);
     if($q2->count()) {
		foreach($q2->results() as $r2) {
           $jobs_pay_limit = $r2->jobs_pay_limit;
		}
	 }	 
	 
    // Check Number of days
	$timenow = date("F j, Y, g:i a");
	$timeend =  $featured_date. ' + ' .$jobs_pay_limit;
	$datediff = datediff($timenow, $timeend);     
	
	if ($datediff <= 0) {
		
		//Update Membership
		$Update = DB::getInstance()->update('job',[
		   'featured' => 0
		],[
		    'jobid' => $jobid
		  ]);		
		
	}
	
}

//Time Ago
function ago($i){
	$m = time()-$i; $o='just now';
	$t = array('year'=>31556926,'month'=>2629744,'week'=>604800, 'day'=>86400,'hour'=>3600,'minute'=>60,'second'=>1);
	foreach($t as $u=>$s){
		if($s<=$m){$v=floor($m/$s); $o="$v $u".($v==1?'':'s').' ago'; break;}
	}
	return $o;
}

//Messages Functions
function getMessage($freelancerid, $clientid) {
	$comList = '';
	$c_per_page = 2;
	
		
	
  $query = DB::getInstance()->get("message", "*", [	
   "ORDER" => "date_added DESC",
   "OR" => [
		"AND #first" => [
			"user_from" => $clientid,
			"user_to" => $freelancerid,
			"delete_remove" => 0
		],
		"AND #second" => [
			"user_from" => $freelancerid,
			"user_to" => $clientid,
			"delete_remove" => 0
		]
	]]);
 if($query->count()) {
    $x = 1;	
	 	 
	foreach($query->results() as $row) {


     $q3 = DB::getInstance()->get("freelancer", "*", ["freelancerid" => $freelancerid, "LIMIT" => 1]);
     if($q3->count()) {
		foreach($q3->results() as $r3) {
           $name_3 = $r3->name;
           $imagelocation_3 = $r3->imagelocation;
		}
	 }	
	 
     $q4 = DB::getInstance()->get("client", "*", ["clientid" => $clientid, "LIMIT" => 1]);
     if($q4->count()) {
		foreach($q4->results() as $r4) {
           $name_4 = $r4->name;
           $imagelocation_4 = $r4->imagelocation;
		}
	 }	 			
		
	// Time Ago
	$time = ago(strtotime($row->date_added));	
	
	if ($freelancerid === $row->user_from) {
		
		if($row->user_from == $clientid) { // If it's current username is the same with the current author
			$delete = '<a class="btn" onclick="delete_the('.$row->id.')" title="Delete Message"><i class="fa fa-trash-o"></i></a>';
		} else { // If the current username is not the same as the author
			$delete = '<a class="btn" onclick="report_the('.$row->id.', '.$clientid.')" title="Report Message"><i class="fa fa-flag"></i></a>';
		}		
		  
     $comList .= '
                 <section id="comment'.$row->id.'" class="comment-list block">
                  <article class="comment-item">
                   <a class="pull-left thumb-sm avatar">
                    <img src="../Freelancer/' . $imagelocation_3 . '" class="img-circle" alt="...">
                   </a>
                   <span class="arrow left"></span>
                   <section class="comment-body panel panel-default bg-white">
                    <header class="panel-heading">
                     <a href="../freelancer.php?a=overview&id=' . $freelancerid . '" target="_blank">' . $name_3 . '
                     <label class="label bg-danger m-left"> Freelancer </label>
                     </a>
					 &nbsp; <i class="fa fa-clock-o"></i> ' . $time . ' </span>
					 <span class="text-muted m-l-sm pull-right">
					  ' . $delete . '
                    </header>
                    <div class="panel-body">
                     ' . $row->message . '
                    </div>
                   </section>
                  </article><!-- .message-end -->
                 </section>
                                
				 ';		
		
	}
	if ($clientid === $row->user_from) {
		
		if($row->user_from == $clientid) { // If it's current username is the same with the current author
			$delete = '<a class="btn" onclick="delete_the('.$row->id.', '.$clientid.')" title="Delete Message"><i class="fa fa-trash-o"></i></a>';
		} else { // If the current username is not the same as the author
			$delete = '<a class="btn" onclick="report_the('.$row->id.', '.$clientid.')" title="Report Message"><i class="fa fa-flag"></i></a>';
		}		
	  
     $comList .= '
                 <section id="comment'.$row->id.'" class="comment-list block">
                  <article class="comment-item">
                   <a class="pull-left thumb-sm avatar">
                    <img src="../Client/' . $imagelocation_4 . '" class="img-circle" alt="...">
                   </a>
                   <span class="arrow left"></span>
                   <section class="comment-body panel panel-default bg-white">
                    <header class="panel-heading">
                     <a href="../client.php?a=overview&id=' . $clientid . '" target="_blank">' . $name_4 . ' 
                     <label class="label bg-info m-left"> Client </label>
                     </a>
					 &nbsp; <i class="fa fa-clock-o"></i> ' . $time . ' </span>
					 <span class="text-muted m-l-sm pull-right">
					  ' . $delete . '
                    </header>
                    <div class="panel-body">
                     ' . $row->message . '
                    </div>
                   </section>
                  </article><!-- .message-end -->
                 </section>
                 
				 ';		
	}
	 $x++;		 
   }
	
}

 return $comList;	
}

function getLastMessage($clientid, $freelancerid) {
	$Last = '';
  $query = DB::getInstance()->get("message", "*", ["LIMIT" => [0,1], "AND" => ["user_to" => $freelancerid, "user_from" => $clientid], "ORDER" => "id DESC"]);
 if($query->count()) {
    $x = 1;
	 	
	foreach($query->results() as $row) {
		
     $q3 = DB::getInstance()->get("client", "*", ["clientid" => $row->user_from, "LIMIT" => 1]);
     if($q3->count()) {
		foreach($q3->results() as $r3) {
           $name_3 = $r3->name;
           $imagelocation_3 = $r3->imagelocation;
		}
	 }		
	
	if($row->user_from == $clientid) { // If it's current username is the same with the current author
		$delete = '<a class="btn" onclick="delete_the('.$row->id.', '.$clientid.')" title="Delete Comment"><i class="fa fa-trash-o"></i></a>';
	} else { // If the current username is not the same as the author
			$delete = '<a class="btn" onclick="report_the('.$row->id.', '.$clientid.')" title="Report Message"><i class="fa fa-flag"></i></a>';
	}	
	
		// Time Ago
		$time = ago(strtotime($row->date_added));	
			
	  
          $Last .= '
          
                 <section id="comment'.$row->id.'" class="comment-list block">
                  <article class="comment-item">
                   <a class="pull-left thumb-sm avatar">
                    <img src="' . $imagelocation_3 . '" class="img-circle" alt="...">
                   </a>
                   <span class="arrow left"></span>
                   <section class="comment-body panel panel-default bg-white">
                    <header class="panel-heading">
                     <a href="../client.php?a=overview&id=' . $clientid . '" target="_blank">' . $name_3 . ' 
                     <label class="label bg-info m-left"> Client </label>
                     </a>
					 &nbsp; <i class="fa fa-clock-o"></i> ' . $time . ' </span>
					 <span class="text-muted m-l-sm pull-right">
					  ' . $delete . '
                    </header>
                    <div class="panel-body">
                     ' . $row->message . '
                    </div>
                   </section>
                  </article><!-- .message-end -->
                 </section>
                 
				 ';
	 $x++;		 
   }
	
}
	
 return $Last;	
 unset($Last);
}

function getMessageF($clientid, $freelancerid) {
	$comList = '';
	$c_per_page = 2;
	
		
	
  $query = DB::getInstance()->get("message", "*", [	
   "ORDER" => "date_added DESC",
   "OR" => [
		"AND #first" => [
			"user_from" => $clientid,
			"user_to" => $freelancerid,
			"delete_remove" => 0
		],
		"AND #second" => [
			"user_from" => $freelancerid,
			"user_to" => $clientid,
			"delete_remove" => 0
		]
	]]);
 if($query->count()) {
    $x = 1;	
	 	 
	foreach($query->results() as $row) {

 $q5 = DB::getInstance()->get("trash", "*", ["AND" => ["messageid" => $row->id, "userid" => $freelancerid], "LIMIT" => 1]);
 if ($q5->count() === 0) {
     
		
		
     $q3 = DB::getInstance()->get("freelancer", "*", ["freelancerid" => $freelancerid, "LIMIT" => 1]);
     if($q3->count()) {
		foreach($q3->results() as $r3) {
           $name_3 = $r3->name;
           $imagelocation_3 = $r3->imagelocation;
		}
	 }	
	 
     $q4 = DB::getInstance()->get("client", "*", ["clientid" => $clientid, "LIMIT" => 1]);
     if($q4->count()) {
		foreach($q4->results() as $r4) {
           $name_4 = $r4->name;
           $imagelocation_4 = $r4->imagelocation;
		}
	 }	 			
		
	// Time Ago
	$time = ago(strtotime($row->date_added));	
	
	if ($freelancerid === $row->user_from) {
		
		if($row->user_from == $freelancerid) { // If it's current username is the same with the current author
			$delete = '<a class="btn" onclick="delete_the('.$row->id.', '.$freelancerid.')" title="Delete Message"><i class="fa fa-trash-o"></i></a>';
		} else { // If the current username is not the same as the author
			$delete = '<a class="btn" onclick="report_the('.$row->id.', '.$freelancerid.')" title="Report Message"><i class="fa fa-flag"></i></a>';
		}		
		  
     $comList .= '
                 <section id="comment'.$row->id.'" class="comment-list block">
                  <article class="comment-item">
                   <a class="pull-left thumb-sm avatar">
                    <img src="../Freelancer/' . $imagelocation_3 . '" class="img-circle" alt="...">
                   </a>
                   <span class="arrow left"></span>
                   <section class="comment-body panel panel-default bg-white">
                    <header class="panel-heading">
                     <a href="../freelancer.php?a=overview&id=' . $freelancerid . '" target="_blank">' . $name_3 . ' 
                     <label class="label bg-danger m-left"> Freelancer </label>
                     </a>
					 &nbsp; <i class="fa fa-clock-o"></i> ' . $time . ' </span>
					 <span class="text-muted m-l-sm pull-right">
					  ' . $delete . '
                    </header>
                    <div class="panel-body">
                     ' . $row->message . '
                    </div>
                   </section>
                  </article><!-- .message-end -->
                 </section>
                                
				 ';		
		
	}
	if ($clientid === $row->user_from) {
		
		if($row->user_from == $freelancerid) { // If it's current username is the same with the current author
			$delete = '<a class="btn" onclick="delete_the('.$row->id.', '.$freelancerid.')" title="Delete Message"><i class="fa fa-trash-o"></i></a>';
		} else { // If the current username is not the same as the author
			$delete = '<a class="btn" onclick="report_the('.$row->id.', '.$freelancerid.')" title="Report Message"><i class="fa fa-flag"></i></a>';
		}		
	  
     $comList .= '
                 <section id="comment'.$row->id.'" class="comment-list block">
                  <article class="comment-item">
                   <a class="pull-left thumb-sm avatar">
                    <img src="../Client/' . $imagelocation_4 . '" class="img-circle" alt="...">
                   </a>
                   <span class="arrow left"></span>
                   <section class="comment-body panel panel-default bg-white">
                    <header class="panel-heading">
                     <a href="../client.php?a=overview&id=' . $clientid . '" target="_blank">' . $name_4 . ' 
                     <label class="label bg-info m-left"> Client </label>
                     </a>
					 &nbsp; <i class="fa fa-clock-o"></i> ' . $time . ' </span>
					 <span class="text-muted m-l-sm pull-right">
					  ' . $delete . '
                    </header>
                    <div class="panel-body">
                     ' . $row->message . '
                    </div>
                   </section>
                  </article><!-- .message-end -->
                 </section>
                 
				 ';		
	}
	 $x++;		 
   }
 }
	
}

 return $comList;	
}

function getLastMessageF($freelancerid, $clientid) {
	$Last = '';
  $query = DB::getInstance()->get("message", "*", ["LIMIT" => [0,1], "AND" => ["user_to" => $clientid, "user_from" => $freelancerid], "ORDER" => "id DESC"]);
 if($query->count()) {
    $x = 1;
	 	
	foreach($query->results() as $row) {
		
     $q3 = DB::getInstance()->get("freelancer", "*", ["freelancerid" => $row->user_from, "LIMIT" => 1]);
     if($q3->count()) {
		foreach($q3->results() as $r3) {
           $name_3 = $r3->name;
           $imagelocation_3 = $r3->imagelocation;
		}
	 }		
	
	if($row->user_from == $freelancerid) { // If it's current username is the same with the current author
		$delete = '<a class="btn" onclick="delete_the('.$row->id.', '.$freelancerid.')" title="Delete Comment"><i class="fa fa-trash-o"></i></a>';
	} else { // If the current username is not the same as the author
			$delete = '<a class="btn" onclick="report_the('.$row->id.', '.$freelancerid.')" title="Report Message"><i class="fa fa-flag"></i></a>';
	}	
	
		// Time Ago
		$time = ago(strtotime($row->date_added));	
			
	  
          $Last .= '
          
                 <section id="comment'.$row->id.'" class="comment-list block">
                  <article class="comment-item">
                   <a class="pull-left thumb-sm avatar">
                    <img src="' . $imagelocation_3 . '" class="img-circle" alt="...">
                   </a>
                   <span class="arrow left"></span>
                   <section class="comment-body panel panel-default bg-white">
                    <header class="panel-heading">
                     <a href="../freelancer.php?a=overview&id=' . $freelancerid . '" target="_blank">' . $name_3 . ' 
                     <label class="label bg-danger m-left"> Freelancer </label>
                     </a>
					 &nbsp; <i class="fa fa-clock-o"></i> ' . $time . ' </span>
					 <span class="text-muted m-l-sm pull-right">
					  ' . $delete . '
                    </header>
                    <div class="panel-body">
                     ' . $row->message . '
                    </div>
                   </section>
                  </article><!-- .message-end -->
                 </section>
                 
				 ';
	 $x++;		 
   }
	
}
	
 return $Last;	
 unset($Last);
}

function star($messageid, $userid, $state = null){
	
	if ($state == 1) {
	
     $query = DB::getInstance()->get("star", "*", ["AND"=> ["messageid" => $messageid, "userid" => $userid]]);
	 if($query->count() === 1) {
		$x = 'Already starred the message';
	 } else {
	   $Insert = DB::getInstance()->insert('star', array(
		   'messageid' => $messageid,
		   'userid' => $userid,
		   'date_added' => date('Y-m-d H:i:s')
	    ));		
	 }	
	 
	 
	} elseif($state == 2) {
	   $query = DB::getInstance()->delete('star', ["AND"=> ["messageid" => $messageid, "userid" => $userid]]);	 
	} else {
	  $state = null;	
	}

	
	// Verify the Follow state
    $q2 = DB::getInstance()->get("star", "*", ["AND"=> ["messageid" => $messageid, "userid" => $userid]]);
	
	if($q2->count() === 1) {
		$state = 2;
		$y = "Un Starred";
		$i = "fa-star text-yellow";
	} else {
		$state = 1;
		$y = "Not Starred";
		$i = "fa-star-o text-yellow";
	}	

	// Output variable
	$actions = '
	 <a class="btn" style="padding: 15px 15px 15px 15px;" onclick="doStar('.$messageid.', '.$userid.', '.$state.')" id="doStar'.$messageid.'">
	 <i class="fa '.$i.'"></i> </a>';	
	
    return $actions;
}


function getProposals($id, $jobid, $limit) {
	
	$comList = '';
	$c_per_page = $limit;
	
		
   if ($id = null) {
	   $q = null;	  
      }	else {
       $q = '"id[<]" => $id';
	  }		
	
	    $q1 = DB::getInstance()->get("proposal", "*", ["AND" => [$q, "jobid" => $jobid, "featured" => 0]]);
		// If there are more results available than the limit, then show the Load More Comments
		$count = $q1->count();
		if($count > $c_per_page) {
			$loadmore = 1;
		} else {
			$loadmore = 0;
		}		
	
  $query = DB::getInstance()->get("proposal", "*", ["ORDER" => "id DESC", "AND" => [$q, "jobid" => $jobid, "featured" => 0], "LIMIT" => $c_per_page]);
 if($query->count()) {
    $x = 1;	
	 	 
	foreach($query->results() as $row) {	

     $q3 = DB::getInstance()->get("freelancer", "*", ["freelancerid" => $row->freelancerid, "LIMIT" => 1]);
     if($q3->count()) {
		foreach($q3->results() as $r3) {
           $name_3 = $r3->name;
           $username_3 = $r3->username;
           $imagelocation_3 = $r3->imagelocation;
		}
	 }		
	 
	$q4 = DB::getInstance()->get("profile", "*", ["userid" => $row->freelancerid, "LIMIT" => 1]);
	if ($q4->count()) {
	 foreach($q4->results() as $r4) {
 	    $country = $r4->country;
		$skills = $r4->skills;
		$arr=explode(',',$skills);
	 }			
	} 	 

    foreach ($arr as $key => $value) {
      $skill .= '<label class="label label-success">'. $value .'</label> &nbsp;'; 
    }			
	

	 $q5 = DB::getInstance()->get("ratings", "*", ["AND" => ["freelancerid" => $row->freelancerid]]);
	 $c5 = $q5->count();
	 $re5 = $c5/7;	


	//Get Payments Settings Data
	$qp = DB::getInstance()->get("payments_settings", "*", ["id" => 1]);
	if ($qp->count()) {
	 foreach($qp->results() as $rp) {
	 	$currency = $rp->currency;
	 }			
	}
	
	//Get Payments Settings Data
	$qc = DB::getInstance()->get("currency", "*", ["id" => $currency]);
	if ($qc->count()) {
	 foreach($qc->results() as $rc) {
	 	$currency_symbol = $rc->currency_symbol;
	 }			
	}	 
		
	// Time Ago
	$time = ago(strtotime($row->date_added));	
	$blurb = truncateHtml($row->description, 250);
	 

	
     $comList .= '
     
		 <div class="job">	
	  
		  <div class="row top-sec">
		   <div class="col-lg-12">
			<div class="col-lg-2 col-xs-12">
			 <a href="freelancer.php?a=overview&&id='.$row->freelancerid.'" target="_blank">
			  <img class="img-responsive" src="Freelancer/'.$imagelocation_3.'" alt="">
			 </a>
			</div><!-- /.col-lg-2 -->
			<div class="col-lg-10 col-xs-12"> 
			 <h4><a href="freelancer.php?a=overview&&id='.$row->freelancerid.'" target="_blank">'.$name_3.'</a></h4>
			 <h5><i class="fa fa-at"></i> '.$username_3.'</h5>
			</div><!-- /.col-lg-10 -->
			
		   </div><!-- /.col-lg-12 -->
		  </div><!-- /.row -->
	  
		  <div class="row mid-sec">			 
		   <div class="col-lg-12">			 
		   <div class="col-lg-12">
			<hr class="small-hr">
			<p>'.$blurb.'</p>
			'.$skill.'

		   </div><!-- /.col-lg-12 -->
		   </div><!-- /.col-lg-12 -->
		  </div><!-- /.row -->
	  
		  <div class="row bottom-sec">
		   <div class="col-lg-12">
			
			<div class="col-lg-12">
			 <hr class="small-hr">
			</div> 
			
			<div class="col-lg-3">
			 <h5>Posted </h5>
			 <p> '.$time.'</p>
			</div>
			<div class="col-lg-3">
			 <h5> Location </h5>
			 <p><i class="fa fa-map-marker"></i> '.$country.'</p>
			</div>
			<div class="col-lg-3">
			 <h5> Budget </h5>
			 <p>'.$currency_symbol.' '.$row->budget.'</p>
			</div>
			<div class="col-lg-3">
			 <h5> Ratings ('.$re5.')</h5>
			 <p><i class="fa fa-star"></i>
				<i class="fa fa-star"></i>
				<i class="fa fa-star"></i>
				<i class="fa fa-star"></i>
				<i class="fa fa-star"></i></p>
			</div>
			
		   </div><!-- /.col-lg-12 -->
		  </div><!-- /.row -->
		 
		 </div><!-- /.job -->
				 ';
	 $x++;		 
   }
	
}

	if($loadmore) {
		$load = '<div class="text-center" id="more_comments_'.$row->id.'">
                 
		 <a class="btn text-center" onclick="loadProposals('.$row->id.', '.$jobid.', '.$limit.')">
		  <hr class="star-light-left">
		   <p>View More Proposals</p>
		  <hr class="star-light-right">
		 </a>
		</div>';
	}	 
	
 return $comList.$load;	
}

function getAllProposals($id, $jobid, $limit) {
	error_reporting(0);
	$comList = '';
	$c_per_page = $limit;
	
	    $q1 = DB::getInstance()->get("proposal", "*", ["AND" => ["id[<]" => $id, "jobid" => $jobid, "featured" => 0]]);
		// If there are more results available than the limit, then show the Load More Comments
		$count = $q1->count();
		if($count > $c_per_page) {
			$loadmore = 1;
		} else {
			$loadmore = 0;
		}		
	
  $query = DB::getInstance()->get("proposal", "*", ["ORDER" => "id DESC", "AND" => ["id[<]" => $id, "jobid" => $jobid, "featured" => 0], "LIMIT" => $c_per_page]);
 if($query->count()) {
    $x = 1;	
	 
	foreach($query->results() as $row) {
	
     $q3 = DB::getInstance()->get("freelancer", "*", ["freelancerid" => $row->freelancerid, "LIMIT" => 1]);
     if($q3->count()) {
		foreach($q3->results() as $r3) {
           $name_3 = $r3->name;
           $username_3 = $r3->username;
           $imagelocation_3 = $r3->imagelocation;
		}
	 }		
	 
	$q4 = DB::getInstance()->get("profile", "*", ["userid" => $row->freelancerid, "LIMIT" => 1]);
	if ($q4->count()) {
	 foreach($q4->results() as $r4) {
 	    $country = $r4->country;
		$skills = $r4->skills;
		$arr=explode(',',$skills);
	 }			
	} 	 

    foreach ($arr as $key => $value) {
      $skill .= '<label class="label label-success">'. $value .'</label> &nbsp;'; 
    }


	//Get Payments Settings Data
	$qp = DB::getInstance()->get("payments_settings", "*", ["id" => 1]);
	if ($qp->count()) {
	 foreach($qp->results() as $rp) {
	 	$currency = $rp->currency;
	 }			
	}
	
	//Get Payments Settings Data
	$qc = DB::getInstance()->get("currency", "*", ["id" => $currency]);
	if ($qc->count()) {
	 foreach($qc->results() as $rc) {
	 	$currency_symbol = $rc->currency_symbol;
	 }			
	}	
	

	 $q5 = DB::getInstance()->get("ratings", "*", ["AND" => ["freelancerid" => $row->freelancerid]]);
	 $c5 = $q5->count();
	 $re5 = $c5/7;			
		
	// Time Ago
	$time = ago(strtotime($row->date_added));	
	$blurb = truncateHtml($row->description, 250);
	  
     $comList .= '
     
		 <div class="job">	
	  
		  <div class="row top-sec">
		   <div class="col-lg-12">
			<div class="col-lg-2 col-xs-12">
			 <a href="freelancer.php?a=overview&&id='.$row->freelancerid.'" target="_blank">
			  <img class="img-responsive" src="Freelancer/'.$imagelocation_3.'" alt="">
			 </a>
			</div><!-- /.col-lg-2 -->
			<div class="col-lg-10 col-xs-12"> 
			 <h4><a href="freelancer.php?a=overview&&id='.$row->freelancerid.'" target="_blank">'.$name_3.'</a></h4>
			 <h5><i class="fa fa-at"></i> '.$username_3.'</h5>
			</div><!-- /.col-lg-10 -->
			
		   </div><!-- /.col-lg-12 -->
		  </div><!-- /.row -->
	  
		  <div class="row mid-sec">			 
		   <div class="col-lg-12">			 
		   <div class="col-lg-12">
			<hr class="small-hr">
			<p>'.$blurb.'</p>
			'.$skill.'

		   </div><!-- /.col-lg-12 -->
		   </div><!-- /.col-lg-12 -->
		  </div><!-- /.row -->
	  
		  <div class="row bottom-sec">
		   <div class="col-lg-12">
			
			<div class="col-lg-12">
			 <hr class="small-hr">
			</div> 
			
			<div class="col-lg-3">
			 <h5>Posted </h5>
			 <p> '.$time.'</p>
			</div>
			<div class="col-lg-3">
			 <h5> Location </h5>
			 <p><i class="fa fa-map-marker"></i> '.$country.'</p>
			</div>
			<div class="col-lg-3">
			 <h5> Budget </h5>
			 <p>'.$currency_symbol.' '.$row->budget.'</p>
			</div>
			<div class="col-lg-3">
			 <h5> Ratings ('.$re5.')</h5>
			 <p><i class="fa fa-star"></i>
				<i class="fa fa-star"></i>
				<i class="fa fa-star"></i>
				<i class="fa fa-star"></i>
				<i class="fa fa-star"></i></p>
			</div>
			
		   </div><!-- /.col-lg-12 -->
		  </div><!-- /.row -->
		 
		 </div><!-- /.job -->
				 ';
	 $x++;		 
   }
	
}

	if($loadmore) {
		$load = '<div class="text-center" id="more_comments_'.$row->id.'">
                 
		 <a class="btn text-center" onclick="loadProposals('.$row->id.', '.$jobid.', '.$limit.')">
		  <hr class="star-light-left">
		   <p>View More Proposals</p>
		  <hr class="star-light-right">
		 </a>
		</div>';
	}	 
	
 return $comList.$load;	
}	

//Get Featured Proposals
function getFeaturedProposals($jobid) {
		
	
  $query = DB::getInstance()->get("proposal", "*", ["ORDER" => "date_added DESC", "AND" => ["jobid" => $jobid, "featured" => 1]]);
 if($query->count()) {
    $x = 1;	
	 	 
	foreach($query->results() as $row) {	

     $q3 = DB::getInstance()->get("freelancer", "*", ["freelancerid" => $row->freelancerid, "LIMIT" => 1]);
     if($q3->count()) {
		foreach($q3->results() as $r3) {
           $name_3 = $r3->name;
           $username_3 = $r3->username;
           $imagelocation_3 = $r3->imagelocation;
		}
	 }		
	 
	$q4 = DB::getInstance()->get("profile", "*", ["userid" => $row->freelancerid, "LIMIT" => 1]);
	if ($q4->count()) {
	 foreach($q4->results() as $r4) {
 	    $country = $r4->country;
		$skills = $r4->skills;
		$arr=explode(',',$skills);
	 }			
	} 	 

    foreach ($arr as $key => $value) {
      $skill .= '<label class="label label-success">'. $value .'</label> &nbsp;'; 
    }			
	

	 $q5 = DB::getInstance()->get("ratings", "*", ["AND" => ["freelancerid" => $row->freelancerid]]);
	 $c5 = $q5->count();
	 $re5 = $c5/7;	


	//Get Payments Settings Data
	$qp = DB::getInstance()->get("payments_settings", "*", ["id" => 1]);
	if ($qp->count()) {
	 foreach($qp->results() as $rp) {
	 	$currency = $rp->currency;
	 }			
	}
	
	//Get Payments Settings Data
	$qc = DB::getInstance()->get("currency", "*", ["id" => $currency]);
	if ($qc->count()) {
	 foreach($qc->results() as $rc) {
	 	$currency_symbol = $rc->currency_symbol;
	 }			
	}	 
		
	// Time Ago
	$time = ago(strtotime($row->date_added));	
	$blurb = truncateHtml($row->description, 250);
	 

	
     $comList .= '
     
		 <div class="job">	
	  
		  <div class="row top-sec">
		   <div class="col-lg-12">
			<div class="col-lg-2 col-xs-12">
			 <a href="freelancer.php?a=overview&&id='.$row->freelancerid.'" target="_blank">
			  <img class="img-responsive" src="Freelancer/'.$imagelocation_3.'" alt="">
			 </a>
			</div><!-- /.col-lg-2 -->
			<div class="col-lg-10 col-xs-12"> 
			 <h4><a href="freelancer.php?a=overview&&id='.$row->freelancerid.'" target="_blank">'.$name_3.'</a> <label class="label bg-danger m-left"> Featured Proposal </label></h4>
			 <h5><i class="fa fa-at"></i> '.$username_3.'</h5>
			</div><!-- /.col-lg-10 -->
			
		   </div><!-- /.col-lg-12 -->
		  </div><!-- /.row -->
	  
		  <div class="row mid-sec">			 
		   <div class="col-lg-12">			 
		   <div class="col-lg-12">
			<hr class="small-hr">
			<p>'.$blurb.'</p>
			'.$skill.'

		   </div><!-- /.col-lg-12 -->
		   </div><!-- /.col-lg-12 -->
		  </div><!-- /.row -->
	  
		  <div class="row bottom-sec">
		   <div class="col-lg-12">
			
			<div class="col-lg-12">
			 <hr class="small-hr">
			</div> 
			
			<div class="col-lg-3">
			 <h5>Posted </h5>
			 <p> '.$time.'</p>
			</div>
			<div class="col-lg-3">
			 <h5> Location </h5>
			 <p><i class="fa fa-map-marker"></i> '.$country.'</p>
			</div>
			<div class="col-lg-3">
			 <h5> Budget </h5>
			 <p>'.$currency_symbol.' '.$row->budget.'</p>
			</div>
			<div class="col-lg-3">
			 <h5> Ratings  ('.$re5.')</h5>
			 <p><i class="fa fa-star"></i>
				<i class="fa fa-star"></i>
				<i class="fa fa-star"></i>
				<i class="fa fa-star"></i>
				<i class="fa fa-star"></i></p>
			</div>
			
		   </div><!-- /.col-lg-12 -->
		  </div><!-- /.row -->
		 
		 </div><!-- /.job -->
				 ';
	 $x++;		 
   }
	
}
	 
	
 return $comList;	
}

//Discussions Functions
function getAdminDiscussion($freelancerid, $clientid) {
	$comList = '';
	$c_per_page = 2;
	
		
	
  $query = DB::getInstance()->get("message", "*", [	
   "ORDER" => "date_added DESC",
   "OR" => [
		"AND #first" => [
			"user_from" => $clientid,
			"user_to" => $freelancerid,
			"delete_remove" => 0,
			"disc" => 1
		],
		"AND #second" => [
			"user_from" => $freelancerid,
			"user_to" => $clientid,
			"delete_remove" => 0,
			"disc" => 1
		]
	]]);
 if($query->count()) {
    $x = 1;	
	 	 
	foreach($query->results() as $row) {


     $q3 = DB::getInstance()->get("freelancer", "*", ["freelancerid" => $freelancerid, "LIMIT" => 1]);
     if($q3->count()) {
		foreach($q3->results() as $r3) {
           $name_3 = $r3->name;
           $imagelocation_3 = $r3->imagelocation;
		}
	 }	
	 
     $q4 = DB::getInstance()->get("client", "*", ["clientid" => $clientid, "LIMIT" => 1]);
     if($q4->count()) {
		foreach($q4->results() as $r4) {
           $name_4 = $r4->name;
           $imagelocation_4 = $r4->imagelocation;
		}
	 }	 			
		
	// Time Ago
	$time = ago(strtotime($row->date_added));	
	
	if ($freelancerid === $row->user_from) {
     $comList .= '
                 <section id="comment'.$row->id.'" class="comment-list block">
                  <article class="comment-item">
                   <a class="pull-left thumb-sm avatar">
                    <img src="../Freelancer/' . $imagelocation_3 . '" class="img-circle" alt="...">
                   </a>
                   <span class="arrow left"></span>
                   <section class="comment-body panel panel-default bg-white">
                    <header class="panel-heading">
                     <a href="../freelancer.php?a=overview&id=' . $freelancerid . '" target="_blank">' . $name_3 . ' 
                     <label class="label bg-danger m-left"> Freelancer </label></a>
					 &nbsp; <span class="text-center"><i class="fa fa-clock-o"></i> ' . $time . ' </span>
					 <span class="text-muted m-l-sm pull-right">
                    </header>
                    <div class="panel-body">
                     ' . $row->message . '
                    </div>
                   </section>
                  </article><!-- .message-end -->
                 </section>
                                
				 ';		
		
	}
	if ($clientid === $row->user_from) {
		
     $comList .= '
                 <section id="comment'.$row->id.'" class="comment-list block">
                  <article class="comment-item">
                   <a class="pull-left thumb-sm avatar">
                    <img src="../Client/' . $imagelocation_4 . '" class="img-circle" alt="...">
                   </a>
                   <span class="arrow left"></span>
                   <section class="comment-body panel panel-default bg-white">
                    <header class="panel-heading">
                     <a href="../client.php?a=overview&id=' . $clientid . '" target="_blank">' . $name_4 . ' 
                     <label class="label bg-info m-left"> Client </label></a>
					 &nbsp; <i class="fa fa-clock-o"></i> ' . $time . ' </span>
					 <span class="text-muted m-l-sm pull-right">
                    </header>
                    <div class="panel-body">
                     ' . $row->message . '
                    </div>
                   </section>
                  </article><!-- .message-end -->
                 </section>
                 
				 ';		
	}
	 $x++;		 
   }
	
}

 return $comList;	
}

function getAdminComment($freelancerid, $clientid, $bugid) {
	$comList = '';
	$c_per_page = 2;
	
		
	
  $query = DB::getInstance()->get("message", "*", [	
   "ORDER" => "date_added DESC",
   "OR" => [
		"AND #first" => [
			"user_from" => $clientid,
			"user_to" => $freelancerid,
			"delete_remove" => 0,
			"bugid" => $bugid,
			"disc" => 2
		],
		"AND #second" => [
			"user_from" => $freelancerid,
			"user_to" => $clientid,
			"delete_remove" => 0,
			"bugid" => $bugid,
			"disc" => 2
		]
	]]);
 if($query->count()) {
    $x = 1;	
	 	 
	foreach($query->results() as $row) {

 $q5 = DB::getInstance()->get("trash", "*", ["AND" => ["messageid" => $row->id, "userid" => $freelancerid], "LIMIT" => 1]);
 if ($q5->count() === 0) {
     
		
		
     $q3 = DB::getInstance()->get("freelancer", "*", ["freelancerid" => $freelancerid, "LIMIT" => 1]);
     if($q3->count()) {
		foreach($q3->results() as $r3) {
           $name_3 = $r3->name;
           $imagelocation_3 = $r3->imagelocation;
		}
	 }	
	 
     $q4 = DB::getInstance()->get("client", "*", ["clientid" => $clientid, "LIMIT" => 1]);
     if($q4->count()) {
		foreach($q4->results() as $r4) {
           $name_4 = $r4->name;
           $imagelocation_4 = $r4->imagelocation;
		}
	 }	 			
		
	// Time Ago
	$time = ago(strtotime($row->date_added));	
	
	if ($freelancerid === $row->user_from) {
     $comList .= '
                 <section id="comment'.$row->id.'" class="comment-list block">
                  <article class="comment-item">
                   <a class="pull-left thumb-sm avatar">
                    <img src="../Freelancer/' . $imagelocation_3 . '" class="img-circle" alt="...">
                   </a>
                   <span class="arrow left"></span>
                   <section class="comment-body panel panel-default bg-white">
                    <header class="panel-heading">
                     <a href="../freelancer.php?a=overview&id=' . $freelancerid . '" target="_blank">' . $name_3 . ' 
                     <label class="label bg-danger m-left"> Freelancer </label>
                     </a>
					 &nbsp; <i class="fa fa-clock-o"></i> ' . $time . ' </span>
					 <span class="text-muted m-l-sm pull-right">
                    </header>
                    <div class="panel-body">
                     ' . $row->message . '
                    </div>
                   </section>
                  </article><!-- .message-end -->
                 </section>
                                
				 ';		
		
	}
	if ($clientid === $row->user_from) {
		
     $comList .= '
                 <section id="comment'.$row->id.'" class="comment-list block">
                  <article class="comment-item">
                   <a class="pull-left thumb-sm avatar">
                    <img src="../Client/' . $imagelocation_4 . '" class="img-circle" alt="...">
                   </a>
                   <span class="arrow left"></span>
                   <section class="comment-body panel panel-default bg-white">
                    <header class="panel-heading">
                     <a href="../client.php?a=overview&id='. $clientid .'" target="_blank">' . $name_4 . '
                     <label class="label bg-info m-left"> Client </label>
                     </a>
					 &nbsp; <i class="fa fa-clock-o"></i> ' . $time . ' </span>
					 <span class="text-muted m-l-sm pull-right">
                    </header>
                    <div class="panel-body">
                     ' . $row->message . '
                    </div>
                   </section>
                  </article><!-- .message-end -->
                 </section>
                 
				 ';		
	}
	 $x++;		 
   }
 }
	
}

 return $comList;	
}

function getDiscussion($freelancerid, $clientid) {
	$comList = '';
	$c_per_page = 2;
	
		
	
  $query = DB::getInstance()->get("message", "*", [	
   "ORDER" => "date_added DESC",
   "OR" => [
		"AND #first" => [
			"user_from" => $clientid,
			"user_to" => $freelancerid,
			"delete_remove" => 0,
			"disc" => 1
		],
		"AND #second" => [
			"user_from" => $freelancerid,
			"user_to" => $clientid,
			"delete_remove" => 0,
			"disc" => 1
		]
	]]);
 if($query->count()) {
    $x = 1;	
	 	 
	foreach($query->results() as $row) {


     $q3 = DB::getInstance()->get("freelancer", "*", ["freelancerid" => $freelancerid, "LIMIT" => 1]);
     if($q3->count()) {
		foreach($q3->results() as $r3) {
           $name_3 = $r3->name;
           $imagelocation_3 = $r3->imagelocation;
		}
	 }	
	 
     $q4 = DB::getInstance()->get("client", "*", ["clientid" => $clientid, "LIMIT" => 1]);
     if($q4->count()) {
		foreach($q4->results() as $r4) {
           $name_4 = $r4->name;
           $imagelocation_4 = $r4->imagelocation;
		}
	 }	 			
		
	// Time Ago
	$time = ago(strtotime($row->date_added));	
	
	if ($freelancerid === $row->user_from) {
		
		if($row->user_from == $clientid) { // If it's current username is the same with the current author
			$delete = '<a class="btn" onclick="delete_the('.$row->id.')" title="Delete Message"><i class="fa fa-trash-o"></i></a>';
		} else { // If the current username is not the same as the author
			$delete = '<a class="btn" onclick="report_the('.$row->id.', '.$clientid.')" title="Report Message"><i class="fa fa-flag"></i></a>';
		}		
		  
     $comList .= '
                 <section id="comment'.$row->id.'" class="comment-list block">
                  <article class="comment-item">
                   <a class="pull-left thumb-sm avatar">
                    <img src="../Freelancer/' . $imagelocation_3 . '" class="img-circle" alt="...">
                   </a>
                   <span class="arrow left"></span>
                   <section class="comment-body panel panel-default bg-white">
                    <header class="panel-heading">
                     <a href="../freelancer.php?a=overview&id=' . $freelancerid . '" target="_blank">' . $name_3 . ' 
                     <label class="label bg-danger m-left"> Freelancer </label></a>
					 &nbsp; <span class="text-center"><i class="fa fa-clock-o"></i> ' . $time . ' </span>
					 <span class="text-muted m-l-sm pull-right">
					  ' . $delete . '
                    </header>
                    <div class="panel-body">
                     ' . $row->message . '
                    </div>
                   </section>
                  </article><!-- .message-end -->
                 </section>
                                
				 ';		
		
	}
	if ($clientid === $row->user_from) {
		
		if($row->user_from == $clientid) { // If it's current username is the same with the current author
			$delete = '<a class="btn" onclick="delete_the('.$row->id.', '.$clientid.')" title="Delete Message"><i class="fa fa-trash-o"></i></a>';
		} else { // If the current username is not the same as the author
			$delete = '<a class="btn" onclick="report_the('.$row->id.', '.$clientid.')" title="Report Message"><i class="fa fa-flag"></i></a>';
		}		
	  
     $comList .= '
                 <section id="comment'.$row->id.'" class="comment-list block">
                  <article class="comment-item">
                   <a class="pull-left thumb-sm avatar">
                    <img src="../Client/' . $imagelocation_4 . '" class="img-circle" alt="...">
                   </a>
                   <span class="arrow left"></span>
                   <section class="comment-body panel panel-default bg-white">
                    <header class="panel-heading">
                     <a href="../client.php?a=overview&id=' . $clientid . '" target="_blank">' . $name_4 . ' 
                     <label class="label bg-info m-left"> Client </label></a>
					 &nbsp; <i class="fa fa-clock-o"></i> ' . $time . ' </span>
					 <span class="text-muted m-l-sm pull-right">
					  ' . $delete . '
                    </header>
                    <div class="panel-body">
                     ' . $row->message . '
                    </div>
                   </section>
                  </article><!-- .message-end -->
                 </section>
                 
				 ';		
	}
	 $x++;		 
   }
	
}

 return $comList;	
}

function getLastDiscussion($clientid, $freelancerid) {
	$Last = '';
  $query = DB::getInstance()->get("message", "*", ["LIMIT" => [0,1], "AND" => ["user_to" => $freelancerid, "user_from" => $clientid, "disc" => 1], "ORDER" => "id DESC"]);
 if($query->count()) {
    $x = 1;
	 	
	foreach($query->results() as $row) {
		
     $q3 = DB::getInstance()->get("client", "*", ["clientid" => $row->user_from, "LIMIT" => 1]);
     if($q3->count()) {
		foreach($q3->results() as $r3) {
           $name_3 = $r3->name;
           $imagelocation_3 = $r3->imagelocation;
		}
	 }		
	
	if($row->user_from == $clientid) { // If it's current username is the same with the current author
		$delete = '<a class="btn" onclick="delete_the('.$row->id.', '.$clientid.')" title="Delete Comment"><i class="fa fa-trash-o"></i></a>';
	} else { // If the current username is not the same as the author
			$delete = '<a class="btn" onclick="report_the('.$row->id.', '.$clientid.')" title="Report Message"><i class="fa fa-flag"></i></a>';
	}	
	
		// Time Ago
		$time = ago(strtotime($row->date_added));	
			
	  
          $Last .= '
          
                 <section id="comment'.$row->id.'" class="comment-list block">
                  <article class="comment-item">
                   <a class="pull-left thumb-sm avatar">
                    <img src="' . $imagelocation_3 . '" class="img-circle" alt="...">
                   </a>
                   <span class="arrow left"></span>
                   <section class="comment-body panel panel-default bg-white">
                    <header class="panel-heading">
                     <a href="../client.php?a=overview&id=' . $clientid . '" target="_blank">' . $name_3 . ' 
                     <label class="label bg-info m-left"> Client </label></a>
					 &nbsp; <i class="fa fa-clock-o"></i> ' . $time . ' </span>
					 <span class="text-muted m-l-sm pull-right">
					  ' . $delete . '
                    </header>
                    <div class="panel-body">
                     ' . $row->message . '
                    </div>
                   </section>
                  </article><!-- .message-end -->
                 </section>
                 
				 ';
	 $x++;		 
   }
	
}
	
 return $Last;	
 unset($Last);
}

function getDiscussionF($clientid, $freelancerid) {
	$comList = '';
	$c_per_page = 2;
	
		
	
  $query = DB::getInstance()->get("message", "*", [	
   "ORDER" => "date_added DESC",
   "OR" => [
		"AND #first" => [
			"user_from" => $clientid,
			"user_to" => $freelancerid,
			"delete_remove" => 0,
			"disc" => 1
		],
		"AND #second" => [
			"user_from" => $freelancerid,
			"user_to" => $clientid,
			"delete_remove" => 0,
			"disc" => 1
		]
	]]);
 if($query->count()) {
    $x = 1;	
	 	 
	foreach($query->results() as $row) {

 $q5 = DB::getInstance()->get("trash", "*", ["AND" => ["messageid" => $row->id, "userid" => $freelancerid], "LIMIT" => 1]);
 if ($q5->count() === 0) {
     
		
		
     $q3 = DB::getInstance()->get("freelancer", "*", ["freelancerid" => $freelancerid, "LIMIT" => 1]);
     if($q3->count()) {
		foreach($q3->results() as $r3) {
           $name_3 = $r3->name;
           $imagelocation_3 = $r3->imagelocation;
		}
	 }	
	 
     $q4 = DB::getInstance()->get("client", "*", ["clientid" => $clientid, "LIMIT" => 1]);
     if($q4->count()) {
		foreach($q4->results() as $r4) {
           $name_4 = $r4->name;
           $imagelocation_4 = $r4->imagelocation;
		}
	 }	 			
		
	// Time Ago
	$time = ago(strtotime($row->date_added));	
	
	if ($freelancerid === $row->user_from) {
		
		if($row->user_from == $freelancerid) { // If it's current username is the same with the current author
			$delete = '<a class="btn" onclick="delete_the('.$row->id.', '.$freelancerid.')" title="Delete Message"><i class="fa fa-trash-o"></i></a>';
		} else { // If the current username is not the same as the author
			$delete = '<a class="btn" onclick="report_the('.$row->id.', '.$freelancerid.')" title="Report Message"><i class="fa fa-flag"></i></a>';
		}		
		  
     $comList .= '
                 <section id="comment'.$row->id.'" class="comment-list block">
                  <article class="comment-item">
                   <a class="pull-left thumb-sm avatar">
                    <img src="../Freelancer/' . $imagelocation_3 . '" class="img-circle" alt="...">
                   </a>
                   <span class="arrow left"></span>
                   <section class="comment-body panel panel-default bg-white">
                    <header class="panel-heading">
                     <a href="../freelancer.php?a=overview&id=' . $freelancerid . '" target="_blank">' . $name_3 . ' 
                     <label class="label bg-danger m-left"> Freelancer </label>
                     </a>
					 &nbsp; <i class="fa fa-clock-o"></i> ' . $time . ' </span>
					 <span class="text-muted m-l-sm pull-right">
					  ' . $delete . '
                    </header>
                    <div class="panel-body">
                     ' . $row->message . '
                    </div>
                   </section>
                  </article><!-- .message-end -->
                 </section>
                                
				 ';		
		
	}
	if ($clientid === $row->user_from) {
		
		if($row->user_from == $freelancerid) { // If it's current username is the same with the current author
			$delete = '<a class="btn" onclick="delete_the('.$row->id.', '.$freelancerid.')" title="Delete Message"><i class="fa fa-trash-o"></i></a>';
		} else { // If the current username is not the same as the author
			$delete = '<a class="btn" onclick="report_the('.$row->id.', '.$freelancerid.')" title="Report Message"><i class="fa fa-flag"></i></a>';
		}		
	  
     $comList .= '
                 <section id="comment'.$row->id.'" class="comment-list block">
                  <article class="comment-item">
                   <a class="pull-left thumb-sm avatar">
                    <img src="../Client/' . $imagelocation_4 . '" class="img-circle" alt="...">
                   </a>
                   <span class="arrow left"></span>
                   <section class="comment-body panel panel-default bg-white">
                    <header class="panel-heading">
                     <a href="../client.php?a=overview&id=' . $clientid . '" target="_blank">' . $name_4 . '
                     <label class="label bg-info m-left"> Client </label>
                     </a>
					 &nbsp; <i class="fa fa-clock-o"></i> ' . $time . ' </span>
					 <span class="text-muted m-l-sm pull-right">
					  ' . $delete . '
                    </header>
                    <div class="panel-body">
                     ' . $row->message . '
                    </div>
                   </section>
                  </article><!-- .message-end -->
                 </section>
                 
				 ';		
	}
	 $x++;		 
   }
 }
	
}

 return $comList;	
}

function getLastDiscussionF($freelancerid, $clientid) {
	$Last = '';
  $query = DB::getInstance()->get("message", "*", ["LIMIT" => [0,1], "AND" => ["user_to" => $clientid, "user_from" => $freelancerid, "disc" => 1], "ORDER" => "id DESC"]);
 if($query->count()) {
    $x = 1;
	 	
	foreach($query->results() as $row) {
		
     $q3 = DB::getInstance()->get("freelancer", "*", ["freelancerid" => $row->user_from, "LIMIT" => 1]);
     if($q3->count()) {
		foreach($q3->results() as $r3) {
           $name_3 = $r3->name;
           $imagelocation_3 = $r3->imagelocation;
		}
	 }		
	
	if($row->user_from == $freelancerid) { // If it's current username is the same with the current author
		$delete = '<a class="btn" onclick="delete_the('.$row->id.', '.$freelancerid.')" title="Delete Comment"><i class="fa fa-trash-o"></i></a>';
	} else { // If the current username is not the same as the author
			$delete = '<a class="btn" onclick="report_the('.$row->id.', '.$freelancerid.')" title="Report Message"><i class="fa fa-flag"></i></a>';
	}	
	
		// Time Ago
		$time = ago(strtotime($row->date_added));	
			
	  
          $Last .= '
          
                 <section id="comment'.$row->id.'" class="comment-list block">
                  <article class="comment-item">
                   <a class="pull-left thumb-sm avatar">
                    <img src="' . $imagelocation_3 . '" class="img-circle" alt="...">
                   </a>
                   <span class="arrow left"></span>
                   <section class="comment-body panel panel-default bg-white">
                    <header class="panel-heading">
                     <a href="../freelancer.php?a=overview&id=' . $freelancerid . '" target="_blank">' . $name_3 . ' 
                     <label class="label bg-danger m-left"> Freelancer </label>
                     </a>
					 &nbsp; <i class="fa fa-clock-o"></i> ' . $time . ' </span>
					 <span class="text-muted m-l-sm pull-right">
					  ' . $delete . '
                    </header>
                    <div class="panel-body">
                     ' . $row->message . '
                    </div>
                   </section>
                  </article><!-- .message-end -->
                 </section>
                 
				 ';
	 $x++;		 
   }
	
}
	
 return $Last;	
 unset($Last);
}

function getCommentF($clientid, $freelancerid, $bugid) {
	$comList = '';
	$c_per_page = 2;
	
		
	
  $query = DB::getInstance()->get("message", "*", [	
   "ORDER" => "date_added DESC",
   "OR" => [
		"AND #first" => [
			"user_from" => $clientid,
			"user_to" => $freelancerid,
			"delete_remove" => 0,
			"bugid" => $bugid,
			"disc" => 2
		],
		"AND #second" => [
			"user_from" => $freelancerid,
			"user_to" => $clientid,
			"delete_remove" => 0,
			"bugid" => $bugid,
			"disc" => 2
		]
	]]);
 if($query->count()) {
    $x = 1;	
	 	 
	foreach($query->results() as $row) {

 $q5 = DB::getInstance()->get("trash", "*", ["AND" => ["messageid" => $row->id, "userid" => $freelancerid], "LIMIT" => 1]);
 if ($q5->count() === 0) {
     
		
		
     $q3 = DB::getInstance()->get("freelancer", "*", ["freelancerid" => $freelancerid, "LIMIT" => 1]);
     if($q3->count()) {
		foreach($q3->results() as $r3) {
           $name_3 = $r3->name;
           $imagelocation_3 = $r3->imagelocation;
		}
	 }	
	 
     $q4 = DB::getInstance()->get("client", "*", ["clientid" => $clientid, "LIMIT" => 1]);
     if($q4->count()) {
		foreach($q4->results() as $r4) {
           $name_4 = $r4->name;
           $imagelocation_4 = $r4->imagelocation;
		}
	 }	 			
		
	// Time Ago
	$time = ago(strtotime($row->date_added));	
	
	if ($freelancerid === $row->user_from) {
		
		if($row->user_from == $freelancerid) { // If it's current username is the same with the current author
			$delete = '<a class="btn" onclick="delete_the('.$row->id.', '.$freelancerid.')" title="Delete Message"><i class="fa fa-trash-o"></i></a>';
		} else { // If the current username is not the same as the author
			$delete = '<a class="btn" onclick="report_the('.$row->id.', '.$freelancerid.')" title="Report Message"><i class="fa fa-flag"></i></a>';
		}		
		  
     $comList .= '
                 <section id="comment'.$row->id.'" class="comment-list block">
                  <article class="comment-item">
                   <a class="pull-left thumb-sm avatar">
                    <img src="../Freelancer/' . $imagelocation_3 . '" class="img-circle" alt="...">
                   </a>
                   <span class="arrow left"></span>
                   <section class="comment-body panel panel-default bg-white">
                    <header class="panel-heading">
                     <a href="../freelancer.php?a=overview&id=' . $freelancerid . '" target="_blank">' . $name_3 . ' 
                     <label class="label bg-danger m-left"> Freelancer </label>
                     </a>
					 &nbsp; <i class="fa fa-clock-o"></i> ' . $time . ' </span>
					 <span class="text-muted m-l-sm pull-right">
					  ' . $delete . '
                    </header>
                    <div class="panel-body">
                     ' . $row->message . '
                    </div>
                   </section>
                  </article><!-- .message-end -->
                 </section>
                                
				 ';		
		
	}
	if ($clientid === $row->user_from) {
		
		if($row->user_from == $freelancerid) { // If it's current username is the same with the current author
			$delete = '<a class="btn" onclick="delete_the('.$row->id.', '.$freelancerid.')" title="Delete Message"><i class="fa fa-trash-o"></i></a>';
		} else { // If the current username is not the same as the author
			$delete = '<a class="btn" onclick="report_the('.$row->id.', '.$freelancerid.')" title="Report Message"><i class="fa fa-flag"></i></a>';
		}		
	  
     $comList .= '
                 <section id="comment'.$row->id.'" class="comment-list block">
                  <article class="comment-item">
                   <a class="pull-left thumb-sm avatar">
                    <img src="../Client/' . $imagelocation_4 . '" class="img-circle" alt="...">
                   </a>
                   <span class="arrow left"></span>
                   <section class="comment-body panel panel-default bg-white">
                    <header class="panel-heading">
                     <a href="../client.php?a=overview&id=' . $clientid . '" target="_blank">' . $name_4 . '
                     <label class="label bg-info m-left"> Client </label>
                     </a>
					 &nbsp; <i class="fa fa-clock-o"></i> ' . $time . ' </span>
					 <span class="text-muted m-l-sm pull-right">
					  ' . $delete . '
                    </header>
                    <div class="panel-body">
                     ' . $row->message . '
                    </div>
                   </section>
                  </article><!-- .message-end -->
                 </section>
                 
				 ';		
	}
	 $x++;		 
   }
 }
	
}

 return $comList;	
}

function getLastCommentF($freelancerid, $clientid , $bugid) {
	$Last = '';
  $query = DB::getInstance()->get("message", "*", ["LIMIT" => [0,1], "AND" => ["user_to" => $clientid, "user_from" => $freelancerid, "bugid" => $bugid, "disc" => 2], "ORDER" => "id DESC"]);
 if($query->count()) {
    $x = 1;
	 	
	foreach($query->results() as $row) {
		
     $q3 = DB::getInstance()->get("freelancer", "*", ["freelancerid" => $row->user_from, "LIMIT" => 1]);
     if($q3->count()) {
		foreach($q3->results() as $r3) {
           $name_3 = $r3->name;
           $imagelocation_3 = $r3->imagelocation;
		}
	 }		
	
	if($row->user_from == $freelancerid) { // If it's current username is the same with the current author
		$delete = '<a class="btn" onclick="delete_the('.$row->id.', '.$freelancerid.')" title="Delete Comment"><i class="fa fa-trash-o"></i></a>';
	} else { // If the current username is not the same as the author
			$delete = '<a class="btn" onclick="report_the('.$row->id.', '.$freelancerid.')" title="Report Message"><i class="fa fa-flag"></i></a>';
	}	
	
		// Time Ago
		$time = ago(strtotime($row->date_added));	
			
	  
          $Last .= '
          
                 <section id="comment'.$row->id.'" class="comment-list block">
                  <article class="comment-item">
                   <a class="pull-left thumb-sm avatar">
                    <img src="' . $imagelocation_3 . '" class="img-circle" alt="...">
                   </a>
                   <span class="arrow left"></span>
                   <section class="comment-body panel panel-default bg-white">
                    <header class="panel-heading">
                     <a href="../freelancer.php?a=overview&id=' . $freelancerid . '" target="_blank">' . $name_3 . ' 
                     <label class="label bg-danger m-left"> Freelancer </label>
                     </a>
					 &nbsp; <i class="fa fa-clock-o"></i> ' . $time . ' </span>
					 <span class="text-muted m-l-sm pull-right">
					  ' . $delete . '
                    </header>
                    <div class="panel-body">
                     ' . $row->message . '
                    </div>
                   </section>
                  </article><!-- .message-end -->
                 </section>
                 
				 ';
	 $x++;		 
   }
	
}
	
 return $Last;	
 unset($Last);
}

function getComment($freelancerid, $clientid, $bugid) {
	$comList = '';
	$c_per_page = 2;
	
		
	
  $query = DB::getInstance()->get("message", "*", [	
   "ORDER" => "date_added DESC",
   "OR" => [
		"AND #first" => [
			"user_from" => $clientid,
			"user_to" => $freelancerid,
			"delete_remove" => 0,
			"bugid" => $bugid,
			"disc" => 2
		],
		"AND #second" => [
			"user_from" => $freelancerid,
			"user_to" => $clientid,
			"delete_remove" => 0,
			"bugid" => $bugid,
			"disc" => 2
		]
	]]);
 if($query->count()) {
    $x = 1;	
	 	 
	foreach($query->results() as $row) {

 $q5 = DB::getInstance()->get("trash", "*", ["AND" => ["messageid" => $row->id, "userid" => $freelancerid], "LIMIT" => 1]);
 if ($q5->count() === 0) {
     
		
		
     $q3 = DB::getInstance()->get("freelancer", "*", ["freelancerid" => $freelancerid, "LIMIT" => 1]);
     if($q3->count()) {
		foreach($q3->results() as $r3) {
           $name_3 = $r3->name;
           $imagelocation_3 = $r3->imagelocation;
		}
	 }	
	 
     $q4 = DB::getInstance()->get("client", "*", ["clientid" => $clientid, "LIMIT" => 1]);
     if($q4->count()) {
		foreach($q4->results() as $r4) {
           $name_4 = $r4->name;
           $imagelocation_4 = $r4->imagelocation;
		}
	 }	 			
		
	// Time Ago
	$time = ago(strtotime($row->date_added));	
	
	if ($freelancerid === $row->user_from) {
		
		if($row->user_from == $clientid) { // If it's current username is the same with the current author
			$delete = '<a class="btn" onclick="delete_the('.$row->id.', '.$clientid.')" title="Delete Message"><i class="fa fa-trash-o"></i></a>';
		} else { // If the current username is not the same as the author
			$delete = '<a class="btn" onclick="report_the('.$row->id.', '.$clientid.')" title="Report Message"><i class="fa fa-flag"></i></a>';
		}		
		  
     $comList .= '
                 <section id="comment'.$row->id.'" class="comment-list block">
                  <article class="comment-item">
                   <a class="pull-left thumb-sm avatar">
                    <img src="../Freelancer/' . $imagelocation_3 . '" class="img-circle" alt="...">
                   </a>
                   <span class="arrow left"></span>
                   <section class="comment-body panel panel-default bg-white">
                    <header class="panel-heading">
                     <a href="../freelancer.php?a=overview&id=' . $freelancerid . '" target="_blank">' . $name_3 . ' 
                     <label class="label bg-danger m-left"> Freelancer </label>
                     </a>
					 &nbsp; <i class="fa fa-clock-o"></i> ' . $time . ' </span>
					 <span class="text-muted m-l-sm pull-right">
					  ' . $delete . '
                    </header>
                    <div class="panel-body">
                     ' . $row->message . '
                    </div>
                   </section>
                  </article><!-- .message-end -->
                 </section>
                                
				 ';		
		
	}
	if ($clientid === $row->user_from) {
		
		if($row->user_from == $clientid) { // If it's current username is the same with the current author
			$delete = '<a class="btn" onclick="delete_the('.$row->id.', '.$clientid.')" title="Delete Message"><i class="fa fa-trash-o"></i></a>';
		} else { // If the current username is not the same as the author
			$delete = '<a class="btn" onclick="report_the('.$row->id.', '.$clientid.')" title="Report Message"><i class="fa fa-flag"></i></a>';
		}		
	  
     $comList .= '
                 <section id="comment'.$row->id.'" class="comment-list block">
                  <article class="comment-item">
                   <a class="pull-left thumb-sm avatar">
                    <img src="../Client/' . $imagelocation_4 . '" class="img-circle" alt="...">
                   </a>
                   <span class="arrow left"></span>
                   <section class="comment-body panel panel-default bg-white">
                    <header class="panel-heading">
                     <a href="../client.php?a=overview&id='. $clientid .'" target="_blank">' . $name_4 . '
                     <label class="label bg-info m-left"> Client </label>
                     </a>
					 &nbsp; <i class="fa fa-clock-o"></i> ' . $time . ' </span>
					 <span class="text-muted m-l-sm pull-right">
					  ' . $delete . '
                    </header>
                    <div class="panel-body">
                     ' . $row->message . '
                    </div>
                   </section>
                  </article><!-- .message-end -->
                 </section>
                 
				 ';		
	}
	 $x++;		 
   }
 }
	
}

 return $comList;	
}

function getLastComment($clientid, $freelancerid, $bugid) {
	$Last = '';
  $query = DB::getInstance()->get("message", "*", ["LIMIT" => [0,1], "AND" => ["user_to" => $freelancerid, "user_from" => $clientid, "bugid" => $bugid, "disc" => 2], "ORDER" => "id DESC"]);
 if($query->count()) {
    $x = 1;
	 	
	foreach($query->results() as $row) {
		
     $q3 = DB::getInstance()->get("client", "*", ["clientid" => $row->user_from, "LIMIT" => 1]);
     if($q3->count()) {
		foreach($q3->results() as $r3) {
           $name_3 = $r3->name;
           $imagelocation_3 = $r3->imagelocation;
		}
	 }			
	
	if($row->user_from == $clientid) { // If it's current username is the same with the current author
		$delete = '<a class="btn" onclick="delete_the('.$row->id.', '.$clientid.')" title="Delete Comment"><i class="fa fa-trash-o"></i></a>';
	} else { // If the current username is not the same as the author
			$delete = '<a class="btn" onclick="report_the('.$row->id.', '.$clientid.')" title="Report Message"><i class="fa fa-flag"></i></a>';
	}	
	
		// Time Ago
		$time = ago(strtotime($row->date_added));	
			
	  
          $Last .= '
          
                 <section id="comment'.$row->id.'" class="comment-list block">
                  <article class="comment-item">
                   <a class="pull-left thumb-sm avatar">
                    <img src="' . $imagelocation_3 . '" class="img-circle" alt="...">
                   </a>
                   <span class="arrow left"></span>
                   <section class="comment-body panel panel-default bg-white">
                    <header class="panel-heading">
                     <a href="../client.php?a=overview&id='. $clientid .'" target="_blank">' . $name_3 . ' 
                     <label class="label bg-info m-left"> Client </label>
                     </a>
					 &nbsp; <i class="fa fa-clock-o"></i> ' . $time . ' </span>
					 <span class="text-muted m-l-sm pull-right">
					  ' . $delete . '
                    </header>
                    <div class="panel-body">
                     ' . $row->message . '
                    </div>
                   </section>
                  </article><!-- .message-end -->
                 </section>
                 
				 ';
	 $x++;		 
   }
	
}
	
 return $Last;	
 unset($Last);
}
?>