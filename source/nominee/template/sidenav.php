 
		 <div class="tr-sidebar">
		  <ul class="nav profile-tabs" role="tablist">
		   <li role="presentation" class="<?php echo $active = (Input::get('m') == 'nomineedashboard') ? 'active' : '';
		   echo $active = (Input::get('m') == 'vote') ? 'active' : ''; ?>">
		    <a href="<?php echo $web->url; ?>nominee/dashboard">
			 <i class="fa fa-life-ring" aria-hidden="true"></i> <?php echo $lang->dashboard; ?>
			</a>
		   </li>
		   <li role="presentation" class="<?php echo $active = (Input::get('m') == 'nomineeeditprofile') ? 'active' : ''; ?>">
		    <a href="<?php echo $web->url; ?>nominee/profile"><span>
			 <i class="fa fa-user" aria-hidden="true"></i></span> <?php echo $lang->edit; ?> <?php echo $lang->profile; ?>
			</a>
		   </li>
		   <li role="presentation" class="<?php echo $active = (Input::get('m') == 'nomineeimage') ? 'active' : ''; ?>">
		    <a href="<?php echo $web->url; ?>nominee/image"><span>
			 <i class="fa fa-user-o" aria-hidden="true"></i></span> <?php echo $lang->profile; ?> <?php echo $lang->image; ?>
			</a>
		   </li>
		   <li role="presentation" class="<?php echo $active = (Input::get('m') == 'nomineepassword') ? 'active' : ''; ?>">
		    <a href="<?php echo $web->url; ?>nominee/password"><span>
			 <i class="fa fa-user-o" aria-hidden="true"></i></span> <?php echo $lang->change_change; ?> <?php echo $lang->password; ?>
			</a>
		   </li>
		   <li role="presentation" class="<?php echo $active = (Input::get('m') == 'nomineehowitworks') ? 'active' : ''; ?>">
		    <a href="<?php echo $web->url; ?>nominee/how-it-works"><span>
			 <i class="fa fa-list" aria-hidden="true"></i></span> <?php echo $lang->how; ?> <?php echo $lang->it; ?> <?php echo $lang->works; ?>
			</a>
		   </li>
		   <li role="presentation">
		    <a href="<?php echo $web->url; ?>nominee/logout"><span>
			 <i class="fa fa-scissors" aria-hidden="true"></i></span> <?php echo $lang->logout; ?>
			</a>
		   </li>
		  </ul>			        			
		 </div><!-- /.tr-sidebar -->  