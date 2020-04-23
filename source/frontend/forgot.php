<?php
//Check if init.php exists
 require_once(__DIR__ .'/../core/frontinit.php');

//Send Email to Reset Password Function
if (Input::exists()) {
 if(Token::check(Input::get('token'))){
	 	
	$errorHandler = new ErrorHandler;
	
	$validator = new Validator($errorHandler);
	
	$validation = $validator->check($_POST, [
	  'email' => [
	     'required' => true,
	     'maxlength' => 255,
	     'email' => true
	   ]
	]);
	 	
	  if (!$validation->fails()) {
	  	

		  	$user = new User();
			  
			$qs = DB::getInstance()->get("user", "*", ["email" => Input::get('email')]);
			if ($qs->count()) {
	         	foreach($qs->results() as $rs) {
	            }
				
				$token = Token::generate(); 
				$studentUpdate = DB::getInstance()->update('user',[
				    'tokencode' => $token
				],[
				    'userid' => $rs->userid
				  ]);
				
			    $id = base64_encode($rs->userid);
                $test = $_SERVER['HTTP_HOST'];
				$email = Input::get('email');
				$title = $web->sitename;
				$smail = $web->smail;
				$smailpass = $web->smailpass;
				$message= "
					   <p>Hello , $email</p>
					   <br /><br />
					   <p>We got requested to reset your password, if you do this then just click the following link to reset your password, if not just ignore this email,</p>
					   <br />
					   <p>Click Following Link To Reset Your Password</p> 
					   <br />
					   <a href='". $web->url ."reset/$id/$token'>click here to reset your password</a>
					   <br /><br />
					   thank you :)
					   ";
			    $subject = "Password Reset";
				
			    sendMail($email,$message,$subject,$title,$smail,$smailpass);
			
			    $noError = true;
					 	
			} else {
				$hasError = true;
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

?>

<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en"> 
<!--<![endif]-->
<head>
	
    <!-- Include header.php. Contains header content. -->
    <?php include ('template/header.php'); ?> 
    
     <link type="text/css" href="<?php echo $web->url; ?>source/assets/css/login.css" rel="stylesheet" />
    
</head>
<body>
	
     <!-- Include navigation.php. Contains navigation content. -->
 	 <?php include ('template/navigation.php'); ?> 
 	 
     <!-- ==============================================
	 Header
	 =============================================== -->	 
	 <header class="header-login top-page" style="

  background: url('<?php echo $web->url; ?>source/admin/<?php echo $web->bgimage; ?>') no-repeat center center fixed;
  background-size: cover;
  background-position: center center;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  color: #fff;
  height: 30vh;
  width: 100%;
  
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  text-align: center;">
      <div class="container">
	   <div class="content">
	    <div class="row">
	     <h1 class="revealOnScroll" data-animation="fadeInDown"> <?php echo $web->sitename; ?></h1>
        </div><!-- /.row -->
       </div><!-- /.content -->
	  </div><!-- /.container -->
     </header><!-- /header -->
	 
     <!-- ==============================================
     Banner Login Section
     =============================================== -->
	 <section class="banner-login">
	  <div class="container">
	  		  	
	   <div class="row">
	   
	    <main class="main main-signup col-lg-12">
	     <div class="col-lg-6 col-lg-offset-3 text-center">
		
	        <?php if(isset($hasError)) { //If errors are found ?>
	        <div class="alert alert-danger fade in">
	         <a href="#" class="close" data-dismiss="alert">&times;</a>
	         <strong>Error!</strong>Email Does not exist.
		    </div>
	        <?php } ?>
	        
	        <?php if (isset($error)) {
				echo $error;
			} ?>
	        
		  <?php if(isset($noError) && $noError == true) { //If email is sent ?>
		   <div class="alert alert-success fade in">
		   <a href="#" class="close" data-dismiss="alert">&times;</a>
		   <strong>Success!</strong> We have sent an email to <?php echo $email; ?>. Please click on the password reset link in the email to generate new password</strong>.
		   </div>
		  <?php } ?>
				
		  <div class="form-sign">
		   <form method="post">
		    <div class="form-head">
			 <h3><?php echo $lang->forgot; ?> <?php echo $lang->password; ?>?</h3>
			</div><!-- /.form-head -->
            <div class="form-body">          	
             
             <div class="form-row">
			  <div class="form-controls">
			   <input type="text" name="email" class="field" placeholder="<?php echo $lang->email; ?>">
			  </div><!-- /.form-controls -->
             </div><!-- /.form-row -->
		   
			 </div><!-- /.form-body -->
	
			 <div class="form-foot">
			  <div class="form-actions">
               <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />
			   <input type="submit" name="register" value="<?php echo $lang->forgot; ?> <?php echo $lang->password; ?>" class="kafe-btn kafe-btn-default full-width">
			  </div><!-- /.form-actions -->
			 </div><!-- /.form-foot -->
		   </form>
		   
		  </div><!-- /.form-sign -->
	     </div><!-- /.col-lg-6 -->
        </main>
		
	   </div><!-- /.row -->
	  </div><!-- /.container -->
     </section><!-- /section --> 	

	 
     <!-- Include footer.php. Contains footer content. -->
 	 <?php include ('template/footer.php'); ?> 

	 
	 <!-- ==============================================
	 Scripts
	 =============================================== -->
     <script src="<?php echo $web->url; ?>source/assets/js/jquery-3.2.1.min.js"></script>
	<script src="<?php echo $web->url; ?>source/assets/js/bootstrap.min.js"></script>
	<script src="<?php echo $web->url; ?>source/assets/js/waypoints.min.js"></script>
	<script src="<?php echo $web->url; ?>source/assets/js/jquery.easypiechart.min.js"></script>
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