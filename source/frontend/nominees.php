<?php 
 require_once(__DIR__ .'/../core/frontinit.php');
 
//Getting freelancer Data
$organizationid = $_GET['id'];
$qs = DB::getInstance()->get("position", "*", ["AND" => ["organizationid" => $organizationid]]);
if ($qs->count()) {
 foreach($qs->results() as $rs) {
 }
}else {
  Redirect::to($web->url.'home');
}

$qo = DB::getInstance()->get("organization", "*", ["AND" => ["organizationid" => $organizationid]]);
if ($qo->count()) {
 foreach($qo->results() as $ro) {
 }
}

?>
<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en"> 
<!--<![endif]-->
<head>
	
    <!-- Include header.php. Contains header content. -->
    <?php include ('template/header.php'); ?> 
    
</head>
<body>
	
     <!-- Include navigation.php. Contains navigation content. -->
 	 <?php include ('template/navigation.php'); ?> 
 	 
  
	

     <!-- ==============================================
	 Dashboard Section
	 =============================================== -->
     <div class="featured-users">
	  <div class="container">
	   <div class="row">
			<div class="section-title" style="padding-top: 20px;">
				<h1><?php echo $lang->organization; ?> :- <?php echo $ro->name; ?></h1>
			</div>
	   
		  <?php
	
		  $query = DB::getInstance()->get("position", "*",["organizationid" => $rs->organizationid]);		  

		 if($query->count()) {
		 	
		 	
          /*
            Start with variables to help with row creation;
          */
            $startRow = true;
            $postCounter = 0;
		    $messageList = '';
		    $x = 1;
			foreach($query->results() as $row) {
				
				
             $q1 = DB::getInstance()->get("user", "*", ["AND" => ["positionid" => $row->positionid]]);
             if($q1->count()) {
				foreach($q1->results() as $r1) {
					
             $q2 = DB::getInstance()->get("organization", "*", ["AND" => ["organizationid" => $r1->organizationid]]);
             if($q2->count()) {
				foreach($q2->results() as $r2) {
				}
			 }			
					
             $q3 = DB::getInstance()->get("position", "*", ["AND" => ["positionid" => $r1->positionid]]);
             if($q3->count()) {
				foreach($q3->results() as $r3) {
				}
			 }	
			 
             $q4 = DB::getInstance()->get("votes", "*", ["AND" => ["nomineeid" => $r1->userid]]);
             $votes = $q4->count();
			  	
			$blurb = truncateHtml($r1->describe_yourself, 400);				
				
		    $messageList = '';
			/*
              Check whether we need to add the start of a new row.
              If true, echo a div with the "row" class and set the startRow variable to false 
              If false, do nothing. 
            */
            if ($startRow) {
              echo '<!-- START OF INTERNAL ROW --><div class="row">';
              $startRow = false;
            } 
            /* Add one to the counter because a new post is being added to your page.  */ 
              $postCounter += 1; 
		    echo $messageList .= '
	   
	   <div class="col-lg-4">	
	    <span id="comment'. $r1->userid .'"></span>
				  
         <div class="text-center card-box">
		  <div class="clearfix"></div>
		  <div class="member-card">
		   <div class="thumb-xl member-thumb m-b-10 center-block">
		    <img src="'. $web->url .'source/nominee/'. $r1->imagelocation .'" class="img-circle img-thumbnail" alt="profile-image">
			<i class="mdi mdi-star-circle member-star text-success" title="verified user"></i>
		   </div>

		   <div class="">
			<h4 class="m-b-5">'. $r1->name .'</h4>
			<p class="text-danger"><i class="fa fa-thumbs-o-up"></i> '. $votes .' '. $lang->votes .'</p> 
			<p class="text-mint"><span class="text-mint"> '. $r2->name .'</span></p>  
			<p> <span><span class="text-muted">'. $lang->running .' '. $lang->to_to .' '. $lang->be .': </span><span class="text-mint">'. $r3->name .'</span> </span></p>
		   </div>

			'. $blurb .'
		   <a href="'. $web->url .'manifesto/'. $r1->userid .'" class="kafe-btn kafe-btn-mint-small"><i class="fa fa-user-secret" aria-hidden="true"></i> '. $lang->view .' '. $lang->manifesto .'</a>
		   <a onclick="vote('. $r1->userid .','. $r1->organizationid .','. $r1->positionid .')" class="kafe-btn kafe-btn-danger-small"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> '. $lang->vote .'</a>
		  </div>
		 </div>
	   </div><!-- /.col-lg-4 -->
					 ';
				
             unset($messageList);	 
			 $x++;		
			
            /*
            Check whether the counter has hit 3 posts.  
            If true, close the "row" div.  Also reset the $startRow variable so that before the next post, a new "row" div is being created. Finally, reset the counter to track the next set of three posts.
            If false, do nothing. 
            */
            if ( 3 === $postCounter ) {
                echo '</div><!-- END OF INTERNAL ROW -->';
                $startRow = true;
                $postCounter = 0;
            } 
			
				}
			 }else {
		 echo $messageList = '<p>No Content Available.</p>';
		 unset($messageList);
		}
			
			
            }
		}
       ?>
	        </div><!-- /.row -->
	    </div><!-- /.container -->
	</div>	 	 
	 
     <!-- Include footer.php. Contains footer content. -->
 	 <?php include ('template/footer.php'); ?> 

	 
	 <!-- ==============================================
	 Scripts
	 =============================================== -->
	<script src="<?php echo $web->url; ?>source/assets/js/jquery-3.2.1.min.js"></script>
	<script src="<?php echo $web->url; ?>source/assets/js/bootstrap.min.js"></script>
	<script src="<?php echo $web->url; ?>source/assets/js/debunk.js"></script>
	<script type="text/javascript">	
	function vote(nomineeid,organizationid,positionid) {
		// id = unique id of the message/comment
		// type = type of post: message/comment

		$.ajax({
			type: "POST",
			url: "<?php echo $web->url; ?>source/frontend/template/requests/vote.php",
			data: "nomineeid="+nomineeid+"&organizationid="+organizationid+"&positionid="+positionid, 
			cache: false,
			success: function(html) {
				$('#comment'+nomineeid).html('<div class="message-reported">'+html+'</div>');
			}
		});
	}		 
	</script>
     
	 <script>	
		/*============================================
		Change Language
		==============================================*/
	 
		function changelanguage(languageid) {
			// id = unique id of the message/comment
			// type = type of post: message/comment
	
			$.ajax({
				type: "POST",
				url: "<?php echo $web->url; ?>source/admin/template/requests/changelanguage.php",
				data: "languageid="+languageid, 
				cache: false,
				success: function(html) {
					window.location.reload();
				}
			});
		}		
	</script>   
 	 
 	 <?php echo $web->google_analytics; ?> 	
 	 
 	 
</body>
</html>