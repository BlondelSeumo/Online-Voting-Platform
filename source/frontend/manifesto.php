<?php 
 require_once(__DIR__ .'/../core/frontinit.php');
 
//Getting freelancer Data
$userid = $_GET['id'];
$qs = DB::getInstance()->get("user", "*", ["AND" => ["userid" => $userid]]);
if ($qs->count()) {
 foreach($qs->results() as $rs) {
 }
}else {
  Redirect::to($web->url.'home');
}

 $q2 = DB::getInstance()->get("organization", "*", ["AND" => ["organizationid" => $rs->organizationid]]);
 if($q2->count()) {
	foreach($q2->results() as $r2) {
	}
 }			
		
 $q3 = DB::getInstance()->get("position", "*", ["AND" => ["positionid" => $rs->positionid]]);
 if($q3->count()) {
	foreach($q3->results() as $r3) {
	}
 }
 
 $q4 = DB::getInstance()->get("votes", "*", ["AND" => ["nomineeid" => $userid]]);
 $votes = $q4->count();


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
	 Feautured Car Section
	 =============================================== -->
     <section class="featured-users">	
      <div class="container">
	  
		<div class="section-title" style="padding-top: 20px;">
		 <h1><?php echo $lang->profile; ?></h1>
		</div>

	   <div class="row"> 
        <div class="card-box-profile">
	     <div class="col-lg-10 col-md-10 col-lg-offset-1 col-md-offset-1">
		  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		   <img src="<?php echo $web->url; ?>source/nominee/<?php echo escape($rs->imagelocation); ?>" class="img-circle img-thumbnail"/>
		  </div><!-- .col-lg-3 -->
		  <div class="col-lg-9 col-md-9 col-sm-6 col-xs-12">
		   <h3><?php echo escape($rs->name); ?></h3>
		   <p> <?php echo $lang->organization; ?>: <span class="text-mint"><?php echo escape($r2->name); ?></span></p>
		   <p> <?php echo $lang->running; ?> <?php echo $lang->to_to; ?> <?php echo $lang->be; ?>: <span class="text-mint"><?php echo escape($r3->name); ?></span></p>
		   <p class="text-danger"><i class="fa fa-thumbs-o-up"></i> <?php echo escape($votes); ?> <?php echo $lang->votes; ?></p>
		  </div><!-- .col-lg-9 -->
	     </div><!-- .col-lg-10 -->
		</div><!-- .card-box-profile --> 
       </div><!-- .row -->	  
	   
      </div><!-- .container -->	
     </section>
	 

     <!-- ==============================================
	 Post Section
	 =============================================== -->
     <section class="post-details" style="padding-top: 0px !important;">
	  <div class="container">
	   <div class="row">
	    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
		 <div class="card-box-profile-details">

		   <div class="section description-profile">
		   
		    <ul class="tr-list resume-info">
			
             <li class="personal-details">
			  <div class="icon">
			   <i class="fa fa-user-secret" aria-hidden="true"></i>
			  </div>
			  <div class="media-body">
			   <span class="tr-title"><?php echo $lang->personal; ?> <?php echo $lang->details_details; ?></span>
			   <ul class="tr-list">
				<li><span class="left"><?php echo $lang->full; ?> <?php echo $lang->name; ?></span><span class="middle">:</span> <span class="right"><?php echo escape($rs->name); ?></span></li>
				<li><span class="left"><?php echo $lang->email; ?></span><span class="middle">:</span> <span class="right"><?php echo escape($rs->email); ?></span></li>
			   </ul>							    	
			  </div>
		     </li><!-- /.personal-details-->			
		   
             <li class="career-objective">
			  <div class="icon">
			   <i class="fa fa-black-tie" aria-hidden="true"></i>
			  </div>  
			  <div class="media-body">
			   <span class="tr-title"><?php echo $lang->describe_describe; ?> <?php echo $lang->yourself; ?></span>
			  <?php echo $rs->describe_yourself; ?>
			  </div>
		     </li><!-- /.career-objective-->			
		   
             <li class="work-history">
			  <div class="icon">
			   <i class="fa fa-briefcase" aria-hidden="true"></i>
			  </div>  
			  <div class="media-body">
			   <span class="tr-title"><?php echo $lang->manifesto; ?></span>
			  <?php echo $rs->manifesto; ?>
			  </div>
		     </li><!-- /.career-objective-->	
			 
            </ul><!-- /.ul -->			
			 
		   </div><!-- /.how-to -->	
						
		  <div class="share-links">
		   <h3><?php echo $lang->share; ?> <?php echo $lang->this; ?></h3>
		   
		   <?php 
			 $ShareUrl = urlencode("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
			 $Media = 'http://2.bp.blogspot.com/-nr1K0W-Zqi0/U_4lUoyvvVI/AAAAAAAABJE/F_C7i48sI58/s1600/new2.png';
			?>
		   <a class="share-facebook" onclick="shareinsocialmedia('https://www.facebook.com/sharer/sharer.php?u=<?php echo $ShareUrl;?>&title=<?php echo $rs->name; ?>')" href="" title="Share this post on Facebook">
		    <i class="fa fa-facebook"></i>
		   </a>
		   <a class="share-twitter" onclick="shareinsocialmedia('http://twitter.com/home?status=<?php echo $rs->name; ?>+<?php echo $ShareUrl; ?>')" href="">
		    <i class="fa fa-twitter"></i>
		   </a>
		   <a class="share-pinterest" onclick="shareinsocialmedia('http://www.linkedin.com/shareArticle?mini=true&url=<?php echo $ShareUrl; ?>&title=<?php echo $rs->name; ?>')" href="">
		    <i class="fa fa-linkedin"></i>
		   </a>
		  </div><!-- .share-links -->
				
		</div><!-- .card-box-profile-details -->	
       </div><!-- .col-lg-9 -->
	   
	    <div class="col-lg-3 col-md-3 col-sm-8 col-xs-12">
		
	   <?php 
		 $ShareUrl = urlencode("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
		 $Media = 'http://2.bp.blogspot.com/-nr1K0W-Zqi0/U_4lUoyvvVI/AAAAAAAABJE/F_C7i48sI58/s1600/new2.png';
		?>
			
		 <div class="list">
		  <div class="list-group">
           <span class="list-group-item active cat-top">
            <em class="fa fa-fw fa-location-arrow"></em>&nbsp;&nbsp;&nbsp;<?php echo $lang->share; ?> <?php echo $lang->profile; ?>
		   </span>
			<a class="list-group-item cat-list" onclick="shareinsocialmedia('https://www.facebook.com/sharer/sharer.php?u=<?php echo $ShareUrl;?>&title=<?php echo $rs->name; ?>')" href="">
			<em class="fa fa-fw fa-facebook"></em>&nbsp;&nbsp;&nbsp;Facebook
			</a>
			<a class="list-group-item cat-list" onclick="shareinsocialmedia('http://twitter.com/home?status=<?php echo $rs->name; ?>+<?php echo $ShareUrl; ?>')" href="">
			<em class="fa fa-fw fa-twitter"></em>&nbsp;&nbsp;&nbsp;Twitter
			</a>
			<a class="list-group-item cat-list" onclick="shareinsocialmedia('http://www.linkedin.com/shareArticle?mini=true&url=<?php echo $ShareUrl; ?>&title=<?php echo $rs->name; ?>')" href="">
			<em class="fa fa-fw fa-linkedin"></em>&nbsp;&nbsp;&nbsp;LinkedIn
			</a>						
          </div><!-- /.list-group -->
		 </div><!-- /.list --> 
	   
      </div><!-- .row -->	  
	 </div><!-- .container -->
    </section>	 	 
	 
     <!-- Include footer.php. Contains footer content. -->
 	 <?php include ('template/footer.php'); ?> 

	 
	 <!-- ==============================================
	 Scripts
	 =============================================== -->
	<script src="<?php echo $web->url; ?>source/assets/js/jquery-3.2.1.min.js"></script>
	<script src="<?php echo $web->url; ?>source/assets/js/bootstrap.min.js"></script>
	<script src="<?php echo $web->url; ?>source/assets/js/debunk.js"></script>
	<script type="text/javascript" async >
	    function shareinsocialmedia(url){
	    window.open(url,'sharein','toolbar=0,status=0,width=648,height=395');
	    return true;
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