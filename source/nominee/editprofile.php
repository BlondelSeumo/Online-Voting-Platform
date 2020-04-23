<?php 
 require_once(__DIR__ .'/../core/frontinit.php');
 
//Start new User object
$user = new User();

//Check user if is Logged In
if (!$user->isLoggedIn()) {
  Redirect::to($web->url.'login');	
}

//Edit Site Settings Data
if(isset($_POST['editresume'])){
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
	     'minlength' => 2
	  ],	
	  'describe_yourself' => [
		 'required' => true
	   ],
	  'manifesto' => [
		 'required' => true
	   ]		 
	]);
		 
    if (!$validation->fails()) {
		
		    
			$Update = DB::getInstance()->update('user',[
			   'name' => Input::get('name'),
			   'email' => Input::get('email'),
			   'describe_yourself' => Input::get('describe_yourself'),
			   'manifesto' => Input::get('manifesto')
		    ],[
		    'userid' => $user->data()->userid
		    ]);
			
			if (count($Update) > 0) {
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
     <link type="text/css" href="<?php echo $web->url; ?>source/assets/plugins/summernote/summernote.css" rel="stylesheet" />
     <link type="text/css" href="<?php echo $web->url; ?>source/assets/plugins/bootstrapselect/bootstrap-select.css" rel="stylesheet" />
    
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
		 	
		  <?php if (isset($error)) {
			  echo $error;
		  } ?>

	      <?php if(isset($hasError)) { //If errors are found ?>
	       <div class="alert alert-danger fade in">
	        <a href="#" class="close" data-dismiss="alert">&times;</a>
	        <strong>Error</strong> Error on updating.
		   </div>
	      <?php } ?>
	
		  <?php if(isset($noError) && $noError == true) { //If email is sent ?>
		   <div class="alert alert-success fade in">
		   <a href="#" class="close" data-dismiss="alert">&times;</a>
		   <strong>Success</strong> Update was successful</strong>.
		   </div>
		  <?php } ?>	


      <div role="tabpanel" class="tab-pane fade in active edit-resume" id="edit-resume">

      
           <div class="section drivers-job">
        <h3><?php echo $lang->edit; ?> <?php echo $lang->your; ?> <?php echo $lang->profile; ?></h3>

        <form method="POST">

        <div class="box-body">
        
        <div class="form-group">
          <label for="Full Name"><?php echo $lang->full; ?> <?php echo $lang->name; ?></label>
          <input type="text" name="name" class="form-control" placeholder="Full Name" value="<?php 
					  if (isset($_POST['editresume'])) {
						 echo escape(Input::get('name')); 
					  } else {
					  echo escape($user->data()->name); 
					  } ?>">
        </div>
        <div class="form-group">
          <label for="Email"><?php echo $lang->email; ?></label>
          <input type="text" name="email" class="form-control" placeholder="Email" value="<?php 
					  if (isset($_POST['editresume'])) {
						 echo escape(Input::get('email')); 
					  } else {
					  echo escape($user->data()->email); 
					  } ?>">
        </div>
        <div class="form-group">
          <label for="Describe Yourself"><?php echo $lang->describe_describe; ?> <?php echo $lang->yourself; ?></label>
          <textarea type="text" name="describe_yourself" class="form-control" id="summernote" placeholder="Describe Yourself"><?php 
					  if (isset($_POST['editresume'])) {
						 echo escape(Input::get('describe_yourself')); 
					  } else {
					  echo escape($user->data()->describe_yourself); 
					  } ?></textarea>
        </div>
        <div class="form-group">
          <label for="Describe Yourself"><?php echo $lang->manifesto; ?></label>
          <textarea type="text" name="manifesto" class="form-control" id="summernote-1" placeholder="Manifesto"><?php 
					  if (isset($_POST['editresume'])) {
						 echo escape(Input::get('manifesto')); 
					  } else {
					  echo escape($user->data()->manifesto); 
					  } ?></textarea>
        </div>
        
         </div><!-- box-body -->  

        <div class="box-footer">
          <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />
          <button type="submit" name="editresume" class="kafe-btn kafe-btn-mint full-width"><?php echo $lang->submit; ?></button>
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
	<script src="<?php echo $web->url; ?>source/assets/plugins/summernote/summernote.min.js"></script>
	<script src="<?php echo $web->url; ?>source/assets/js/debunk.js"></script>
	  <script>
		$(document).ready(function() {
			$('#summernote, #summernote-1').summernote({
        height: 100,
        toolbar: [
          ['style', ['bold', 'italic', 'underline', 'clear']],
          ['misc', ['print']]
        ]
      });
		});
	  </script>	
	<script src="<?php echo $web->url; ?>source/assets/plugins/bootstrapselect/bootstrap-select.js"></script>
    <script>
    $(document).ready(function() {
		$('.selectpicker').selectpicker({
		  size: 5
		});
    });
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