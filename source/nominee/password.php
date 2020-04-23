<?php 
 require_once(__DIR__ .'/../core/frontinit.php');
 
//Start new User object
$user = new User();

//Check user if is Logged In
if (!$user->isLoggedIn()) {
  Redirect::to($web->url.'login');	
}



/*Edit Password Data*/
if(isset($_POST['register'])){
if (Input::exists()) {
  if (Token::check(Input::get('token'))) {
 
 	$errorHandler = new ErrorHandler;
	
	$validator = new Validator($errorHandler);
	
	$validation = $validator->check($_POST, [
	  'password_current' => [
	     'required' => true,
	     'maxlength' => 300
	  ],
	   'password_new' => [
	     'required' => true,
	     'minlength' => 6
	   ],
	   'password_new_again' => [
	     'required' => true,
	     'match' => 'password_new'
	   ]
	]);
		 
    if (!$validation->fails()) {
  	
		if (Hash::make(Input::get('password_current'), $user->data()->salt) !== $user->data()->password) {
			$hasError = true;
		} else {
		  $salt = Hash::salt(32);
		  $user->update([
		    'password' => Hash::make(Input::get('password_new'), $salt),
		    'salt' => $salt
		  ],[
		    'userid' => $user->data()->userid
		  ]);
		  
		  $passError = true;
		 
		}
      
	 } else {
     $error = '';
     foreach ($validation->errors()->all() as $err) {
     	$str = implode(" ",$err);
     	$error .= '
	           <div class="alert alert-danger fade in">
	            <a href="#" class="close" data-dismiss="alert">&times;</a>
	            <strong>Error!</strong> '.$str.'
		       </div>
		       ';
     }
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
		 	
		  <?php if (isset($error)) {
			  echo $error;
		  } ?> 
	
		  <?php if(isset($passError) && $passError == true) { //If email is sent ?>
		   <div class="alert alert-success fade in">
		   <a href="#" class="close" data-dismiss="alert">&times;</a>
		   <strong>Success!</strong> You have successfully changed your password.</strong>.
		   </div>
		  <?php } ?>
       

      
           <div class="section drivers-job">
        <h3><?php echo $lang->change_change; ?> <?php echo $lang->password; ?></h3>
       
       <form role="form" method="post">

        <div class="box-body">
        
        <div class="form-group">
          <label for="Old Password"><?php echo $lang->current; ?> <?php echo $lang->password; ?></label>
          <input type="password" name="password_current" class="form-control" placeholder="<?php echo $lang->current; ?> <?php echo $lang->password; ?>">
        </div>
        
        <div class="form-group">
          <label for="New Password"><?php echo $lang->new; ?> <?php echo $lang->password; ?></label>
          <input type="password" name="password_new" class="form-control" placeholder="<?php echo $lang->new; ?> <?php echo $lang->password; ?>">
        </div>
        
        <div class="form-group">
          <label for="Confirm Password"><?php echo $lang->confirm; ?> <?php echo $lang->password; ?></label>
          <input type="password" name="password_new_again" class="form-control" placeholder="<?php echo $lang->confirm; ?> <?php echo $lang->password; ?>">
        </div>
        
         </div><!-- box-body -->  

        <div class="box-footer">
         <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />
        <button type="submit" name="register" class="kafe-btn kafe-btn-mint full-width"><?php echo $lang->submit; ?></button>
        </div>        
       
       </form>            
       </div><!-- /.resume-update -->      
      
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