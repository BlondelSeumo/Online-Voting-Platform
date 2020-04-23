<?php
//Check if init.php exists
 require_once(__DIR__ .'/../core/frontinit.php');
 
//Start new Admin Object
$admin = new Admin();

//Check if Admin is logged in
if (!$admin->isLoggedIn()) {
  Redirect::to($web->url.'admin/login');	
}

//Getting Skill Data
$languageid = Input::get('id');
$qt = DB::getInstance()->get("languages", "*", ["languageid" => $languageid, "LIMIT" => 1]);
if ($qt->count() === 1) {
 foreach($qt->results() as $rt) {

 }
} else {
  Redirect::to($web->url.'admin/languagelist');
}	

//Edit Category Data
if (Input::exists()) {
 if(Token::check(Input::get('token'))){

		
		//Update Skill
		$Update = DB::getInstance()->update('languages',[
		   'languages' => Input::get('languages'),
		   'language_lang' => Input::get('language_lang'),
		   'header' => Input::get('header'),
		   'login' => Input::get('login'),
		   'email' => Input::get('email'),
		   'password' => Input::get('password'),
		   'remember_me' => Input::get('remember_me'),
		   'register' => Input::get('register'),
		   'forgot' => Input::get('forgot'),
		   'home' => Input::get('home'),
		   'page' => Input::get('page'),
		   'settings' => Input::get('settings'),
		   'profile' => Input::get('profile'),
		   'logout' => Input::get('logout'),
		   'online' => Input::get('online'),
		   'dashboard' => Input::get('dashboard'),
		   'voters' => Input::get('voters'),
		   'voter' => Input::get('voter'),
		   'add_add' => Input::get('add'),
		   'list' => Input::get('list'),
		   'organizations' => Input::get('organizations'),
		   'organization' => Input::get('organization'),
		   'positions' => Input::get('positions'),
		   'position' => Input::get('position'),
		   'nominees' => Input::get('nominees'),
		   'nominee' => Input::get('nominee'),
		   'control' => Input::get('control'),
		   'panel' => Input::get('panel'),
		   'section' => Input::get('section'),
		   'full' => Input::get('full'),
		   'name' => Input::get('name'),
		   'username' => Input::get('username'),
		   'confirm' => Input::get('confirm'),
		   'choose' => Input::get('choose'),
		   'image' => Input::get('image'),
		   'submit' => Input::get('submit'),
		   'active' => Input::get('active'),
		   'action' => Input::get('action'),
		   'in_active' => Input::get('in_active'),
		   'activate' => Input::get('activate'),
		   'deactivate' => Input::get('deactivate'),
		   'edit' => Input::get('edit'),
		   'delete_delete' => Input::get('delete_delete'),
		   'details_details' => Input::get('details_details'),
		   'change_change' => Input::get('change_change'),
		   'picture' => Input::get('picture'),
		   'current' => Input::get('current'),
		   'new' => Input::get('new'),
		   'nominated' => Input::get('nominated'),
		   'for_for' => Input::get('for_for'),
		   'word' => Input::get('word'),
		   'phrases' => Input::get('phrases'),
		   'of' => Input::get('of'),
		   'site' => Input::get('site'),
		   'background' => Input::get('background'),
		   'title' => Input::get('title'),
		   'description' => Input::get('description'),
		   'keywords' => Input::get('keywords'),
		   'mail' => Input::get('mail'),
		   'select_select' => Input::get('select_select'),
		   'default_default' => Input::get('default_default'),
		   'admin' => Input::get('admin'),
		   'reset' => Input::get('reset'),
		   'votes' => Input::get('votes'),
		   'you' => Input::get('you'),
		   'got' => Input::get('got'),
		   'other' => Input::get('other'),
		   'running' => Input::get('running'),
		   'against' => Input::get('against'),
		   'no' => Input::get('no'),
		   'to_to' => Input::get('to_to'),
		   'be' => Input::get('be'),
		   'how' => Input::get('how'),
		   'it' => Input::get('it'),
		   'works' => Input::get('works'),
		   'your' => Input::get('your'),
		   'describe_describe' => Input::get('describe_describe'),
		   'yourself' => Input::get('yourself'),
		   'manifesto' => Input::get('manifesto'),
		   'please' => Input::get('please'),
		   'vote' => Input::get('vote'),
		   'these' => Input::get('these'),
		   'guys' => Input::get('guys'),
		   'search' => Input::get('search'),
		   'and_and' => Input::get('and_and'),
		   'view' => Input::get('view'),
		   'error' => Input::get('error'),
		   'success' => Input::get('success'),
		   'have' => Input::get('have'),
		   'changed' => Input::get('changed'),
		   'something' => Input::get('something'),
		   'went' => Input::get('went'),
		   'wrong' => Input::get('wrong'),
		   'voted' => Input::get('voted'),
		   'successfully' => Input::get('successfully'),
		   'personal' => Input::get('personal'),
		   'share' => Input::get('share'),
		   'this' => Input::get('this'),
		   'as_as' => Input::get('as_as'),
		   'a' => Input::get('a'),
		],[
		    'languageid' => $rt->languageid
		  ]);
		
	   if (count($Update) > 0) {
			$updatedError = true;
		} else {
			$hasError = true;
		}
		
			

  }
 }

