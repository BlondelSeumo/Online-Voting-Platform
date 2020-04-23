<?php
    
	//Setup Settings
    $config_file_default_front    = "folder/frontsetup.php"; 
	//File Directory
    $config_file_directory  = "source/core/";	
	//Init Setup Settings
    $config_file_name_front       = "frontinit.php"; 
	//File Path Directory
    $config_file_path_front       = $config_file_directory.$config_file_name_front;
    //Database SQL
    $sql_dump_file               = "folder/sql.sql";
	
	define("DATABASE_TYPE", "mysql");
	
	// Force database creation
	define("DATABASE_CREATE", false);

    // Defines using of utf-8 encoding and collation for SQL dump file
	define("USE_ENCODING", true);
	define("DUMP_FILE_ENCODING", "utf8");
	define("DUMP_FILE_COLLATION", "utf8_unicode_ci");	
    
?>
