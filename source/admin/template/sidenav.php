<?
$admin = new Admin();

$basename = basename($_SERVER["REQUEST_URI"], ".php");
$editname = basename($_SERVER["REQUEST_URI"]);
?>
<!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar user panel (optional) -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo $web->url; ?>source/admin/<?php echo escape($admin->data()->imagelocation); ?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p><?php echo escape($admin->data()->name); ?></p>
              <!-- Status -->
              <a href="<?php echo $web->url; ?>admin/profile"><i class="fa fa-circle text-success"></i> <?php echo $lang->online; ?></a>
            </div>
          </div>


          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
            <li class="header"><?php echo $lang->header; ?></li>
            <!-- Optionally, you can add icons to the links -->
            <li class="<?php echo $active = (Input::get('m') == 'admindashboard') ? ' active' : ''; ?>">
            	<a href="<?php echo $web->url; ?>admin/dashboard"><i class='fa fa-dashboard'></i> <span><?php echo $lang->dashboard; ?></span></a>
            </li>
            <li class="treeview<?php echo $active = (Input::get('m') == 'adminvoterlist') ? ' active' : ''; 
            echo $active = (Input::get('m') == 'adminaddvoter') ? ' active' : '';
			echo $active = (Input::get('m') == 'adminvoterprofile') ? ' active' : '';
			echo $active = (Input::get('m') == 'adminvoterimage') ? ' active' : '';
			echo $active = (Input::get('m') == 'adminvoterpassword') ? ' active' : '';
			 ?>">
              <a href="#"><i class='fa fa-users'></i> <span><?php echo $lang->voters; ?></span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="<?php echo $web->url; ?>admin/voterlist"><?php echo $lang->voters; ?> <?php echo $lang->list; ?></a></li>
                <li><a href="<?php echo $web->url; ?>admin/addvoter"><?php echo $lang->add_add; ?> <?php echo $lang->voter; ?></a></li>
              </ul>
            </li>   
            <li class="treeview<?php echo $active = (Input::get('m') == 'adminorganizationlist') ? ' active' : ''; 
            echo $active = (Input::get('m') == 'adminaddorganization') ? ' active' : '';
			echo $active = (Input::get('m') == 'adminorganizationdetails') ? ' active' : '';
			echo $active = (Input::get('m') == 'adminorganizationimage') ? ' active' : '';
			 ?>">
              <a href="#"><i class='fa fa-align-left'></i> <span><?php echo $lang->organizations; ?></span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="<?php echo $web->url; ?>admin/organizationlist"><?php echo $lang->organization; ?> <?php echo $lang->list; ?></a></li>
                <li><a href="<?php echo $web->url; ?>admin/addorganization"><?php echo $lang->add_add; ?> <?php echo $lang->organization; ?></a></li>
              </ul>
            </li> 
            <li class="treeview<?php echo $active = (Input::get('m') == 'adminpositionlist') ? ' active' : ''; 
            echo $active = (Input::get('m') == 'adminaddposition') ? ' active' : '';
			echo $active = (Input::get('m') == 'admineditposition') ? ' active' : '';
			 ?>">
              <a href="#"><i class='fa fa-align-left'></i> <span><?php echo $lang->positions; ?></span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="<?php echo $web->url; ?>admin/positionlist"><?php echo $lang->position; ?> <?php echo $lang->list; ?></a></li>
                <li><a href="<?php echo $web->url; ?>admin/addposition"><?php echo $lang->add_add; ?> <?php echo $lang->position; ?></a></li>
              </ul>
            </li> 
            <li class="treeview<?php echo $active = (Input::get('m') == 'adminnomineelist') ? ' active' : ''; 
            echo $active = (Input::get('m') == 'adminaddnominee') ? ' active' : '';
			echo $active = (Input::get('m') == 'adminnomineeprofile') ? ' active' : '';
			echo $active = (Input::get('m') == 'adminnomineeimage') ? ' active' : '';
			echo $active = (Input::get('m') == 'adminnomineepassword') ? ' active' : '';
			 ?>">
              <a href="#"><i class='fa fa-users'></i> <span><?php echo $lang->nominees; ?></span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="<?php echo $web->url; ?>admin/nomineelist"><?php echo $lang->nominees; ?> <?php echo $lang->list; ?></a></li>
                <li><a href="<?php echo $web->url; ?>admin/addnominee"><?php echo $lang->add_add; ?> <?php echo $lang->nominee; ?></a></li>
              </ul>
            </li>  
            <li class="treeview<?php echo $active = (Input::get('m') == 'adminlanguagelist') ? ' active' : ''; 
            echo $active = (Input::get('m') == 'adminaddlanguage') ? ' active' : '';
			echo $active = (Input::get('m') == 'admineditlanguage') ? ' active' : '';
			 ?>">
              <a href="#"><i class='fa fa-files-o'></i> <span><?php echo $lang->language_lang; ?></span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="<?php echo $web->url; ?>admin/languagelist"><?php echo $lang->language_lang; ?> <?php echo $lang->list; ?></a></li>
                <li><a href="<?php echo $web->url; ?>admin/addlanguage"><?php echo $lang->add_add; ?> <?php echo $lang->language_lang; ?></a></li>
              </ul>
            </li>        
            <li class="<?php echo $active = (Input::get('m') == 'adminsite') ? ' active' : '';  
            echo $active = (Input::get('m') == 'mail') ? ' active' : '';
			echo $active = (Input::get('m') == 'bgimage') ? ' active' : '';
			echo $active = (Input::get('m') == 'language') ? ' active' : '';
			echo $active = (Input::get('m') == 'analytics') ? ' active' : '';
			?>">
            	<a href="<?php echo $web->url; ?>admin/settings/site"><i class='fa fa-cogs'></i> <span><?php echo $lang->settings; ?></span></a>
            </li>   
          
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>