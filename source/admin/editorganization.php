<?php
//Check if init.php exists
 require_once(__DIR__ .'/../core/frontinit.php');
 
//Start new Admin Object
$admin = new Admin();

//Check if Admin is logged in
if (!$admin->isLoggedIn()) {
  Redirect::to($web->url.'admin/login');	
}

//Getting freelancer Data
$organizationid = $_GET['id'];
$qs = DB::getInstance()->get("organization", "*", ["organizationid" => $organizationid, "LIMIT" => 1]);
if ($qs->count() === 1) {
 foreach($qs->results() as $rs) {
 }
}else {
  Redirect::to($web->url.'admin/organizationlist');
}	

//Edit Profile Data
if(isset($_POST['details'])){
if (Input::exists()) {
 if(Token::check(Input::get('token'))){

	$errorHandler = new ErrorHandler;
	
	$validator = new Validator($errorHandler);
	
	$validation = $validator->check($_POST, [
	  'name' => [
		 'required' => true,
		 'minlength' => 2,
		 'maxlength' => 200
	   ]
	]);
		 
    if (!$validation->fails()) {
		
		//Update
		$Update = DB::getInstance()->update('organization',[
		   'name' => Input::get('name')
		],[
		    'organizationid' => $rs->organizationid
		  ]);
		
	   if (count($Update) > 0) {
			$updatedError = true;
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
	      	
				unlink('source/admin/'.$rs->imagelocation);
				
				
				$Update = DB::getInstance()->update('organization',[
				    'imagelocation' => $newname
				],[
				    'organizationid' => $rs->organizationid
				]);
				
			   if (count($Update) > 0) {
					$updatedError = true;
				} else {
					$hasError = true;
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
          <h1><?php echo $lang->organization; ?><small><?php echo $lang->section; ?></small></h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo $web->url; ?>admin/dashboard"><i class="fa fa-dashboard"></i> <?php echo $lang->home; ?></a></li>
            <li class="active"><?php echo $lang->edit; ?> <?php echo $lang->organization; ?></li>
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
	
		  <?php if(isset($updatedError) && $updatedError == true) { //If email is sent ?>
		   <div class="alert alert-success fade in">
		   <a href="#" class="close" data-dismiss="alert">&times;</a>
		   <strong>Success!</strong> The details have been successfully Updated.</strong>
		   </div>
		  <?php } ?>
		  
          </div>	
           
          <div class="col-lg-4">
          	<?php $selected = (Input::get('m') == 'adminorganizationdetails') ? ' active' : ''; ?>
          	<?php $image = (Input::get('m') == 'adminorganizationimage') ? ' active' : ''; ?>
	         <div class="list-group">
	         <a href="<?php echo $web->url; ?>admin/editorganization/details/<?php echo $organizationid ?>" class="list-group-item<?php echo $selected; ?>">
	          <em class="fa fa-fw fa-user-md text-white"></em>&nbsp;&nbsp;&nbsp;<?php echo $lang->organization; ?> <?php echo $lang->details_details; ?>
			 </a>
	         <a href="<?php echo $web->url; ?>admin/editorganization/image/<?php echo $organizationid ?>" class="list-group-item<?php echo $image; ?>">
	          <em class="fa fa-fw fa-image text-white"></em>&nbsp;&nbsp;&nbsp;<?php echo $lang->organization; ?> <?php echo $lang->image; ?>
			 </a>
			 
	         </div>
          </div>
          
		 <div class="col-lg-8">
		 <?php if (Input::get('m') == 'adminorganizationdetails') : ?>
		 <!-- Input addon -->
              <div class="box box-info">
                <div class="box-header">
                  <h3 class="box-title"><?php echo $lang->edit; ?> <?php echo $lang->organization; ?> <?php echo $lang->details_details; ?></h3>
                </div>
                <div class="box-body">
                 <form role="form" method="post" id="editform"> 
                 	
                  <div class="form-group">	
                    <label><?php echo $lang->name; ?></Label>
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="name" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('name')); 
					  } else {
					  echo escape($rs->name); 
					  } ?>" />
                   </div>
                  </div>
                                   
                  <div class="box-footer">
                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />
                    <button type="submit" name="details" class="btn btn-primary full-width"><?php echo $lang->submit; ?></button>
                  </div>
                 </form> 
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              
		 <?php elseif (Input::get('m') == 'adminorganizationimage') : ?>
		  
		  		 <div class="box box-info">
                <div class="box-header">
                  <h3 class="box-title"><?php echo $lang->organization; ?> <?php echo $lang->image; ?></h3>
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
					  echo $web->url; ?>source/admin/<?php echo escape($rs->imagelocation); 
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
