<?php
//Check if init.php exists
 require_once(__DIR__ .'/../core/frontinit.php');
 
//Start new User object
$user = new User();

//Check user if is Logged In
if ($user->isLoggedIn()) {
  Redirect::to($web->url.'account/dashboard');	
}
//Register Function
if (Input::exists()) {
 if(Token::check(Input::get('token'))){
 	 
    $errorHandler = new ErrorHandler;
	
	$validator = new Validator($errorHandler);
	
	$validation = $validator->check($_POST, [
	  'name' => [
		 'required' => true,
		 'minlength' => 2,
		 'maxlength' => 50
	   ],
	  'email' => [
	     'required' => true,
	     'email' => true,
	     'maxlength' => 100,
	     'minlength' => 2,
	     'unique' => 'user'
	  ],		 
	  'username' => [
	     'required' => true,
	     'maxlength' => 20,
	     'minlength' => 3,
	     'alnum' => true
	  ],
	   'password' => [
	     'required' => true,
	     'minlength' => 6
	   ],
	   'confirmPassword' => [
	     'match' => 'password'
	   ]
	]);
	 	
	  if (!$validation->fails()) {
	  	$user = new User();
		  
		$remember = (Input::get('remember') === 'on') ? true : false;
		$salt = Hash::salt(32);  
		$imagelocation = 'uploads/default.png';
		$userid = uniqueid(); 
		try{
			
		  $user->create(array(
		   'userid' => $userid,
		   'username' => Input::get('username'),
		   'password' => Hash::make(Input::get('password'), $salt),
		   'salt' => $salt,
		   'name' => Input::get('name'),
		   'email' => Input::get('email'),
		   'imagelocation' => $imagelocation,
		   'joined' => date('Y-m-d H:i:s'),
		   'user_type' => 1
		  ));	
		  
		if ($user) {
	     $login = $user->login(Input::get('username'), Input::get('password'), $remember);
		 Redirect::to($web->url.'account/dashboard');
	    }else {
	     $hasError = true;
	   }
			
		}catch(Exception $e){
		 die($e->getMessage());	
		}
		
	  } else {
	     $error = '';
	     foreach ($validation->errors()->all() as $err) {
	     	$str = implode(" ",$err);
	     	$error .= '
		           <div class="alert alert-danger fade in">
		            <a href="#" class="close" data-dismiss="alert">&times;</a>
		            <strong>Error!</strong> '.$str.'<br/>
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
				
		  <div class="form-sign">
		   <form method="post">
		    <div class="form-head">
			 <h3><?php echo $lang->register; ?></h3>
			</div><!-- /.form-head -->
            <div class="form-body">            	
            	
			
             <div class="form-row">
			  <div class="form-controls">
			   <input type="text" name="name" class="field" value="<?php echo escape(Input::get('name')); ?>" placeholder="<?php echo $lang->full; ?> <?php echo $lang->name; ?>">
			  </div><!-- /.form-controls -->
             </div><!-- /.form-row -->		
             
             <div class="form-row">
			  <div class="form-controls">
			   <input type="text" name="email" class="field" value="<?php echo escape(Input::get('email')); ?>" placeholder="<?php echo $lang->email; ?>">
			  </div><!-- /.form-controls -->
             </div><!-- /.form-row -->
             
		     <div class="form-row">
		      <div class="form-controls">
			   <input type="text" name="username" class="field" value="<?php echo escape(Input::get('username')); ?>" placeholder="<?php echo $lang->username; ?>">
			  </div><!-- /.form-controls -->
		     </div><!-- /.form-row -->
			 
             <div class="form-row">
			  <div class="form-controls">
			   <input type="password" name="password" class="field" placeholder="<?php echo $lang->password; ?>">
			  </div><!-- /.form-controls -->
             </div><!-- /.form-row -->

			 <div class="form-row">
			  <div class="form-controls">
			   <input type="password" name="confirmPassword" class="field" placeholder="<?php echo $lang->confirm; ?> <?php echo $lang->password; ?>">
			  </div><!-- /.form-controls -->
             </div><!-- /.form-row -->
		   
			 </div><!-- /.form-body -->
	
			 <div class="form-foot">
			  <div class="form-actions">
               <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />
			   <input type="submit" name="register" value="<?php echo $lang->register; ?>" class="kafe-btn kafe-btn-default full-width">
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