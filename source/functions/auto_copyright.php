<?php

function auto_copyright($year = 'auto', $name){
	$copy = ' &copy; ';
	if(intval($year) == 'auto'){
	 $year = date('Y').$copy.$name;
	}
	if(intval($year) == date('Y')){
	 echo intval($year).$copy.$name;
	}
	if(intval($year) < date('Y')){
	 echo intval($year) . ' - ' . date('Y').$copy.$name;
	}
	if(intval($year) > date('Y')){
	 echo date('Y').$copy.$name;
	}
}



?>