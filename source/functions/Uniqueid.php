<?php

function uniqueid()
{
	$un = substr(number_format(time() * rand(),0,'',''),0,12);
	return $un;
}


?>