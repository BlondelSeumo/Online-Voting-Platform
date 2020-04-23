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
          <h1><?php echo $lang->language_lang; ?><small><?php echo $lang->section; ?></small></h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo $web->url; ?>admin/dashboard"><i class="fa fa-dashboard"></i> <?php echo $lang->home; ?></a></li>
            <li class="active"><?php echo $lang->language_lang; ?> <?php echo $lang->list; ?></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">	 	
 
		 <div class="row">	
		 	<div class="col-md-12">
		 		
		 		<div class="box box-info">
                <div class="box-header">
                  <h3 class="box-title"> <?php echo $lang->language_lang; ?> <?php echo $lang->list; ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                 <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
					   <th><?php echo $lang->name; ?></th>
					   <th><?php echo $lang->action; ?></th>
                      </tr>
                    </thead>
                    <tbody>
				    <?php
                     $query = DB::getInstance()->get("languages", "*", []);
                     if($query->count()) {
						foreach($query->results() as $row) {
										
					    echo '<tr id="tr'.$row->languageid.'">';
					    echo '<td>'. escape($row->language) .'</td>';
					    echo '<td>
					    
					      <a href="'. $web->url .'admin/editlanguage/' . escape($row->languageid) . '" class="btn btn-success btn-xs" data-toggle="tooltip" title="' . $lang->add_add . ' ' . $lang->word . ' ' . $lang->phrases . '"><span class="fa fa-edit"></span></a>
					      '.getDeleteLanguage($row->languageid) .'
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
					   <th><?php echo $lang->name; ?></th>
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
    <script src="<?php echo $web->url; ?>source/assets/js/jquery-3.2.1.min.js"></script>
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
	function delete_the_language(id) {
		// id = unique id of the message/comment/chat
		// type = type of post: message/comment/chat
		$('#del_comment_'+id).html('<div class="preloader-retina"></div>');
		
		$.ajax({
			type: "POST",
			url: "<?php echo $web->url; ?>source/admin/template/requests/deletelanguage.php",
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
