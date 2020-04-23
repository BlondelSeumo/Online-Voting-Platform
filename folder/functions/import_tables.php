<?php
//https://github.com/tazotodua/useful-php-scripts

   function IMPORT_TABLES($host,$user,$pass,$dbname,$sql_file){
	if (!file_exists($sql_file)) {
	  die('Input the SQL filename correctly!');
	} 
	$allLines = file($sql_file);
	$mysqli = new mysqli($host, $user, $pass, $dbname); 
	
	if (mysqli_connect_errno()){
	 return false;	
	 //echo "Failed to connect to MySQL: ";
	 }  else {
	 	
	 $dbsql = file_get_contents($sql_file);
	 
	   if (!$dbsql){
		 die ('Error opening file');
	    }
	   mysqli_multi_query($mysqli, $dbsql) or die('-1' . mysqli_error());
     }	 
	 
	return true; 
	//echo 'Importing finished. Now, Delete the import file.';
  }
?>