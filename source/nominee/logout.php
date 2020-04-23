<?php

 require_once(__DIR__ .'/../core/frontinit.php');
 
$user = new User();
$user->logout();
Redirect::to($web->url.'login');
?>