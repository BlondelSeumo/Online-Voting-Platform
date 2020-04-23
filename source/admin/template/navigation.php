<?
$url = '';
$url = $_SERVER["REQUEST_URI"];
$pg = parse_url($url, PHP_URL_QUERY);

$admin = new Admin();
?>
<!-- ==============================================
     Main Header Section
     =============================================== -->
     <header class="main-header">
      <a href="<?php echo $web->url; ?>" class="logo">
       <!-- mini logo for sidebar mini 50x50 pixels -->
       <span class="logo-mini"><b><i class="fa fa-user-md"></i></b></span>
       <!-- logo for regular state and mobile devices -->
       <span class="logo-lg"><b>
       	<?php echo $web->sitename; ?></b></span>
      </a>

      <!-- Header Navbar -->
      <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
       <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
       </a>
      <!-- Navbar Right Menu -->
       <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
        <!-- Messages: style can be found in dropdown.less-->
			  <li><a href="<?php echo $web->url; ?>"><i class="fa fa-home"></i> <?php echo $lang->home; ?> <?php echo $lang->page; ?></a></li>
              <!-- User Account Menu -->              
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->
				 <strong><?php echo $lang->languages; ?></strong>	
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
              <!-- User Account Menu -->             
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->
            	<?php // echo $profileimg; ?>
                  <img src="<?php echo $web->url; ?>source/admin/<?php echo escape($admin->data()->imagelocation); ?>" class="user-image" alt="User Image"/>
                
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs">
                  	<?php echo escape($admin->data()->name); ?>
                  </span>
                </a>
                <ul class="dropdown-menu">
						<li class="dropdown-menu-header text-center">
							<strong><?php echo $lang->settings; ?></strong>						
						</li>
						<li class="m_2"><a href="<?php echo $web->url; ?>admin/settings/site"><i class="fa fa-cogs"></i> <?php echo $lang->settings; ?></a></li>
						<li class="m_2"><a href="<?php echo $web->url; ?>admin/profile"><i class="fa fa-user"></i> <?php echo $lang->profile; ?></a></li>
						<li class="m_2"><a href="<?php echo $web->url; ?>admin/logout"><i class="fa fa-lock"></i> <?php echo $lang->logout; ?></a></li>	
        		</ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>