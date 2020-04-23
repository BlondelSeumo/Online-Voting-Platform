<?php
//Check if init.php exists
 require_once(__DIR__ .'/source/core/frontinit.php');
 
error_reporting(E_ALL);
 
ob_start();



//Check if init.php exists
require_once("folder/settings.php");      
require_once('folder/functions/database.php'); 
require_once('folder/functions/DB.php');   
require_once('folder/functions/functions.php');   

	$step = 1;
	$canInstall = 'true';
	$svrErr	= 'false';
	$folderErr = 'false';

	// Check for PHP Version, MySQLi & other Core Functions
	if (version_compare(PHP_VERSION, '5.6.0', '<=')) {
		$phpversion = PHP_VERSION;
		$phpcheck = '<i class="fa fa-check text-default"></i> PASS';
	} else {
		$phpversion = 'You need to have PHP Version 5.6 and Lower to Install this system.';
		$phpcheck = '<i class="fa fa-times text-danger"></i> FAIL';
		$canInstall = 'false';
		$svrErr	= 'true';
	}
	if (curl_version()) {
		$curlcheck = '<i class="fa fa-check"></i> PASS';
	} else {
		$curlcheck = '<i class="fa fa-times text-danger"></i> FAIL';
		$canInstall = 'false';
		$svrErr	= 'true';
	}	
	if (class_exists('PDO')) {
		$pdo = '<i class="fa fa-check"></i> PASS';
	} else {
		$pdo = '<i class="fa fa-times"></i> FAIL';
		$canInstall = 'false';
		$svrErr	= 'true';
	}
	if (function_exists('mysqli_connect')) {
		$mysqli = '<i class="fa fa-check"></i> PASS';
	} else {
		$mysqli = '<i class="fa fa-times"></i> FAIL';
		$canInstall = 'false';
		$svrErr	= 'true';
	}
	if (version_compare(PHP_VERSION, '7.0', '<=')) {
	
		if (function_exists('mysql_connect')) {
			$mysql = '<i class="fa fa-check"></i> PASS';
		} else {
			$mysql = '<i class="fa fa-times"></i> FAIL';
			$canInstall = 'false';
			$svrErr	= 'true';
		}
	} else {
		$canInstall = 'true';
	}

	if(isset($_POST['submit']) && $_POST['submit'] == 'nextStep') {
		$step = '2';
	}

	if(isset($_POST['submit']) && $_POST['submit'] == 'backStep') {
		$step = '1';
	}
	

		if(isset($_POST['do_install'])) {
		$mysql_host = $_POST['mysql_host'];
		$mysql_username = $_POST['mysql_username'];
		$mysql_password = $_POST['mysql_password'];
		$mysql_database = $_POST['mysql_database'];
		
		$name = $_POST['name'];
		$title = $_POST['title'];
		$url = $_POST['url'];
		$description = $_POST['description'];
		$keywords = $_POST['keywords'];
		
		$site_email = $_POST['site_email'];
		$site_password = $_POST['site_password'];
		
		$admin_email = $_POST['admin_email'];
		$admin_password = $_POST['admin_password'];

			if(empty($mysql_host) or 
			empty($mysql_username) or 
			empty($mysql_database) or 
			empty($name) or 
			empty($title) or 
			empty($url) or 
			empty($description) or 
			empty($keywords) or 
			empty($site_email) or 
			empty($site_password) or 
			empty($admin_email) or 
			empty($admin_password)) { echo error("Error! All fields are required."); }
			else {
				
				
		$db = Database::GetInstance($_POST['mysql_host'], $_POST['mysql_database'], $_POST['mysql_username'], $_POST['mysql_password'], DATABASE_TYPE);
		if (DATABASE_CREATE && !$db->Create()) {
		    $error_mg[] = $db->Error();
		} else if ($db->Open()) {
			 // Read sql dump file
		    $sql_dump = file_get_contents($sql_dump_file);
			$database = db_install($sql_dump_file);	
			
$dbh = DB::getInstance($_POST['mysql_host'], $_POST['mysql_database'], $_POST['mysql_username'], $_POST['mysql_password'], DATABASE_TYPE);
								
			$salt = Hash::salt(32);
			$new_password = Hash::make($admin_password, $salt);
			$adminid = uniqueid();
		
			$Insert = $dbh->insert('admin', array(
			   'adminid' => $adminid,
			   'email' => $admin_email,
			   'password' => $new_password,
			   'salt' => $salt,
			   'joined' => date('Y-m-d H:i:s')
		    ));	
			
			//Update
			$Update = $dbh->update('settings',[
			   'title' => $title,
			   'description' => $description,
			   'keywords' => $keywords,
			   'url' => $url,
			   'sitename' => $name,
	           'smail' => $site_email,
	           'smailpass' => $site_password,
	           'sandbox' => 1
			],[
			    'id' => 1
			  ]);			

			/*frontinit.php*/
			$config_file_front = file_get_contents($config_file_default_front);
			$config_file_front = str_replace("_DB_HOST_", $mysql_host, $config_file_front);
			$config_file_front = str_replace("_DB_USER_", $mysql_username, $config_file_front);
			$config_file_front = str_replace("_DB_PASSWORD_", $mysql_password, $config_file_front);
			$config_file_front = str_replace("_DB_NAME_", $mysql_database, $config_file_front);
			
			$f = @fopen($config_file_path_front, "w+");
			fwrite($f, $config_file_front);			
						
			
		    $step = '3';


					} else {
						echo error("Error! MySQL database not exists.");
					}

				} 
			}
			
			

