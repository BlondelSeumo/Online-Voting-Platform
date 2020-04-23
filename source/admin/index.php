<?php
//Check if init.php exists
 require_once(__DIR__ .'/../core/frontinit.php');
 
 //Start new Admin Object
$admin = new Admin();

//Check if Admin is logged in
if ($admin->isLoggedIn()) {
  Redirect::to($web->url.'admin/dashboard');	
}
 
//Log In Function
if (Input::exists()) {
 if(Token::check(Input::get('token'))){
	 
	$errorHandler = new ErrorHandler;
	
	$validator = new Validator($errorHandler);
	
	$validation = $validator->check($_POST, [
	  'email' => [
	     'required' => true,
	     'maxlength' => 255,
	     'email' => true
	   ],
	   'password' => [
	     'required' => true,
	     'minlength' => 6
	   ]
	]);
	 	
	  if (!$validation->fails()) {
		
			 //Log User In
			 $admin = new Admin();
	
			 $remember = (Input::get('remember') === 'on') ? true : false;
			 $login = $admin->login(Input::get('email'), Input::get('password'), $remember);
			 
			 if ($login === true) {
	           Redirect::to($web->url.'admin/dashboard');
			 }else {
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
    <?php include ('template/login/header.php'); ?> 
    
     <link type="text/css" href="<?php echo $web->url; ?>source/assets/css/login.css" rel="stylesheet" />
    
</head>
<body>
	
     <!-- Include navigation.php. Contains navigation content. -->
 	 <?php include ('template/login/navigation.php'); ?> 
 	 
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
         <strong>Error!!</strong> Wrong Email or Password.
	    </div>
        <?php } ?>
        
        <?php if (isset($error)) {
			echo $error;
		} ?>
				
	     	
		  <div class="form-sign">
		   <form method="post">
		    <div class="form-head">
			 <h3><?php echo $lang->login; ?></h3>
			</div><!-- /.form-head -->
            <div class="form-body">            	
            	
			 <div class="form-row">
			  <div class="form-controls">
			   <input name="email" placeholder="<?php echo $lang->email; ?>" class="field" type="text">
			  </div><!-- /.form-controls -->
			 </div><!-- /.form-row -->

			 <div class="form-row">
			  <div class="form-controls">
			   <input name="password" placeholder="<?php echo $lang->password; ?>" class="field" type="password">
			  </div><!-- /.form-controls -->
			 </div><!-- /.form-row -->
			 
			 <div class="form-row">
			  <div class="material-switch pull-left">
			   <input id="someSwitchOptionSuccess" name="remember" type="checkbox"/>
			   <label for="someSwitchOptionSuccess" class="label-success"></label>
			   <span><?php echo $lang->remember_me; ?></span>
			  </div>
			 </div><!-- /.form-row -->
			 
		    </div><!-- /.form-body -->

			<div class="form-foot">
			 <div class="form-actions">					
              <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />
			  <input value="<?php echo $lang->login; ?>" class="kafe-btn kafe-btn-default full-width" type="submit">
			 </div><!-- /.form-actions -->
             <div class="form-head">
			  <a href="<?php echo $web->url; ?>admin/forgot" class="more-link"><?php echo $lang->forgot; ?> <?php echo $lang->password; ?></a>
			 </div>
			</div><!-- /.form-foot -->
		   </form>
		   
		  </div><!-- /.form-sign -->
	     </div><!-- /.col-lg-6 -->
        </main>
		
	   </div><!-- /.row -->
	  </div><!-- /.container -->
     </section><!-- /section --> 	 
	 
     <!-- Include footer.php. Contains footer content. -->
 	 <?php include ('template/login//footer.php'); ?> 

	 
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