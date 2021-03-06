<?php 
 require_once(__DIR__ .'/../core/frontinit.php');
 
//Start new User object
$user = new User();

//Check user if is Logged In
if (!$user->isLoggedIn()) {
  Redirect::to($web->url.'login');	
}

if ($user->data()->user_type == 1) {
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
		  
		   <div class="tr-fun-fact">
		    <div class="row">
			 
			 <div class="col-sm-4">
			  <div class="fun-fact">
			   <div class="media-body">
				<h4 class="counter"><?php echo $lang->organization; ?></h4>
				<span>
                    <?php	
			             $q2 = DB::getInstance()->get("organization", "*", ["AND" => ["organizationid" => $user->data()->organizationid]]);
			             if($q2->count()) {
							foreach($q2->results() as $r2) {
							}
						 }			
								
			             $q3 = DB::getInstance()->get("position", "*", ["AND" => ["positionid" => $user->data()->positionid]]);
			             if($q3->count()) {
							foreach($q3->results() as $r3) {
							}
						 }
						 
						 echo $r2->name;
						          
                    ?></span>
			   </div>
			  </div><!-- /.fun-fact -->
	         </div><!-- /.col-sm-4 -->
			 
			 <div class="col-sm-4">
			  <div class="fun-fact">
			   <div class="media-body">
				<h4 class="counter"><?php echo $lang->position; ?></h4>
				<span>
                    <?php	
		             echo $r3->name;         
                    ?></span>
			   </div>
			  </div><!-- /.fun-fact -->
	         </div><!-- /.col-sm-4 -->
			 
			 <div class="col-sm-4">
			  <div class="fun-fact">
			   <div class="media-body">
				<h1 class="counter">
                    <?php	
		             $q4 = DB::getInstance()->get("votes", "*", ["AND" => ["nomineeid" => $user->data()->userid]]);
		             echo $q4->count();         
                    ?></h1>
				<span><?php echo $lang->votes; ?> <?php echo $lang->you; ?> <?php echo $lang->got; ?></span>
			   </div>
			  </div><!-- /.fun-fact -->
	         </div><!-- /.col-sm-4 -->
			
		    </div><!-- ./row -->							
		   </div><!-- /.tr-fun-fact -->
		   
		 		<div class="box box-info">
                <div class="box-header">
                  <h3 class="box-title"> <?php echo $lang->other; ?> <?php echo $lang->nominees; ?> <?php echo $lang->running; ?> <?php echo $lang->against; ?> <?php echo $lang->you; ?></h3>
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
					   <th><?php echo $lang->votes; ?></th>
                      </tr>
                    </thead>
                    <tbody>
				    <?php
				    $x = 1;
                     $query = DB::getInstance()->get("user", "*", ["AND" => ["positionid" => $user->data()->positionid, "user_type" => 2]]);
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
						 
			             $q4 = DB::getInstance()->get("votes", "*", ["AND" => ["nomineeid" => $row->userid]]);
			             $votes = $q4->count();						 
										
					    echo '<tr>';
						echo '<td>'. escape($x) .'</td>';
					    echo '<td><img src="'. $web->url .'source/nominee/'. $row->imagelocation .'" width="50" height="30" /></td>';
					    echo '<td><a href="'. $web->url .'nominees/'. $row->organizationid .'">'. escape($row->name) .'</a></td>';
						echo '<td><a href="'. $web->url .'nominees/'. $row->organizationid .'">'. escape($r2->name) .'</a></td>';
						echo '<td><a href="'. $web->url .'nominees/'. $row->organizationid .'">'. escape($r3->name) .'</a></td>';
						echo '<td>'. escape($votes) .'</td>';
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
					   <th><?php echo $lang->votes; ?></th>
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