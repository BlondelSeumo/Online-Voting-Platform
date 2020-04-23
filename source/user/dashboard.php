<?php 
 require_once(__DIR__ .'/../core/frontinit.php');
 
//Start new User object
$user = new User();

//Check user if is Logged In
if (!$user->isLoggedIn()) {
  Redirect::to($web->url.'login');	
}

if ($user->data()->user_type == 2) {
  Redirect::to($web->url.'account/logout');	
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
    <link href="<?php echo $web->url; ?>source/assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    
</head>
<body>
	
     <!-- Include navigation.php. Contains navigation content. -->
 	 <?php include ('template/navigation.php'); ?> 
 	 
      <!-- ==============================================
   Dashboard Section
   =============================================== -->
     <section class="tr-profile section-padding">
    <div class="container">
     <div class="row">
      <div class="col-sm-4 col-md-3">  
      	
     <!-- Include sidenav.php. Contains navigation content. -->
 	 <?php include ('template/sidenav.php'); ?> 
 	 
      </div>
	    <div class="col-sm-8 col-md-9">
	     <div class="tab-content">
		 
		  <div role="tabpanel" class="tab-pane fade in active account-info" id="account-info">	
		  
		   
		 		<div class="box box-info">
                <div class="box-header">
                  <h3 class="box-title"> <?php echo $lang->please; ?> <?php echo $lang->vote; ?> <?php echo $lang->for_for; ?> <?php echo $lang->these; ?> <?php echo $lang->guys; ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                 <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
					   <th><?php echo $lang->no; ?></th>
					   <th><?php echo $lang->image; ?></th>
					   <th><?php echo $lang->name; ?></th>
					   <th><?php echo $lang->organization; ?></th>
					   <th><?php echo $lang->running; ?> <?php echo $lang->to_to; ?> <?php echo $lang->be; ?></th>
                      </tr>
                    </thead>
                    <tbody>
				    <?php
				    $x = 1;
                     $query = DB::getInstance()->get("user", "*", ["user_type" => 2]);
                     if($query->count()) {
						foreach($query->results() as $row) {
							
			             $q2 = DB::getInstance()->get("organization", "*", ["AND" => ["organizationid" => $row->organizationid]]);
			             if($q2->count()) {
							foreach($q2->results() as $r2) {
							}
						 }			
								
			             $q3 = DB::getInstance()->get("position", "*", ["AND" => ["positionid" => $row->positionid]]);
			             if($q3->count()) {
							foreach($q3->results() as $r3) {
							}
						 }
										
					    echo '<tr>';
						echo '<td>'. escape($x) .'</td>';
					    echo '<td><img src="'. $web->url .'source/nominee/'. $row->imagelocation .'" width="50" height="30" /></td>';
					    echo '<td><a href="'. $web->url .'nominees/'. $row->organizationid .'">'. escape($row->name) .'</a></td>';
						echo '<td><a href="'. $web->url .'nominees/'. $row->organizationid .'">'. escape($r2->name) .'</a></td>';
						echo '<td><a href="'. $web->url .'nominees/'. $row->organizationid .'">'. escape($r3->name) .'</a></td>';
					    echo '</tr>';
						$x++;
					   }
					}else {
						echo 'No Results';
					}
			        ?>
                    </tbody>
                    <tfoot>
                      <tr>
					   <th><?php echo $lang->no; ?></th>
					   <th><?php echo $lang->image; ?></th>
					   <th><?php echo $lang->name; ?></th>
					   <th><?php echo $lang->organization; ?></th>
					   <th><?php echo $lang->running; ?> <?php echo $lang->to_to; ?> <?php echo $lang->be; ?></th>
                      </tr>
                    </tfoot>
                  </table>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->  		   
          
		  </div><!-- /.tab-pane -->
		</div>				
		
		
	    </div><!-- /.col-md-9 -->	
          </div><!-- /.row -->
      </div><!-- /.container -->
  </section>  	 
	 
     <!-- Include footer.php. Contains footer content. -->
 	 <?php include ('template/footer.php'); ?> 

	 
	 <!-- ==============================================
	 Scripts
	 =============================================== -->
	<script src="<?php echo $web->url; ?>source/assets/js/jquery-3.2.1.min.js"></script>
	<script src="<?php echo $web->url; ?>source/assets/js/bootstrap.min.js"></script>
    <!-- DATA TABES SCRIPT -->
    <script src="<?php echo $web->url; ?>source/assets/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="<?php echo $web->url; ?>source/assets/plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
	<script src="<?php echo $web->url; ?>source/assets/js/debunk.js"></script>
    <script type="text/javascript">
      $(function () {
        $("#example1").dataTable();
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