?>
<!DOCTYPE html>
<html lang="en-US" class="no-js">
	
    <!-- Include header.php. Contains header content. -->
    <?php include ('template/header.php'); ?> 

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
            <li class="active"><?php echo $lang->edit; ?> <?php echo $lang->language_lang; ?></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">	 	

		 <div class="row">	
		 	
		 <div class="col-lg-12">
		 	
	      <?php if(isset($hasError)) { //If errors are found ?>
	       <div class="alert alert-danger fade in">
	        <a href="#" class="close" data-dismiss="alert">&times;</a>
	        <strong>Error!</strong> Please check if you've filled all the fields with valid information and try again. Thank you.
		   </div>
	      <?php } ?>
	
		  <?php if(isset($updatedError) && $updatedError == true) { //If email is sent ?>
		   <div class="alert alert-success fade in">
		   <a href="#" class="close" data-dismiss="alert">&times;</a>
		   <strong>Success!</strong> The details have been successfully Updated.</strong>
		   </div>
		  <?php } ?>
		  
          </div>	
           
          
		 <div class="col-lg-12">
		 <!-- Input addon -->
              <div class="box box-info">
                <div class="box-header">
                  <h3 class="box-title"><?php echo $lang->add_add; ?> <?php echo $lang->word; ?> <?php echo $lang->phrases; ?> <?php echo $lang->of; ?> <?php echo $rt->language; ?></h3>
                </div>
                <div class="box-body">
                 <form role="form" method="post" id="editform"> 
                 	
                  <div class="form-group">
                  	<label>Languages</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="languages" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('languages')); 
					  } else {
					  echo escape($rt->languages); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Language</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="language_lang" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('language_lang')); 
					  } else {
					  echo escape($rt->language_lang); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Header</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="header" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('header')); 
					  } else {
					  echo escape($rt->header); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Login</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="login" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('login')); 
					  } else {
					  echo escape($rt->login); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Email</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="email" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('email')); 
					  } else {
					  echo escape($rt->email); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Password</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="password" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('password')); 
					  } else {
					  echo escape($rt->password); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Remember Me</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="remember_me" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('remember_me')); 
					  } else {
					  echo escape($rt->remember_me); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Register</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="register" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('register')); 
					  } else {
					  echo escape($rt->register); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Forgot</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="forgot" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('forgot')); 
					  } else {
					  echo escape($rt->forgot); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Home</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="home" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('home')); 
					  } else {
					  echo escape($rt->home); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Page</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="page" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('page')); 
					  } else {
					  echo escape($rt->page); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Settings</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="settings" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('settings')); 
					  } else {
					  echo escape($rt->settings); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Profile</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="profile" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('profile')); 
					  } else {
					  echo escape($rt->profile); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Logout</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="logout" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('logout')); 
					  } else {
					  echo escape($rt->logout); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Online</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="online" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('online')); 
					  } else {
					  echo escape($rt->online); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Dashboard</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="dashboard" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('dashboard')); 
					  } else {
					  echo escape($rt->dashboard); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Voters</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="voters" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('voters')); 
					  } else {
					  echo escape($rt->voters); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Voter</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="voter" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('voter')); 
					  } else {
					  echo escape($rt->voter); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Add</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="add" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('add')); 
					  } else {
					  echo escape($rt->add_add); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>List</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="list" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('list')); 
					  } else {
					  echo escape($rt->list); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Organizations</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="organizations" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('organizations')); 
					  } else {
					  echo escape($rt->organizations); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Organization</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="organization" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('organization')); 
					  } else {
					  echo escape($rt->organization); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Positions</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="positions" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('positions')); 
					  } else {
					  echo escape($rt->positions); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Position</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="position" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('position')); 
					  } else {
					  echo escape($rt->position); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Nominees</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="nominees" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('nominees')); 
					  } else {
					  echo escape($rt->nominees); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Nominee</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="nominee" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('nominee')); 
					  } else {
					  echo escape($rt->nominee); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Control</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="control" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('control')); 
					  } else {
					  echo escape($rt->control); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Panel</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="panel" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('panel')); 
					  } else {
					  echo escape($rt->panel); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Section</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="section" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('section')); 
					  } else {
					  echo escape($rt->section); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Full</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="full" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('full')); 
					  } else {
					  echo escape($rt->full); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Name</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="name" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('name')); 
					  } else {
					  echo escape($rt->name); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Username</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="username" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('username')); 
					  } else {
					  echo escape($rt->username); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Confirm</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="confirm" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('confirm')); 
					  } else {
					  echo escape($rt->confirm); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Choose</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="choose" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('choose')); 
					  } else {
					  echo escape($rt->choose); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Image</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="image" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('image')); 
					  } else {
					  echo escape($rt->image); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Submit</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="submit" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('submit')); 
					  } else {
					  echo escape($rt->submit); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Active</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="active" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('active')); 
					  } else {
					  echo escape($rt->active); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Action</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="action" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('action')); 
					  } else {
					  echo escape($rt->action); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>In Active</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="in_active" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('in_active')); 
					  } else {
					  echo escape($rt->in_active); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Activate</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="activate" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('activate')); 
					  } else {
					  echo escape($rt->activate); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Deactivate</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="deactivate" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('deactivate')); 
					  } else {
					  echo escape($rt->deactivate); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Edit</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="edit" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('edit')); 
					  } else {
					  echo escape($rt->edit); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Delete</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="delete_delete" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('delete_delete')); 
					  } else {
					  echo escape($rt->delete_delete); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Details</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="details_details" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('details_details')); 
					  } else {
					  echo escape($rt->details_details); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Change</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="change_change" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('change_change')); 
					  } else {
					  echo escape($rt->change_change); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Picture</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="picture" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('picture')); 
					  } else {
					  echo escape($rt->picture); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Current</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="current" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('current')); 
					  } else {
					  echo escape($rt->current); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>New</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="new" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('new')); 
					  } else {
					  echo escape($rt->new); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Nominated</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="nominated" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('nominated')); 
					  } else {
					  echo escape($rt->nominated); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>For</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="for_for" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('for_for')); 
					  } else {
					  echo escape($rt->for_for); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Word</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="word" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('word')); 
					  } else {
					  echo escape($rt->word); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Phrases</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="phrases" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('phrases')); 
					  } else {
					  echo escape($rt->phrases); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Of</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="of" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('of')); 
					  } else {
					  echo escape($rt->of); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Site</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="site" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('site')); 
					  } else {
					  echo escape($rt->site); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Background</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="background" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('background')); 
					  } else {
					  echo escape($rt->background); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Title</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="title" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('title')); 
					  } else {
					  echo escape($rt->title); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Description</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="description" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('description')); 
					  } else {
					  echo escape($rt->description); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Keywords</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="keywords" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('keywords')); 
					  } else {
					  echo escape($rt->keywords); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Mail</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="mail" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('mail')); 
					  } else {
					  echo escape($rt->mail); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Select</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="select_select" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('select_select')); 
					  } else {
					  echo escape($rt->select_select); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Default</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="default_default" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('default_default')); 
					  } else {
					  echo escape($rt->default_default); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Admin</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="admin" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('admin')); 
					  } else {
					  echo escape($rt->admin); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Reset</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="reset" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('reset')); 
					  } else {
					  echo escape($rt->reset); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Votes</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="votes" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('votes')); 
					  } else {
					  echo escape($rt->votes); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>You</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="you" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('you')); 
					  } else {
					  echo escape($rt->you); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Got</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="got" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('got')); 
					  } else {
					  echo escape($rt->got); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Other</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="other" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('other')); 
					  } else {
					  echo escape($rt->other); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Running</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="running" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('running')); 
					  } else {
					  echo escape($rt->running); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Against</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="against" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('against')); 
					  } else {
					  echo escape($rt->against); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>No</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="no" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('no')); 
					  } else {
					  echo escape($rt->no); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>To</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="to_to" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('to_to')); 
					  } else {
					  echo escape($rt->to_to); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Be</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="be" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('be')); 
					  } else {
					  echo escape($rt->be); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>How</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="how" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('how')); 
					  } else {
					  echo escape($rt->how); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>It</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="it" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('it')); 
					  } else {
					  echo escape($rt->it); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Works</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="works" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('works')); 
					  } else {
					  echo escape($rt->works); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Your</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="your" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('your')); 
					  } else {
					  echo escape($rt->your); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Describe</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="describe_describe" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('describe_describe')); 
					  } else {
					  echo escape($rt->describe_describe); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Yourself</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="yourself" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('yourself')); 
					  } else {
					  echo escape($rt->yourself); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Manifesto</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="manifesto" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('manifesto')); 
					  } else {
					  echo escape($rt->manifesto); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Please</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="please" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('please')); 
					  } else {
					  echo escape($rt->please); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Vote</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="vote" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('vote')); 
					  } else {
					  echo escape($rt->vote); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>These</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="these" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('these')); 
					  } else {
					  echo escape($rt->these); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Guys</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="guys" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('guys')); 
					  } else {
					  echo escape($rt->guys); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Search</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="search" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('search')); 
					  } else {
					  echo escape($rt->search); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>And</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="and_and" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('and_and')); 
					  } else {
					  echo escape($rt->and_and); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>View</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="view" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('view')); 
					  } else {
					  echo escape($rt->view); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Error</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="error" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('error')); 
					  } else {
					  echo escape($rt->error); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Success</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="success" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('success')); 
					  } else {
					  echo escape($rt->success); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Have</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="have" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('have')); 
					  } else {
					  echo escape($rt->have); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Changed</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="changed" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('changed')); 
					  } else {
					  echo escape($rt->changed); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Something</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="something" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('something')); 
					  } else {
					  echo escape($rt->something); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Went</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="went" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('went')); 
					  } else {
					  echo escape($rt->went); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Wrong</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="wrong" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('wrong')); 
					  } else {
					  echo escape($rt->wrong); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Voted</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="voted" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('voted')); 
					  } else {
					  echo escape($rt->voted); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Successfully</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="successfully" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('successfully')); 
					  } else {
					  echo escape($rt->successfully); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Personal</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="personal" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('personal')); 
					  } else {
					  echo escape($rt->personal); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>Share</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="share" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('share')); 
					  } else {
					  echo escape($rt->share); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>This</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="this" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('this')); 
					  } else {
					  echo escape($rt->this); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>As</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="as_as" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('as_as')); 
					  } else {
					  echo escape($rt->as_as); 
					  } ?>" />
                   </div>
                  </div>
                 	
                  <div class="form-group">
                  	<label>A</label>	
                   <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="a" class="form-control" value="<?php 
					  if (isset($_POST['details'])) {
						 echo escape(Input::get('a')); 
					  } else {
					  echo escape($rt->a); 
					  } ?>" />
                   </div>
                  </div>
                                   
                  <div class="box-footer">
                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />
                    <button type="submit" name="details" class="btn btn-primary full-width">Submit</button>
                  </div>
                 </form> 
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              

		 
		</div><!-- /.col -->
		
        
			 
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
    <!-- AdminLTE App -->
    <script src="<?php echo $web->url; ?>source/assets/js/app.min.js" type="text/javascript"></script> 
     
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
