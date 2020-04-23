<?php
//Check if init.php exists
 require_once(__DIR__ .'/../core/frontinit.php');

//Start new Admin Object
$admin = new Admin();

//Check if Admin is logged in
if (!$admin->isLoggedIn()) {
  Redirect::to($web->url.'admin/login');	
}


//Get Site Settings Data
$qset = DB::getInstance()->get("settings", "*", ["id" => 1]);
if ($qset->count()) {
 foreach($qset->results() as $rset) {
 }			
}	


//Edit Site Settings Data
if(isset($_POST['postsite'])){
if (Input::exists()) {
 if(Token::check(Input::get('token'))){

	$errorHandler = new ErrorHandler;
	
	$validator = new Validator($errorHandler);
	
	$validation = $validator->check($_POST, [
	  'sitename' => [
	     'required' => true,
	     'minlength' => 2
	  ],
	  'title' => [
	     'required' => true,
	     'minlength' => 2
	  ],
	  'url' => [
	     'required' => true,
	     'maxlength' => 255,
	     'minlength' => 2
	   ],
	  'description' => [
	     'required' => true,
	     'minlength' => 3
	   ],
	  'keywords' => [
	     'required' => true,
	     'minlength' => 3
	   ]
	]);
		 
    if (!$validation->fails()) {
		
			$siteUpdate = DB::getInstance()->update('settings',[
			    'sitename' => Input::get('sitename'),
			    'title' => Input::get('title'),
			    'url' => Input::get('url'),
			    'description' => Input::get('description'),
			    'keywords' => Input::get('keywords')
		    ],[
		    'id' => $rset->id
		    ]);
			
			if (count($siteUpdate) > 0) {
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

//Edit Icon Settings Data
if(isset($_POST['postpayments'])){
if (Input::exists()) {
 if(Token::check(Input::get('token'))){

	$errorHandler = new ErrorHandler;
	
	$validator = new Validator($errorHandler);
	
	$validation = $validator->check($_POST, [
	  'sandbox' => [
	     'required' => true
	  ],
	  'paypal_email' => [
	     'required' => true,
	     'email' => true,
	  ]
	]);
		 
    if (!$validation->fails()) {
		
			$sandbox = (Input::get('sandbox') === 'on') ? 1 : 0;
			$siteUpdate = DB::getInstance()->update('settings',[
			    'sandbox' => $sandbox,
			    'paypal_email' => Input::get('paypal_email')
		    ],[
		    'id' => $rset->id
		    ]);
			
			if (count($siteUpdate) > 0) {
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

//Edit Mail Site Settings Data
if(isset($_POST['postmail'])){
if (Input::exists()) {
 if(Token::check(Input::get('token'))){

	$errorHandler = new ErrorHandler;
	
	$validator = new Validator($errorHandler);
	
	$validation = $validator->check($_POST, [
	  'smail' => [
	     'required' => true,
	     'maxlength' => 100,
	     'minlength' => 2
	  ],
	  'smailpass' => [
	     'required' => true,
	     'maxlength' => 255,
	     'minlength' => 2
	   ]
	]);
		 
    if (!$validation->fails()) {
		
			$sid = Input::get('sid');
			$siteUpdate = DB::getInstance()->update('settings',[
			    'smail' => Input::get('smail'),
			    'smailpass' => Input::get('smailpass')
		    ],[
		    'id' => $rset->id
		    ]);
			
			if (count($siteUpdate) > 0) {
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

/*Edit Background Image Data*/
if(isset($_POST['postpicture'])){
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
      if(in_array($ext,$valid_formats) && $size<(1920*1280))
	   {
	     $actual_image_name = time().substr($txt, 5).".".$ext;
		 $image_name = $actual_image_name;
		 $newname=$path.$image_name;
         $tmp = $_FILES['photoimg']['tmp_name'];
         if(move_uploaded_file($tmp, $path_new.$actual_image_name))
	      {
	      	
				unlink('source/admin/'.$rset->bgimage);
				
				$siteUpdate = DB::getInstance()->update('settings',[
				    'bgimage' => $newname
			    ],[
			    'id' => $rset->id
			    ]);
				
				if (count($siteUpdate) > 0) {
					$noError = true;
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

//Edit Currency Settings Data
if(isset($_POST['language_submit'])){
if (Input::exists()) {
 if(Token::check(Input::get('token'))){

	$errorHandler = new ErrorHandler;
	
	$validator = new Validator($errorHandler);
	
	$validation = $validator->check($_POST, [
	  'language_select' => [
	     'required' => true,
	     'minlength' => 1
	  ]
	]);
		 
    if (!$validation->fails()) {
		
			$siteUpdate = DB::getInstance()->update('settings',[
			    'languageid' => Input::get('language_select')
		    ],[
		    'id' => $rset->id
		    ]);
			
			if (count($siteUpdate) > 0) {
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


//Edit Currency Settings Data
if(isset($_POST['currency_submit'])){
if (Input::exists()) {
 if(Token::check(Input::get('token'))){

	$errorHandler = new ErrorHandler;
	
	$validator = new Validator($errorHandler);
	
	$validation = $validator->check($_POST, [
	  'currency_select' => [
	     'required' => true,
	     'minlength' => 1
	  ]
	]);
		 
    if (!$validation->fails()) {
		
			$siteUpdate = DB::getInstance()->update('settings',[
			    'currency' => Input::get('currency_select')
		    ],[
		    'id' => $rset->id
		    ]);
			
			if (count($siteUpdate) > 0) {
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


//Edit Site Analytics Data
if(isset($_POST['postanalytics'])){
if (Input::exists()) {
 if(Token::check(Input::get('token'))){

	$errorHandler = new ErrorHandler;
	
	$validator = new Validator($errorHandler);
	
	$validation = $validator->check($_POST, [
	  'google_analytics' => [
	     'required' => true
	  ]
	]);
		 
    if (!$validation->fails()) {
		
		    $sid = Input::get('sid');
			$siteUpdate = DB::getInstance()->update('settings',[
			    'google_analytics' => Input::get('google_analytics')
		    ],[
		    'id' => $rset->id
		    ]);
			
			if (count($siteUpdate) > 0) {
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
<html lang="en-US" class="no-js">
	
    <!-- Include header.php. Contains header content. -->
    <?php include ('template/header.php'); ?> 
    <!-- Fontawesome Icon Picker CSS -->
    <link href="../assets/css/fontawesome-iconpicker.min.css" rel="stylesheet" type="text/css" />

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
          <h1><?php echo $lang->settings; ?><small><?php echo $lang->section; ?></small></h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo $web->url; ?>admin/dashboard"><i class="fa fa-dashboard"></i> <?php echo $lang->home; ?></a></li>
            <li class="active"><?php echo $lang->settings; ?></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">	 	
		    <!-- Include currency.php. Contains header content. -->
		    <?php include ('template/language.php'); ?>   
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
	      
		 <?php if(isset($imageError)) { //If errors are found ?>
	       <div class="alert alert-danger fade in">
	        <a href="#" class="close" data-dismiss="alert">&times;</a>
	        <strong>Error!</strong> Failed to upload Image. Please try again.
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
		   <strong>Success</strong> The details have been updated successfully.</strong>
		   </div>
		  <?php } ?>
		  
		  <?php if (isset($error)) {
			  echo $error;
		  } ?>
          </div>	
           
          <div class="col-lg-4">
          	<?php $selected = (Input::get('m') == 'adminsite') ? ' active' : ''; ?>
          	<?php $sitemail = (Input::get('m') == 'mail') ? ' active' : ''; ?>
          	<?php $bgimg = (Input::get('m') == 'bgimage') ? ' active' : ''; ?>
          	<?php $langp = (Input::get('m') == 'language') ? ' active' : ''; ?>
          	<?php $analytics = (Input::get('m') == 'analytics') ? ' active' : ''; ?>
	         <div class="list-group">
	         <a href="<?php echo $web->url; ?>admin/settings/site" class="list-group-item<?php echo $selected; ?>">
	          <em class="fa fa-fw fa-cogs text-white"></em>&nbsp;&nbsp;&nbsp;<?php echo $lang->site; ?> <?php echo $lang->settings; ?>
			 </a>
	         <a href="<?php echo $web->url; ?>admin/settings/mail" class="list-group-item<?php echo $sitemail; ?>">
	          <em class="fa fa-fw fa-inbox text-white"></em>&nbsp;&nbsp;&nbsp;<?php echo $lang->email; ?> <?php echo $lang->settings; ?>
			 </a>
	         <a href="<?php echo $web->url; ?>admin/settings/bgimage" class="list-group-item<?php echo $bgimg; ?>">
	          <em class="fa fa-fw fa-image text-white"></em>&nbsp;&nbsp;&nbsp;<?php echo $lang->background; ?> <?php echo $lang->image; ?> <?php echo $lang->settings; ?>
			 </a>
	         <a href="<?php echo $web->url; ?>admin/settings/language" class="list-group-item<?php echo $langp; ?>">
	          <em class="fa fa-fw fa-image text-white"></em>&nbsp;&nbsp;&nbsp;<?php echo $lang->language_lang; ?> <?php echo $lang->settings; ?>
			 </a>
	         <a href="<?php echo $web->url; ?>admin/settings/analytics" class="list-group-item<?php echo $analytics; ?>">
	          <em class="fa fa-fw fa-line-chart text-white"></em>&nbsp;&nbsp;&nbsp;Google Analytics 
			 </a>
			 
	         </div>
          </div>
          
		 <div class="col-lg-8">
		 <?php if (Input::get('m') == 'adminsite') : ?>
		 <!-- Input addon -->
              <div class="box box-info">
                <div class="box-header">
                  <h3 class="box-title"><?php echo $lang->edit; ?> <?php echo $lang->site; ?> <?php echo $lang->settings; ?></h3>
                </div>
                <div class="box-body">
                 <form role="form" method="post"> 
                  
			 
                  <div class="form-group">	
                    <label><?php echo $lang->site; ?> <?php echo $lang->name; ?></label>
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="sitename" class="form-control" value="<?php
                         if (isset($_POST['postsite'])) {
							 echo escape(Input::get('sitename')); 
						  } else {
						  echo escape($rset->sitename); 
						  }
					  ?>"/>
                   </div>
                  </div>
                  <div class="form-group">	
                    <label><?php echo $lang->site; ?> <?php echo $lang->title; ?></label>
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="title" class="form-control" value="<?php
                         if (isset($_POST['postsite'])) {
							 echo escape(Input::get('title')); 
						  } else {
						  echo escape($rset->title); 
						  }
					  ?>"/>
                   </div>
                  </div>
                  <div class="form-group">
                    <label><?php echo $lang->site; ?> URL</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="url" class="form-control" value="<?php
                         if (isset($_POST['postsite'])) {
							 echo escape(Input::get('url')); 
						  } else {
						  echo escape($rset->url); 
						  }
					  ?>"/>
                   </div>
                  </div>
                  <div class="form-group">
                    <label><?php echo $lang->site; ?> <?php echo $lang->description; ?></label>		
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-quote-left"></i></span>
                    <textarea type="text" name="description" class="form-control" rows="5"><?php
                         if (isset($_POST['postsite'])) {
							 echo escape(Input::get('description')); 
						  } else {
						  echo escape($rset->description); 
						  }
					  ?></textarea>
                   </div>
                  </div>
                  <div class="form-group">	
                    <label><?php echo $lang->site; ?> <?php echo $lang->keywords; ?></label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-quote-left"></i></span>
                    <textarea type="text" name="keywords" class="form-control" rows="5"><?php
                         if (isset($_POST['postsite'])) {
							 echo escape(Input::get('keywords')); 
						  } else {
						  echo escape($rset->keywords); 
						  }
					  ?></textarea>
                   </div>
                  </div>
                                   
                  <div class="box-footer">
                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />
                    <button type="submit" name="postsite" class="btn btn-primary full-width"><?php echo $lang->submit; ?></button>
                  </div>
                 </form> 
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              
		 <?php elseif (Input::get('m') == 'mail') : ?>
		  
		 <!-- Input addon -->
              <div class="box box-info">
                <div class="box-header">
                  <h3 class="box-title"><?php echo $lang->edit; ?> <?php echo $lang->site; ?> <?php echo $lang->mail; ?> <?php echo $lang->settings; ?></h3>
                </div>
                <div class="box-body">
                 <form role="form" method="post"> 
                  
                  <div class="form-group">	
                    <label><?php echo $lang->site; ?> <?php echo $lang->email; ?></label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="smail" class="form-control" value="<?php
                         if (isset($_POST['postmail'])) {
							 echo escape(Input::get('smail')); 
						  } else {
						  echo escape($rset->smail); 
						  }
					  ?>"/>
                   </div>
                  </div>
                  <div class="form-group">	
                    <label><?php echo $lang->site; ?> <?php echo $lang->email; ?> <?php echo $lang->password; ?></label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="smailpass" class="form-control" value="<?php
                         if (isset($_POST['postmail'])) {
							 echo escape(Input::get('smailpass')); 
						  } else {
						  echo escape($rset->smailpass); 
						  }
					  ?>"/>
                   </div>
                  </div>
                                   
                  <div class="box-footer">
                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />
                    <button type="submit" name="postmail" class="btn btn-primary full-width"><?php echo $lang->submit; ?></button>
                  </div>
                 </form> 
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              
 		 <?php elseif (Input::get('m') == 'bgimage') : ?>
		  
		  		 <div class="box box-info">
                <div class="box-header">
                  <h3 class="box-title"><?php echo $lang->background; ?> <?php echo $lang->image; ?></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="sid" value="<?php echo escape($sid); ?>"/>
                  <div class="box-body">
                    <div class="form-group">
					 <div class="image text-center">
					  <img src="<?php 
					  if (isset($_POST['postpicture'])) {
						 echo $web->url.'source/admin/'.$newname; 
					  } else {
					  echo escape($rset->url.'source/admin/'.$rset->bgimage); 
					  } ?>" class="img-thumbnail" width="515" height="415"/>
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
                    <button type="submit" name="postpicture" class="btn btn-primary full-width"><?php echo $lang->submit; ?></button><br></br>
                  </div>

                </form>
              </div><!-- /.box -->  
	  
	  <?php elseif (Input::get('m') == 'language') : ?>
       <div class="col-lg-12">		 	
		 <div class="row">	
          		 	
		 	<div class="col-md-12">
		 		

		 
		 <!-- Input addon -->
              <div class="box box-info">
                <div class="box-header">
                  <h3 class="box-title"><?php echo $lang->select_select; ?> <?php echo $lang->default_default; ?> <?php echo $lang->language_lang; ?></h3>
                </div>
                <div class="box-body">
                 <form role="form" method="post" id="editform"> 
                  
                  <div class="form-group">	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-pencil-square"></i></span>
					<select name="language_select" type="text" class="form-control">
					 <?php
					  $query = DB::getInstance()->get("languages", "*", []);
						if ($query->count()) {
						   $name = '';
						   $x = 1;
							 foreach ($query->results() as $row) {
	                          if (isset($_POST['language_submit'])) {
                                $selected = ($row->languageid === Input::get('language_select')) ? ' selected="selected"' : '';
							  } else {
                                $selected = ($row->languageid === $rset->languageid) ? ' selected="selected"' : '';
							  }
							  echo $name .= '<option value = "' . $row->languageid . '" '.$selected.'>' . $row->language . '</option>';
							  unset($name); 
							  $x++;
						     }
						}
						
					 ?>	
					</select>
                   </div>
                  </div>
                                   
                  <div class="box-footer">
                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />
                    <button type="submit" name="language_submit" class="btn btn-primary full-width"><?php echo $lang->submit; ?></button>
                  </div>
                 </form> 
                </div><!-- /.box-body -->
              </div><!-- /.box -->	
              
		 </div><!-- /.col-lg-12 -->	 
	    </div><!-- /.row -->	
	    </div>              
              
	    
		 <?php elseif (Input::get('m') == 'analytics') : ?>
       <div class="col-lg-12">		 	
		 <div class="row">	
		 	
		 	<div class="col-md-12">
		 		
		 <!-- Input addon -->
              <div class="box box-info">
                <div class="box-header">
                  <h3 class="box-title">Google Analytics</h3>
                </div>
                <div class="box-body">
                 <form role="form" method="post" id="editform"> 
                  <input type="hidden" name="sid" value="<?php echo escape($sid); ?>"/>   
                                
                  <div class="form-group">	
				    <label>Google Analytics</label>
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <textarea type="text" name="google_analytics" class="form-control" rows="6"><?php
                         if (isset($_POST['postanalytics'])) {
							 echo escape(Input::get('google_analytics')); 
						  } else {
						  echo escape($rset->google_analytics); 
						  }
					  ?></textarea>
                   </div>
                  </div>  
                                                 
                                   
                  <div class="box-footer">
                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />
                    <button type="submit" name="postanalytics" class="btn btn-primary full-width"><?php echo $lang->submit; ?></button>
                  </div>
                 </form> 
                </div><!-- /.box-body -->
              </div><!-- /.box -->		 		
		 		
	         
		 </div><!-- /.col-lg-12 -->	 
	    </div><!-- /.row -->	
	    </div>	 
	    			 
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
    <!-- DATA TABES SCRIPT -->
    <script src="<?php echo $web->url; ?>source/assets/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="<?php echo $web->url; ?>source/assets/plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo $web->url; ?>source/assets/js/app.min.js" type="text/javascript"></script> 
    <!-- page script -->
    <script type="text/javascript">
      $(function () {
        $("#example1").dataTable({
        /* No ordering applied by DataTables during initialisation */
        "order": []
        });
      });
    </script>
    <script type="text/javascript">
	$(function() {
	$(".btn-currency").click(function(){
	
	//Save the link in a variable called element
	var element = $(this);
	
	//Find the id of the link that was clicked
	var id = element.attr("id");
	
	//Built a url to send
	var info = 'id=' + id;
	 if(confirm("Are you sure you want to delete this Currency"))
			  {
			var parent = $(this).parent().parent();
				$.ajax({
				 type: "GET",
				 url: "<?php echo $web->url; ?>source/admin/template/requests/deletecurrency.php",
				 data: info,
				 success: function()
					   {
						parent.fadeOut('slow', function() {$(this).remove();});
					   }
				});
			 
	
			  }
		   return false;
	
		});
	
	});
	</script>  
   <script type="text/javascript">
 	// Add Currency
	function addcurrency() {	
	    // get values
	    var currency_code = $("#currency_code").val();
	    var currency_name = $("#currency_name").val();
	    var currency_symbol = $("#currency_symbol").val();
	    
		//Built a url to send    
		var info = "currency_code="+currency_code+"&currency_name="+currency_name+"&currency_symbol="+currency_symbol;
	
	    // Add record
        $.ajax({
           type  : 'POST',
            url  : '<?php echo $web->url; ?>source/admin/template/requests/addcurrency.php',
		    data: info,
            success: function (data) {
	        // close the popup
	        $("#addcurrency").modal("hide");
            }
        });
	}   
	function getCurrencyDetails(id) {
	    // Add User ID to the hidden field for furture usage
	    $("#update_currencyid").val(id);
	    $.post("<?php echo $web->url; ?>source/admin/template/requests/readcurrencydetails.php", {
	            id: id
	        },
	        function (data, status) {
	            // PARSE json data
	            var currency = JSON.parse(data);
	            // Assing existing values to the modal popup fields
	            $("#update_currency_code").val(currency.currency_code);
	            $("#update_currency_name").val(currency.currency_name);
	            $("#update_currency_symbol").val(currency.currency_symbol);
	        }
	    );
	    // Open modal popup
	    $("#editcurrency").modal("show");
	}  
	function updatecurrency() {
	    // get values
	    var currencyid = $("#update_currencyid").val();
	    var currency_code = $("#update_currency_code").val();
	    var currency_name = $("#update_currency_name").val();
	    var currency_symbol = $("#update_currency_symbol").val();
	    
		//Built a url to send       
		var info = "currency_code="+currency_code+"&currency_name="+currency_name+"&currency_symbol="+currency_symbol+"&currencyid="+currencyid;
	
	    // Add record
        $.ajax({
           type  : 'POST',
            url  : '<?php echo $web->url; ?>source/admin/template/requests/updatecurrency.php',
		    data: info,
            success: function (data) {
	        // close the popup
	        $("#editcurrency").modal("hide");
            }
        });
	}		  
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