?>


<?php if($step == 1) { ?>
	
<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en"> 
<!--<![endif]-->
<head>
	    <!-- ==============================================
		Title and Meta Tags
		=============================================== -->
		<meta charset="utf-8">
		<title>Voting Platform Installation</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="">
		
	    <!-- ==============================================
		CSS
		=============================================== -->
        <!-- Style-->
        <link type="text/css" href="source/assets/css/style.css" rel="stylesheet" />
				
		<!-- ==============================================
		Feauture Detection
		=============================================== -->
		<script src="source/assets/js/modernizr-custom.js"></script>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->			
		
     <link type="text/css" href="source/assets/plugins/summernote/summernote.css" rel="stylesheet" />
     <link type="text/css" href="source/assets/plugins/bootstrapselect/bootstrap-select.css" rel="stylesheet" />
    
</head>
<body>
	
     <!-- ==============================================
     Navigation Section
     =============================================== -->  
     <header class="tr-header">
      <nav class="navbar navbar-default">
       <div class="container">
	    <div class="navbar-header">
		 <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
		  <span class="sr-only">Toggle navigation</span>
		  <span class="icon-bar"></span>
		  <span class="icon-bar"></span>
		  <span class="icon-bar"></span>
		 </button>
		 <a class="navbar-brand" href="">Voting</a>
		</div><!-- /.navbar-header -->
       </div><!-- /.container -->
      </nav><!-- /.navbar -->
     </header><!-- Page Header -->
 	 
      <!-- ==============================================
   Dashboard Section
   =============================================== -->
     <div class="tr-profile section-padding">
    <div class="container">
     <div class="row">
      <div class="col-sm-8 col-md-9 col-md-offset-2">
       <div class="tab-content">	


      <div role="tabpanel" class="tab-pane fade in active edit-resume" id="edit-resume">

      
           <div class="section drivers-job text-center">
		<p>Make sure you have created a databse first on your website.</p>
           	           
       </div><!-- /.resume-update -->
	   <br/>

      
           <div class="section drivers-job text-center">	
		      <div class="list-group">
			    <div class="list-group-item text-muted">
			      PHP Version	
		          <span><?php echo $phpversion; ?></span>
		          <div class="pull-right">
		           <span class="label label-info"><?php echo $phpcheck; ?></span>
		          </div>
                </div>
			    <div class="list-group-item text-muted">
			     PDO Extension	
		          <div class="pull-right">
		           <span class="label label-info"><?php echo $pdo; ?></span>
		          </div>
			    </div>  
			    <div class="list-group-item text-muted">
			     Mysqli Extension	
		          <div class="pull-right">
		           <span class="label label-info"><?php echo $mysqli; ?></span>
		          </div>
			    </div>  
			    <div class="list-group-item text-muted">
			     Mysql Extension
		          <div class="pull-right">
		           <span class="label label-info"><?php echo $mysql; ?></span>
		          </div>	
			    </div>
			    <div class="list-group-item text-muted">
			      CURL Extension	
		          <div class="pull-right">
		           <span class="label label-info"><?php echo $curlcheck; ?></span>
		          </div>
                </div>   
			  </div>	
		      <?php if ($canInstall == 'true') { ?>	
		      	<form method="post">
		        <button class="kafe-btn kafe-btn-mint" type="submit" name="submit" value="nextStep">Next Step</button>
		        </form>
		      <?php } ?>
           	           
       </div><!-- /.resume-update -->
      
      </div><!-- /.tab-pane -->
            
          </div>
              </div>
          </div><!-- /.row -->
      </div><!-- /.container -->
  </div>  
	 
	 <!-- ==============================================
	 Footer Section
	 =============================================== -->
	 <footer class="footerWhite">

      <!-- COPY RIGHT -->
      <div class="clearfix copyRight">
       <div class="container">
        <div class="row">
         
		 <div class="col-xs-12">
          <div class="copyRightWrapper">
           <div class="row">
		   
            <div class="col-sm-5 col-sm-push-7 col-xs-12">
            </div><!-- /col-sm-5 -->
			
		    <div class="col-sm-7 col-sm-pull-5 col-xs-12">
			 <div class="copyRightText">
			  <p>Copyright © Voting&nbsp; 2018. All Rights Reserved</p>
			 </div>
		    </div><!-- /col-sm-7 -->
		  
           </div><!-- /row -->
          </div><!-- /copyRightWrapper -->
         </div><!-- /col-xs-2 -->

        </div><!-- /row -->
       </div><!-- /container -->
      </div><!-- /copyRight -->
	  
    </footer>	
	
     <a id="scrollup">Scroll</a>

	 
	 <!-- ==============================================
	 Scripts
	 =============================================== -->
	<script src="source/assets/js/jquery-3.2.1.min.js"></script>
	<script src="source/assets/js/bootstrap.min.js"></script>
	<script src="source/assets/plugins/summernote/summernote.min.js"></script>
	<script src="source/assets/js/debunk.js"></script>
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
	<script src="source/assets/plugins/bootstrapselect/bootstrap-select.js"></script>
    <script>
		$('.selectpicker').selectpicker({
		  size: 5
		});
		$('.selectpickera').selectpicker({
		  size: 5
		});
		$('.selectpickerb').selectpicker({
		  size: 5
		});
			
		$('.selectpickerc').selectpicker({
		  size: 5
		});
    </script>
 	 
 	 
</body>
</html>	


<?php } elseif($step == 2) { ?> 
	
		
<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en"> 
<!--<![endif]-->
<head>
	    <!-- ==============================================
		Title and Meta Tags
		=============================================== -->
		<meta charset="utf-8">
		<title>Voting Platform Installation</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="">
		
	    <!-- ==============================================
		CSS
		=============================================== -->
        <!-- Style-->
        <link type="text/css" href="source/assets/css/style.css" rel="stylesheet" />
				
		<!-- ==============================================
		Feauture Detection
		=============================================== -->
		<script src="source/assets/js/modernizr-custom.js"></script>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->			
		
     <link type="text/css" href="source/assets/plugins/summernote/summernote.css" rel="stylesheet" />
     <link type="text/css" href="source/assets/plugins/bootstrapselect/bootstrap-select.css" rel="stylesheet" />
    
</head>
<body>
	
     <!-- ==============================================
     Navigation Section
     =============================================== -->  
     <header class="tr-header">
      <nav class="navbar navbar-default">
       <div class="container">
	    <div class="navbar-header">
		 <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
		  <span class="sr-only">Toggle navigation</span>
		  <span class="icon-bar"></span>
		  <span class="icon-bar"></span>
		  <span class="icon-bar"></span>
		 </button>
		 <a class="navbar-brand" href="">Voting</a>
		</div><!-- /.navbar-header -->
       </div><!-- /.container -->
      </nav><!-- /.navbar -->
     </header><!-- Page Header -->
 	 
      <!-- ==============================================
   Dashboard Section
   =============================================== -->
     <div class="tr-profile section-padding">
    <div class="container">
     <div class="row">
      <div class="col-sm-4 col-md-3">
 	           
      </div>
      <div class="col-sm-8 col-md-9 col-md-offset-2">
       <div class="tab-content">	


      <div role="tabpanel" class="tab-pane fade in active edit-resume" id="edit-resume">

      
           <div class="section drivers-job">
        <h3>Installation of the System</h3>

        <form role="form" method="post">

        <div class="box-body">
        
        <div class="form-group">
          <label for="Name">Mysql Host</label>
          <input type="text" name="mysql_host" class="form-control" placeholder="Mysql Host">
        </div>
		<div class="form-group">
		  <label for="Mysql Username">Mysql Username</label>
		  <input type="text" name="mysql_username" class="form-control" placeholder="Mysql Username">
		</div>
		<div class="form-group">
		  <label for="Mysql Password">Mysql Password</label>
		  <input type="text" name="mysql_password" class="form-control" placeholder="Mysql Password">
		</div>
		<div class="form-group">
		  <label for="Mysql database">Mysql Databse</label>
		  <input type="text" name="mysql_database" class="form-control" placeholder="Mysql Database">
		</div>
		<br/>
        
        <div class="form-group">
          <label for="Name">Website Name</label>
          <input type="text" name="name" class="form-control" placeholder="Website Name">
        </div>
        <div class="form-group">
          <label for="Title">Website Title</label>
          <input type="text" name="title" class="form-control" placeholder="Website Title">
        </div>
		<div class="form-group">
		  <label for="URL">Website Url</label>
		  <input type="text" name="url" class="form-control" placeholder="http://www.example.com/">
		</div>
		<p>Note! The URL should end with a / at the end.</p>
		<br/>
        
        <div class="form-group">
          <label for="Description">Website Description</label>
          <textarea type="text" name="description" class="form-control" rows="4" placeholder="Describe your site"></textarea>
        </div>
        <div class="form-group">
          <label for="Keywords">Website Keywords</label>
          <textarea type="text" name="keywords" class="form-control" rows="4" placeholder="Website Keywords"></textarea>
        </div>
		<br/>
		
        <div class="form-group">
          <label for="Name">Site Email</label>
          <input type="text" name="site_email" class="form-control" placeholder="Site Email e.g info@example.com" value="">
        </div>
		<div class="form-group">
		  <label for="URL">Site Password</label>
		  <input type="text" name="site_password" class="form-control" placeholder="Site Password">
		</div>
		<br/>
        <div class="form-group">
          <label for="Name">Admin Email</label>
          <input type="text" name="admin_email" class="form-control" placeholder="Site Email" value="">
        </div>
		<div class="form-group">
		  <label for="Password">Admin Password</label>
		  <input type="text" name="admin_password" class="form-control" placeholder="Site Password">
		</div>

        
         </div><!-- box-body -->  

        <div class="box-footer">
          <button type="submit" name="do_install" class="kafe-btn kafe-btn-mint full-width">Submit</button>
        </div>        
       
       </form>  
       <br />
      	<form method="post">
        <button class="kafe-btn kafe-btn-danger full-width" type="submit" name="submit" value="backStep">Back Step</button>
        </form>          
       </div><!-- /.resume-update -->
      
      </div><!-- /.tab-pane -->
            
          </div>
              </div>
          </div><!-- /.row -->
      </div><!-- /.container -->
  </div>  
	 
	 <!-- ==============================================
	 Footer Section
	 =============================================== -->
	 <footer class="footerWhite">

      <!-- COPY RIGHT -->
      <div class="clearfix copyRight">
       <div class="container">
        <div class="row">
         
		 <div class="col-xs-12">
          <div class="copyRightWrapper">
           <div class="row">
		   
            <div class="col-sm-5 col-sm-push-7 col-xs-12">
            </div><!-- /col-sm-5 -->
			
		    <div class="col-sm-7 col-sm-pull-5 col-xs-12">
			 <div class="copyRightText">
			  <p>Copyright © Voting&nbsp; 2018. All Rights Reserved</p>
			 </div>
		    </div><!-- /col-sm-7 -->
		  
           </div><!-- /row -->
          </div><!-- /copyRightWrapper -->
         </div><!-- /col-xs-2 -->

        </div><!-- /row -->
       </div><!-- /container -->
      </div><!-- /copyRight -->
	  
    </footer>	
	
     <a id="scrollup">Scroll</a>

	 
	 <!-- ==============================================
	 Scripts
	 =============================================== -->
	<script src="source/assets/js/jquery-3.2.1.min.js"></script>
	<script src="source/assets/js/bootstrap.min.js"></script>
	<script src="source/assets/plugins/summernote/summernote.min.js"></script>
	<script src="source/assets/js/debunk.js"></script>
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
	<script src="source/assets/plugins/bootstrapselect/bootstrap-select.js"></script>
    <script>
		$('.selectpicker').selectpicker({
		  size: 5
		});
		$('.selectpickera').selectpicker({
		  size: 5
		});
		$('.selectpickerb').selectpicker({
		  size: 5
		});
			
		$('.selectpickerc').selectpicker({
		  size: 5
		});
    </script>
 	 
 	 
</body>
</html>	
	
	
<?php } elseif ($step == 3) { ?>
	
<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en"> 
<!--<![endif]-->
<head>
	    <!-- ==============================================
		Title and Meta Tags
		=============================================== -->
		<meta charset="utf-8">
		<title>Voting Platform Installation</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="">
		
	    <!-- ==============================================
		CSS
		=============================================== -->
        <!-- Style-->
        <link type="text/css" href="source/assets/css/style.css" rel="stylesheet" />
				
		<!-- ==============================================
		Feauture Detection
		=============================================== -->
		<script src="source/assets/js/modernizr-custom.js"></script>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->			
		
     <link type="text/css" href="source/assets/plugins/summernote/summernote.css" rel="stylesheet" />
     <link type="text/css" href="source/assets/plugins/bootstrapselect/bootstrap-select.css" rel="stylesheet" />
    
</head>
<body>
	
     <!-- ==============================================
     Navigation Section
     =============================================== -->  
     <header class="tr-header">
      <nav class="navbar navbar-default">
       <div class="container">
	    <div class="navbar-header">
		 <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
		  <span class="sr-only">Toggle navigation</span>
		  <span class="icon-bar"></span>
		  <span class="icon-bar"></span>
		  <span class="icon-bar"></span>
		 </button>
		 <a class="navbar-brand" href="">Voting</a>
		</div><!-- /.navbar-header -->
       </div><!-- /.container -->
      </nav><!-- /.navbar -->
     </header><!-- Page Header -->
 	 
      <!-- ==============================================
   Dashboard Section
   =============================================== -->
     <div class="tr-profile section-padding" style="height: 65vh;">
    <div class="container">
     <div class="row">
      <div class="col-sm-8 col-md-9 col-md-offset-2">
       <div class="tab-content">	


      <div role="tabpanel" class="tab-pane fade in active edit-resume" id="edit-resume">

      
           <div class="section drivers-job text-center">
           	
      	
        <a class="kafe-btn kafe-btn-danger full-width">You have Successfully Installed the System</a>
		<br></br>
        <p>Now Please go to your files and DELETE a file named "install.php". Note! You will have an error if you don't delete the file.</p>
		<br/>
		<p>After that go to your website link and Success it is working.</p>
		
           	
           	           
       </div><!-- /.resume-update -->
      
      </div><!-- /.tab-pane -->
            
          </div>
              </div>
          </div><!-- /.row -->
      </div><!-- /.container -->
  </div>  
	 
	 <!-- ==============================================
	 Footer Section
	 =============================================== -->
	 <footer class="footerWhite">

      <!-- COPY RIGHT -->
      <div class="clearfix copyRight">
       <div class="container">
        <div class="row">
         
		 <div class="col-xs-12">
          <div class="copyRightWrapper">
           <div class="row">
		   
            <div class="col-sm-5 col-sm-push-7 col-xs-12">
            </div><!-- /col-sm-5 -->
			
		    <div class="col-sm-7 col-sm-pull-5 col-xs-12">
			 <div class="copyRightText">
			  <p>Copyright © Voting &nbsp; 2018. All Rights Reserved</p>
			 </div>
		    </div><!-- /col-sm-7 -->
		  
           </div><!-- /row -->
          </div><!-- /copyRightWrapper -->
         </div><!-- /col-xs-2 -->

        </div><!-- /row -->
       </div><!-- /container -->
      </div><!-- /copyRight -->
	  
    </footer>	
	
     <a id="scrollup">Scroll</a>

	 
	 <!-- ==============================================
	 Scripts
	 =============================================== -->
	<script src="../source/assets/js/jquery-3.2.1.min.js"></script>
	<script src="../source/assets/js/bootstrap.min.js"></script>
	<script src="../source/assets/plugins/summernote/summernote.min.js"></script>
	<script src="../source/assets/js/debunk.js"></script>
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
	<script src="../source/assets/plugins/bootstrapselect/bootstrap-select.js"></script>
    <script>
		$('.selectpicker').selectpicker({
		  size: 5
		});
		$('.selectpickera').selectpicker({
		  size: 5
		});
		$('.selectpickerb').selectpicker({
		  size: 5
		});
			
		$('.selectpickerc').selectpicker({
		  size: 5
		});
    </script>
 	 
 	 
</body>
</html>	
	
<?php } ?>	
