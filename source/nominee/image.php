<?php 
 require_once(__DIR__ .'/../core/frontinit.php');
 
//Start new User object
$user = new User();

//Check user if is Logged In
if (!$user->isLoggedIn()) {
  Redirect::to($web->url.'login');	
}

/*Edit Image Data*/
if(isset($_POST['picture'])){
if (Input::exists()) {
  if (Token::check(Input::get('token'))) {
  	
	$path = 'uploads/';
	$path_new = 'source/nominee/uploads/';
    $valid_formats = array("jpg", "png", "gif", "bmp");
   
    $name = $_FILES['photoimg']['name'];
    $size = $_FILES['photoimg']['size'];

    if(strlen($name))
	{
	  list($txt, $ext) = explode(".", $name);
      if(in_array($ext,$valid_formats) && $size<(1400*1400))
	   {
	     $actual_image_name = time().substr($txt, 5).".".$ext;
		 $image_name = $actual_image_name;
		 $newname=$path.$image_name;
         $tmp = $_FILES['photoimg']['tmp_name'];
         if(move_uploaded_file($tmp, $path_new.$actual_image_name))
	      {
	       if ($user->data()->imagelocation !== 'uploads/default.png') {
				unlink('source/nominee/'.$user->data()->imagelocation);
				
		      	$user->update([
			    'imagelocation' => $newname
			    ],[
			    'userid' => $user->data()->userid
			    ]);
			
				$noError = true;	 
		   } else {
				   	
				$user->update([
			    'imagelocation' => $newname
			    ],[
			    'userid' => $user->data()->userid
			    ]);
				$noError = true;
		   }  		  
					
	      }else{
		   $imageError = true;	
     	  }
       }else{
       	  $formatError = true;				
	   }
      }else{
      	  $selectError = true;
      }	
  	
  }
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
     <div class="tr-profile section-padding">
    <div class="container">
     <div class="row">
      <div class="col-sm-4 col-md-3">
      	
     <!-- Include sidenav.php. Contains navigation content. -->
 	 <?php include ('template/sidenav.php'); ?> 
 	           
      </div>
      <div class="col-sm-8 col-md-9">
       <div class="tab-content">      



      <div role="tabpanel" class="tab-pane fade in active profile" id="profile">
      	
		 <?php if(isset($selectError)) { //If errors are found ?>
	       <div class="alert alert-danger fade in">
	        <a href="#" class="close" data-dismiss="alert">&times;</a>
	        <strong>Error!</strong> Please select image..! Please try again.
		   </div>
	      <?php } ?>
	      
		 <?php if(isset($formatError)) { //If errors are found ?>
	       <div class="alert alert-danger fade in">
	        <a href="#" class="close" data-dismiss="alert">&times;</a>
	        <strong>Error!</strong> Invalid file formats..! Please try again.
		   </div>
	      <?php } ?>
	      
		 <?php if(isset($imageError)) { //If errors are found ?>
	       <div class="alert alert-danger fade in">
	        <a href="#" class="close" data-dismiss="alert">&times;</a>
	        <strong>Error!</strong> Failed to upload Image. Please try again.
		   </div>
	      <?php } ?>
		 	
		  <?php if (isset($error)) {
			  echo $error;
		  } ?>
	        
	      <?php if(isset($hasError)) { //If errors are found ?>
	       <div class="alert alert-danger fade in">
	        <a href="#" class="close" data-dismiss="alert">&times;</a>
	        <strong>Error!</strong> Your current password is wrong.
		   </div>
	      <?php } ?>
	
		  <?php if(isset($noError) && $noError == true) { //If email is sent ?>
		   <div class="alert alert-success fade in">
		   <a href="#" class="close" data-dismiss="alert">&times;</a>
		   <strong>Success!</strong> You have successfully changed your Profile Image.</strong>.
		   </div>
		  <?php } ?>
       
       <div class="section profile-pic">
       	
       
       <form role="form" method="post" enctype="multipart/form-data">
       
        <div class="change-photo">
       <div class="user-image">
          <img src="<?php 
					  if (isset($_POST['picture'])) {
						 echo $web->url; ?>source/nominee/<?php echo escape($newname); 
					  } else {
					  echo $web->url; ?>source/nominee/<?php echo escape($user->data()->imagelocation); 
					  } ?>" alt="Image" class="img-responsive">
       </div>
       <div style="position:relative;">
        <a class='kafe-btn kafe-btn-mint-small' href='javascript:;'>
        <?php echo $lang->change_change; ?> <?php echo $lang->image; ?>...
        <input type="file" name="photoimg" id="photoimg" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="file_source" size="40"  onchange='$("#upload-file-info").html($(this).val());'>
        <input type="hidden" name="image_name" id="image_name"/>
        </a>
        &nbsp;
        <span class='label label-info' id="upload-file-info"></span>
      </div>
        </div><!-- /.change-photo -->

        <div class="box-footer">
          <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />
        <button type="submit" name="picture" class="kafe-btn kafe-btn-mint full-width"><?php echo $lang->submit; ?></button>
        </div> 
        
       </form>  
        
           </div><!-- /.section -->   

      
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