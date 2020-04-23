 
		 <div class="tr-sidebar">
		  <ul class="nav profile-tabs" role="tablist">
		   <li role="presentation" class="<?php echo $active = (Input::get('m') == 'dashboard') ? 'active' : '';
		   echo $active = (Input::get('m') == 'vote') ? 'active' : ''; ?>">
		    <a href="<?php echo $web->url; ?>account/dashboard">
			 <i class="fa fa-life-ring" aria-hidden="true"></i> <?php echo $lang->dashboard; ?>
			</a>
		   </li>
		   <li role="presentation" class="<?php echo $active = (Input::get('m') == 'editprofile') ? 'active' : ''; ?>">
		    <a href="<?php echo $web->url; ?>account/profile"><span>
			 <i class="fa fa-user" aria-hidden="true"></i></span> <?php echo $lang->edit; ?> <?php echo $lang->profile; ?>
			</a>
		   </li>
		   <li role="presentation" class="<?php echo $active = (Input::get('m') == 'image') ? 'active' : ''; ?>">
		    <a href="<?php echo $web->url; ?>account/image"><span>
			 <i class="fa fa-user-o" aria-hidden="true"></i></span> <?php echo $lang->profile; ?> <?php echo $lang->image; ?>
			</a>
		   </li>
		   <li role="presentation" class="<?php echo $active = (Input::get('m') == 'password') ? 'active' : ''; ?>">
		    <a href="<?php echo $web->url; ?>account/password"><span>
			 <i class="fa fa-user-o" aria-hidden="true"></i></span> <?php echo $lang->change_change; ?> <?php echo $lang->password; ?>
			</a>
		   </li>
		   <li role="presentation" class="<?php echo $active = (Input::get('m') == 'howitworks') ? 'active' : ''; ?>">
		    <a href="<?php echo $web->url; ?>account/how-it-works"><span>
			 <i class="fa fa-list" aria-hidden="true"></i></span> <?php echo $lang->how; ?> <?php echo $lang->it; ?> <?php echo $lang->works; ?>
			</a>
		   </li>
		   <li role="presentation">
		    <a href="<?php echo $web->url; ?>account/logout"><span>
			 <i class="fa fa-scissors" aria-hidden="true"></i></span> <?php echo $lang->logout; ?>
			</a>
		   </li>
		  </ul>			        			
		 </div><!-- /.tr-sidebar -->  