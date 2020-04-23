<?php
error_reporting(E_ALL);

session_start();

$GLOBALS['config'] = array(
  'remember' => array(
    'cookie_name' => 'hash',
    'cookie_expiry' => 604800
  ),
  'language' => array(
    'cookie_name' => 'lang',
    'session_name' => 'lang',
    'cookie_expiry' => 604800
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