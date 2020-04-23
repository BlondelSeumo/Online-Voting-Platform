<?php
error_reporting(E_ALL);

session_start();

$GLOBALS['config'] = array(
  'mysql' => array(
    'host' => '_DB_HOST_',
    'username' => '_DB_USER_',
    'password' => '_DB_PASSWORD_',
    'db' => '_DB_NAME_'
  ),
  'remember' => array(
    'cookie_name' => 'hash',
    'cookie_expiry' => 604800
  ),
  'language' => array(
    'cookie_name' => 'lang',
    'cookie_expiry' => 600
  ),
  'session' => array(
    'session_admin' => 'admin',
    'session_name' => 'user',
    'token_name' => 'token'
  )
);


spl_autoload_register(function($class){
  require_once __DIR__ .'/../classes/' .$class. '.php';	
});



//Get Site Settings Data
$query = DB::getInstance()->get("settings", "*", ["id" => 1]);
if ($query->count()) {
 foreach($query->results() as $web) {
 }			
}

//Get Payments Settings Data
$qlang = DB::getInstance()->get("languages", "*", ["languageid" => $web->languageid]);
if ($qlang->count()) {
 foreach($qlang->results() as $lang) {
 }			
}

require_once(__DIR__ .'/../functions/paypal_class.php');
require_once(__DIR__ .'/../functions/sanitize.php');
require_once(__DIR__ .'/../functions/Mail.php');
require_once(__DIR__ .'/../functions/TruncateHTML.php');
require_once(__DIR__ .'/../functions/Pagination.php');
require_once(__DIR__ .'/../functions/Functions.php');
require_once(__DIR__ .'/../functions/Uniqueid.php');
require_once(__DIR__ .'/../functions/Slug.php');
require_once(__DIR__ .'/../functions/auto_copyright.php');
require_once(__DIR__ .'/../functions/Feed.php');


if($_COOKIE['lang'] = '') {
	$pglang = 'english';
	
	//Get Site Settings Data
	$qset = DB::getInstance()->get("languages", "*", ["language" => $pglang]);
	if ($qset->count()) {
	 foreach($qset->results() as $rset) {
	 }			
     } 
	
	$siteUpdate = DB::getInstance()->update('settings',[
	    'languageid' => $rset->languageid
    ],[
    'id' => $web->id
    ]);	
	
		
}


if (Cookie::exists(Config::get('remember/cookie_name')) && !Session::exists(Config::get('session/session_name')) 
&& !Session::exists(Config::get('session/session_admin')) && !Session::exists(Config::get('session/session_user'))) {
  $hash = Cookie::get(Config::get('remember/cookie_name'));
  $hashCheck = DB::getInstance()->get("users_session", "*", ["hash" => $hash]);	

  if ($hashCheck->count()) {
  	$admin = new Admin($hashCheck->first()->user_id);
  	$user = new User($hashCheck->first()->user_id);
	
	if ($admin) {
	$admin->login();  
	}else {
	$user->login(); 
	}
	
  }

}
?>