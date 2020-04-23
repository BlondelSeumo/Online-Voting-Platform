<?php

 require_once(__DIR__ .'/../core/frontinit.php');
 
$admin = new Admin();
$admin->logout();
Redirect::to($web->url.'admin/login');
?>