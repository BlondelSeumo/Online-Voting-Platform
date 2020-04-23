<?php
//Check if init.php exists
 require_once(__DIR__ .'/../core/frontinit.php');
 
//Start new Admin Object
$admin = new Admin();

//Check if Admin is logged in
if (!$admin->isLoggedIn()) {
  Redirect::to($web->url.'admin/login');	
}

//Getting Skill Data
$positionid = Input::get('id');
$qt = DB::getInstance()->get("position", "*", ["positionid" => $positionid, "LIMIT" => 1]);
if ($qt->count() === 1) {
 foreach($qt->results() as $rt) {

 }
} else {
  Redirect::to($web->url.'admin/positionlist');
}	

//Edit Category Data
if (Input::exists()) {
 if(Token::check(Input::get('token'))){

	$errorHandler = new ErrorHandler;
	
	$validator = new Validator($errorHandler);
	
	$validation = $validator->check($_POST, [
	  'name' => [
		 'required' => true,
		 'minlength' => 2
	   ],
	  'organizationid' => [
		 'required' => true
	   ]
	]);
		 
    if (!$validation->fails()) {
		
		//Update Skill
		$Update = DB::getInstance()->update('position',[
		   'name' => Input::get('name'),
		   'organizationid' => Input::get('organizationid')
		],[
		    'positionid' => $rt->positionid
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
          <h1><?php echo $lang->position; ?><small><?php echo $lang->section; ?></small></h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo $web->url; ?>admin/dashboard"><i class="fa fa-dashboard"></i> <?php echo $lang->home; ?></a></li>
            <li class="active"><?php echo $lang->edit; ?> <?php echo $lang->position; ?></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">	 	

		 <div class="row">	
		 	
		 <div class="col-lg-12">
		 	
		  <?php if (isset($error)) {
			  echo $error;
		  } ?>  
		  
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
           
          
		 <div class="col-lg-12">
		 <!-- Input addon -->
              <div class="box box-info">
                <div class="box-header">
                  <h3 class="box-title"><?php echo $lang->edit; ?> <?php echo $lang->position; ?></h3>
                </div>
                <div class="box-body">
                 <form role="form" method="post" id="editform"> 
                                    
                  <div class="form-group">	
				    <label><?php echo $lang->organization; ?></label>
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-pencil-square"></i></span>
					<select name="organizationid" type="text" class="form-control">
					 <?php
					  $query = DB::getInstance()->get("organization", "*", []);
						if ($query->count()) {
						   $categoryname = '';
						   $x = 1;
							 foreach ($query->results() as $row) {

	                         if (isset($_POST['details'])) {
	                         	$selected = (Input::get('organizationid') === $rt->organizationid) ? ' selected="selected"' : '';
							  } else {
							  	$selected = ($row->organizationid === $rt->organizationid) ? ' selected="selected"' : '';
							  }
							  
							  echo $categoryname .= '<option value = "' . $row->organizationid . '" '.$selected.'>' . $row->name . '</option>';
							  unset($categoryname); 
							  $x++;
						     }
						}
					 ?>	
					</select>
                   </div>
                  </div>
                 	
                  <div class="form-group">	
                    <label><?php echo $lang->name; ?></label>
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="name" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('name')); 
					  } else {
					  echo escape($rt->name); 
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
