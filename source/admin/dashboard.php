<?php 

//Check if init.php exists
 require_once(__DIR__ .'/../core/frontinit.php');
 
//Start new Admin Object
$admin = new Admin();

//Check if Admin is logged in
if (!$admin->isLoggedIn()) {
  Redirect::to($web->url.'admin/login');	
}


?>
<!DOCTYPE html>
<html lang="en-US" class="no-js">
    
    <!-- Include header.php. Contains header content. -->
    <?php include ('template/header.php'); ?> 
    <!-- Panel CSS -->
    <link type="text/css" href="<?php echo $web->url; ?>source/assets/css/AdminLTE/AdminLTE.min.css" rel="stylesheet" />
    
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
          <h1><?php echo $lang->dashboard; ?><small><?php echo $lang->control; ?> <?php echo $lang->panel; ?></small></h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo $web->url; ?>admin/dashboard"><i class="fa fa-dashboard"></i> <?php echo $lang->home; ?></a></li>
            <li class="active"><?php echo $lang->dashboard; ?></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          
          <!-- Info boxes -->
          <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-globe"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text"><?php echo $lang->organizations; ?></span>
                  <span class="info-box-number">
                    <?php	
                     $query = DB::getInstance()->get("organization", "*", []);
                     echo $query->count();
                    ?>	
                    </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>
            
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-money"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text"><?php echo $lang->positions; ?></span>
                  <span class="info-box-number">
                    <?php	
                     $query = DB::getInstance()->get("position", "*", []);
                     echo $query->count();
                    ?>	
                    </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text"><?php echo $lang->nominees; ?></span>
                  <span class="info-box-number">
                    <?php	
                     $query = DB::getInstance()->get("user", "*", ["user_type" => 2]);
                     echo $query->count();
                    ?>	
                    </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-align-left"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text"><?php echo $lang->voters; ?></span>
                  <span class="info-box-number">
                    <?php	
                     $query = DB::getInstance()->get("user", "*", ["user_type" => 1]);
                     echo $query->count();
                    ?>	
                    </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->

          </div><!-- /.row --> 
          
          <?php
$url = $_SERVER["REQUEST_URI"];
$pg = parse_url($url, PHP_URL_QUERY);
 echo $pg; ?>
          
                </div><!-- /.box-footer -->
              </div><!-- /.box -->
            </div><!-- /.col -->
         	
         </div>               	           

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
	 	
	  <?php include 'template/footer.php'; ?>	
	 	
     </div>
     
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