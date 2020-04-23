

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
		 <a class="navbar-brand" href="<?php echo $web->url; ?>"><?php echo $web->sitename; ?></a>
		</div><!-- /.navbar-header -->
		<div class="navbar-left">
		 <div class="collapse navbar-collapse" id="navbar-collapse">
		  <ul class="nav navbar-nav">
		   <li class="active"><a href="<?php echo $web->url; ?>"><?php echo $lang->home; ?></a></li>
		   <li><a href="<?php echo $web->url; ?>how"><?php echo $lang->how; ?> <?php echo $lang->it; ?> <?php echo $lang->works; ?></a></li>
		  </ul>
		 </div>
		</div><!-- /.navbar-left -->
		<div class="navbar-right"> 

		 <ul class="nav navbar-nav">
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs">
                  	<?php echo $lang->languages; ?>
                  </span>
                </a>
                <ul class="dropdown-menu">
                	<?php 
					$qnav = DB::getInstance()->get("languages", "*", []);
					if ($qnav->count()) {
						
		              $x = 1;
					 foreach($qnav->results() as $rnav) {
                	  $post ='';
					 	
					  echo $post .='<li class="m_2"><a onclick="changelanguage('. $rnav->languageid .')" style="cursor: pointer;">'. $rnav->language .'</a></li>';
						 
						unset($post);	
					   $x++;	
					 }	
					 	
				     }                 	
                	
                	 ?>	
        		</ul>
              </li>
           </ul> 			                         
		 

	        
		 <?php
		 //Start new Freelancer object
		 $admin = new Admin(); 
		 
		 if($admin->isLoggedIn()) { ?>
		 <ul class="nav navbar-nav">
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->
            	<?php // echo $profileimg; ?>
                  <img src="<?php echo $web->url; ?>source/admin/<?php echo escape($admin->data()->imagelocation); ?>" class="img-circle user-image-p" width="20" height="20" alt="User Image"/>
                
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs">
                  	<?php echo escape($admin->data()->name); ?>
                  </span>
                </a>
                <ul class="dropdown-menu">
						<li class="m_2"><a href="<?php echo $web->url; ?>admin/dashboard"><i class="fa fa-dashboard"></i><?php echo $lang->dashboard; ?></a></li>
						<li class="m_2"><a href="<?php echo $web->url; ?>admin/profile"><i class="fa fa-user"></i><?php echo $lang->profile; ?></a></li>
						<li class="m_2"><a href="<?php echo $web->url; ?>admin/logout"><i class="fa fa-lock"></i> <?php echo $lang->logout; ?></a></li>	
        		</ul>
              </li>
           </ul>   
		<?php } else { ?>	
		 <ul class="nav navbar-nav">
		  <li><i class="fa fa-user"></i></li>
		  <li><a href="<?php echo $web->url; ?>admin/login"><?php echo $lang->login; ?> </a></li>
		 </ul><!-- /.sign-in -->   
		 <?php } ?> 
		 		 
		</div><!-- /.nav-right -->
       </div><!-- /.container -->
      </nav><!-- /.navbar -->
     </header><!-- Page Header -->  