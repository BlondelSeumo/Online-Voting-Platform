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
     <div class="tr-profile section-padding">
    <div class="container">
     <div class="row">
      <div class="col-sm-4 col-md-3">
      	
     <!-- Include sidenav.php. Contains navigation content. -->
 	 <?php include ('template/sidenav.php'); ?> 
 	         
      </div>
      <div class="col-sm-8 col-md-9">
       <div class="tab-content">   



      <div role="tabpanel" class="tab-pane fade in active how" id="how"> 

       <div class="section how-to">
         <h3>How to use this Voting Platform</h3>
       <ul>
        <li> - Admin adds an Organization e.g Harvard Campus Election</li>
        <li> - Admin then adds the Positions in that Organization.</li>
        <li> - Admin then adds Nominees for those Positions</li>
        <li> - Then the Voters vote.</li>
       </ul>
       
       </div><!-- /.how-to -->     
      
      </div><!-- /.tab-pane -->          
            
          </div>
              </div>
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