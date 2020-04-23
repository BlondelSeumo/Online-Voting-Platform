
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
		   <li><a href="<?php echo $web->url; ?>"><?php echo $lang->home; ?></a></li>
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
                  	Languages
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
		 $user = new User(); 
		 
		 if($user->isLoggedIn()) { ?>
		  
		 <ul class="nav navbar-nav">
		 <li class="dropdown mega-avatar active">
		  <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
		   <span class="avatar w-32"><img src="<?php echo $web->url; ?>source/nominee/<?php echo escape($user->data()->imagelocation); ?>" class="img-resonsive img-circle" width="25" height="25" alt="..."></span>
		   <!-- hidden-xs hides the username on small devices so only the image appears. -->
		   &nbsp;<span>
			<?php echo escape($user->data()->name); ?>
		   </span>
		  </a>
		  <div class="dropdown-menu w dropdown-menu-scale pull-right">
		   <a class="dropdown-item" href="<?php echo $web->url; ?>nominee/dashboard"><span><?php echo $lang->dashboard; ?></span></a> 
		   <a class="dropdown-item" href="<?php echo $web->url; ?>nominee/profile"><span><?php echo $lang->profile; ?></span></a>
		   <a class="dropdown-item" href="<?php echo $web->url; ?>nominee/logout"><?php echo $lang->logout; ?></a>
		  </div>
		 </li><!-- /navbar-item -->
		 </ul>
		   
		<?php } else { ?>	
		 <ul class="nav navbar-nav">
		 	
		  <li><i class="fa fa-user"></i></li>
		  <li><a href="<?php echo $web->url; ?>login">Sign In/ Register </a></li>
		 </ul><!-- /.sign-in -->   
		 <?php } ?> 		 		
		</div><!-- /.nav-right -->
       </div><!-- /.container -->
      </nav><!-- /.navbar -->
     </header><!-- Page Header -->
