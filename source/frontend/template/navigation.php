
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
		   <li class="<?php echo $active = (Input::get('m') == 'home') ? 'active' : ''; 
		                    echo $active = (Input::get('m') == 'nominees') ? 'active' : '';
		                    echo $active = (Input::get('m') == 'manifesto') ? 'active' : '';
		                    echo $active = (Input::get('m') == 'search') ? 'active' : '';
		                    ?>"><a href="<?php echo $web->url; ?>"><?php echo $lang->home; ?></a></li>
		   <li class="<?php echo $active = (Input::get('m') == 'how') ? 'active' : ''; ?>"><a href="<?php echo $web->url; ?>/how"><?php echo $lang->how; ?> <?php echo $lang->it; ?> <?php echo $lang->works; ?></a></li>
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
		 $user = new User(); 
		 $admin = new Admin(); 
		 
		 if($user->isLoggedIn()) { ?>
		 	
		 	<?php if ($user->data()->user_type == 1) { ?>
				 
			
		  
		 <ul class="nav navbar-nav">
		 <li class="dropdown mega-avatar">
		  <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
		   <span class="avatar w-32"><img src="<?php echo $web->url; ?>source/user/<?php echo escape($user->data()->imagelocation); ?>" class="img-resonsive img-circle" width="25" height="25" alt="..."></span>
		   <!-- hidden-xs hides the username on small devices so only the image appears. -->
		   <span>
			<?php echo escape($user->data()->name); ?>
		   </span>
		  </a>
		  <div class="dropdown-menu w dropdown-menu-scale pull-right">
		   <a class="dropdown-item" href="<?php echo $web->url; ?>account/dashboard"><span><?php echo $lang->dashboard; ?></span></a> 
		   <a class="dropdown-item" href="<?php echo $web->url; ?>account/profile"><span><?php echo $lang->profile; ?></span></a>
		   <a class="dropdown-item" href="<?php echo $web->url; ?>account/logout"><?php echo $lang->logout; ?></a>
		  </div>
		 </li><!-- /navbar-item -->
		 </ul>
		 
		 <?php } else { ?>
				 
		  
		 <ul class="nav navbar-nav">
		 <li class="dropdown mega-avatar">
		  <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
		   <span class="avatar w-32"><img src="<?php echo $web->url; ?>source/nominee/<?php echo escape($user->data()->imagelocation); ?>" class="img-resonsive img-circle" width="25" height="25" alt="..."></span>
		   <!-- hidden-xs hides the username on small devices so only the image appears. -->
		   <span>
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
		 	
		 <?php } ?>
		 
		<?php } elseif($admin->isLoggedIn()) { ?>
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
		  <li class="<?php echo $active = (Input::get('m') == 'login') ? 'active' : ''; ?>"><a href="<?php echo $web->url; ?>login"><?php echo $lang->login; ?></a></li>
		 </ul><!-- /.sign-in -->   
		 <a href="<?php echo $web->url; ?>register" class="kafe-btn kafe-btn-mint-small">
		 	<?php echo $lang->register; ?>
		 	<?php echo $lang->as_as; ?>
		 	<?php echo $lang->a; ?>
		 	<?php echo $lang->voter; ?>
		 </a>
		 <?php } ?> 		 		
		</div><!-- /.nav-right -->
       </div><!-- /.container -->
      </nav><!-- /.navbar -->
     </header><!-- Page Header -->
