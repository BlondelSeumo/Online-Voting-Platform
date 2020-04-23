<?php
ob_start();
if(file_exists("./install.php")) {
	header("Location: ./install.php");
}

$source_dir_user = 'source/user/';
$source_dir_nominee = 'source/nominee/';
$source_dir_frontend = 'source/frontend/';
$source_dir_admin = 'source/admin/';

$resource_dir = 'resource/';

$m = $_GET['m'];
switch($m) {
	case "not_found": include($source_dir_user."not_found.php"); break;
	case "home": include($source_dir_frontend."home.php"); break;
	case "how": include($source_dir_frontend."how.php"); break;
	case "profile": include($source_dir_frontend."profile.php"); break;
	case "login": include($source_dir_frontend."login.php"); break;
	case "register": include($source_dir_frontend."register.php"); break;
	case "forgot": include($source_dir_frontend."forgot.php"); break;
	case "reset": include($source_dir_frontend."reset.php"); break;
	case "nominees": include($source_dir_frontend."nominees.php"); break;
	case "manifesto": include($source_dir_frontend."manifesto.php"); break;
	case "search": include($source_dir_frontend."search.php"); break;
	
	case "dashboard": include($source_dir_user."dashboard.php"); break;
	case "editprofile": include($source_dir_user."editprofile.php"); break;
	case "image": include($source_dir_user."image.php"); break;
	case "howitworks": include($source_dir_user."howitworks.php"); break;
	case "password": include($source_dir_user."password.php"); break;
	case "logout": include($source_dir_user."logout.php"); break;

	case "websitedetails": include($source_dir_user."editwebsite.php"); break;	
	case "websiteimage": include($source_dir_user."editwebsite.php"); break;	
	
	case "vote": include($source_dir_user."vote.php"); break;
	case "votesdetails": include($source_dir_user."editvote.php"); break;
	case "voters": include($source_dir_user."voters.php"); break;
	
	case "nomineedashboard": include($source_dir_nominee."dashboard.php"); break;
	case "nomineeeditprofile": include($source_dir_nominee."editprofile.php"); break;
	case "nomineeimage": include($source_dir_nominee."image.php"); break;
	case "nomineehowitworks": include($source_dir_nominee."howitworks.php"); break;
	case "nomineepassword": include($source_dir_nominee."password.php"); break;
	case "nomineelogout": include($source_dir_nominee."logout.php"); break;
	
	case "adminlogin": include($source_dir_admin."index.php"); break;
	case "adminforgot": include($source_dir_admin."forgot.php"); break;
	case "adminreset": include($source_dir_admin."reset.php"); break;
	case "admindashboard": include($source_dir_admin."dashboard.php"); break;
	case "adminlogout": include($source_dir_admin."logout.php"); break;
		
	case "adminprofile": include($source_dir_admin."profile.php"); break;
	case "adminimage": include($source_dir_admin."profile.php"); break;
	case "adminpassword": include($source_dir_admin."profile.php"); break;
	
	case "adminaddvoter": include($source_dir_admin."addvoter.php"); break;
	case "adminvoterlist": include($source_dir_admin."voterlist.php"); break;
	case "adminvoterprofile": include($source_dir_admin."editvoter.php"); break;
	case "adminvoterimage": include($source_dir_admin."editvoter.php"); break;
	case "adminvoterpassword": include($source_dir_admin."editvoter.php"); break;
	
	case "adminaddnominee": include($source_dir_admin."addnominee.php"); break;
	case "adminnomineelist": include($source_dir_admin."nomineelist.php"); break;
	case "adminnomineeprofile": include($source_dir_admin."editnominee.php"); break;
	case "adminnomineeimage": include($source_dir_admin."editnominee.php"); break;
	case "adminnomineepassword": include($source_dir_admin."editnominee.php"); break;
	
	case "adminaddorganization": include($source_dir_admin."addorganization.php"); break;
	case "adminorganizationlist": include($source_dir_admin."organizationlist.php"); break;
	case "adminorganizationdetails": include($source_dir_admin."editorganization.php"); break;
	case "adminorganizationimage": include($source_dir_admin."editorganization.php"); break;
	
	case "adminaddposition": include($source_dir_admin."addposition.php"); break;
	case "adminpositionlist": include($source_dir_admin."positionlist.php"); break;
	case "admineditposition": include($source_dir_admin."editposition.php"); break;
	
	case "adminaddlanguage": include($source_dir_admin."addlanguage.php"); break;
	case "adminlanguagelist": include($source_dir_admin."languagelist.php"); break;
	case "admineditlanguage": include($source_dir_admin."editlanguage.php"); break;
	
	case "adminsite": include($source_dir_admin."settings.php"); break;
	case "mail": include($source_dir_admin."settings.php"); break;
	case "bgimage": include($source_dir_admin."settings.php"); break;
	case "language": include($source_dir_admin."settings.php"); break;
	case "analytics": include($source_dir_admin."settings.php"); break;
	
}

?>