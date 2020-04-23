<?php
//Check if init.php exists
 require_once(__DIR__ .'/../core/frontinit.php');
 
//Start new Admin Object
$admin = new Admin();

//Check if Admin is logged in
if (!$admin->isLoggedIn()) {
  Redirect::to($web->url.'admin/login');	
}
	

//Edit Profile Data
if(isset($_POST['profile'])){
if (Input::exists()) {
 if(Token::check(Input::get('token'))){

	$errorHandler = new ErrorHandler;
	
	$validator = new Validator($errorHandler);
	
	$validation = $validator->check($_POST, [
	  'username' => [
	     'required' => true,
	     'maxlength' => 20,
	     'minlength' => 2
	  ],
	  'name' => [
	     'required' => true,
	     'maxlength' => 100,
	     'minlength' => 2
	  ],
	  'email' => [
	     'required' => true,
	     'maxlength' => 255,
	     'email' => true
	   ]
	]);
		 
    if (!$validation->fails()) {
		
	 	
		$admin->update([
		    'name' => Input::get('name'),
		    'username' => Input::get('username'),
		    'email' => Input::get('email')
		],[
		    'adminid' => $admin->data()->adminid
		  ]);
		
	   if (count($admin) > 0) {
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

/*Edit Image Data*/
if(isset($_POST['picture'])){
if (Input::exists()) {
  if (Token::check(Input::get('token'))) {
  	
	$path = 'uploads/';
	$path_new = 'source/admin/uploads/';
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
	       if ($admin->data()->imagelocation !== 'uploads/default.png') {
			unlink('source/admin/'.$admin->data()->imagelocation);
			
	      	$admin->update([
		    'imagelocation' => $newname
		    ],[
		    'adminid' => $admin->data()->adminid
		  ]);
		
			$noImageError = true;	
			 
		   } else {
		   	
			   $admin->update([
			    'imagelocation' => $newname
			    ],[
			    'adminid' => $admin->data()->adminid
			  ]);
				$noImageError = true;
		   }  		  
					
	      }else{
		   $imageError = true;	
     	  }
       }else{
       	  $formatprofileError = true;				
	   }
      }else{
      	  $selectError = true;
      }	
  	
  }
 }	
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
  	
		if (Hash::make(Input::get('password_current'), $admin->data()->salt) !== $admin->data()->password) {
			$hasError = true;
		} else {
		  $salt = Hash::salt(32);
		  $admin->update([
		    'password' => Hash::make(Input::get('password_new'), $salt),
		    'salt' => $salt
		  ],[
		    'adminid' => $admin->data()->adminid
		  ]);
		  
		 $noError = true;
		 
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
<html lang="en-US" class="no-js">
	
    <!-- Include header.php. Contains header content. -->
    <?php include ('template/header.php'); ?> 

 <body class="skin-green sidebar-mini">
     
     <!-- ==============================================
     Wrapper Section
     =============================================== -->
	 <div class="wrapper">
	 	
        <!-- Include navigation.php. Contains navigation content. -->
	 	<?php include ('template/navigation.php'); ?> 
        <!-- Include sidenav.php. Contains sidebar content. -->
	 	<?php include ('template/sidenav.php'); ?> 
	 	
	  <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1><?php echo $lang->profile; ?><small><?php echo $lang->section; ?></small></h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo $web->url; ?>admin/dashboard"><i class="fa fa-dashboard"></i> <?php echo $lang->home; ?></a></li>
            <li class="active"><?php echo $lang->profile; ?></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">	 	

		 <div class="row">	
		 	
		 <div class="col-lg-12">
      	
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
	      
		 <?php if(isset($formatprofileError)) { //If errors are found ?>
	       <div class="alert alert-danger fade in">
	        <a href="#" class="close" data-dismiss="alert">&times;</a>
	        <strong>Error!</strong> Invalid file formats..! Please try again. Formats accepted are jpg,png,gif,bmp and size should be 1400 * 1400.
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
	
		  <?php if(isset($noImageError) && $noImageError == true) { //If email is sent ?>
		   <div class="alert alert-success fade in">
		   <a href="#" class="close" data-dismiss="alert">&times;</a>
		   <strong>Success!</strong> You have successfully changed your Profile Image.</strong>.
		   </div>
		  <?php } ?>
	        
	      <?php if(isset($passError)) { //If errors are found ?>
	       <div class="alert alert-danger fade in">
	        <a href="#" class="close" data-dismiss="alert">&times;</a>
	        <strong>Error!</strong> Your current password is wrong
		   </div>
	      <?php } ?>
	

	      <?php if(isset($hasError)) { //If errors are found ?>
	       <div class="alert alert-danger fade in">
	        <a href="#" class="close" data-dismiss="alert">&times;</a>
	        <strong>Error!</strong> Please check if you've filled all the fields with valid information and try again. Thank you.
		   </div>
	      <?php } ?>
	
		  <?php if(isset($noError) && $noError == true) { //If email is sent ?>
		   <div class="alert alert-success fade in">
		   <a href="#" class="close" data-dismiss="alert">&times;</a>
		   <strong>Success!</strong> The details have been successfully saved.</strong>.
		   </div>
		  <?php } ?>
		  
          </div>	
           
          <div class="col-lg-4">
          	<?php $selected = (Input::get('m') == 'adminprofile') ? ' active' : ''; ?>
          	<?php $image = (Input::get('m') == 'adminimage') ? ' active' : ''; ?>
          	<?php $active = (Input::get('m') == 'adminpassword') ? ' active' : ''; ?>
	         <div class="list-group">
	         <a href="<?php echo $web->url; ?>admin/profile" class="list-group-item<?php echo $selected; ?>">
	          <em class="fa fa-fw fa-user-md text-white"></em>&nbsp;&nbsp;&nbsp;<?php echo $lang->profile; ?>
			 </a>
	         <a href="<?php echo $web->url; ?>admin/profile/image" class="list-group-item<?php echo $image; ?>">
	          <em class="fa fa-fw fa-image text-white"></em>&nbsp;&nbsp;&nbsp;<?php echo $lang->admin; ?> <?php echo $lang->image; ?>
			 </a>
	         <a href="<?php echo $web->url; ?>admin/profile/password" class="list-group-item<?php echo $active; ?>">
	          <em class="fa fa-fw fa-lock text-white"></em>&nbsp;&nbsp;&nbsp;<?php echo $lang->change_change; ?> <?php echo $lang->password; ?>
			 </a>
			 
	         </div>
          </div>
          
		 <div class="col-lg-8">
		 <?php if (Input::get('m') == 'adminprofile') : ?>
		 <!-- Input addon -->
              <div class="box box-info">
                <div class="box-header">
                  <h3 class="box-title"><?php echo $lang->edit; ?> <?php echo $lang->profile; ?></h3>
                </div>
                <div class="box-body">
                 <form role="form" method="post" id="addstudentform"> 
                  <div class="form-group">	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="name" class="form-control" value="<?php 
					  if (isset($_POST['profile'])) {
						 echo escape(Input::get('name')); 
					  } else {
					  echo escape($admin->data()->name); 
					  } ?>"/>
                   </div>
                  </div>
                  <div class="form-group">	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="username" class="form-control" value="<?php 
					  if (isset($_POST['profile'])) {
						 echo escape(Input::get('username')); 
					  } else {
					  echo escape($admin->data()->username); 
					  } ?>"/>
                   </div>
                  </div>
                  <div class="form-group">	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-inbox"></i></span>
                    <input type="text" name="email" class="form-control" value="<?php 
					  if (isset($_POST['profile'])) {
						 echo escape(Input::get('email')); 
					  } else {
					  echo escape($admin->data()->email); 
					  } ?>">
                   </div>
                  </div>
                                   
                  <div class="box-footer">
                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />
                    <button type="submit" name="profile" class="btn btn-primary full-width"><?php echo $lang->submit; ?></button>
                  </div>
                 </form> 
                </div><!-- /.box-body -->
              </div><!-- /.box -->
		 <?php elseif (Input::get('m') == 'adminimage') : ?>
		  
		  		 <div class="box box-info">
                <div class="box-header">
                  <h3 class="box-title"><?php echo $lang->profile; ?> <?php echo $lang->picture; ?></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" enctype="multipart/form-data">
                  <div class="box-body">
                    <div class="form-group">
					 <div class="image text-center">
					  <img src="<?php 
					  if (isset($_POST['picture'])) {
						 echo $web->url; ?>source/admin/<?php echo escape($newname); 
					  } else {
					  echo $web->url; ?>source/admin/<?php echo escape($admin->data()->imagelocation); 
					  } ?>" class="img-thumbnail" width="215" height="215"/>
					 </div>
                    </div>
                   <div style="position:relative;">
	                <a class='btn btn-primary' href='javascript:;'>
		            <?php echo $lang->choose; ?> <?php echo $lang->image; ?>...
		            <input type="file" name="photoimg" id="photoimg" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="file_source" size="40"  onchange='$("#upload-file-info").html($(this).val());'>
	                <input type="hidden" name="image_name" id="image_name"/>
	                </a>
	                &nbsp;
	                <span class='label label-info' id="upload-file-info"></span>
                  </div>
				  
                  </div><!-- /.box-body -->
                  
                  <div class="box-footer">
                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />
                    <button type="submit" name="picture" class="btn btn-primary full-width"><?php echo $lang->submit; ?></button><br></br>
                  </div>

                </form>
              </div><!-- /.box -->	
              
	                    	
		 <?php elseif (Input::get('m') == 'adminpassword') : ?>	 
			 
		 <!-- Input addon -->
              <div class="box box-info">
                <div class="box-header">
                  <h3 class="box-title"><?php echo $lang->change_change; ?> <?php echo $lang->password; ?></h3>
                </div>
                <div class="box-body">
                 <form role="form" method="post" id="addstudentform"> 
                  <input type="hidden" name="nid" value="<?php echo escape($nid); ?>"/>
                  <div class="form-group">	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    <input type="password" name="password_current" class="form-control" placeholder="<?php echo $lang->current; ?> <?php echo $lang->password; ?>"/>
                   </div>
                  </div>
                  <div class="form-group">	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    <input type="password" name="password_new" class="form-control" placeholder="<?php echo $lang->new; ?> <?php echo $lang->password; ?>"/>
                   </div>
                  </div>
                  <div class="form-group">	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    <input type="password" name="password_new_again" class="form-control" placeholder="<?php echo $lang->confirm; ?> <?php echo $lang->new; ?> <?php echo $lang->password; ?>"/>
                   </div>
                  </div>
                                   
                  <div class="box-footer">
                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />
                    <button type="submit" name="register" class="btn btn-primary full-width"><?php echo $lang->submit; ?></button>
                  </div>
                 </form> 
                </div><!-- /.box-body -->
              </div><!-- /.box -->
			 
		 <?php endif; ?>
		 
		</div><!-- /.col -->
		
        
			 
	    </div><!-- /.row -->		  		  
	   </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
	 	
      <!-- Include footer.php. Contains footer content. -->	
	  <?php include 'template/footer.php'; ?>	
	 	
     </div><!-- /.wrapper -->   

	
     
     <!-- ==============================================
	 Scripts
	 =============================================== -->
	 
    <!-- jQuery 2.1.4 -->
    <script src="<?php echo $web->url; ?>source/assets/js/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.6 JS -->
    <script src="<?php echo $web->url; ?>source/assets/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo $web->url; ?>source/assets/js/app.min.js" type="text/javascript"></script>  
     
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
