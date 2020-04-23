<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en"> 
<!--<![endif]-->
<head>
	
    <!-- Include header.php. Contains header content. -->
    <?php include ('template/header.php'); ?> 
    
</head>
<body>
	
     <!-- Include navigation.php. Contains navigation content. -->
 	 <?php include ('template/navigation.php'); ?> 

	

	 <!-- ==============================================
	 Header Section
	 =============================================== -->	
     <section class="tr-banner section-before bg-image" style="

  background: url('<?php echo $web->url; ?>source/admin/<?php echo $web->bgimage; ?>') no-repeat center center fixed;
  
  background-size: cover;
  background-position: center center;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  color: #fff;
  width: 100%;
  
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  text-align: center;
  color: #fff;
  padding: 120px 0;">
      <div class="container">
       <div class="banner-content text-center">
        <h1><?php echo $web->title; ?></h1>
        <h2><?php echo $lang->search; ?> <?php echo $lang->organizations; ?> <?php echo $lang->and_and; ?> <?php echo $lang->positions; ?>.</h2>

        <form class="form-horizontal" method="post" action="search"> 
		 <div class="col-md-5 no-padd"> 
		  <div class="input-group"> 
			<select name="organizationid" type="text" class="form-control" onclick="ajaxfunction(this.value)">
			 <?php
			 $categoryname = '';
			  echo $categoryname .= '<option value = "0">Nothing Selected</option>';
			  $query = DB::getInstance()->get("organization", "*", []);
				if ($query->count()) {
				   $categoryname = '';
				   $x = 1;
					 foreach ($query->results() as $row) {
					  echo $categoryname .= '<option value = "' . $row->organizationid . '">' . $row->name . '</option>';
					  unset($categoryname); 
					  $x++;
				     }
				}
			 ?>	
			</select>
		  </div>
		 </div>
		 <div class="col-md-5 no-padd"> 
		  <div class="input-group"> 
			<select name="positionid" type="text" class="form-control" id="sub">
			</select>
		  </div>
		 </div>
		 <div class="col-md-2 no-padd"> 
		  <div class="input-group"> 
          <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />
		   <button type="submit" class="kafe-btn kafe-btn-mint full-width"><?php echo $lang->search; ?></button> 
		  </div>
		 </div>
		</form>
		
       </div><!--/. banner-content -->
      </div><!-- /.container -->
     </section>		

	 <!-- ==============================================
	 Feautured Car Section
	 =============================================== -->
     <section class="featured-users">	
      <div class="container">
	  <div class="row">
			<div class="section-title" style="padding-top: 20px;">
				<h1><?php echo $lang->organizations; ?></h1>
			</div>
	  </div>
	   
		  <?php
	
		  $query = DB::getInstance()->get("organization", "*",[]);		  

		 if($query->count()) {
		 	
		 	
          /*
            Start with variables to help with row creation;
          */
            $startRow = true;
            $postCounter = 0;
		    $messageList = '';
		    $x = 1;
			foreach($query->results() as $row) {
				
				
             $q1 = DB::getInstance()->get("position", "*", ["AND" => ["organizationid" => $row->organizationid]]);
             if($q1->count()) {
				foreach($q1->results() as $r1) {
				}
			 }		
				
		    $messageList = '';
			/*
              Check whether we need to add the start of a new row.
              If true, echo a div with the "row" class and set the startRow variable to false 
              If false, do nothing. 
            */
            if ($startRow) {
              echo '<!-- START OF INTERNAL ROW --><div class="row">';
              $startRow = false;
            } 
            /* Add one to the counter because a new post is being added to your page.  */ 
              $postCounter += 1; 
		    echo $messageList .= '
	   
	   <div class="col-lg-4">	
        <div class="box-home clearfix">
         <a href="'. $web->url .'nominees/'. $row->organizationid .'"></a>
          <img src="'. $web->url .'source/admin/'. $row->imagelocation .'" alt="" class="img-resonsive">
         <h3>'. $row->name .'</h3>
         <p>Positions :- '. $q1->count() .'</p>
        </div><!-- /box-home -->
	   </div><!-- /.col-lg-4 -->
					 ';
				
             unset($messageList);	 
			 $x++;		
			
            /*
            Check whether the counter has hit 3 posts.  
            If true, close the "row" div.  Also reset the $startRow variable so that before the next post, a new "row" div is being created. Finally, reset the counter to track the next set of three posts.
            If false, do nothing. 
            */
            if ( 3 === $postCounter ) {
                echo '</div><!-- END OF INTERNAL ROW -->';
                $startRow = true;
                $postCounter = 0;
            } 
            }
		}else {
		 echo $messageList = '<p>No Content Available.</p>';
		}
       ?>	
      </div>	
     </section>
	 
     <!-- Include footer.php. Contains footer content. -->
 	 <?php include ('template/footer.php'); ?> 

	 
	 <!-- ==============================================
	 Scripts
	 =============================================== -->
     <script src="<?php echo $web->url; ?>source/assets/js/jquery-3.2.1.min.js"></script>
	<script src="<?php echo $web->url; ?>source/assets/js/bootstrap.min.js"></script>
	<script src="<?php echo $web->url; ?>source/assets/js/waypoints.min.js"></script>
	<script src="<?php echo $web->url; ?>source/assets/js/jquery.easypiechart.min.js"></script>
	<script src="<?php echo $web->url; ?>source/assets/js/debunk.js"></script> 
	<script type="text/javascript">
	    function ajaxfunction(parent)
	    {
	        $.ajax({
			    type: "POST",
	            url: "<?php echo $web->url; ?>source/admin/template/requests/process.php",
			    data: "parent="+parent, 
			    cache: false,
	            success: function(data) {
	                $("#sub").html(data);
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