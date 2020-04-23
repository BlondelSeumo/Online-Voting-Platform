<?php 
//Check if init.php exists
 require_once(__DIR__ .'/../core/frontinit.php');
 
//Start new Admin Object
$admin = new Admin();

//Check if Admin is logged in
if (!$admin->isLoggedIn()) {
  Redirect::to('admin/login');	
}

?>
<!DOCTYPE html>
<html lang="en-US" class="no-js">

    <!-- Include header.php. Contains header content. -->
    <?php include ('template/header.php'); ?>
     <link type="text/css" href="<?php echo $web->url; ?>source/assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" />
  
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
          <h1><?php echo $lang->nominee; ?><small><?php echo $lang->section; ?></small></h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo $web->url; ?>admin/dashboard"><i class="fa fa-dashboard"></i> <?php echo $lang->home; ?></a></li>
            <li class="active"><?php echo $lang->nominee; ?> <?php echo $lang->list; ?></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">	 	
 
		 <div class="row">	
		 	<div class="col-md-12">
		 		
		 		<div class="box box-info">
                <div class="box-header">
                  <h3 class="box-title"> <?php echo $lang->nominee; ?> <?php echo $lang->list; ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                 <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
					   <th><?php echo $lang->image; ?></th>
					   <th><?php echo $lang->name; ?></th>
					   <th><?php echo $lang->email; ?></th>
					   <th><?php echo $lang->organization; ?></th>
					   <th><?php echo $lang->nominated; ?> <?php echo $lang->for_for; ?></th>
					   <th><?php echo $lang->active; ?></th>
					   <th><?php echo $lang->action; ?></th>
                      </tr>
                    </thead>
                    <tbody>
				    <?php
                     $query = DB::getInstance()->get("user", "*", ["user_type" => 2]);
                     if($query->count()) {
						foreach($query->results() as $row) {
							
					  $qo = DB::getInstance()->get("organization", "*", ["organizationid" => $row->organizationid]);
						if ($qo->count()) {
							 foreach ($qo->results() as $ro) {
						     }
						}
					  $qp = DB::getInstance()->get("position", "*", ["positionid" => $row->positionid]);
						if ($qp->count()) {
							 foreach ($qp->results() as $rp) {
						     }
						}
										
					    echo '<tr id="tr'.$row->userid.'">';
					    echo '<td><img src="'. $web->url .'source/nominee/'. $row->imagelocation .'" width="50" height="30" /></td>';
					    echo '<td>'. escape($row->name) .'</td>';
					    echo '<td>'. escape($row->email) .'</td>';
					    echo '<td>'. escape($ro->name) .'</td>';
					    echo '<td>'. escape($rp->name) .'</td>';
					    if (escape($row->active) == 1) {
					    echo '<td><span class="label label-success"> Active </span> </td>';
						} else {
					    echo '<td><span class="label label-success"> In-Active </span> </td>';
						}
					    echo '<td>
					    
		                 <div id="message-action'.$row->userid.'">
					      '.getActionsNominee($row->userid, null) .'
					     </div> 
					      <a href="'. $web->url .'admin/editnominee/profile/' . escape($row->userid) . '" class="btn btn-success btn-xs" data-toggle="tooltip" title="' . $lang->edit . '"><span class="fa fa-edit"></span></a>
					      '.getDeleteNominee($row->userid) .'
					      </td>';
					    echo '</tr>';
					   }
					}else {
						echo 'No Results';
					}
			        ?>
                    </tbody>
                    <tfoot>
                      <tr>
					   <th><?php echo $lang->image; ?></th>
					   <th><?php echo $lang->name; ?></th>
					   <th><?php echo $lang->email; ?></th>
					   <th><?php echo $lang->organization; ?></th>
					   <th><?php echo $lang->nominated; ?> <?php echo $lang->for_for; ?></th>
					   <th><?php echo $lang->active; ?></th>
					   <th><?php echo $lang->action; ?></th>
                      </tr>
                    </tfoot>
                  </table>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->  	
			  
	         
		 </div><!-- /.col-lg-12 -->	 
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
	<script src="<?php echo $web->url; ?>source/assets/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="<?php echo $web->url; ?>source/assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo $web->url; ?>source/assets/js/app.min.js" type="text/javascript"></script> 
    <!-- page script -->
    <script type="text/javascript">
      $(function () {
        $("#example1").dataTable();
      });
    </script>

    <script type="text/javascript">
	function doActiveNominee(id, state) {
		// id = unique id of the message
		// type = 1 do the like, 2 do the dislike
		$('#like_btn'+id).html('<div class="privacy_loader"></div>');
		$('#doActive'+id).removeAttr('onclick');
		$.ajax({
			type: "POST",
			url: "<?php echo $web->url; ?>source/admin/template/requests/activenominee.php",
			data: "id="+id+"&state="+state, 
			cache: false,
			success: function(html) {
				window.location.reload();
			}
		});
	}		
	function delete_the_nominee(id) {
		// id = unique id of the message/comment/chat
		// type = type of post: message/comment/chat
		$('#del_comment_'+id).html('<div class="preloader-retina"></div>');
		
		$.ajax({
			type: "POST",
			url: "<?php echo $web->url; ?>source/admin/template/requests/deletenominee.php",
			data: "id="+id, 
			cache: false,
			success: function(html) {
				if(html == '1') {
				   $('#tr'+id).fadeOut(500, function() { $('#comment'+id).remove(); });
				} else {
				   $('#tr'+id).html($('#del_comment_'+id).html('Sorry, the comment could not be removed, please refresh the page and try again.'));
				}
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
